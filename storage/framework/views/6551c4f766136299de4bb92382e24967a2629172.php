
<?php $__env->startSection('title', 'Seller Verification'); ?>

<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('assets')); ?>/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .payment-option ul li .checked {
  position: absolute;
  top: 0;
  left: 0;
  width: 30px;
  height: 30px;
  background: #6c2eb9;
  -webkit-clip-path: polygon(0 0, 0% 100%, 100% 0);
          clip-path: polygon(0 0, 0% 100%, 100% 0);
  opacity: 0;
}
.payment-option ul li .active .checked {
  opacity: 1;
}
.payment-option ul li .checked i{ font-size: 12px; color: white;
  margin-left: -10px;margin-top: -5px}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Main Container  -->
<div class="container bg-white px-0">
    

    <h2 class="text-center py-3 border-bottom mb-3"><?php if($user->sellerVerify): ?> MEMBERSHIP PLAN <?php else: ?> MEMBERSHIP REGISTRATION <?php endif; ?></h2>
    
    <?php if(!$user->sellerVerify || ($user->sellerVerify && $user->sellerVerify->status == "reject")): ?>
        <form action="<?php echo e(route('verifyAccount')); ?>" method="post" enctype="multipart/form-data" data-parsley-validate>
        <?php echo csrf_field(); ?>
        <?php if($user->sellerVerify && $user->sellerVerify->status == "reject"): ?>
        <div style="padding: 10px;display: inline-block;background: #fff1f1;width: 100%;">
        <h3>Verified request reject.</h3>
        <p><strong>Reject reason: </strong><?php echo e($user->sellerVerify->reject_reason); ?></p> </div> 
        <?php endif; ?>
		<div class="row">
		    <div class="col-md-4 col-sm-12">
		        <label class="required">Your Photo</label>                         
				<input type="file" <?php if($user->sellerVerify &&  $user->sellerVerify->owner_photo): ?> data-default-file="<?php echo e(asset('upload/users/'.$user->sellerVerify->owner_photo)); ?>" <?php else: ?> required <?php endif; ?> data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M"  class="dropify" name="photo">
		    </div>
		    <div class="col-md-4 col-sm-12">
		        <div class="form-group">
					<label for="name" class="control-label required">Full Name</label>
					<input type="text" required class="form-control" id="name" placeholder="Full Name" value="<?php if($user->sellerVerify): ?> <?php echo e($user->sellerVerify->name); ?> <?php endif; ?>" name="name">
				</div>
				<div class="form-group">
					<label for="shop_name" class="control-label required">Organization name</label>
					<input type="text" required class="form-control" id="shop_name" placeholder="Organization name" value="<?php if($user->sellerVerify): ?><?php echo e($user->sellerVerify->shop_name); ?><?php endif; ?>" name="shop_name">
				</div>
		    </div>
		    <div class="col-md-4 col-sm-12">
		        <label for="mobile" class="control-label required w-100">Mobile Number</label>
				<div class="form-group" id="moreMobile" style="position: relative;">
					
					<input type="text" class="form-control" id="mobile" placeholder="Enter Mobile" value="<?php if($user->sellerVerify): ?> <?php echo e($user->sellerVerify->mobile); ?> <?php endif; ?>" name="mobile">
                    
				</div>
				<label for="input-email" class="control-label required w-100">E-Mail Address</label>
				<div class="form-group" id="moreEmail" style="position: relative;">
					
					<input type="email" class="form-control" id="input-email" placeholder="E-Mail" value="<?php if($user->sellerVerify): ?><?php echo e($user->sellerVerify->email); ?> <?php endif; ?>" name="email">
                   
				</div>
		    </div>
		</div>
		
		<div class="row mt-2">
		    
			<div class="col-md-6 col-sm-12">
			    <label class="required mb-2">SHOP OPEN AND CLOSE TIME</label>
			    <div class="d-flex align-items-center">
			        <input type="time" class="form-control" value="<?php if($user->sellerVerify): ?><?php echo e($user->sellerVerify->open_time); ?><?php endif; ?>" name="open_time" id="name" placeholder="OPEN">
			        <p class="py-2 px-4">TO</p>
			        <input type="time" class="form-control" value="<?php if($user->sellerVerify): ?><?php echo e($user->sellerVerify->close_time); ?><?php endif; ?>" name="closed_time" id="name" placeholder="OPEN">
			    </div>
			</div>
            <div class="col-6 col-md-6">
                <label class="required">Shop Open Days</label>
                <div class="d-flex flex-wrap py-2 gap">
                    <div class="d-flex align-items-center ">
                        <input type="checkbox" name="open_days[]" <?php if($user->sellerVerify && in_array("SAT", json_decode($user->sellerVerify->open_days) )): ?> checked <?php endif; ?> value="SAT" id="SAT">
                        <label class="iy" for="SAT">SAT</label>
                    </div>
                    <div class="d-flex align-items-center ">
                        <input type="checkbox" name="open_days[]" <?php if($user->sellerVerify && in_array("SUN", json_decode($user->sellerVerify->open_days) )): ?> checked <?php endif; ?> value="SUN" id="SUN">
                        <label class="iy" for="SUN">SUN</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <input type="checkbox" name="open_days[]" <?php if($user->sellerVerify && in_array("MON", json_decode($user->sellerVerify->open_days) )): ?> checked <?php endif; ?> value="MON" id="MON">
                        <label class="iy" for="MON">MON</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <input type="checkbox" name="open_days[]" <?php if($user->sellerVerify && in_array("TUE", json_decode($user->sellerVerify->open_days) )): ?> checked <?php endif; ?> value="TUE" id="TUE">
                        <label class="iy" for="TUE">TUE</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <input type="checkbox" name="open_days[]" <?php if($user->sellerVerify && in_array("WED", json_decode($user->sellerVerify->open_days) )): ?> checked <?php endif; ?> value="WED" id="WED">
                        <label class="iy" for="WED">WED</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <input type="checkbox" name="open_days[]" <?php if($user->sellerVerify && in_array("THU", json_decode($user->sellerVerify->open_days) )): ?> checked <?php endif; ?> value="THU" id="THU">
                        <label class="iy" for="THU">THU</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <input type="checkbox" name="open_days[]" <?php if($user->sellerVerify && in_array("FRI", json_decode($user->sellerVerify->open_days) )): ?> checked <?php endif; ?> value="FRI" id="FRI">
                        <label class="iy" for="FRI">FRI</label>
                    </div>
                </div>
            </div>
            

            <div class="col-md-6 col-sm-12">
                <div class="form-group mb-1">
                    <span class="required mb-2 d-block">About your shop</span>
                    <textarea required class="form-control" id="address" placeholder="For example: #road:2, #sector: 3, Dhaka-1215" name="shop_about"><?php if($user->sellerVerify): ?> <?php echo e($user->sellerVerify->shop_about); ?> <?php endif; ?></textarea>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group mb-0">
                    <span class="required mb-2 d-block">Business address</span>
                    <textarea required class="form-control" id="address" placeholder="For example: #road:2, #sector: 3, Dhaka-1215" name="address"><?php if($user->sellerVerify): ?> <?php echo e($user->sellerVerify->address); ?> <?php endif; ?></textarea>
                </div>
            </div>
		</div>
		
		<div class="row mt-2">
            <div class="col-md-6 col-sm-12 mb-2">
                <div class="row">
                    <div class="col-6 col-md-6 pl-0 pr-1">
    				    <label class="required mb-2">NID Front Side</label>
    				    <input type="file" <?php if($user->sellerVerify && $user->sellerVerify->nid_front): ?> data-default-file="<?php echo e(asset('upload/users/'.$user->sellerVerify->nid_front)); ?>" <?php else: ?> required <?php endif; ?> data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M"  class="dropify" name="nid_front" >
    				</div>
    				<div class="col-6 col-md-6 pr-0 pl-1">
    				    <label class="required mb-2">NID Back Side</label>                         
    				    <input type="file" <?php if($user->sellerVerify && $user->sellerVerify->nid_back): ?> data-default-file="<?php echo e(asset('upload/users/'.$user->sellerVerify->nid_back)); ?>" <?php else: ?> required <?php endif; ?> data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M"  class="dropify" name="nid_back"  >
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-12 mb-2">
				<label class="required mb-2">Upload Trade License</label>   
				<div class="d-flex gap">
				    <input type="file" <?php if($user->sellerVerify): ?> data-default-file="<?php echo e(asset('upload/users/'.$user->sellerVerify->trade_license)); ?>" <?php else: ?> required <?php endif; ?> data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M" class="dropify mr-1" name="trade_license" >
				    <input type="file" <?php if($user->sellerVerify): ?> data-default-file="<?php echo e(asset('upload/users/'.$user->sellerVerify->trade_license2)); ?>" <?php endif; ?> data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M" class="dropify" name="trade_license2">
				    <input type="file" <?php if($user->sellerVerify): ?> data-default-file="<?php echo e(asset('upload/users/'.$user->sellerVerify->trade_license3)); ?>" <?php endif; ?> data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M" class="dropify ml-1" name="trade_license3">
				</div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-6 col-md-3">
                <div class="form-group ">
                    <span class="required">Select Your Region</span>
                    <select name="region" onchange="get_city(this.value)" required id="input-payment-country" class="form-control">
                        <option value=""> Please Select  </option>
                        <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php if($user->sellerVerify && $user->sellerVerify->region == $state->id): ?> selected <?php endif; ?> value="<?php echo e($state->id); ?>"> <?php echo e($state->name); ?> </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="form-group">
                    <span class="required">City</span>
                    <select name="city" onchange="get_area(this.value)"  required id="show_city" class="form-control">
                        
                        <option value="">Please Select</option>
                        <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php if($user->sellerVerify && $user->sellerVerify->city == $city->id): ?> selected <?php endif; ?> value="<?php echo e($city->id); ?>"> <?php echo e($city->name); ?> </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group ">
                    <span class="required">Select Membership</span>
                    <select name="membership" id="membershipPlan" required class="form-control">
                        <option value="" selected disabled>Please Select</option>
                        <?php $__currentLoopData = $memberships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membership): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php if($user->sellerVerify && $user->sellerVerify->membership == $membership->slug): ?> selected <?php endif; ?> value="<?php echo e($membership->slug); ?>"> <?php echo e($membership->name); ?> </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <!-- check first month membership -->
                <?php if($user->membership && $user->verify): ?>
                <div class=" w-100 ab px-2 py-3 borders my-3">
                    <div class="d-flex align-items-center justify-content-between border-bottom border-dark pb-1 mb-1">
                        <h4 class="">Membership Details:</h4>
                    </div>
                    <div class="d-flex align-items-center justify-content-between fir" id="membershipType">
                        <p><?php if($user->sellerVerify): ?> <?php echo e(ucwords($user->sellerVerify->membership)); ?> Bonik <?php else: ?> Membership <?php endif; ?></p>
                        <p>
                        <select required name="membershipDuration" id="membershipDuration" class="form-control">
                            <option value="">Select duration</option>
                        </select></p>
                    </div>
                    <div class="d-flex align-items-center justify-content-between border-top border-dark pt-1 mt-1">
                        <p>Total Amount</p>
                        <input type="hidden" name="total_price" id="total_price" value="0">
                        <b>TK. <span class="total">0</span></b>
                    </div>
                </div>
                <div class="payment-option"> 
                  <ul class="nav nav-tabs">
                      <?php $__currentLoopData = $paymentgateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <li>
                            <input required type="radio" <?php if($index == 0): ?> checked <?php endif; ?> name="payment_method" id="payment_method<?php echo e($method->id); ?>" value="<?php echo e($method->method_slug); ?>"> 
                            <a onclick="paymentMethod(<?php echo e($method->id); ?>)" <?php if($index == 0): ?> class="active" <?php endif; ?> style="border: 1px solid #6c2eb9;border-radius: 5px; display:block;padding:5px;margin-bottom: 8px;position: relative; margin-right: 15px;text-align: center;" data-toggle="tab" href="#paymentgateway<?php echo e($method->id); ?>"><div class="checked"><i class="fa fa-check"></i></div> <img  width="50"  src="<?php echo e(asset('upload/images/payment/'.$method->method_logo)); ?>"></a></li>
                    
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                  <div class="tab-content">
                    <?php $__currentLoopData = $paymentgateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                      <?php if($method->is_default == 1): ?>
                      <div id="paymentgateway<?php echo e($method->id); ?>" class="tab-pane fade <?php if($index == 0): ?> active show <?php endif; ?>">
                        
                              <?php echo $method->method_info; ?>

                              
                             
                      </div>
                      <?php else: ?>
                      <div id="paymentgateway<?php echo e($method->id); ?>" class="tab-pane fade <?php if($index == 0): ?> active show <?php endif; ?>">
                        
                        <?php echo $method->method_info; ?>

                          <strong style="color: green;">Pay with <?php echo e($method->method_name); ?>.</strong><br/>
                          <?php if($method->method_slug != 'cash'): ?>
                          <strong>Payment Transaction Id</strong>
                          <p><input type="text" data-parsley-required-message = "Transaction Id is required" placeholder="Enter Transaction Id" value="<?php echo e(old('trnx_id')); ?>" class="form-control" name="trnx_id"></p>
                          <?php endif; ?>
                          <strong>Write Your <?php echo e($method->method_name); ?> Payment Information below.</strong>
                          <textarea data-parsley-required-message = "Payment Information is required" name="payment_info" style="margin: 0;" rows="2" placeholder="Write Payment Information" class="form-control"><?php echo e(old('payment_info')); ?></textarea>
                        
                      </div>
                      <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     
                  </div>
                </div>
                <?php endif; ?>
            </div>
           
            <div style="text-align: right;margin: 10px;" class="col-12">
                <div class="pull-right">
                    <input type="submit" class="btn btn-md btn-primary" value="Verify Account">
                </div>
            </div>
        </div>
        </form>
    <?php elseif($user->sellerVerify && $user->sellerVerify->status == "pending"): ?>
        <?php if(Session::has('success')): ?>
        <div style="margin: 10px;" class="alert alert-success">
          <strong>Success! </strong> <?php echo e(Session::get('success')); ?>

        </div>
        <?php else: ?>
        <h3 style="padding: 10px; text-align: center;">Verification request already send. <br> <small>Your verify request under review.</small></h3>
        <?php endif; ?>
        
    <?php else: ?>
    <!-- //update membership plan or renew -->
    <form action="<?php echo e(route('membershipRequest')); ?>" method="post" data-parsley-validate>
        <?php echo csrf_field(); ?>
        <?php if(Session::has('success')): ?>
        <div style="margin: 10px;" class="alert alert-success">
          <strong>Success! </strong> <?php echo e(Session::get('success')); ?>

        </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-12 col-md-3"></div>
            <div class="col-12 col-md-6">

                <div class="form-group ">
                    <span class="required">Select Membership</span>
                    <select name="membership" id="membershipPlan" required class="form-control">
                        <option value="" selected disabled>Please Select</option>
                        <?php $__currentLoopData = $memberships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membership): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($membership->slug); ?>"> <?php echo e($membership->name); ?> </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
               
                <div class=" w-100 ab px-2 py-3 borders my-3">
                    <div class="d-flex align-items-center justify-content-between border-bottom border-dark pb-1 mb-1">
                        <h4 class="">Membership Details:</h4>
                    </div>
                    <div class="d-flex align-items-center justify-content-between fir" id="membershipType">
                        <p> Membership </p>
                        <p>
                        <select required name="membershipDuration" id="membershipDuration" class="form-control">
                            <option value="">Select Duration</option>
                        </select></p>
                    </div>
                    <div class="d-flex align-items-center justify-content-between border-top border-dark pt-1 mt-1">
                        <p>Total Amount</p>
                        <input type="hidden" name="total_price" id="total_price" value="0">
                        <b>TK. <span class="total">0</span></b>
                    </div>
                </div>
                <div class="payment-option"> 
                    Select Payment Method
                  <ul class="nav nav-tabs">
                      <?php $__currentLoopData = $paymentgateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <li>
                            <input required type="radio" <?php if($index == 0): ?> checked <?php endif; ?> name="payment_method" id="payment_method<?php echo e($method->id); ?>" value="<?php echo e($method->method_slug); ?>"> 
                            <a onclick="paymentMethod(<?php echo e($method->id); ?>)" <?php if($index == 0): ?> class="active" <?php endif; ?> style="border: 1px solid #6c2eb9;border-radius: 5px; display:block;padding:5px;margin-bottom: 8px;position: relative; margin-right: 15px;text-align: center;" data-toggle="tab" href="#paymentgateway<?php echo e($method->id); ?>"><div class="checked"><i class="fa fa-check"></i></div> <img  width="50"  src="<?php echo e(asset('upload/images/payment/'.$method->method_logo)); ?>"></a></li>
                    
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                  <div class="tab-content">
                    <?php $__currentLoopData = $paymentgateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                      <?php if($method->is_default == 1): ?>
                      <div id="paymentgateway<?php echo e($method->id); ?>" class="tab-pane fade <?php if($index == 0): ?> active show <?php endif; ?>">
                        
                        <?php echo $method->method_info; ?>

                              
                      </div>
                      <?php else: ?>
                      <div id="paymentgateway<?php echo e($method->id); ?>" class="tab-pane fade <?php if($index == 0): ?> active show <?php endif; ?>">
                        
                            <?php echo $method->method_info; ?>

                          <strong style="color: green;">Pay with <?php echo e($method->method_name); ?>.</strong><br/>
                          <?php if($method->method_slug != 'cash'): ?>
                          <strong>Payment Transaction Id</strong>
                          <p><input type="text" data-parsley-required-message = "Transaction Id is required" placeholder="Enter Transaction Id" value="<?php echo e(old('trnx_id')); ?>" class="form-control" name="trnx_id"></p>
                          <?php endif; ?>
                          <strong>Write Your <?php echo e($method->method_name); ?> Payment Information below.</strong>
                          <textarea data-parsley-required-message = "Payment Information is required" name="payment_info" style="margin: 0;" rows="2" placeholder="Write Payment Information" class="form-control"><?php echo e(old('payment_info')); ?></textarea>
                        
                      </div>
                      <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     
                  </div>
                </div>
                
                <div style="text-align: right;margin: 10px;" class="buttons clearfix">
                <div class="pull-right">
                    <input type="submit" class="btn btn-md btn-primary" value="Membership Request">
                </div>
                </div>
            </div>
    	</div>
    </form>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('js/parsley.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/dropify/dist/js/dropify.min.js"></script>
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
            url:"<?php echo e(route('addNumber')); ?>",
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
            url:"<?php echo e(route('verifyNumber')); ?>",
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
            url:"<?php echo e(route('addEmail')); ?>",
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
            url:"<?php echo e(route('verifyEmail')); ?>",
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
       
        var  url = '<?php echo e(route("get_city", ":id")); ?>';
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
           
        var  url = '<?php echo e(route("get_area", ":id")); ?>';
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

    function paymentMethod(id){
        $("#payment_method"+id).click();   
    }


    $(document).on("change", "#membershipPlan", function(){
       
        var membershipName = $("#membershipPlan :selected").val();

        var output = '';
        <?php $__currentLoopData = $memberships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membership): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            if(membershipName == "<?php echo e($membership->slug); ?>"){
                output = `<p><?php echo e($membership->name); ?></p>
                        <p>
                        <select name="membershipDuration" id="membershipDuration" class="form-control">
                            <option value="" selected disabled>Select duration</option>
                            <?php $__currentLoopData = $membership->membershipDurations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membershipDuration): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option data-price="<?php echo e($membershipDuration->price); ?>" value="<?php echo e($membershipDuration->id); ?>"><?php echo e($membershipDuration->duration ." ". $membershipDuration->type); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select></p>
                    </div>
                    `;
            }

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        $("#membershipType").html(output);
        $(".total").html(0);
        $("#total_price").val(0);
    });

    $(document).on("change", "#membershipDuration", function(){    
        var price = $("#membershipDuration :selected").data("price");
        if(price > 0){
            $("#total_price").val(price);
            $(".total").html(price);
        }else{
            $(".total").html("Membership free");
            $("#total_price").val(0);
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bonik\resources\views/users/seller-verify.blade.php ENDPATH**/ ?>