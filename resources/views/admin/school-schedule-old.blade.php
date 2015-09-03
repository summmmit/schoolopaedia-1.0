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
                    <table class="table table-hover" id="sample-table-1">
                        <thead>
                        <tr>
                            <h4>Schedule Start From
                                <strong>( 2015-September-15 )</strong> To
                                <strong>( 2016-May-15 )</strong>
                            </h4>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="active">
                            <td class="center">Opening Time</td>
                            <td class="center">10:15 Am</td>
                        </tr>
                        <tr class="warning">
                            <td class="center">Lunch Time</td>
                            <td class="center">12:15 Pm</td>
                        </tr>
                        <tr class="success">
                            <td class="center">Opening Time</td>
                            <td class="center">4:15 Pm</td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td></td>
                            <td class="center">
                                <a href="#subview-add-new-schedule" class="btn btn-success col-sm-3 pull-right show-sv" data-startFrom="right">
                                    Edit <i class="fa fa-arrow-circle-right"></i>
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
