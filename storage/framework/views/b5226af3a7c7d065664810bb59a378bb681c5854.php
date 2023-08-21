
<?php $__env->startSection('title', 'Ads Post' ); ?>

<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('assets')); ?>/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
<style>.h-300 .dropify-wrapper {height: 300px !important;}.dropify-wrapper {height: 140px !important;}

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
<div class="container bg-white mb-2 p-3">
    <h3 class="border-bottom text-center pb-2 mb-3">Choose Your Ad Type</h3>
    <div class="d-flex justify-content-center align-items-center mb-3 post_type">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="post_type" value="sell" id="radioBox1" data-box="#box1" checked>
            <label class="form-check-label" for="radioBox1">Sell</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="post_type" value="link_ad" id="radioBox2" data-box="#box2">
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
        <form action="<?php echo e(route('post.create')); ?>" data-parsley-validate method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="post_type" value="sell">
        <div class="row">
            <div class="col-12 col-md-6">
                <label class="mb-2 w-100" for="pageDropdown">Select a category:</label>
                <select name="category" required class="form-control gb shadow-b borders" id="pageDropdown">
                    <option value="" selected disabled>Select an option</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       	<?php if(count($category->get_subcategory)>0): ?>
                            <optgroup label="<?php echo e($category->name); ?>">
                                <?php $__currentLoopData = $category->get_subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($subcategory->id); ?>"><?php echo e($subcategory->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </optgroup>
                        <?php else: ?>
                            <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
            </div>
            <div class="col-12 col-md-6">
                <label class="mb-2 w-100" for="">Select District</label>
                <select name="location" required class="form-control mb-2 gb shadow-b borders" id="">
                    <option value="" selected disabled>Select an option</option>
                    <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(count($region->get_city)>0): ?>
                            <optgroup label="<?php echo e($region->name); ?>">
                                <?php $__currentLoopData = $region->get_city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($city->id); ?>"><?php echo e($city->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </optgroup>
                        <?php else: ?>
                            <option value="<?php echo e($region->id); ?>"><?php echo e($region->name); ?></option>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>    
        <div class="row">
            <div class="col-12 col-md-4 h-300 py-2 pr-md-0">
                <input type="file" required data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M" accept="image/*" class=" dropify mt-2 shadow-b" name="feature_image">
            </div>
            <div class="col-12 col-md-8">
                <div class="row"> 
                    <?php for($i=1; $i<=8; $i++): ?>
                    <div class="col-3 p-2"><input type="file" data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M" accept="image/*" class=" dropify mt-2 shadow-b" name="gallery_image[]"></div>
                    <?php endfor; ?>
                   
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
        <form action="<?php echo e(route('storeLinkAd')); ?>" data-parsley-validate method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="post_type" value="link_ad">
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="row">
                    <div class="col-12 col-md-6 pl-md-0">
                        <label class="mb-2" for="">Type your banner link</label>
                        <input type="text" required name="redirect_url" placeholder="link" class="mb-2 w-100 borders p-2 gb shadow-b rounded-3">
                    </div>
                    <div class="col-12 col-md-6 pr-md-0">
                        <label class="mb-2 w-60" for="">Select your banner Desktop</label>
                       <select name="position" required="required" id="position" class="form-control custom-select">
                        <option value="" selected disabled>Select an option</option>
                            <option value="top-content" <?php echo e((old('position') == 'top-content') ? 'selected' : ''); ?>>Top Of the Content</option>
                            <option value="middle-content" <?php echo e((old('position') =='middle-content') ? 'selected' : ''); ?>>Middle Of the Content</option>
                            <option value="bottom-content" <?php echo e((old('position') =='bottom-content') ? 'selected' : ''); ?>>Bottom Of the Content</option>
                            <option value="sidebar-top" <?php echo e((old('position') =='sidebar-top') ? 'selected' : ''); ?>>Sidebar Top </option>
                           <option value="sidebar-middle" <?php echo e((old('position') =='sidebar-middle') ? 'selected' : ''); ?>>Sidebar Middle </option>

                           <option value="sidebar-bottom" <?php echo e((old('position') =='sidebar-middle') ? 'selected' : ''); ?>>Sidebar Bottom </option>
                          
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
                <select name="mobile_position" class="form-control mb-2 gb shadow-b borders" id="">
                    <option value="" selected disabled>Select an option</option>
                   <option value="top-content" <?php echo e((old('position') == 'top-content') ? 'selected' : ''); ?>>Top Of the Content</option>
                    <option value="middle-content" <?php echo e((old('position') =='middle-content') ? 'selected' : ''); ?>>Middle Of the Content</option>
                    <option value="bottom-content" <?php echo e((old('position') =='bottom-content') ? 'selected' : ''); ?>>Bottom Of the Content</option>
                    <option value="sidebar-top" <?php echo e((old('position') =='sidebar-top') ? 'selected' : ''); ?>>Sidebar Top </option>
                   <option value="sidebar-middle" <?php echo e((old('position') =='sidebar-middle') ? 'selected' : ''); ?>>Sidebar Middle </option>

                   <option value="sidebar-bottom" <?php echo e((old('position') =='sidebar-middle') ? 'selected' : ''); ?>>Sidebar Bottom </option>
                </select>
                <label class="mb-2 w-100" for="">Upload your banner</label>
                <div class="h-300">
                    <input type="file" data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M"  class=" dropify mt-2 shadow-b" name="mobile_image">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <label class="mt-2" for="">Start date</label>
                <input type="date" required min="<?php echo e(date('Y-m-d')); ?>" name="start_date" id="start_date" placeholder="link" class="mt-2 w-100 borders p-2 gb shadow-b rounded-3">
                <label class="my-2" for="">End date</label>
                <input type="date" required min="<?php echo e(Carbon\Carbon::parse(now())->addDay()->format('Y-m-d')); ?>" name="end_date" id="end_date" placeholder="link" class="mt-2 w-100 borders p-2 gb shadow-b rounded-3">
                
                <div class="w-100 ab px-2 py-3 borders my-3">
                    <div class="d-flex align-items-center justify-content-between border-bottom border-dark pb-1 mb-1">
                        <h4 class="">Calculate:</h4>
                        <p>(Per Day TK. 100)</p>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <p>Link Ad</p>
                        <p><span id="days"> 0 </span> Days</p>
                        <p>TK 100</p>
                    </div>
                    <div class="d-flex align-items-center justify-content-between border-top border-dark pt-1 mt-1">
                        <p>Total</p>
                        <b>TK.<span id="total"> 0</span></b>
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
                          <p><input type="text" required data-parsley-required-message = "Transaction Id is required" placeholder="Enter Transaction Id" value="<?php echo e(old('trnx_id')); ?>" class="form-control" name="trnx_id"></p>
                          <?php endif; ?>
                          <strong>Write Your <?php echo e($method->method_name); ?> Payment Information below.</strong>
                          <textarea required data-parsley-required-message = "Payment Information is required" name="payment_info" style="margin: 0;" rows="2" placeholder="Write Payment Information" class="form-control"><?php echo e(old('payment_info')); ?></textarea>
                        
                      </div>
                      <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     
                  </div>
                </div>
                <div id="linkAdBtn"> </div>
            </div>
        </div>
        </form>
    </div>

    <div id="box3" class="box w-100 py-3" style="display: none;">
        <form action="<?php echo e(route('storeWantedPost')); ?>" data-parsley-validate method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="post_type" value="wanted">
        <h3 class="border-bottom text-center pb-2 mb-3">Choose Your post request</h3>
        <div class="row">
            <div class="col-12 col-md-6">
                <label class="mb-2 w-100" for="">Select a category:</label>
                <select name="category" class="form-control gb shadow-b borders">
                    <option value="" selected disabled>Select an option</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       	<?php if(count($category->get_subcategory)>0): ?>
                        <optgroup label="<?php echo e($category->name); ?>">
                            <?php $__currentLoopData = $category->get_subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($subcategory->id); ?>"><?php echo e($subcategory->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </optgroup>
                        <?php else: ?>
                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-12 col-md-6">
                <label class="mb-2 w-100" for="">Select District</label>
                <select name="location" required class="form-control mb-2 gb shadow-b borders" id="">
                    <option value="" selected disabled>Select an option</option>
                    <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(count($region->get_city)>0): ?>
                            <optgroup label="<?php echo e($region->name); ?>">
                                <?php $__currentLoopData = $region->get_city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($city->id); ?>"><?php echo e($city->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </optgroup>
                        <?php else: ?>
                            <option value="<?php echo e($region->id); ?>"><?php echo e($region->name); ?></option>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                    <input type="text" required name="contact_name" value="<?php echo e((old('contact_name') ? old('contact_name') : Auth::user()->name )); ?>" class="form-control" placeholder="Your Name">
                </div>
                
                <div class="w-100">
                    <div class="form-group mb-2">
                        <label>Mobile Number</label>
                        <div id="mobileNumber">
                            <?php if(Auth::user()->mobile): ?>
                            <div id="<?php echo e(Auth::user()->mobile); ?>" class="addNumber">
                                <input type="hidden" class="contact_mobile" name="contact_mobile[]" value="<?php echo e(Auth::user()->mobile); ?>">
                                <i class="fa fa-check-square"></i>
                                <strong><?php echo e(Auth::user()->mobile); ?> </strong>
                                <a class="removeNumber" href="javascript:void(0)" onclick="removeNumber('<?php echo e(Auth::user()->mobile); ?>')" title="Remove phone number">✕</a>
                            </div>
                            
                            <?php endif; ?>
                        </div>
                        <span id="moreMobile">
                            <?php if(Auth::user()->mobile): ?>
                                <a onclick="moreMobile()" href="javascript:void(0)">Add another mobile number</a>
                            <?php else: ?>
                            <div style="display:flex; margin-bottom: 10px;">
                                <div>
                                    Add mobile number
                                    <div style="position: relative;margin-right: 10px;width: 300px;">
                                        <input type="number" id="number" value="number" required name="contact_mobile" class="form-control" placeholder="Enter your number">
                                        <div class="adjust-field" onclick="addNumber()"> Add</div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<script src="<?php echo e(asset('assets')); ?>/node_modules/dropify/dist/js/dropify.min.js"></script>
<script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();

    });
</script>
<script src="<?php echo e(asset('js/parsley.min.js')); ?>"></script>
<script>

    function paymentMethod(id){
        $("#payment_method"+id).click();
        
    }
  $(document).ready(function() {
    // Handle radio button change event
    $('.post_type input[type="radio"]').change(function() {
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

<script type="text/javascript">
    $(document).on("change", "#start_date, #end_date", function(){

        $("#start_date").val()
        var date1 = new Date($("#start_date").val());
        var date2 = new Date($("#end_date").val());

        var difference = date2.getTime() - date1.getTime();
        var days = Math.ceil(difference / (1000 * 3600 * 24));
        if(days < 0 || !parseInt(days)){
            days = 0;
            total = 0;
        } else if(days == 0){
            days = 1;
        }else{
            
        }
        var total = (days * 100);

        $("#days").html(days);
        $("#total").html(total);
        if(days > 0){
            $("#linkAdBtn").html(`<button class="yb py-2 text-center bt bb2 rounded font-weight-bold mt-2 float-right px-5">Post Ad</button>`)
        }else{
            $("#linkAdBtn").html(``);
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bonik\resources\views/users/post/ads-category.blade.php ENDPATH**/ ?>