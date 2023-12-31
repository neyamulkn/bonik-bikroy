 @extends('layouts.frontend')
@section('title', 'Blog Post' )
@section('css')

@endsection
@section('content')
    <div class="container bg-white mb-2 py-3 px-0">
        <div class="row">
            <div class="col-12 col-md-3">
                @include('users.inc.sidebar')
            </div>
            <div class="col-12 col-md-9">
                <form action="" method="get">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <input name="title" placeholder="Title" value="{{ Request::get('title')}}" type="text" class="form-control mr-md-2">
                        <select name="status" class="form-control mr-md-2">
                            <option value="all" {{ (Request::get('status') == "all") ? 'selected' : ''}}>All Status</option>
                            <option value="pending" {{ (Request::get('status') == 'pending') ? 'selected' : ''}} >Pending</option>
                            <option value="active" {{ (Request::get('status') == 'active') ? 'selected' : ''}}>Active</option>
                            <option value="deactive" {{ (Request::get('status') == 'deactive') ? 'selected' : ''}}>Deactive</option>
                            <option value="reject" {{ (Request::get('status') == 'reject') ? 'selected' : ''}}>Reject</option>
                        </select>
                        <button type="submit" class="form-control btn btn-success mr-md-2">Search</button>
                        <a class="btn btn-primary" href="{{route('blog.create')}}">New</a>
                    </div>
                </form>

                <div class="table-responsive">
                    
                    <table id="config-table" class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Blog Title</th>
                                <th>Category</th>
                                <th>Comments</th>
                                <th>Views</th>
                                <th>Publish</th>
                                <th>Status</th>
                                
                                <th>Action</th>
                            </tr>
                        </thead> 
                        <tbody>
                            @if(count($blogs)>0)
                            @foreach($blogs as $index => $blog)
                            <tr id="item{{$blog->id}}">
                                <td>{{$index+1}}</td>
                                <td><a target="_blank" href="{{ route('blog_details', $blog->slug) }}"><img src="{{asset('upload/images/blog/thumb/'. $blog->image)}}" width="50"> </a></td>
                                <td><a target="_blank" href="{{ route('blog_details', $blog->slug) }}"> {{$blog->title}} </a></td>
                                
                                <td>{{$blog->get_category->name ?? ''}}</td>
                               
                                <td>{{$blog->comments_count}}</td>
                                <td><p style="font-size:10px" class="fa fa-eye">  {{$blog->views}} </p></td>
                                <td>{{Carbon\Carbon::parse($blog->created_at)->format(Config::get('siteSetting.date_format'))}}</td>
                                <td>
                                    @if($blog->status != 'pending')
                                    <div class="custom-control custom-switch">
                                      <input  name="status" onclick="satusActiveDeactive('blogs', {{$blog->id}})"  type="checkbox" {{($blog->status == 'active') ? 'checked' : ''}}  type="checkbox" class="custom-control-input" id="status{{$blog->id}}">
                                      <label style="padding: 5px 12px" class="custom-control-label" for="status{{$blog->id}}"></label>
                                    </div>
                                    @else
                                        <span class="label label-warning"> Pending </span>
                                    @endif
                                </td>
                                <td>
                                   
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <a target="_blank" class="dropdown-item text-inverse" title="View product" href="{{ route('blog_details', $blog->slug) }}"><i class="ti-eye"></i> View Blog</a>
                                            <a class="dropdown-item" title="Edit product" href="{{ route('blog.edit', $blog->slug) }}"><i class="ti-pencil-alt"></i> Edit Blog</a>
                                            <span title="Delete"><button   data-target="#delete" onclick='deleteConfirmPopup("{{route("blog.delete", $blog->id)}}")'  data-toggle="modal" class="dropdown-item" ><i class="ti-trash"></i> Delete Product</button></span>
                                        </div>
                                    </div>                                     
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr style="text-align: center;"><td colspan="8">Blog not found.!</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('users.modal.delete-modal')
@endsection

@section('js')
  <script type="text/javascript">
        //change status by id
        function satusActiveDeactive(table, id, field = null){
            @if(env('MODE') == 'demo')
            toastr.error('Demo mode on edit/update not working');
            return false;
            @endif
            var  url = '{{route("statusChange")}}';
            $.ajax({
                url:url,
                method:"get",
                data:{table:table,field:field,id:id},
                success:function(data){
                    if(data.status){
                        toastr.success(data.message);
                    }else{
                        toastr.error(data.message);
                    }
                }
            });
        }
    </script>  
@endsection