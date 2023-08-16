<?php $categories = App\Models\Category::withCount('productsByCategory')->where('parent_id', null)->orderBy('position', 'desc')->take($section->item_number)->get(); ?>
<?php if(count($categories)>0): ?>
<section style="margin:0; <?php if($section->layout_width == 1): ?> background:<?php echo e($section->background_color); ?> <?php endif; ?>">
  <div class="container" <?php if($section->layout_width != 1): ?> style="background:<?php echo e($section->background_color); ?>;border-radius: 5px;" <?php endif; ?>>
      <h2 class="heading"><?php echo e($section->title); ?></h2>
      <div class="row">
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-3 col-6">
            <div class="quick-links">
                <a class="bikroysub" href="<?php echo e(route('home.category', [$category->slug])); ?>"><b><?php echo e($category->products_by_category_count); ?> ads in <?php echo e($category->name); ?></b></a>
                <p class="subcategory">
                <?php $__currentLoopData = $category->get_subcategory->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('home.category',[$subcategory->slug])); ?>"><?php echo e($subcategory->name); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </p>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
</section>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\bonik\resources\views/frontend/homepage/categoriessub.blade.php ENDPATH**/ ?>