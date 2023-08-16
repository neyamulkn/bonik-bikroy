@extends('layouts.frontend')
@section('title', 'Seller Verification')

@section('css')
<link href="{{asset('assets')}}/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<!-- Main Container  -->
<div class="container bg-white px-0">
    
    <h2 class="text-center py-3 border-bottom mb-3">MEMBERSHIP REGISTRATION</h2>
    
    <form action="{{ route('verifyAccount') }}" method="post" enctype="multipart/form-data" data-parsley-validate>
		@csrf
		<div class="row">
		    <div class="col-md-4 col-sm-12">
		        <label class="required">Your Photo</label>                         
				<input type="file" @if($user->owner_photo) data-default-file="{{asset('upload/users/'.$user->owner_photo)}}" @else required @endif data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M"  class="dropify" name="photo">
		    </div>
		    <div class="col-md-4 col-sm-12">
		        <div class="form-group">
					<label for="name" class="control-label required">Full Name</label>
					<input type="text" required class="form-control" id="name" placeholder="Full Name" value="{{ $user->name }}" name="name">
				</div>
				<div class="form-group">
					<label for="shop_name" class="control-label required">Organization name</label>
					<input type="text" required class="form-control" id="shop_name" placeholder="Organization name" value="{{ $user->shop_name }}" name="shop_name">
				</div>
		    </div>
		    <div class="col-md-4 col-sm-12">
		        <label for="mobile" class="control-label required w-100">Mobile Number</label>
				<div class="form-group" id="moreMobile" style="position: relative;">
					
					<input type="text" disabled class="form-control" id="mobile" placeholder="Enter Mobile" value="{{ $user->mobile }}" name="mobile">
					<span class="adjust-field">
                        <label onclick="moreMobile()"><small>Chnage Number</small></label>
                    </span>
				</div>
				<label for="input-email" class="control-label required w-100">E-Mail Address</label>
				<div class="form-group" id="moreEmail" style="position: relative;">
					
					<input type="email" disabled class="form-control" id="input-email" placeholder="E-Mail" value="{{ $user->email }}" name="email">
					<span class="adjust-field">
                        <label onclick="moreEmail()"><small>Chnage Email</small></label>
                    </span>
				</div>
		    </div>
		</div>
		
		<div class="row mt-2">
		    <div class="col-md-6 col-sm-12">
				<div class="form-group mb-1">
					<span class="required mb-2 d-block">About your shop</span>
					<textarea required class="form-control" id="address" placeholder="For example: #road:2, #sector: 3, Dhaka-1215" name="address">{{ $user->address }}</textarea>
				</div>
				<div class="form-group mb-0">
					<span class="required mb-2 d-block">Business address</span>
					<textarea required class="form-control" id="address" placeholder="For example: #road:2, #sector: 3, Dhaka-1215" name="address">{{ $user->address }}</textarea>
				</div>
			</div>
			<div class="col-md-6 col-sm-12">
			    <label class="required mb-2">SHOP OPEN AND CLOSE TIME</label>
			    <div class="d-flex align-items-center">
			        <input type="text" class="form-control" id="name" placeholder="OPEN">
			        <p class="py-2 px-4">TO</p>
			        <input type="text" class="form-control" id="name" placeholder="OPEN">
			    </div>
			    <div class="d-flex flex-wrap py-2 gap">
                    <div class="d-flex align-items-center pr-2">
                        <input type="checkbox" name="SAT" id="SAT">
                        <label class="iy" for="SAT">SAT</label>
                    </div>
                    <div class="d-flex align-items-center pr-2">
                        <input type="checkbox" name="SUN" id="SUN">
                        <label class="iy" for="SUN">SUN</label>
                    </div>
                    <div class="d-flex align-items-center pr-2">
                        <input type="checkbox" name="MON" id="MON">
                        <label class="iy" for="MON">MON</label>
                    </div>
                    <div class="d-flex align-items-center pr-2">
                        <input type="checkbox" name="TUE" id="TUE">
                        <label class="iy" for="TUE">TUE</label>
                    </div>
                    <div class="d-flex align-items-center pr-2">
                        <input type="checkbox" name="WED" id="WED">
                        <label class="iy" for="WED">WED</label>
                    </div>
                    <div class="d-flex align-items-center pr-2">
                        <input type="checkbox" name="THU" id="THU">
                        <label class="iy" for="THU">THU</label>
                    </div>
                    <div class="d-flex align-items-center pr-2">
                        <input type="checkbox" name="FRI" id="FRI">
                        <label class="iy" for="FRI">FRI</label>
                    </div>
                </div>
			</div>
		</div>
		
		<div class="row mt-2">
            <div class="col-md-6 col-sm-12 mb-2">
                <div class="row">
                    <div class="col-6 col-md-6 pl-0 pr-1">
    				    <label class="required mb-2">NID Front Side</label>
    				    <input type="file" @if($user->nid_front) data-default-file="{{asset('upload/users/'.$user->nid_front)}}" @else required @endif data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M"  class="dropify" name="nid_front" >
    				</div>
    				<div class="col-6 col-md-6 pr-0 pl-1">
    				    <label class="required mb-2">NID Back Side</label>                         
    				    <input type="file" @if($user->nid_back) data-default-file="{{asset('upload/users/'.$user->nid_back)}}" @else required @endif data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M"  class="dropify" name="nid_back"  >
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-12 mb-2">
				<label class="required mb-2">Upload Trade License</label>   
				<div class="d-flex gap">
				    <input type="file" @if($user->trade_license) data-default-file="{{asset('upload/users/'.$user->trade_license)}}" @else required @endif data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M" class="dropify mr-1" name="trade_license" >
				    <input type="file" @if($user->trade_license2) data-default-file="{{asset('upload/users/'.$user->trade_license2)}}" @endif data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M" class="dropify" name="trade_license2">
				    <input type="file" @if($user->trade_license3) data-default-file="{{asset('upload/users/'.$user->trade_license3)}}" @endif data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M" class="dropify ml-1" name="trade_license3">
				</div>
            </div>
            
			<div class="col-md-4 col-sm-12">
			    <div class="form-group ">
    				<span class="required">Select Membership</span>
    				<select required class="form-control">
    					<option value="">Please Select</option>
    					<option> 123 </option>
    				</select>
    			</div>
			</div>
			<div class="col-6 col-md-4">
    			<div class="form-group ">
    				<span class="required">Select Your Region</span>
    				<select name="region" onchange="get_city(this.value)" required id="input-payment-country" class="form-control">
    					<option value=""> Please Select  </option>
    					@foreach($states as $state)
    					<option @if($user->region == $state->id) selected @endif value="{{$state->id}}"> {{$state->name}} </option>
    					@endforeach
    				</select>
    			</div>
			</div>
			<div class="col-6 col-md-4">
				<div class="form-group">
					<span class="required">City</span>
					<select name="city" onchange="get_area(this.value)"  required id="show_city" class="form-control">
						
						<option value="">Please Select</option>
						@foreach($cities as $city)
						<option @if($user->city == $city->id) selected @endif value="{{$city->id}}"> {{$city->name}} </option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		<div class="buttons clearfix">
			
			<div class="pull-right">
				<input type="submit" class="btn btn-md btn-primary" value="Verify Account">
			</div>
			
		</div>
	</form>
	@if($user->verify)
	    <h3 class="text-center py-3 mb-4">Your account allready verified.</h3>
	@else
	@endif
</div>
@endsection

@section('js')
<script src="{{ asset('js/parsley.min.js') }}"></script>
    <script src="{{asset('assets')}}/node_modules/dropify/dist/js/dropify.min.js"></script>
    <script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();

    });
</script>
<script type="text/javascript">

	    function moreMobile(number=null){
       
        $('#moreMobile').html(`
        <div style="display:flex; margin-bottom: 10px;">
        
        <div style="position: relative;width: 100%;">
        <input type="number" id="number" value="`+number+`" required name="contact_mobile" class="form-control" placeholder="Enter your number">
        <span class="adjust-field" onclick="addNumber()"> Add</span>
       
        </div>
        </div>`);
    }

    function addNumber(){
       var number = $('#number').val();
        if(number){
        $.ajax({
            url:"{{route('addNumber')}}",
            method:'get',
            data:{number:number},
            success:function(data){
                $('#moreMobile').html(data);
            }
        });
        }
    }

    function verifyNumber(number){

       var otp = $('#otp').val();
        if(otp){
        $.ajax({
            url:"{{route('verifyNumber')}}",
            method:'get',
            data:{otp:otp,number:number},
            success:function(data){
                if(data.status){
                    $('#moreMobile').html(data.number);
                    
                }else{
                    $('#optmsg').html('<span style="color:red">Invalid otp code.</span>')
                }
            }
        });
        }else{
            $('#optmsg').html('<span style="color:red">Please enter otp</span>')
        }
    }

    function removeNumber(number) {
       $('#'+number).remove();
       if($('.contact_mobile').val() == null){
            moreMobile();
       }
    }


     function moreEmail(email=''){
       
        $('#moreEmail').html(`
        <div style="display:flex; margin-bottom: 10px;">
        
        <div style="position: relative;width: 100%;">
        <input type="email" id="email" value="`+email+`" required name="email" class="form-control" placeholder="Enter your email">
        <span class="adjust-field" onclick="addEmail()"> Add</span>
       
        </div>
        </div>`);
    }

    function addEmail(){
       var email = $('#email').val();
        if(email){
        $.ajax({
            url:"{{route('addEmail')}}",
            method:'get',
            data:{email:email},
            success:function(data){
                $('#moreEmail').html(data);
            }
        });
        }
    }

    function verifyEmail(email){

       var code = $('#code').val();
        if(code){
        $.ajax({
            url:"{{route('verifyEmail')}}",
            method:'get',
            data:{code:code,email:email},
            success:function(data){
                if(data.status){
                    $('#moreEmail').html(data.email);
                    
                }else{
                    $('#codemsg').html('<span style="color:red">Invalid verify code.</span>')
                }
            }
        });
        }else{
            $('#codemsg').html('<span style="color:red">Please enter verify code</span>')
        }
    }

    function removeEmail(email) {
       $('#'+email).remove();
       if($('.contact_email').val() == null){
            moreEmail();
       }
    }

	 function get_city(id, type=''){
       
        var  url = '{{route("get_city", ":id")}}';
        url = url.replace(':id',id);
        $.ajax({
            url:url,
            method:"get",
            success:function(data){
                if(data){
                    $("#show_city"+type).html(data);
                    $("#show_city"+type).focus();
                }else{
                    $("#show_city"+type).html('<option>City not found</option>');
                }
            }
        });
    }  	 

    function get_area(id, type=''){
           
        var  url = '{{route("get_area", ":id")}}';
        url = url.replace(':id',id);
        $.ajax({
            url:url,
            method:"get",
            success:function(data){
                if(data){
                    $("#show_area"+type).html(data);
                    $("#show_area"+type).focus();
                }else{
                    $("#show_area"+type).html('<option>Area not found</option>');
                }
            }
        });
    }  
</script>
@endsection