
<?php $__env->startSection('title', ($category) ? $category->name : 'All ads' . ' | '. Config::get('siteSetting.site_name') ); ?>
<?php $__env->startSection('css'); ?>
    <style type="text/css">
        .page-info{font-size: 14px;}
        .filterBtn{background: #fff;text-align: left; border: none; padding: 0px 3px; font-weight: 600;font-size: 14px;}
        .filter{position: fixed;top: 0;background: #fff;z-index: 999;padding: 10px; display: none; overflow-y: scroll;height: 100%;}
        .product-widget-dropitem{padding-left: 5px;}
        .product-meta span{color: var(--gray);font-size: 12px}
        .product-meta {display: flex; flex-direction: column;}
        .product-info{padding: 0;border: none;}
        .page-item.active .page-link{background:#EB5206;}
        @media (max-width: 575px) {
            #verify-seller .product-img{width: 135px;}
          .featurePromotePost{padding: 0;}
          #filter_product{min-height:150px}
      }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
 
    <?php
    $topOfContent = $middleOfContent = $bottomOfContent = $sitebarTop = $sitebarMiddle = $sitebarBottom = null ;
    foreach ($get_ads as $ads){
        if($ads->position == 'top-content'){
            $topOfContent = ($ads->adsType == 'image') ? '<a  href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code;
        }elseif($ads->position == 'sidebar-top'){
            $sitebarTop = '<div class="sidebar">'. ($ads->adsType == 'image' ? '<a  href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code) . '</div>';
        }elseif($ads->position == 'sidebar-middle'){
            $sitebarMiddle = '<div class="sidebar">'. ($ads->adsType == 'image' ? '<a  href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code) . '</div>';
        }elseif($ads->position == 'sidebar-bottom'){
            $sitebarBottom = '<div class="sidebar">'. ($ads->adsType == 'image' ? '<a href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code) . '</div>' ; 
        }elseif($ads->position == 'bottom-content'){
            $bottomOfContent = ($ads->adsType == 'image') ? '<a  href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code;
        }else{
            echo '';
        }
    }
    if($category){
        if($category->parent_id && $category->subcategory_id){ $maincategory = $category->get_category->get_category->name; $maincategory_slug = $category->get_category->get_category->slug; }  
        elseif($category->parent_id){$maincategory = $category->get_category->name; $maincategory_slug = $category->get_category->slug;} else{ $maincategory =  $category->name ; $maincategory_slug =  $category->slug ; }


        if($category->parent_id && $category->subcategory_id){ $subcategory = $category->get_category->name; $subcategory_slug = $category->get_category->slug; } 
        elseif($category->parent_id){$subcategory = $category->name; $subcategory_slug = $category->slug; } else{ $subcategory = null; }

        $childcategory = ($category->parent_id && $category->subcategory_id ? $category->name : null);

        $category_name = ($subcategory) ? $subcategory : $maincategory;
    }
    ?>
    <?php if((new \Jenssegers\Agent\Agent())->isDesktop()): ?>
    <div class="breadcrumbs">
        <div class="container" style="padding: 0">
            <ul class="breadcrumb-cate">
                <li style="padding-left:0"><a href="<?php echo e(url('/')); ?>"><i  class="fa fa-home"></i> </a></li>
                <?php if($category): ?>
                    <li><a href="<?php echo e(route('home.category', $maincategory_slug )); ?>"><?php echo e($maincategory); ?></a></li>
                    <?php if($subcategory): ?>
                    <li><a href="<?php echo e(route('home.category', $subcategory_slug )); ?>"><?php echo e($category_name); ?></a></li>
                    <?php endif; ?>
                    <?php if($subcategory): ?>
                    <li><a href="javascript:void(0)"><?php echo e(str_replace('-', ' ', $childcategory)); ?></a></li>
                    <?php endif; ?>
                <?php else: ?>
                 <li><a href="javascript:void(0)">All Ads</a></li>
                <?php endif; ?>
             </ul>
        </div>
    </div>
    <?php endif; ?>
    <div class="container advertising" style="padding: 10px;margin-bottom: 1em;background: white;"><?php echo $topOfContent; ?></div>
    <section class="inner-section ad-list-part">
        
        <div class="container" style="background: #fff;padding: 0;">
            <div class="row" style="padding:10px;border-bottom: 1px solid #ededed;">
                <div class="col-5 col-md-3" style="padding:0px;display: flex;align-items: center;justify-content: center;">
                   <button class="btn filterBtn btn-block" data-toggle="modal" data-target="#selectcatmodal">
                   <i style="color:#666" class="fa fa-tag"></i><?php if($category): ?> <?php echo e($category->name); ?> <?php else: ?> <span class="hidden-xs"> Select </span> Category <?php endif; ?>
                   </button>
                </div>
                <div class="col-4 col-md-4" style="display: flex;align-items: center;justify-content: center;padding:0px;padding-left: 5px;<?php if((new \Jenssegers\Agent\Agent())->isMobile()): ?> border-left: 1px solid #ededed;border-right: 1px solid #ededed; <?php endif; ?>">
                   <button class="btn filterBtn btn-block" type="submit" data-toggle="modal" data-target="#locationmodal" >
                   <i style="color:#666" class="fa fa-map-marker"></i> <?php if($state): ?> <?php echo e($state->name); ?> <?php else: ?> <span class="hidden-xs"> Select </span> Location <?php endif; ?>
                   </button>
                </div>
               
                <div class="col-3 col-md-5" style="padding:0px ;padding-left: 5px;">
                    <?php if((new \Jenssegers\Agent\Agent())->isDesktop()): ?>
                   <div class="filter-action">
                    <div class="filter-short" style="margin-right: 5px !important;">
                        <label class="filter-label">Short by: </label>
                        <select onchange="sortproduct()" id="sortby" class="custom-select filter-select">
                            <option value="" selected>default</option>
                            <option <?php if(Request::get('sortby') == 'name-a-z'): ?> selected <?php endif; ?> value="name-a-z">Name (A - Z)</option>
                            <option <?php if(Request::get('sortby') == 'name-z-a'): ?> selected <?php endif; ?> value="name-z-a"> Name (Z - A) </option>
                            <option <?php if(Request::get('sortby') == 'price-l-h'): ?> selected <?php endif; ?> value="price-l-h">Price (Low &gt; High)</option>
                            <option <?php if(Request::get('sortby') == 'price-h-l'): ?> selected <?php endif; ?> value="price-h-l"> Price (High &gt; Low) </option>
                        </select>
                    </div>
    
                    <div class="filter-show">
                        <label class="filter-label"> Time: </label>
                        <select onchange="showPeriod()" id="period" class="custom-select filter-select">
                            <option value="">Any time</option>
                            <option value="hour">+2 for hour</option>
                            <option value="day">+3 for day</option>
                        </select>
                    </div>
                    </div>
                    <?php else: ?>
    
                    <button class="filterBtn open-filter btn btn-block"><i style="color:#EB5206" class="fa fa-filter"></i> Filter</button>
    
                    <?php endif; ?>
                
                </div>
            </div>
            <div class="row">
                <div style="padding-left: 5px;border-right: 1px solid #e9e8e8;" class="col-lg-4 col-xl-3 <?php if(!(new \Jenssegers\Agent\Agent())->isDesktop()): ?> filter <?php endif; ?>">
                    <?php if(!(new \Jenssegers\Agent\Agent())->isDesktop()): ?>
                    <div style="display:flex;align-items: flex-end;justify-content: space-between; margin: 0 10px;"><p>Filters</p><span class="close-filter" >✕</span></div><?php endif; ?>
                    <div class="row">
                        <div class="col-md-6 col-lg-12">
                            <div class="product-widget">
                                <h6 class="product-widget-title">Filter by category</h6>
                                <form class="product-widget-form">
                                    <ul class="product-widget-list product-widget-scroll">
                                        <li><a href="<?php echo e(Request::route('location') ? route('home.category', [Request::route('location')]) : route('home.category')); ?>"> All Categories</a></li>
                                        <?php if($category): ?>
                                        <li class="product-widget-dropitem">
                                            <button type="button" class="product-widget-link active">
                                                 <?php echo e($category->name); ?> (<?php echo e(($products ?  $products->total() : '0')); ?>  )
                                            </button>
                                            <ul class="product-widget-dropdown" style="display: block;">
                                                <?php $__currentLoopData = $category->get_subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filterCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><a href="<?php echo e(Request::route('location') ? route('home.category', [ $filterCategory->slug, Request::route('location')]) : route('home.category', $filterCategory->slug)); ?>"> <?php echo e($filterCategory->name); ?> (<?php echo e($filterCategory->products_by_subcategory_count); ?>)</a></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </li>
                                        <?php else: ?>
                                        
                                        <?php $__currentLoopData = $get_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="product-widget-dropitem" style="margin: 0;padding: 8px; border-bottom: 1px solid #f1f1f1;">
                                            <button type="button" class="product-widget-link">
                                                 <?php echo e($category->name); ?> (<?php echo e($category->products_by_category_count); ?>)
                                            </button>
                                            <ul class="product-widget-dropdown" >
                                                <?php $__currentLoopData = $category->get_subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><a href="<?php echo e(Request::route('location') ? route('home.location', [Request::route('location'), $subcategory->slug]) : route('home.category', $subcategory->slug)); ?>"> <?php echo e($subcategory->name); ?> (<?php echo e($subcategory->products_by_subcategory_count); ?>)</a></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </ul>
                                </form>
                            </div>
                        </div>
                        
                        
                        <?php $__currentLoopData = $product_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <!-- check weather value set or not -->
                        <?php if(count($product_variation->get_attrValues)>0): ?>
                        <div class="col-md-6 col-lg-12">

                            <div class="product-widget">
                                <h6 class="product-widget-title"><?php echo e($product_variation->name); ?></h6>
                                
                                    <ul class="product-widget-list">
                                        <?php $__currentLoopData = $product_variation->get_attrValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variationValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox">
                                                <input <?php if(in_array(strtolower($variationValue->name) , explode(',', Request::get(strtolower($product_variation->name)))) ): ?> checked <?php endif; ?> value="<?php echo e(strtolower($variationValue->name)); ?>" class=" <?php echo e(str_replace(' ', '', $product_variation->name)); ?> common_selector" id="attr<?php echo e($variationValue->id); ?>" type="checkbox" />
                                            </div>
                                            <label class="product-widget-label" for="attr<?php echo e($variationValue->id); ?>">
                                                <span class="product-widget-text"><?php echo e($variationValue->name); ?></span>
                                                <span class="product-widget-number">(<?php echo e($variationValue->get_variant_products_count); ?>)</span>
                                            </label>
                                        </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                        <div class="col-12 advertising">
                            <?php echo $sitebarMiddle; ?>

                        </div>
                        
                        <?php if(count($brands)>0): ?>
                        <div class="col-md-6 col-lg-12">
                            <div class="product-widget">
                                <h6 class="product-widget-title">filter by Brand</h6>
                                <form class="product-widget-form">
                                    <ul class="product-widget-list product-widget-scroll">
                                        <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="product-widget-dropitem">
                                            <button type="button" class="product-widget-link">
                                            <input <?php if(in_array($brand->slug , explode(',', Request::get('brand')))): ?> checked <?php endif; ?> class="common_selector brand" value="<?php echo e($brand->slug); ?>" id="brand<?php echo e($brand->id); ?>" type="checkbox" />
                                            <label style="margin: 0px;" for="brand<?php echo e($brand->id); ?>" ><?php echo e($brand->name); ?></label> 
                                            </button>
                                        </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </form>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="col-md-6 col-lg-12">
                            <div class="product-widget">
                                <h6 class="product-widget-title">Filter by cities</h6>
                                <form class="product-widget-form">
                                    <ul class="product-widget-list product-widget-scroll">
                                        <li><a href="<?php echo e(Request::route('location') ? route('home.category', [Request::route('catslug')]) : route('home.category')); ?>"> All Location</a></li>
                                        <?php if($state): ?>
                                        <li class="product-widget-dropitem" >
                                            <button type="button" class="product-widget-link active">
                                               <?php echo e($state->name); ?>

                                            </button>
                                            <?php if($state->get_city): ?>
                                            <ul class="product-widget-dropdown" style="display: block;">
                                                <?php $__currentLoopData = $state->get_city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><a href="<?php echo e(Request::route('catslug') ? route('home.category', [Request::route('catslug'), $city->slug]) : route('home.category', $city->slug)); ?>"> <?php echo e($city->name); ?> </a></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                            <?php endif; ?>
                                        </li>
                                        <?php else: ?>
                                        <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="product-widget-dropitem" style="margin: 0;padding: 8px; border-bottom: 1px solid #f1f1f1;">
                                                <button type="button" class="product-widget-link">
                                                     <?php echo e($state->name); ?> (<?php echo e($state->products_by_state_count); ?>)
                                                </button>
                                                <ul class="product-widget-dropdown">
                                                    <?php $__currentLoopData = $state->get_city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li><a href="<?php echo e(Request::route('catslug') ? route('home.category', [Request::route('catslug'), $city->slug]) : route('home.category', $city->slug)); ?>"> <?php echo e($city->name); ?> (<?php echo e($city->products_by_city_count); ?>)</a></li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </ul>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-12">
                            <div class="product-widget">
                                <h6 class="product-widget-title">Filter by Price</h6>
                                <form class="product-widget-form">
                                    <div class="product-widget-group">
                                        <input type="text" value="<?php echo e(Request::get('price_min')); ?>" id="price_min" class="price-range" placeholder="min - 00">
                                        <input type="text" value="<?php echo e(Request::get('price_max')); ?>" id="price_max" placeholder="max - 1B">
                                    </div>
                                    <button type="button" class="product-widget-btn common_selector">
                                        <i class="fa fa-search"></i>
                                        <span>search</span>
                                    </button>
                                </form>
                            </div> 
                        </div>
                        
                        <div class="col-12 advertising">
                           <span class="sidebar"> <?php echo $sitebarBottom; ?> </span>
                        </div>
                    </div>
                </div>
                <div id="content" class="col-lg-6 col-xl-7 sticky-content" >
                    <div id="filter_product">
                    <?php echo $__env->make('frontend.post-filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
                <div class="col-md-2 m-none sticky-content" >
                    <?php echo $sitebarTop; ?>

                </div>
            </div>
        </div>
        <div class="container advertising" style="padding: 10px;margin-bottom: 1em;background: white;"><?php echo $bottomOfContent; ?></div>
    </section>

    <div class="modal fade" id="selectcatmodal" role="dialog" style="display: none;">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="border: none;padding-bottom: 0;">
                    <h4 class="modal-title">Select Category</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="padding: 0 20px;">
                    <ul class="product-widget-list">
                        <li><a href="<?php echo e(route('home.category')); ?>"> All Categories</a></li>
                        <?php $__currentLoopData = $get_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="product-widget-dropitem" style="margin: 0;padding: 8px; border-bottom: 1px solid #f1f1f1;">
                            <button type="button" class="product-widget-link">
                                 <?php echo e($category->name); ?>

                            </button>
                            <ul class="product-widget-dropdown" >
                                <?php $__currentLoopData = $category->get_subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(Request::route('location') ? route('home.category', [$subcategory->slug, Request::route('category')]) : route('home.category', $subcategory->slug)); ?>"> <?php echo e($subcategory->name); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="locationmodal" role="dialog" style="display: none;">
        <div class="modal-dialog modal-sm">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="border: none;padding-bottom: 0;">
                    <h4 class="modal-title">Select Location</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="padding: 0 20px;">
                    <ul class="product-widget-list">
                        <li><a href="<?php echo e(route('home.category')); ?>"> All Location</a></li>
                        <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="product-widget-dropitem" style="margin: 0;padding: 8px; border-bottom: 1px solid #f1f1f1;">
                            <button type="button" class="product-widget-link">
                                 <?php echo e($state->name); ?>

                            </button>
                            <ul class="product-widget-dropdown">
                                <?php $__currentLoopData = $state->get_city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(Request::route('catslug') ? route('home.category', [Request::route('catslug'), $city->slug]) : route('home.category', $city->slug)); ?>"> <?php echo e($city->name); ?> (<?php echo e($city->products_by_city_count); ?>)</a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<script type="text/javascript">
    
    function filter_data(page)
    {
        //enable loader
        $('#filter_product').html('<div style="display:block;" id="loadingData"></div>');
        
        window.scrollTo({top: 100, behavior: 'smooth'});
        $('.filter').hide().fadeOut();
        
        var category = "<?php echo str_replace(' ', '', Request::route('catslug')); ?>" ;
        <?php if(Request::route('location')): ?>
            category += "<?php echo e(Request::route('location')); ?>";
        <?php endif; ?>
        var concatUrl = '?';
        
        var searchKey = $("#searchKey").val();
        if(searchKey != '' ){
            concatUrl += 'q='+searchKey;
        }


        <?php $__currentLoopData = $product_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            var filterValue = get_filter('<?php echo e(str_replace(' ', '', $product_variation->name)); ?>');
            if(filterValue != ''){
                concatUrl += '&<?php echo e(strtolower(str_replace(' ', '', $product_variation->name))); ?>='+filterValue;
            }  
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       
        var brand = get_filter('brand');
        if(brand != '' ){
            concatUrl += '&brand='+brand;
        }        
       
        var perPage = null;
        var showItem = $("#perPage :selected").val();
        if(typeof showItem != 'undefined' || showItem != null){
           perPage = showItem;
           //check weather page null or set 
            if(page == null){
                //var active = $('.active .page-link').html();
                var page = 1;
            }
        }

        var sortby = $("#sortby :selected").val();
        if(typeof sortby != 'undefined' && sortby != ''){
            concatUrl += '&sortby='+sortby;
            //check weather page null or set 
            if(page == null){
                //var active = $('.active .page-link').html();
                var page = 1;
            }
        }

        var period = $("#period :selected").val();
        if(typeof period != 'undefined' && period != ''){
            concatUrl += '&period='+period;
            //check weather page null or set 
            if(page == null){
                //var active = $('.active .page-link').html();
                var page = 1;
            }
        }

        var price_min = $("#price_min").val();
        if(price_min != '' ){
            concatUrl += '&price_min='+price_min;
        }

        var price_max = $("#price_max").val();
        if(price_max != '' ){
            concatUrl += '&price_max='+price_max;
        }

        if(page != null){concatUrl += '&page='+page;}
     
        var link = '<?php echo e(URL::current()); ?>/'+concatUrl;
            history.pushState({id: null}, null, link);

        $.ajax({
            url:link,
            method:"get",
            data:{
                filter:'filter',perPage:showItem
            },
            success:function(data){
               
                if(data){
                    $('#filter_product').html(data);
                    
                    //AD LIST FEATURE SLIDER
                    $('.ad-feature-slider').slick({
                        autoplay: true,
                        infinite: true,
                        arrows: true,
                        centerMode: true,
                        // centerPadding: '180px',
                        speed: 800,
                        slidesToShow: 1,
                        prevArrow: '<i class="fa fa-long-arrow-alt-right dandik"></i>',
                        nextArrow: '<i class="fa fa-long-arrow-alt-left bamdik"></i>',
                        responsive: [
                          {
                            breakpoint: 1200,
                            settings: {
                              arrows: true,
                              centerMode: true,
                              centerPadding: '180px',
                              slidesToShow: 1
                            }
                          },
                          {
                            breakpoint: 768,
                            settings: {
                              arrows: true,
                              centerMode: true,
                              centerPadding: '40px',
                              slidesToShow: 1
                            }
                          },
                          {
                            breakpoint: 576,
                            settings: {
                              arrows: false,
                              centerMode: true,
                              centerPadding: '35px',
                              slidesToShow: 1
                            }
                          },
                          {
                            breakpoint: 401,
                            settings: {
                              arrows: false,
                              centerMode: true,
                              centerPadding: '0px',
                              slidesToShow: 1
                            }
                          }
                        ]
                    });
                }else{
                    $('#filter_product').html('Not Found');
                }
            },
            error: function() {
                $('#filter_product').html('<span class="ajaxError">Internal server error.!</span>');
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
       
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

    function sortproduct(){
        filter_data();
    }
    function showPeriod(){
        filter_data();
    }

    function searchItem(value){
        if(value != ''){ filter_data(); }
    }

    $(document).on('click', '.pagination a', function(e){
        e.preventDefault();

        var page = $(this).attr('href').split('page=')[1];

        filter_data(page);
    });

      
        $(window).on('popstate', function() {  
           var page = $('.pagination a').attr('href').split('page=')[1];
           
            if(page != 'undefined' && page>0){
                window.scrollTo({top: 100, behavior: 'smooth'});
                filter_data(page);
            }
       });

    

    $('#resetAll').click(function(){
        $('input:checkbox').removeAttr('checked');
        $('input[type=checkbox]').prop('checked', false);
        $("#searchKey").val('');
        $('input:radio').removeAttr('checked');
         $("#price-range").val('0');
        //call function
        filter_data();
    });

    $(document).ready(function(){

        $(".open-filter").click(function(e){
            e.preventDefault();
            $(".filter").show().fadeIn();
        });
       
        $('.close-filter').click(function() {
          
            $('.filter').hide().fadeOut();
            
        }); 
    });

</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bikroy\resources\views/frontend/category-details.blade.php ENDPATH**/ ?>