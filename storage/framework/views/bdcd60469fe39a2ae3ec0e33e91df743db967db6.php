
<?php $__env->startSection('title', Config::get('siteSetting.title')); ?>
<?php $__env->startSection('metatag'); ?>
    <title><?php echo e(Config::get('siteSetting.title')); ?></title>
    <meta name="title" content="<?php echo e(Config::get('siteSetting.title')); ?>">
    <meta name="description" content="<?php echo e(Config::get('siteSetting.description')); ?>">
    <meta name="keywords" content="<?php echo e(Config::get('siteSetting.meta_keywords')); ?>" />
    <meta name="robots" content="index,follow" />

    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    <meta property="og:title" content="<?php echo e(Config::get('siteSetting.title')); ?>">
    <meta property="og:description" content="<?php echo e(Config::get('siteSetting.description')); ?>">
    <meta property="og:image" content="<?php echo e(asset('upload/images/'.Config::get('siteSetting.meta_image'))); ?>">
    <meta property="og:url" content="<?php echo e(url()->full()); ?>">
    <meta property="og:site_name" content="<?php echo e(Config::get('siteSetting.site_name')); ?>">
    <meta property="og:locale" content="bd">
    <meta property="og:type" content="e-commerce">
    <!-- Schema.org for Google -->

    <meta itemprop="title" content="<?php echo e(Config::get('siteSetting.title')); ?>">
    <meta itemprop="description" content="<?php echo e(Config::get('siteSetting.description')); ?>">
    <meta itemprop="image" content="<?php echo e(asset('upload/images/'.Config::get('siteSetting.meta_image'))); ?>">

    <!-- Twitter -->
    <meta name="twitter:card" content="<?php echo e(Config::get('siteSetting.title')); ?>">
    <meta name="twitter:title" content="<?php echo e(Config::get('siteSetting.title')); ?>">
    <meta name="twitter:description" content="<?php echo e(Config::get('siteSetting.description')); ?>">
    <meta name="twitter:site" content="<?php echo e(url('/')); ?>">
    <meta name="twitter:creator" content="@bonik">
    <meta name="twitter:image:src" content="<?php echo e(asset('upload/images/'.Config::get('siteSetting.meta_image'))); ?>">
    <meta name="twitter:player" content="#">
    <style>.home{display: none;}</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="">
    <div class="container px-0">
        <div class="row">
            <div class="col-md-3 px-0 d-flex flex-column justify-content-between hidden-xs">
                <div>
                    <div class="accordion w-100" id="accordion">
                        <div class="bg-white mb-3">
                            <div class="bb p-2" role="tab" id="headingOne">
                                <div class="w-100 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseOne">
                                    <div class="d-flex align-items-center">
                                        <img class="mr-1" src="<?php echo e(asset('upload/images/group.png')); ?>" alt="group">
                                        <h4 class="yt">Filter by</h4>
                                    </div>
                                    <img class="" src="<?php echo e(asset('upload/images/vector.png')); ?>" alt="vector">
                                </div>
                            </div>
                    
                            <div id="collapseOne" class="collapse show p-2" role="tabpanel" aria-labelledby="headingOne">
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="Urgent" id="Urgent">
                                    <label class="iy" for="Urgent">Urgent</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="Urgent" id="Urgent">
                                    <label class="iy" for="Urgent">Featured</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="Urgent" id="Urgent">
                                    <label class="iy" for="Urgent">Member Bonik</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="Urgent" id="Urgent">
                                    <label class="iy" for="Urgent">Verified Bonik</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="Urgent" id="Urgent">
                                    <label class="iy" for="Urgent">Dealers Bonik</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="Urgent" id="Urgent">
                                    <label class="iy" for="Urgent">Agent Bonik</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="Urgent" id="Urgent">
                                    <label class="iy" for="Urgent">Wholesale Bonik</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white mb-3">
                            <div class="bb p-2" role="tab" id="headingOne">
                                <div class="w-100 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseOne">
                                    <div class="d-flex align-items-center">
                                        <img class="mr-1" src="<?php echo e(asset('upload/images/group.png')); ?>" alt="group">
                                        <h4 class="yt">Filter by</h4>
                                    </div>
                                    <img class="" src="<?php echo e(asset('upload/images/vector.png')); ?>" alt="vector">
                                </div>
                            </div>
                    
                            <div id="collapseOne" class="collapse show p-2" role="tabpanel" aria-labelledby="headingOne">
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="Urgent" id="Urgent">
                                    <label class="iy" for="Urgent">Urgent</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="Urgent" id="Urgent">
                                    <label class="iy" for="Urgent">Featured</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="Urgent" id="Urgent">
                                    <label class="iy" for="Urgent">Member Bonik</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="Urgent" id="Urgent">
                                    <label class="iy" for="Urgent">Verified Bonik</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="Urgent" id="Urgent">
                                    <label class="iy" for="Urgent">Dealers Bonik</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="Urgent" id="Urgent">
                                    <label class="iy" for="Urgent">Agent Bonik</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="Urgent" id="Urgent">
                                    <label class="iy" for="Urgent">Wholesale Bonik</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white mb-3">
                            <div class="bb p-2" role="tab" id="heading3">
                                <div class="w-100 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapse3">
                                    <div class="d-flex align-items-center">
                                        <img class="mr-1" src="<?php echo e(asset('upload/images/group.png')); ?>" alt="group">
                                        <h4 class="yt">Filter by</h4>
                                    </div>
                                    <img class="" src="<?php echo e(asset('upload/images/vector.png')); ?>" alt="vector">
                                </div>
                            </div>
                    
                            <div id="collapse3" class="collapse show p-2" role="tabpanel" aria-labelledby="heading3">
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="bg-white mb-3 p-2">
                    <img class="w-100 mw-100" src="<?php echo e(asset('upload/images/banner.png')); ?>" alt="banner">
                </div>
                <div>
                    <div class="accordion w-100" id="accordion">
                        <div class="bg-white mb-3">
                            <div class="bb p-2" role="tab" id="heading4">
                                <div class="w-100 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapse4">
                                    <div class="d-flex align-items-center">
                                        <img class="mr-1" src="<?php echo e(asset('upload/images/group.png')); ?>" alt="group">
                                        <h4 class="yt">Filter by</h4>
                                    </div>
                                    <img class="" src="<?php echo e(asset('upload/images/vector.png')); ?>" alt="vector">
                                </div>
                            </div>
                    
                            <div id="collapse4" class="collapse show p-2" role="tabpanel" aria-labelledby="heading4">
                            </div>
                        </div>
                        
                        <div class="bg-white mb-3">
                            <div class="bb p-2" role="tab" id="heading5">
                                <div class="w-100 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapse5">
                                    <div class="d-flex align-items-center">
                                        <img class="mr-1" src="<?php echo e(asset('upload/images/group.png')); ?>" alt="group">
                                        <h4 class="yt">Filter by</h4>
                                    </div>
                                    <img class="" src="<?php echo e(asset('upload/images/vector.png')); ?>" alt="vector">
                                </div>
                            </div>
                    
                            <div id="collapse5" class="collapse show p-2" role="tabpanel" aria-labelledby="heading5">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-sm-12">
                <div class="homepage" >
                    <div id="loadProducts">
                        <!-- Load products here -->
                    </div>
                    <div class="ajax-load text-center" id="data-loader">
                        <img src="<?php echo e(asset('frontend/images/loading.gif')); ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-2 hidden-xs p-0 bg-white mb-3">
                <img class="w-100 sticky-top" src="<?php echo e(asset('upload/images/banners.png')); ?>" alt="banner">
            </div>
            <div class="col-md-12 p-2 bg-white mb-3">
                <img class="w-100" src="<?php echo e(asset('upload/images/ads.png')); ?>" alt="banner">
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        var page = 1;
        loadMoreProducts(page);
        function loadMoreProducts(page){
            $.ajax(
                {
                    url: '?page=' + page,
                    type: "get",
                    beforeSend: function()
                    {
                        $('.ajax-load').show();
                    }
                })
            .done(function(data)
            {
                $('.ajax-load').hide();
                $("#loadProducts").append(data.html);

                //check section last page
                if(page <= '<?php echo e($sections->lastPage()); ?>' ){
                    page++;
                    loadMoreProducts(page);
                }
                 
            })
            .fail(function(jqXHR, ajaxOptions, thrownError)
            {
                $('.ajax-load').hide();
            });
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bonik\resources\views/frontend/home.blade.php ENDPATH**/ ?>