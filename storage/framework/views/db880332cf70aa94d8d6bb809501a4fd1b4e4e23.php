
<?php $__env->startSection('title', 'Edit Post'); ?>

<?php $__env->startSection('css-top'); ?>
    <link href="<?php echo e(asset('assets')); ?>/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
  
<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('frontend')); ?>/css/custom/ad-post.css">
<link href="<?php echo e(asset('assets')); ?>/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
<link href="<?php echo e(asset('assets')); ?>/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .packageBox{cursor: pointer;  border: 2px solid #bdbdbd;border-radius: 16px;padding: 10px;margin-bottom: 10px !important;width: 100%;}
    .packageValue{border: 1px solid #a3dca2; border-radius: 16px;padding: 3px 10px;margin-bottom: 5px; color: #279625;}
    .form-check-list li{display: inline-flex;margin-left: 10px;}
    .adjust-field{border: none;border-radius:0;position: absolute;top: 0;right: 0;background: #e9ecef;padding: 7px;}

    .adpost-plan-list input[type="radio"]:checked + label { border-color: #3db83a; }

    .packageValueList input[type="radio"]:checked + label {background-color: #a3dca2;color: #279625;}
    .adpost-plan-list input[type="radio"]{display: none;}
.dropify_image{
            position: absolute;top: -12px!important;left: 12px !important; z-index: 9; background:#fff!important;padding: 3px;
        }

.image .col-md-2{width: 20% !important;}
.dropify-wrapper{height: 125px;padding: 5px;}
  .fa-check-square{color: green;}
  .addNumber{position: relative;margin-right: 10px;width: 320px;border-bottom: 1px solid #e5e5e5;padding: 5px;}
  .removeNumber{color:red;padding: 3px 5px

</style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Edit post</h4>
                </div>
                
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->

            <div class="card">
                <div id="pageLoading"></div>
                <div class="card-body">
                     <?php if($product->status == 'reject'): ?>
                    <div class="alert alert-danger alert-dismissible"><?php echo e($product->reject_reason); ?></div>
                    <?php endif; ?>
                    <form action="<?php echo e(route('admin.product.update',$product->id)); ?>" data-parsley-validate method="post" enctype="multipart/form-data" class="adpost-form">
                        <?php echo csrf_field(); ?>
                        <div class="adpost-card">
                            <div class="adpost-title">
                                <h3>Ad Information</h3>
                            </div>

                            <div id="pageLoading"></div>
                           
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="required">Product Title</label>
                                        <input name="title" required value="<?php echo e($product->title); ?>" type="text" class="form-control" placeholder="Type your product title here">
                                    </div>
                                </div>


                                
                                <?php if(count($chilcategories)>0): ?>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class=" required">Type</label>
                                        <select name="childcategory_id" class="form-control">
                                            <option value="">Select Type</option>
                                            <?php $__currentLoopData = $chilcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if($product->childcategory_id == $childcategory->id): ?> selected <?php endif; ?> value="<?php echo e($childcategory->id); ?>"><?php echo e($childcategory->name); ?></option>
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
                                                    <input name="attributeValue[<?php echo e($attribute->id); ?>][]" <?php if($attribute->is_required == 1): ?> required <?php endif; ?> <?php if($value->get_productVariant): ?> checked <?php endif; ?> value="<?php echo e($value->id); ?>" type="checkbox" class="form-check" id="attributeValue<?php echo e($value->id); ?>">
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
                                                    <input name="attributeValue[<?php echo e($attribute->id); ?>][]" <?php if($value->get_productVariant): ?> checked <?php endif; ?> <?php if($attribute->is_required == 1): ?> required <?php endif; ?> value="<?php echo e($value->id); ?>" type="radio" class="form-check" id="attributeValue<?php echo e($value->id); ?>">
                                                    <label for="attributeValue<?php echo e($value->id); ?>" class="form-check-text"><?php echo e($value->name); ?></label>
                                                </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                            <?php endif; ?>

                                        <?php else: ?>
                                        <select class="form-control" <?php if($attribute->is_required == 1): ?> required <?php endif; ?> name="attributeValue[<?php echo e($attribute->id); ?>][]">
                                            <?php if($attribute->get_attrValues): ?>
                                                <?php if(count($attribute->get_attrValues)>0): ?>
                                                    <option value="">Select one</option>
                                                    <?php $__currentLoopData = $attribute->get_attrValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php if($value->get_productVariant): ?> selected <?php endif; ?> value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
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
                                            <input <?php if($feature->is_required): ?> required <?php endif; ?> type="text" name="featureValue[<?php echo e($feature->id); ?>]" value="<?php echo e(($feature->featureValue) ? $feature->featureValue->value : null); ?>" class="form-control" placeholder="Input value here">
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>

                                    <div id="PredefinedFeatureBycategory"></div>
                                    <div id="PredefinedFeatureBySubcategory"></div>
                                   
                                </div>

                                
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="">Product image</label>
                                        <div class="row image" style="padding: 0 10px">

                                            <div class="col-6 col-md-2" style="padding: 5px;">
                                                <input type="file" data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M" name="feature_image" class="dropify" data-default-file="<?php echo e(asset('upload/images/product/thumb/'.$product->feature_image)); ?>" <?php if(!$product->feature_image): ?> required <?php endif; ?>  accept="image/*" >
                                            </div>

                                            <?php $__currentLoopData = $product->get_galleryImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $galleryImage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <div class="col-6 col-md-2" style="padding: 5px;">
                                               <input type="file" data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M"  name="gallery_image[<?php echo e($galleryImage->id); ?>]" class="dropify" data-default-file="<?php echo e(asset('upload/images/product/gallery/'.$galleryImage->image_path)); ?>" accept="image/*" >
                                            </div>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php for($i=count($product->get_galleryImages); $i<5; $i++): ?>
                                            <div class="col-6 col-md-2" style="padding: 5px;">
                                               <input type="file" data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M" name="gallery_image[]" class="dropify" data-default-file="<?php echo e(asset('upload/images/product/default.jpg')); ?>" accept="image/*" >
                                            </div>
                                           
                                            <?php endfor; ?>
                                        </div>
                                         <div class="form-group"><i style="color:red;font-size: 11px">Supported formats are jpg,gif,png (Max picture size 5 Mb)</i></div>
                                    </div>
                                   
                                </div>
                                
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="required">ad description</label>
                                        <textarea name="description" required class=" form-control" rows="4" maxlength="5000" placeholder="Describe your message"><?php echo $product->description; ?></textarea>
                                        <p>Max 5000 character</p>
                                    </div>
                                </div>  
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required">Division</label>
                                        <select required name="state_id" onchange="get_city(this.value)" class="form-control custom-select">
                                            <option selected>Select Location</option>
                                            <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if($product->state_id == $region->id): ?> selected <?php endif; ?> value="<?php echo e($region->id); ?>"><?php echo e($region->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required">City</label>
                                        <select required name="city_id" id="city_id" class="form-control custom-select">
                                            <option selected>Select City</option>
                                            <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if($product->city_id == $city->id): ?> selected <?php endif; ?> value="<?php echo e($city->id); ?>"><?php echo e($city->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class=" required">Price</label>
                                    <div class="form-group" style="position: relative;">
                                        <input name="price" value="<?php echo e($product->price); ?>" required type="number" class="form-control" placeholder="Enter your pricing amount">

                                        <span class="adjust-field">
                                            <input id="negotiable" <?php if($product->negotiable == 1): ?> checked <?php endif; ?> name="negotiable" type="checkbox" value="1">&nbsp;
                                            <label for="negotiable"><small>Negotiable</small></label>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="required">Search Keywords( <span style="font-size: 12px;color: #777;font-weight: initial;">Write meta tags Separated by Comma[,]</span> )</label>

                                         <div class="tags-default">
                                            <input  type="text" name="meta_keywords[]" value="<?php echo e($product->meta_keywords); ?>" data-role="tagsinput" placeholder="Enter search keywords" />
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
                                        <input type="text" required name="contact_name" value="<?php echo e(($product->contact_name ? $product->contact_name : Auth::user()->name )); ?>" class="form-control" placeholder="Your Name">
                                    </div>
                                </div>
                               
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Mobile Number</label>
                                        <?php $__currentLoopData = json_decode($product->contact_mobile); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $number): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div id="mobileNumber">
                                            <div id="<?php echo e($number); ?>" class="addNumber">
                                            <input type="hidden" name="contact_mobile[]" value="<?php echo e($number); ?>">
                                            <i class="fa fa-check-square"></i> <strong><?php echo e($number); ?> </strong><a class="removeNumber" href="javascript:void(0)" onclick="removeNumber('<?php echo e($number); ?>')" title="Remove phone number">✕
                                            </a>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <span id="moreMobile"><a onclick="moreMobile()" href="javascript:void(0)">Add another mobile number</a></span>
                                    </div>
                                    
                                    <label><input id="contact_hidden" <?php if($product->contact_hidden == 1): ?> checked <?php endif; ?> name="contact_hidden" type="checkbox" value="1"> Hide mobile number(s)</label>
                                </div>
                            </div>
                            <div class="row offset-md-2">
                                <div class="col-md-8">
                                <div class="form-group text-right">
                                    <button style="width: 100%;" class="btn btn-success">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Update Your Ad</span>
                                    </button>
                                </div>
                                </div>
                            </div>
                        </div>
                       
                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('js/parsley.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets')); ?>/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>

    <script src="<?php echo e(asset('assets')); ?>/node_modules/dropify/dist/js/dropify.min.js"></script>
    <script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();

    });
</script>
<script type="text/javascript">

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
    function packageBox(id, price){
        $("#packagePrice"+id).html(price);
        $(".package").prop("checked", false);
        $('#package'+id).prop('checked', true);
    }
</script>

</script>
<script>
 
    var number = 1;
    do {
      function showPreview(event, number){
        if(event.target.files.length > 0){
        if((event.target.files[0].size/1000) <= 5120 ){
          let src = URL.createObjectURL(event.target.files[0]);
          let preview = document.getElementById("file-ip-"+number+"-preview");
          preview.src = src;
          preview.style.display = "block";
            $('#'+number).html('');
        }else{
            $('#'+number).html('<span style="font-size:12px;color:red"> Image size max 5MB</span>');
        }
        }
      }
      function myImgRemove(number) {
          document.getElementById("file-ip-"+number+"-preview").src = "<?php echo e(asset('upload/images/product/default.jpg')); ?>";
          document.getElementById("file-ip-"+number).value = null;
        }
      number++;
    }
    while (number < 5);


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
    }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bonik\resources\views/admin/product/product-edit.blade.php ENDPATH**/ ?>