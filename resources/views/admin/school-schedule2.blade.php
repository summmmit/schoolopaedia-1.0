@extends('layouts.main-layout')

@section('page_header')
    <h1><i class="fa fa-clock-o"></i> Schedule</h1>
@stop

@section('stylesheets')
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css') }}">
@stop

@section('page_breadcrumb')
    <ol class="breadcrumb">
        <li>
            <a href="#">
                Dashboard
            </a>
        </li>
        <li class="active">
            School Schedule
        </li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            @if(Session::has('global'))
                <div class="errorHandler alert alert-success">
                    <i class="fa fa-remove-sign"></i>{{ Session::get('global') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- start: CONTEXTUAL CLASSES -->
            <div class="panel panel-white">
                <div class="panel-body">
                    <p>
                    <h4><strong>Schedule Profiles</strong></h4>
                    </p>
                    <table class="table table-hover" id="table-schedule-profiles">
                        <thead>
                        <tr>
                            <td class="center">Profile Name</td>
                            <td class="center">Current Profile</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr data-schedule-profile-id="1">
                            <td class="center">Profile 1</td>
                            <td class="center">
                                <div class="checkbox-table">
                                    <label>
                                        <input type="checkbox" class="flat-grey foocheck">
                                    </label>
                                </div>
                            </td>
                            <td class="center">
                                <div class="visible-md visible-lg hidden-sm hidden-xs">
                                    <a href="#" id="schedule-profile-edit" class="btn btn-xs btn-blue tooltips" data-placement="top" data-original-title="Show"><i class="fa fa-edit"></i></a>
                                    <a href="#" id="schedule-profile-delete" class="btn btn-xs btn-red tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
                                </div>
                                <div class="visible-xs visible-sm hidden-md hidden-lg">
                                    <div class="btn-group">
                                        <a class="btn btn-green dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                                            <i class="fa fa-cog"></i> <span class="caret"></span>
                                        </a>
                                        <ul role="menu" class="dropdown-menu pull-right dropdown-dark">
                                            <li>
                                                <a role="menuitem" tabindex="-1" href="#" id="schedule-profile-edit">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a role="menuitem" tabindex="-1" href="#" id="schedule-profile-delete">
                                                    <i class="fa fa-times"></i> Remove
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <a href="#subview-add-new-schedule-profile" class="btn btn-success col-sm-6 pull-right show-sv" data-startFrom="right">
                                    New <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- end: CONTEXTUAL CLASSES -->
        </div>
    </div>
@stop

@section('subview')
        <!--Start :  Subview for This page only -->
    <div id="subview-add-new-schedule-profile" class="no-display">
        <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="col-md-12">
                    <!-- start: DYNAMIC TABLE PANEL -->
                    <div class="panel panel-white panel-add-subjects">
                        <div class="panel-heading">
                            <h3>New Profile</h3>
                        </div>
                        <div class="panel-body">
                            <form action="#" method="post" class="form-horizontal" role="form" id="form-new-schedule">
                                <div class="form-group has-success">
                                    <div class="col-sm-8">
                                        <label class="col-sm-3 control-label">
                                            Profile Name
                                        </label>
                                        <div class="col-sm-9">
													<span class="input-icon">
														<input type="text" name="profile_name" placeholder="Text Field" id="form-field-14" class="form-control">
														<i class="fa fa-user"></i>
                                                    </span>
                                        </div>
                                    </div>
                                    <div class="col-offset-sm-1 col-sm-3">
                                        <button class="btn btn-block btn-info save-note" type="submit" id="form-submit-new-schedule-profile">
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
                                            <input type="text" name="schedule_starts_from" id="schedule-starts-from" data-date-format="yyyy-mm-dd" data-date-viewmode="years" class="form-control date-picker">
                                            <span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <p>
                                            Schedule Ends Untill
                                        </p>
                                        <div class="input-group">
                                            <input type="text" name="schedule_ends_untill" id="schedule-ends-untill" data-date-format="yyyy-mm-dd" data-date-viewmode="years" class="form-control date-picker">
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
                                            <input type="text" name="school_opening_time" id="school-opening-time" class="form-control time-picker">
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
                                            <input type="text" name="school_lunch_time" id="school-lunch-time" class="form-control time-picker">
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
                                            <input type="text" name="school_closing_time" id="school-closing-time" class="form-control time-picker">
                                            <span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-9 col-sm-3">
                                        <button class="btn btn-block btn-info save-note" type="submit" id="form-submit-new-schedule">
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

            <!-- Scripts for This page only -->
    <script src="{{ URL::asset('assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/x-editable/js/bootstrap-editable.min.js') }}"></script>
    <script src="{{ URL::asset('school\admin\school-settings/school-schedule.js') }}"></script>
    <script>
        jQuery(document).ready(function () {
            Main.init();
            SVExamples.init();
            AdminSchoolSchedule.init();
            $('.date-picker').datepicker({
                autoclose: true
            });
            $(".time-picker").on("focus", function() {
                return $(this).timepicker("showWidget");
            });
        });
    </script>

@stop
