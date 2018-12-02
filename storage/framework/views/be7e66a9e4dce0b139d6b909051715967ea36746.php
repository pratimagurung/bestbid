<div class="navbar navbar-default navbar-fixed-top" role="navigation">  
    <div class="container">
        <div class="navbar-header">
            <div class="navbar-header"><a class="navbar-brand" href="<?php echo e(url('/')); ?>">Best Bid</a></div>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav pull-right">
                <?php if(auth()->guard()->guest()): ?>
                <li><a href="<?php echo e(route('login')); ?>">Login</a></li>
                <li><a href="<?php echo e(route('register')); ?>">Register</a></li>
                <?php else: ?>
                <?php if(Auth::user()->is_admin): ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> Admin Dashboard <span class="caret"></span>  
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo e(url('/category')); ?>">Categories</a></li>
                    </ul>
                <?php endif; ?>
                <li><a href="<?php echo e(url('/profile')); ?>"><?php echo e(Auth::user()->firstname); ?></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> My BestBid  <span class="caret"></span>  
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo e(url('/products')); ?>">My Products</a></li>
                        <li>
                            <a href="<?php echo e(route('logout')); ?>"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            Logout
                        </a><form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo e(csrf_field()); ?>

                        </form></li>
                    </ul>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>

<div class="navbar navbar-inverse navbar-static-top" role="navigation" style="background-color: #e3f2fd;">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav" >
                <li class="<?php echo e(Request::is('/') ? 'active' : ''); ?>"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                <li class="<?php echo e(Request::is('auction-gallery') ? 'active' : ''); ?>"><a href="<?php echo e(url('/auction-gallery')); ?>">Auction</a></li>
                <li class="<?php echo e(Request::is('product') ? 'active' : ''); ?>"><a href="<?php echo e(url('/product')); ?>">Sell</a></li>
                <li class="<?php echo e(Request::is('buy-it-now') ? 'active' : ''); ?>"><a href="<?php echo e(url('/buy-it-now')); ?>">Buy It Now</a></li>
                <li class="<?php echo e(Request::is('starting-soon') ? 'active' : ''); ?>"><a href="<?php echo e(url('/startingsoon')); ?>">Starting Soon</a></li>
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <?php if(count($category->subcategories)): ?>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo e(url('/category/'.urlencode($category->categoryname))); ?>"><?php echo e($category->categoryname); ?><span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <?php $__currentLoopData = $category->subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(url('/show-category/'.urlencode($category->categoryname).'/'.urlencode($subcategory->name))); ?>"><?php echo e($subcategory->name); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <?php else: ?>
                            <a href="<?php echo e(url('/show-category'.$category->categoryname)); ?>"><?php echo e($category->categoryname); ?></a>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </li>
            </ul>
            <div class="col-sm-3 col-md-3 pull-right">
                <form method="GET" action="<?php echo e(url('/search')); ?>" class="navbar-form" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" name="searchTerm" id="searchTerm">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container">