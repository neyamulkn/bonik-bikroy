
<?php $__env->startSection('title', 'Dashboard | '. Config::get('siteSetting.site_name') ); ?>
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container bg-white p-0 pb-3 mb-2">
        <img class="lazyload mw-100 h-300" src="<?php echo e(asset('upload/images/cover.png')); ?>">
        <div class="row mt4">
            <div class="col-md-6 d-flex align-items-end">
                <img class="by2 w-150 rounded mr-2 bg-white" src="<?php echo e(asset('upload/users')); ?>/<?php echo e(($user->photo) ? $user->photo : 'default.png'); ?>">
                <div>
                    <h3><?php echo e($user->name); ?></h3>
                    <div class="d-flex align-items-center">
                        <img class="lazyload" src="<?php echo e(asset('upload/users/lavel1.png')); ?>">
                        <p class="bt" title="Verified Bonik">Verified Bonik</p>
                    </div>
                    <p>Member Since <?php echo e(Carbon\Carbon::parse($user->created_at)->format(Config::get('siteSetting.date_format'))); ?></p>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-end align-items-end">
                <div>
                    <a
                    <?php if(Auth::check()): ?>
                        onclick="report(<?php echo e($user->id); ?>)" data-toggle="tooltip"
                    <?php else: ?>
                        data-toggle="modal" data-target="#so_sociallogin"
                    <?php endif; ?>
                    class="btn btn-danger" href="javascript:void(0)">Report user</a>
                    <a
                    <?php if(Auth::check()): ?>
                        onclick="follower(<?php echo e($user->id); ?>)"
                    <?php else: ?>
                        data-toggle="modal" data-target="#so_sociallogin"
                    <?php endif; ?>
                    class="btn btn-success" id="follower" href="javascript:void(0)">
                        <?php if(Auth::check() && App\Models\FavoriteSeller::where('user_id', Auth::id())->where('follower_id', $user->id)->first()): ?>
                        <i class="fa fa-thumbs-down"></i> Unfollow
                        <?php else: ?>
                        <i class="fa fa-thumbs-up"></i> Follow
                        <?php endif; ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container bg-white px-0 py-2 mb-3">
        <div class="row">
            <div class="col-md-4 col-12">
                <div class="d-flex align-items-center border-bottom pb-2 mb-2">
                    <p class="mr-2">Bonik ID: </p>
                    <b><?php echo e($user->id); ?></b>
                </div>
                <div class="d-flex align-items-center border-bottom pb-2 mb-2">
                    <p class="mr-2">Published: </p>
                    <b><?php echo e($posts->total()); ?> Ads</b>
                </div>
                <?php if($user->mobile): ?>
                <div class="d-flex align-items-center border-bottom pb-2 mb-2">
                    <img width="25" height="25" class="mr-2" src="<?php echo e(asset('upload/images/phones.png')); ?>" alt="logo">
                    <b><?php echo e($user->mobile); ?></b>
                </div>
                <?php endif; ?>
                <?php if($user->email): ?>
                <div class="d-flex align-items-center border-bottom pb-2 mb-2">
                    <img width="25" height="25" class="mr-2" src="<?php echo e(asset('upload/images/envelope.png')); ?>" alt="logo">
                    <b><?php echo e($user->email); ?> <br><p class="font-weight-normal">via BonikBazar</p></b>
                </div>
                <?php endif; ?>
                <div class="d-flex align-items-center border-bottom pb-2 mb-2">
                    <img width="25" height="25" class="mr-2" src="<?php echo e(asset('upload/images/time.png')); ?>" alt="logo">
                    <div class="w-100">
                        <div class="d-flex justify-content-between">
                            <p>Now Open</p>
                            <p>Closed</p>
                        </div>
                        <b>9.00 AM - 8.00 PM</b>
                    </div>
                </div>
                <div class="d-flex align-items-center border-bottom pb-2 mb-2">
                    <img width="25" height="25" class="mr-2" src="<?php echo e(asset('upload/images/maps.png')); ?>" alt="logo">
                    <b>
                        <?php if($user->address): ?>
                            <?php echo e($user->address); ?>,
                        <?php endif; ?>
                        <?php if($user->get_city): ?>
                            <?php echo e($user->get_city->name); ?>, 
                        <?php endif; ?> <?php if($user->get_state): ?>
                            <?php echo e($user->get_state->name); ?>

                        <?php endif; ?>
                    </b>
                </div>
                <div class="d-flex">
                    <p></p>
                    <b></b>
                </div>
            </div>
            <div class="col-md-8 col-12">
                <?php if(count($posts)>0): ?>
                    <div class="hl-2">
                    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="w-100 ab p-2 mb-2 position-relative">
                        <a class="w-100" href="<?php echo e(route('post_details', $post->slug)); ?>">
                            <div class="position-relative">
                                <div class="d-flex align-items-center position-absolute left-0 top-0 ">
                                    <div class="yb bt px-3 font-weight-bold">USED</div>
                                    <div class="ff"></div>
                                </div>
                                
                                <img class="position-absolute right-0 top-0 lazyload" src="<?php echo e(asset('upload/images/urgent.png')); ?>">
                                <img class="lazyload w-100" src="<?php echo e(asset('upload/images/product/thumb/default.jpg')); ?>" data-src="<?php echo e(asset('upload/images/product/thumb/'. $post->feature_image)); ?>" alt="<?php echo e($post->title); ?>">
                            </div>
                            <div class="w-100">
                                <h4 class="font-weight-bold bt py-1" title=""><?php echo e($post->title); ?></h4>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <div class="d-flex align-items-center">
                                            <img class="lazyload" src="<?php echo e(asset('upload/users/lavel1.png')); ?>">
                                            <p class="bt" title="Verified Bonik">Verified Bonik</p>
                                        </div>
                                        <p class="bt py-1" title="">Dhaka</p>
                                    </div>
                                    <div>
                                        <img class="lazyload" src="<?php echo e(asset('upload/users/pin.png')); ?>">
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="font-weight-bold bt py-1"><?php echo e(Config::get('siteSetting.currency_symble') . $post->price); ?></h4>
                                    <p class="bt py-1">(<?php echo e($post->views); ?>) <?php echo e(Carbon\Carbon::parse($post->created_at)->format(Config::get('siteSetting.date_format'))); ?></p>
                                </div>
                            </div>
                        </a>
                        <div class="d-flex align-items-center bb2 rounded shadow w-100">
                            <input type="text" class="px-2 py-1 w-100 rounded" placeholder="Username">
                            <button><img height="23" src="<?php echo e(asset('upload/images/chat2.png')); ?>"></button>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php echo e($posts->appends(request()->query())->links()); ?>

                <?php else: ?>
                    <h1>Posts not found.!</h1>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="reportModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>User report</h4>
                    <button class="fa fa-times" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(route('sellerReport')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="seller_id" value="<?php echo e($user->id); ?>">
                        <div id="reportForm"></div>
                    </form>
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
                    $('#follower').html(data.msg);
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
                type:'user'
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
    



<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bonik\resources\views/frontend/user/user_profile.blade.php ENDPATH**/ ?>