
<?php $__env->startSection('title', 'package lists'); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('assets')); ?>/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/pages/stylish-tooltip.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets')); ?>/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets')); ?>/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
    <style type="text/css">
        .payment-method, .customer{ max-width: 150px !important; font-size: 12px; }
        .label-return{background: #ff6226;}
        .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn){max-width: 100px;}
        #orerControll .form-control{padding: 3px;}

    </style>
    <!-- page CSS -->
    <link href="<?php echo e(asset('assets')); ?>/node_modules/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor"> Package History</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <a class="btn btn-info btn-sm d-none d-lg-block m-l-15" href="<?php echo e(route('admin.packageList')); ?>"><i class="fa fa-eye"></i> Package lists</a>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->

            
                

            <div class="row">
                <div class="col-lg-12">
                    <div class="card" style="margin-bottom: 2px;">
                        <form action="<?php echo e(route('admin.packageList')); ?>" id="orerControll" method="get">
                            <div class="form-body">
                                <div class="card-body" style="padding-bottom: 0;">
                                    <div class="row">
                                        
                                        <div class="col-md-2 col-6">
                                            <div class="form-group">
                                                <label class="control-label">Package</label>
                                                <input name="package" value="<?php echo e(Request::get('package')); ?>" type="text" placeholder="package name" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-2 col-6">
                                            <div class="form-group">
                                                <label class="control-label"> Status  </label>
                                                <select name="status" class="form-control">
                                                <option value="">Select Status</option>
                                                <option value="pending" <?php echo e((Request::get('status') == 'pending') ? 'selected' : ''); ?> >Pending</option>
                                                <option value="received" <?php echo e((Request::get('status') == 'received') ? 'selected' : ''); ?>>Received</option>
                                               
                                                <option value="paid" <?php echo e((Request::get('status') == 'paid') ? 'selected' : ''); ?>>Paid</option>
                                               
                                                <option value="all" <?php echo e((Request::get('status') == "all") ? 'selected' : ''); ?>>All</option>
                                            </select>
                                            </div>
                                        </div>  
                                        <div class="col-md-2 col-6">
                                            <div class="form-group">
                                                <label class="control-label">From Date</label>
                                                <input name="from_date" value="<?php echo e(Request::get('from_date')); ?>" type="date" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-6">
                                            <div class="form-group">
                                                <label class="control-label">End Date</label>
                                                <input name="end_date" value="<?php echo e(Request::get('end_date')); ?>" type="date" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-6">
                                            <div class="form-group">
                                                <label class="control-label">.</label>
                                               <button type="submit" class="form-control btn btn-success"><i style="color:#fff; font-size: 20px;" class="ti-search"></i> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                        <h3>
                            <?php if(Route::current()->getName() == 'package.search'): ?>
                                Total Record: (<?php echo e(count($packages)); ?>)
                            <?php endif; ?>
                        </h3>
                        <div class="table-responsive">
                            <table class="table display table-bpackageed table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Invoice</th>
                                        <th>Package</th>
                                        <th>Customer</th>
                                        
                                        <th>Category</th>
                                        <th>Total Ads</th>
                                        <th>Remaining Ads</th>
                                        <th>Duration</th>
                                        <th style="min-width: 100px;">Price</th>
                                        <th>Pay_method</th>
                                        <th>Payment</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(count($packages)>0): ?>
                                        <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php 

                                            $total_price = $package->price ?>
                                        <tr id="<?php echo e($package->package_id); ?>" <?php if($package->order_status == 'cancel'): ?> style="background:#ff000026" <?php endif; ?> >
                                            <td><?php echo e((($packages->perPage() * $packages->currentPage() - $packages->perPage()) + ($index+1) )); ?></td> 
                                            <td><?php echo e($package->order_id); ?></td>
                                           <td>
                                            <?php if($package->package_id == 'post_fee'): ?> Ad post fee <?php else: ?>
                                            <img width="30" src="<?php echo e(asset('upload/images/package/'.$package->get_package->ribbon)); ?>"> <?php echo e($package->get_package->name); ?>

                                             <p style="font-size: 12px;margin: 0;padding: 0">
                                                <?php echo e(\Carbon\Carbon::parse($package->created_at)->format(Config::get('siteSetting.date_format'))); ?> <br/>
                                           <?php echo e(\Carbon\Carbon::parse($package->created_at)->format('h:i:s A')); ?></p> <?php endif; ?>
                                            </td>
                                           <td><?php echo e($package->customer_name); ?>

                                            <p style="font-size: 12px;margin: 0;padding: 0"><?php echo e($package->mobile); ?></p></td>

                                            <td><?php echo e(($package->get_category) ? $package->get_category->name : 'Not found.'); ?></td>
                                            <td><?php echo e($package->total_ads); ?> ads</td>
                                            <td><?php echo e($package->remaining_ads); ?> ads</td>
                                            <td><?php echo e($package->duration); ?> days</td>
                                            <td>
                                                <?php echo e($package->currency_sign); ?><?php echo e($total_price); ?>

                                                 
                                            </td>
                                            <td class ="payment-method"> 
                                                <span class="mytooltip tooltip-effect-2">
                                                <span class="label label-<?php echo e(($package->payment_method=='pending') ? 'danger' : 'success'); ?>"><?php echo e(str_replace( '-', ' ', $package->payment_method)); ?></span>
                                               
                                                <?php if($package->payment_info): ?>
                                                <span class="tooltip-content clearfix">
                                                <span class="tooltip-text">
                                                    <?php if($package->tnx_id): ?>
                                                    <strong>Tnx_id:</strong> <span> <?php echo e($package->tnx_id); ?></span><br/>
                                                    <?php endif; ?>
                                                    <?php echo e($package->payment_info); ?>

                                                </span> 
                                                </span>
                                                <?php endif; ?>
                                                </span>
                                            </td>
                                            <td>
                                                 
                                                <a href="javascript:void(0)" class="label btn-xs <?php if($package->payment_status == 'paid'): ?>  label-success <?php elseif($package->payment_status == 'received'): ?> label-info <?php else: ?> label-danger <?php endif; ?>">
                                                
                                                <span class="mytooltip tooltip-effect-2">
                                                <div <?php if($permission['is_edit']): ?> <?php if($package->payment_status != 'paid'): ?> onclick="orderPaymentPopup('<?php echo e(route("packagePaymentDetails", $package->id)); ?>')"  <?php endif; ?>  <?php endif; ?>  title="package payment info" data-toggle="tooltip"  class="text-inverse p-r-10" ><?php echo e($package->payment_status); ?> </div>
                                                </span>
                                                </a>

                                            </td>

                                        </tr>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?> <tr><td colspan="8"> <h1>No packages found.</h1></td></tr> <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- Column -->
            </div>
            <div class="row">
               <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                   <?php echo e($packages->appends(request()->query())->links()); ?>

                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 text-right">Showing <?php echo e($packages->firstItem()); ?> to <?php echo e($packages->lastItem()); ?> of total <?php echo e($packages->total()); ?> entries (<?php echo e($packages->lastPage()); ?> Pages)</div>
            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
   <div class="modal fade" id="getpackageDetails" style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="padding: 5px 15px;">
                    <h4 class="modal-title" id="myLargeModalLabel">Package Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" id="package_details"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <?php if($permission['is_edit']): ?>
    <div class="modal bs-example-modal-lg" id="orderPaymentModal" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Update payment info.</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <?php if(Session::has('error')): ?>
                    <div class="alert alert-danger">
                      <?php echo e(Session::get('error')); ?>

                    </div>
                <?php endif; ?>
                <div class="modal-body" id="orderPaymentDetails"></div> 
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

    <script type="text/javascript">
        function package_details(id){
            $('#package_details').html('<div class="loadingData"></div>');
            $('#getpackageDetails').modal('show');
            var  url = '<?php echo e(route("admin.getpackageDetails", ":id")); ?>';
            url = url.replace(':id',id);
            $.ajax({
            url:url,
            method:"get",
            success:function(data){
                if(data){
                    $("#package_details").html(data);
                    $('.selectpicker').selectpicker();
                    $('#'+id).css("background-color", "rgb(0 255 231 / 14%)");
                }
            }
        });
        }

        <?php if($permission['is_edit']): ?>
        function changepackageStatus(status, package_id) {
            if (confirm("Are you sure "+status+ " this package.?")) {
                var link = '<?php echo e(route("admin.changepackageStatus")); ?>';
                $.ajax({
                    url:link,
                    method:"get",
                    data:{'status': status, 'package_id': package_id},
                    success:function(data){
                        if(data.status){
                            $('#getpackageDetails').modal('hide');
                            toastr.success(data.message);
                        }else{
                            toastr.error(data.message);
                        }
                    }
                });
            }
            return false;
        }     

        //package cancel
        function packageCancelPopup(route) {
            document.getElementById('packageCancelRoute').value = route;
        }

        function packageCancel(route) {
            //separate id from route
            var id = route.split("/").pop();

            $.ajax({
                url:route,
                method:"get",
                success:function(data){
                    if(data.status){
                        $("#ship_status"+id).html('cancel');
                        toastr.success(data.msg);
                    }else{
                        toastr.error(data.msg);
                    }
                }
            });
        }


        function orderPaymentPopup(link){
            $('#orderPaymentModal').modal('show');
            $('#orderPaymentDetails').html('<div class="loadingData"></div>');
            $.ajax({
                url:link,
                method:"get",
                success:function(data){
                    $('#orderPaymentDetails').html(data);
                }
            });
        }

        function changePaymentStatus(status, order_id) {
            if (confirm("Are you sure change payment status "+status+".?")) {
                var link = '<?php echo e(route("changePaymentStatus")); ?>';
                $.ajax({
                    url:link,
                    method:"get",
                    data:{'status': status, 'order_id': order_id},
                    success:function(data){
                        if(data){
                            toastr.success(data.message);
                        }else{
                            toastr.error(data.message);
                        }
                    }
                });
            }
            return false;
        }  

        <?php endif; ?>   

    </script>

    <script src="<?php echo e(asset('assets')); ?>/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
        <script>
    // responsive table
        $('#config-table').DataTable({
            responsive: true, searching: false, paging: false, info: false, packageing: false
        });
    </script>

    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
 
    <script src="<?php echo e(asset('assets')); ?>/node_modules/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
 
    <script>
        function checkField(value, field){
            if(value != ""){
                $.ajax({
                    method:'get',
                    url:"<?php echo e(route('checkField')); ?>",
                    data:{table:'package_payments', field:field, value:value},
                    success:function(data){
                        if(data.status){
                            $('#'+field).html("");
                            
                            $('#submitBtn').removeAttr('disabled');
                            $('#submitBtn').removeAttr('style', 'cursor:not-allowed');
                            
                        }else{
                            $('#'+field).html("<span style='color:red'><i class='fa fa-times'></i> "+data.msg+"</span>");
                            
                            $('#submitBtn').attr('disabled', 'disabled');
                            $('#submitBtn').attr('style', 'cursor:not-allowed');
                            
                        }
                    },
                    error: function(jqXHR, exception) {
                        toastr.error('Unexpected error occur.');
                    }
                });
            }else{
                $('#'+field).html("<span style='color:red'>"+field +" is required</span>");
                $('#submitBtn').attr('disabled', 'disabled');
                $('#submitBtn').attr('style', 'cursor:not-allowed');   
            }
        }
        $(function () {
            $('.selectpicker').selectpicker();
        });
    </script>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>

    <script type="text/javascript">

    $(".select2").select2();
    </script>
 
    <script type="text/javascript">
        function reviewModal(package_id, product_id){
            $('#reviewModal').modal('show');
            $("#getReviewForm").html("<div class='loadingData-sm'></div>");
            $.ajax({
                url:'<?php echo e(route("adminGetReviewForm")); ?>',
                type:'get',
                data:{package_id:package_id,product_id:product_id},
                success:function(data){
                    if(data){
                       $('#getReviewForm').html(data);
                    }else{
                      toastr.error(data);
                    }
                }
            });
         }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bonik\resources\views/admin/package/purchasePackages.blade.php ENDPATH**/ ?>