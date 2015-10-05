@extends('layouts.main-layout')

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/select2/select2.css') }}"/>
    <link rel="stylesheet" type="text/css"
          href="{{ URL::asset('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}"/>
@stop
@section('page_header')
    <h1><i class="fa fa-pencil-square"></i> Periods</h1>
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
        <div class="col-sm-12">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h4><i class="fa fa-calendar"></i> Period Profiles</h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 space20">
                            <a href="#" class="btn btn-green add-new-profile-row">
                                Add New <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-stripped table-hover" id="table-periods-profile">
                            <thead>
                            <tr>
                                <td>Profile Name</td>
                                <td>Make Current</td>
                                <td>Edit</td>
                                <td>Details</td>
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
    <div id="subview-periods" class="no-display">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-white panel-add-streams">
                <div class="panel-heading">
                    <h4><i class="fa fa-calendar"></i><span id="period-profile-name" data-profile-period-id=""> </span></h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6 space20">
                            <button class="btn btn-green add-row-periods">
                                Add New <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="errorHandler alert alert-danger no-display">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="table-periods">
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
    <script src="{{ URL::asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('school/admin/school-settings/table-data-periods-profiles.js') }}"></script>

    <script>
        jQuery(document).ready(function () {
            Main.init();
            SVExamples.init();
            TableDataPeriodsAndProfiles.init();
        });
    </script>

@stop
