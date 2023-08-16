
<?php $__env->startSection('title', 'Logo Setting'); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('assets')); ?>/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />

    <style type="text/css">
        .dropify_image{
            position: absolute;top: -8px!important;left: 19px !important; z-index: 9; background:#fff!important;
        }
        .info{color: red;font-size: 12px;}
    </style>
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
                
                    <div class="col-md-12 align-self-center ">
                        <div class="d-fl ">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">General</a></li>
                                <li class="breadcrumb-item ">Setting</li>
                                <li class="breadcrumb-item active">Logo</li>
                            </ol>
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
                    <div class="col-md-12">
                        <div class="card card-body">
                            <div class="title_head"> Set Logo </div>
                            <form action="<?php echo e(route('logoSettingUpdate', $setting->id)); ?>" enctype="multipart/form-data" method="post" id="generalSetting">
                            <?php echo csrf_field(); ?>
                        
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group"> 
                                        <label class="dropify_image">Main Logo</label>
                                        <input type="file" data-default-file="<?php echo e(asset('upload/images/logo/'.$setting->logo)); ?>" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg png gif"  data-max-file-size="5M"  name="logo" id="input-file-events">
                                        <p class="info">Image size: 200px*50px</p>
                                    </div>
                                    <?php if($errors->has('logo')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <?php echo e($errors->first('logo')); ?>

                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group"> 
                                        <label class="dropify_image">Invoice Logo</label>
                                        <input type="file" class="dropify" accept="image/*" data-type='image' data-default-file="<?php echo e(asset('upload/images/logo/'.$setting->invoice_logo)); ?>" data-allowed-file-extensions="jpg png gif"  data-max-file-size="5M"  name="invoice_logo" id="input-file-events">
                                        <p class="info">Image size: 200px*50px</p>
                                    </div>
                                    <?php if($errors->has('invoice_logo')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <?php echo e($errors->first('invoice_logo')); ?>

                                        </span>
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group"> 
                                        <label class="dropify_image">Favicon</label>
                                        <input type="file" class="dropify" accept="image/*" data-type='image' data-default-file="<?php echo e(asset('upload/images/logo/'.$setting->favicon)); ?>" data-allowed-file-extensions="jpg png gif"  data-max-file-size="5M"  name="favicon" id="input-file-events">
                                        <p class="info">Image size: 32px*32px</p>
                                    </div>
                                    <?php if($errors->has('favicon')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <?php echo e($errors->first('favicon')); ?>

                                        </span>
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group"> 
                                        <label class="dropify_image">Watermark</label>
                                        <input type="file" class="dropify" accept="image/*" data-type='image' data-default-file="<?php echo e(asset('upload/images/logo/'.$setting->watermark)); ?>" data-allowed-file-extensions="jpg png gif"  data-max-file-size="5M"  name="watermark" id="input-file-events">
                                        <p class="info">Image size: 350px*70px</p>
                                    </div>
                                    <?php if($errors->has('watermark')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <?php echo e($errors->first('watermark')); ?>

                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                    <div class="form-actions pull-right">
                                        <button type="submit"  name="submit" value="save" class="btn btn-success"> <i class="fa fa-save"></i> Update Logo</button>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
           
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('assets')); ?>/node_modules/dropify/dist/js/dropify.min.js"></script>
     <script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();
    });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bonik\resources\views/admin/setting/logo.blade.php ENDPATH**/ ?>