
<?php $__env->startSection('title', $post_detail->title.' | '.Config::get('siteSetting.title')); ?>
<?php $__env->startSection('metatag'); ?>
    <meta name="keywords" content="<?php echo e($post_detail->meta_keywords); ?>" />
    <meta name="title" content="<?php echo e(($post_detail->meta_title) ? $post_detail->meta_title : $post_detail->title); ?>" />
    <meta name="description" content="<?php echo strip_tags( ($post_detail->meta_description) ? $post_detail->meta_description : Str::limit($post_detail->description, 500)); ?>">
    <meta name="image" content="<?php echo e(asset('upload/images/product/'.$post_detail->feature_image)); ?>">
    <meta name="rating" content="5">
    <!-- Schema.org for Google -->
    <meta itemprop="name" content="<?php echo e(($post_detail->meta_title) ? $post_detail->meta_title : $post_detail->title); ?>">
    <meta itemprop="description" content="<?php echo strip_tags(($post_detail->meta_description) ? $post_detail->meta_description : Str::limit($post_detail->description, 500)); ?>">
    <meta itemprop="image" content="<?php echo e(asset('upload/images/product/'.$post_detail->feature_image)); ?>">
    <!-- Twitter -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="<?php echo e(($post_detail->meta_title) ? $post_detail->meta_title : $post_detail->title); ?>">
    <meta name="twitter:description" content="<?php echo strip_tags(($post_detail->meta_description) ? $post_detail->meta_description : Str::limit($post_detail->description, 500)); ?>">
    <meta name="twitter:site" content="<?php echo e(url()->full()); ?>">
    <meta name="twitter:creator" content="@neyamul">
    <meta name="twitter:image:src" content="<?php echo e(asset('upload/images/product/'.$post_detail->feature_image)); ?>">
    <meta name="twitter:player" content="#">
    <!-- Twitter - Product (e-commerce) -->
    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    <meta property="og:title" content="<?php echo e(($post_detail->meta_title) ? $post_detail->meta_title : $post_detail->title); ?>">
    <meta property="og:description" content="<?php echo strip_tags(($post_detail->meta_description) ? $post_detail->meta_description : Str::limit($post_detail->description, 500)); ?>">
    <meta property="og:image" content="<?php echo e(asset('upload/images/product/'.$post_detail->feature_image)); ?>">
    <meta property="og:url" content="<?php echo e(url()->full()); ?>">
    <meta property="og:site_name" content="<?php echo e(Config::get('siteSetting.site_name')); ?>">
    <meta property="og:locale" content="bd">
    <meta property="og:type" content="product">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('frontend')); ?>/css/custom/ad-details.css">
    <style type="text/css">
        .ad-thumb-slider img{max-height: 120px;}
        .share-list{display: flex;
    align-items: center;
    justify-content: center;
    justify-content: flex-start;}
    .share-list li{padding: 6px 12px; margin: 5px;
    background: #e1e1e1;
    border-radius: 50%;}
    </style>
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=618557cffcbbc300140e7592&product=sop' async='async'></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php
    $get_ads = App\Models\Addvertisement::whereIn('page', ['post', 'all'])->inRandomOrder()->where('status', 1)->get();

    $topOfContent = $middleOfContent = $bottomOfContent = $sitebarTop = $sitebarMiddle = $sitebarBottom = null ;
    foreach ($get_ads as $ads){
        if($ads->position == 'top-content'){
            $topOfContent = ($ads->adsType == 'image') ? '<a  href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code;
        }elseif($ads->position == 'middle-content'){
            $middleOfContent = ($ads->adsType == 'image') ? '<a  href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code;
        }elseif($ads->position == 'bottom-content'){
            $bottomOfContent = ($ads->adsType == 'image') ? '<a  href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code;
        }elseif($ads->position == 'sidebar-top'){
            $sitebarTop = '<div class="sidebar">'. ($ads->adsType == 'image' ? '<a  href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code) . '</div>';
        }elseif($ads->position == 'sidebar-middle'){
            $sitebarMiddle = '<div class="sidebar">'. ($ads->adsType == 'image' ? '<a  href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code) . '</div>';
        }elseif($ads->position == 'sidebar-bottom'){
            $sitebarBottom = '<div class="sidebar">'. ($ads->adsType == 'image' ? '<a href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code) . '</div>' ; 
        }else{
            echo '';
        }
    }
    ?>
    <div class="breadcrumbs">
        <div class="container">
          <ul class="breadcrumb-cate">
            <li><i class="fa fa-home"></i></li>
              <li><a href="<?php echo e(route('home.category', $post_detail->get_category->slug ?? '')); ?>"><?php echo e($post_detail->get_category->name ?? ''); ?></a></li>
              <?php if($post_detail->get_subcategory ?? false): ?>
              <li><a href="<?php echo e(route('home.category', [$post_detail->get_subcategory->slug])); ?>"><?php echo e($post_detail->get_subcategory->name); ?></a></li>
              <?php endif; ?>
              <?php if($post_detail->get_childcategory ?? false): ?>
              <!-- <li><a href="<?php echo e(route('home.category', [$post_detail->get_childcategory->slug])); ?>"><?php echo e($post_detail->get_childcategory->name); ?></a></li> -->
              <?php endif; ?>
              <li><?php echo e($post_detail->title); ?></li>
          </ul>
        </div>
    </div>
    <!--=====================================
    AD DETAILS PART START
    =======================================-->
    <section class="inner-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="advertising">
                        <?php echo $topOfContent; ?>

                    </div>
                    <!-- AD DETAILS CARD -->
                    <div class="common-card" style="padding:10px;overflow: hidden;">
                        
                        <div class="ad-details-slider-group">
                            <div class="ad-details-slider slider-arrow">
                                <div><img src="<?php echo e(asset('upload/images/product/'. $post_detail->feature_image)); ?>" alt="details"></div>
                                <?php $__currentLoopData = $post_detail->get_galleryImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div><img src="<?php echo e(asset('upload/images/product/gallery/'. $image->image_path)); ?>" alt="details"></div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            
                        </div>
                        <div class="ad-thumb-slider">
                            <div><img src="<?php echo e(asset('upload/images/product/thumb/'. $post_detail->feature_image)); ?>" alt="details"></div>
                            <?php $__currentLoopData = $post_detail->get_galleryImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div><img src="<?php echo e(asset('upload/images/product/gallery/'. $image->image_path)); ?>" alt="details"></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <h3 style="margin-bottom: 10px;"><?php echo e($post_detail->title); ?></h3>

                        
                        <p class="ad-details-address"><i class="fa fa-clock"></i> Posted on <?php echo e(Carbon\Carbon::parse(($post_detail->approved) ? $post_detail->approved : $post_detail->created_at)->format(Config::get('siteSetting.date_format'))); ?>, <?php echo e(\Carbon\Carbon::parse(($post_detail->approved) ? $post_detail->approved : $post_detail->created_at)->format('h:i A')); ?>


                        <?php if($post_detail->get_state): ?> <i style="padding-left: 20px" class="fa fa-map-marker-alt"></i>  <?php echo e($post_detail->get_state->name); ?> <?php endif; ?> <?php if($post_detail->get_city): ?>, <?php echo e($post_detail->get_city->name); ?> <?php endif; ?></p>
                        
                        
                        <div class="ad-details-action">
                            <button type="button" <?php if(Auth::check()): ?> onclick="addToWishlist(<?php echo e($post_detail->id); ?>)" data-toggle="tooltip" <?php else: ?> data-toggle="modal" data-target="#so_sociallogin" <?php endif; ?> class="wish"><i class="fa fa-heart"></i>bookmark</button>
                            <button type="button"  <?php if(Auth::check()): ?> onclick="report(<?php echo e($post_detail->id); ?>)" data-toggle="tooltip" <?php else: ?> data-toggle="modal" data-target="#so_sociallogin" <?php endif; ?>><i class="fa fa-exclamation-triangle"></i>report</button>
                            <button type="button" data-toggle="modal" data-target="#ad-share">
                                <i class="fa fa-share-alt"></i>
                                share
                            </button>
                        </div>
                    </div>
                    <div class="advertising">
                        <?php echo $middleOfContent; ?>

                    </div>
                    <!-- SPECIFICATION CARD -->
                    <div class="common-card">
                        <div class="card-header">
                            <h5 class="card-title">Specification</h5>
                        </div>
                        <ul class="ad-details-specific">
                            <li>
                                <h6>price:</h6>
                                <p><?php echo e(Config::get('siteSetting.currency_symble') .' '. number_format($post_detail->price)); ?></p>
                            </li>

                            <li>
                                <h6>published:</h6>
                                <p><?php echo e(Carbon\Carbon::parse(($post_detail->approved) ? $post_detail->approved : $post_detail->created_at)->format(Config::get('siteSetting.date_format'))); ?></p>
                            </li>
                        
                            <li>
                                <h6>price type:</h6>
                                <p><?php echo e(($post_detail->negotiable == 1) ? 'negotiable' : 'fixed'); ?></p>
                            </li>
                        
                            <?php if($post_detail->get_brand): ?>
                            <li>
                                <h6>Brand:</h6>
                                <p><?php echo e($post_detail->get_brand->name); ?></p>
                            </li>
                            <?php endif; ?>
                            <?php if(count($post_detail->get_features)>0): ?>
                            <?php $__currentLoopData = $post_detail->get_features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($feature->value): ?>
                            <li>
                                <h6><?php echo e($feature->name); ?>: </h6> 
                                <p><?php echo e($feature->value); ?></p>
                            </li>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>

                            <?php if(count($post_detail->get_variations)>0): ?>
                            <?php $__currentLoopData = $post_detail->get_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <h6><?php echo e($variation->attribute_name); ?>: </h6> 
                                <?php $__currentLoopData = $variation->get_variationDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variationDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <?php if($variationDetail->get_attributeValue): ?><p><?php echo e($variationDetail->get_attributeValue->name); ?></p><?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <!-- DESCRIPTION CARD -->
                    <div class="common-card">
                        <div class="card-header">
                            <h5 class="card-title">description</h5>
                        </div>
                        <p class="ad-details-desc"><?php echo $post_detail->description; ?></p>
                    </div>
                    <div class="advertising">
                        <?php echo $bottomOfContent; ?>

                    </div>
                    
                </div>
                <div class="col-lg-4">
                    <div class="advertising">
                        <?php echo $sitebarTop; ?>

                    </div>
                    <!-- PRICE CARD -->
                    <div class="common-card price">
                        <h3><?php echo e(Config::get('siteSetting.currency_symble') .' '. number_format($post_detail->price)); ?><?php if($post_detail->negotiable == 1): ?><span>/negotiable</span> <?php endif; ?></h3>
                        <i class="fa fa-tag"></i>
                    </div>

                    <!-- NUMBER CARD -->
                    <button type="button" class="common-card number" data-toggle="modal" data-target="#number">
                        <h3> <?php if($post_detail->contact_hidden == 1): ?> (+880)<span>Click to show</span> <?php else: ?> <?php if($post_detail->contact_mobile): ?> <?php $__currentLoopData = json_decode($post_detail->contact_mobile); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $number): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <p><a style="color: #fff;" href="tel:<?php echo e($number); ?>"><?php echo e($number); ?></a></p> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  <?php endif; ?> <?php endif; ?></h3>  <i class="fa fa-phone"></i>
                        
                    </button>

                     <a style=" justify-content: center;" href="<?php echo e(route('user.message', [$post_detail->author->username, $post_detail->slug])); ?>" title="Message" class="common-card number">
                        <i class="fa fa-envelope"></i>&nbsp; <h3>Chat</h3>
                        
                    </a>

                    <!-- AUTHOR CARD -->
                    <div class="common-card">
                        <div class="card-header">
                            <h5 class="card-title">author info</h5>
                        </div>
                        <div class="ad-details-author">
                            <a href="<?php echo e(route('userProfile', $post_detail->author->username)); ?>" class="author-img active">
                                <img src="<?php echo e(asset('upload/users')); ?>/<?php echo e(($post_detail->author->photo) ? $post_detail->author->photo : 'defualt.png'); ?>" alt="<?php echo e($post_detail->author->name); ?>">
                            </a>
                            <div class="author-meta">
                                <h4><a href="<?php echo e(route('userProfile', $post_detail->author->username)); ?>"><?php echo e($post_detail->author->name); ?></a></h4>
                                <h5>joined: <?php echo e(Carbon\Carbon::parse($post_detail->author->created_at)->format(Config::get('siteSetting.date_format'))); ?></h5>
                                <?php if($post_detail->author->user_dsc): ?>
                                <p><?php echo e($post_detail->author->user_dsc); ?></p><?php endif; ?>
                            </div>
                            <div class="author-widget">
                                <a href="<?php echo e(route('userProfile', $post_detail->author->username)); ?>" title="Profile" class="fa fa-eye"></a>
                                <a href="<?php echo e(route('user.message', [$post_detail->author->username, $post_detail->slug])); ?>" title="Message" class="fa fa-envelope"></a>

                                

                                <button type="button" title="Follow" <?php if(Auth::check()): ?> onclick="follower(<?php echo e($post_detail->author->id); ?>)" <?php else: ?> data-toggle="modal" data-target="#so_sociallogin" <?php endif; ?> class="follow fa <?php if(Auth::check() && App\Models\FavoriteSeller::where('user_id', Auth::id())->where('follower_id', $post_detail->user_id)->first()): ?>
                                        fa-thumbs-down
                                        <?php else: ?>
                                        fa-thumbs-up
                                        <?php endif; ?> "></button>
                                <a href="tel:<?php echo e(($post_detail->contact_mobile) ? json_decode($post_detail->contact_mobile)[0] : null); ?>" title="Number" class="fa fa-phone"></a>
                                <button type="button" title="Share" class="fa fa-share-alt" data-toggle="modal" data-target="#ad-share"></button>
                            </div>
                        </div>
                    </div>
                    <div class="advertising">
                        <?php echo $sitebarMiddle; ?>

                    </div>
                    <?php

                    $safety_tip = App\Models\SiteSetting::where('type', 'safety_tip')->first();
                    ?>
                    <?php if($safety_tip->status == 1): ?>
                    <!-- SAFETY CARD -->
                    <div class="common-card">
                        <div class="card-header">
                            <h5 class="card-title"><i class="fa fa-hand-point-right"></i> safety tips</h5>
                        </div>
                        <div class="ad-details-safety" style="border: 1px solid #e19407;border-radius: 3px;padding: 5px;">
                            <?php echo ($post_detail->get_category->safety_tip) ? $post_detail->get_category->safety_tip : $safety_tip->value; ?>

                        </div>
                    </div>
                    <?php endif; ?>
                    
                    
                    <div class="advertising">
                        <?php echo $sitebarBottom; ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=====================================
        AD DETAILS PART END
    =======================================-->
    
    <?php if(count($related_products)>0): ?>
    <!--=====================================
        RELATED PART START
    =======================================-->
    <section class="inner-section related-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-center-heading">
                        <h2>Related This <span>Ads</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="related-slider slider-arrow">
                        <?php $__currentLoopData = $related_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="product-card">
                            <a style="width: 100%" href="<?php echo e(route('post_details', $related_product->slug)); ?>">
                            <div class="product-media">
                                
                                <div class="product-img">
                                    <img  src="<?php echo e(asset('upload/images/product/thumb/'. $related_product->feature_image)); ?>" alt="product">
                                </div>
                               
                            </div> </a>
                            <div class="product-content">
                                <a style="color: #666666" href="<?php echo e(route('post_details', $related_product->slug)); ?>">
                                <ol class="breadcrumb product-category">
                                    <li><i class="fa fa-tags"></i><?php echo e($related_product->get_category->name ?? ''); ?></li>
                                    
                                </ol>
                                <h5 class="product-title">
                                    <?php echo e(Str::limit($related_product->title, 40)); ?>

                                </h5>
                                <div class="product-meta">
                                    <span><i class="fa fa-map-marker-alt"></i><?php echo e($related_product->get_state->name ?? ''); ?></span>
                                    <span><i class="fa fa-clock"></i><?php echo e(Carbon\Carbon::parse($related_product->created_at)->diffForHumans()); ?></span>
                                </div>
                                </a>
                                <div class="product-info">
                                    <h5 class="product-price"><?php echo e(Config::get('siteSetting.currency_symble') .' '. number_format($related_product->price)); ?></h5>
                                    <div class="product-btn">
                                        <button type="button" title="Wishlist" <?php if(Auth::check()): ?> onclick="addToWishlist(<?php echo e($related_product->id); ?>)" data-toggle="tooltip" <?php else: ?> data-toggle="modal" data-target="#so_sociallogin" <?php endif; ?> class="far fa-heart"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <?php if($post_detail->contact_hidden == 1): ?>
    <div class="modal fade" id="number">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Contact this Number</h4>
                    <button class="fa fa-times" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <h3 class="modal-number"><?php if($post_detail->contact_mobile): ?> <?php $__currentLoopData = json_decode($post_detail->contact_mobile); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $number): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <p><a href="tel:<?php echo e($number); ?>"><?php echo e($number); ?></a></p> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  <?php endif; ?></h3>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="modal fade" id="reportModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Product report</h4>
                    <button class="fa fa-times" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(route('sellerReport')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="product_id" value="<?php echo e($post_detail->id); ?>">
                        <div id="reportForm"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>    
    <div class="modal fade" id="ad-share">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Share Product</h4>
                    <button class="fa fa-times" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                   <div class="blog-details-widget">
                           
                            <ul class="share-list">
                                <li style="background:transparent;"><h4>Share:</h4></li>
                                <li><a href="https://www.facebook.com/sharer.php?u=<?php echo e(route('post_details', $post_detail->slug)); ?>"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="https://twitter.com/share?url=<?php echo e(route('post_details', $post_detail->slug)); ?>&amp;text=<?php echo $post_detail->title; ?>&amp;hashtags=blog"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo e(route('post_details', $post_detail->slug)); ?>?rs=<?php echo e($post_detail->id); ?>"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="https://web.whatsapp.com/send?text=<?php echo e(route('post_details', $post_detail->slug)); ?>&amp;title=<?php echo $post_detail->title; ?>"><i class="fab fa-whatsapp"></i></a></li>
                                <li><a href="https://pinterest.com/pin/create/button/?url=<?php echo e(route('post_details', $post_detail->slug)); ?>?rs=<?php echo e($post_detail->id); ?>"><i class="fab fa-pinterest-p"></i></a></li>
                            </ul>
                        </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    <?php if(Auth::check()): ?>
    function follower(follower_id){
        $.ajax({
            method:'get',
            url:'<?php echo e(route("follower")); ?>',
            data:{
                follower_id:follower_id,
            },
            success:function(data){
                if(data.status){
                    toastr.success(data.msg);
                }
            }
        });
    }

    function report(id){
        $('#reportModal').modal('show');
         $('#reportForm').html('<div class="loadingData-sm"></div>');
        $.ajax({
            method:'get',
            url:'<?php echo e(route("reportForm")); ?>',
            data:{
                type:'product'
            },
            success:function(data){
                if(data){
                    $('#reportForm').html(data);
                }
            }
        });
    }
    <?php endif; ?>
</script>   
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\jotesto\resources\views/frontend/ads-details.blade.php ENDPATH**/ ?>