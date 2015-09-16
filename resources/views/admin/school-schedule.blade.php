@extends('layouts.main-layout')

@section('page_header')
    <h1><i class="fa fa-clock-o"></i> Schedule Profiles</h1>
@stop

@section('stylesheets')
    <link rel="stylesheet"
          href="{{ URL::asset('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
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
            School Schedule Profiles
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
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 space20">
                            <a href="#subview-add-new-schedule-profile"
                               class="btn btn-green add-new-profile-row show-sv">
                                Add New <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="table-schedule-profiles">
                            <thead>
                            <tr>
                                <th>Profile Name</th>
                                <th>Current Profile</th>
                                <th>Schedules</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($schedule_profiles as $schedule_profile)
                                <tr data-profile-id="{{ $schedule_profile->id }}">
                                    <td>
                                        {{ $schedule_profile->profile_name }}
                                    </td>
                                    <td>
                                        <input type="radio" name="schedule_profile_make_current" {{ $schedule_profile->current_profile ? 'checked' : '' }}
                                               class="flat-grey" id="schedule_profile_make_current">
                                    </td>
                                    <td>
                                        <a href="#subview-add-new-schedule" class="show-schedules-row">
                                            Schedules
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
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
                            <h3 class="text-center"><strong>New Profile</strong></h3>
                        </div>
                        <div class="panel-body">
                            <form role="form" class="form-horizontal">
                                <div class="form-group  has-success">
                                    <label class="col-sm-2 control-label" for="profile-name">
                                        Name of the Profile
                                    </label>
                                    <div class="col-sm-7">
                                        <input type="text" name="profile_name" placeholder="Profile Name"
                                               id="profile-name"
                                               class="form-control">
                                    </div>
                                    <div class="col-sm-3">
                                        <button class="btn btn-info create-new-profile" id="create-new-profile">Submit</button>
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
    <div id="subview-add-new-schedule" class="no-display subview-add-new-schedule">
        <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="col-md-12">
                    <!-- start: DYNAMIC TABLE PANEL -->
                    <div class="panel panel-white panel-add-subjects">
                        <div class="panel-heading">
                            <h3 class="text-center" id="schedule-profile-name" data-schedule-profile-id=""></h3>
                        </div>
                        <div class="panel-body" id="schedule-tables">
                        </div>
                        <div class="panel-footer">
                            <button class="btn btn-success" id="add-new-schedule-to-profile">Add New Schedule</button>
                            <button class="btn btn-warning" id="delete-schedule-profile">Delete This Profile</button>
                        </div>
                    </div>
                    <!-- End: DYNAMIC TABLE PANEL -->
                </div>
            </div>
        </div>
    </div>
    <div id="subview-add-edit-schedule-timing" class="no-display">
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
                                <input type="hidden" value="" id="profile-schedule-id">
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

            <!-- Scripts for This page only -->
    <script src="{{ URL::asset('assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/x-editable/js/bootstrap-editable.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ URL::asset('school/admin/school-settings/table-data-school-schedules.js') }}"></script>
    <script>
        jQuery(document).ready(function () {
            Main.init();
            SVExamples.init();
            TableDataSchoolScheduleNew.init();
            $('.date-picker').datepicker({
                autoclose: true
            });
            $(".time-picker").on("focus", function () {
                return $(this).timepicker("showWidget");
            });
        });
    </script>

@stop
