@extends('layouts.frontend')
@section('title', ($category) ? $category->name : 'All ads' . ' | '. Config::get('siteSetting.site_name') )
@section('css')
    <style type="text/css">
        .page-info{font-size: 14px;}
        .filterBtn{text-align: left; border: none; padding: 0px 3px; font-weight: 600;font-size: 14px;}
        .filter{position: fixed;top: 0;background: #fff;z-index: 999;padding: 10px; display: none; overflow-y: scroll;height: 100%;}
        .product-widget-dropitem{padding-left: 5px;}
        .product-meta span{color: var(--gray);font-size: 12px}
        .product-meta {display: flex; flex-direction: column;}
        .product-info{padding: 0;border: none;}
        .page-item.active .page-link{background:#EB5206;}
        @media (max-width: 575px) {
            #verify-seller .product-img{width: 135px;}
          .featurePromotePost{padding: 0;}
          #filter_product{min-height:150px}
      }
      .close-filter{padding-right: 10px}

      #categories a, #location a{display:flex;gap: 5px;color: #000;margin-bottom: 10px;line-height: 15px; margin-left: 10px}
      #categories img{width: 30px;height: 28px;}
      #categories p, #location p{font-size: 12px;color: #857e7e}
    </style>
@endsection
@section('content')
 
    @php
    $topOfContent = $middleOfContent = $bottomOfContent = $sitebarTop = $sitebarMiddle = $sitebarBottom = null ;
    foreach ($get_ads as $ads){
        if($ads->position == 'top-content'){
            $topOfContent = ($ads->adsType == 'image') ? '<a  href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code;
        }elseif($ads->position == 'sidebar-top'){
            $sitebarTop = '<div class="sidebar">'. ($ads->adsType == 'image' ? '<a  href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code) . '</div>';
        }elseif($ads->position == 'sidebar-middle'){
            $sitebarMiddle = '<div class="sidebar">'. ($ads->adsType == 'image' ? '<a  href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code) . '</div>';
        }elseif($ads->position == 'sidebar-bottom'){
            $sitebarBottom = '<div class="sidebar">'. ($ads->adsType == 'image' ? '<a href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code) . '</div>' ; 
        }elseif($ads->position == 'bottom-content'){
            $bottomOfContent = ($ads->adsType == 'image') ? '<a  href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code;
        }else{
            echo '';
        }
    }
    if($category){
        if($category->parent_id && $category->subcategory_id){ $maincategory = $category->get_category->get_category->name; $maincategory_slug = $category->get_category->get_category->slug; }  
        elseif($category->parent_id){$maincategory = $category->get_category->name; $maincategory_slug = $category->get_category->slug;} else{ $maincategory =  $category->name ; $maincategory_slug =  $category->slug ; }


        if($category->parent_id && $category->subcategory_id){ $subcategory = $category->get_category->name; $subcategory_slug = $category->get_category->slug; } 
        elseif($category->parent_id){$subcategory = $category->name; $subcategory_slug = $category->slug; } else{ $subcategory = null; }

        $childcategory = ($category->parent_id && $category->subcategory_id ? $category->name : null);

        $category_name = ($subcategory) ? $subcategory : $maincategory;
    }
    @endphp

        
    <div class="container  px-0">
        @if($topOfContent)
        <div class="advertising">
            {!! $topOfContent !!}
        </div>@endif
        <div class="row">
            <div style="padding-left: 5px; padding-right: 5px;" class="col-lg-4 col-xl-3 @if(!(new \Jenssegers\Agent\Agent())->isDesktop()) filter @endif">
                @if(!(new \Jenssegers\Agent\Agent())->isDesktop())
                <div style="display:flex;align-items: flex-end;justify-content: space-between; margin: 0;"><p>Filters</p><span class="close-filter" >✕</span></div>@endif
                <div>
                    <div class="accordion w-100" id="accordion">
                        <div class="bg-white mb-3">
                            <div class="bb p-2" role="tab" id="headingOne">
                                <div class="w-100 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseOne">
                                    <div class="d-flex align-items-center">
                                        <img class="mr-1" src="{{ asset('upload/images/group.png')}}" alt="group">
                                        <h4 class="yt">Filter by</h4>
                                    </div>
                                    <img class="" src="{{ asset('upload/images/vector.png')}}" alt="vector">
                                </div>
                            </div>
                    
                            <div id="collapseOne" class="collapse show p-2" role="tabpanel" aria-labelledby="headingOne">
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="ad" value="pin" @if(in_array("pin", explode(',', Request::get('ad')))) checked @endif class="common_selector package" id="Pin">
                                    <label class="iy" for="Pin">Pin Ad</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="ad" id="Urgent" @if(in_array("urgent", explode(',', Request::get('ad')))) checked @endif class="common_selector package" value="urgent">
                                    <label class="iy" for="Urgent">Urgent Ad</label>
                                </div>
                                
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="ad" value="highlight" @if(in_array("highlight", explode(',', Request::get('ad')))) checked @endif class="common_selector package" id="highlight">
                                    <label class="iy" for="highlight">Highlight Ad</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="ad" value="fast" @if(in_array("fast", explode(',', Request::get('ad')))) checked @endif class="common_selector package" id="fast">
                                    <label class="iy" for="fast">Fast Ad</label>
                                </div>

                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="member" value="member" @if(in_array("member", explode(',', Request::get('member')))) checked @endif class="common_selector member" id="member">
                                    <label class="iy" for="member">Member Bonik</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="member" value="verified" @if(in_array("verified", explode(',', Request::get('member')))) checked @endif class="common_selector member" id="verified">
                                    <label class="iy" for="verified">Verified Bonik</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="member" value="dealer" @if(in_array("dealer", explode(',', Request::get('member')))) checked @endif class="common_selector member" id="dealer">
                                    <label class="iy" for="dealer">Dealers Bonik</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="agent" value="agent" @if(in_array("agent", explode(',', Request::get('member')))) checked @endif class="common_selector member" id="agent">
                                    <label class="iy" for="agent">Agent Bonik</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="member" value="wholesale" @if(in_array("wholesale", explode(',', Request::get('member')))) checked @endif class="common_selector member" id="wholesale">
                                    <label class="iy" for="wholesale">Wholesale Bonik</label>
                                </div>
                            </div>
                        </div>

                       
                        <div class="bg-white mb-3">
                            <div class="bb p-2" role="tab" id="headingOne">
                                <div class="w-100 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#categories">
                                    <div class="d-flex align-items-center">
                                        <img class="mr-1" src="{{ asset('upload/images/group.png')}}" alt="group">
                                        <h4 class="yt">Categories</h4>
                                    </div>
                                    <img class="" src="{{ asset('upload/images/vector.png')}}" alt="vector">
                                </div>
                            </div>
                    
                            <div id="categories" class="collapse show p-2" role="tabpanel" aria-labelledby="headingOne">
                                <ul class="product-widget-list product-widget-scroll">
                                        
                                    @if($category)
                                    <li><a href="{{ Request::route('location') ? route('home.category', [Request::route('location')]) : route('home.category')}}"> All Categories</a></li>
                                    <li class="product-widget-dropitem">

                                        <li><a href="{{ Request::route('location') ? route('home.category', [ $category->slug, Request::route('location')]) : route('home.category', $category->slug)}}{{ (request()->getQueryString()) ? '?'. request()->getQueryString() : null}}"><img alt="" src="{{ asset('upload/images/category/thumb/'.$category->image) }}"><span>{{$category->name}} <p>{{ ($products ?  $products->total() : '0')}} Ads</p></span> </a></li>

                                        
                                        <ul class="product-widget-dropdown" style="display: block;">
                                            @foreach($category->get_subcategory as $filterCategory )
                                            <li><a href="{{ Request::route('location') ? route('home.category', [ $filterCategory->slug, Request::route('location')]) : route('home.category', $filterCategory->slug)}}{{ (request()->getQueryString()) ? '?'. request()->getQueryString() : null}}"><img alt="" src="{{ asset('upload/images/category/thumb/'.$filterCategory->image) }}"><span> {{$filterCategory->name}} <p>{{$filterCategory->products_by_subcategory_count}} Ads</p></span> </a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    @else
                                    
                                    @foreach($get_category as $show_category)

                                    <li><a href="{{ Request::route('location') ? route('home.category', [ $show_category->slug, Request::route('location')]) : route('home.category', $show_category->slug)}}{{ (request()->getQueryString()) ? '?'. request()->getQueryString() : null}}"><img alt="" src="{{ asset('upload/images/category/thumb/'.$show_category->image) }}"><span>{{$show_category->name}} <p>{{$show_category->products_by_category_count}} Ads</p></span> </a></li>
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                        
                        <div class="bg-white mb-3">
                            <div class="bb p-2" role="tab" id="headingOne">
                                <div class="w-100 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#location">
                                    <div class="d-flex align-items-center">
                                        <img class="mr-1" src="{{ asset('upload/images/group.png')}}" alt="group">
                                        <h4 class="yt">Location</h4>
                                    </div>
                                    <img class="" src="{{ asset('upload/images/vector.png')}}" alt="vector">
                                </div>
                            </div>
                    
                            <div id="location" class="collapse show p-2" role="tabpanel" aria-labelledby="headingOne">
                                <ul class="product-widget-list product-widget-scroll">
                                        
                                    @if($state)
                                    <li><a href="{{ Request::route('location') ? route('home.category', [Request::route('catslug')]) : route('home.category')}}"> All Location</a></li>
                                    <li class="product-widget-dropitem">

                                        <li><a href="{{ Request::route('location') ? route('home.category', [ $state->slug, Request::route('location')]) : route('home.category', $state->slug)}}{{ (request()->getQueryString()) ? '?'. request()->getQueryString() : null}}"><span>{{$state->name}} <p>{{ ($products ?  $products->total() : '0')}} Ads</p></span> </a></li>
                                        @if($state->get_city)
                                        <ul class="product-widget-dropdown" style="display: block;">
                                            @foreach($state->get_city as $city )
                                            <li><a href="{{ Request::route('location') ? route('home.category', [Request::route('catslug'), $city->slug]) : route('home.category', $city->slug) }}{{ (request()->getQueryString()) ? '?'. request()->getQueryString() : null}}"><span> {{$city->name}}<p>{{$city->products_by_city_count}} Ads</p></span> </a></li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                    @else
                                    
                                    @foreach($states as $show_state)

                                    <li><a href="{{ Request::route('catslug') ? route('home.category', [Request::route('catslug'), $show_state->slug]) : route('home.category', $show_state->slug)}}{{ (request()->getQueryString()) ? '?'. request()->getQueryString() : null}}"><span> {{$show_state->name}}<p>{{$show_state->products_by_state_count}} Ads</p></span> </a></li>
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>

                        @if(count($brands)>0)
                        <div class="bg-white mb-3">
                            <div class="bb p-2" role="tab" id="headingOne">
                                <div class="w-100 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseOne">
                                    <div class="d-flex align-items-center">
                                        <img class="mr-1" src="{{ asset('upload/images/group.png')}}" alt="group">
                                        <h4 class="yt">Brand</h4>
                                    </div>
                                    <img class="" src="{{ asset('upload/images/vector.png')}}" alt="vector">
                                </div>
                            </div>
                    
                            <div id="collapseOne" class="collapse show p-2" role="tabpanel" aria-labelledby="headingOne">
                                @foreach($brands as $brand)
                                <div class="d-flex align-items-center">
                                    <input @if(in_array($brand->slug , explode(',', Request::get('brand')))) checked @endif class="common_selector brand" value="{{$brand->slug}}" id="brand{{$brand->id}}" type="checkbox">
                                    <label class="iy" for="brand{{$brand->id}}">Urgent</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        @foreach($product_variations as $product_variation)
                        <!-- check weather value set or not -->
                        @if(count($product_variation->get_attrValues)>0)
                        <div class="bg-white mb-3">
                            <div class="bb p-2" role="tab" id="heading3">
                                <div class="w-100 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapse3">
                                    <div class="d-flex align-items-center">
                                        <img class="mr-1" src="{{ asset('upload/images/group.png')}}" alt="group">
                                        <h4 class="yt">{{$product_variation->name}}</h4>
                                    </div>
                                    <img class="" src="{{ asset('upload/images/vector.png')}}" alt="vector">
                                </div>
                            </div>
                    
                            <div id="collapse3" class="collapse show p-2" role="tabpanel" aria-labelledby="heading3">
                                @foreach($product_variation->get_attrValues as $variationValue)
                                <div class="d-flex align-items-center">
                                    <input  @if(in_array(strtolower($variationValue->name) , explode(',', Request::get(strtolower($product_variation->name)))) ) checked @endif value="{{strtolower($variationValue->name)}}" class=" {{str_replace(' ', '', $product_variation->name)}} common_selector" id="attr{{$variationValue->id}}" type="checkbox">
                                    <label class="iy" for="attr{{$variationValue->id}}">{{ $variationValue->name }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                <div class="bg-white mb-3">
                    <div class="bb p-2" role="tab" id="headingOne">
                        <div class="w-100 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#price">
                            <div class="d-flex align-items-center">
                                <img class="mr-1" src="{{ asset('upload/images/group.png')}}" alt="group">
                                <h4 class="yt">Price</h4>
                            </div>
                            <img class="" src="{{ asset('upload/images/vector.png')}}" alt="vector">
                        </div>
                    </div>
            
                    <div id="price" class="collapse show p-2" role="tabpanel" aria-labelledby="headingOne">
                        <form class="product-widget-form">
                            <div class="product-widget-group">
                                <input type="text" value="{{Request::get('price_min')}}" id="price_min" class="price-range" placeholder="min - 00">
                                <input type="text" value="{{Request::get('price_max')}}" id="price_max" placeholder="max - 1B">
                            </div>
                            <button type="button" class="product-widget-btn common_selector">
                                <i class="fa fa-search"></i>
                                <span>search</span>
                            </button>
                        </form>
                    </div>
                </div>
                @if($sitebarMiddle)
                <div class="bg-white mb-3 p-2">
                    {!! $sitebarMiddle !!}
                </div>@endif
                
            </div>
            <div class="col-md-7 col-xl-7" >
                <div id="filter_product">
                @include('frontend.post-filter')
                </div>
            </div>
            <div class="col-md-2 hidden-xs p-0 bg-white mb-3">
                <div class="advertising w-100 sticky-top">
                {!! $sitebarTop !!} </div>
            </div>
        </div>
        <div class="advertising">{!! $bottomOfContent !!}</div>
    </div>

    <div class="modal fade" id="selectcatmodal" role="dialog" style="display: none;">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="border: none;padding-bottom: 0;">
                    <h4 class="modal-title">Select Category</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="padding: 0 20px;">
                    <ul class="product-widget-list">
                        <li><a href="{{ route('home.category')}}"> All Categories</a></li>
                        @foreach($get_category as $category)
                        <li class="product-widget-dropitem" style="margin: 0;padding: 8px; border-bottom: 1px solid #f1f1f1;">
                            <button type="button" class="product-widget-link">
                                 {{$category->name}}
                            </button>
                            <ul class="product-widget-dropdown" >
                                @foreach($category->get_subcategory as $subcategory )
                                <li><a href="{{ Request::route('location') ? route('home.category', [$subcategory->slug, Request::route('category')]) : route('home.category', $subcategory->slug)}}"> {{$subcategory->name}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="locationmodal" role="dialog" style="display: none;">
        <div class="modal-dialog modal-sm">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="border: none;padding-bottom: 0;">
                    <h4 class="modal-title">Select Location</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="padding: 0 20px;">
                    <ul class="product-widget-list">
                        <li><a href="{{ route('home.category')}}"> All Location</a></li>
                        @foreach($states as $state)
                        <li class="product-widget-dropitem" style="margin: 0;padding: 8px; border-bottom: 1px solid #f1f1f1;">
                            <button type="button" class="product-widget-link">
                                 {{$state->name}}
                            </button>
                            <ul class="product-widget-dropdown">
                                @foreach($state->get_city as $city )
                                <li><a href="{{ Request::route('catslug') ? route('home.category', [Request::route('catslug'), $city->slug]) : route('home.category', $city->slug)}}"> {{$city->name}} ({{$city->products_by_city_count}})</a></li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

<script type="text/javascript">
    
    function filter_data(page)
    {
        //enable loader
        $('#filter_product').html('<div style="display:block;" id="loadingData"></div>');
        
        window.scrollTo({top: 100, behavior: 'smooth'});
        $('.filter').hide().fadeOut();
        
        var category = "{!! str_replace(' ', '', Request::route('catslug')) !!}" ;
        @if(Request::route('location'))
            category += "{{Request::route('location')}}";
        @endif
        var concatUrl = '?';
        
        var searchKey = $("#searchKey").val();
        if(searchKey != '' ){
            concatUrl += 'q='+searchKey;
        }


        @foreach($product_variations as $product_variation)
            var filterValue = get_filter('{{str_replace(' ', '', $product_variation->name)}}');
            if(filterValue != ''){
                concatUrl += '&{{strtolower(str_replace(' ', '', $product_variation->name))}}='+filterValue;
            }  
        @endforeach
       
        

        var package = get_filter('package');
        if(package != '' ){
            concatUrl += '&ad='+package;
        }  

        var member = get_filter('member');
        if(member != '' ){
            concatUrl += '&member='+member;
        }     

        var brand = get_filter('brand');
        if(brand != '' ){
            concatUrl += '&brand='+brand;
        }    
       
        var perPage = null;
        var showItem = $("#perPage :selected").val();
        if(typeof showItem != 'undefined' || showItem != null){
           perPage = showItem;
           //check weather page null or set 
            if(page == null){
                //var active = $('.active .page-link').html();
                var page = 1;
            }
        }

        var sortby = $("#sortby :selected").val();
        if(typeof sortby != 'undefined' && sortby != ''){
            concatUrl += '&sortby='+sortby;
            //check weather page null or set 
            if(page == null){
                //var active = $('.active .page-link').html();
                var page = 1;
            }
        }

        var period = $("#period :selected").val();
        if(typeof period != 'undefined' && period != ''){
            concatUrl += '&period='+period;
            //check weather page null or set 
            if(page == null){
                //var active = $('.active .page-link').html();
                var page = 1;
            }
        }

        var price_min = $("#price_min").val();
        if(price_min != '' ){
            concatUrl += '&price_min='+price_min;
        }

        var price_max = $("#price_max").val();
        if(price_max != '' ){
            concatUrl += '&price_max='+price_max;
        }

        if(page != null){concatUrl += '&page='+page;}
     
        var link = '{{ URL::current() }}/'+concatUrl;
            history.pushState({id: null}, null, link);

        $.ajax({
            url:link,
            method:"get",
            data:{
                filter:'filter',perPage:showItem
            },
            success:function(data){
               
                if(data){
                    $('#filter_product').html(data);
                    
                    //AD LIST FEATURE SLIDER
                    $('.ad-feature-slider').slick({
                        autoplay: true,
                        infinite: true,
                        arrows: true,
                        centerMode: true,
                        // centerPadding: '180px',
                        speed: 800,
                        slidesToShow: 1,
                        prevArrow: '<i class="fa fa-long-arrow-alt-right dandik"></i>',
                        nextArrow: '<i class="fa fa-long-arrow-alt-left bamdik"></i>',
                        responsive: [
                          {
                            breakpoint: 1200,
                            settings: {
                              arrows: true,
                              centerMode: true,
                              centerPadding: '180px',
                              slidesToShow: 1
                            }
                          },
                          {
                            breakpoint: 768,
                            settings: {
                              arrows: true,
                              centerMode: true,
                              centerPadding: '40px',
                              slidesToShow: 1
                            }
                          },
                          {
                            breakpoint: 576,
                            settings: {
                              arrows: false,
                              centerMode: true,
                              centerPadding: '35px',
                              slidesToShow: 1
                            }
                          },
                          {
                            breakpoint: 401,
                            settings: {
                              arrows: false,
                              centerMode: true,
                              centerPadding: '0px',
                              slidesToShow: 1
                            }
                          }
                        ]
                    });
                }else{
                    $('#filter_product').html('Not Found');
                }
            },
            error: function() {
                $('#filter_product').html('<span class="ajaxError">Internal server error.!</span>');
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
       
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

    function sortproduct(){
        filter_data();
    }
    function showPeriod(){
        filter_data();
    }

    function searchItem(value){
        if(value != ''){ filter_data(); }
    }

    $(document).on('click', '.pagination a', function(e){
        e.preventDefault();

        var page = $(this).attr('href').split('page=')[1];

        filter_data(page);
    });

      
        $(window).on('popstate', function() {  
           var page = $('.pagination a').attr('href').split('page=')[1];
           
            if(page != 'undefined' && page>0){
                window.scrollTo({top: 100, behavior: 'smooth'});
                filter_data(page);
            }
       });

    

    $('#resetAll').click(function(){
        $('input:checkbox').removeAttr('checked');
        $('input[type=checkbox]').prop('checked', false);
        $("#searchKey").val('');
        $('input:radio').removeAttr('checked');
         $("#price-range").val('0');
        //call function
        filter_data();
    });

    $(document).ready(function(){

        $(document).on("click", ".open-filter", function(e){
            e.preventDefault();
            $(".filter").show().fadeIn();
        });
       
        $('.close-filter').click(function() {
          
            $('.filter').hide().fadeOut();
            
        }); 
    });


    function sendMessage(product_id){
    
    var message = $('#message'+product_id).val();
   
      $.ajax({
        url:'{{route("user.sendMessage")}}',
        type:'post',
        data:{productOrConId:product_id,message:message,'_token':'{{ csrf_token() }}'},
        success:function(data){
            if(data){
                $('#message'+product_id).val('');
                toastr.success('Message send success.');
            }else{
                toastr.error('Message send failad.');
            }
          }
      });
    }

</script>

@endsection

