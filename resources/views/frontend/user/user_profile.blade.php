@extends('layouts.frontend')
@section('title', 'Dashboard | '. Config::get('siteSetting.site_name') )
@section('css')
@endsection
@section('content')
    <div class="container bg-white p-0 pb-3 mb-2">
        <img class="lazyload mw-100 h-300" src="{{ asset('upload/images/cover.png')}}">
        <div class="row mt4">
            <div class="col-md-6 d-flex align-items-end">
                <img class="by2 w-150 rounded mr-2 bg-white" src="{{ asset('upload/users') }}/{{($user->photo) ? $user->photo : 'default.png'}}">
                <div>
                    <h3>{{$user->name}}</h3>
                    <div class="d-flex align-items-center">
                        <img class="lazyload" src="{{ asset('upload/users/lavel1.png')}}">
                        <p class="bt" title="Verified Bonik">Verified Bonik</p>
                    </div>
                    <p>Member Since {{Carbon\Carbon::parse($user->created_at)->format(Config::get('siteSetting.date_format'))}}</p>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-end align-items-end">
                <div>
                    <a
                    @if(Auth::check())
                        onclick="report({{$user->id}})" data-toggle="tooltip"
                    @else
                        data-toggle="modal" data-target="#so_sociallogin"
                    @endif
                    class="btn btn-danger" href="javascript:void(0)">Report user</a>
                    <a
                    @if(Auth::check())
                        onclick="follower({{$user->id}})"
                    @else
                        data-toggle="modal" data-target="#so_sociallogin"
                    @endif
                    class="btn btn-success" id="follower" href="javascript:void(0)">
                        @if(Auth::check() && App\Models\FavoriteSeller::where('user_id', Auth::id())->where('follower_id', $user->id)->first())
                        <i class="fa fa-thumbs-down"></i> Unfollow
                        @else
                        <i class="fa fa-thumbs-up"></i> Follow
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container bg-white px-0 py-2 mb-3">
        <div class="row">
            <div class="col-md-4 col-12">
                <div class="d-flex align-items-center border-bottom pb-2 mb-2">
                    <p class="mr-2">Bonik ID: </p>
                    <b>{{$user->id}}</b>
                </div>
                <div class="d-flex align-items-center border-bottom pb-2 mb-2">
                    <p class="mr-2">Published: </p>
                    <b>{{$posts->total()}} Ads</b>
                </div>
                @if($user->mobile)
                <div class="d-flex align-items-center border-bottom pb-2 mb-2">
                    <img width="25" height="25" class="mr-2" src="{{ asset('upload/images/phones.png')}}" alt="logo">
                    <b>{{$user->mobile}}</b>
                </div>
                @endif
                @if($user->email)
                <div class="d-flex align-items-center border-bottom pb-2 mb-2">
                    <img width="25" height="25" class="mr-2" src="{{ asset('upload/images/envelope.png')}}" alt="logo">
                    <b>{{$user->email}} <br><p class="font-weight-normal">via BonikBazar</p></b>
                </div>
                @endif
                <div class="d-flex align-items-center border-bottom pb-2 mb-2">
                    <img width="25" height="25" class="mr-2" src="{{ asset('upload/images/time.png')}}" alt="logo">
                    <div class="w-100">
                        <div class="d-flex justify-content-between">
                            <p>Now Open</p>
                            <p>Closed</p>
                        </div>
                        <b>9.00 AM - 8.00 PM</b>
                    </div>
                </div>
                <div class="d-flex align-items-center border-bottom pb-2 mb-2">
                    <img width="25" height="25" class="mr-2" src="{{ asset('upload/images/maps.png')}}" alt="logo">
                    <b>
                        @if($user->address)
                            {{$user->address}},
                        @endif
                        @if($user->get_city)
                            {{$user->get_city->name}}, 
                        @endif @if($user->get_state)
                            {{$user->get_state->name}}
                        @endif
                    </b>
                </div>
                <div class="d-flex">
                    <p></p>
                    <b></b>
                </div>
            </div>
            <div class="col-md-8 col-12">
                @if(count($posts)>0)
                    <div class="hl-2">
                    @foreach($posts as $index => $post)
                    <div class="w-100 ab p-2 mb-2 position-relative">
                        <a class="w-100" href="{{ route('post_details', $post->slug) }}">
                            <div class="position-relative">
                                <div class="d-flex align-items-center position-absolute left-0 top-0 ">
                                    <div class="yb bt px-3 font-weight-bold">USED</div>
                                    <div class="ff"></div>
                                </div>
                                
                                <img class="position-absolute right-0 top-0 lazyload" src="{{ asset('upload/images/urgent.png')}}">
                                <img class="lazyload w-100" src="{{ asset('upload/images/product/thumb/default.jpg')}}" data-src="{{asset('upload/images/product/thumb/'. $post->feature_image)}}" alt="{{$post->title}}">
                            </div>
                            <div class="w-100">
                                <h4 class="font-weight-bold bt py-1" title="">{{$post->title}}</h4>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <div class="d-flex align-items-center">
                                            <img class="lazyload" src="{{ asset('upload/users/lavel1.png')}}">
                                            <p class="bt" title="Verified Bonik">Verified Bonik</p>
                                        </div>
                                        <p class="bt py-1" title="">Dhaka</p>
                                    </div>
                                    <div>
                                        <img class="lazyload" src="{{ asset('upload/users/pin.png')}}">
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="font-weight-bold bt py-1">{{Config::get('siteSetting.currency_symble') . $post->price}}</h4>
                                    <p class="bt py-1">({{$post->views}}) {{Carbon\Carbon::parse($post->created_at)->format(Config::get('siteSetting.date_format'))}}</p>
                                </div>
                            </div>
                        </a>
                        <div class="d-flex align-items-center bb2 rounded shadow w-100">
                            <input type="text" class="px-2 py-1 w-100 rounded" placeholder="Username">
                            <button><img height="23" src="{{ asset('upload/images/chat2.png')}}"></button>
                        </div>
                    </div>
                    @endforeach
                    </div>
                    {{$posts->appends(request()->query())->links()}}
                @else
                    <h1>Posts not found.!</h1>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="reportModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>User report</h4>
                    <button class="fa fa-times" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('sellerReport')}}" method="post">
                        @csrf()
                        <input type="hidden" name="seller_id" value="{{$user->id}}">
                        <div id="reportForm"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection  

@section('js')
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
                    $('#follower').html(data.msg);
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
                type:'user'
            },
            success:function(data){
                if(data){
                    $('#reportForm').html(data);
                }
            }
        });
    }
    @endif
</script>   
@endsection     
    


