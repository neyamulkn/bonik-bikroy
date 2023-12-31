<input type="hidden" value="{{$data->id}}" name="id">

<div class="col-md-12">
    <div class="form-group">
        <label for="reason">Reason Title</label>
        <input name="reason" id="reason" value="{{$data->reason}}" required="" type="text" class="form-control">
    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        <label class="required" for="reason">Reason for</label>
        <select class="form-control" name="type">
            <option @if($data->type == 'product') selected @endif value="product">Post</option>
            <option @if($data->type == 'product-delete') selected @endif value="product-delete">Product Delete</option>
            <option @if($data->type == 'user') selected @endif value="user">User</option>
        </select>
    </div>
</div>
<div class="col-md-12 mb-12">
    <div class="form-group">
        <label class="switch-box">Status</label>
        <div  class="status-btn" >
            <div class="custom-control custom-switch">
                <input name="status" {{($data->status == 1) ?  'checked' : ''}}   type="checkbox" class="custom-control-input" id="status-edit">
                <label class="custom-control-label" for="status-edit">Publish/UnPublish</label>
            </div>
        </div>
    </div>
</div>

