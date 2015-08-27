<!DOCTYPE html>
<!-- Template Name: Rapido - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.2 Author: ClipTheme -->
<!--[if IE 8]>
<html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]>
<html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- start: HEAD -->
<head>
    <title>Schoolopaedia - Smart School</title>
    <!-- start: META -->
    <meta charset="utf-8"/>
    <!--[if IE]>
    <meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1"/><![endif]-->
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- end: META -->
    <!-- start: MAIN CSS -->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/styles-responsive.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/animate.css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/print.css') }}" type="text/css" media="print"/>
    <!--[if IE 7]>
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/font-awesome/css/font-awesome-ie7.min.css') }}">
    <![endif]-->
    <!-- end: MAIN CSS -->
    <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
    <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
    <link rel="shortcut icon" href="favicon.ico"/>

    <style>
        .page-error .error-number {
            font-size: 80px;
            letter-spacing: -5px;
            line-height: 90px;
        }
        .page-error .error-details {
            padding-top: 21px;
        }
    </style>
</head>
<!-- end: HEAD -->
<!-- start: BODY -->
<body class="error-full-page">
<!-- start: PAGE -->
<div class="container">
    <div class="row">
        <!-- start: 404 -->
        <div class="col-sm-12 page-error animated shake">
            <div class="error-number text-azure">
                Thank You
            </div>
            <div class="error-details col-sm-6 col-sm-offset-3">
                <h3>
                    @yield('content')
                </h3>
                <p>
                    <a href="{{ URL::route('account-user-sign-in') }}" class="btn btn-red btn-return">
                       Go to Login Page
                    </a>
                </p>
            </div>
        </div>
        <!-- end: 404 -->
    </div>
</div>
<!-- end: PAGE -->
<!-- start: MAIN JAVASCRIPTS -->
<!--[if lt IE 9]>
<script src="{{ URL::asset('assets/plugins/respond.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/excanvas.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/plugins/jQuery/jquery-1.11.1.min.js') }}"></script>
<![endif]-->
<!--[if gte IE 9]><!-->
<script src="{{ URL::asset('assets/plugins/jQuery/jquery-2.1.1.min.js') }}"></script>
<!--<![endif]-->
<script src="{{ URL::asset('assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jquery-cookie/jquery.cookie.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/TouchSwipe/jquery.touchSwipe.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/main.js') }}"></script>
<!-- end: MAIN JAVASCRIPTS -->
<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script>
    jQuery(document).ready(function () {
        Main.init();
    });
</script>
</body>
<!-- end: BODY -->
</html>