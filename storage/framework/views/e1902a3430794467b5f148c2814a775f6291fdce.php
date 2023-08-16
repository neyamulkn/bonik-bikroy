<?php
	$banner = App\Models\Banner::find($section->product_id); 
?>

<?php if($banner): ?>
<section class="section" style="<?php if($section->layout_width == 1): ?> background:<?php echo e($section->background_color); ?>; <?php endif; ?> padding:5px;">
  <div class="container" <?php if($section->layout_width != 1): ?> style="background:<?php echo e($section->background_color); ?>;border-radius: 3px;" <?php endif; ?>>
  	<div class="row">
    <?php for($i=1;$i<=$banner->banner_type; $i++): ?>
    <?php $col = round(12/$banner->banner_type); 
    $mobcol = ($banner->banner_type == 1) ? 12 : 6;
    $btn_link = 'btn_link'.$i;
    $banner_img = 'banner'.$i;
    ?>
	  <div class="col-md-<?php echo e($col); ?> col-xs-<?php echo e($mobcol); ?>" style="margin-bottom: 10px;">
	     <a  title="<?php echo e($banner->title); ?>" href="<?php echo e(url($banner->$btn_link)); ?>"><img style="width: 100%" src="<?php echo e(asset('upload/images/banner/'.$banner->$banner_img)); ?>"></a>
	  </div>
	  <?php endfor; ?>
	 </div>
	</div>
</section>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\jotesto\resources\views/frontend/homepage/banner.blade.php ENDPATH**/ ?>