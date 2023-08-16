@extends('layouts.frontend')
@section('title', 'Package payment |'. Config::get('siteSetting.site_name') )
@section('css')
  <style type="text/css">
  	.tab-content{padding: 10px;background: #f1f2f4;margin-bottom: 10px;}
  	.nav-tabs{text-align: center;}
  	.nav-tabs li { width: initial;} .nav{flex-wrap: wrap;justify-content: left;}
  </style>
@endsection
@section('content')

<section class="inner-section">
    <div class="container">
        <div class="row">
        	<div class="col-md-2"></div>

        	<div class="col-md-8 col-xs-12" style="background: #fff;border-radius: 5px;padding-top: 15px;">
        		<h5>@if($package->package_id == 'post_fee')  Ad post fee  @else @if($package->get_boostAd) Promote Ad ({{$package->get_package->name}}) @else Package Details  @endif   @endif </h5>
	            <div style="background: #f1f2f4;" class="box-inner">
	                <div class="table-responsive checkout-product">
	                  <table  id="order_summary" class="table table-bordered table-hover">
	                    <thead>
	                      <tr>
	                        <th>@if($package->get_boostAd) Ad Title @else Package @endif</th>
	                        @if($package->get_package)<th>Ads</th>	                        
	                        <th>Duration</th>@endif
	                        <th>Price</th>
	                      </tr>
	                    </thead>
	                    <tbody style="background:#fff">
	                        <tr>
	                          <td>
                                @if($package->get_boostAd)<img src="{{asset('upload/images/product/thumb/'.$package->get_boostAd->feature_image)}}" width="50"> {{ $package->get_boostAd->title }} @else {{$package->get_package->name}} @endif
                            </td>
                            @if($package->get_package)
	                          <td>{{ $package->total_ads }} ads</td>
	                          
	                          <td>{{ $package->duration }} days </td>@endif
	                         <td >{{ config('siteSetting.currency_symble') }}{{ $postFee->price + $postFee->post_fee }}</td>
	                        </tr>
	                     
	                    </tbody>
	                    
	                  </table>
	                </div>
	              </div>
              <h5>Select Payment Method</h5>
      				<div style="background: #fff; padding-bottom: 0 10px 10px;">
      					
      					<div class="box-inner">          
               		<div id="process"></div>  
                  @if(Session::has('error'))
                    <div class="alert alert-danger">
                      {{Session::get('error')}}
                    </div>
                  @endif        
                  <ul class="nav nav-tabs">
                      @foreach($paymentgateways as $index => $method)
                        <li ><a @if($index == 0) class="active" @endif style="display:block;padding: 10px;background: #fff;" data-toggle="tab" href="#paymentgateway{{$method->id}}"><img @if($method->method_slug == 'shurjopay') width = "190" height="45" @else width="90" @endif src="{{asset('upload/images/payment/'.$method->method_logo)}}"></a></li>
                    
                      @endforeach
                  </ul>
                  <div class="tab-content">
                    @foreach($paymentgateways as $index => $method)

                      @if($method->is_default == 1)
                      <div id="paymentgateway{{$method->id}}" class="tab-pane fade @if($index == 0) active show @endif">
                          <form action="{{route('packagePurchasePayment', $package->order_id)}}" method="post" @if($method->method_slug == 'masterCard') class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{$method->public_key}}"  @endif >
                              @csrf
                              <input type="hidden"  name="payment_method" value="{{$method->method_slug}}">
                              
                              {!! $method->method_info !!}
                              
                              @if($method->method_slug == 'wallet-balance')
                                 Your wallet balance: {{ config('siteSetting.currency_symble').Auth::user()->wallet_balance }}
                              @endif

                              @if($method->method_slug == 'masterCard')
                                <div class="form-row">                                    
                                    <div id="card-element" style="width: 100%">
                                         <div class="display-td" >                            
                                            <img class="img-responsive pull-right" src="https://i76.imgup.net/accepted_c22e0.png">
                                          </div>
                                       
                                          <div class="row">
                                            <div class="col-lg-8 col-md-8">
                                            <div class='col-lg-12 col-md-12 col-xs-12 card '> <span class='control-label required'>Card Number</span> <input  autocomplete='off' placeholder='Enter card number' class='form-control card-number' required size='20' type='text'> </div> <div class='col-xs-3  cvc '> <span class='control-label required'>CVC</span> <input autocomplete='off' class='form-control card-cvc' maxlength="3" placeholder='ex. 311' required size='4' type='text'> </div> <div class='col-xs-4 expiration '> <span class='required control-label'>Month</span>  <input maxlength="2" required class='form-control card-expiry-month' placeholder='MM' size='2' type='text'> </div> <div class='col-xs-5 expiration '> <span class='control-label required'>Expiration Year</span> <input class='form-control card-expiry-year' placeholder='YYYY' required size='4' maxlength="4" type='text'> </div>
                                          </div>
                                        </div>
                  
                                        <div class='row'>
                                            <div class='col-md-12 error form-group hide'>
                                                <div style="padding: 5px;margin-top: 10px;" class='alert-danger alert'>Please correct the errors and try again.</div>
                                            </div>
                                        </div>          
                                    </div>
                                  <!-- Used to display Element errors. -->
                                  <div id="card-errors" role="alert"></div>
                                </div>
                              @endif
                            
                            <div class="text-right" >
                            @if($method->method_slug == 'wallet-balance')
                                @if(Auth::user()->wallet_balance >= $package->price)
                                  <button  class="btn payButton btn-success"><span><i class="fa fa-money" aria-hidden="true"></i> Pay with wallet balance </span></button>
                               
                                @else
                                 <button title="Insufficient wallet balance" disabled  class="btn btn-success"><span><i class="fa fa-money" aria-hidden="true"></i> Insufficient wallet balance </span></button>
                                @endif
                              @else
                                <button id="{{$method->method_slug}}"  class="btn btn-success payButton"><span><i class="fa fa-money" aria-hidden="true"></i> Pay with {{$method->method_name}}</span></button>
                              @endif
                              </div>
                          </form>
                      </div>
                      @else
                      <div id="paymentgateway{{$method->id}}" class="tab-pane fade @if($index == 0) active show @endif">
                        
                        {!! $method->method_info !!}
                        <form action="{{route('packagePurchasePayment', $package->order_id)}}" data-parsley-validate method="post">
                          @csrf
                          <strong style="color: green;">Pay with {{$method->method_name}}.</strong><br/>
                          <input type="hidden"  name="manual_method_name" value="{{$method->method_slug}}">
                          @if($method->method_slug != 'cash')
                          <strong>Payment Transaction Id</strong>
                          <p><input type="text" required data-parsley-required-message = "Transaction Id is required" placeholder="Enter Transaction Id" value="{{old('trnx_id')}}" class="form-control" name="trnx_id"></p>
                          @endif
                          <strong>Write Your {{$method->method_name}} Payment Information below.</strong>
                          <textarea required data-parsley-required-message = "Payment Information is required" name="payment_info" style="margin: 0;" rows="2" placeholder="Write Payment Information" class="form-control">{{old('payment_info')}}</textarea>

                          
                          <div class="text-right">
                              <button name="payment_method" value="manual" class="btn btn-success"><span><i class="fa fa-money" aria-hidden="true"></i> Pay {{$method->method_name}}</span></button>
                          </div>
                        </form>
                      </div>
                      @endif
                    @endforeach
                     
                  </div>
              	</div>
      				</div>
      			</div>
          
        </div>
    </div>
</section>
@endsection