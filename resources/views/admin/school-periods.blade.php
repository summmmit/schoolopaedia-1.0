@extends('layouts.main-layout')

@section('stylesheets')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/select2/select2.css'); }}" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css'); }}" />
@stop
@section('page_header')
<h1><i class="fa fa-pencil-square"></i>Periods</h1>
@stop

@section('page_breadcrumb')
<ol class="breadcrumb">
    <li>
        <a href="#">
            Dashboard
        </a>
    </li>
    <li class="active">
        School Periods
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
    <div class="col-sm-6">
        <div class="panel panel-white">
            <div class="panel-heading">
                <h4> <i class="fa fa-calendar"></i> Period Profiles</h4>
            </div>
            <div class="panel-body">
                <div class="table-responsive noBorderTop">
                    <table class="table table-bordered table-hover" id="table-periods-profile">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Profile Name</td>
                                <td class="center">Make Current</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($periods_profiles as $periods_profile)
                            <tr data-period-profile-id="{{ $periods_profile->id }}">
                                <td>{{ $i++ }}</td>
                                <td>
                                    <a class="show-sv" href="#subview-add-period-profile" data-startFrom="right" id="period-profile-show-button">
                                        {{ $periods_profile->profile_name }}
                                    </a>
                                </td>
                                <td class="center">
                                    <div class="radio-inline no-padding">
                                        <input type="radio" class="square-red" id="make-current-period-profile" name="make-current-period-profile" {{ ($periods_profile->current_profile == 1) ? 'checked' : '' }}>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <a class="pull-right show-sv" href="#subview-add-new-period-profile" data-startFrom="right" id="add-new-periods-profile-button">
                            Add New Period Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-white panel-add-streams">
            <div class="panel-heading">
                <h4> <i class="fa fa-calendar"></i> Current Schedule</h4>
            </div>
            <div class="panel-body">
                <div class="table-responsive noBorderTop">
                    <table class="table table-striped table-hover">
                        <tbody>
                            @foreach($schedules as $schedule)
                            <tr>
                                <td colspan="2" class="text-center text-box-light">{{ date_format(date_create($schedule->start_from), "F / Y") }} - {{ date_format(date_create($schedule->close_untill), "F / Y") }}</td>
                            </tr>
                            <tr>
                                <td class="column-left">School Opening Time</td>
                                <td class="column-right">
                                    {{ date_format(date_create($schedule->opening_time), "h:i A") }}
                                </td>
                            </tr>
                            <tr>
                                <td class="column-left">Lunch Time</td>
                                <td class="column-right">
                                    {{ date_format(date_create($schedule->lunch_time), "h:i A") }}
                                </td>
                            </tr>
                            <tr>
                                <td class="column-left">School Closing Time</td>
                                <td class="column-right">
                                    {{ date_format(date_create($schedule->closing_time), "h:i A") }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <a href="{{ URL::route('admin-school-settings'); }}" class="pull-right">Other Schedules</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stop

    @section('subview')
    <!--Start :  Subview for This page only -->
    <div id="subview-add-new-period-profile" class="no-display">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-white panel-add-streams">
                <div class="panel-heading">
                    <h4> <i class="fa fa-calendar"></i> Periods Profile</h4>
                </div>
                <div class="panel-body">
                    <div class="row" id="add-new-periods-profile-row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <input type="text" placeholder="Profile Name" id="profile-name" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-6 space20">
                                <button class="btn btn-green" id="add-new-periods-profile-save-button">
                                    Add this Profile <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="subview-add-period-profile" class="no-display">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-white panel-add-streams">
                <div class="panel-heading">
                    <h4> <i class="fa fa-calendar"></i> Periods</h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6 space20">
                            <button class="btn btn-green add-row-periods">
                                Add New <i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <div class="col-sm-6">
                            <h3 class="text-center" id="period-profile-name">  </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="errorHandler alert alert-danger no-display">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="table-school-periods">
                            <thead>
                                <tr>
                                    <th>Period</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
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
    <!--End :  Subview for This page only -->
    @stop
    @section('scripts')
    <!-- Scripts for This page only -->
    <script src="{{ URL::asset('assets/plugins/select2/select2.min.js'); }}"></script>
    <script src="{{ URL::asset('assets/js/required/javascript-variables.js'); }}"></script>
    <script src="{{ URL::asset('assets/js/modifiedJs/admin/school-settings/table-data-periods.js'); }}"></script>
    <script src="{{ URL::asset('assets/js/modifiedJs/admin/validation.js'); }}"></script>
    <script src="{{ URL::asset('assets/plugins/combodate/combodate.js'); }}"></script>        <!-- For creating Time Table -->

    <script>
jQuery(document).ready(function() {
    Main.init();
    SVExamples.init();
    TableDataPeriods.init();
});
    </script>

    @stop
