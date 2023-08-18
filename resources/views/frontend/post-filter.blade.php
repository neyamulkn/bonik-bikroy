@php
$topOfContent = $middleOfContent = $bottomOfContent = $sitebarTop = $sitebarMiddle = $sitebarBottom = null ;
foreach ($get_ads as $ads){
    if($ads->position == 'top-content'){
        $topOfContent = ($ads->adsType == 'image') ? '<a  href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code;
    }elseif($ads->position == 'middle-content'){
        $middleOfContent = ($ads->adsType == 'image') ? '<a  href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code;
    }elseif($ads->position == 'bottom-content'){
        $bottomOfContent = ($ads->adsType == 'image') ? '<a  href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code;
    }else{
        echo '';
    }
}
@endphp
@if(count($products)>0)


    <?php  
    $addproducts = App\Models\Product::with('get_brand')->where('status', 'active')->selectRaw('id,title,slug,price,category_id,state_id,views,sale_type, feature_image,created_at')->whereRaw('id IN (select MAX(id) FROM products GROUP BY subcategory_id)')->inRandomOrder()->take(7)->get(); 
    ?>
    @if(count($products)>0)
        <div id="carouselExampleControls" class="carousel slide bg-white w-100 rounded" data-ride="carousel" style="max-height: 382px;">
            <div class="carousel-inner">
                @foreach($addproducts as $index => $product)
                    <a href="#" class="carousel-item @if($index==0) active @endif ">
                        <img class="d-block rounded w-100 mh-300 lazyload" src="{{ asset('upload/images/default.jpg')}}" data-src="{{asset('upload/images/product/'.$product->feature_image)}}" alt="{{$product->title}}">
                        <div class="position-absolute left-0 bottom-0 ml-4 w-250 rounded mb-4 bgs p-2">
                            <h4 class="text-white title">{{$product->title}}</h4>
                            <div class="d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                    <b class="text-white pr-1">{{Config::get('siteSetting.currency_symble')}}.</b>
                                    <b class="yt py-1 mr-2">{{$product->price}}</b>
                                </div>
                                <div class="d-flex align-items-center">
                                    <img class="lazyload" src="{{ asset('upload/users/lavel1.png')}}">
                                    <p class="text-white" title="Verified Bonik">Verified Bonik</p>
                                </div>
                                
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <a class="position-absolute left-0 top-50 bg-white px-2 py-1" href="#carouselExampleControls" role="button" data-slide="prev">
                <img height="15" src="{{ asset('upload/images/a.png')}}">
            </a>
            <a class="position-absolute right-0 top-50 bg-white px-2 py-1" href="#carouselExampleControls" role="button" data-slide="next">
                <img height="15" class="transform-180" src="{{ asset('upload/images/a.png')}}">
            </a>
        </div>
    @endif

    <div class="yb py-2 px-2 mx-2 px-md-4 mx-md-4 rounded position-relative mt--4">
        <div class="d-flex align-items-center justify-content-md-between justify-content-around">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#selectcatmodal" class="d-flex align-items-center">
                <img width="35" height="35" class="lazyload mr-2" src="{{ asset('upload/images/m-1.png')}}">
                <p class="bt">  @if($category) {{$category->name}} @else Categories @endif
                </p>
            </a>
            <a href="javascript:void(0)" data-toggle="modal" data-target="#locationmodal" class="d-flex align-items-center">
                <img width="35" height="35" class="lazyload mr-1" src="{{ asset('upload/images/m-2.png')}}">
                <p class="bt">@if($state) {{$state->name}} @else Location @endif</p>
            </a>
            @if(!(new \Jenssegers\Agent\Agent())->isDesktop())
            <a href="javascript:void(0)" class="d-flex align-items-center filterBtn open-filter btn btn-block">
                <img width="35" height="35" class="lazyload mr-1" src="{{ asset('upload/images/m-3.png')}}">
                <p class="bt">Filter</p>
            </a>@endif
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <p style="margin-bottom: 5px;">({{ ($products ?  $products->total() : '0') + count($featureAds) + count($topUpAds)}}  ) ads found {{Request::get('q')}} </p>
        </div>
    </div>
    @if(count($spotlights)>0)
    <div class="row"> 
        <div class="col-lg-12 spotlight">
            <div class="ad-feature-slider slider-arrow" >
                @foreach($spotlights as $spotlight)
                <div class="feature-card" >
                    <a style="display: block;" href="{{ route('post_details', $spotlight->get_adPost->slug) }}">
                    <img class="lazyload" style="max-height:@if((new \Jenssegers\Agent\Agent())->isDesktop()) 350px; @else 250px; @endif height: 100%" src="{{ asset('upload/images/product/default.jpg')}}"  data-src="{{asset('upload/images/product/'. $spotlight->get_adPost->feature_image)}}" alt="{{$spotlight->get_adPost->title}}">
                    <div class="feature-content">
                       
                        <h3 class="feature-title">{{Str::limit($spotlight->get_adPost->title, 60)}}</h3>
                        <div class="feature-meta">
                            @if($spotlight->get_adPost->price > 0)
                                <span class="feature-price">{{Config::get('siteSetting.currency_symble')  .' '. number_format($spotlight->get_adPost->price) }}</span>
                            @else
                                <span class="feature-price">Ask For Price</span>
                            @endif
                            <span class="feature-time"><i class="fas fa-clock"></i>{{Carbon\Carbon::parse($spotlight->get_adPost->approved)->diffForHumans()}}</span>
                        </div>
                    </div>
                    </a>
                    <button type="button" @if(Auth::check()) onclick="addToWishlist({{$spotlight->get_adPost->id}})" data-toggle="tooltip" @else data-toggle="modal" data-target="#so_sociallogin" @endif class="feature-wish @if($spotlight->get_adPost->wishlist) active @endif">
                        <i class="fas fa-heart"></i>
                    </button>

                    @if($spotlight->get_adPackage)
                    <span style="position:absolute;top: 5px;left: -4px;"><img style="width:90px" src="{{asset('upload/images/package/'.$spotlight->get_adPackage->ribbon)}}"></span>@endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    @foreach($urgentAds as $urgentAd)
    <div style="padding:3px 8px;" class="col-12">
        <div class="product-card standard"  style="border: 3px solid {{$urgentAd->get_adPackage->border_color}};">
            <a href="{{ route('post_details', $urgentAd->get_adPost->slug) }}">
            <div class="product-media" @if($urgentAd->user->verify) id="verify-seller" @endif>
                <div class="product-img" >
                    <img class="lazyload" src="{{ asset('upload/images/product/thumb/default.jpg')}}" data-src="{{asset('upload/images/product/thumb/'. $urgentAd->get_adPost->feature_image)}}" alt="{{$urgentAd->get_adPost->title}}">
                </div>

            </div></a>
            <div class="product-content">
                <a href="{{ route('post_details', $urgentAd->get_adPost->slug) }}">
                <h5 class="product-title">
                    {{Str::limit(ucfirst($urgentAd->get_adPost->title), 60)}}
                </h5>
                @if($urgentAd->user && $urgentAd->user->verify)
                <p style="color: #11b76b;font-size: 10px;font-weight: 500;"><img src="https://icon-library.com/images/verified-icon-png/verified-icon-png-11.jpg" width="18" height="16"> VERIFIED SELLER</p>
                @endif
                <div class="product-meta">
                    <span><i class="fas fa-map-marker-alt"></i> {{$urgentAd->get_adPost->get_state->name ?? ''}}</span>
                    <span><i class="fas fa-clock"></i> {{Carbon\Carbon::parse(($urgentAd->get_adPost->approved ? $urgentAd->get_adPost->approved : $urgentAd->get_adPost->created_at))->diffForHumans()}}</span>
                </div></a>
                <div class="product-info">
                    @if($urgentAd->get_adPost->price > 0)
                        <h5 class="product-price">{{Config::get('siteSetting.currency_symble') .' '. number_format($urgentAd->get_adPost->price) }}<span></span></h5>
                    @else
                        <h5 class="product-price">Ask For Price<span></span></h5>
                    @endif
                    <div class="product-btn">

                        <button type="button" title="Wishlist" @if(Auth::check()) onclick="addToWishlist({{$urgentAd->get_adPost->id}})" data-toggle="tooltip" @else data-toggle="modal" data-target="#so_sociallogin" @endif class="far fa-heart @if($urgentAd->get_adPost->wishlist) fas @endif"></button>
                    </div>
                </div>
            </div>
            @if($urgentAd->get_adPackage)
            @php $ribon = explode('-',$urgentAd->get_adPackage->ribbon_position); @endphp
            <span style="position:absolute;top: 0px;left: 0px;width: 95px;"><img style="width:100%" src="{{asset('upload/images/package/'.$urgentAd->get_adPackage->ribbon)}}"></span>@endif
        </div>
    </div>
    @endforeach
    @foreach($featureAds as $index => $featureAd)
    @if($index < 3)
    <div style="padding:3px 8px;" class="col-12">
        <div class="product-card standard"  style=" border: 3px solid {{$featureAd->get_adPackage->border_color}};">
            <a href="{{ route('post_details', $featureAd->get_adPost->slug) }}">
            <div class="product-media" @if($featureAd->user->verify) id="verify-seller" @endif>
                <div class="product-img">
                    <img class="lazyload" src="{{ asset('upload/images/product/thumb/default.jpg')}}" data-src="{{asset('upload/images/product/thumb/'. $featureAd->get_adPost->feature_image)}}" alt="{{$featureAd->get_adPost->title}}">
                </div>
            </div></a>
            <div class="product-content">
                <a href="{{ route('post_details', $featureAd->get_adPost->slug) }}">
                <h5 class="product-title">
                    {{ Str::limit(ucfirst($featureAd->get_adPost->title), 60)}}
                </h5>
                @if($featureAd->user->verify)
                <p style="color: #11b76b;font-size: 10px;font-weight: 500;"><img src="https://icon-library.com/images/verified-icon-png/verified-icon-png-11.jpg" width="18" height="16"> VERIFIED SELLER</p>
                @endif

                <div class="product-meta">
                    <span><i class="fas fa-map-marker-alt"></i> {{$featureAd->get_adPost->get_state->name ?? ''}}</span>
                    <span><i class="fas fa-clock"></i>Just now</span>
                </div></a>
                <div class="product-info">
                    @if($featureAd->get_adPost->price > 0)
                        <h5 class="product-price">{{Config::get('siteSetting.currency_symble') .' '. number_format($featureAd->get_adPost->price) }}<span></span></h5>
                    @else
                        <h5 class="product-price">Ask For Price<span></span></h5>
                    @endif
                    <div class="product-btn">
                        <button type="button" title="Wishlist" @if(Auth::check()) onclick="addToWishlist({{$featureAd->get_adPost->id}})" data-toggle="tooltip" @else data-toggle="modal" data-target="#so_sociallogin" @endif class="far fa-heart @if($urgentAd->get_adPost->wishlist) fas @endif"></button>
                    </div>
                </div>
            </div>
            @if($featureAd->get_adPackage)
            @php $ribon = explode('-',$featureAd->get_adPackage->ribbon_position); @endphp
            <span style="position:absolute;top: 0px;left: 0px;width: 95px;"><img style="width:100%" src="{{asset('upload/images/package/'.$featureAd->get_adPackage->ribbon)}}"></span>@endif
        </div>
    </div>
    @endif
    @endforeach
    @foreach($topUpAds as $topUpAd)
    <div style="padding:3px 8px;" class="col-12">
        <div class="product-card standard"  style="border: 3px solid {{$topUpAd->get_adPackage->border_color}};">
            <a href="{{ route('post_details', $topUpAd->get_adPost->slug) }}">
            <div class="product-media" @if($topUpAd->user->verify) id="verify-seller" @endif>
                <div class="product-img" >
                    <img class="lazyload" src="{{ asset('upload/images/product/thumb/default.jpg')}}" data-src="{{asset('upload/images/product/thumb/'. $topUpAd->get_adPost->feature_image)}}" alt="{{$topUpAd->get_adPost->title}}">
                </div>

            </div></a>
            <div class="product-content">
                <a href="{{ route('post_details', $topUpAd->get_adPost->slug) }}">
                <h5 class="product-title">
                    {{Str::limit(ucfirst($topUpAd->get_adPost->title), 60)}}
                </h5>
                @if($topUpAd->user && $topUpAd->user->verify)
                <p style="color: #11b76b;font-size: 10px;font-weight: 500;"><img src="https://icon-library.com/images/verified-icon-png/verified-icon-png-11.jpg" width="18" height="16"> VERIFIED SELLER</p>
                @endif
                <div class="product-meta">
                    <span><i class="fas fa-map-marker-alt"></i> {{$topUpAd->get_adPost->get_state->name ?? ''}}</span>
                    <span><i class="fas fa-clock"></i>Just now</span>
                </div></a>
                <div class="product-info">
                    @if($topUpAd->get_adPost->price > 0)
                        <h5 class="product-price">{{Config::get('siteSetting.currency_symble') .' '. number_format($topUpAd->get_adPost->price) }}<span></span></h5>
                    @else
                        <h5 class="product-price">Ask For Price<span></span></h5>
                    @endif
                    <div class="product-btn">

                        <button type="button" title="Wishlist" @if(Auth::check()) onclick="addToWishlist({{$topUpAd->get_adPost->id}})" data-toggle="tooltip" @else data-toggle="modal" data-target="#so_sociallogin" @endif class="far fa-heart @if($topUpAd->get_adPost->wishlist) fas @endif "></button>
                    </div>
                </div>
            </div>
            @if($topUpAd->get_adPackage)
            @php $ribon = explode('-',$topUpAd->get_adPackage->ribbon_position); @endphp
            <span style="position:absolute;top: 0px;left: 0px;width: 95px;"><img style="width:100%" src="{{asset('upload/images/package/'.$topUpAd->get_adPackage->ribbon)}}"></span>@endif
        </div>
    </div>
    @endforeach

    @if(count($products)>0)
    <div class="hl-2 mt-2"> 
    @foreach($products as $index => $product)
    <div class="w-100 @if($index==0) ab @else bg-white @endif p-2 mb-2">
        <a class="w-100" href="{{ route('post_details', $product->slug) }}">
            <div class="position-relative">
                <div class="d-flex align-items-center position-absolute left-0 top-0 ">
                    <div class="yb bt px-3 font-weight-bold">{{($product->sale_type) ? $product->sale_type : $product->post_type}}</div>
                    <div class="ff"></div>
                </div>
                <img class="position-absolute right-0 top-0 lazyload" src="{{ asset('upload/images/urgent.png')}}">
                <img class="lazyload w-100 mh-300" src="{{ asset('upload/images/product/thumb/default.jpg')}}" data-src="{{asset('upload/images/product/'.$product->feature_image)}}" alt="{{$product->title}}">
            </div>
            <div class="">
                <h4 class="font-weight-bold bt py-1 title" title="{{ $product->title }}">{{ $product->title }}</h4>
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="d-flex align-items-center">
                            <img class="lazyload" src="{{ asset('upload/users/lavel1.png')}}">
                            <p class="bt" title="Verified Bonik">Verified Bonik</p>
                        </div>
                        <p class="bt py-1" title="{{$product->get_state->name ?? ''}}">{{$product->get_state->name ?? ''}}</p>
                    </div>
                    <div>
                        <img class="lazyload" src="{{ asset('upload/users/pin.png')}}">
                    </div>
                </div>
                
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="font-weight-bold bt py-1">{{Config::get('siteSetting.currency_symble') .' '. number_format($product->price) }}</h4>
                    <p class="bt py-1">{{Carbon\Carbon::parse($product->created_at)->diffForHumans()}}</p>
                </div>
            </div>
            @if($product->get_promoteAd && $product->get_promoteAd->get_adPackage)
            <img src="{{asset('upload/images/package/'.$product->get_promoteAd->get_adPackage->ribbon)}}">
            @endif
        </a>
        <div >
            <form action="{{route('user.sendMessage')}}?send=direct" method="post" class="d-flex align-items-center bb2 rounded shadow mx-3">
            @csrf
            <input type="hidden" name="productOrConId" value="{{$product->id}}">
            <input type="text" name="message" id="message{{$product->id}}" class="px-2 py-1 w-100 rounded" placeholder="Send message">
            <button onclick="sendMessage({{$product->id}})" type="button"><img height="23" src="{{ asset('upload/images/chat2.png')}}"></button>
            </form>
        </div>
    </div>

    @if($products && $index > 2 && $index == (count($products)/2))
    <div style="padding:3px 8px;" class="col-12 advertising">
    {!! $middleOfContent !!}
    </div>
    @endif
    @endforeach
    </div>
    @endif

    @if(count($featureAds)>3)
        @foreach($featureAds as $index => $featureAd)
        @if($index >= 3)
        <div style="padding:3px 8px;" class="col-12">
            <div class="product-card standard"  style=" border: 3px solid {{$featureAd->get_adPackage->border_color}};">
                <a href="{{ route('post_details', $featureAd->get_adPost->slug) }}">
                <div class="product-media" @if($featureAd->user && $featureAd->user->verify) id="verify-seller" @endif>
                    <div class="product-img">
                        <img class="lazyload" src="{{ asset('upload/images/product/thumb/default.jpg')}}" data-src="{{asset('upload/images/product/thumb/'. $featureAd->get_adPost->feature_image)}}" alt="{{$featureAd->get_adPost->title}}">
                    </div>

                </div></a>
                <div class="product-content">
                    <a href="{{ route('post_details', $featureAd->get_adPost->slug) }}">
                    <h5 class="product-title">
                        {{Str::limit(ucfirst($featureAd->get_adPost->title), 60)}}
                    </h5>
                    @if($featureAd->user && $featureAd->user->verify)
                    <p style="color: #11b76b;font-size: 10px;font-weight: 500;"><img src="https://icon-library.com/images/verified-icon-png/verified-icon-png-11.jpg" width="18" height="16"> VERIFIED SELLER</p>
                    @endif
                    <div class="product-meta">
                        <span><i class="fas fa-map-marker-alt"></i>{{$featureAd->get_adPost->get_state->name ?? ''}}</span>
                        <span><i class="fas fa-clock"></i>Just now</span>
                    </div></a>
                    <div class="product-info">
                        @if($featureAd->get_adPost->price > 0)
                            <h5 class="product-price">{{Config::get('siteSetting.currency_symble') .' '. number_format($featureAd->get_adPost->price) }}<span></span></h5>
                        @else
                            <h5 class="product-price">Ask For Price<span></span></h5>
                        @endif
                        <div class="product-btn">

                            <button type="button" title="Wishlist" @if(Auth::check()) onclick="addToWishlist({{$featureAd->get_adPost->id}})" data-toggle="tooltip" @else data-toggle="modal" data-target="#so_sociallogin" @endif class="far fa-heart @if($featureAd->get_adPost->wishlist) fas @endif"></button>
                        </div>
                    </div>
                </div>
                @if($featureAd->get_adPackage)
                @php $ribon = explode('-',$featureAd->get_adPackage->ribbon_position); @endphp
                <span style="position:absolute;top: 0px;left: 0px;width: 95px;"><img style="width:100%" src="{{asset('upload/images/package/'.$featureAd->get_adPackage->ribbon)}}"></span>@endif
            </div>
        </div>
        @endif
        @endforeach
    @endif

    @if($products && count($products) >= 8)
    <div style="padding:3px 8px;" class="col-12 advertising">
    {!! $bottomOfContent !!}
    </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="footer-pagection">
                {{$products->appends(request()->query())->links()}}
                <!-- <p>Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of total {{ ($products ?  $products->total() : '0') + count($featureAds) + count($topUpAds)}} ads</p> -->
            </div>
        </div>
    </div>

@else

<div class="yb py-2 px-2 mx-2 px-md-4 mx-md-4 rounded position-relative mt--4" style="margin:5px 0">
    <div class="d-flex align-items-center justify-content-md-between justify-content-around">
        <a href="javascript:void(0)" data-toggle="modal" data-target="#selectcatmodal" class="d-flex align-items-center">
            <img width="35" height="35" class="lazyload mr-2" src="{{ asset('upload/images/m-1.png')}}">
            <p class="bt">  @if($category) {{$category->name}} @else Categories @endif
            </p>
        </a>
        <a href="javascript:void(0)" data-toggle="modal" data-target="#locationmodal" class="d-flex align-items-center">
            <img width="35" height="35" class="lazyload mr-1" src="{{ asset('upload/images/m-2.png')}}">
            <p class="bt">@if($state) {{$state->name}} @else Location @endif</p>
        </a>
        @if(!(new \Jenssegers\Agent\Agent())->isDesktop())
        <a href="javascript:void(0)" class="d-flex align-items-center filterBtn open-filter btn btn-block">
            <img width="35" height="35" class="lazyload mr-1" src="{{ asset('upload/images/m-3.png')}}">
            <p class="bt">Filter</p>
        </a>@endif
    </div>
</div>

<div style="text-align: center;">
    <h3>Search Result Not Found.</h3>
    <p>We're sorry. We cannot find any matches for your search term</p>
    <i style="font-size: 10rem;" class="fa fa-search"></i>
</div>
@endif
