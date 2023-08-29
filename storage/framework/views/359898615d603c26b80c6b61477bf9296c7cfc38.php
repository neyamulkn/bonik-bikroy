
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
    <meta property="og:url" content="<?php echo e(asset('upload/images/product/'.$post_detail->feature_image)); ?>">
    <meta property="og:site_name" content="<?php echo e(Config::get('siteSetting.site_name')); ?>">
    <meta property="og:locale" content="bd">
    <meta property="og:type" content="product">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
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
    <div>
        
        <div class="container bg-white mb-3 p-2">
            <img class="w-100" src="<?php echo e(asset('upload/images/ads.png')); ?>" alt="banner">
        </div>
        <div class="container bg-white py-4 px-0 mb-3 rounded">
            <div class="row">
                <div class="col-12 d-flex align-items-start justify-content-between">
                    <div>
                        <h3 class="bt w-100"><?php echo e($post_detail->title); ?></h3>
                        <p class="bt mt-2 mb-3 w-100">
                            <?php if($post_detail->get_state): ?>
                                <?php echo e($post_detail->get_state->name); ?>

                            <?php endif; ?>
                            <?php if($post_detail->get_city): ?>,
                                <?php echo e($post_detail->get_city->name); ?>

                            <?php endif; ?>
                        </p>
                    </div>
                    <div class="d-flex align-items-center">
                        <button type="button" id="shareBtn" data-toggle="modal" data-target="#ad-share" class="wish yb p-2 rounded borders mr-2 sh">
                            <img width="25" height="25" src="<?php echo e(asset('upload/images/share.svg')); ?>" alt="share">
                        </button>
                        <button type="button"  <?php if(Auth::check()): ?> onclick="addToWishlist(<?php echo e($post_detail->id); ?>)" data-toggle="tooltip" <?php else: ?> data-toggle="modal" data-target="#so_sociallogin" <?php endif; ?> class="yb p-2 rounded borders sh">
                             <img width="25" height="25" src="<?php echo e(asset('upload/images/heart.svg')); ?>" alt="heart">
                        </button>
                    </div>
                </div>
                
                <div class="col-lg-8 col-md-8 col-sm-12 pr-md-0">
                    <div >
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
                        
                        <p class="bt mt-2">
                            Published On <?php echo e(Carbon\Carbon::parse(($post_detail->approved) ? $post_detail->approved : $post_detail->created_at)->format(Config::get('siteSetting.date_format'))); ?>

                            , <?php echo e(\Carbon\Carbon::parse(($post_detail->approved) ? $post_detail->approved : $post_detail->created_at)->format('h:i A')); ?>

                        </p>
                        <div class="d-flex align-items-end my-2">
                            <h3 class="pt"><?php echo e(Config::get('siteSetting.currency_symble') .' '. number_format($post_detail->price)); ?></h3>
                            <?php if($post_detail->negotiable == 1): ?>
                            <p>/negotiable</p>
                            <?php endif; ?>
                        </div>
                        
                        <div class="hl-2">
                            <div class="d-flex align-items-start justify-content-between">
                                <p>Price:</p>
                                <b><?php if($post_detail->price > 0): ?> <?php echo e(Config::get('siteSetting.currency_symble') .' '. number_format($post_detail->price)); ?> <?php else: ?> Negotiable <?php endif; ?> </b>
                            </div>
                            <div class="d-flex align-items-start justify-content-between">
                                <p>Published:</p>
                                <b><?php echo e(Carbon\Carbon::parse(($post_detail->approved) ? $post_detail->approved : $post_detail->created_at)->format(Config::get('siteSetting.date_format'))); ?></b>
                            </div>
                            <div class="d-flex align-items-start justify-content-between">
                                <p>Price type:</p>
                                <b><?php echo e(($post_detail->negotiable == 1) ? 'negotiable' : 'fixed'); ?></b>
                            </div>
                        
                            <?php if($post_detail->get_brand): ?>
                            <div class="d-flex align-items-start justify-content-between">
                                <p>Brand:</p>
                                <b><?php echo e($post_detail->get_brand->name); ?></b>
                            </div>
                            <?php endif; ?>
                            <?php if(count($post_detail->get_features)>0): ?>
                            <?php $__currentLoopData = $post_detail->get_features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($feature->value): ?>
                            <div class="d-flex align-items-start justify-content-between">
                                <p><?php echo e($feature->name); ?>: </p> 
                                <b><?php echo e($feature->value); ?></b>
                            </div>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>

                            <?php if(count($post_detail->get_variations)>0): ?>
                            <?php $__currentLoopData = $post_detail->get_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="d-flex align-items-start justify-content-between">
                                <p><?php echo e($variation->attribute_name); ?>: </p> 
                                <?php $__currentLoopData = $variation->get_variationDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variationDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <?php if($variationDetail->get_attributeValue): ?>
                                <b><?php echo e($variationDetail->get_attributeValue->name); ?></b>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                        
                        <div class="description my-2 border-bottom pb-2">
                            <article><?php echo $post_detail->description; ?></article>
                        </div>
                        <button class="float-right py-1 px-4 bg-danger text-white bb2 rounded" type="button" <?php if(Auth::check()): ?> onclick="report(<?php echo e($post_detail->id); ?>)" data-toggle="tooltip" <?php else: ?> data-toggle="modal" data-target="#so_sociallogin" <?php endif; ?>>Report</button>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="d-flex align-items-center">
                        <a href="<?php echo e(route('userProfile', $post_detail->author->username)); ?>" class="mr-3">
                            <img class="rounded" width="70" height="70" src="<?php echo e(asset('upload/users')); ?>/<?php echo e(($post_detail->author->photo) ? $post_detail->author->photo : 'default.png'); ?>" alt="<?php echo e($post_detail->author->name); ?>">
                        </a>
                        <div>
                            <h4><?php echo e($post_detail->author->name); ?></h4>
                            <h5>joined: <?php echo e(Carbon\Carbon::parse($post_detail->author->created_at)->format(Config::get('siteSetting.date_format'))); ?></h5>
                            <a href="<?php echo e(route('userProfile', $post_detail->author->username)); ?>">Visit Member Shop</a>
                        </div>
                    </div>
                    
                    <button type="button" class="w-100 bb p-2 text-center by2 rounded my-2 font-weight-bold d-flex align-items-center" data-toggle="modal" data-target="#number">
                        <img width="40" height="40" src="<?php echo e(asset('upload/images/phone.png')); ?>" alt="banner">
                        <?php if($post_detail->contact_hidden == 1): ?>
                            <div class="d-flex align-items-center">
                                <h3 class="text-white pl-2">(+880)</h3>
                                <h1 class="text-white h-33">********</h1>
                            </div>
                        <?php else: ?>
                            <?php if($post_detail->contact_mobile): ?>
                                <?php $__currentLoopData = json_decode($post_detail->contact_mobile); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $number): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a class="text-white pl-2" href="tel:<?php echo e($number); ?>">+88 <?php echo e($number); ?></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </button>
                    <div class="d-flex align-items-center">
                        <a class="w-100 p-3 bib d-flex align-items-center justify-content-end mr-1" href="<?php echo e(route('ads.promotePackage', [$post_detail->slug])); ?>" title="Message">
                            <h4 class="text-white pr-2">Boost Ad</h4>
                            <img width="30" height="30" src="<?php echo e(asset('upload/images/boosti.png')); ?>" alt="sms">
                        </a>
                        <a class="w-100 bb p-2 text-center by2 rounded my-2 font-weight-bold d-flex align-items-center ml-1" href="<?php echo e(route('user.message', [$post_detail->author->username, $post_detail->slug])); ?>" title="Message">
                            <img width="30" height="30" src="<?php echo e(asset('upload/images/sms.png')); ?>" alt="sms">
                            <h4 class="text-white pl-2">Chating</h4>
                        </a>
                    </div>
                    <?php

                    $safety_tip = App\Models\SiteSetting::where('type', 'safety_tip')->first();
                    ?>
                    <?php if($safety_tip->status == 1): ?>
                    <!-- SAFETY CARD -->
                    <div class="bg-white py-3">
                        <h5 class="">Be Safe</h5>
                        <div class="">
                            <?php echo ($post_detail->get_category->safety_tip) ? $post_detail->get_category->safety_tip : $safety_tip->value; ?>

                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <?php if(count($related_products)>0): ?>
    <div class="container bg-white mb-3 py-4 px-0 rounded">
        <h3 class="mb-4 d-flex align-items-center justify-content-center">Related This <p class="pt font-weight-normal pl-2">Ads</p></h3>
        <div class="hl-3 hl-2 px-md-5">
            <?php $__currentLoopData = $related_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $related_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="w-100 <?php if($index==0): ?> ab <?php else: ?> bg-white <?php endif; ?> p-2 mb-2 position-relative">
                <a class="w-100" href="<?php echo e(route('post_details', $related_product->slug)); ?>">
                    <div class="position-relative">
                        <div class="d-flex align-items-center position-absolute left-0 top-0 ">
                            <div class="yb bt px-3 font-weight-bold">USED</div>
                            <div class="ff"></div>
                        </div>
                        
                        <img class="position-absolute right-0 top-0 lazyload" src="<?php echo e(asset('upload/images/urgent.png')); ?>">
                        <img class="lazyload w-100" src="<?php echo e(asset('upload/images/product/thumb/default.jpg')); ?>" data-src="<?php echo e(asset('upload/images/product/thumb/'. $related_product->feature_image)); ?>" alt="<?php echo e($related_product->title); ?>">
                    </div>
                    <div class="w-100">
                        <h4 class="font-weight-bold bt py-1" title="<?php echo e($related_product->title); ?>"><?php echo e($related_product->title); ?></h4>
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="d-flex align-items-center">
                                    <img class="lazyload" src="<?php echo e(asset('upload/users/lavel1.png')); ?>">
                                    <p class="bt" title="Verified Bonik">Verified Bonik</p>
                                </div>
                                <p class="bt py-1" title="<?php echo e($product->get_state->name ?? ''); ?>"><?php echo e($related_product->get_state->name ?? ''); ?></p>
                            </div>
                            <div>
                                <img class="lazyload" src="<?php echo e(asset('upload/users/pin.png')); ?>">
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="font-weight-bold bt py-1"><?php echo e(Config::get('siteSetting.currency_symble') .' '. number_format($related_product->price)); ?></h4>
                            <p class="bt py-1"><?php echo e(Carbon\Carbon::parse($related_product->created_at)->diffForHumans()); ?></p>
                        </div>
                    </div>
                    <?php if($related_product->get_promoteAd && $related_product->get_promoteAd->get_adPackage): ?>
                    <img src="<?php echo e(asset('upload/images/package/'.$related_product->get_promoteAd->get_adPackage->ribbon)); ?>">
                    <?php endif; ?>
                </a>
                <div class="d-flex align-items-center bb2 rounded shadow w-100">
                    <input type="text" name="message" id="message<?php echo e($related_product->id); ?>" class="px-2 py-1 w-100 rounded" placeholder="Send message">
                    <button <?php if(Auth::check()): ?> onclick="sendMessage(<?php echo e($related_product->id); ?>)" <?php else: ?> data-target="#so_sociallogin" data-toggle="modal" <?php endif; ?>><img height="23" src="<?php echo e(asset('upload/images/chat2.png')); ?>"></button>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php endif; ?>
    
    <div class="container bg-white mb-3 py-3">
        <img class="w-100" src="<?php echo e(asset('upload/images/ads.png')); ?>" alt="banner">
    </div>
    
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
                <div class="modal-body d-flex align-items-center justify-content-around">
                    <a href="https://www.facebook.com/sharer.php?u=<?php echo e(route('post_details', $post_detail->slug)); ?>">
                        <i class="fab fa-facebook-f bt yb p-3 rounded-circle"></i>
                    </a>
                    <a href="https://twitter.com/share?url=<?php echo e(route('post_details', $post_detail->slug)); ?>&amp;text=<?php echo $post_detail->title; ?>&amp;hashtags=blog">
                        <i class="fab fa-twitter bt yb p-3 rounded-circle"></i>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo e(route('post_details', $post_detail->slug)); ?>?rs=<?php echo e($post_detail->id); ?>">
                        <i class="fab fa-linkedin-in bt yb p-3 rounded-circle"></i>
                    </a>
                    <a href="https://web.whatsapp.com/send?text=<?php echo e(route('post_details', $post_detail->slug)); ?>&amp;title=<?php echo $post_detail->title; ?>">
                        <i class="fab fa-whatsapp bt yb p-3 rounded-circle"></i>
                    </a>
                    <a href="https://pinterest.com/pin/create/button/?url=<?php echo e(route('post_details', $post_detail->slug)); ?>?rs=<?php echo e($post_detail->id); ?>">
                        <i class="fab fa-pinterest-p bt yb p-3 rounded-circle"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('js/readmore.js')); ?>"></script>
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
    $('article').readmore({speed: 500});


    function sendMessage(product_id){
    
    var message = $('#message'+product_id).val();
   
      $.ajax({
        url:'<?php echo e(route("user.sendMessage")); ?>',
        type:'post',
        data:{productOrConId:product_id,message:message,'_token':'<?php echo e(csrf_token()); ?>'},
        success:function(data){
            if(data){
                $('#message'+product_id).val('');
                toastr.success('Message send success.');
            }else{
                toastr.error('Message send failad.');
            }
          }
      });
    }


    $(document).on("click", "#shareBtn", function(){
        var ad_id = "<?php echo e($post_detail->id); ?>"
        $.ajax({
            method:'get',
            url:'<?php echo e(route("shareAd")); ?>',
            data:{ ad_id:ad_id }
        });
    });
</script>   
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bonik\resources\views/frontend/ads-details.blade.php ENDPATH**/ ?>