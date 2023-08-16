<?php $__env->startSection('title', 'Dashboard | '. Config::get('siteSetting.site_name') ); ?>
<?php $__env->startSection('css'); ?>
 <link rel="stylesheet" href="<?php echo e(asset('frontend')); ?>/css/custom/dashboard.css">

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
        <section class="dash-header-part">
            <div class="container">
                <div class="row">
                    <!--Right Part Start -->
                    <?php echo $__env->make('users.inc.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <!--Middle Part Start-->
                    <div class="col-md-9 sticky-conent">
                        <div class="dash-header-card">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="dash-header-left">

                                        <div class="dash-intro">
                                            <h4><a href="#"><?php echo e($user->name); ?></a></h4>
                                            <h5>Member Since: <?php echo e(Carbon\Carbon::parse($user->created_at)->format(Config::get('siteSetting.date_format'))); ?></h5>
                                            <ul class="dash-meta">
                                                <li>
                                                    <i class="fas fa-phone-alt"></i>
                                                    <span><?php echo e($user->mobile); ?></span>
                                                </li>
                                                <?php if($user->email): ?>
                                                <li>
                                                    <i class="fas fa-envelope"></i>
                                                    <span><?php echo e($user->email); ?></span>
                                                </li><?php endif; ?>
                                                <li>
                                                    <i class="fas fa-map-marker"></i>
                                                    <span><?php if($user->get_state): ?> <?php echo e($user->get_state->name); ?>, <?php endif; ?> <?php if($user->get_city): ?> <?php echo e($user->get_city->name); ?> <?php endif; ?>
                                                        <br><?php echo e($user->address); ?></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="dash-header-right">
                                        <div class="dash-focus dash-list">
                                            <h2><?php echo e($total_posts); ?></h2>
                                            <p>listing ads</p>
                                        </div>
                                        <div class="dash-focus dash-book">
                                            <h2><?php echo e($follower); ?></h2>
                                            <p>follower</p>
                                        </div>
                                        <div class="dash-focus dash-rev">
                                            <h2><?php echo e($following); ?></h2>
                                            <p>following</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if($user->user_dsc): ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="dash-header-alert">
                                        <p><?php echo e($user->user_dsc); ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>

                            <section style="margin-top: 15px;">
                                <h4>Published Ads</h4>
                                <div class="table-responsive">
                                    <table id="config-table" class="table post-list table-hover ">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>Ads Title</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(count($posts)>0): ?>
                                            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr id="item<?php echo e($post->id); ?>">
                                                <td><?php echo e($index+1); ?></td>
                                                <td><a  target="_blank" href="<?php echo e(route('post_details', $post->slug)); ?>"><img src="<?php echo e(asset('upload/images/product/thumb/'. $post->feature_image)); ?>" width="80"></a></td>
                                                <td><a target="_blank" style="color:#000" href="<?php echo e(route('post_details', $post->slug)); ?>"> <?php echo e($post->title); ?> </a><br/>


                                                <?php echo e(Config::get('siteSetting.currency_symble') . $post->price); ?><br/>

                                                    <p class="fa fa-clock" style="font-size:10px"> <?php echo e(Carbon\Carbon::parse($post->created_at)->format(Config::get('siteSetting.date_format'))); ?></p>
                                                    <p style="font-size:10px" class="fa fa-eye"> Views <?php echo e($post->views); ?> </p>

                                                </td>

                                                <td>

                                                    <span class="post-status badge <?php if($post->status == 'reject'): ?> badge-danger <?php elseif($post->status == 'active'): ?> badge-success <?php else: ?> badge-info <?php endif; ?>"> <?php echo e($post->status); ?> </span>

                                                </td>

                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                            <tr style="text-align: center;"><td colspan="8">Posts not found.!</td></tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\jotesto\resources\views/users/dashboard.blade.php ENDPATH**/ ?>