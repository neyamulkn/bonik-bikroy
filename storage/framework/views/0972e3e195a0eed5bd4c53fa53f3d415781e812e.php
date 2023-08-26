 
<?php $__env->startSection('title', 'Post lists' ); ?>
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container bg-white mb-2 py-3 px-0">
        <div class="row">
            <div class="col-12 col-md-3">
                <?php echo $__env->make('users.inc.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="col-12 col-md-9">
                <?php if(count($advertisements)>0): ?>
               
                <div class="table-responsive">
                    <table id="config-table" class="table post-list table-hover ">
                        <thead class="hidden-xs">
                            <tr>
                                <th>Banner</th>
                                <th>Link</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $advertisements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="d-h-flex" id="item<?php echo e($ad->id); ?>">
                                <td>
                                    <a target="_blank" class="w-100" href="<?php echo e($ad->redirect_url); ?>">
                                        <img class="iuser" width="100" src="<?php echo e(asset('upload/marketing/'. $ad->image)); ?>">
                                    </a>
                                </td>
                                <td>
                                    <a target="_blank"  href="<?php echo e($ad->redirect_url); ?>">
                                       <?php echo e($ad->redirect_url); ?>

                                    </a>
                                    <div class="d-flex flex-column">
                                        
                                        Position: <?php echo e($ad->position); ?>

                                        
                                        <p><?php echo e(Config::get('siteSetting.currency_symble')); ?>. <?php echo e($ad->amount); ?></p>
                                        
                                        <p><?php echo e(Carbon\Carbon::parse($ad->start_date)->format(Config::get('siteSetting.date_format'))); ?></p>
                                        <p>Views <?php echo e($ad->views); ?></p>
                                        
                                    </div>
                                </td>
                                
                                <td class="action">
                                   <div class="status">
                                        <span class="post-status badge <?php if($ad->status == 'reject'): ?>  badge-danger <?php elseif($ad->status == 0): ?> badge-danger <?php elseif($ad->status == 1): ?> badge-success <?php else: ?> badge-info <?php endif; ?>"> <?php if($ad->status == 1): ?> Active <?php elseif($ad->status == 0): ?> Deactive <?php else: ?>  <?php echo e($ad->status); ?> <?php endif; ?></span>
                                        
                                    </div>
                                    <div class="actionBtn">
                                       
                                        <a href="javascript:void(0)" style="color:red;" data-target="#delete" data-toggle="modal" onclick="confirmPopup(<?php echo e($ad->id); ?>)" ><i class="fa fa-trash"></i> Delete</a> 
                                    </div>                           
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <tr style="margin: 5px"><?php echo e($advertisements->appends(request()->query())->links()); ?></tr>
                        </tbody>
                    </table>
                </div>
                <?php else: ?>
                <h3 class="pb-2 mb-2 border-bottom"><?php echo e(Auth::user()->name); ?></h3>
                <div class="my-5 pt-md-5">
                    <div class="d-flex justify-content-center align-items-center">
                        <img width="95" height="63" src="https://w.bikroy-st.com/dist/img/all/shop/empty-1x-6561cc5e.png">
                        <div class="ml-3 text-center">
                            <h4>You don't have any ads yet.</h4>
                            <p>Click the "Post an ad now!" button to post your ad.</p>
                        </div>
                    </div>
                    <p class="d-flex justify-content-center align-items-end my-5">
                        <img height="56" src="<?php echo e(asset('upload/images/as.jpg')); ?>">
                        <a class="yb p-2 text-center bt bb2 rounded font-weight-bold f-12 mx-3 mb-n3" href="<?php echo e(route('post.create')); ?>">Post your ad now!</a>
                        <img height="56" style="-webkit-transform: scaleX(-1);transform: scaleX(-1);" src="<?php echo e(asset('upload/images/as.jpg')); ?>">
                    </p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div id="delete" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <h4 class="modal-title">Are you sure?</h4>
                    <p>Do you really want to delete these records? This process cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                    <button type="button" value="" id="itemID" onclick="deleteItem(this.value)" data-dismiss="modal" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
 
    <script type="text/javascript">


     function confirmPopup(id) {

        document.getElementById('itemID').value = id;
     }
    function deleteItem(id) {

        var link = '<?php echo e(route("linkAd.delete", ":id")); ?>';
        var link = link.replace(':id', id);
       
            $.ajax({
            url:link,
            method:"get",
            success:function(data){
                if(data.status){
                    $("#item"+id).hide();
                    toastr.success(data.msg);
                }else{
                    toastr.error(data.msg);
                }
            }

        });
    }

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bonik\resources\views/users/linkAds/index.blade.php ENDPATH**/ ?>