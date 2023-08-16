<?php
$topOfContent = $middleOfContent = $bottomOfContent = $sitebarTop = $sitebarMiddle = $sitebarBottom = null ;
foreach ($get_ads as $ads){
    if($ads->position == 'top-content'){
        $topOfContent = ($ads->adsType == 'image') ? '<a  href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code;
    }elseif($ads->position == 'middle-content'){
        $middleOfContent = ($ads->adsType == 'image') ? '<a  href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code;
    }elseif($ads->position == 'bottom-content'){
        $bottomOfContent = ($ads->adsType == 'image') ? '<a  href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code;
    }else{
        echo '';
    }
}
?>
<?php if(count($products)>0): ?>
<div class="row">
    <div class="col-lg-12">
        <p style="margin-bottom: 5px;">(<?php echo e(($products ?  $products->total() : '0') + count($featureAds) + count($topUpAds)); ?>  ) ads found <?php echo e(Request::get('q')); ?> </p>
    </div>
</div>
<?php if(count($spotlights)>0): ?>
<div class="row">
    <div class="col-lg-12 spotlight">
        <div class="ad-feature-slider slider-arrow" >
            <?php $__currentLoopData = $spotlights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $spotlight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="feature-card" >
                <a style="display: block;" href="<?php echo e(route('post_details', $spotlight->get_adPost->slug)); ?>">
                <img class="lazyload" style="max-height:<?php if((new \Jenssegers\Agent\Agent())->isDesktop()): ?> 350px; <?php else: ?> 250px; <?php endif; ?> height: 100%" src="<?php echo e(asset('upload/images/product/default.jpg')); ?>"  data-src="<?php echo e(asset('upload/images/product/'. $spotlight->get_adPost->feature_image)); ?>" alt="<?php echo e($spotlight->get_adPost->title); ?>">
                <div class="feature-content">
                   
                    <h3 class="feature-title"><?php echo e(Str::limit($spotlight->get_adPost->title, 60)); ?></h3>
                    <div class="feature-meta">
                        <?php if($spotlight->get_adPost->price > 0): ?>
                            <span class="feature-price"><?php echo e(Config::get('siteSetting.currency_symble')  .' '. number_format($spotlight->get_adPost->price)); ?></span>
                        <?php else: ?>
                            <span class="feature-price">Ask For Price</span>
                        <?php endif; ?>
                        <span class="feature-time"><i class="fas fa-clock"></i><?php echo e(Carbon\Carbon::parse($spotlight->get_adPost->approved)->diffForHumans()); ?></span>
                    </div>
                </div>
                </a>
                <button type="button" <?php if(Auth::check()): ?> onclick="addToWishlist(<?php echo e($spotlight->get_adPost->id); ?>)" data-toggle="tooltip" <?php else: ?> data-toggle="modal" data-target="#so_sociallogin" <?php endif; ?> class="feature-wish <?php if($spotlight->get_adPost->wishlist): ?> active <?php endif; ?>">
                    <i class="fas fa-heart"></i>
                </button>

                <?php if($spotlight->get_adPackage): ?>
                <span style="position:absolute;top: 5px;left: -4px;"><img style="width:90px" src="<?php echo e(asset('upload/images/package/'.$spotlight->get_adPackage->ribbon)); ?>"></span><?php endif; ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="row">
    <?php $__currentLoopData = $urgentAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $urgentAd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div style="padding:3px 8px;" class="col-12">
        <div class="product-card standard"  style="border: 3px solid <?php echo e($urgentAd->get_adPackage->border_color); ?>;">
            <a href="<?php echo e(route('post_details', $urgentAd->get_adPost->slug)); ?>">
            <div class="product-media" <?php if($urgentAd->user->verify): ?> id="verify-seller" <?php endif; ?>>
                <div class="product-img" >
                    <img class="lazyload" src="<?php echo e(asset('upload/images/product/thumb/default.jpg')); ?>" data-src="<?php echo e(asset('upload/images/product/thumb/'. $urgentAd->get_adPost->feature_image)); ?>" alt="<?php echo e($urgentAd->get_adPost->title); ?>">
                </div>

            </div></a>
            <div class="product-content">
                <a href="<?php echo e(route('post_details', $urgentAd->get_adPost->slug)); ?>">
                <h5 class="product-title">
                    <?php echo e(Str::limit(ucfirst($urgentAd->get_adPost->title), 60)); ?>

                </h5>
                <?php if($urgentAd->user && $urgentAd->user->verify): ?>
                <p style="color: #11b76b;font-size: 10px;font-weight: 500;"><img src="https://icon-library.com/images/verified-icon-png/verified-icon-png-11.jpg" width="18" height="16"> VERIFIED SELLER</p>
                <?php endif; ?>
                <div class="product-meta">
                    <span><i class="fas fa-map-marker-alt"></i> <?php echo e($urgentAd->get_adPost->get_state->name ?? ''); ?></span>
                    <span><i class="fas fa-clock"></i> <?php echo e(Carbon\Carbon::parse(($urgentAd->get_adPost->approved ? $urgentAd->get_adPost->approved : $urgentAd->get_adPost->created_at))->diffForHumans()); ?></span>
                </div></a>
                <div class="product-info">
                    <?php if($urgentAd->get_adPost->price > 0): ?>
                        <h5 class="product-price"><?php echo e(Config::get('siteSetting.currency_symble') .' '. number_format($urgentAd->get_adPost->price)); ?><span></span></h5>
                    <?php else: ?>
                        <h5 class="product-price">Ask For Price<span></span></h5>
                    <?php endif; ?>
                    <div class="product-btn">

                        <button type="button" title="Wishlist" <?php if(Auth::check()): ?> onclick="addToWishlist(<?php echo e($urgentAd->get_adPost->id); ?>)" data-toggle="tooltip" <?php else: ?> data-toggle="modal" data-target="#so_sociallogin" <?php endif; ?> class="far fa-heart <?php if($urgentAd->get_adPost->wishlist): ?> fas <?php endif; ?>"></button>
                    </div>
                </div>
            </div>
            <?php if($urgentAd->get_adPackage): ?>
            <?php $ribon = explode('-',$urgentAd->get_adPackage->ribbon_position); ?>
            <span style="position:absolute;top: 0px;left: 0px;width: 95px;"><img style="width:100%" src="<?php echo e(asset('upload/images/package/'.$urgentAd->get_adPackage->ribbon)); ?>"></span><?php endif; ?>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php $__currentLoopData = $featureAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $featureAd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($index < 3): ?>
    <div style="padding:3px 8px;" class="col-12">
        <div class="product-card standard"  style=" border: 3px solid <?php echo e($featureAd->get_adPackage->border_color); ?>;">
            <a href="<?php echo e(route('post_details', $featureAd->get_adPost->slug)); ?>">
            <div class="product-media" <?php if($featureAd->user->verify): ?> id="verify-seller" <?php endif; ?>>
                <div class="product-img">
                    <img class="lazyload" src="<?php echo e(asset('upload/images/product/thumb/default.jpg')); ?>" data-src="<?php echo e(asset('upload/images/product/thumb/'. $featureAd->get_adPost->feature_image)); ?>" alt="<?php echo e($featureAd->get_adPost->title); ?>">
                </div>
            </div></a>
            <div class="product-content">
                <a href="<?php echo e(route('post_details', $featureAd->get_adPost->slug)); ?>">
                <h5 class="product-title">
                    <?php echo e(Str::limit(ucfirst($featureAd->get_adPost->title), 60)); ?>

                </h5>
                <?php if($featureAd->user->verify): ?>
                <p style="color: #11b76b;font-size: 10px;font-weight: 500;"><img src="https://icon-library.com/images/verified-icon-png/verified-icon-png-11.jpg" width="18" height="16"> VERIFIED SELLER</p>
                <?php endif; ?>

                <div class="product-meta">
                    <span><i class="fas fa-map-marker-alt"></i> <?php echo e($featureAd->get_adPost->get_state->name ?? ''); ?></span>
                    <span><i class="fas fa-clock"></i>Just now</span>
                </div></a>
                <div class="product-info">
                    <?php if($featureAd->get_adPost->price > 0): ?>
                        <h5 class="product-price"><?php echo e(Config::get('siteSetting.currency_symble') .' '. number_format($featureAd->get_adPost->price)); ?><span></span></h5>
                    <?php else: ?>
                        <h5 class="product-price">Ask For Price<span></span></h5>
                    <?php endif; ?>
                    <div class="product-btn">
                        <button type="button" title="Wishlist" <?php if(Auth::check()): ?> onclick="addToWishlist(<?php echo e($featureAd->get_adPost->id); ?>)" data-toggle="tooltip" <?php else: ?> data-toggle="modal" data-target="#so_sociallogin" <?php endif; ?> class="far fa-heart <?php if($urgentAd->get_adPost->wishlist): ?> fas <?php endif; ?>"></button>
                    </div>
                </div>
            </div>
            <?php if($featureAd->get_adPackage): ?>
            <?php $ribon = explode('-',$featureAd->get_adPackage->ribbon_position); ?>
            <span style="position:absolute;top: 0px;left: 0px;width: 95px;"><img style="width:100%" src="<?php echo e(asset('upload/images/package/'.$featureAd->get_adPackage->ribbon)); ?>"></span><?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php $__currentLoopData = $topUpAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topUpAd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div style="padding:3px 8px;" class="col-12">
        <div class="product-card standard"  style="border: 3px solid <?php echo e($topUpAd->get_adPackage->border_color); ?>;">
            <a href="<?php echo e(route('post_details', $topUpAd->get_adPost->slug)); ?>">
            <div class="product-media" <?php if($topUpAd->user->verify): ?> id="verify-seller" <?php endif; ?>>
                <div class="product-img" >
                    <img class="lazyload" src="<?php echo e(asset('upload/images/product/thumb/default.jpg')); ?>" data-src="<?php echo e(asset('upload/images/product/thumb/'. $topUpAd->get_adPost->feature_image)); ?>" alt="<?php echo e($topUpAd->get_adPost->title); ?>">
                </div>

            </div></a>
            <div class="product-content">
                <a href="<?php echo e(route('post_details', $topUpAd->get_adPost->slug)); ?>">
                <h5 class="product-title">
                    <?php echo e(Str::limit(ucfirst($topUpAd->get_adPost->title), 60)); ?>

                </h5>
                <?php if($topUpAd->user && $topUpAd->user->verify): ?>
                <p style="color: #11b76b;font-size: 10px;font-weight: 500;"><img src="https://icon-library.com/images/verified-icon-png/verified-icon-png-11.jpg" width="18" height="16"> VERIFIED SELLER</p>
                <?php endif; ?>
                <div class="product-meta">
                    <span><i class="fas fa-map-marker-alt"></i> <?php echo e($topUpAd->get_adPost->get_state->name ?? ''); ?></span>
                    <span><i class="fas fa-clock"></i>Just now</span>
                </div></a>
                <div class="product-info">
                    <?php if($topUpAd->get_adPost->price > 0): ?>
                        <h5 class="product-price"><?php echo e(Config::get('siteSetting.currency_symble') .' '. number_format($topUpAd->get_adPost->price)); ?><span></span></h5>
                    <?php else: ?>
                        <h5 class="product-price">Ask For Price<span></span></h5>
                    <?php endif; ?>
                    <div class="product-btn">

                        <button type="button" title="Wishlist" <?php if(Auth::check()): ?> onclick="addToWishlist(<?php echo e($topUpAd->get_adPost->id); ?>)" data-toggle="tooltip" <?php else: ?> data-toggle="modal" data-target="#so_sociallogin" <?php endif; ?> class="far fa-heart <?php if($topUpAd->get_adPost->wishlist): ?> fas <?php endif; ?> "></button>
                    </div>
                </div>
            </div>
            <?php if($topUpAd->get_adPackage): ?>
            <?php $ribon = explode('-',$topUpAd->get_adPackage->ribbon_position); ?>
            <span style="position:absolute;top: 0px;left: 0px;width: 95px;"><img style="width:100%" src="<?php echo e(asset('upload/images/package/'.$topUpAd->get_adPackage->ribbon)); ?>"></span><?php endif; ?>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div style="padding:3px 8px;" class="col-12">
        <div class="product-card standard">
            <a href="<?php echo e(route('post_details', $product->slug)); ?>">
            <div class="product-media" <?php if($product->author && $product->author->verify): ?> id="verify-seller" <?php endif; ?>>
                <div class="product-img">
                    <img class="lazyload" src="<?php echo e(asset('upload/images/product/thumb/default.jpg')); ?>" data-src="<?php echo e(asset('upload/images/product/thumb/'.$product->feature_image)); ?>" alt="<?php echo e($product->title); ?>">
                </div>
            </div></a>
            <div class="product-content">
                <a href="<?php echo e(route('post_details', $product->slug)); ?>">
                <h5 class="product-title">
                   <?php echo e(Str::limit(ucfirst($product->title), 60)); ?>

                </h5>
                <?php if($product->author && $product->author->verify): ?>
                <p style="color: #11b76b;font-size: 10px;font-weight: 500;"><img src="https://icon-library.com/images/verified-icon-png/verified-icon-png-11.jpg" width="18" height="16"> VERIFIED SELLER</p>
                <?php endif; ?>
                <div class="product-meta">
                    <span><i class="fas fa-map-marker-alt"></i> <?php echo e($product->get_state->name ?? ''); ?></span>

                    <span><i class="fas fa-clock"></i><?php echo e(Carbon\Carbon::parse(($product->approved ? $product->approved : $product->created_at))->diffForHumans()); ?></span>
                </div></a>
                <div class="product-info">

                    <?php if($product->price > 0): ?>
                        <h5 class="product-price"><?php echo e(Config::get('siteSetting.currency_symble') .' '. number_format($product->price)); ?><span></span></h5>
                    <?php else: ?>
                        <h5 class="product-price">Ask For Price<span></span></h5>
                    <?php endif; ?>
                    <div class="product-btn">

                        <button type="button" title="Wishlist" <?php if(Auth::check()): ?> onclick="addToWishlist(<?php echo e($product->id); ?>)" data-toggle="tooltip" <?php else: ?> data-toggle="modal" data-target="#so_sociallogin" <?php endif; ?> class="far fa-heart <?php if($product->wishlist): ?> fas <?php endif; ?>"></button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php if($products && $index > 2 && $index == (count($products)/2)): ?>
    <div style="padding:3px 8px;" class="col-12 advertising">
    <?php echo $middleOfContent; ?>

    </div>
    <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php if(count($featureAds)>3): ?>
        <?php $__currentLoopData = $featureAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $featureAd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($index >= 3): ?>
        <div style="padding:3px 8px;" class="col-12">
            <div class="product-card standard"  style=" border: 3px solid <?php echo e($featureAd->get_adPackage->border_color); ?>;">
                <a href="<?php echo e(route('post_details', $featureAd->get_adPost->slug)); ?>">
                <div class="product-media" <?php if($featureAd->user && $featureAd->user->verify): ?> id="verify-seller" <?php endif; ?>>
                    <div class="product-img">
                        <img class="lazyload" src="<?php echo e(asset('upload/images/product/thumb/default.jpg')); ?>" data-src="<?php echo e(asset('upload/images/product/thumb/'. $featureAd->get_adPost->feature_image)); ?>" alt="<?php echo e($featureAd->get_adPost->title); ?>">
                    </div>

                </div></a>
                <div class="product-content">
                    <a href="<?php echo e(route('post_details', $featureAd->get_adPost->slug)); ?>">
                    <h5 class="product-title">
                        <?php echo e(Str::limit(ucfirst($featureAd->get_adPost->title), 60)); ?>

                    </h5>
                    <?php if($featureAd->user && $featureAd->user->verify): ?>
                    <p style="color: #11b76b;font-size: 10px;font-weight: 500;"><img src="https://icon-library.com/images/verified-icon-png/verified-icon-png-11.jpg" width="18" height="16"> VERIFIED SELLER</p>
                    <?php endif; ?>
                    <div class="product-meta">
                        <span><i class="fas fa-map-marker-alt"></i><?php echo e($featureAd->get_adPost->get_state->name ?? ''); ?></span>
                        <span><i class="fas fa-clock"></i>Just now</span>
                    </div></a>
                    <div class="product-info">
                        <?php if($featureAd->get_adPost->price > 0): ?>
                            <h5 class="product-price"><?php echo e(Config::get('siteSetting.currency_symble') .' '. number_format($featureAd->get_adPost->price)); ?><span></span></h5>
                        <?php else: ?>
                            <h5 class="product-price">Ask For Price<span></span></h5>
                        <?php endif; ?>
                        <div class="product-btn">

                            <button type="button" title="Wishlist" <?php if(Auth::check()): ?> onclick="addToWishlist(<?php echo e($featureAd->get_adPost->id); ?>)" data-toggle="tooltip" <?php else: ?> data-toggle="modal" data-target="#so_sociallogin" <?php endif; ?> class="far fa-heart <?php if($featureAd->get_adPost->wishlist): ?> fas <?php endif; ?>"></button>
                        </div>
                    </div>
                </div>
                <?php if($featureAd->get_adPackage): ?>
                <?php $ribon = explode('-',$featureAd->get_adPackage->ribbon_position); ?>
                <span style="position:absolute;top: 0px;left: 0px;width: 95px;"><img style="width:100%" src="<?php echo e(asset('upload/images/package/'.$featureAd->get_adPackage->ribbon)); ?>"></span><?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

    <?php if($products && count($products) >= 8): ?>
    <div style="padding:3px 8px;" class="col-12 advertising">
    <?php echo $bottomOfContent; ?>

    </div>
    <?php endif; ?>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="footer-pagection">
            <?php echo e($products->appends(request()->query())->links()); ?>

            <!-- <p>Showing <?php echo e($products->firstItem()); ?> to <?php echo e($products->lastItem()); ?> of total <?php echo e(($products ?  $products->total() : '0') + count($featureAds) + count($topUpAds)); ?> ads</p> -->
        </div>
    </div>
</div>

<?php else: ?>
<div style="text-align: center;">
    <h3>Search Result Not Found.</h3>
    <p>We're sorry. We cannot find any matches for your search term</p>
    <i style="font-size: 10rem;" class="fa fa-search"></i>
</div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\bikroy\resources\views/frontend/post-filter.blade.php ENDPATH**/ ?>