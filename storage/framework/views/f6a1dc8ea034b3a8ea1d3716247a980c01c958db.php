<?php  
$products = App\Models\Product::with('get_brand')->where('status', 'active')->selectRaw('id,title,slug,price,category_id,state_id,views,sale_type, feature_image,created_at')->whereRaw('id IN (select MAX(id) FROM products GROUP BY subcategory_id)')->inRandomOrder()->take($section->item_number)->get(); 
?>
<?php if(count($products)>0): ?>
<section class="section" <?php if($section->layout_width == 1): ?> style="background:<?php echo e($section->background_color); ?>" <?php endif; ?>>
  <div class="container" <?php if($section->layout_width != 1): ?> style="background:<?php echo e($section->background_color); ?>;border-radius: 5px;" <?php endif; ?>>
    <div class="row">
          <div class="col-md-6 col-lg-6">
              <div class="section-side-heading" style="padding:15px;text-align: center;">
                  <h2><?php echo e($section->title); ?></h2>
                  <p><?php echo e($section->notes); ?></p>
                  <a href="#" class="btn btn-inline">
                      <i class="fas fa-eye"></i>
                      <span>View all featured</span>
                  </a>
              </div>
          </div>
          <div class="col-md-6 col-lg-6">
              <div class="feature-card-slider slider-arrow">
                  <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="feature-card">
                      <a href="<?php echo e(route('post_details', $product->slug)); ?>" class="feature-img">
                          <img class="lazyload" src="<?php echo e(asset('upload/images/product/thumb/default.jpg')); ?>" data-src="<?php echo e(asset('upload/images/product/'.$product->feature_image)); ?>" alt="<?php echo e($product->title); ?>">
                      </a>
                     
                      <button type="button" class="feature-wish">
                          <i class="fas fa-heart"></i>
                      </button>
                      <div class="feature-content">
                          <ol class="breadcrumb feature-category">
                              <li><span class="flat-badge rent"><?php echo e($product->sale_type); ?></span></li>
                              <li class="breadcrumb-item"><a href="#"><?php echo e($product->get_state->name ?? ''); ?></a></li>
                              <li class="breadcrumb-item active" aria-current="page"><?php echo e($product->get_category->name ?? ''); ?></li>
                          </ol>
                          <h3 class="feature-title"><a href="<?php echo e(route('post_details', $product->slug)); ?>"><?php echo e(Str::limit($product->title, 40)); ?></a></h3>
                          <div class="feature-meta">
                              <span class="feature-price"><?php echo e(Config::get('siteSetting.currency_symble') . $product->price); ?> <?php if($product->negotiable == 1): ?><small>/negotiable</small> <?php endif; ?> </span>
                              <span class="feature-time"><i class="fa fa-clock"></i><?php echo e(Carbon\Carbon::parse($product->created_at)->diffForHumans()); ?></span>
                          </div>
                      </div>
                  </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
              <div class="feature-thumb-slider">
                   <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="feature-thumb"><img src="<?php echo e(asset('upload/images/product/thumb/'. $product->feature_image)); ?>" alt="<?php echo e($product->title); ?>"></div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
          </div>
        
        </div>
      </div>
  </div>
</section>

<script type="text/javascript">
  try {
  $('.feature-card-slider').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  autoplay: true,
  arrows: true,
  fade: true,
  asNavFor: '.feature-thumb-slider',
  prevArrow: '<i class="fa fa-long-arrow-alt-right dandik"></i>',
  nextArrow: '<i class="fa fa-long-arrow-alt-left bamdik"></i>',
  responsive: [
      {
          breakpoint: 576,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
          }
      }
  ]
  });
  }
  catch (e) {
     //Handle the error if you wish.
  }

  try{
    
  $('.feature-thumb-slider').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  asNavFor: '.feature-card-slider',
  dots: false,
  arrows: false,
  autoplay: true,
  centerMode: true,
  focusOnSelect: true,
  responsive: [
      {
          breakpoint: 992,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            arrows: false,
          }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          arrows: false,
        }
      },
      {
        breakpoint: 576,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          arrows: false,
        }
      },
      {
        breakpoint: 400,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          arrows: false,
        }
    }
  ]
  });
 
  }catch(e){
    
  }
</script>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\jotesto\resources\views/frontend/homepage/features-ads.blade.php ENDPATH**/ ?>