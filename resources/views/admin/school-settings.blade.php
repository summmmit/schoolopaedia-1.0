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

        .fb-profile img.fb-image-lg {
            z-index: 0;
            width: 100%;
            margin-bottom: 10px;
        }

        .fb-image-profile {
            margin: -194px 10px 0px 50px;
            z-index: 9;
            width: 15%;
        }

        .fb-profile-text {
            margin-top: -120px;
            margin-right: 20px;
            color: white;
        }

        @media (max-width: 768px) {

            .fb-profile-text > h1 {
                font-weight: 700;
                font-size: 16px;
            }

            .fb-image-profile {
                margin: -45px 10px 0px 25px;
                z-index: 9;
                width: 20%;
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
        <div class="col-sm-12">
            <div class="panel panel-white">
                <div class="panel-body">
                    <div class="fb-profile">
                        <img align="left" class="fb-image-cover" height="400px" class="fb-image-lg"
                             src="http://lorempixel.com/850/280/nightlife/5/" alt="Profile image example"/>
                        <img align="left" class="fb-image-profile thumbnail"
                             src="http://lorempixel.com/180/180/people/9/" alt="Profile image example"/>

                        <div class="fb-profile-text pull-right">
                            <h1 id="data-school-name">School Name</h1>
                            <p class="pull-right">Girls just wanna go fun.</p>
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
                                    <li data-placement="top" data-original-title="Twitter" class="social-twitter tooltips">
                                        <a href="http://www.twitter.com" target="_blank">
                                            Twitter
                                        </a>
                                    </li>
                                    <li data-placement="top" data-original-title="Facebook" class="social-facebook tooltips">
                                        <a href="http://facebook.com" target="_blank">
                                            Facebook
                                        </a>
                                    </li>
                                    <li data-placement="top" data-original-title="Google" class="social-google tooltips">
                                        <a href="http://google.com" target="_blank">
                                            Google+
                                        </a>
                                    </li>
                                    <li data-placement="top" data-original-title="LinkedIn" class="social-linkedin tooltips">
                                        <a href="http://linkedin.com" target="_blank">
                                            LinkedIn
                                        </a>
                                    </li>
                                    <li data-placement="top" data-original-title="Github" class="social-github tooltips">
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
                                            <li class="active">
                                                <a href="#school-details" data-toggle="tab">
                                                    <i class="green fa fa-home"></i> School Details
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#school-codes" data-toggle="tab">
                                                    <i class="green fa fa-home"></i> School Registration Codes
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#school-schedule" data-toggle="tab">
                                                    <i class="green fa fa-home"></i> School Schedule
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade in active" id="school-details">
                                                <table data-school-id="" class="table table-bordered table-striped">
                                                    <tbody>
                                                    <tr>
                                                        <td>School Name</td>
                                                        <td id="school-name">Sumit ISngh</td>
                                                    </tr>
                                                    <tr>
                                                        <td>School Name</td>
                                                        <td id="data-school-name"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>School Logo</td>
                                                        <td id="data-school-logo"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Manager Full Name</td>
                                                        <td id="data-school-manager"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Registered Phone number</td>
                                                        <td id="data-school-phone-number"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email Address</td>
                                                        <td id="data-school-email"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Address</td>
                                                        <td id="data-school-address"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>City</td>
                                                        <td id="data-school-city"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>State</td>
                                                        <td id="data-school-state"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Country</td>
                                                        <td id="data-school-country"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Zip Code</td>
                                                        <td id="data-school-pin-code"></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="tab-pane fade" id="school-codes">
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
                                            <div class="tab-pane fade" id="school-schedule">
                                                <table id="table-school-schedule"
                                                       class="table table-bordered table-striped">
                                                    <tbody></tbody>
                                                </table>
                                                <div class="row">
                                                    <div class="col-md-offset-10 col-md-2 text-right">
                                                        <a class="btn btn-blue show-sv" href="#subview-add-new-schedule"
                                                           data-startFrom="right">
                                                            Add New Schedule <i class="fa fa-chevron-right"></i>
                                                        </a>
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
