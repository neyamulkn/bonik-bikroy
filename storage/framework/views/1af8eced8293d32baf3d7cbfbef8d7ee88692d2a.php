<?php
$products = App\Models\Product::with(['get_promoteAd.get_adPackage', 'wishlist'])->where('status', 'active')
->selectRaw('id,title,slug,price,category_id,state_id,views,sale_type, feature_image,created_at')->orderBy('id', 'desc')->take($section->item_number)->get(); 
?>
<?php if(count($products)>0): ?>
<div class="hl-2 mt-2">
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="w-100 <?php if($index==0): ?> ab <?php else: ?> bg-white <?php endif; ?> p-2 mb-2">
        <a class="w-100" href="<?php echo e(route('post_details', $product->slug)); ?>">
            <div class="position-relative">
                <div class="d-flex align-items-center position-absolute left-0 top-0 ">
                    <div class="yb bt px-3 font-weight-bold">USED</div>
                    <div class="ff"></div>
                </div>
                <img class="position-absolute right-0 top-0 lazyload" src="<?php echo e(asset('upload/images/urgent.png')); ?>">
                <img class="lazyload w-100 mh-300" src="<?php echo e(asset('upload/images/product/thumb/default.jpg')); ?>" data-src="<?php echo e(asset('upload/images/product/'.$product->feature_image)); ?>" alt="<?php echo e($product->title); ?>">
            </div>
            <div class="">
                <h4 class="font-weight-bold bt py-1 title" title="<?php echo e($product->title); ?>"><?php echo e($product->title); ?></h4>
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="d-flex align-items-center">
                            <img class="lazyload" src="<?php echo e(asset('upload/users/lavel1.png')); ?>">
                            <p class="bt" title="Verified Bonik">Verified Bonik</p>
                        </div>
                        <p class="bt py-1" title="<?php echo e($product->get_state->name ?? ''); ?>"><?php echo e($product->get_state->name ?? ''); ?></p>
                    </div>
                    <div>
                        <img class="lazyload" src="<?php echo e(asset('upload/users/pin.png')); ?>">
                    </div>
                </div>
                
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="font-weight-bold bt py-1"><?php echo e(Config::get('siteSetting.currency_symble') .' '. number_format($product->price)); ?></h4>
                    <p class="bt py-1"><?php echo e(Carbon\Carbon::parse($product->created_at)->diffForHumans()); ?></p>
                </div>
            </div>
            <?php if($product->get_promoteAd && $product->get_promoteAd->get_adPackage): ?>
            <img src="<?php echo e(asset('upload/images/package/'.$product->get_promoteAd->get_adPackage->ribbon)); ?>">
            <?php endif; ?>
        </a>
        <div class="d-flex align-items-center bb2 rounded shadow mx-3">
            <input type="text" class="px-2 py-1 w-100 rounded" placeholder="Username">
            <button><img height="23" src="<?php echo e(asset('upload/images/chat2.png')); ?>"></button>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\bonik\resources\views/frontend/homepage/just-for-you.blade.php ENDPATH**/ ?>