
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from gebo-admin-3.tzdthemes.com/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 30 Oct 2016 15:38:15 GMT -->
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page_title')</title>
    <!-- Bootstrap framework -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}" />
    <!-- JQuery UI framework -->
    <!-- main styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <!-- theme color-->
    <link rel="stylesheet" href="{{ asset('css/blue.css') }}" id="link_theme" />
    <!-- Google Font-->
    <!--link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'-->
    <!-- breadcrumbs -->
    <link rel="stylesheet" href="{{ asset('lib/jBreadcrumbs/css/BreadCrumb.css') }}" />
    <!-- breadcrumbs -->
    <link rel="stylesheet" href="{{ asset('lib/select2/select2.css') }}" />

    <!-- Bootstrap Notification -->
    <link rel="stylesheet" href="{{ asset('lib/bootstrap-notify/css/bootstrap-notify.css') }}" />
    <!-- File Input -->
    {{--<link href="{{ asset('lib/bootstrap-fileinput/css/fileinput.min.css') }}" rel="stylesheet">--}}
    <!-- jQuery UI theme -->
    <!-- tooltips-->
    {{--<link rel="stylesheet" href="{{ asset('lib/qtip2/jquery.qtip.min.css') }}" />
    <!-- colorbox -->
    <link rel="stylesheet" href="{{ asset('lib/colorbox/colorbox.css') }}" />
    <!-- code prettify -->
    <link rel="stylesheet" href="{{ asset('lib/google-code-prettify/prettify.css') }}" />
    <!-- sticky notifications -->
    <link rel="stylesheet" href="{{ asset('lib/sticky/sticky.css') }}" />
    <!-- aditional icons -->
    <link rel="stylesheet" href="{{ asset('img/splashy/splashy.css') }}" />
    <!-- flags -->
    <link rel="stylesheet" href="{{ asset('img/flags/flags.css') }}" />--}}
    <!-- datatables -->
    <!--link rel="stylesheet" href="{{ asset('lib/datatables/extras/TableTools/media/css/TableTools.css') }}" /-->

    <!-- font-awesome -->
    {{--<link rel="stylesheet" href="{{ asset('img/font-awesome/css/font-awesome.min.css') }}" />
    <!-- calendar -->
    <link rel="stylesheet" href="{{ asset('lib/fullcalendar/fullcalendar_gebo.css') }}" />--}}
</head>