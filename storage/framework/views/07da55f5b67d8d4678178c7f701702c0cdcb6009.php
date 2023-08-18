<style>
.h-56 {height: 59px;}
.contents {display: contents;}
.accordion .collapse.show {display: block;}
.accordion .card-header {cursor: pointer;}
.rounded-3 {border-radius: 3px !important;}
.rounded {border-radius: .6rem!important;}
.rounded-1 {border-radius: 1em!important;}
.border-r {border-right: 2px solid #fff;}
.border-rr {border-right: 1px solid #000;}
.border-b {border-bottom: 1px solid #000;}
.borders {border: 1px solid #000;}
.w-250 {width: 250px;}
.h-300 {object-fit: cover;height: 300px;}
.w-150 {
    width: 150px;
    height: 150px;
    object-fit: cover;
}

.left-0 {left: 0;}
.f-12 {font-size: 12px;}
.shadow-b {
    box-shadow: 0 0 5px 0 #d4ded9;
}
.dropify-wrapper {
    height: 150px;
}
.gap {gap: 5px;}
.title {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.mh-300 {max-height: 310px;object-fit: cover;}
.rounded-l {
    border-top-left-radius: .6rem!important;
    border-bottom-left-radius: .6rem!important;
}
.mt--4 {margin-top: -15px;}
.h-33 {height: 33px;}
.bib {background-image: url("/upload/images/bimgb.png");background-repeat: round;}

.transform-180 {transform: rotate(180deg);}
.bottom-0{bottom: 0;}
.bgs{    background: #0000008f;}
.top-50 {top: 50%;}
.pt {color:#009877;}
.yt {color:#f9ef6b;}
.yb {background:#f9ef6b;}
.gb {background:#f5f5f5 !important;}

.ab {background:#FFFDEB;}

.by2 {border:2px solid #f9ef6b !important;}
.bb2 {border:2px solid #1f1e13 !important;}

.bt {color:#1f1e13;}
.bb {background:#1f1e13;}
.eb {background:#E6E6E6;}
.mb {background:#EDEDED;}

.gt {color:#268000;}
.gb {background:#268000;}

.rt {color:#DC0000;}
.rb {background:#DC0000;}
.right-0{right: 0;}

.hl-2 {
    -webkit-column-count: 2;
    -moz-column-count: 2;
    column-count: 2;
    -webkit-column-gap: 10px;
    -moz-column-gap: 10px;
    column-gap: 10px;
    orphans: 1;
    widows: 1;
}

.ff:after {
    border-top: 12px solid;
    border-bottom: 12px solid;
    border-right: 0;
    border-left: 9px solid transparent;
    position: absolute;
    top: 0;
    border-top-color: #f9ef6b;
    border-bottom-color: #f9ef6b;
    content: '';
    transform: rotate(180deg);
}
[type="checkbox"]:checked+label:after,
[type="radio"]:checked+label:after {
  background-color: #1f1e13;
  border: 1px solid #1f1e13;
  border-radius: 0%;
}
[type="checkbox"]:not(:checked)+label:before,
[type="radio"]:not(:checked)+label:before {
    border-radius: 0%;
    border: 1px solid #1f1e13;
    background: #f9ef6b;
}
[type="checkbox"]+label:before, [type="checkbox"]+label:after,
[type="radio"]+label:before, [type="radio"]+label:after {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    margin: 4px;
    width: 16px;
    height: 16px;
    z-index: 0;
    transition: .28s ease;
}
[type="checkbox"]:not(:checked)+label, [type="checkbox"]:checked+label,
[type="radio"]:not(:checked)+label, [type="radio"]:checked+label {
    position: relative;
    padding-left: 25px;
    cursor: pointer;
    display: inline-block;
    height: 25px;
    line-height: 25px;
    font-size: 1rem;
    transition: .28s ease;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
input[type="checkbox" i],
input[type="radio" i]{
      display: none;
}
.dropdown-toggle::after {display: none;}
article::after {
    content: '';
    display: block;
    position: sticky;
    bottom: 0;
    left: 0;
    width: 100%;
    background: -moz-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
    background: -webkit-linear-gradient(top, rgba(255,255,255,0) 0%,rgba(255,255,255,1) 100%);
    background: linear-gradient(to bottom, rgba(255,255,255,0) 0%,rgba(255,255,255,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00ffffff', endColorstr='#ffffff',GradientType=0 );
    height: 21px;
}
.sh:hover {background: #1f1e13;border: 1px solid #f5ed74;}
.sh:hover img {filter: brightness(0) invert(1);}

@media (min-width: 1200px){
.container, .container-lg, .container-md, .container-sm, .container-xl {
    max-width: 940px !important;
}
.mt4 {margin-top: -4em;}
.col-55 {
    -ms-flex: 0 0 20%;
    flex: 0 0 20%;
    max-width: 20%;
}
.hl-3 {
    -webkit-column-count: 3;
    -moz-column-count: 3;
    column-count: 3;
    -webkit-column-gap: 10px;
    -moz-column-gap: 10px;
    column-gap: 10px;
    orphans: 1;
    widows: 1;
}
.iuser {object-fit: cover;height: 240px;max-width: 180px;}
}
@media (max-width: 600px) {
.d-h-flex {
    display: flex;
    flex-direction: column;
    width: 100%;
}
.iuser {max-height: 180px;width: 100%;object-fit: cover;}
.d-h-flex td, .d-h-flex th {display: inline-flex;width: 100%;}
}
</style>
<header class="bg-white mb-2 hidden-xs">
    <div class="bg-dark w-100 h-56 position-absolute "></div>
    <div class="row">
        <div class="container px-0">
            <div class="row align-items-center">
                <div class="col-md-3 col-sm-6 pl-0">
                    <a href="<?php echo e(url('/')); ?>" class="py-3">
                        <img class="mw-100" src="<?php echo e(asset('upload/images/logo/'.config('siteSetting.logo'))); ?>" alt="logo">
                    </a>
                </div>
       
                <div class="col-md-7">
                    <form action="<?php echo e(route('home.category')); ?>" method="get" class="w-100 d-flex align-items-center bb2 rounded yb">
                        <input type="text" id="searchKey" value="<?php echo e(Request::get('q')); ?>" name="q" class="searchKey w-100 p-3 rounded-l" placeholder="What are you looking for?">
                        <button type="submit" class="contents">
                            <img class="px-2" src="<?php echo e(asset('upload/images/search-y.png')); ?>" alt="search">
                        </button>
                    </form>
                    <div class="d-flex align-items-center justify-content-center mt-1 mb-n4">
                        <b class="mr-2">Live Ads : </b>
                        <b class="pt">4,59,563</b>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 pr-0">
                    <div class="d-flex justify-content-end flex-column">
                        <div class="d-flex justify-content-end py-2 icon-size">
                            <ul class="d-flex justify-content-end">
                                <li
                                <?php if(Auth::check()): ?>
                                    onclick="getNotification('notify-item-list')"
                                <?php else: ?>
                                    data-toggle="modal" data-target="#so_sociallogin"
                                <?php endif; ?>
                                class="mr-3">
                                    <button type="button" class="border-r pr-2">
                                        <img width="25" height="25" src="<?php echo e(asset('upload/images/Language.png')); ?>" alt="logo">
                                    </button>
                                    <?php if(Auth::check()): ?>
                                    <div class="dropdown-card notify-item-list"></div>
                                    <?php endif; ?>
                                </li>
                                <li
                                <?php if(Auth::check()): ?>
                                    onclick="getNotification('message-user-list')"
                                <?php else: ?>
                                    data-toggle="modal" data-target="#so_sociallogin"
                                <?php endif; ?>
                                class="mr-3">
                                    <button type="button" class="border-r pr-2">
                                        <img width="25" height="25" src="<?php echo e(asset('upload/images/chat.png')); ?>" alt="logo">
                                    </button>
                                    <?php if(Auth::check()): ?>
                                    <div class="dropdown-card message-user-list"></div>
                                    <?php endif; ?>
                                </li>
                            </ul>
                            <?php if(Auth::check()): ?>
                            <div class="btn-group user">
                              <button type="button" class="border-none p-0 btn dropdown-toggle users" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                                  <img width="25" height="25" src="<?php echo e(asset('upload/users')); ?>/<?php echo e((Auth::user()->photo) ? Auth::user()->photo : 'default.png'); ?>" alt="user">
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
                            <a href="<?php echo e(route('login')); ?>">
                                <img width="25" height="25" src="<?php echo e(asset('upload/images/user.png')); ?>" alt="logo">
                            </a>
                            <?php endif; ?>
                        </div>
                        <a
                        <?php if(Auth::check()): ?>
                            href="<?php echo e(route('post.create')); ?>"
                        <?php else: ?>
                            data-toggle="modal" data-target="#so_sociallogin" href="javascript:void(0)"
                        <?php endif; ?>
                        class="yb p-2 text-center bt bb2 rounded font-weight-bold mt-2 f-12">POST YOUR AD FREE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<header class="bb mb-2 d-md-none">
    <div class="container">
        <div class="d-flex align-items-center">
            <a href="javascript:history.back()" class="home mr-2">
                <img class="mw-100" width="30" height="25" src="<?php echo e(asset('upload/images/left-arrow.png')); ?>" alt="logo">
            </a>
            <a href="<?php echo e(url('/')); ?>" class="py-3">
                <img class="mw-100" src="<?php echo e(asset('upload/images/mlogo.png')); ?>" alt="logo">
            </a>
        </div>
    </div>
</header>
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
<?php /**PATH C:\xampp\htdocs\bonik\resources\views/layouts/partials/frontend/header1.blade.php ENDPATH**/ ?>