@extends('layouts.frontend')
@section('title', 'Dashboard | '. Config::get('siteSetting.site_name') )
@section('css')
@endsection
@section('content')
    <div class="container bg-white mb-2 py-3 px-0">
        <div class="row">
            <div class="col-12 col-md-3">
                @include('users.inc.sidebar')
            </div>
            <div class="col-12 col-md-9">
                @if(count($posts)>0)
                <div class="d-flex">
                    <div class="dash-focus dash-list">
                        <h2>{{$total_posts}}</h2>
                        <p>listing ads</p>
                    </div>
                    <div class="dash-focus dash-book">
                        <h2>{{$follower}}</h2>
                        <p>follower</p>
                    </div>
                    <div class="dash-focus dash-rev">
                        <h2>{{$following}}</h2>
                        <p>following</p>
                    </div>
                </div>
                
                <h4 class="my-3">Published Ads</h4>
                
                <div class="table-responsive">
                    <table id="config-table" class="table post-list table-hover ">
                        <thead class="hidden-xs">
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Ads Title</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $index => $post)
                            <tr id="item{{$post->id}}" class="d-h-flex">
                                <td>{{$index+1}}</td>
                                <td>
                                    <a target="_blank" class="w-100" href="{{ route('post_details', $post->slug) }}">
                                        <img class="iuser" src="{{asset('upload/images/product/'. $post->feature_image)}}">
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <a class="bt" target="_blank" href="{{ route('post_details', $post->slug) }}">
                                            {{$post->title}}
                                        </a>
                                        <p>{{Config::get('siteSetting.currency_symble')}}. {{$post->price}}</p>
                                        <p>Reach</p>
                                        <p>React</p>
                                        <p>Share</p>
                                        <p>Massage</p>
                                        <p>Report</p>
                                        <p>{{Carbon\Carbon::parse($post->created_at)->format(Config::get('siteSetting.date_format'))}}</p>
                                        <p>Views {{$post->views}}</p>
                                    </div>
                                    
                                </td>

                                <td>
                                    <span class="post-status badge @if($post->status == 'reject') badge-danger @elseif($post->status == 'active') badge-success @else badge-info @endif"> {{$post->status}} </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <h3 class="pb-2 mb-2 border-bottom">{{Auth::user()->name}}</h3>
                <div class="my-5 pt-md-5">
                    <div class="d-flex justify-content-center align-items-center">
                        <img width="95" height="63" src="https://w.bikroy-st.com/dist/img/all/shop/empty-1x-6561cc5e.png">
                        <div class="ml-3 text-center">
                            <h4>You don't have any ads yet.</h4>
                            <p>Click the "Post an ad now!" button to post your ad.</p>
                        </div>
                    </div>
                    <p class="d-flex justify-content-center align-items-end my-5">
                        <img height="56" src="{{asset('upload/images/as.jpg')}}">
                        <a class="yb p-2 text-center bt bb2 rounded font-weight-bold f-12 mx-3 mb-n3" href="{{route('post.create')}}">Post your ad now!</a>
                        <img height="56" style="-webkit-transform: scaleX(-1);transform: scaleX(-1);" src="{{asset('upload/images/as.jpg')}}">
                    </p>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection



