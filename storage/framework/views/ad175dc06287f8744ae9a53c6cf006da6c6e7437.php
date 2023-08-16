<?php  
$products = App\Models\Product::with('get_brand')->where('status', 'active')->selectRaw('id,title,slug,price,category_id,state_id,views,sale_type, feature_image,created_at')->whereRaw('id IN (select MAX(id) FROM products GROUP BY subcategory_id)')->inRandomOrder()->take($section->item_number)->get(); 
?>
<?php if(count($products)>0): ?>
    <div id="carouselExampleControls" class="carousel slide bg-white w-100 rounded" data-ride="carousel" style="max-height: 382px;">
        <div class="carousel-inner">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="#" class="carousel-item <?php if($index==0): ?> active <?php endif; ?> ">
                    <img class="d-block rounded w-100 mh-300 lazyload" src="<?php echo e(asset('upload/images/default.jpg')); ?>" data-src="<?php echo e(asset('upload/images/product/'.$product->feature_image)); ?>" alt="<?php echo e($product->title); ?>">
                    <div class="position-absolute left-0 bottom-0 ml-4 w-250 rounded mb-4 bgs p-2">
                        <h4 class="text-white title"><?php echo e($product->title); ?></h4>
                        <div class="d-flex align-items-center">
                            <div class="d-flex align-items-center">
                                <b class="text-white pr-1"><?php echo e(Config::get('siteSetting.currency_symble')); ?>.</b>
                                <b class="yt py-1 mr-2"><?php echo e($product->price); ?></b>
                            </div>
                            <div class="d-flex align-items-center">
                                <img class="lazyload" src="<?php echo e(asset('upload/users/lavel1.png')); ?>">
                                <p class="text-white" title="Verified Bonik">Verified Bonik</p>
                            </div>
                            
                        </div>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <a class="position-absolute left-0 top-50 bg-white px-2 py-1" href="#carouselExampleControls" role="button" data-slide="prev">
            <img height="15" src="<?php echo e(asset('upload/images/a.png')); ?>">
        </a>
        <a class="position-absolute right-0 top-50 bg-white px-2 py-1" href="#carouselExampleControls" role="button" data-slide="next">
            <img height="15" class="transform-180" src="<?php echo e(asset('upload/images/a.png')); ?>">
        </a>
    </div>
<?php endif; ?>
<div class="yb py-2 px-2 mx-2 px-md-4 mx-md-4 rounded position-relative mt--4">
    <div class="d-flex align-items-center justify-content-md-between justify-content-around">
        <a href="#" class="d-flex align-items-center">
            <img width="35" height="35" class="lazyload mr-2" src="<?php echo e(asset('upload/images/m-1.png')); ?>">
            <p class="bt">Categories</p>
        </a>
        <a href="#" class="d-flex align-items-center">
            <img width="35" height="35" class="lazyload mr-1" src="<?php echo e(asset('upload/images/m-2.png')); ?>">
            <p class="bt">Location</p>
        </a>
        <a href="#" class="d-flex align-items-center">
            <img width="35" height="35" class="lazyload mr-1" src="<?php echo e(asset('upload/images/m-3.png')); ?>">
            <p class="bt">Filter</p>
        </a>
    </div>
</div><?php /**PATH C:\xampp\htdocs\bonik\resources\views/frontend/homepage/features-ads.blade.php ENDPATH**/ ?>