<!DOCTYPE html>
<!-- Template Name: Rapido - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.2 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- start: HEAD -->
    <head>
        <title>Schoolopaedia - Smart School</title>
        <!-- start: META -->
        <meta charset="utf-8" />
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- end: META -->
        <!-- start: MAIN CSS -->
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,500,600,700,200,100,800' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="{{ URL::asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('assets/plugins/iCheck/skins/all.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('assets/plugins/animate.css/animate.min.css') }}">
        <!-- end: MAIN CSS -->
        <!-- start: CSS REQUIRED FOR SUBVIEW CONTENTS -->
        <link rel="stylesheet" href="{{ URL::asset('assets/plugins/owl-carousel/owl-carousel/owl.carousel.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('assets/plugins/owl-carousel/owl-carousel/owl.theme.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('assets/plugins/owl-carousel/owl-carousel/owl.transitions.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('assets/plugins/summernote/dist/summernote.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('assets/plugins/fullcalendar/fullcalendar/fullcalendar.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('assets/plugins/toastr/toastr.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('assets/plugins/bootstrap-select/bootstrap-select.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('assets/plugins/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('assets/plugins/DataTables/media/css/DT_bootstrap.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') }}">
        <!-- end: CSS REQUIRED FOR THIS SUBVIEW CONTENTS-->
        <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
        @yield('stylesheets')
        <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
        <!-- start: CORE CSS -->
        <link rel="stylesheet" href="{{ URL::asset('assets/css/styles.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('assets/css/styles-responsive.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('assets/css/plugins.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('assets/css/themes/theme-default.css') }}" type="text/css" id="skin_color">
        <link rel="stylesheet" href="{{ URL::asset('assets/css/print.css') }}" type="text/css" media="print"/>
        <!-- end: CORE CSS -->
        <link rel="shortcut icon" href="{{ URL::asset('assets/favicon.ico') }}" />
        <style>
            .main-container{
                margin-left: 0px;
            }
        </style>
    </head>
    <!-- end: HEAD -->
    <!-- start: BODY -->
    <body>
        <div class="main-wrapper">
            <!-- start: TOPBAR -->
            <header class="topbar navbar navbar-inverse navbar-fixed-top inner">
                <!-- start: TOPBAR CONTAINER -->
                <div class="container">
                    <div class="navbar-header">
                        <!-- start: LOGO -->
                        <a class="navbar-brand" href="index.html">
                            <img src="{{ URL::asset('assets/images/logo.png') }}" alt="Rapido"/>
                        </a>
                        <!-- end: LOGO -->
                    </div>
                </div>
                <!-- end: TOPBAR CONTAINER -->
            </header>
            <!-- end: TOPBAR -->
            <!-- start: MAIN CONTAINER -->
            <div class="main-container inner">
                <!-- start: PAGE -->
                <div class="main-content">
                    <div class="container">
                        <!-- start: PAGE HEADER -->
                        <!-- start: TOOLBAR -->
                        <div class="toolbar row">
                            <div class="col-sm-6 hidden-xs">
                                <div class="page-header">
                                    @yield('page_header')
                                </div>
                            </div>
                        </div>
                        <!-- end: TOOLBAR -->
                        <!-- end: PAGE HEADER -->
                        <!-- start: BREADCRUMB -->
                        <div class="row">
                            <div class="col-md-12">
                                @yield('page_breadcrumb')
                            </div>
                        </div>
                        <!-- end: BREADCRUMB -->
                        <!-- start: PAGE CONTENT -->
                        @yield('content')
                        <!-- end: PAGE CONTENT-->
                    </div>
                </div>
                <!-- end: PAGE -->
            </div>
            <!-- end: MAIN CONTAINER -->
            <!-- start: FOOTER -->
            <footer class="inner">
                <div class="footer-inner">
                    <div class="pull-left">
                        2014 &copy; By Sumit Singh.
                    </div>
                    <div class="pull-right">
                        <span class="go-top"><i class="fa fa-chevron-up"></i></span>
                    </div>
                </div>
            </footer>
            <!-- end: FOOTER -->
            <!-- start: SUBVIEW SAMPLE CONTENTS -->
            <!-- *** READ NOTE *** -->
            <div id="readNote">
                <div class="barTopSubview">
                    <a href="#newNote" class="new-note button-sv"><i class="fa fa-plus"></i> Add new note</a>
                </div>
                <div class="noteWrap col-md-8 col-md-offset-2">
                    <div class="panel panel-note">
                        <div class="e-slider owl-carousel owl-theme">
                            <div class="item">
                                <div class="panel-heading">
                                    <h3>This is a Note</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="note-short-content">
                                        Lorem ipsum dolor sit amet, consectetur adipisici elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...
                                    </div>
                                    <div class="note-content">
                                        Lorem ipsum dolor sit amet, consectetur adipisici elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua.
                                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat.
                                        Quis aute iure reprehenderit in <strong>voluptate velit</strong> esse cillum dolore eu fugiat nulla pariatur.
                                        <br>
                                        Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        <br>
                                        Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci v'elit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem.
                                        <br>
                                        Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut <strong>aliquid ex ea commodi consequatur?</strong>
                                        <br>
                                        Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur?
                                        <br>
                                        At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.
                                        <br>
                                        Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae.
                                        <br>
                                        Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.
                                    </div>
                                    <div class="note-options pull-right">
                                        <a href="#readNote" class="read-note"><i class="fa fa-chevron-circle-right"></i> Read</a><a href="#" class="delete-note"><i class="fa fa-times"></i> Delete</a>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <div class="avatar-note"><img src="{{ URL::asset('assets/images/avatar-2-small.jpg') }}" alt="">
                                    </div>
                                    <span class="author-note">Nicole Bell</span>
                                    <time class="timestamp" title="2014-02-18T00:00:00-05:00">
                                        2014-02-18T00:00:00-05:00
                                    </time>
                                </div>
                            </div>
                            <div class="item">
                                <div class="panel-heading">
                                    <h3>This is the second Note</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="note-short-content">
                                        Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Nemo enim ipsam voluptatem, quia voluptas sit...
                                    </div>
                                    <div class="note-content">
                                        Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        <br>
                                        Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci v'elit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem.
                                        <br>
                                        Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut <strong>aliquid ex ea commodi consequatur?</strong>
                                        <br>
                                        Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur?
                                        <br>
                                        Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae.
                                        <br>
                                        Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.
                                    </div>
                                    <div class="note-options pull-right">
                                        <a href="#" class="read-note"><i class="fa fa-chevron-circle-right"></i> Read</a><a href="#" class="delete-note"><i class="fa fa-times"></i> Delete</a>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <div class="avatar-note"><img src="{{ URL::asset('assets/images/avatar-3-small.jpg') }}" alt="">
                                    </div>
                                    <span class="author-note">Steven Thompson</span>
                                    <time class="timestamp" title="2014-02-18T00:00:00-05:00">
                                        2014-02-18T00:00:00-05:00
                                    </time>
                                </div>
                            </div>
                            <div class="item">
                                <div class="panel-heading">
                                    <h3>This is yet another Note</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="note-short-content">
                                        At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores...
                                    </div>
                                    <div class="note-content">
                                        At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.
                                        <br>
                                        Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        <br>
                                        Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci v'elit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem.
                                        <br>
                                        Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut <strong>aliquid ex ea commodi consequatur?</strong>
                                    </div>
                                    <div class="note-options pull-right">
                                        <a href="#" class="read-note"><i class="fa fa-chevron-circle-right"></i> Read</a><a href="#" class="delete-note"><i class="fa fa-times"></i> Delete</a>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <div class="avatar-note"><img src="{{ URL::asset('assets/images/avatar-4-small.jpg') }}" alt="">
                                    </div>
                                    <span class="author-note">Ella Patterson</span>
                                    <time class="timestamp" title="2014-02-18T00:00:00-05:00">
                                        2014-02-18T00:00:00-05:00
                                    </time>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- *** NEW EVENT *** -->
            <!-- end: SUBVIEW SAMPLE CONTENTS -->
        </div>
        <!-- start: MAIN JAVASCRIPTS -->
        <!--[if lt IE 9]>
        <script src="assets/plugins/respond.min.js"></script>
        <script src="assets/plugins/excanvas.min.js"></script>
        <script type="text/javascript" src="assets/plugins/jQuery/jquery-1.11.1.min.js"></script>
        <![endif]-->
        <!--[if gte IE 9]><!-->
        <script src="{{ URL::asset('assets/plugins/jQuery/jquery-2.1.1.min.js') }} "></script>
        <!--<![endif]-->
        <script src="{{ URL::asset('assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js') }} "></script>
        <script src="{{ URL::asset('assets/plugins/bootstrap/js/bootstrap.min.js') }} "></script>
        <script src="{{ URL::asset('assets/plugins/blockUI/jquery.blockUI.js') }} "></script>
        <script src="{{ URL::asset('assets/plugins/iCheck/jquery.icheck.min.js') }} "></script>
        <script src="{{ URL::asset('assets/plugins/moment/min/moment.min.js') }} "></script>
        <script src="{{ URL::asset('assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js') }} "></script>
        <script src="{{ URL::asset('assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js') }} "></script>
        <script src="{{ URL::asset('assets/plugins/bootbox/bootbox.min.js') }} "></script>
        <script src="{{ URL::asset('assets/plugins/jquery.scrollTo/jquery.scrollTo.min.js') }} "></script>
        <script src="{{ URL::asset('assets/plugins/ScrollToFixed/jquery-scrolltofixed-min.js') }} "></script>
        <script src="{{ URL::asset('assets/plugins/jquery.appear/jquery.appear.js') }} "></script>
        <script src="{{ URL::asset('assets/plugins/jquery-cookie/jquery.cookie.js') }} "></script>
        <script src="{{ URL::asset('assets/plugins/velocity/jquery.velocity.min.js') }} "></script>
        <script src="{{ URL::asset('assets/plugins/TouchSwipe/jquery.touchSwipe.min.js') }} "></script>
        <!-- end: MAIN JAVASCRIPTS -->
        <!-- start: JAVASCRIPTS REQUIRED FOR SUBVIEW CONTENTS -->
        <script src="{{ URL::asset('assets/plugins/owl-carousel/owl-carousel/owl.carousel.js') }} "></script>
        <script src="{{ URL::asset('assets/plugins/jquery-mockjax/jquery.mockjax.js') }} "></script>
        <script src="{{ URL::asset('assets/plugins/toastr/toastr.js') }} "></script>
        <script src="{{ URL::asset('assets/plugins/bootstrap-modal/js/bootstrap-modal.js') }} "></script>
        <script src="{{ URL::asset('assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }} "></script>
        <script src="{{ URL::asset('assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js') }} "></script>
        <script src="{{ URL::asset('assets/plugins/bootstrap-switch/dist/js/bootstrap-switch.min.js') }} "></script>
        <script src="{{ URL::asset('assets/plugins/bootstrap-select/bootstrap-select.min.js') }} "></script>
        <script src="{{ URL::asset('assets/plugins/jquery-validation/dist/jquery.validate.min.js') }} "></script>
        <script src="{{ URL::asset('assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js') }} "></script>
        <script src="{{ URL::asset('assets/plugins/DataTables/media/js/jquery.dataTables.min.js') }} "></script>
        <script src="{{ URL::asset('assets/plugins/truncate/jquery.truncate.js') }} "></script>
        <script src="{{ URL::asset('assets/plugins/summernote/dist/summernote.min.js') }} "></script>
        <script src="{{ URL::asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }} "></script>
        <script src="{{ URL::asset('assets/js/subview.js') }} "></script>
        <script src="{{ URL::asset('assets/js/subview-examples.js') }} "></script>
        <!-- end: JAVASCRIPTS REQUIRED FOR SUBVIEW CONTENTS -->
        <!-- start: CORE JAVASCRIPTS  -->
        <script src="{{ URL::asset('assets/js/main.js') }} "></script>
        <!-- end: CORE JAVASCRIPTS  -->
        <!-- start: VARIABLES FOR JAVASCRIPTS  -->
        <script src="{{ URL::asset('school/required/javascript-variables.js') }} "></script>
        <!-- end: VARIABLES FOR JAVASCRIPTS  -->
        <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        @yield('scripts')
        <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
    </body>
    <!-- end: BODY -->
</html>