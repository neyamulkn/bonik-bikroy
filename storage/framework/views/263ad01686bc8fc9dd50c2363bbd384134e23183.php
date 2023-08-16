  <?php if(!Request::is('message')): ?>
 <footer class="footer-part footer_area">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="footer-info">
                    <a href="#"><img src="<?php echo e(asset('upload/images/logo/'.Config::get('siteSetting.invoice_logo') )); ?>" alt="logo"></a>
                    <p><?php echo e(Config::get('siteSetting.about')); ?></p>
                    <div class="footer-content">
                   
                        <ul class="footer-address">
                            <li>
                                <i class="fas fa-map-marker-alt"></i>
                                <p><?php echo e(Config::get('siteSetting.address')); ?></p>
                            </li>
                            <li>
                                <i class="fas fa-envelope"></i>
                                <p><?php echo e(Config::get('siteSetting.email')); ?></p>
                            </li>
                            <li>
                                <i class="fas fa-phone-alt"></i>
                                <p><?php echo e(Config::get('siteSetting.phone')); ?></p>
                            </li>
                        </ul>
                    </div>
                    
                </div>
            </div>
            
            <?php $footer_menus = $menus->where('footer', 1); ?>
            <?php $__currentLoopData = $footer_menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="hidden-xs hidden-sm col-lg-<?php echo e((count($footer_menus) > 3 )  ? 3 : 3); ?> col-md-<?php echo e((count($footer_menus) > 3 )  ? 3 : 3); ?> col-sm-6 col-xs-6">
                <div class="footer-content">
                    <h3><?php echo e($menu->name); ?></h3>
                    <ul class="footer-widget">
                       <?php
                        $source_id = explode(',', $menu->source_id);
                        $get_pages =  \App\Models\Page::whereIn('id', $source_id)->get();
                      ?>
                      
                        <?php if($menu->menu_source == 'page'): ?>
                        <?php $__currentLoopData = $get_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="<?php echo e(route('page', $page->slug)); ?>"><?php echo e($page->title); ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <?php if($menu->menu_source == 'category'): ?>
                          <?php $__currentLoopData = $menu->get_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <li><a href="<?php echo e(route('home.category', [$category->slug])); ?>" ><?php echo e($category->name); ?></a></li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

             <div class="col-sm-6 col-md-6 col-lg-3">
                 <div class="footer-content">
                  <h3>Follow Us</h3>
                <ul class="footer-social">
                <?php
                  
                      Session::put('socialLists', App\Models\Social::where('status', 1)->get());
                  
                ?>
                <?php $__currentLoopData = Session::get('socialLists'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a href="<?php echo e($social->link); ?>" target="_blank">
                  <i style="background: <?php echo e($social->background); ?>; color:<?php echo e($social->text_color); ?>" class="fab <?php echo e($social->icon); ?>"></i>
                </a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <div class="footer-app">
                    <?php if(Config::get('siteSetting.playStore')): ?>
                    <a href="<?php echo e(Config::get('siteSetting.playStore')); ?>" target="_blank"><img src="<?php echo e(asset('frontend')); ?>/images/play-store.png" alt="play-store"></a><?php endif; ?>
                    <?php if(Config::get('siteSetting.appStore')): ?>
                    <a href="<?php echo e(Config::get('siteSetting.appStore')); ?>" target="_blank"><img src="<?php echo e(asset('frontend')); ?>/images/app-store.png" alt="app-store"></a><?php endif; ?>
                </div>
            </div>
            </div>
        </div>
    </div>
     <?php if(Config::get('siteSetting.copyright_text')): ?>
    <div class="footer-end copyright_area">
        <div class="container">
            <div class="footer-end-content">
                <p><?php echo config::get('siteSetting.copyright_text'); ?></p>
                
            </div>
        </div>
    </div><?php endif; ?>
</footer>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\jotesto\resources\views/layouts/partials/frontend/footer1.blade.php ENDPATH**/ ?>