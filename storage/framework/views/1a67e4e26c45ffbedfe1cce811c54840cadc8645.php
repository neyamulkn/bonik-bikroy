 
<?php $__env->startSection('title', 'Promote Ad' ); ?>
<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('frontend')); ?>/css/custom/ad-post.css">
<style type="text/css">
    .packageBox{cursor: pointer; position: relative; border: 2px solid #bdbdbd;border-radius: 16px;padding: 10px;margin-bottom: 10px !important;width: 100%;}
    .packageValue{border: 1px solid #a3dca2; border-radius: 16px;padding: 3px 10px;margin-bottom: 5px; color: #279625;}
    .adpost-plan-list input[type="radio"]:checked + label { border-color: #3db83a; }

    .packageValueList input[type="radio"]:checked + label {background-color: #a3dca2;color: #279625;}
    .adpost-plan-list input[type="radio"]{display: none;}
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
                    <form action="<?php echo e(route('ads.promote', $adsSlug)); ?>" data-parsley-validate method="post" enctype="multipart/form-data" class="adpost-form">
                        <?php echo csrf_field(); ?>
                       	<div class="adpost-card">
                                <div class="row offset-md-2">
                           
                                    <div class="col-md-8">
                                        <?php if(Session::has('success')): ?>
                                        <div class="alert alert-success">
                                          <strong>Success! </strong> <?php echo e(Session::get('success')); ?>

                                        </div>
                                        <?php endif; ?>
                                        <?php if(Session::has('error')): ?>
                                        <div class="alert alert-danger">
                                          <strong>Error! </strong> <?php echo e(Session::get('error')); ?>

                                        </div>
                                        <?php endif; ?>
                                        <div class="adpost-title" >
                                            <h3 style="text-align: center;">Promote your ad</h3>
                                            <p>Please choose one of the following options to post your ad</p>
                                        </div>
                                        <ul class="adpost-plan-list">

                                            <li>
                                                <a target="_blank" style="color:#000; display: flex;" href="<?php echo e(route('post_details', $post->slug)); ?>">
                                                    <div>
                                                    <img width="120" src="<?php echo e(asset('upload/images/product/thumb/'.$post->feature_image)); ?>" alt="<?php echo e($post->title); ?>"> </div>
                                                    <div style="margin-left: 5px;">
                                                    <p> <?php echo e(Str::limit($post->title, 60)); ?></p>
                                                    <p style="font-size:12px"> <span><i class="fas fa-tags"></i> <?php echo e($post->get_category->name ?? ''); ?>, <?php echo e($post->get_state->name ?? ''); ?></span></p>
                                                    <p class="fa fa-clock" style="font-size:10px"> <?php echo e(Carbon\Carbon::parse(($post->approved) ? $post->approved : $post->created_at)->format(Config::get('siteSetting.date_format'))); ?></p>
                                                    <p style="font-size:10px" class="fa fa-eye"> Views <?php echo e($post->views); ?> </p><br/>
                                                    <?php echo e(Config::get('siteSetting.currency_symble') . $post->price); ?></div>
                                                </a>
                                            </li>
                                        <?php if($post->status == 'Not posted'): ?>
                                            <?php $last_free_post = App\Models\Product::where('subcategory_id', $post->subcategory_id)->where('user_id', $post->user_id)->where('ad_type', 'free')->orderBy('created_at', 'desc')->where('id', '!=', $post->id)->first();

                                            $to = \Carbon\Carbon::parse($last_free_post->created_at);
                                            $from = \Carbon\Carbon::parse(now());
                                            $days = $to->diffInDays($from);
                                            
                                            $free_ads_duration = App\Models\SiteSetting::where('type', 'free_ads_limit')->first();

                                            ?>
                                        
                                            
                                        <?php endif; ?>
                                          
                                            <?php $__currentLoopData = $packageTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(count($package->get_purchasePackages)>0 || count($package->get_packageVlues)>0): ?>
                                            <input type="radio" <?php if($index == 0): ?> checked <?php endif; ?> class="package" value="<?php echo e($package->id); ?>" name="package" id="package<?php echo e($package->id); ?>">

                                            <label style="background: <?php echo e($package->background_color); ?>" class="packageBox" for="package<?php echo e($package->id); ?>">
                                                
                                                <div class="adpost-plan-content">
                                                    <h6><img width="25" src="<?php echo e(asset('upload/images/package/'.$package->ribbon)); ?>"> <?php echo e($package->name); ?></h6>
                                                    <!-- <?php if($package->promote_demo): ?>
                                                    <span onclick="promteDemo('<?php echo $package->id; ?>')" style="position: absolute;right: 10px;top: 0;"><i class="fa fa-eye"></i> See Example</span><?php endif; ?> -->
                                                </div>
                                                <div class="packageValueList">
                                                    <?php if(count($package->get_purchasePackages)>0): ?>
                                                        <p style="font-size: 12px;line-height: 5px;padding-left: 30px;">My Purchased Package</p>
                                                        <?php $__currentLoopData = $package->get_purchasePackages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $packageValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($index == 0): ?>
                                                        
                                                        <h3 style="text-align: right;"><?php echo e(config('siteSetting.currency_symble')); ?><span id="packagePrice<?php echo e($package->id); ?>"><?php echo e(round($packageValue->price)); ?></span></h3><?php endif; ?>

                                                        <input onclick="packageBox('<?php echo e($package->id); ?>', <?php echo e($packageValue->price); ?>)" type="radio" <?php if($index == 0): ?> checked <?php endif; ?> name="purchasPackvalue[<?php echo e($package->id); ?>]" value="<?php echo e($packageValue->id); ?>" id="purchasPackvalue<?php echo e($packageValue->id); ?>">
                                                        <label for="purchasPackvalue<?php echo e($packageValue->id); ?>" class="packageValue"><?php echo e($packageValue->duration); ?> days</label>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                       
                                                        <?php $__currentLoopData = $package->get_packageVlues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $packageValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($index == 0): ?>
                                                        <h3 style="text-align: right;"><?php echo e(config('siteSetting.currency_symble')); ?><span id="packagePrice<?php echo e($package->id); ?>"><?php echo e(round($packageValue->price)); ?></span></h3><?php endif; ?>

                                                        <input onclick="packageBox('<?php echo e($package->id); ?>', <?php echo e($packageValue->price); ?>)" type="radio" <?php if($index == 0): ?> checked <?php endif; ?> name="packageValue[<?php echo e($package->id); ?>]" value="<?php echo e($packageValue->id); ?>" id="packvalue<?php echo e($packageValue->id); ?>">
                                                        <label for="packvalue<?php echo e($packageValue->id); ?>" class="packageValue"><?php echo e($packageValue->duration); ?> days</label>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </div>
                                            </label>
                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                        </ul>
                                    </div>
                                    <div class="col-md-8">
                                    <div class="form-group text-right">
                                        <button style="width: 100%;" class="btn btn-inline">
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
<script type="text/javascript">
    function packageBox(id, price){
        $("#packagePrice"+id).html(price);
        $(".package").prop("checked", false);
        $('#package'+id).prop('checked', true);
    }
</script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\jotesto\resources\views/users/post/promoteAds.blade.php ENDPATH**/ ?>