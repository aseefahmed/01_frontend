@include('layouts/dashboard/head')
<body class="full_width" ng-app="myApp">
<div class='notifications top-right'></div>

<div id="maincontainer" class="clearfix">

    <header>
        @include('layouts/dashboard/header_nav')
    </header>
    <div id="contentwrapper">
        <div class="main_content">
            @yield('content')
        </div>
    </div>

</div>

<div class="sidebar">
    @include('layouts/dashboard/left_sidebar')
</div>
@include('layouts/dashboard/scripts')
</body>

<!-- Mirrored from gebo-admin-3.tzdthemes.com/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 30 Oct 2016 15:39:41 GMT -->
</html>
