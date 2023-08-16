
<?php $__env->startSection('title', $packageType->name. ' | '. Config::get('siteSetting.site_name') ); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('frontend')); ?>/css/custom/price.css">
<style type="text/css">.section-center-heading h2, .section-center-heading p{color:#000} .section-center-heading{margin: 0;}
	.price-btn{text-align: center;}.price-list{margin-bottom: 0;}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

	<!--=====================================
	             PRICE PART START
	=======================================-->
	<section>
	    <div class="container" style="background: #fff;border-radius: 5px; margin-bottom: 10px;padding: 15px;">
	    	<div class="row">

	    		<div class="col-md-12" style="padding: 15px;text-align: center;">
	    		<h3><?php echo e($packageType->name); ?></h3>
				<p><?php echo e($packageType->details); ?></p> 
				</div>
	            
	        </div>
	        <div class="row">

	        	<?php $__currentLoopData = $packageValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	            <div class="col-md-3 col-lg-3">
	            	<form action="<?php echo e(route('packagePurchase', $package->id)); ?>" method="post">
	            	<?php echo csrf_field(); ?>
	                <div class="price-card" style="padding:25px 15px;">
	                	<?php  
					        $selling_price = $package->price;
					        $discount = ($package->discount) ? $package->discount : null;
					        $discount_type = '%';
					        if($discount){
					            $calculate_discount = App\Http\Controllers\HelperController::calculate_discount($selling_price, $discount, $discount_type );
					        }
					    ?>
	                    <div class="price-head">
	                        <i><img width="60" src="<?php echo e(asset('upload/images/package/'.$packageType->ribbon)); ?>"></i>
	                        <h3><?php echo e(config('siteSetting.currency_symble')); ?><?php echo e(round($discount ? $calculate_discount['price'] : $selling_price)); ?> <?php if($discount): ?><s style="font-size: 18px;color: red;display: block;position: absolute; left: 45px"><?php echo e(config('siteSetting.currency_symble')); ?><?php echo e(round($selling_price)); ?></s><?php endif; ?></h3>
	                        
	                    </div>
	                    <ul class="price-list">
	                        <li>
	                            <i class="fa fa-plus"></i>
	                            <p><?php echo e($package->ads); ?> Ads</p>
	                        </li>

	                        <li>
	                            <i class="fa fa-plus"></i>
	                            <p>Ads for <?php echo e($package->duration); ?> days</p>
	                        </li>
	                       
	                    </ul>
	                    <p><?php echo e($package->details); ?></p>
	                    <div class="price-btn">
	                        <button class="btn btn-inline btn-sm">
	                            <i class="fa fa-sign-in-alt"></i>
	                            <span>Purchase Now</span>
	                        </button>
	                    </div>
	                </div>
	                </form>
	            </div>
	            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	        </div>
	        
	    </div>
	</section>
	<!--=====================================
	             PRICE PART END
	=======================================-->
<?php $__env->stopSection(); ?>    

<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\jotesto\resources\views/frontend/package/package.blade.php ENDPATH**/ ?>