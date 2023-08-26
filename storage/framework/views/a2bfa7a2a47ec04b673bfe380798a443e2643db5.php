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

<style type="text/css">.mt-2 .bg-white{padding: 0.5rem!important}</style>
<?php if(count($products)>0): ?>

    <?php if(count($bannerAds)>0): ?>
        <div id="carouselExampleControls" class="carousel slide  w-100 rounded" data-ride="carousel" style="max-height: 382px;">
            <div class="carousel-inner">
                <?php $__currentLoopData = $bannerAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $bannerAd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="#" class="carousel-item <?php if($index==0): ?> active <?php endif; ?> ">
                        <img class="d-block rounded w-100 mh-300 lazyload" src="<?php echo e(asset('upload/images/product/default.jpg')); ?>" data-src="<?php echo e(asset('upload/images/product/'.$bannerAd->feature_image)); ?>" alt="<?php echo e($bannerAd->title); ?>">
                        <div class="position-absolute left-0 bottom-0 ml-4 w-250 rounded mb-4 bgs p-2">
                            <h4 class="text-white title"><?php echo e($bannerAd->title); ?></h4>
                            <div class="d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                    <b class="text-white pr-1"><?php echo e(Config::get('siteSetting.currency_symble')); ?>.</b>
                                    <b class="yt py-1 mr-2"><?php echo e($bannerAd->price); ?></b>
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
            <a class="position-absolute left-0 top-50  px-2 py-1" href="#carouselExampleControls" role="button" data-slide="prev">
                <img height="15" src="<?php echo e(asset('upload/images/a.png')); ?>">
            </a>
            <a class="position-absolute right-0 top-50  px-2 py-1" href="#carouselExampleControls" role="button" data-slide="next">
                <img height="15" class="transform-180" src="<?php echo e(asset('upload/images/a.png')); ?>">
            </a>
        </div>
    <?php endif; ?>

    <div class="yb py-2 px-2 mx-2 px-md-4 mx-md-4 rounded position-relative <?php if(count($bannerAds)>0): ?> mt--4 <?php endif; ?>">
        <div class="d-flex align-items-center justify-content-md-between justify-content-around">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#selectcatmodal" class="d-flex align-items-center">
                <img width="35" height="35" class="lazyload mr-2" src="<?php echo e(asset('upload/images/m-1.png')); ?>">
                <p class="bt">  <?php if($category): ?> <?php echo e($category->name); ?> <?php else: ?> Categories <?php endif; ?>
                </p>
            </a>
            <a href="javascript:void(0)" data-toggle="modal" data-target="#locationmodal" class="d-flex align-items-center">
                <img width="35" height="35" class="lazyload mr-1" src="<?php echo e(asset('upload/images/m-2.png')); ?>">
                <p class="bt"><?php if($state): ?> <?php echo e($state->name); ?> <?php else: ?> Location <?php endif; ?></p>
            </a>
            <?php if(!(new \Jenssegers\Agent\Agent())->isDesktop()): ?>
            <a href="javascript:void(0)" class="d-flex align-items-center filterBtn open-filter btn btn-block">
                <img width="35" height="35" class="lazyload mr-1" src="<?php echo e(asset('upload/images/m-3.png')); ?>">
                <p class="bt">Filter</p>
            </a><?php endif; ?>
        </div>
    </div>

    
    <p style="margin: 5px 0; "> (<?php echo e(($products ?  $products->total() : '0') + count($pinAds) + count($urgentAds) + count($highlightAds) + count($fastAds)); ?>  ) ads found <?php echo e(Request::get('q')); ?> </p>
        
    <div class="row mt-2">
    <?php if(count($pinAds)>0): ?>
        <?php $__currentLoopData = $pinAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pinAd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-12 col-sm-6 w-100  p-2 ">
            <a class="w-100 bg-white" href="<?php echo e(route('post_details', $pinAd->slug)); ?>">
                <div class="position-relative">
                    <div class="d-flex align-items-center position-absolute left-0 top-0 ">
                        <div class="yb bt px-3 font-weight-bold"><?php echo e(($pinAd->sale_type) ? $pinAd->sale_type : $pinAd->post_type); ?></div>
                        <div class="ff"></div>
                    </div>
                   
                    <img class="lazyload w-100 mh-300" src="<?php echo e(asset('upload/images/product/thumb/default.jpg')); ?>" data-src="<?php echo e(asset('upload/images/product/'.$pinAd->feature_image)); ?>" alt="<?php echo e($pinAd->title); ?>">
                </div>
                <div class="">
                    <h4 class="font-weight-bold bt py-1 title" title="<?php echo e($pinAd->title); ?>"><?php echo e($pinAd->title); ?></h4>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="d-flex align-items-center">
                                <img class="lazyload" src="<?php echo e(asset('upload/users/lavel1.png')); ?>">
                                <p class="bt" title="Verified Bonik">Verified Bonik</p>
                            </div>
                            <p class="bt py-1" title="<?php echo e($pinAd->get_state->name ?? ''); ?>"><?php echo e($pinAd->get_state->name ?? ''); ?></p>
                        </div>
                        <?php if($pinAd->ribbon): ?>
                        <div>
                            <img class="lazyload" src="<?php echo e(asset('upload/images/package/'.$pinAd->ribbon)); ?>">
                        </div><?php endif; ?>
                    </div>
                    
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="font-weight-bold bt py-1"><?php echo e(Config::get('siteSetting.currency_symble') .' '. number_format($pinAd->price)); ?></h4>
                        <p class="bt py-1"><?php echo e(Carbon\Carbon::parse($pinAd->approved ? $pinAd->approved : $pinAd->created_at)->diffForHumans()); ?></p>
                    </div>
                </div>
                
            </a>
            <div class="bg-white">
                <form action="<?php echo e(route('user.sendMessage')); ?>?send=direct" method="post" class="d-flex align-items-center bb2 rounded shadow mx-3">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="productOrConId" value="<?php echo e($pinAd->id); ?>">
                <input type="text" name="message" id="message<?php echo e($pinAd->id); ?>" class="px-2 py-1 w-100 rounded" placeholder="Send message">
                <button <?php if(Auth::check()): ?> onclick="sendMessage(<?php echo e($pinAd->id); ?>)" <?php else: ?> data-target="#so_sociallogin" data-toggle="modal" <?php endif; ?> type="button"><img height="23" src="<?php echo e(asset('upload/images/chat2.png')); ?>"></button>
                </form>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <?php if($index == 5): ?>
    
        <?php $__currentLoopData = $urgentAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $urgentAd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-12 col-sm-6 w-100  p-2 ">
            <a class="w-100 bg-white" href="<?php echo e(route('post_details', $urgentAd->slug)); ?>">
                <div class="position-relative">
                    <div class="d-flex align-items-center position-absolute left-0 top-0 ">
                        <div class="yb bt px-3 font-weight-bold"><?php echo e(($urgentAd->sale_type) ? $urgentAd->sale_type : $urgentAd->post_type); ?></div>
                        <div class="ff"></div>
                    </div>
                    <?php if($urgentAd->ribbon): ?>
                    <img class="position-absolute right-0 top-0 lazyload" src="<?php echo e(asset('upload/images/package/'.$urgentAd->ribbon)); ?>"><?php endif; ?>
                    <img class="lazyload w-100 mh-300" src="<?php echo e(asset('upload/images/product/thumb/default.jpg')); ?>" data-src="<?php echo e(asset('upload/images/product/'.$urgentAd->feature_image)); ?>" alt="<?php echo e($urgentAd->title); ?>">
                </div>
                <div class="">
                    <h4 class="font-weight-bold bt py-1 title" title="<?php echo e($urgentAd->title); ?>">Urgent <?php echo e($urgentAd->title); ?></h4>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="d-flex align-items-center">
                                <img class="lazyload" src="<?php echo e(asset('upload/users/lavel1.png')); ?>">
                                <p class="bt" title="Verified Bonik">Verified Bonik</p>
                            </div>
                            <p class="bt py-1" title="<?php echo e($urgentAd->state_name); ?>"><?php echo e($urgentAd->state_name); ?></p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="font-weight-bold bt py-1"><?php echo e(Config::get('siteSetting.currency_symble') .' '. number_format($urgentAd->price)); ?></h4>
                        <p class="bt py-1"><?php echo e(Carbon\Carbon::parse($urgentAd->approved ? $urgentAd->approved : $urgentAd->created_at)->diffForHumans()); ?></p>
                    </div>
                </div>
            </a>
            <div class="bg-white">
                <form action="<?php echo e(route('user.sendMessage')); ?>?send=direct" method="post" class="d-flex align-items-center bb2 rounded shadow mx-3">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="productOrConId" value="<?php echo e($urgentAd->id); ?>">
                <input type="text" name="message" id="message<?php echo e($urgentAd->id); ?>" class="px-2 py-1 w-100 rounded" placeholder="Send message">
                <button <?php if(Auth::check()): ?> onclick="sendMessage(<?php echo e($urgentAd->id); ?>)" <?php else: ?> data-target="#so_sociallogin" data-toggle="modal" <?php endif; ?> type="button"><img height="23" src="<?php echo e(asset('upload/images/chat2.png')); ?>"></button>
                </form>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php elseif($index == 10): ?>
   
        <?php $__currentLoopData = $highlightAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $highlightAd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-12 col-sm-6 w-100  p-2 ">
            <a class="w-100 bg-white" href="<?php echo e(route('post_details', $highlightAd->slug)); ?>">
                <div class="position-relative">
                    <div class="d-flex align-items-center position-absolute left-0 top-0 ">
                        <div class="yb bt px-3 font-weight-bold"><?php echo e(($highlightAd->sale_type) ? $highlightAd->sale_type : $highlightAd->post_type); ?></div>
                        <div class="ff"></div>
                    </div>
                    <?php if($highlightAd->ribbon): ?>
                    <img class="position-absolute right-0 top-0 lazyload" src="<?php echo e(asset('upload/images/package/'.$highlightAd->ribbon)); ?>"><?php endif; ?>
                    <img class="lazyload w-100 mh-300" src="<?php echo e(asset('upload/images/product/thumb/default.jpg')); ?>" data-src="<?php echo e(asset('upload/images/product/'.$highlightAd->feature_image)); ?>" alt="<?php echo e($highlightAd->title); ?>">
                </div>
                <div class="">
                    <h4 class="font-weight-bold bt py-1 title" title="<?php echo e($highlightAd->title); ?>"><?php echo e($highlightAd->title); ?></h4>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="d-flex align-items-center">
                                <img class="lazyload" src="<?php echo e(asset('upload/users/lavel1.png')); ?>">
                                <p class="bt" title="Verified Bonik">Verified Bonik</p>
                            </div>
                            <p class="bt py-1" title="<?php echo e($highlightAd->state_name); ?>"><?php echo e($highlightAd->state_name); ?></p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="font-weight-bold bt py-1"><?php echo e(Config::get('siteSetting.currency_symble') .' '. number_format($highlightAd->price)); ?></h4>
                        <p class="bt py-1"><?php echo e(Carbon\Carbon::parse($highlightAd->approved ? $highlightAd->approved : $highlightAd->created_at)->diffForHumans()); ?></p>
                    </div>
                </div>
            </a>
            <div class="bg-white">
                <form action="<?php echo e(route('user.sendMessage')); ?>?send=direct" method="post" class="d-flex align-items-center bb2 rounded shadow mx-3">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="productOrConId" value="<?php echo e($highlightAd->id); ?>">
                <input type="text" name="message" id="message<?php echo e($highlightAd->id); ?>" class="px-2 py-1 w-100 rounded" placeholder="Send message">
                <button <?php if(Auth::check()): ?> onclick="sendMessage(<?php echo e($highlightAd->id); ?>)" <?php else: ?> data-target="#so_sociallogin" data-toggle="modal" <?php endif; ?> type="button"><img height="23" src="<?php echo e(asset('upload/images/chat2.png')); ?>"></button>
                </form>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php $__currentLoopData = $fastAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fastAd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-12 col-sm-6 w-100  p-2 ">
            <a class="w-100 bg-white" href="<?php echo e(route('post_details', $fastAd->slug)); ?>">
                <div class="position-relative">
                    <div class="d-flex align-items-center position-absolute left-0 top-0 ">
                        <div class="yb bt px-3 font-weight-bold"><?php echo e(($fastAd->sale_type) ? $fastAd->sale_type : $fastAd->post_type); ?></div>
                        <div class="ff"></div>
                    </div>
                    <?php if($fastAd->ribbon): ?>
                    <img class="position-absolute right-0 top-0 lazyload" src="<?php echo e(asset('upload/images/package/'.$fastAd->ribbon)); ?>"><?php endif; ?>
                    <img class="lazyload w-100 mh-300" src="<?php echo e(asset('upload/images/product/thumb/default.jpg')); ?>" data-src="<?php echo e(asset('upload/images/product/'.$fastAd->feature_image)); ?>" alt="<?php echo e($fastAd->title); ?>">
                </div>
                <div class="">
                    <h4 class="font-weight-bold bt py-1 title" title="<?php echo e($fastAd->title); ?>"><?php echo e($fastAd->title); ?></h4>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="d-flex align-items-center">
                                <img class="lazyload" src="<?php echo e(asset('upload/users/lavel1.png')); ?>">
                                <p class="bt" title="Verified Bonik">Verified Bonik</p>
                            </div>
                            <p class="bt py-1" title="<?php echo e($fastAd->state_name); ?>"><?php echo e($fastAd->state_name); ?></p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="font-weight-bold bt py-1"><?php echo e(Config::get('siteSetting.currency_symble') .' '. number_format($fastAd->price)); ?></h4>
                        <p class="bt py-1"><?php echo e(Carbon\Carbon::parse($fastAd->approved ? $fastAd->approved : $fastAd->created_at)->diffForHumans()); ?></p>
                    </div>
                </div>
            </a>
            <div class="bg-white">
                <form action="<?php echo e(route('user.sendMessage')); ?>?send=direct" method="post" class="d-flex align-items-center bb2 rounded shadow mx-3">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="productOrConId" value="<?php echo e($fastAd->id); ?>">
                <input type="text" name="message" id="message<?php echo e($fastAd->id); ?>" class="px-2 py-1 w-100 rounded" placeholder="Send message">
                <button <?php if(Auth::check()): ?> onclick="sendMessage(<?php echo e($fastAd->id); ?>)" <?php else: ?> data-target="#so_sociallogin" data-toggle="modal" <?php endif; ?> type="button"><img height="23" src="<?php echo e(asset('upload/images/chat2.png')); ?>"></button>
                </form>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>

    <?php endif; ?>
        <div class="col-12 col-sm-6 w-100  p-2 ">
            <a class="w-100 bg-white" href="<?php echo e(route('post_details', $product->slug)); ?>">
                <div class="position-relative">
                    <div class="d-flex align-items-center position-absolute left-0 top-0 ">
                        <div class="yb bt px-3 font-weight-bold"><?php echo e(($product->sale_type) ? $product->sale_type : $product->post_type); ?></div>
                        <div class="ff"></div>
                    </div>
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
                    </div>
                    
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="font-weight-bold bt py-1"><?php echo e(Config::get('siteSetting.currency_symble') .' '. number_format($product->price)); ?></h4>
                        <p class="bt py-1"><?php echo e(Carbon\Carbon::parse($product->approved ? $product->approved : $product->created_at)->diffForHumans()); ?></p>
                    </div>
                </div>
            </a>
            <div class="bg-white">
                <form action="<?php echo e(route('user.sendMessage')); ?>?send=direct" method="post" class="d-flex align-items-center bb2 rounded shadow mx-3">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="productOrConId" value="<?php echo e($product->id); ?>">
                <input type="text" name="message" id="message<?php echo e($product->id); ?>" class="px-2 py-1 w-100 rounded" placeholder="Send message">
                <button <?php if(Auth::check()): ?> onclick="sendMessage(<?php echo e($product->id); ?>)" <?php else: ?> data-target="#so_sociallogin" data-toggle="modal" <?php endif; ?> type="button"><img height="23" src="<?php echo e(asset('upload/images/chat2.png')); ?>"></button>
                </form>
            </div>
        </div>
   
        <?php if($index == 4 && count($link_ads) > 0): ?>
        <!-- //google ad or mobile -->
        <div class="col-12 col-sm-6 w-100  p-2 ">
            <a  href="<?php echo e($link_ads[0]['redirect_url']); ?>"><img class="w-100" src="<?php echo e(asset('upload/marketing/'.$link_ads[0]['image'])); ?>" alt=""></a>
        </div>
        <?php endif; ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <div class="col-12">
        <div class="advertising">
        <?php echo $bottomOfContent; ?>

        </div>
    </div>

    <div class="col-lg-12">
        <div class="footer-pagection">
            <?php echo e($products->appends(request()->query())->links()); ?>

           
        </div>
    </div>
    
</div>

<?php else: ?>

    <div class="yb py-2 px-2 mx-2 px-md-4 mx-md-4 rounded position-relative" style="margin:5px 0">
        <div class="d-flex align-items-center justify-content-md-between justify-content-around">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#selectcatmodal" class="d-flex align-items-center">
                <img width="35" height="35" class="lazyload mr-2" src="<?php echo e(asset('upload/images/m-1.png')); ?>">
                <p class="bt">  <?php if($category): ?> <?php echo e($category->name); ?> <?php else: ?> Categories <?php endif; ?>
                </p>
            </a>
            <a href="javascript:void(0)" data-toggle="modal" data-target="#locationmodal" class="d-flex align-items-center">
                <img width="35" height="35" class="lazyload mr-1" src="<?php echo e(asset('upload/images/m-2.png')); ?>">
                <p class="bt"><?php if($state): ?> <?php echo e($state->name); ?> <?php else: ?> Location <?php endif; ?></p>
            </a>
            <?php if(!(new \Jenssegers\Agent\Agent())->isDesktop()): ?>
            <a href="javascript:void(0)" class="d-flex align-items-center filterBtn open-filter btn btn-block">
                <img width="35" height="35" class="lazyload mr-1" src="<?php echo e(asset('upload/images/m-3.png')); ?>">
                <p class="bt">Filter</p>
            </a><?php endif; ?>
        </div>
    </div>

    <div style="text-align: center;">
        <h3>Search Result Not Found.</h3>
        <p>We're sorry. We cannot find any matches for your search term</p>
        <i style="font-size: 10rem;" class="fa fa-search"></i>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\bonik\resources\views/frontend/post-filter.blade.php ENDPATH**/ ?>