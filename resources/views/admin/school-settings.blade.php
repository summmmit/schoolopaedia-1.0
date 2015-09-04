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
                <div class="panel-heading">
                    <h4 class="panel-title">Inline <span class="text-bold">Tabs</span></h4>
                </div>
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
                                        <table id="table-school-session" class="table table-bordered table-striped">
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
                                        <table id="table-school-schedule" class="table table-bordered table-striped">
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
