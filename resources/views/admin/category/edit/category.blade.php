<input type="hidden" value="{{$data->id}}" name="id">

<div class="col-md-12">
    <div class="form-group">
        <label for="name">Name</label>
        <input  name="name" id="name" value="{{$data->name}}" required="" type="text" class="form-control">
    </div>
</div>



<div class="col-md-12">
    <div class="form-group"> 
        <label class="dropify_image">Feature Image</label>
        <input data-default-file="{{asset('upload/images/category/'.$data->image)}}" type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="2M"  name="phato" id="input-file-events">
    </div>
    @if ($errors->has('phato'))
        <span class="invalid-feedback" role="alert">
            {{ $errors->first('phato') }}
        </span>
    @endif
</div>

<div class="row justify-content-md-center">
    <div class="col-md-3">
        <label for="name">URGENT ADS</label>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="ua_1">3 days</label>
            <input  name="ua_1" id="ua_1" value="{{$data->ua_1}}" required="" type="text" class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="ua_2">7 days</label>
            <input  name="ua_2" id="ua_2" value="{{$data->ua_2}}" required="" type="text" class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="ua_3">15 days</label>
            <input  name="ua_3" id="ua_3" value="{{$data->ua_3}}" required="" type="text" class="form-control">
        </div>
    </div>
</div>

<div class="row justify-content-md-center">
    <div class="col-md-3">
        <label for="name">PIN ADS</label>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="pa_1">3 days</label>
            <input  name="pa_1" id="pa_1" value="{{$data->pa_1}}" required="" type="text" class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="pa_2">7 days</label>
            <input  name="pa_2" id="pa_2" value="{{$data->pa_2}}" required="" type="text" class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="pa_3">15 days</label>
            <input  name="pa_3" id="pa_3" value="{{$data->pa_3}}" required="" type="text" class="form-control">
        </div>
    </div>
</div>

<div class="row justify-content-md-center">
    <div class="col-md-3">
        <label for="name">HIGHLIGHT ADS</label>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="ha_1">3 days</label>
            <input  name="ha_1" id="ha_1" value="{{$data->ha_1}}" required="" type="text" class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="ha_2">7 days</label>
            <input  name="ha_2" id="ha_2" value="{{$data->ha_2}}" required="" type="text" class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="ha_3">15 days</label>
            <input  name="ha_3" id="ha_3" value="{{$data->ha_3}}" required="" type="text" class="form-control">
        </div>
    </div>
</div>

<div class="row justify-content-md-center">
    <div class="col-md-3">
        <label for="name">FAST ADS</label>
    </div>
    <div class="col-md-5">
        <div class="form-group">
            <label for="fa_1">1 days</label>
            <input  name="fa_1" id="fa_1" value="{{$data->fa_1}}" required="" type="text" class="form-control">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="fa_2">3 days</label>
            <input  name="fa_2" id="fa_2" value="{{$data->fa_2}}" required="" type="text" class="form-control">
        </div>
    </div>
</div>

<div class="row justify-content-md-center">
    <div class="col-md-3">
        <label for="name">BANNER ADS</label>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="ba_1">3 days</label>
            <input  name="ba_1" id="ba_1" value="{{$data->ba_1}}" required="" type="text" class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="ba_2">7 days</label>
            <input  name="ba_2" id="ba_2" value="{{$data->ba_2}}" required="" type="text" class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="ba_3">15 days</label>
            <input  name="ba_3" id="ba_3" value="{{$data->ba_3}}" required="" type="text" class="form-control">
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label for="notes">Notes</label>
        <input  name="notes" id="notes" value="{{$data->notes}}" type="text" class="form-control">
    </div>
</div>

<div class="col-md-12 mb-12">

    <div class="form-group">
        <label class="switch-box">Status</label>
        <div  class="status-btn" >
            <div class="custom-control custom-switch">
                <input name="status" {{($data->status == 1) ?  'checked' : ''}}   type="checkbox" class="custom-control-input" id="status-edit">
                <label  class="custom-control-label" for="status-edit">Publish/UnPublish</label>
            </div>
        </div>
    </div>

</div>

