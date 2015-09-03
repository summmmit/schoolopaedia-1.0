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
            <!-- start: DYNAMIC TABLE PANEL -->
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h4 class="panel-title">Editable <span class="text-bold">Table</span></h4>
                    <div class="panel-tools">
                        <div class="dropdown">
                            <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
                                <i class="fa fa-cog"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-light pull-right" role="menu">
                                <li>
                                    <a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
                                </li>
                                <li>
                                    <a class="panel-refresh" href="#">
                                        <i class="fa fa-refresh"></i> <span>Refresh</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="panel-config" href="#panel-config" data-toggle="modal">
                                        <i class="fa fa-wrench"></i> <span>Configurations</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="panel-expand" href="#">
                                        <i class="fa fa-expand"></i> <span>Fullscreen</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <a class="btn btn-xs btn-link panel-close" href="#">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 space20">
                            <button class="btn btn-green add-row">
                                Add New <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="sample_2">
                            <thead>
                            <tr>
                                <th class="center">Profile Name</th>
                                <th class="center">Current Profile</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="center">Profile 1</td>
                                <td class="center">
                                    <div class="checkbox-table">
                                        <label>
                                            <input type="checkbox" class="flat-grey foocheck">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <a href="#" class="edit-row">
                                        Edit
                                    </a></td>
                                <td>
                                    <a href="#" class="delete-row">
                                        Delete
                                    </a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
    <script type="text/javascript" src="assets/plugins/select2/select2.min.js"></script>
    <script type="text/javascript" src="school/admin/school-settings/table-data-school-schedule.js"></script>
    <script>
        jQuery(document).ready(function () {
            Main.init();
            SVExamples.init();
            AdminSchoolSchedule.init();
            TableDataSchoolSchedule.init();
            $('.date-picker').datepicker({
                autoclose: true
            });
            $(".time-picker").on("focus", function() {
                return $(this).timepicker("showWidget");
            });
        });
    </script>

@stop
