<div class="dropdown-header">
    <h5>Notification</h5>
    <a href="<?php echo e(route('allNotifications')); ?>">view all</a>
</div>
<ul class="notify-list ">
 
<?php if(count($notifications )>0): ?>
<?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($notification->type == 'post'): ?>
    <?php if($notification->product): ?>
    <li class="notify-item <?php if($notification->read == 0): ?> active <?php endif; ?>">
        <a onclick="readNotify('<?php echo e($notification->id); ?>')" href="<?php echo e(route('post_details', $notification->product->slug)); ?>" class="notify-link">
            <div class="notify-img">
                <img src="<?php echo e(asset('upload/images/product/thumb/'. $notification->product->feature_image)); ?>" alt="obondhu">
            </div>
            <div class="notify-content">
                <p class="notify-text"><?php if($notification->user): ?><span><?php echo e($notification->user->name); ?>: </span><?php endif; ?> <?php echo e($notification->notify); ?>  <?php echo e(Str::limit($notification->product->title, 25)); ?></p>
                <span class="notify-time"><?php echo e(Carbon\Carbon::parse($notification->created_at)->diffForHumans()); ?></span>
            </div> 
        </a>
    </li>
    <?php endif; ?>
<?php elseif($notification->type == 'package'): ?>
<li class="notify-item <?php if($notification->read == 0): ?> active <?php endif; ?>">
    <a onclick="readNotify('<?php echo e($notification->id); ?>')" href="<?php echo e(route('user.packageHistory')); ?>#<?php echo e($notification->item_id); ?>" class="notify-link">
        <div class="notify-img">
             <img src="https://img.favpng.com/19/10/20/blue-computer-icon-area-symbol-png-favpng-Rsn1G41w4PgR3fpkZntM1wVrZ.jpg" alt="obondhu">
        </div>
        <div class="notify-content">
            <p class="notify-text"> <?php echo e($notification->notify); ?> </p>
            <span class="notify-time"><?php echo e(Carbon\Carbon::parse($notification->created_at)->diffForHumans()); ?></span>
        </div>
    </a>
</li>
<?php elseif($notification->type == 'register'): ?>{
    <li class="notify-item <?php if($notification->read == 0): ?> active <?php endif; ?>">
    <a href="<?php echo e(route('user.dashboard')); ?>" class="notify-link">
        <div class="notify-img">
            <img src="<?php echo e(asset('frontend/images/post.png')); ?>" alt="obondhu">
        </div>
        <div class="notify-content">
            <p class="notify-text"><span><?php echo e($notification->notify); ?></span></p>
            <span class="notify-time"><?php echo e(Carbon\Carbon::parse($notification->created_at)->diffForHumans()); ?></span>
        </div>
    </a>
</li>
}
<?php else: ?>

<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
<h3>No notification found.</h3>
<?php endif; ?>
    
</ul><?php /**PATH C:\xampp\htdocs\jotesto\resources\views/users/notifications/notify-item-list.blade.php ENDPATH**/ ?>