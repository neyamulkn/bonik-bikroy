 
<?php $__env->startSection('title', 'Post lists' ); ?>
<?php $__env->startSection('css'); ?>
<style type="text/css">
    .post-list{display: flex;justify-content: space-between;border-bottom: 1px solid #e3e0e0;padding: 8px 0;}
    .post-list a{line-height: 16px;font-size: 15px;}
    .post-status{text-transform: capitalize; margin: 0 5px;}
    .action{display: flex;flex-direction: column;justify-content: space-between;min-width: 90px;}
    .actionBtn{display: flex;flex-direction: column;justify-content: space-between;}
    .actionBtn a{margin-bottom: 8px;}
    .info-area{display: flex;padding:0 5px 5px;justify-content: space-between;align-items: center;}
    @media (max-width: 767px) {
        .post-list{flex-direction: column;}
        .actionBtn a{border-right: 1px solid #ccc;padding: 0 5px;margin: 0;}
        .actionBtn a:last-child{border: none;}
       .action { flex-direction: initial;}
       .actionBtn { flex-direction: initial;align-items: center;}
       
    }
.clockdiv{ display: inline-flex; margin: 0 auto; text-align: center; align-items: center;}
.count_d {position: relative;width: 28px;padding: 0;overflow: hidden;color: #46b700;}
.count_d:before{ content: '';  position: absolute;top: 0;left: 0;width: 100%;height: 50%;}
.count_d span { text-align: center; font-size: 14px; font-weight: 800;}
.count_d h2 { display: block; text-align: center; font-size: 8px; font-weight: 800; margin: 0;}

</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="user-area">
        <div class="container">
            <div class="row">
                <!--Right Part Start -->
                <?php echo $__env->make('users.inc.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!--Middle Part Start-->
                <div class="col-md-9 sticky-conent" style="background: #fff;padding-top: 15px;">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if(Session::has('success')): ?>
                            <div class="alert alert-success">
                              <strong>Success! </strong> <?php echo e(Session::get('success')); ?>

                            </div>
                            <?php endif; ?>
                            <?php if(Session::has('error')): ?>
                            <div class="alert alert-danger">
                              <strong>Error! </strong> <?php echo e(Session::get('error')); ?>

                            </div>
                            <?php endif; ?>
                            <form action="" method="get">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-6 col-md-4">
                                            <input name="title" placeholder="Title" value="<?php echo e(Request::get('title')); ?>" type="text" class="form-control">
                                        </div>
                                        <div class="col-6 col-md-3" style="margin-bottom: 5px;">
                                            <select name="status" class="form-control">
                                                <option value="all" <?php echo e((Request::get('status') == "all") ? 'selected' : ''); ?>>All Status</option>
                                                <option value="pending" <?php echo e((Request::get('status') == 'pending') ? 'selected' : ''); ?> >Pending</option>
                                                <option value="active" <?php echo e((Request::get('status') == 'active') ? 'selected' : ''); ?>>Active</option>
                                                <option value="deactive" <?php echo e((Request::get('status') == 'deactive') ? 'selected' : ''); ?>>Deactive</option>
                                                <option value="reject" <?php echo e((Request::get('status') == 'reject') ? 'selected' : ''); ?>>Reject</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <div class="form-group" >
                                               <button type="submit" class="form-control btn btn-success">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <ul>
                        <?php if(count($posts)>0): ?>
                        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="post-list" id="item<?php echo e($post->id); ?>">
                            <div style="display:flex;align-items: self-start;">

                            <a  target="_blank" href="<?php echo e(route('post_details', $post->slug)); ?>"><img src="<?php echo e(asset('upload/images/product/thumb/'. $post->feature_image)); ?>" width="120"></a>
                            <div class="info-area">
                                <div>
                                <a target="_blank" style="color:#000" href="<?php echo e(route('post_details', $post->slug)); ?>"> <?php echo e(Str::limit($post->title,45)); ?> </a><br/>
                                
                                    
                                    <p class="fa fa-clock" style="font-size:10px"> <?php echo e(Carbon\Carbon::parse(($post->approved) ? $post->approved : $post->created)->format(Config::get('siteSetting.date_format'))); ?></p>
                                    <p style="font-size:10px" class="fa fa-eye"> Views <?php echo e($post->views); ?> </p><br/>
                                    <p>
                                    <?php echo e(Config::get('siteSetting.currency_symble') . $post->price); ?></p>
                                    <?php if($post->approved): ?>
                                    <?php if(count($post->get_promotePackage)>0): ?>
                                        <?php if(now() <= $post->get_promotePackage[0]->end_date): ?> 

                                        <div class="clockdiv" data-date="<?php echo e($post->get_promotePackage[0]->end_date); ?>">
                                          <div class="count_d">
                                            <span class="days">0</span><sub>D</sub>
                                          </div>
                                          <div class="count_d">
                                            <span class="hours">0</span><sub>H</sub>
                                            </div>
                                            <div class="count_d">
                                              <span class="minutes">0</span><sub>M</sub>
                                            </div>
                                            <div class="count_d">
                                              <span class="seconds">0</span><sub>S</sub>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if($post->status == 'Not posted'): ?>
                                        <?php $last_free_post = App\Models\Product::where('subcategory_id', $post->subcategory_id)->where('user_id', $post->user_id)->where('id', '!=', $post->id)->orderBy('created_at', 'desc')->where('ad_type', 'free')->first();
                                        $days = 0;
                                        if($last_free_post){
                                        $to = \Carbon\Carbon::parse($last_free_post->created_at);
                                        $from = \Carbon\Carbon::parse(now());
                                        $days = $to->diffInDays($from);
                                        }
                                        $free_ads_duration = App\Models\SiteSetting::where('type', 'free_ads_limit')->first();

                                        ?>
                                        
                                        <?php if($free_ads_duration->status != 1 || $days >= $free_ads_duration->value ): ?>
                                        <p style="font-size:15px;color: green">Now available free post.</p>
                                        <?php else: ?>
                                        <!-- <p style="font-size:15px;color: red">Wait <?php echo e($free_ads_duration->value - $days); ?> days to post for free or pay to post now.</p> -->
                                        <?php endif; ?>
                                    <?php else: ?>
                                    <?php if($post->reject_reason): ?>
                                    <p style="font-size:15px;color: red"><?php echo e($post->reject_reason); ?></p>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="status">
                                    <span class="post-status badge <?php if($post->status == 'reject'): ?>  badge-danger <?php elseif($post->status == 'Not posted'): ?> badge-danger <?php elseif($post->status == 'active'): ?> badge-success <?php else: ?> badge-info <?php endif; ?>"> <?php echo e($post->status); ?> </span>
                                    
                                </div>
                            </div>
                               
                            </div>
                            <div class="action">
                               
                                <div class="actionBtn">
                                    <a title="Edit ads" href="<?php echo e(route('post.edit', $post->slug)); ?>"><i class="fa fa-pencil-alt"></i> Edit</a>
                                    <a href="javascript:void(0)" style="color:red;"  onclick='deleteModal(<?php echo e($post->id); ?>)' ><i class="fa fa-trash"></i> Delete</a> 
                                </div> 
                                <div >
                                    <?php if($post->status == 'reject'): ?>
                                    <a class="btn btn-danger btn-sm" title="Edit ads" href="<?php echo e(route('post.edit', $post->slug)); ?>"><i class="ti-pencil-alt"></i> Edit Post</a>
                                    

                                    <?php elseif($post->status == 'pending'): ?>
                                    <a class="btn btn-warning btn-sm" title="Review this post" href="<?php echo e(route('post.edit', $post->slug)); ?>"> In review</a>

                                    <?php elseif($post->status == 'Not posted' || $post->status == 'draft'): ?>
                                    <a class="bt btn-primary btn-sm" title="Wait for free or promote ads" href="<?php echo e(route('post.edit', $post->slug)); ?>?status=post-now"><i class="ti-pencil-alt"></i>Continue Editing</a>
                                    <?php endif; ?>
                                 </div>                                    
                            </div>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <li style="text-align: center;">Posts not found.!</li>
                        <?php endif; ?>

                        <li style="margin: 5px"><?php echo e($posts->appends(request()->query())->links()); ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
   
    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Post Delete</h4>
                    <button class="fas fa-times" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(route('post.delete')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="product_id" id="product_id">
                         
                        <div class="row justify-content-md-center">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="required" for="reason">Delete Reason</label>
                                    <select required name="reason" class="form-control">
                                        <option value="">Select reason</option>
                                    <?php $__currentLoopData = $reasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($reason->reason); ?>"><?php echo e($reason->reason); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="required" for="reason_details">Please describe delete reason.</label>
                                    <textarea class="form-control" required minlength="6" rows="2" id="reason_details" placeholder="Write reason details" name="reason_details"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger"> Delete Now</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>  
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">
    function deleteModal(product_id){
        $('#deleteModal').modal('show');
        $('#product_id').val(product_id);
    }
    document.addEventListener('readystatechange', event => {
        if (event.target.readyState === "complete") {
            var clockdiv = document.getElementsByClassName("clockdiv");
          var countDownDate = new Array();
            for (var i = 0; i < clockdiv.length; i++) {
                countDownDate[i] = new Array();
                countDownDate[i]['el'] = clockdiv[i];
                countDownDate[i]['time'] = new Date(clockdiv[i].getAttribute('data-date')).getTime();
                countDownDate[i]['days'] = 0;
                countDownDate[i]['hours'] = 0;
                countDownDate[i]['seconds'] = 0;
                countDownDate[i]['minutes'] = 0;
            }
          
            var countdownfunction = setInterval(function() {
                for (var i = 0; i < countDownDate.length; i++) {
                    var now = new Date().getTime();
                    var distance = countDownDate[i]['time'] - now;
                    countDownDate[i]['days'] = Math.floor(distance / (1000 * 60 * 60 * 24));
                    countDownDate[i]['hours'] = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    countDownDate[i]['minutes'] = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    countDownDate[i]['seconds'] = Math.floor((distance % (1000 * 60)) / 1000);

                    if (distance < 0) {
                        countDownDate[i]['el'].querySelector('.days').innerHTML = 0;
                        countDownDate[i]['el'].querySelector('.hours').innerHTML = 0;
                        countDownDate[i]['el'].querySelector('.minutes').innerHTML = 0;
                        countDownDate[i]['el'].querySelector('.seconds').innerHTML = 0;
                    }else{
                        countDownDate[i]['el'].querySelector('.days').innerHTML = countDownDate[i]['days'];
                        countDownDate[i]['el'].querySelector('.hours').innerHTML = countDownDate[i]['hours'];
                        countDownDate[i]['el'].querySelector('.minutes').innerHTML = countDownDate[i]['minutes'];
                        countDownDate[i]['el'].querySelector('.seconds').innerHTML = countDownDate[i]['seconds'];
                    } 
                }
            }, 1000);
        }
    });
</script>  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\jotesto\resources\views/users/post/index.blade.php ENDPATH**/ ?>