@extends('layouts.main-layout')

@section('stylesheets')
    <link rel="stylesheet"
          href="{{ URL::asset('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/x-editable/css/bootstrap-editable.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/typeaheadjs/lib/typeahead.js-bootstrap.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/jquery-address/address.css') }}">
    <link rel="stylesheet"
          href="{{ URL::asset('assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.css') }}">
    <link rel="stylesheet"
          href="{{ URL::asset('assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysiwyg-color.css') }}">
    <style>

        .well {
            margin-top:-20px;
            background-color:#007FBD;
            border:2px solid #0077B2;
            text-align:center;
            cursor:pointer;
            font-size: 25px;
            padding: 15px;
            border-radius: 0px !important;
        }

        .well:hover {
            margin-top:-20px;
            background-color:#0077B2;
            border:2px solid #0077B2;
            text-align:center;
            cursor:pointer;
            font-size: 25px;
            padding: 15px;
            border-radius: 0px !important;
            border-bottom : 2px solid rgba(97, 203, 255, 0.65);
        }

        body {
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            font-size: 14px;
            line-height: 1.42857143;
            color: #fff;
            background-color: #F1F1F1;
        }



        .bg_blur
        {
            background-image:url('http://data2.whicdn.com/images/139218968/large.jpg');
            height: 300px;
            background-size: cover;
        }

        .follow_btn {
            text-decoration: none;
            position: absolute;
            left: 35%;
            top: 42.5%;
            width: 35%;
            height: 15%;
            background-color: #007FBE;
            padding: 10px;
            padding-top: 6px;
            color: #fff;
            text-align: center;
            font-size: 20px;
            border: 4px solid #007FBE;
        }

        .follow_btn:hover {
            text-decoration: none;
            position: absolute;
            left: 35%;
            top: 42.5%;
            width: 35%;
            height: 15%;
            background-color: #007FBE;
            padding: 10px;
            padding-top: 6px;
            color: #fff;
            text-align: center;
            font-size: 20px;
            border: 4px solid rgba(255, 255, 255, 0.8);
        }

        .header{
            color : #808080;
            margin-left:10%;
            margin-top:70px;
        }

        .picture{
            height:150px;
            width:150px;
            position:absolute;
            top: 75px;
            left:-75px;
        }

        .picture_mob{
            position: absolute;
            width: 35%;
            left: 35%;
            bottom: 70%;
        }

        .btn-style{
            color: #fff;
            background-color: #007FBE;
            border-color: #adadad;
            width: 33.3%;
        }

        .btn-style:hover {
            color: #333;
            background-color: #3D5DE0;
            border-color: #adadad;
            width: 33.3%;

        }


        @media (max-width: 767px) {
            .header{
                text-align : center;
            }



            .nav{
                margin-top : 30px;
            }
        }
    </style>
@stop

@section('page_header')
    <h1><i class="fa fa-pencil-square"></i> School Details</h1>
@stop

@section('page_breadcrumb')
    <ol class="breadcrumb">
        <li>
            <a href="#">
                Dashboard
            </a>
        </li>
        <li class="active">
            school settings
        </li>
    </ol>
    @stop

    @section('content')
            <!-- start: PAGE CONTENT -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-body">
                    <div class="container" style="margin-top: 20px; margin-bottom: 20px;">
                        <div class="row panel">
                            <div class="col-md-4 bg_blur ">
                            </div>
                            <div class="col-md-8  col-xs-12">
                                <img src="http://lorempixel.com/output/people-q-c-100-100-1.jpg"
                                     class="img-thumbnail picture hidden-xs"/>
                                <img src="http://lorempixel.com/output/people-q-c-100-100-1.jpg"
                                     class="img-thumbnail visible-xs picture_mob"/>

                                <div class="header">
                                    <h1 id="data-school-name"></h1>
                                    <span>"There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain..."</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5 col-md-4">
            <div class="panel panel-white">
                <div class="panel-body">
                    <div class="user-left">
                        <table class="table table-condensed table-hover">
                            <thead>
                            <tr>
                                <th colspan="3">General information</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Address</td>
                                <td id="data-school-address"></td>
                                <td><a href="#panel_edit_account" class="show-tab"><i
                                                class="fa fa-pencil edit-user-info"></i></a></td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td id="data-school-city"></td>
                                <td>
                                    <a href="#panel_edit_account" class="show-tab">
                                        <i class="fa fa-pencil edit-user-info"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>State</td>
                                <td id="data-school-state"></td>
                                <td>
                                    <a href="#panel_edit_account" class="show-tab">
                                        <i class="fa fa-pencil edit-user-info"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td id="data-school-country"></td>
                                <td>
                                    <a href="#panel_edit_account" class="show-tab">
                                        <i class="fa fa-pencil edit-user-info"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Zip Code</td>
                                <td id="data-school-pin-code"></td>
                                <td>
                                    <a href="#panel_edit_account" class="show-tab">
                                        <i class="fa fa-pencil edit-user-info"></i>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="table table-condensed table-hover">
                            <thead>
                            <tr>
                                <th colspan="3">Contact Information</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>email:</td>
                                <td id="data-school-email"></td>
                                <td><a href="#panel_edit_account" class="show-tab"><i
                                                class="fa fa-pencil edit-user-info"></i></a></td>
                            </tr>
                            <tr>
                                <td>phone:</td>
                                <td id="data-school-phone-number"></td>
                                <td><a href="#panel_edit_account" class="show-tab"><i
                                                class="fa fa-pencil edit-user-info"></i></a></td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="center">
                            <hr>
                            <div class="social-icons block">
                                <ul>
                                    <li data-placement="top" data-original-title="Twitter"
                                        class="social-twitter tooltips">
                                        <a href="http://www.twitter.com" target="_blank">
                                            Twitter
                                        </a>
                                    </li>
                                    <li data-placement="top" data-original-title="Facebook"
                                        class="social-facebook tooltips">
                                        <a href="http://facebook.com" target="_blank">
                                            Facebook
                                        </a>
                                    </li>
                                    <li data-placement="top" data-original-title="Google"
                                        class="social-google tooltips">
                                        <a href="http://google.com" target="_blank">
                                            Google+
                                        </a>
                                    </li>
                                    <li data-placement="top" data-original-title="LinkedIn"
                                        class="social-linkedin tooltips">
                                        <a href="http://linkedin.com" target="_blank">
                                            LinkedIn
                                        </a>
                                    </li>
                                    <li data-placement="top" data-original-title="Github"
                                        class="social-github tooltips">
                                        <a href="#" target="_blank">
                                            Github
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-7 col-md-8">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-white">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="tabbable">
                                        <ul id="myTab" class="nav nav-tabs">
                                            <li>
                                                <a href="#school-codes" data-toggle="tab">
                                                    <i class="green fa fa-home"></i> School Registration Codes
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade in active" id="school-codes">
                                                <table id="table-school-session"
                                                       class="table table-bordered table-striped">
                                                    <tbody>
                                                    <tr>
                                                        <td>School Registration Code</td>
                                                        <td id="school-registration-code" class="center"></td>
                                                        <td class="center"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Admin Registration Code</td>
                                                        <td id="code-for-admin" class="center"></td>
                                                        <td class="center">
                                                            <a href="#" class="btn btn-success">Invite</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Student Registration Code</td>
                                                        <td id="code-for-students" class="center"></td>
                                                        <td class="center">
                                                            <a href="#" class="btn btn-success">Invite</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Teacher Registration Code</td>
                                                        <td id="code-for-teachers" class="center"></td>
                                                        <td class="center">
                                                            <a href="#" class="btn btn-success">Invite</a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end: PAGE CONTENT-->
    @stop

    @section('subview')
            <!--Start :  Subview for This page only -->
    <div id="subview-add-new-schedule" class="no-display">
        <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="col-md-12">
                    <!-- start: DYNAMIC TABLE PANEL -->
                    <div class="panel panel-white panel-add-subjects">
                        <div class="panel-heading">
                            <h3>Add New Schedule</h3>
                        </div>
                        <div class="panel-body">
                            <form action="#" method="post" class="form-horizontal" role="form" id="form-new-schedule">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-4">
                                        <p>
                                            Schedule Starts From
                                        </p>

                                        <div class="input-group">
                                            <input type="text" name="schedule_starts_from" id="schedule-starts-from"
                                                   data-date-format="yyyy-mm-dd" data-date-viewmode="years"
                                                   class="form-control date-picker">
                                            <span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <p>
                                            Schedule Ends Untill
                                        </p>

                                        <div class="input-group">
                                            <input type="text" name="schedule_ends_untill" id="schedule-ends-untill"
                                                   data-date-format="yyyy-mm-dd" data-date-viewmode="years"
                                                   class="form-control date-picker">
                                            <span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label>
                                            School Opening Time
                                        </label>

                                        <div class="input-group input-append bootstrap-timepicker">
                                            <input type="text" name="school_opening_time" id="school-opening-time"
                                                   class="form-control time-picker">
                                            <span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label>
                                            School Lunch Time
                                        </label>

                                        <div class="input-group input-append bootstrap-timepicker">
                                            <input type="text" name="school_lunch_time" id="school-lunch-time"
                                                   class="form-control time-picker">
                                            <span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label>
                                            School Closing Time
                                        </label>

                                        <div class="input-group input-append bootstrap-timepicker">
                                            <input type="text" name="school_closing_time" id="school-closing-time"
                                                   class="form-control time-picker">
                                            <span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-9 col-sm-3">
                                        <button class="btn btn-block btn-info save-note" type="submit"
                                                id="form-submit-new-schedule">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- End: DYNAMIC TABLE PANEL -->
                </div>
            </div>
        </div>
    </div>
    <!--End :  Subview for This page only -->
    @stop

    @section('scripts')

            <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <script src="{{ URL::asset('assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/x-editable/js/bootstrap-editable.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/typeaheadjs/typeaheadjs.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/typeaheadjs/lib/typeahead.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery-address/address.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysihtml5-0.3.0.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/wysihtml5/wysihtml5.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modifiedJs/admin/school-settings/school-schedule.js') }}"></script>
    <script src="{{ URL::asset('school/admin/school-settings/school-settings.js') }}"></script>
    <script src="{{ URL::asset('school/admin/school-settings/school-settings-xeditable.js') }}"></script>
    <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <script>
        jQuery(document).ready(function () {
            Main.init();
            SVExamples.init();
            Schedule.init();
            AdminSchoolSettings.init();
            $('.date-picker').datepicker({
                autoclose: true
            });
            $('.time-picker').timepicker();
        });
    </script>

@stop
