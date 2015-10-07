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
                               class="btn btn-green add-new-profile-row">
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
                                <th>Edit</th>
                                <th>Schedules</th>
                            </tr>
                            </thead>
                            <tbody>
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
    <div id="subview-schedules" class="no-display">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-md-12">
                    <!-- start: DYNAMIC TABLE PANEL -->
                    <div class="panel panel-white panel-add-subjects">
                        <div class="panel-heading">
                            <h3 class="text-center" id="profile-heading" data-profile-schedule-id="">
                                <i class="fa fa-camera"></i><span id="profile-schedule-name"></span>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 space20">
                                    <a href="#"
                                       class="btn btn-green add-new-schedule-row">
                                        Add New <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="table-schedules">
                                    <thead>
                                    <tr>
                                        <th>Start From</th>
                                        <th>End Until</th>
                                        <th>Opening Time</th>
                                        <th>Lunch Time</th>
                                        <th>Closing Time</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <button class="btn btn-warning" id="delete-schedule-profile">Delete This Profile</button>
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
            src="{{ URL::asset('school/admin/school-settings/table-data-schedule-profiles.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/combodate/combodate.js') }}"></script>
    <script>
        jQuery(document).ready(function () {
            Main.init();
            SVExamples.init();
            TableDataScheduleProfiles.init();
            $('.date-picker').datepicker({
                autoclose: true
            });
            $(".time-picker").on("focus", function () {
                return $(this).timepicker("showWidget");
            });
        });
    </script>

@stop
