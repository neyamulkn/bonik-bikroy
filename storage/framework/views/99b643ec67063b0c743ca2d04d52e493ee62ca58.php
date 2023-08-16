<style>
.col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto {
    
    width: 100%;
    padding-right: 5px;
    padding-left: 5px;
}
.quick-links b {
    color: #2f3432;
    font-weight: 800;
    display: block;
}
.quick-links {
    background: #f3f6f5;
    padding: 15px;
}
.subcategory a {
    color: #424e4e;
    display: inline;
    font-size: 14px;
}
.subcategory a:after {
    content: " |";
}
.hrta {
    background: #10846f;
    padding: 4px 20px;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    border-radius: 30px;
    color: #fff;
    align-items: center;
    width: fit-content;
    margin: 0 auto 1em;
}
@media (min-width: 1200px) {
.container, .container-lg, .container-md, .container-sm, .container-xl {
    max-width: 1305px;
}}
.heading {
    font-size: 16px;
}
.bikroy {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: row;
    -ms-flex-negative: 0;
    flex-shrink: 0;
    padding: 16px;
    align-items: center;
}
.bikroy-icon {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 10px;
}
.bikroy-icon img {
    width: 36px;
    height: 36px;
}
.bikroy-info p {
    color: #2f3432;
}
.bikroy-info span {
    font-size: 14px;
    color: #707676;
}
.content {
    margin: 0;
    padding: 32px 32px 36px;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: nowrap;
    flex-wrap: nowrap;
    border-radius: 8px;
    box-shadow: 0 2px 16px 0 rgba(0,0,0,.1);
}
.content-boxss {
    display: flex;
    flex-direction: row;
    align-items: center;
}
.home-make-money-cta {
    background-color: #ffc800;
    color: #673500;
    font-weight: 800;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: center;
    justify-content: center;
    border-radius: 100px;
    width: auto;
    padding: 7px 35px;
}
.box img {
    margin-right: 10px;
}
.subn {
    padding: 10px 0;
    color: #666;
    font-size: 14px;
}
.icon1XWWO {
    width: 140px;
}
.gtm-home-explore-jobs-cta {
    background-color: #0074ba;
    color: #fff;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: center;
    justify-content: center;
    border-radius: 100px;
    width: auto;
    padding: 7px 35px;
}
button.gtm-home-explore-jobs-cta i {
    width: 20px;
    height: 20px;
    vertical-align: middle;
    display: inline-block;
    pointer-events: none;
    background: #fff;
    color: #878787;
    border-radius: 50%;
    line-height: 20px;
    font-size: 16px;
}
.all-ads:hover,
.all-ads {
    color: white;
    font-weight: bold;
}
.m-none {
    display: block;
}
.d-none {
    display: none;
}
@media  only screen and (max-width: 850px){
.m-none {
    display: none!important;
}
.d-none {
    display: block !important;
}
.header-mob {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    padding: 0 15px;
}
.header-left {
    display: flex;
    flex-direction: column;
}
.header-search {
    width: 95%;
    height: 44px;
}
.header-search input {
    padding: 10px;
}
.header-search button i {
    width: 40px;
    height: 40px;
    font-size: 20px;
    line-height: 40px;
}
.header-widget i {
    font-size: 25px;
}
.bikroy,
.content-boxss {
    display: flex;
    flex-direction: column;
    text-align: center;
    align-items: center;
}
}
</style>
<header class="header-part">
    <div class="container-fluid">
        <div class="header-content">
            <div class="header-left">
                <div class="header-mob">
                    <button type="button" class="d-none header-widget sidebar-btn">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a href="<?php echo e(url('/')); ?>" class="header-logo">
                        <img src="<?php echo e(asset('upload/images/logo/'.config('siteSetting.logo'))); ?>" alt="logo">
                    </a>
                    <a class="all-ads m-none" href="<?php echo e(url('/ads')); ?>">All ads</a>
                    <div style="display: flex;">
                        <a style="margin: 0 10px;" <?php if(Auth::check()): ?> href="<?php echo e(route('user.message')); ?>" <?php else: ?> data-toggle="modal" data-target="#so_sociallogin" <?php endif; ?> class="header-widget  headtopHide">
                            <i class="fa fa-comments" aria-hidden="true"></i>
                        </a>
                        
                        <?php if(Auth::check()): ?>
                        <a href="<?php echo e(route('user.dashboard')); ?>" style="border: none;" class="header-widget headtopHide">
                            <img src="<?php echo e(asset('upload/users')); ?>/<?php echo e((Auth::user()->photo) ? Auth::user()->photo : 'default.png'); ?>" alt="user">
                        </a>
                        
                        <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="header-widget headtopHide">
                            <i class="fa fa-user"></i>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <form action="<?php echo e(route('home.category')); ?>" method="get" class="d-none header-form">
                    <div class="header-search">
                       
                        <input type="text" id="searchKey" value="<?php echo e(Request::get('q')); ?>" name="q" class="searchKey" placeholder="What are you looking for?">
                       
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
            
            <div class="header-right">
                <ul class="header-list">
                    <li <?php if(Auth::check()): ?> onclick="getNotification('message-user-list')" <?php else: ?> data-toggle="modal" data-target="#so_sociallogin" <?php endif; ?> class="header-item">
                        <button type="button" class="header-widget">
                            <i class="fa fa-comments" aria-hidden="true"></i>
                            <span>Chat</span>
                        </button>
                        <?php if(Auth::check()): ?>
                        <div class="dropdown-card message-user-list"></div><?php endif; ?>
                    </li>
                    <li  <?php if(Auth::check()): ?> onclick="getNotification('notify-item-list')" <?php else: ?> data-toggle="modal" data-target="#so_sociallogin" <?php endif; ?> class="header-item">
                        <button type="button" class="header-widget">
                            <i class="fa fa-bell"></i>
                        </button>
                        <?php if(Auth::check()): ?>
                        <div class="dropdown-card notify-item-list"></div><?php endif; ?>
                    </li>
                </ul>
                <?php if(Auth::check()): ?>
                <div class="btn-group user">
                  <button type="button" style="border: none;" class="btn header-widget dropdown-toggle users" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false"><img src="<?php echo e(asset('upload/users')); ?>/<?php echo e((Auth::user()->photo) ? Auth::user()->photo : 'default.png'); ?>" alt="user">&nbsp; <?php echo e(explode(' ', trim(Auth::user()->name))[0]); ?> 
                    
                  </button>
                  <div class="dropdown-menu dropdown-menu-lg-right">
                    <a href="<?php echo e(route('user.dashboard')); ?>" class="dropdown-item">Dashboard</a>
                    <a href="<?php echo e(route('post.list')); ?>" class="dropdown-item">My Ads</a>
                    <a href="<?php echo e(route('user.packageHistory')); ?>" class="dropdown-item"> My Package</a>
                    <a href="<?php echo e(route('user.change-password')); ?>" class="dropdown-item"> Change Password </a>
                    <a href="<?php echo e(route('userLogout')); ?>" class="dropdown-item">Logout </a> 
                    
                  </div>
                </div>
                <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="header-widget header-user">
                    <i class="fa fa-user"></i>
                    <span>Login</span>
                </a>
                
                <?php endif; ?>
                <a  <?php if(Auth::check()): ?> href="<?php echo e(route('post.create')); ?>" <?php else: ?> data-toggle="modal" data-target="#so_sociallogin" href="javascript:void(0)" <?php endif; ?>  class="btn btn-inline post-btn">
                    <span>POST YOUR AD</span>
                </a>
            </div>
        </div>
    </div>
</header>
<!--=====================================
            HEADER PART END
=======================================-->


<!--=====================================
            SIDEBAR PART START
=======================================-->
<aside class="sidebar-part">
    <div class="sidebar-body">
        <div class="sidebar-header">
            <a href="<?php echo e(url('/')); ?>" class="sidebar-logo"><img src="<?php echo e(asset('upload/images/logo/'.config('siteSetting.invoice_logo'))); ?>" alt="logo"></a>
            <button class="sidebar-cross"><i class="fa fa-times"></i></button>
        </div>
        <div class="sidebar-content">
            
            <div class="sidebar-menu">
               

                <div class="tab-pane active" id="main-menu">
                    <ul class="navbar-list">
                        
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(count($category->get_subcategory)>0): ?>
                        <li class="navbar-item navbar-dropdown">
                            <a class="navbar-link" href="javascript:void(0)">
                                <span><?php echo e($category->name); ?></span>
                                <i class="fa fa-plus"></i>
                            </a>
                            <ul class="dropdown-list">
                                <?php $__currentLoopData = $category->get_subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a class="dropdown-link" href="<?php echo e(route('home.category', [ $subcategory->slug])); ?>"><?php echo e($subcategory->name); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </li>
                        <?php else: ?>
                        <li class="navbar-item"><a class="navbar-link" href="<?php echo e(route('home.category', [ $category->slug])); ?>"><?php echo e($category->name); ?></a></li>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <!-- menu  -->
                        <?php $__currentLoopData = $menus->where('main_header', 1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($menu->menu_source == 'category'): ?>
                                <?php if(count($menu->get_categories)>1): ?>
                                <li class="navbar-item navbar-dropdown">
                                    <a class="navbar-link" href="#">
                                        <span><?php echo e($menu->name); ?></span>
                                        <i class="fa fa-plus"></i>
                                    </a>
                                    <ul class="dropdown-list">
                                        <?php $__currentLoopData = $menu->get_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a class="dropdown-link" href="<?php echo e(route('home.category', [ $category->slug])); ?>"><?php echo e($category->name); ?></a></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </li>
                                <?php else: ?>
                                <li class="navbar-item"><a class="navbar-link" href="<?php echo e(route('home.category', $menu->get_categories[0]->slug)); ?>"><?php echo e($menu->name); ?></a></li>
                                <?php endif; ?>
                            <?php elseif($menu->menu_source == 'page'): ?>
                                <?php
                                $source_id = explode(',', $menu->source_id);
                                $get_pages =  \App\Models\Page::whereIn('id', $source_id)->get();
                                ?>
                                <?php if(count($get_pages)>0): ?>
                                <?php if(count($get_pages)>1): ?>
                                <li class="navbar-item navbar-dropdown">
                                    <a class="navbar-link" href="#">
                                        <span><?php echo e($menu->name); ?></span>
                                        <i class="fa fa-plus"></i>
                                    </a>
                                    <ul class="dropdown-list">
                                        <?php $__currentLoopData = $get_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a class="dropdown-link" href="<?php echo e(route('page', $page->slug)); ?>"><?php echo e($page->title); ?></a></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </li>
                                <?php else: ?>
                                <li class="navbar-item"><a class="navbar-link" href="<?php echo e(route('page', $get_pages[0]->slug)); ?>"><?php echo e($menu->name); ?></a></li>
                                <?php endif; ?>
                                <?php endif; ?>
                            <?php else: ?>

                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>

                <div class="tab-pane" id="author-menu">
                    <ul class="navbar-list">
                        <li class="navbar-item"><a class="navbar-link" href="dashboard.html">Dashboard</a></li>
                        <li class="navbar-item"><a class="navbar-link" href="profile.html">Profile</a></li>
                        <li class="navbar-item"><a class="navbar-link" href="ad-post.html">Ad Post</a></li>
                        <li class="navbar-item"><a class="navbar-link" href="my-ads.html">My Ads</a></li>
                        <li class="navbar-item"><a class="navbar-link" href="setting.html">Settings</a></li>
                        <li class="navbar-item navbar-dropdown">
                            <a class="navbar-link" href="bookmark.html">
                                <span>bookmark</span>
                                <span>0</span>
                            </a>
                        </li>
                        <li class="navbar-item navbar-dropdown">
                            <a class="navbar-link" href="message.html">
                                <span>Message</span>
                                <span>0</span>
                            </a>
                        </li>
                        <li class="navbar-item navbar-dropdown">
                            <a class="navbar-link" href="notification.html">
                                <span>Notification</span>
                                <span>0</span>
                            </a>
                        </li>
                        <li class="navbar-item"><a class="navbar-link" href="user-form.html">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</aside> 
<!--=====================================
            SIDEBAR PART END
=======================================-->


<!--=====================================
            MOBILE-NAV PART START
=======================================-->
<nav class="mobile-nav">
    <div class="container">
        <div class="mobile-group">
            <a href="<?php echo e(url('/')); ?>" class="mobile-widget">
                <i class="fa fa-home"></i>
                <span>home</span>
            </a>
          
            <a href="<?php echo e(route('wishlists')); ?>" class="mobile-widget">
                <i class="fa fa-heart"></i>
                <span>Saved</span>
            </a>
            <a  <?php if(Auth::check()): ?> href="<?php echo e(route('post.create')); ?>" <?php else: ?> data-toggle="modal" data-target="#so_sociallogin" href="javascript:void(0)" <?php endif; ?>  class="mobile-widget plus-btn">
                <i class="fa fa-plus"></i>
                <span>Ad Post</span>
            </a>
            <a href="<?php echo e(route('allNotifications')); ?>" class="mobile-widget">
                <i class="fa fa-bell"></i>
                <span>notify</span>
                <sup class="countNotifications">0</sup>
            </a>

            <?php if(Auth::check()): ?>
            <a href="javascript:void(0)" class="mobile-widget open-sidebar">
                <i class="fa fa-envelope"></i>
                <span>Dashboard</span>
            </a>
            <?php else: ?>
            <a data-toggle="modal" data-target="#so_sociallogin" href="javascript:void(0)" class="mobile-widget">
                <i class="fa fa-envelope"></i>
                <span>Account</span>
            </a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<!--=====================================
            MOBILE-NAV PART END
=======================================-->
<?php /**PATH C:\xampp\htdocs\bikroy\resources\views/layouts/partials/frontend/header1.blade.php ENDPATH**/ ?>