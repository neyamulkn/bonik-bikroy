@extends('layouts.frontend')
@section('title', 'Ads Post' )

@section('css')
<link href="{{asset('assets')}}/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
<style>.h-300 .dropify-wrapper {height: 300px !important;}.dropify-wrapper {height: 140px !important;}</style>

@endsection

@section('content')
<div class="container bg-white mb-2 p-3">
    <h3 class="border-bottom text-center pb-2 mb-3">Choose Your Ad Type</h3>
    <div class="d-flex justify-content-center align-items-center mb-3">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="post_type" value="sell" id="radioBox1" data-box="#box1" checked>
            <label class="form-check-label" for="radioBox1">Sell</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="post_type" value="link_ads" id="radioBox2" data-box="#box2">
            <label class="form-check-label" for="radioBox2">Link Ads</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="post_type" value="wanted" id="radioBox3" data-box="#box3">
            <label class="form-check-label" for="radioBox3">Wanted</label>
        </div>
    </div>
</div>
<div class="container bg-white mb-5 px-0">
    <div id="box1" class="box py-3" style="display: block;">
        <h3 class="border-bottom text-center pb-2 mb-3">Choose Your Post</h3>
        <form action="{{ route('post.create')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="post_type" value="sell">
        <div class="row">
            <div class="col-12 col-md-6">
                <label class="mb-2 w-100" for="pageDropdown">Select a category:</label>
                <select name="category" required class="form-control gb shadow-b borders" id="pageDropdown">
                    <option value="" selected disabled>Select an option</option>
                    @foreach($categories as $category)
                       	@if(count($category->get_subcategory)>0)
                            <optgroup label="{{$category->name}}">
                                @foreach($category->get_subcategory as $subcategory)
                                <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                                @endforeach
                            </optgroup>
                        @else
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endif
                    @endforeach
                    </select>
            </div>
            <div class="col-12 col-md-6">
                <label class="mb-2 w-100" for="">Select District</label>
                <select name="location" required class="form-control mb-2 gb shadow-b borders" id="">
                    <option value="" selected disabled>Select an option</option>
                    @foreach($regions as $region)
                        @if(count($region->get_city)>0)
                            <optgroup label="{{$region->name}}">
                                @foreach($region->get_city as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            </optgroup>
                        @else
                            <option value="{{ $region->id }}">{{$region->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>    
        <div class="row">
            <div class="col-12 col-md-4 h-300 py-2 pr-md-0">
                <input type="file" required data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M" accept="image/*" class=" dropify mt-2 shadow-b" name="feature_image">
            </div>
            <div class="col-12 col-md-8">
                <div class="row"> 
                    @for($i=1; $i<=8; $i++)
                    <div class="col-3 p-2"><input type="file" data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M" accept="image/*" class=" dropify mt-2 shadow-b" name="gallery_image[]"></div>
                    @endfor
                   
                </div>
            </div>
        </div>
        
        
        <div class="row">
            <div class="col-12">
                <button class="yb py-2 text-center bt bb2 rounded font-weight-bold mt-2 float-right px-5">Next</button>
            </div>
        </div>
        </form>
    </div>

    <div id="box2" class="box w-100 py-3" style="display: none;">
        <h3 class="border-bottom text-center pb-2 mb-3">Choose Your Banner</h3>
        <form action="{{ route('storeLinkPost')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="post_type" value="wanted">
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="row">
                    <div class="col-12 col-md-6 pl-md-0">
                        <label class="mb-2" for="">Type your banner link</label>
                        <input type="text" name="redirect_url" placeholder="link" class="mb-2 w-100 borders p-2 gb shadow-b rounded-3">
                    </div>
                    <div class="col-12 col-md-6 pr-md-0">
                        <label class="mb-2 w-60" for="">Select your banner Desktop</label>
                        <select name="position" class="form-control mb-2 gb shadow-b borders" id="">
                            <option value="" selected disabled>Select an option</option>
                            <option value="">Bannder 728x90</option>
                            <option value="">Bannder 160x600</option>
                            <option value="">Bannder 300x600</option>
                            <option value="">Bannder 300x300</option>
                        </select>
                    </div>
                </div>
                <label class="mb-2 w-100" for="">Upload your banner</label>
                <div class="h-300">
                    <input type="file" data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M"  class=" dropify mt-2 shadow-b" name="desktop_image">
                </div>
                
            </div>
            <div class="col-12 col-md-6">
                <label class="my-2 w-100" for="">Select your banner mobile</label>
                <select class="form-control mb-2 gb shadow-b borders" id="">
                    <option value="" selected disabled>Select an option</option>
                    <option value="">Bannder 728x90</option>
                    <option value="">Bannder 160x600</option>
                    <option value="">Bannder 300x600</option>
                    <option value="">Bannder 300x300</option>
                </select>
                <label class="mb-2 w-100" for="">Upload your banner</label>
                <div class="h-300">
                    <input type="file" data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M"  class=" dropify mt-2 shadow-b" name="photo">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <label class="mt-2" for="">Start date</label>
                <input type="date" placeholder="link" class="mt-2 w-100 borders p-2 gb shadow-b rounded-3">
                <label class="my-2" for="">End date</label>
                <input type="date" placeholder="link" class="mt-2 w-100 borders p-2 gb shadow-b rounded-3">
                
                <div class="w-100 ab px-2 py-3 borders my-3">
                    <div class="d-flex align-items-center justify-content-between border-bottom border-dark pb-1 mb-1">
                        <h4 class="">Calculate:</h4>
                        <p>(Per Day TK. 100)</p>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <p>Urgent Ad</p>
                        <p>3 Days</p>
                        <p>TK 100</p>
                    </div>
                    <div class="d-flex align-items-center justify-content-between border-top border-dark pt-1 mt-1">
                        <p>Total</p>
                        <b>TK. 1200</b>
                    </div>
                </div>
                <div>
                    <button class="yb py-2 text-center bt bb2 rounded font-weight-bold mt-2 float-right px-5">Post Ad</button>
                </div>
            </div>
        </div>
        </form>
    </div>

    <div id="box3" class="box w-100 py-3" style="display: none;">
        <form action="{{ route('storeWantedPost')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="post_type" value="wanted">
        <h3 class="border-bottom text-center pb-2 mb-3">Choose Your post request</h3>
        <div class="row">
            <div class="col-12 col-md-6">
                <label class="mb-2 w-100" for="">Select a category:</label>
                <select name="category" class="form-control gb shadow-b borders">
                    <option value="" selected disabled>Select an option</option>
                    @foreach($categories as $category)
                       	@if(count($category->get_subcategory)>0)
                        <optgroup label="{{$category->name}}">
                            @foreach($category->get_subcategory as $subcategory)
                            <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                            @endforeach
                        </optgroup>
                        @else
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-6">
                <label class="mb-2 w-100" for="">Select District</label>
                <select name="location" required class="form-control mb-2 gb shadow-b borders" id="">
                    <option value="" selected disabled>Select an option</option>
                    @foreach($regions as $region)
                        @if(count($region->get_city)>0)
                            <optgroup label="{{$region->name}}">
                                @foreach($region->get_city as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            </optgroup>
                        @else
                            <option value="{{ $region->id }}">{{$region->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <label class="mb-2 w-100" for="">Upload ad photo</label>
                <div class="h-300">
                    <input type="file" data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M"  class="dropify mt-2 borders shadow-b" name="feature_image">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <label class="mb-2" for="">Type ad title</label>
                <input type="text" name="title" placeholder="Title" class="w-100 borders p-2 gb shadow-b rounded-3">
                <label class="my-2" for="">Type ad description</label>
                <textarea name="description" required class="summernote form-control gb shadow-b borders" rows="5" maxlength="5000" placeholder="Describe your message"></textarea>
                <p>Max 5000 character</p>

                <h3 class="font-weight-normal mb-2">CONTACT DETAILS:</h3>
                
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text required">Name:</span>
                    </div>
                    <input type="text" required name="contact_name" value="{{(old('contact_name') ? old('contact_name') : Auth::user()->name )}}" class="form-control" placeholder="Your Name">
                </div>
                
                <div class="w-100">
                    <div class="form-group mb-2">
                        <label>Mobile Number</label>
                        <div id="mobileNumber">
                            @if(Auth::user()->mobile)
                            <div id="{{ Auth::user()->mobile }}" class="addNumber">
                                <input type="hidden" class="contact_mobile" name="contact_mobile[]" value="{{ Auth::user()->mobile }}">
                                <i class="fa fa-check-square"></i>
                                <strong>{{ Auth::user()->mobile }} </strong>
                                <a class="removeNumber" href="javascript:void(0)" onclick="removeNumber('{{ Auth::user()->mobile }}')" title="Remove phone number">✕</a>
                            </div>
                            
                            @endif
                        </div>
                        <span id="moreMobile">
                            @if(Auth::user()->mobile)
                                <a onclick="moreMobile()" href="javascript:void(0)">Add another mobile number</a>
                            @else
                            <div style="display:flex; margin-bottom: 10px;">
                                <div>
                                    Add mobile number
                                    <div style="position: relative;margin-right: 10px;width: 300px;">
                                        <input type="number" id="number" value="number" required name="contact_mobile" class="form-control" placeholder="Enter your number">
                                        <div class="adjust-field" onclick="addNumber()"> Add</div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </span>
                    </div>
                    <div>
                        <input id="contact_hidden" name="contact_hidden" type="checkbox" value="1">
                        <label for="contact_hidden">Hide mobile number(s)</label>
                    </div>
                </div>
                <div class="my-2">
                   <input id="conditions" required type="checkbox">
                   <label for="conditions">I have read and accept the <a href="#"> Terms and Conditions</a></label>
                </div>
                <button class="yb py-2 text-center bt bb2 rounded font-weight-bold mt-2 float-right px-5">Post Ad</button>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('assets')}}/node_modules/dropify/dist/js/dropify.min.js"></script>
<script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();

    });
</script>
<script>
  $(document).ready(function() {
    // Handle radio button change event
    $('input[type="radio"]').change(function() {
      var selectedBox = $(this).data('box');
      $(".box").hide(); // Hide all boxes
      $(selectedBox).show(); // Show the selected box
    });
  });
</script>

<script type="text/javascript">
    function moreMobile(number=null){

        $('#moreMobile').html(`
        <div style="display:flex; margin-bottom: 10px;">
        <div>
        Add mobile number
        <div style="position: relative;margin-right: 10px;width: 300px;">
        <input type="number" id="number" value="`+number+`" required name="contact_mobile" class="form-control" placeholder="Enter your number">
        <span class="adjust-field" onclick="addNumber()"> Add</span>
        </div>
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
                    $('#mobileNumber').append(data.number);
                    $('#moreMobile').html('<a onclick="moreMobile()" href="javascript:void(0)">Add another mobile number</a>')
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
</script>
@endsection