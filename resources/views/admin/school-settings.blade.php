@extends('layouts.main-layout')

@section('stylesheets')
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css'); }}">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/select2/select2.css'); }}">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css'); }}">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/x-editable/css/bootstrap-editable.css'); }}">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/typeaheadjs/lib/typeahead.js-bootstrap.css'); }}">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/jquery-address/address.css'); }}">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.css'); }}">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysiwyg-color.css'); }}">
@stop

@section('page_header')
<h1><i class="fa fa-pencil-square"></i> School Session ( {{ date_format(date_create($current_session->session_start), "F/Y") }} --- {{ date_format(date_create($current_session->session_end), "F/Y") }} )</h1>
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
                                    <a href="#school-session" data-toggle="tab">
                                        <i class="green fa fa-home"></i> School Session
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
                                    <table id="user" class="table table-bordered table-striped">
                                        <tbody>
                                            <tr>
                                                <td>School Name</td>
                                                <td>{{ $school->school_name }}</td>
                                            </tr>
                                            <tr>
                                                <td>School Logo</td>
                                                <td>
                                                    <img class="thumbnail" src="{{ URL::asset('assets/projects/images/'.$school->logo); }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>School Manager</td>
                                                <td>{{ $school->manager_full_name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Phone Number</td>
                                                <td>{{ $school->phone_number }}</td>
                                            </tr>
                                            <tr>
                                                <td>Registered Email Address</td>
                                                <td>{{ $school->email }}</td>
                                            </tr>
                                            <tr>
                                                <td>Address</td>
                                                <td>
                                                    <address>
                                                        {{ $school->add_1 }}<br>
                                                        {{ $school->add_2 }} {{ $school->city }}<br>
                                                        {{ $school->state }}<br>
                                                        {{ $school->country }} ({{ $school->pin_code }})
                                                    </address>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Registration Code</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Registration Code for Admin</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Registration Code for Moderators</td>
                                                <td>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Registration Code for Teachers</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Registration Code for Parents</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Registration Code for Students</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Registered Since</td>
                                                <td>{{ date_format(date_create($school->registration_date), "d - F - Y") }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="school-session">
                                    <table id="table-school-session" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Session Start</td>
                                            <td>Session End</td>
                                            <td class="center">Current</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; ?>
                                        @foreach($sessions as $session)
                                            <tr data-school-session-id="{{ $session->id }}">
                                                <td>{{ $i++ }}</td>
                                                <td>{{ date_format(date_create($session->session_start), "F/Y") }}</td>
                                                <td>{{ date_format(date_create($session->session_end), "F/Y") }}</td>
                                                <td class="center">
                                                    <div class="radio-inline">
                                                        <input type="radio" class="square-red" name="current_session" {{ $session->current_session ? 'checked' : '' }}>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    </div>
                                <div class="tab-pane fade" id="school-schedule">
                                    <table id="table-school-schedule" class="table table-bordered table-striped">
                                        <tbody>
                                            @foreach($schedules as $schedule)
                                            <tr>
                                                <td colspan="2" class="text-center text-box-light">{{ date_format(date_create($schedule->start_from), "F / Y") }} - {{ date_format(date_create($schedule->close_untill), "F / Y") }}</td>
                                            </tr>
                                            <tr>
                                                <td class="column-left">School Opening Time</td>
                                                <td class="column-right">
                                                    <a href="#" class="opening-time" data-type="combodate" data-template="HH:mm A" data-format="HH:mm A" data-viewformat="HH:mm A" data-pk="{{ $schedule->id }}">
                                                        {{ date_format(date_create($schedule->opening_time), "h:i A") }}
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="column-left">Lunch Time</td>
                                                <td class="column-right">
                                                    <a href="#" class="lunch-time" data-type="combodate" data-template="HH:mm A" data-format="HH:mm A" data-viewformat="HH:mm A" data-pk="{{ $schedule->id }}">
                                                        {{ date_format(date_create($schedule->lunch_time), "h:i A") }}
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="column-left">School Closing Time</td>
                                                <td class="column-right">
                                                    <a href="#" class="closing-time" data-type="combodate" data-template="HH:mm" data-format="HH:mm A" data-viewformat="HH:mm A" data-pk="{{ $schedule->id }}">
                                                        {{ date_format(date_create($schedule->closing_time), "h:i A") }}
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-md-offset-10 col-md-2 text-right">
                                            <a class="btn btn-blue show-sv" href="#subview-add-new-schedule" data-startFrom="right">
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

<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script src="{{ URL::asset('assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js'); }}"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js'); }}"></script>
<script src="{{ URL::asset('assets/plugins/x-editable/js/bootstrap-editable.min.js'); }}"></script>
<script src="{{ URL::asset('assets/plugins/typeaheadjs/typeaheadjs.js'); }}"></script>
<script src="{{ URL::asset('assets/plugins/typeaheadjs/lib/typeahead.js'); }}"></script>
<script src="{{ URL::asset('assets/plugins/jquery-address/address.js'); }}"></script>
<script src="{{ URL::asset('assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysihtml5-0.3.0.min.js'); }}"></script>
<script src="{{ URL::asset('assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5.js'); }}"></script>
<script src="{{ URL::asset('assets/plugins/wysihtml5/wysihtml5.js'); }}"></script>
<script src="{{ URL::asset('assets/js/modifiedJs/admin/school-settings/school-settings-xeditable.js'); }}"></script>
<script src="{{ URL::asset('assets/js/modifiedJs/admin/school-settings/school-schedule.js'); }}"></script>
<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script>
jQuery(document).ready(function() {
    Main.init();
    SVExamples.init();
    Schedule.init();
    $('.date-picker').datepicker({
        autoclose: true
    });
    $('.time-picker').timepicker();
});
</script>

@stop
