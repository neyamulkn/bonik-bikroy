 
<?php $__env->startSection('title', 'Ads Post' ); ?>
<?php $__env->startSection('css'); ?>
  <link href="<?php echo e(asset('assets')); ?>/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
 <link href="<?php echo e(asset('assets')); ?>/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo e(asset('frontend')); ?>/css/custom/ad-post.css">
<link href="<?php echo e(asset('assets')); ?>/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
<style type="text/css">
    .packageBox{cursor: pointer; position: relative; border-bottom: 1px solid #bdbdbd;padding-bottom: 10px;margin-bottom: 10px !important;width: 100%;}
    .packageValue{border: 1px solid #eb5206; border-radius: 16px;padding: 3px 10px;margin-bottom: 5px; color: #000;}
    .form-check-list li{display: inline-flex;margin-left: 10px;}
    .adjust-field{cursor: pointer; border: none;border-radius:0;position: absolute;top: 0;right: 0;background: #e9ecef;padding: 7px;}

    .adpost-plan-list input[type="checkbox"]:checked + label { border-color: #eb5206; }

    .packageValueList input[type="radio"]:checked + label {background-color: #eb520621;color: #eb5206;}
 
    .dropify_image{ position: absolute;top: -12px!important;left: 12px !important; z-index: 9; background:#fff!important;padding: 3px;}
.image .col-md-2{width: 20% !important;}
.dropify-wrapper.touch-fallback{height: 105px!important;}
.dropify-wrapper{height: 110px!important;padding: 5px; overflow: hidden ;}
.adpost-plan-content input{width: 25px;height: 25px}
.packageValueList{position: absolute;right: 10px;top: 5px;}
.packageValueList select{border: none;}
 @media (max-width: 768px) {

.dropify-wrapper .dropify-message{top: initial;}}
.dropify-wrapper.touch-fallback .dropify-clear{top: 3px; right: 3px; bottom: inherit;}

  .fa-check-square{color: green;}
  .addNumber{position: relative;margin-right: 10px;width: 320px;border-bottom: 1px solid #e5e5e5;padding: 5px;}
  .removeNumber{color:red;padding: 3px 5px;}
    .adpost-plan-list input[type="checkbox"]:checked + label .free-add-label {
        color: #eb5306;
    }
</style>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!--=====================================
        ADPOST PART START
    =======================================-->
    <section class="user-area">
        <div class="container">
            <div class="row">
                <!--Right Part Start -->
                <?php echo $__env->make('users.inc.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!--Middle Part Start-->
                <div class="col-md-9 sticky-conent">
                    <form action="<?php echo e(route('post.store')); ?>" data-parsley-validate method="post" enctype="multipart/form-data" class="adpost-form">
                        <?php echo csrf_field(); ?>
                        <div class="adpost-card">
                            <div class="adpost-title">
                                <h3>Ad Information</h3>
                            </div>

                            <div id="pageLoading"></div>
                            <input type="hidden" name="category_id" value="<?php echo e($category->id); ?>">
                            <?php if($subcategory): ?>
                            <input type="hidden" name="subcategory_id" value="<?php echo e($subcategory->id); ?>"><?php endif; ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="required">Product Title</label>
                                        <input name="title" required value="<?php echo e(old('title')); ?>" type="text" class="form-control" placeholder="Type your product title here">
                                    </div>
                                </div>

                                <?php if(count($chilcategories)>0): ?>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="required">Type</label>
                                        <select name="childcategory_id" class="select2 form-control">
                                            <option value="">Select Type</option>
                                            <?php $__currentLoopData = $chilcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if(old('childcategory_id') == $childcategory->id): ?> selected <?php endif; ?> value="<?php echo e($childcategory->id); ?>"><?php echo e($childcategory->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if(count($brands)>0): ?>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="required" for="brand">Brand </label>
                                        <select name="brand" required id="brand" style="width:100%" id="brand" data-parsley-required-message = "Brand is required" class="select2 form-control custom-select">
                                           <option value="">Select Brand</option>
                                           <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                           <option  <?php if(old('brand') == $brand->id): ?> selected <?php endif; ?>  value="<?php echo e($brand->id); ?>"><?php echo e($brand->name); ?></option>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                       </select>
                                   </div>
                                </div>
                                <?php endif; ?>
                                <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <input type="hidden" name="attribute[<?php echo e($attribute->id); ?>]" value="<?php echo e($attribute->name); ?>">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="<?php if($attribute->is_required == 1): ?> required <?php endif; ?>"><?php echo e($attribute->name); ?></label>
                                        <?php if($attribute->display_type == 1): ?>
                                            <?php if(count($attribute->get_attrValues)>0): ?>
                                            <ul class="form-check-list">
                                                <?php $__currentLoopData = $attribute->get_attrValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                    <input name="attributeValue[<?php echo e($attribute->id); ?>][]" <?php if($attribute->is_required == 1): ?> required <?php endif; ?> value="<?php echo e($value->id); ?>" type="checkbox" class="form-check" id="attributeValue<?php echo e($value->id); ?>">
                                                    <label for="attributeValue<?php echo e($value->id); ?>" class="form-check-text"><?php echo e($value->name); ?></label>
                                                </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                            <?php endif; ?>
                                        <?php elseif($attribute->display_type == 3): ?>
                                        <?php if(count($attribute->get_attrValues)>0): ?>
                                            <ul class="form-check-list">
                                                <?php $__currentLoopData = $attribute->get_attrValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                    <input name="attributeValue[<?php echo e($attribute->id); ?>][]" <?php if($attribute->is_required == 1): ?> required <?php endif; ?> value="<?php echo e($value->id); ?>" type="radio" class="form-check" id="attributeValue<?php echo e($value->id); ?>">
                                                    <label for="attributeValue<?php echo e($value->id); ?>" class="form-check-text"><?php echo e($value->name); ?></label>
                                                </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                            <?php endif; ?>

                                        <?php else: ?>
                                        <select class="form-control select2" <?php if($attribute->is_required == 1): ?> required <?php endif; ?> name="attributeValue[<?php echo e($attribute->id); ?>][]">
                                            <?php if($attribute->get_attrValues): ?>
                                                <?php if(count($attribute->get_attrValues)>0): ?>
                                                    <option value="">Select one</option>
                                                    <?php $__currentLoopData = $attribute->get_attrValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    <option value="">Value Not Found</option>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php endif; ?>

                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <div class="col-md-12" <?php if(count($features) <= 0): ?> style="display:none" <?php endif; ?>>
                                    <!-- Allow attribute checkbox button -->
                                    <label class="form-label">Product Features</label>


                                    <div class="row">
                                        <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div style="margin-bottom:10px;" class="col-4 <?php if($feature->is_required): ?> required <?php endif; ?> col-sm-2 text-right col-form-label"><?php echo e($feature->name); ?>

                                        <input type="hidden" value="<?php echo e($feature->name); ?>" class="form-control" name="features[<?php echo e($feature->id); ?>]"></div>
                                        <div class="col-8 col-sm-4">
                                            <input <?php if($feature->is_required): ?> required <?php endif; ?> type="text" name="featureValue[<?php echo e($feature->id); ?>]" class="form-control" placeholder="Input value here">
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>

                                    <div id="PredefinedFeatureBycategory"></div>
                                    <div id="PredefinedFeatureBySubcategory"></div>

                                </div>


                                <div class="col-lg-12">
                                    <div class="form-group">
                                        
                                        <div class="row image">
                                            <div class="col-12 col-md-2">
                                                <label class="required">Main image</label>
                                                <input type="file" data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M" class="dropify" accept="image/*" name="feature_image" required>
                                            
                                            </div>
                                            <div class="col-md-10">
                                            <label>Gallery image</label>
                                            <div class="row">
                                            <?php for($i=1; $i<=5; $i++): ?>
                                            <div class="col-4 col-md-2">
                                                <input type="file" data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M" class="dropify" accept="image/*"  name="gallery_image[]">
                                            
                                            </div>
                                             <?php endfor; ?>
                                            </div>
                                            </div>
                                           
                                        </div>
                                         <div class="form-group"><i style="color:red;font-size: 11px">Supported formats are jpg,gif,png (Max picture size 5 Mb)</i></div>
                                    </div>
                                   
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="required">Description</label>
                                        <textarea name="description" required class="summernote form-control" rows="4" maxlength="5000" placeholder="Describe your message"><?php echo e(old('description')); ?></textarea>
                                        <p>Max 5000 character</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required">District </label>
                                        <select required name="state_id"  onchange="get_city(this.value)" class="form-control select2 custom-select">
                                            <option value="">Select Location</option>
                                            <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if(old('state_id') == $region->id): ?> selected <?php endif; ?> value="<?php echo e($region->id); ?>"><?php echo e($region->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required">City</label>
                                        <select required  name="city_id" id="city_id" class="form-control select2 custom-select">
                                            <option value="">Select Location</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="required">Price</label>
                                    <div class="form-group" style="position: relative;">
                                        <input name="price" value="<?php echo e(old('price')); ?>" required type="number" class="form-control" placeholder="Enter your pricing amount">

                                        <span class="adjust-field">
                                            <input id="negotiable" name="negotiable" type="checkbox" value="1">&nbsp;
                                            <label for="negotiable"><small>Negotiable</small></label>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Search Keywords( <span style="font-size: 12px;color: #777;font-weight: initial;">Write tags Separated by [,]</span> )</label>

                                         <div class="tags-default">
                                            <input  type="text" name="meta_keywords[]"  data-role="tagsinput" placeholder="Enter search keywords" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="adpost-card">
                            <div class="adpost-title">
                                <h3>Author Information</h3>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required">Name</label>
                                        <input type="text" required name="contact_name" value="<?php echo e((old('contact_name') ? old('contact_name') : Auth::user()->name )); ?>" class="form-control" placeholder="Your Name">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Mobile Number</label>
                                        <div id="mobileNumber">
                                            <?php if(Auth::user()->mobile): ?>
                                            <div id="<?php echo e(Auth::user()->mobile); ?>" class="addNumber">
                                            <input type="hidden" class="contact_mobile" name="contact_mobile[]" value="<?php echo e(Auth::user()->mobile); ?>">
                                            <i class="fa fa-check-square"></i> <strong><?php echo e(Auth::user()->mobile); ?> </strong><a class="removeNumber" href="javascript:void(0)" onclick="removeNumber('<?php echo e(Auth::user()->mobile); ?>')" title="Remove phone number">✕
                                            </a>
                                            </div>
                                            
                                            <?php endif; ?>
                                        </div>
                                        <span id="moreMobile"><?php if(Auth::user()->mobile): ?><a onclick="moreMobile()" href="javascript:void(0)">Add another mobile number</a>

                                        <?php else: ?>

                                        <div style="display:flex; margin-bottom: 10px;">
                                            <div>
                                            Add mobile number
                                            <div style="position: relative;margin-right: 10px;width: 300px;">
                                            <input type="number" id="number" value="`+number+`" required name="contact_mobile" class="form-control" placeholder="Enter your number">
                                            <span class="adjust-field" onclick="addNumber()"> Add</span>
                                            </div>
                                            </div>
                                            </div>


                                        <?php endif; ?></span>
                                    </div>

                                    <label><input id="contact_hidden" name="contact_hidden" type="checkbox" value="1"> Hide mobile number(s)</label>
                                </div>
                            </div>
                        </div>

                        <div class="adpost-card">
                            <div class="row offset-md-2">
                                <?php if(count($packageTypes)>1): ?>

                                <div class="col-md-10">
                                    <div class="adpost-title" style="text-align: center;">
                                        <h3 >Promote your ad</h3>
                                        <p>Want to sell faster choose one of the following options to post your ad</p>
                                    </div>
                                    <ul class="adpost-plan-list">
                                        <?php $activePackage = null; ?>
                                        <?php $__currentLoopData = $packageTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(count($package->get_purchasePackages)>0 || count($package->get_packageVlues)>0): ?>
                                            <?php $activePackage = 1; ?>
                                            <?php if(count($package->get_purchasePackages)>0): ?>
                                                       
                                            <label class="packageBox" for="package<?php echo e($package->id); ?>">

                                                <div class="adpost-plan-content purchasPackvalue">
                                                    <h6 style="display: flex;"> <input  type="checkbox" value="<?php echo e($package->id); ?>" name="package[]" id="package<?php echo e($package->id); ?>"> <span style="background: <?php echo e($package->background_color); ?>; color:<?php echo e($package->text_color); ?>;margin-left: 8px; padding: 5px 5px;border-radius: 3px;"> <?php echo e($package->name); ?> </span></h6>
                                                    <p class="package_details"><?php echo e($package->details); ?>  <?php if($package->promote_demo): ?> <a onclick="promteDemo('<?php echo $package->id; ?>')" href="javascript:void(0)"><i class="fa fa-eye"></i> See Example</a><?php endif; ?></p>
                                                    
                                                </div>
                                                <div class="packageValueList">
                                                     
                                                        <select name="purchasPackvalue[<?php echo e($package->id); ?>]">
                                                        <?php $__currentLoopData = $package->get_purchasePackages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $packageValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                        <option value="<?php echo e($packageValue->id); ?>"><?php echo e($packageValue->duration); ?> days  - <?php echo e(config('siteSetting.currency_symble') . $packageValue->price); ?></option>
                                                       
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                   
                                                </div>
                                            </label>
                                            <?php else: ?>
                                            <label class="packageBox" for="package<?php echo e($package->id); ?>">

                                                <div class="adpost-plan-content package">
                                                    <h6 style="display: flex;"> <input onclick="packageBox()" type="checkbox" value="<?php echo e($package->id); ?>" name="package[]" id="package<?php echo e($package->id); ?>"> <span style="background: <?php echo e($package->background_color); ?>; color:<?php echo e($package->text_color); ?>;margin-left: 8px; padding: 5px 5px;border-radius: 3px;"> <?php echo e($package->name); ?> </span></h6>
                                                    <p class="package_details"><?php echo e($package->details); ?>  <?php if($package->promote_demo): ?> <a onclick="promteDemo('<?php echo $package->id; ?>')" href="javascript:void(0)"><i class="fa fa-eye"></i> See Example</a><?php endif; ?></p>
                                                    
                                                </div>
                                                <div class="packageValueList">
                                                   
                                                        <select name="packageValue[<?php echo e($package->id); ?>]" onchange="packageBox()" class ="packvalue">
                                                        <?php $__currentLoopData = $package->get_packageVlues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $packageValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option data-price="<?php echo e($packageValue->price); ?>" data-package="<?php echo e($package->id); ?>" value="<?php echo e($packageValue->id); ?>"><?php echo e($packageValue->duration); ?> days - <?php echo e(config('siteSetting.currency_symble') . $packageValue->price); ?> </option>

                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    
                                                </div>
                                            </label>

                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                         <?php if($activePackage): ?>
                                        <label class="packageBox" for="allCheck">

                                        <div class="adpost-plan-content">
                                            <h6 style="display: flex;"> <input  type="checkbox" id="allCheck"><span style="padding: 5px;"> Select all </span></h6>
                                            
                                        </div></label><?php endif; ?>
                                    </ul>
                                </div>
                                <?php endif; ?>
                                <div class="col-md-10">
                                    <?php $ads_fee = ($subcategory && $subcategory->post_fee > 0) ? $subcategory->post_fee : 0; ?>
                                    <input type="hidden" class="postPrice" value="<?php echo e($ads_fee); ?>" name="postPrice">
                                    <div style="display: flex;background: #585252;color: #fff;padding: 5px;     justify-content: space-between;margin-bottom: 5px;"><strong>Total</strong> <p id="TotalPrice"><?php if($ads_fee > 0): ?> <?php echo e(config('siteSetting.currency_symble').$ads_fee); ?>  <?php else: ?> Free <?php endif; ?></p></div>
                               
                                <label for="conditions"><input id="conditions" required type="checkbox" name=""> I have read and accept the <a href="#"> Terms and Conditions</a></label>

                                <div class="form-group text-center">
                                    <button class="btn btn-inline">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Published Your Ad</span>
                                    </button>
                                </div>
                                </div>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--=====================================
                ADPOST PART END
    =======================================-->
    <div class="modal fade" id="promte_demo_modal" role="dialog"   style="display: none;">
        <div class="modal-dialog" style="max-width: 95%;">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Promote Ad View</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div style="text-align:center;" id="promote_demo">

            </div>
          </div>
        </div>
    </div>
    <script type="text/javascript">
        function promteDemo(id) {
            $('#promte_demo_modal').modal('show');
            var  url = '<?php echo e(route("package_demo", ":id")); ?>';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    if(data){
                         $('#promote_demo').html(data);
                    }else{
                        $("#promote_demo").html('');
                    }
                }
            });


        }
    </script>

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
<script src="<?php echo e(asset('assets')); ?>/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="<?php echo e(asset('assets')); ?>/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(".select2").select2();
</script>
<script type="text/javascript">


    <?php if(old('state_id')): ?>
        get_city(old('state_id'));
    <?php endif; ?>

    function get_city(id){

        var  url = '<?php echo e(route("get_city", ":id")); ?>';
        url = url.replace(':id',id);
        $.ajax({
            url:url,
            method:"get",
            success:function(data){
                if(data){
                    $("#city_id").html(data);
                }else{
                    $("#city_id").html('<option>City not found</option>');
                }
            }
        });
    }
    // Enter form submit preventDefault for tags
    $(document).on('keyup keypress', 'form input[type="text"]', function(e) {
      if(e.keyCode == 13) {
        e.preventDefault();
        return false;
      }
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


    function packageBox(){
        var total = <?php echo e($ads_fee); ?>;

        $('.package :checked').each(function () {
        var packageId = (this.checked ? $(this).val() : "");
        
        $('.packvalue :selected').each(function () {

            if($(this).data('package') == packageId){
                var price = $(this).data('price');
                total = parseInt(total) + parseInt(price);
            }

            });
        });

        if(total > 0){
            $('#TotalPrice').html("<?php echo e(config('siteSetting.currency_symble')); ?>" + total);
            $('.postPrice').val(total);
        }else{
            $('#TotalPrice').html('Free');
        }

        if($('.package :checked').length == $('.package').length){
            $('#allCheck').prop('checked', true); 
        }else{
            $('#allCheck').prop('checked', false); 
        }

       
    }

    $("#allCheck").click(function(){
       
        $('.package input:checkbox').not(this).prop('checked', this.checked);
        $('.purchasPackvalue input:checkbox').not(this).prop('checked', this.checked);
        packageBox();
    });



</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bikroy\resources\views/users/post/ad-post.blade.php ENDPATH**/ ?>