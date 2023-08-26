
<?php $__env->startSection('title', 'Membership list'); ?>
<?php $__env->startSection('css-top'); ?>
    <link href="<?php echo e(asset('assets')); ?>/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
   
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('assets')); ?>/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('assets')); ?>/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">

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
                    <h4 class="text-themecolor">Membership List</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Membership</a></li>
                            <li class="breadcrumb-item active">list</li>
                        </ol>
                        <?php if($permission['is_add']): ?>
                        <button data-toggle="modal" data-target="#add" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Add New Membership</button><?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-body">

                            <div class="table-responsive">
                                <table id="myTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Ribbon</th>
                                            <th>Membership Name</th>
                                            <th>Ribbon Position</th>
                                            <th>Status</th>
                                            <th>Set Duration</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $get_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr id="item<?php echo e($data->id); ?>">
                                            <td><img width="60" src="<?php echo e(asset('upload/images/membership/'.$data->ribbon)); ?>"></td>
                                            <td><?php echo e($data->name); ?></td>
                                            <td><?php echo e($data->ribbon_position); ?></td>
                                            
                                            <td><?php echo ($data->status == 1) ? "<span class='label label-info'>Active</span>" : '<span class="label label-danger">Deactive</span>'; ?>

                                            </td>
                                            <td><a href="<?php echo e(route('membershipDuration', $data->slug)); ?>"  class="btn btn-success btn-sm"><i class="ti-plus" aria-hidden="true"></i> Set & View Duration</a>
                                               
                                            </td>
                                            <td>
                                                <?php if($permission['is_edit']): ?>
                                                <button type="button" onclick="edit('<?php echo e($data->id); ?>')"  data-toggle="modal" data-target="#edit" class="btn btn-info btn-sm"><i class="ti-pencil" aria-hidden="true"></i> Edit</button><?php endif; ?>
                                                <?php if($data->is_default != 1 && $permission['is_delete']): ?>
                                                <button data-target="#delete" onclick="deleteConfirmPopup('<?php echo e(route("membership.delete", $data->id)); ?>')" class="btn btn-danger btn-sm" data-toggle="modal"><i class="ti-trash" aria-hidden="true"></i> Delete</button><?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->

        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- add Modal -->
    <div class="modal fade" id="add" style="display: none;">
        <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create New Membership</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="<?php echo e(route('membership.store')); ?>" enctype="multipart/form-data" method="POST">
                    <?php echo e(csrf_field()); ?>

                    <div class="modal-body form-row">

                        <div class="card-body">

                                <div class="form-body">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name required">Membership Name</label>
                                                <input name="name" placeholder="Write Membership name" id="name" value="<?php echo e(old('name')); ?>" required="" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-6 col-md-6">
                                            <div class="form-group">
                                                <label for="ribbon">Ribbon Image</label>
                                                <input name="ribbon" id="ribbon" type="file" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-md-6">
                                            <div class="form-group">
                                                <label for="name">Ribbon Position</label>
                                                <select name="ribbon_position" class="form-control">
                                                    <option value="top-left">Top left</option>
                                                    <option value="top-right">Top right</option>
                                                    <option value="bottom-left">Bottom left</option>
                                                    <option value="bottom-right">Bottom right</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Membership Details</label>
                                                <textarea name="details" rows="1" id="name" value="<?php echo e(old('details')); ?>" placeholder="Write Membership details" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    
                                        <div class="col-md-6">
                                           <span class="switch-box">Status</span>
                                            <div class="head-label">

                                                <div  class="status-btn" >
                                                    <div class="custom-control custom-switch">
                                                        <input name="status" checked  type="checkbox" class="custom-control-input" <?php echo e((old('status') == 'on') ? 'checked' : ''); ?> id="status">
                                                        <label  class="custom-control-label" for="status">Active/Deactive</label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                     <div class="modal-footer">
                        <button type="submit" name="submit" value="add" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                        <button type="button" data-dismiss="modal" class="btn btn-inverse">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

 
    <!-- update Modal -->
    <div class="modal fade" id="edit" role="dialog"   style="display: none;">
        <div class="modal-dialog">
            <form action="<?php echo e(route('membership.update')); ?>"  enctype="multipart/form-data" method="post">
                  <?php echo e(csrf_field()); ?>

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Membership</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body form-row" id="edit_form"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-success">Update</button>
                </div>
              </div>
            </form>
        </div>
    </div>
    <!-- delete Modal -->
    <?php echo $__env->make('admin.modal.delete-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <!-- This is data table -->
    <script src="<?php echo e(asset('assets')); ?>/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
   <script>
        $(".select2").select2();
        $(function () {
            $('#myTable').DataTable();
        });

        function setValue(id){
            document.getElementById('setValueId').value = id;
        }
    </script>

    <script type="text/javascript">

        function edit(id){
            $('#edit_form').html('<div class="loadingData"></div>');
            var  url = '<?php echo e(route("membership.edit", ":id")); ?>';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    if(data){
                        $("#edit_form").html(data);
                        
                },
                // $ID Error display id name
                <?php echo $__env->make('common.ajaxError', ['ID' => 'edit_form'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            });

        }

    $("#displayIn").change(function() {
        if(this.checked) { $("#displayInDetailsPage").show(); }
        else { $("#displayInDetailsPage").hide(); }
    });


</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bonik\resources\views/admin/membership/index.blade.php ENDPATH**/ ?>