<!DOCTYPE html>
<!-- Template Name: Rapido - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.2 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
    <!--<![endif]-->
    <!-- start: HEAD -->
    <head>
        <title>Rapido - the Voting App</title>
        <!-- start: META -->
        <meta charset="utf-8" />
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- end: META -->
        <!-- start: MAIN CSS -->
        <link rel="stylesheet" href="{{ URL::asset('assets/plugins/bootstrap/css/bootstrap.min.css'); }}">
        <link rel="stylesheet" href="{{ URL::asset('assets/plugins/font-awesome/css/font-awesome.min.css'); }}">
        <link rel="stylesheet" href="{{ URL::asset('assets/plugins/iCheck/skins/all.css'); }}">
        <link rel="stylesheet" href="{{ URL::asset('assets/plugins/animate.css/animate.min.css'); }}">
        <link rel="stylesheet" href="{{ URL::asset('assets/css/styles.css'); }}">
        <link rel="stylesheet" href="{{ URL::asset('assets/css/styles-responsive.css'); }}">
        <!--[if IE 7]>
        <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome-ie7.min.css">
        <![endif]-->
        <!-- end: MAIN CSS -->
        <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
        @yield('stylesheets')
        <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
    </head>
    <!-- end: HEAD -->
    <!-- start: BODY -->
    <body class="login">
        <div class="row">
            <div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
                <div class="logo">
                    <img src="{{ URL::asset('assets/images/logo.png') }}">
                </div>
                <!--Start Main Content -->
                @yield('content')
                <!--End Main Content-->
            </div>
        </div>
        <!-- start: MAIN JAVASCRIPTS -->
        <!--[if lt IE 9]>
        <script src="assets/plugins/respond.min.js"></script>
        <script src="assets/plugins/excanvas.min.js"></script>
        <script type="text/javascript" src="assets/plugins/jQuery/jquery-1.11.1.min.js"></script>
        <![endif]-->
        <!--[if gte IE 9]><!-->
        <script src="{{ URL::asset('assets/plugins/jQuery/jquery-2.1.1.min.js'); }} "></script>
        <!--<![endif]-->
        <script src="{{ URL::asset('assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js'); }} "></script>
        <script src="{{ URL::asset('assets/plugins/bootstrap/js/bootstrap.min.js'); }} "></script>
        <script src="{{ URL::asset('assets/plugins/jquery.transit/jquery.transit.js'); }} "></script>
        <script src="{{ URL::asset('assets/js/main.js'); }} "></script>
        <!-- end: MAIN JAVASCRIPTS -->
        <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        <script src="{{ URL::asset('assets/plugins/jquery-validation/dist/jquery.validate.min.js'); }} "></script>
        <script src="{{ URL::asset('assets/js/modifiedJs/login.js'); }} "></script>
        <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        @yield('scripts')
    </body>
    <!-- end: BODY -->
</html>