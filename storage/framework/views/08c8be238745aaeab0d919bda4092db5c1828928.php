<ul class="list-box">
                 
                <li class="border-bottom"><a href="<?php echo e(route('user.dashboard')); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
                <li class="border-bottom"><a href="<?php echo e(route('post.create')); ?>"><i class="fa fa-pencil-alt"></i> Ads Post</a></li>
               
                <li class="navbar-dropdown border-bottom" style="">
                    <a class="navbar-link" href="javascript:void(0)">
                        <span><i style="font-size: 16px;" class="fa fa-th-list"></i> My Ads</span>
                        <i class="fas fa-plus"></i>
                    </a>
                    <ul class="dropdown-list" style="display: none;">
                        <li><a href="<?php echo e(route('post.list')); ?>">All Ads</a></li>
                        <li><a href="<?php echo e(route('post.list', 'active')); ?>">Active Ads</a></li>
                        <li><a href="<?php echo e(route('post.list', 'deactive')); ?>">Deactive Ads</a></li>
                        <li><a href="<?php echo e(route('post.list', 'reject')); ?>">Reject Ads</a></li>
                        <li><a href="<?php echo e(route('post.list', 'pending')); ?>">Pending Ads</a></li>
                    </ul>
                </li>
                <li class="border-bottom"><a href="<?php echo e(route('linkAds')); ?>"><i class="fa fa-clipboard-list"></i> Link Ads</a></li>
                
                <li class="border-bottom"><a href="<?php echo e(route('user.packageHistory')); ?>"><i class="fa fa-clipboard-list"></i> My Package</a></li>

                <li class="border-bottom"><a href="<?php echo e(route('blog.list')); ?>"><i class="fa fa-pen-square"></i> Blogs</a></li>
                <li class="border-bottom"><a href="<?php echo e(route('user.message')); ?>"><i class="fa fa-comment"></i> Message</a></li>
                <li class="border-bottom"><a href="<?php echo e(route('wishlists')); ?>"><i class="fa fa-heart"></i> Wishlist</a></li>
                
                <li class="border-bottom"><a href="<?php echo e(route('user.myAccount')); ?>"><i class="fa fa-user"></i> My Profile</a></li>
                <li class="border-bottom"><a href="<?php echo e(route('verifyAccount')); ?>"><i class="fa fa-user-plus"></i> Seller verification</a></li>
                <li class="border-bottom"><a href="<?php echo e(route('user.change-password')); ?>"><i class="fa fa-edit"></i> Change Password </a></li>
                <li><a href="<?php echo e(route('userLogout')); ?>"><i class="fa fa-power-off"></i> Logout</a></li>
                 
            </ul>
<?php /**PATH C:\xampp\htdocs\bonik\resources\views/users/inc/sidebar.blade.php ENDPATH**/ ?>