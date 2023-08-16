<?php
$products = App\Models\Product::with(['get_promoteAd.get_adPackage', 'wishlist'])->where('status', 'active')
->selectRaw('id,title,slug,price,category_id,state_id,views,sale_type, feature_image,created_at')->orderBy('id', 'desc')->take($section->item_number)->get(); 
?>
<?php if(count($products)>0): ?>
<section class="section" <?php if($section->layout_width == 1): ?> style="background:<?php echo e($section->background_color); ?>" <?php endif; ?>>
  <div class="container" <?php if($section->layout_width != 1): ?> style="background:<?php echo e($section->background_color); ?>;border-radius: 5px;" <?php endif; ?>>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background:<?php echo e($section->text_bg); ?>;margin: 0; padding: 0; display: flex;justify-content: space-between;align-items: center;">
      <h4 style="color:<?php echo e($section->text_color); ?>;margin: 0;"><?php echo e($section->title); ?></h4>
      
    </div>
    <div class="row">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-6 col-md-2">
                    <div class="product-card">
                    <a  style="width: 100%" href="<?php echo e(route('post_details', $product->slug)); ?>">
                    <div class="product-media">
                        <div class="product-img">
                            <img class="lazyload" src="<?php echo e(asset('upload/images/product/thumb/default.jpg')); ?>" data-src="<?php echo e(asset('upload/images/product/thumb/'.$product->feature_image)); ?>" alt="<?php echo e($product->title); ?>">
                        </div>
                    </div>
                    </a>
                    <div class="product-content">
                        <a style="width: 100%; color:<?php echo e($section->text_color); ?>" href="<?php echo e(route('post_details', $product->slug)); ?>">
                        
                        <h5 class="product-title">
                           <?php echo e(Str::limit($product->title, 40)); ?>

                        </h5>
                        <div class="product-meta">
                            <span><i class="fas fa-map-marker-alt"></i><?php echo e($product->get_state->name ?? ''); ?></span><br>
                            <span><i class="fas fa-clock"></i><?php echo e(Carbon\Carbon::parse($product->created_at)->diffForHumans()); ?></span>
                        </div>
                        </a>
                        <div class="product-info">
                            <h5 class="product-price"><?php echo e(Config::get('siteSetting.currency_symble') .' '. number_format($product->price)); ?><?php if($product->negotiable == 1): ?><small>/negotiable</small> <?php endif; ?></h5>
                            <div class="product-btn">
                                
                                <button type="button" title="Wishlist" <?php if(Auth::check()): ?> onclick="addToWishlist(<?php echo e($product->id); ?>)" data-toggle="tooltip" <?php else: ?> data-toggle="modal" data-target="#so_sociallogin" <?php endif; ?> class="far fa-heart <?php if($product->wishlist): ?> fas <?php endif; ?>"></button>
                            </div>
                        </div>
                    </div>
                    <?php if($product->get_promoteAd && $product->get_promoteAd->get_adPackage): ?>
                    <span style="position:absolute;top: 6px;left: 11px;width: 95px;"><img style="width:100%" src="<?php echo e(asset('upload/images/package/'.$product->get_promoteAd->get_adPackage->ribbon)); ?>"></span><?php endif; ?>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
      
  </div>
</section>


<?php endif; ?><?php /**PATH C:\xampp\htdocs\jotesto\resources\views/frontend/homepage/just-for-you.blade.php ENDPATH**/ ?>