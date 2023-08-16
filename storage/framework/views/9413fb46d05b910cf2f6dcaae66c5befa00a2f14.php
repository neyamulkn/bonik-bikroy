 
<?php $__env->startSection('title', 'Promote Ads Post' ); ?>
<?php $__env->startSection('css'); ?>
<style type="text/css">
    .post-list a{line-height: 16px;font-size: 15px;}
    .clockdiv{ display: inline-flex; margin: 0 auto; text-align: center; align-items: center;}
.count_d {position: relative;width: 28px;padding: 5px 0px 15px;margin: 0px 1px;border-radius: 5px;overflow: hidden;color: #46b700;}
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
                    <h4><?php echo e($package->name); ?> ads promote history</h4>
                    <div class="table-responsive">
                        <table id="config-table" class="table post-list table-hover ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Post</th>
                                    <th>Duration</th>
                                    <th>Remaing Time</th>
                                </tr>
                            </thead> 
                            <tbody>
                                <?php if(count($promoteAds)>0): ?>
                                <?php $__currentLoopData = $promoteAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                <tr id="item<?php echo e($post->id); ?>">
                                    <td><?php echo e($index+1); ?></td>
                                    <td>
                                        <?php if($post->get_adPost): ?>
                                        <a  target="_blank" href="<?php echo e(route('post_details', $post->get_adPost->slug)); ?>"><img src="<?php echo e(asset('upload/images/product/thumb/'. $post->get_adPost->feature_image)); ?>" width="80">
                                   <?php echo e($post->get_adPost->title); ?> </a><br/>
                                    <?php echo e(Config::get('siteSetting.currency_symble') . $post->get_adPost->price); ?><br/>
                                        <p class="fa fa-clock" style="font-size:10px"> <?php echo e(Carbon\Carbon::parse($post->get_adPost->approved)->format(Config::get('siteSetting.date_format'))); ?></p>
                                        <p style="font-size:10px" class="fa fa-eye"> Views <?php echo e($post->get_adPost->views); ?> </p>
                                        <?php else: ?> Post not found <?php endif; ?>
                                    </td>
                                    <td><?php echo e($post->duration); ?> days</td>
                                    <td>
                                        <?php if($post->status == 1): ?>
                                            <?php if(now() > $post->end_date): ?> 
                                                <span class="label label-danger">  Expired </span> 
                                            <?php else: ?>  
                                                <div class="clockdiv" data-date="<?php echo e($post->end_date); ?>">
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
                                        <?php else: ?>
                                            <span class="label label-warning"> Pending </span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <tr style="text-align: center;"><td colspan="8">Posts not found.!</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">

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


<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bonik\resources\views/users/post/promoteAdsHistory.blade.php ENDPATH**/ ?>