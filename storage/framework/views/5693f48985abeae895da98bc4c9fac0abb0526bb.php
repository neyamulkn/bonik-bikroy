<?php
$blogs = App\Models\Blog::orderBy('id', 'desc')->where('status', 'active')->take($section->item_number)->get();
?>
<?php if(count($blogs)>0): ?>
<section class="section intro-part" <?php if($section->layout_width == 1): ?> style="background:<?php echo e($section->background_color); ?>" <?php endif; ?>>
  <div class="container" <?php if($section->layout_width != 1): ?> style="background:<?php echo e($section->background_color); ?>;border-radius: 5px;" <?php endif; ?>>
        <div class="row">
            <div class="col-lg-12">
                <h4 style="color:<?php echo e($section->text_color); ?>;margin: 0;"><?php echo e($section->title); ?></h4>
            </div>
        </div>
		<div class="row">
        <div class="col-lg-12">
            <div class="blog-slider slider-arrow">
            	<?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="blog-card">
                    <div class="blog-img">
                        <img src="<?php echo e(asset('upload/images/blog/thumb/'.$blog->image)); ?>" alt="blog">
                        
                    </div>
                    <div class="blog-content">
                        <div class="blog-text">
                            <a href="<?php echo e(route('blog_details', $blog->slug)); ?>"><h6><?php echo e(Str::limit($blog->title, 30)); ?></h6></a>
                            
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <!-- <div class="row">
        <div class="col-lg-12">
            <div class="blog-btn">
                <a href="<?php echo e(route('blog')); ?>" class="btn btn-inline">
                    <i class="fas fa-eye"></i>
                    <span>view all blogs</span>
                </a>
            </div>
        </div>
    </div> -->
	</div>
</section>

<script type="text/javascript">
  try {
    $('.blog-slider').slick({
    dots: false,
    infinite: true,
    speed: 800,
    autoplay: true,
    arrows: true,
    fade: false,
    slidesToShow: 5,
    slidesToScroll: 1,
    prevArrow: '<i class="fas fa-long-arrow-alt-right dandik"></i>',
    nextArrow: '<i class="fas fa-long-arrow-alt-left bamdik"></i>',
    responsive: [
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          variableWidth: true,
          arrows: true,
        }
      },
      {
        breakpoint: 576,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          variableWidth: true,
          arrows: false,
        }
      }
    ]
  });
  
  }
  catch (e) {
     //Handle the error if you wish.
  }
</script>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\bikroy\resources\views/frontend/homepage/blog.blade.php ENDPATH**/ ?>