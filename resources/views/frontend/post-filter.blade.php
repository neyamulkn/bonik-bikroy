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

<style type="text/css">.mt-2 .bg-white{padding: 0.5rem!important}</style>
@if(count($products)>0)

    @if(count($bannerAds)>0)
        <div id="carouselExampleControls" class="carousel slide  w-100 rounded" data-ride="carousel" style="max-height: 382px;">
            <div class="carousel-inner">
                @foreach($bannerAds as $index => $bannerAd)
                    <a href="#" class="carousel-item @if($index==0) active @endif ">
                        <img class="d-block rounded w-100 mh-300 lazyload" src="{{ asset('upload/images/product/default.jpg')}}" data-src="{{asset('upload/images/product/'.$bannerAd->feature_image)}}" alt="{{$bannerAd->title}}">
                        <div class="position-absolute left-0 bottom-0 ml-4 w-250 rounded mb-4 bgs p-2">
                            <h4 class="text-white title">{{$bannerAd->title}}</h4>
                            <div class="d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                    <b class="text-white pr-1">{{Config::get('siteSetting.currency_symble')}}.</b>
                                    <b class="yt py-1 mr-2">{{$bannerAd->price}}</b>
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
            <a class="position-absolute left-0 top-50  px-2 py-1" href="#carouselExampleControls" role="button" data-slide="prev">
                <img height="15" src="{{ asset('upload/images/a.png')}}">
            </a>
            <a class="position-absolute right-0 top-50  px-2 py-1" href="#carouselExampleControls" role="button" data-slide="next">
                <img height="15" class="transform-180" src="{{ asset('upload/images/a.png')}}">
            </a>
        </div>
    @endif

    <div class="yb py-2 px-2 mx-2 px-md-4 mx-md-4 rounded position-relative @if(count($bannerAds)>0) mt--4 @endif">
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

    
    <p style="margin: 5px 0; "> ({{ ($products ?  $products->total() : '0') + count($pinAds) + count($urgentAds) + count($highlightAds) + count($fastAds)}}  ) ads found {{Request::get('q')}} </p>
        
    <div class="row mt-2">
    @if(count($pinAds)>0)
        @foreach($pinAds as $pinAd)
        <div class="col-12 col-sm-6 w-100  p-2 ">
            <a class="w-100 bg-white" href="{{ route('post_details', $pinAd->slug) }}">
                <div class="position-relative">
                    <div class="d-flex align-items-center position-absolute left-0 top-0 ">
                        <div class="yb bt px-3 font-weight-bold">{{($pinAd->sale_type) ? $pinAd->sale_type : $pinAd->post_type}}</div>
                        <div class="ff"></div>
                    </div>
                   
                    <img class="lazyload w-100 mh-300" src="{{ asset('upload/images/product/thumb/default.jpg')}}" data-src="{{asset('upload/images/product/'.$pinAd->feature_image)}}" alt="{{$pinAd->title}}">
                </div>
                <div class="">
                    <h4 class="font-weight-bold bt py-1 title" title="{{ $pinAd->title }}">{{ $pinAd->title }}</h4>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="d-flex align-items-center">
                                <img class="lazyload" src="{{ asset('upload/users/lavel1.png')}}">
                                <p class="bt" title="Verified Bonik">Verified Bonik</p>
                            </div>
                            <p class="bt py-1" title="{{$pinAd->get_state->name ?? ''}}">{{$pinAd->get_state->name ?? ''}}</p>
                        </div>
                        @if($pinAd->ribbon)
                        <div>
                            <img class="lazyload" src="{{ asset('upload/images/package/'.$pinAd->ribbon)}}">
                        </div>@endif
                    </div>
                    
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="font-weight-bold bt py-1">{{Config::get('siteSetting.currency_symble') .' '. number_format($pinAd->price) }}</h4>
                        <p class="bt py-1">{{Carbon\Carbon::parse($pinAd->approved ? $pinAd->approved : $pinAd->created_at)->diffForHumans()}}</p>
                    </div>
                </div>
                
            </a>
            <div class="bg-white">
                <form action="{{route('user.sendMessage')}}?send=direct" method="post" class="d-flex align-items-center bb2 rounded shadow mx-3">
                @csrf
                <input type="hidden" name="productOrConId" value="{{$pinAd->id}}">
                <input type="text" name="message" id="message{{$pinAd->id}}" class="px-2 py-1 w-100 rounded" placeholder="Send message">
                <button @if(Auth::check()) onclick="sendMessage({{$pinAd->id}})" @else data-target="#so_sociallogin" data-toggle="modal" @endif type="button"><img height="23" src="{{ asset('upload/images/chat2.png')}}"></button>
                </form>
            </div>
        </div>
        @endforeach
    @endif

    @foreach($products as $index => $product)

    @if($index == 5)
    
        @foreach($urgentAds as $urgentAd)
        <div class="col-12 col-sm-6 w-100  p-2 ">
            <a class="w-100 bg-white" href="{{ route('post_details', $urgentAd->slug) }}">
                <div class="position-relative">
                    <div class="d-flex align-items-center position-absolute left-0 top-0 ">
                        <div class="yb bt px-3 font-weight-bold">{{($urgentAd->sale_type) ? $urgentAd->sale_type : $urgentAd->post_type}}</div>
                        <div class="ff"></div>
                    </div>
                    @if($urgentAd->ribbon)
                    <img class="position-absolute right-0 top-0 lazyload" src="{{ asset('upload/images/package/'.$urgentAd->ribbon)}}">@endif
                    <img class="lazyload w-100 mh-300" src="{{ asset('upload/images/product/thumb/default.jpg')}}" data-src="{{asset('upload/images/product/'.$urgentAd->feature_image)}}" alt="{{$urgentAd->title}}">
                </div>
                <div class="">
                    <h4 class="font-weight-bold bt py-1 title" title="{{ $urgentAd->title }}">Urgent {{ $urgentAd->title }}</h4>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="d-flex align-items-center">
                                <img class="lazyload" src="{{ asset('upload/users/lavel1.png')}}">
                                <p class="bt" title="Verified Bonik">Verified Bonik</p>
                            </div>
                            <p class="bt py-1" title="{{$urgentAd->state_name}}">{{$urgentAd->state_name}}</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="font-weight-bold bt py-1">{{Config::get('siteSetting.currency_symble') .' '. number_format($urgentAd->price) }}</h4>
                        <p class="bt py-1">{{Carbon\Carbon::parse($urgentAd->approved ? $urgentAd->approved : $urgentAd->created_at)->diffForHumans()}}</p>
                    </div>
                </div>
            </a>
            <div class="bg-white">
                <form action="{{route('user.sendMessage')}}?send=direct" method="post" class="d-flex align-items-center bb2 rounded shadow mx-3">
                @csrf
                <input type="hidden" name="productOrConId" value="{{$urgentAd->id}}">
                <input type="text" name="message" id="message{{$urgentAd->id}}" class="px-2 py-1 w-100 rounded" placeholder="Send message">
                <button @if(Auth::check()) onclick="sendMessage({{$urgentAd->id}})" @else data-target="#so_sociallogin" data-toggle="modal" @endif type="button"><img height="23" src="{{ asset('upload/images/chat2.png')}}"></button>
                </form>
            </div>
        </div>
        @endforeach

    @elseif($index == 10)
   
        @foreach($highlightAds as $highlightAd)
        <div class="col-12 col-sm-6 w-100  p-2 ">
            <a class="w-100 bg-white" href="{{ route('post_details', $highlightAd->slug) }}">
                <div class="position-relative">
                    <div class="d-flex align-items-center position-absolute left-0 top-0 ">
                        <div class="yb bt px-3 font-weight-bold">{{($highlightAd->sale_type) ? $highlightAd->sale_type : $highlightAd->post_type}}</div>
                        <div class="ff"></div>
                    </div>
                    @if($highlightAd->ribbon)
                    <img class="position-absolute right-0 top-0 lazyload" src="{{ asset('upload/images/package/'.$highlightAd->ribbon)}}">@endif
                    <img class="lazyload w-100 mh-300" src="{{ asset('upload/images/product/thumb/default.jpg')}}" data-src="{{asset('upload/images/product/'.$highlightAd->feature_image)}}" alt="{{$highlightAd->title}}">
                </div>
                <div class="">
                    <h4 class="font-weight-bold bt py-1 title" title="{{ $highlightAd->title }}">{{ $highlightAd->title }}</h4>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="d-flex align-items-center">
                                <img class="lazyload" src="{{ asset('upload/users/lavel1.png')}}">
                                <p class="bt" title="Verified Bonik">Verified Bonik</p>
                            </div>
                            <p class="bt py-1" title="{{$highlightAd->state_name}}">{{$highlightAd->state_name}}</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="font-weight-bold bt py-1">{{Config::get('siteSetting.currency_symble') .' '. number_format($highlightAd->price) }}</h4>
                        <p class="bt py-1">{{Carbon\Carbon::parse($highlightAd->approved ? $highlightAd->approved : $highlightAd->created_at)->diffForHumans()}}</p>
                    </div>
                </div>
            </a>
            <div class="bg-white">
                <form action="{{route('user.sendMessage')}}?send=direct" method="post" class="d-flex align-items-center bb2 rounded shadow mx-3">
                @csrf
                <input type="hidden" name="productOrConId" value="{{$highlightAd->id}}">
                <input type="text" name="message" id="message{{$highlightAd->id}}" class="px-2 py-1 w-100 rounded" placeholder="Send message">
                <button @if(Auth::check()) onclick="sendMessage({{$highlightAd->id}})" @else data-target="#so_sociallogin" data-toggle="modal" @endif type="button"><img height="23" src="{{ asset('upload/images/chat2.png')}}"></button>
                </form>
            </div>
        </div>
        @endforeach

        @foreach($fastAds as $fastAd)
        <div class="col-12 col-sm-6 w-100  p-2 ">
            <a class="w-100 bg-white" href="{{ route('post_details', $fastAd->slug) }}">
                <div class="position-relative">
                    <div class="d-flex align-items-center position-absolute left-0 top-0 ">
                        <div class="yb bt px-3 font-weight-bold">{{($fastAd->sale_type) ? $fastAd->sale_type : $fastAd->post_type}}</div>
                        <div class="ff"></div>
                    </div>
                    @if($fastAd->ribbon)
                    <img class="position-absolute right-0 top-0 lazyload" src="{{ asset('upload/images/package/'.$fastAd->ribbon)}}">@endif
                    <img class="lazyload w-100 mh-300" src="{{ asset('upload/images/product/thumb/default.jpg')}}" data-src="{{asset('upload/images/product/'.$fastAd->feature_image)}}" alt="{{$fastAd->title}}">
                </div>
                <div class="">
                    <h4 class="font-weight-bold bt py-1 title" title="{{ $fastAd->title }}">{{ $fastAd->title }}</h4>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="d-flex align-items-center">
                                <img class="lazyload" src="{{ asset('upload/users/lavel1.png')}}">
                                <p class="bt" title="Verified Bonik">Verified Bonik</p>
                            </div>
                            <p class="bt py-1" title="{{$fastAd->state_name}}">{{$fastAd->state_name}}</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="font-weight-bold bt py-1">{{Config::get('siteSetting.currency_symble') .' '. number_format($fastAd->price) }}</h4>
                        <p class="bt py-1">{{Carbon\Carbon::parse($fastAd->approved ? $fastAd->approved : $fastAd->created_at)->diffForHumans()}}</p>
                    </div>
                </div>
            </a>
            <div class="bg-white">
                <form action="{{route('user.sendMessage')}}?send=direct" method="post" class="d-flex align-items-center bb2 rounded shadow mx-3">
                @csrf
                <input type="hidden" name="productOrConId" value="{{$fastAd->id}}">
                <input type="text" name="message" id="message{{$fastAd->id}}" class="px-2 py-1 w-100 rounded" placeholder="Send message">
                <button @if(Auth::check()) onclick="sendMessage({{$fastAd->id}})" @else data-target="#so_sociallogin" data-toggle="modal" @endif type="button"><img height="23" src="{{ asset('upload/images/chat2.png')}}"></button>
                </form>
            </div>
        </div>
        @endforeach
    @else

    @endif
        <div class="col-12 col-sm-6 w-100  p-2 ">
            <a class="w-100 bg-white" href="{{ route('post_details', $product->slug) }}">
                <div class="position-relative">
                    <div class="d-flex align-items-center position-absolute left-0 top-0 ">
                        <div class="yb bt px-3 font-weight-bold">{{($product->sale_type) ? $product->sale_type : $product->post_type}}</div>
                        <div class="ff"></div>
                    </div>
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
                    </div>
                    
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="font-weight-bold bt py-1">{{Config::get('siteSetting.currency_symble') .' '. number_format($product->price) }}</h4>
                        <p class="bt py-1">{{Carbon\Carbon::parse($product->approved ? $product->approved : $product->created_at)->diffForHumans()}}</p>
                    </div>
                </div>
            </a>
            <div class="bg-white">
                <form action="{{route('user.sendMessage')}}?send=direct" method="post" class="d-flex align-items-center bb2 rounded shadow mx-3">
                @csrf
                <input type="hidden" name="productOrConId" value="{{$product->id}}">
                <input type="text" name="message" id="message{{$product->id}}" class="px-2 py-1 w-100 rounded" placeholder="Send message">
                <button @if(Auth::check()) onclick="sendMessage({{$product->id}})" @else data-target="#so_sociallogin" data-toggle="modal" @endif type="button"><img height="23" src="{{ asset('upload/images/chat2.png')}}"></button>
                </form>
            </div>
        </div>
   
        @if($index == 4 && count($link_ads) > 0)
        <!-- //google ad or mobile -->
        <div class="col-12 col-sm-6 w-100  p-2 ">
            <a  href="{{$link_ads[0]['redirect_url']}}"><img class="w-100" src="{{asset('upload/marketing/'.$link_ads[0]['image'])}}" alt=""></a>
        </div>
        @endif

    @endforeach

    <div class="col-12">
        <div class="advertising">
        {!! $bottomOfContent !!}
        </div>
    </div>

    <div class="col-lg-12">
        <div class="footer-pagection">
            {{$products->appends(request()->query())->links()}}
           
        </div>
    </div>
    
</div>

@else

    <div class="yb py-2 px-2 mx-2 px-md-4 mx-md-4 rounded position-relative" style="margin:5px 0">
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
