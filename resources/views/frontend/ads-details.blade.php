@extends('layouts.frontend')
@section('title', $post_detail->title.' | '.Config::get('siteSetting.title'))
@section('metatag')
    <meta name="keywords" content="{{ $post_detail->meta_keywords }}" />
    <meta name="title" content="{{($post_detail->meta_title) ? $post_detail->meta_title : $post_detail->title }}" />
    <meta name="description" content="{!! strip_tags( ($post_detail->meta_description) ? $post_detail->meta_description : Str::limit($post_detail->description, 500)) !!}">
    <meta name="image" content="{{asset('upload/images/product/'.$post_detail->feature_image) }}">
    <meta name="rating" content="5">
    <!-- Schema.org for Google -->
    <meta itemprop="name" content="{{($post_detail->meta_title) ? $post_detail->meta_title : $post_detail->title }}">
    <meta itemprop="description" content="{!! strip_tags(($post_detail->meta_description) ? $post_detail->meta_description : Str::limit($post_detail->description, 500)) !!}">
    <meta itemprop="image" content="{{asset('upload/images/product/'.$post_detail->feature_image) }}">
    <!-- Twitter -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="{{($post_detail->meta_title) ? $post_detail->meta_title : $post_detail->title }}">
    <meta name="twitter:description" content="{!! strip_tags(($post_detail->meta_description) ? $post_detail->meta_description : Str::limit($post_detail->description, 500)) !!}">
    <meta name="twitter:site" content="{{ url()->full() }}">
    <meta name="twitter:creator" content="@neyamul">
    <meta name="twitter:image:src" content="{{asset('upload/images/product/'.$post_detail->feature_image) }}">
    <meta name="twitter:player" content="#">
    <!-- Twitter - Product (e-commerce) -->
    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    <meta property="og:title" content="{{($post_detail->meta_title) ? $post_detail->meta_title : $post_detail->title }}">
    <meta property="og:description" content="{!! strip_tags(($post_detail->meta_description) ? $post_detail->meta_description : Str::limit($post_detail->description, 500)) !!}">
    <meta property="og:image" content="{{asset('upload/images/product/'.$post_detail->feature_image) }}">
    <meta property="og:url" content="{{asset('upload/images/product/'.$post_detail->feature_image) }}">
    <meta property="og:site_name" content="{{Config::get('siteSetting.site_name')}}">
    <meta property="og:locale" content="bd">
    <meta property="og:type" content="product">
@endsection
@section('css')
@endsection
@section('content')
@php
    $get_ads = App\Models\Addvertisement::whereIn('page', ['post', 'all'])->inRandomOrder()->where('status', 1)->get();

    $topOfContent = $middleOfContent = $bottomOfContent = $sitebarTop = $sitebarMiddle = $sitebarBottom = null ;
    foreach ($get_ads as $ads){
        if($ads->position == 'top-content'){
            $topOfContent = ($ads->adsType == 'image') ? '<a  href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code;
        }elseif($ads->position == 'middle-content'){
            $middleOfContent = ($ads->adsType == 'image') ? '<a  href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code;
        }elseif($ads->position == 'bottom-content'){
            $bottomOfContent = ($ads->adsType == 'image') ? '<a  href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code;
        }elseif($ads->position == 'sidebar-top'){
            $sitebarTop = '<div class="sidebar">'. ($ads->adsType == 'image' ? '<a  href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code) . '</div>';
        }elseif($ads->position == 'sidebar-middle'){
            $sitebarMiddle = '<div class="sidebar">'. ($ads->adsType == 'image' ? '<a  href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code) . '</div>';
        }elseif($ads->position == 'sidebar-bottom'){
            $sitebarBottom = '<div class="sidebar">'. ($ads->adsType == 'image' ? '<a href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code) . '</div>' ; 
        }else{
            echo '';
        }
    }
    @endphp
    <div class="breadcrumbs">
        <div class="container">
          <ul class="breadcrumb-cate">
            <li><i class="fa fa-home"></i></li>
              <li><a href="{{route('home.category', $post_detail->get_category->slug ?? '') }}">{{$post_detail->get_category->name ?? ''}}</a></li>
              @if($post_detail->get_subcategory ?? false)
              <li><a href="{{route('home.category', [$post_detail->get_subcategory->slug]) }}">{{$post_detail->get_subcategory->name}}</a></li>
              @endif
              @if($post_detail->get_childcategory ?? false)
              <!-- <li><a href="{{route('home.category', [$post_detail->get_childcategory->slug]) }}">{{$post_detail->get_childcategory->name}}</a></li> -->
              @endif
              <li>{{$post_detail->title}}</li>
          </ul>
        </div>
    </div>
    <div>
        
        <div class="container bg-white mb-3 p-2">
            <img class="w-100" src="{{ asset('upload/images/ads.png')}}" alt="banner">
        </div>
        <div class="container bg-white py-4 px-0 mb-3 rounded">
            <div class="row">
                <div class="col-12 d-flex align-items-start justify-content-between">
                    <div>
                        <h3 class="bt w-100">{{$post_detail->title}}</h3>
                        <p class="bt mt-2 mb-3 w-100">
                            @if($post_detail->get_state)
                                {{$post_detail->get_state->name}}
                            @endif
                            @if($post_detail->get_city),
                                {{$post_detail->get_city->name}}
                            @endif
                        </p>
                    </div>
                    <div class="d-flex align-items-center">
                        <button type="button" @if(Auth::check()) onclick="addToWishlist({{$post_detail->id}})" data-toggle="tooltip" @else data-toggle="modal" data-target="#so_sociallogin" @endif class="wish yb p-2 rounded borders mr-2 sh">
                            <img width="25" height="25" src="{{ asset('upload/images/share.svg')}}" alt="share"
                        </button>
                        <button type="button" data-toggle="modal" data-target="#ad-share" class="yb p-2 rounded borders sh">
                             <img width="25" height="25" src="{{ asset('upload/images/heart.svg')}}" alt="heart">
                        </button>
                    </div>
                </div>
                
                <div class="col-lg-8 col-md-8 col-sm-12 pr-md-0">
                    <div >
                        <div class="ad-details-slider-group">
                            <div class="ad-details-slider slider-arrow">
                                <div><img src="{{asset('upload/images/product/'. $post_detail->feature_image)}}" alt="details"></div>
                                @foreach($post_detail->get_galleryImages as $image)
                                <div><img src="{{asset('upload/images/product/gallery/'. $image->image_path)}}" alt="details"></div>
                                @endforeach
                            </div>
                            
                        </div>
                        <div class="ad-thumb-slider">
                            <div><img src="{{asset('upload/images/product/thumb/'. $post_detail->feature_image)}}" alt="details"></div>
                            @foreach($post_detail->get_galleryImages as $image)
                            <div><img src="{{asset('upload/images/product/gallery/'. $image->image_path)}}" alt="details"></div>
                            @endforeach
                        </div>
                        
                        <p class="bt mt-2">
                            Published On {{Carbon\Carbon::parse(($post_detail->approved) ? $post_detail->approved : $post_detail->created_at)->format(Config::get('siteSetting.date_format'))}}
                            , {{\Carbon\Carbon::parse(($post_detail->approved) ? $post_detail->approved : $post_detail->created_at)->format('h:i A')}}
                        </p>
                        <div class="d-flex align-items-end my-2">
                            <h3 class="pt">{{Config::get('siteSetting.currency_symble') .' '. number_format($post_detail->price) }}</h3>
                            @if($post_detail->negotiable == 1)
                            <p>/negotiable</p>
                            @endif
                        </div>
                        
                        <div class="hl-2">
                            <div class="d-flex align-items-start justify-content-between">
                                <p>Price:</p>
                                <b>@if($post_detail->price > 0) {{Config::get('siteSetting.currency_symble') .' '. number_format($post_detail->price)}} @else Negotiable @endif </b>
                            </div>
                            <div class="d-flex align-items-start justify-content-between">
                                <p>Published:</p>
                                <b>{{Carbon\Carbon::parse(($post_detail->approved) ? $post_detail->approved : $post_detail->created_at)->format(Config::get('siteSetting.date_format'))}}</b>
                            </div>
                            <div class="d-flex align-items-start justify-content-between">
                                <p>Price type:</p>
                                <b>{{($post_detail->negotiable == 1) ? 'negotiable' : 'fixed'}}</b>
                            </div>
                        
                            @if($post_detail->get_brand)
                            <div class="d-flex align-items-start justify-content-between">
                                <p>Brand:</p>
                                <b>{{ $post_detail->get_brand->name}}</b>
                            </div>
                            @endif
                            @if(count($post_detail->get_features)>0)
                            @foreach($post_detail->get_features as $feature)
                            @if($feature->value)
                            <div class="d-flex align-items-start justify-content-between">
                                <p>{{ $feature->name }}: </p> 
                                <b>{{$feature->value}}</b>
                            </div>
                            @endif
                            @endforeach
                            @endif

                            @if(count($post_detail->get_variations)>0)
                            @foreach($post_detail->get_variations as $variation)
                            <div class="d-flex align-items-start justify-content-between">
                                <p>{{$variation->attribute_name}}: </p> 
                                @foreach($variation->get_variationDetails as $variationDetail)

                                @if($variationDetail->get_attributeValue)
                                <b>{{$variationDetail->get_attributeValue->name}}</b>
                                @endif
                                @endforeach
                            </div>
                            @endforeach
                            @endif
                        </div>
                        
                        <div class="description my-2 border-bottom pb-2">
                            <article>{!! $post_detail->description !!}</article>
                        </div>
                        <button class="float-right py-1 px-4 bg-danger text-white bb2 rounded" type="button" @if(Auth::check()) onclick="report({{$post_detail->id}})" data-toggle="tooltip" @else data-toggle="modal" data-target="#so_sociallogin" @endif>Report</button>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="d-flex align-items-center">
                        <a href="{{route('userProfile', $post_detail->author->username)}}" class="mr-3">
                            <img class="rounded" width="70" height="70" src="{{ asset('upload/users') }}/{{($post_detail->author->photo) ? $post_detail->author->photo : 'default.png'}}" alt="{{$post_detail->author->name}}">
                        </a>
                        <div>
                            <h4>{{$post_detail->author->name}}</h4>
                            <h5>joined: {{Carbon\Carbon::parse($post_detail->author->created_at)->format(Config::get('siteSetting.date_format'))}}</h5>
                            <a href="{{route('userProfile', $post_detail->author->username)}}">Visit Member Shop</a>
                        </div>
                    </div>
                    
                    <button type="button" class="w-100 bb p-2 text-center by2 rounded my-2 font-weight-bold d-flex align-items-center" data-toggle="modal" data-target="#number">
                        <img width="40" height="40" src="{{ asset('upload/images/phone.png')}}" alt="banner">
                        @if($post_detail->contact_hidden == 1)
                            <div class="d-flex align-items-center">
                                <h3 class="text-white pl-2">(+880)</h3>
                                <h1 class="text-white h-33">********</h1>
                            </div>
                        @else
                            @if($post_detail->contact_mobile)
                                @foreach(json_decode($post_detail->contact_mobile) as $number)
                                <a class="text-white pl-2" href="tel:{{ $number}}">+88 {{ $number}}</a>
                                @endforeach
                            @endif
                        @endif
                    </button>
                    <div class="d-flex align-items-center">
                        <a class="w-100 p-3 bib d-flex align-items-center justify-content-end mr-1" href="{{route('ads.promotePackage', [$post_detail->slug])}}" title="Message">
                            <h4 class="text-white pr-2">Boost Ad</h4>
                            <img width="30" height="30" src="{{ asset('upload/images/boosti.png')}}" alt="sms">
                        </a>
                        <a class="w-100 bb p-2 text-center by2 rounded my-2 font-weight-bold d-flex align-items-center ml-1" href="{{route('user.message', [$post_detail->author->username, $post_detail->slug])}}" title="Message">
                            <img width="30" height="30" src="{{ asset('upload/images/sms.png')}}" alt="sms">
                            <h4 class="text-white pl-2">Chating</h4>
                        </a>
                    </div>
                    <?php

                    $safety_tip = App\Models\SiteSetting::where('type', 'safety_tip')->first();
                    ?>
                    @if($safety_tip->status == 1)
                    <!-- SAFETY CARD -->
                    <div class="bg-white py-3">
                        <h5 class="">Be Safe</h5>
                        <div class="">
                            {!! ($post_detail->get_category->safety_tip) ? $post_detail->get_category->safety_tip : $safety_tip->value !!}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    @if(count($related_products)>0)
    <div class="container bg-white mb-3 py-4 px-0 rounded">
        <h3 class="mb-4 d-flex align-items-center justify-content-center">Related This <p class="pt font-weight-normal pl-2">Ads</p></h3>
        <div class="hl-3 hl-2 px-md-5">
            @foreach($related_products as $index => $related_product)
            <div class="w-100 @if($index==0) ab @else bg-white @endif p-2 mb-2 position-relative">
                <a class="w-100" href="{{ route('post_details', $related_product->slug) }}">
                    <div class="position-relative">
                        <div class="d-flex align-items-center position-absolute left-0 top-0 ">
                            <div class="yb bt px-3 font-weight-bold">USED</div>
                            <div class="ff"></div>
                        </div>
                        
                        <img class="position-absolute right-0 top-0 lazyload" src="{{ asset('upload/images/urgent.png')}}">
                        <img class="lazyload w-100" src="{{ asset('upload/images/product/thumb/default.jpg')}}" data-src="{{asset('upload/images/product/thumb/'. $related_product->feature_image)}}" alt="{{$related_product->title}}">
                    </div>
                    <div class="w-100">
                        <h4 class="font-weight-bold bt py-1" title="{{ $related_product->title }}">{{ $related_product->title }}</h4>
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="d-flex align-items-center">
                                    <img class="lazyload" src="{{ asset('upload/users/lavel1.png')}}">
                                    <p class="bt" title="Verified Bonik">Verified Bonik</p>
                                </div>
                                <p class="bt py-1" title="{{$product->get_state->name ?? ''}}">{{$related_product->get_state->name ?? ''}}</p>
                            </div>
                            <div>
                                <img class="lazyload" src="{{ asset('upload/users/pin.png')}}">
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="font-weight-bold bt py-1">{{Config::get('siteSetting.currency_symble') .' '. number_format($related_product->price) }}</h4>
                            <p class="bt py-1">{{Carbon\Carbon::parse($related_product->created_at)->diffForHumans()}}</p>
                        </div>
                    </div>
                    @if($related_product->get_promoteAd && $related_product->get_promoteAd->get_adPackage)
                    <img src="{{asset('upload/images/package/'.$related_product->get_promoteAd->get_adPackage->ribbon)}}">
                    @endif
                </a>
                <div class="d-flex align-items-center bb2 rounded shadow w-100">
                    <input type="text" class="px-2 py-1 w-100 rounded" placeholder="Username">
                    <button><img height="23" src="{{ asset('upload/images/chat2.png')}}"></button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    
    <div class="container bg-white mb-3 py-3">
        <img class="w-100" src="{{ asset('upload/images/ads.png')}}" alt="banner">
    </div>
    
    @if($post_detail->contact_hidden == 1)
    <div class="modal fade" id="number">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Contact this Number</h4>
                    <button class="fa fa-times" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <h3 class="modal-number">@if($post_detail->contact_mobile) @foreach(json_decode($post_detail->contact_mobile) as $number) <p><a href="tel:{{ $number}}">{{ $number}}</a></p> @endforeach  @endif</h3>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="modal fade" id="reportModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Product report</h4>
                    <button class="fa fa-times" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('sellerReport')}}" method="post">
                        @csrf()
                        <input type="hidden" name="product_id" value="{{$post_detail->id}}">
                        <div id="reportForm"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>    
    <div class="modal fade" id="ad-share">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Share Product</h4>
                    <button class="fa fa-times" data-dismiss="modal"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-around">
                    <a href="https://www.facebook.com/sharer.php?u={{ route('post_details', $post_detail->slug) }}">
                        <i class="fab fa-facebook-f bt yb p-3 rounded-circle"></i>
                    </a>
                    <a href="https://twitter.com/share?url={{ route('post_details', $post_detail->slug) }}&amp;text={!! $post_detail->title !!}&amp;hashtags=blog">
                        <i class="fab fa-twitter bt yb p-3 rounded-circle"></i>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url={{ route('post_details', $post_detail->slug) }}?rs={{$post_detail->id}}">
                        <i class="fab fa-linkedin-in bt yb p-3 rounded-circle"></i>
                    </a>
                    <a href="https://web.whatsapp.com/send?text={{ route('post_details', $post_detail->slug) }}&amp;title={!! $post_detail->title !!}">
                        <i class="fab fa-whatsapp bt yb p-3 rounded-circle"></i>
                    </a>
                    <a href="https://pinterest.com/pin/create/button/?url={{ route('post_details', $post_detail->slug) }}?rs={{$post_detail->id}}">
                        <i class="fab fa-pinterest-p bt yb p-3 rounded-circle"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="{{asset('js/readmore.js') }}"></script>
<script>
    @if(Auth::check())
    function follower(follower_id){
        $.ajax({
            method:'get',
            url:'{{route("follower")}}',
            data:{
                follower_id:follower_id,
            },
            success:function(data){
                if(data.status){
                    toastr.success(data.msg);
                }
            }
        });
    }

    function report(id){
        $('#reportModal').modal('show');
         $('#reportForm').html('<div class="loadingData-sm"></div>');
        $.ajax({
            method:'get',
            url:'{{route("reportForm")}}',
            data:{
                type:'product'
            },
            success:function(data){
                if(data){
                    $('#reportForm').html(data);
                }
            }
        });
    }
    @endif
    $('article').readmore({speed: 500});
</script>   
@endsection 