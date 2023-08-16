<?php  

$categories = App\Models\Category::where('parent_id', null)->orderBy('position', 'asc')->where('status', 1)->limit($section->item_number)->get();
?>
<?php if(count($categories)>0): ?>
<section style="margin: 5px 0;">
  <div class="container" <?php if($section->layout_width != 1): ?> style="background:<?php echo e($section->background_color); ?>;border-radius: 5px;" <?php endif; ?>>
      <h4 style="color:<?php echo e($section->text_color); ?>;margin: 0;"><?php echo e($section->title); ?></h4>
      <div class="row" style="padding: 10px 0px;">
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

          <div class="col-4 col-md-2">
                <a style="padding: 0px; margin:0 0 10px;width:100%" href="<?php echo e(route('home.category', [$category->slug])); ?>" class="suggest-card">
                    <img class="lazyload" src="<?php echo e(asset('upload/images/category/thumb/loader.jpg')); ?>" data-src="<?php echo e(asset('upload/images/category/thumb/'.$category->image)); ?>" alt="car">
                    <h6><?php echo e($category->name); ?></h6>
                </a>
            </div>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
</section>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\bonik\resources\views/frontend/homepage/categories.blade.php ENDPATH**/ ?>