<?php echo $__env->make('layouts/dashboard/head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<body class="full_width" ng-app="myApp">
<div class='notifications top-right'></div>

<div id="maincontainer" class="clearfix">

    <header>
        <?php echo $__env->make('layouts/dashboard/header_nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </header>
    <div id="contentwrapper">
        <div class="main_content">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>

</div>

<div class="sidebar">
    <?php echo $__env->make('layouts/dashboard/left_sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<?php echo $__env->make('layouts/dashboard/scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</body>

<!-- Mirrored from gebo-admin-3.tzdthemes.com/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 30 Oct 2016 15:39:41 GMT -->
</html>
