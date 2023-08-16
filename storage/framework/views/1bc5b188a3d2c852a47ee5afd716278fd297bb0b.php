<?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($message->sender_id == Auth::id()): ?>
    <li class="inbox-chat-item my-chat" id="message<?php echo e($message->id); ?>">
        <div class="inbox-chat-content">
            <?php if($message->deleted_from_sender == 0): ?>
            <div class="inbox-chat-text">
                <p><?php echo $message->message; ?></p>
                <div class="inbox-chat-action">
                    <a href="javascript:void(0)" title="Remove" onclick= "removeMessage(<?php echo e($message->id); ?>)" class="fas fa-trash-alt"></a>
                </div>
            </div>
            <small class="inbox-chat-time"><?php echo e(Carbon\Carbon::parse($message->created_at)->diffForHumans()); ?></small>
           <?php endif; ?>
        </div>
    </li>
    <?php else: ?>
    <li class="inbox-chat-item" id="message<?php echo e($message->id); ?>">
        <div class="inbox-chat-content">
            <?php if($message->deleted_from_receiver == 0): ?>
            <div class="inbox-chat-text">
                <p><?php echo $message->message; ?></p>
                <div class="inbox-chat-action">
                    <a href="javascript:void(0)" title="Remove" onclick= "removeMessage(<?php echo e($message->id); ?>)" class="fas fa-trash-alt"></a>
                </div>
            </div>
            <small class="inbox-chat-time"><?php echo e(Carbon\Carbon::parse($message->created_at)->diffForHumans()); ?></small>
            <?php endif; ?>
        </div>
    </li>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\xampp\htdocs\bonik\resources\views/users/message/realtimeMessage.blade.php ENDPATH**/ ?>