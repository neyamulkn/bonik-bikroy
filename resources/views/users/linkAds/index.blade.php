 @extends('layouts.frontend')
@section('title', 'Post lists' )
@section('css')
@endsection
@section('content')
    <div class="container bg-white mb-2 py-3 px-0">
        <div class="row">
            <div class="col-12 col-md-3">
                @include('users.inc.sidebar')
            </div>
            <div class="col-12 col-md-9">
                @if(count($advertisements)>0)
               
                <div class="table-responsive">
                    <table id="config-table" class="table post-list table-hover ">
                        <thead class="hidden-xs">
                            <tr>
                                <th>Banner</th>
                                <th>Link</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($advertisements as $index => $ad)
                            <tr class="d-h-flex" id="item{{$ad->id}}">
                                <td>
                                    <a target="_blank" class="w-100" href="{{ $ad->redirect_url }}">
                                        <img class="iuser" width="100" src="{{asset('upload/marketing/'. $ad->image)}}">
                                    </a>
                                </td>
                                <td>
                                    <a target="_blank"  href="{{ $ad->redirect_url }}">
                                       {{ $ad->redirect_url }}
                                    </a>
                                    <div class="d-flex flex-column">
                                        
                                        Position: {{$ad->position}}
                                        
                                        <p>{{Config::get('siteSetting.currency_symble')}}. {{$ad->amount}}</p>
                                        
                                        <p>{{Carbon\Carbon::parse($ad->start_date)->format(Config::get('siteSetting.date_format'))}}</p>
                                        <p>Views {{$ad->views}}</p>
                                        
                                    </div>
                                </td>
                                
                                <td class="action">
                                   <div class="status">
                                        <span class="post-status badge @if($ad->status == 'reject')  badge-danger @elseif($ad->status == 0) badge-danger @elseif($ad->status == 1) badge-success @else badge-info @endif"> @if($ad->status == 1) Active @elseif($ad->status == 0) Deactive @else  {{ $ad->status }} @endif</span>
                                        
                                    </div>
                                    <div class="actionBtn">
                                       
                                        <a href="javascript:void(0)" style="color:red;" data-target="#delete" data-toggle="modal" onclick="confirmPopup({{$ad->id}})" ><i class="fa fa-trash"></i> Delete</a> 
                                    </div>                           
                                </td>
                            </tr>
                            @endforeach
                            <tr style="margin: 5px">{{$advertisements->appends(request()->query())->links()}}</tr>
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
    <div id="delete" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <h4 class="modal-title">Are you sure?</h4>
                    <p>Do you really want to delete these records? This process cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                    <button type="button" value="" id="itemID" onclick="deleteItem(this.value)" data-dismiss="modal" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div> 
@endsection

@section('js')
 
    <script type="text/javascript">


     function confirmPopup(id) {

        document.getElementById('itemID').value = id;
     }
    function deleteItem(id) {

        var link = '{{route("linkAd.delete", ":id")}}';
        var link = link.replace(':id', id);
       
            $.ajax({
            url:link,
            method:"get",
            success:function(data){
                if(data.status){
                    $("#item"+id).hide();
                    toastr.success(data.msg);
                }else{
                    toastr.error(data.msg);
                }
            }

        });
    }

</script>
@endsection