@extends('layouts.main-layout')

@section('stylesheets')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/select2/select2.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/ms-Dropdown/css/msdropdown/dd.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/TimePicki-master/css/timepicki.css') }}" />
@stop

@section('page_header')
<h1><i class="fa fa-pencil-square"></i> TimeTable</h1>
@stop

@section('page_breadcrumb')
<ol class="breadcrumb">
    <li>
        <a href="#">
            Dashboard
        </a>
    </li>
    <li class="active">
        Time Table
    </li>
</ol>
@stop

@section('content')
<!-- Start: PAGE CONTENT-->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading">
                <h4 class="panel-title">Export <span class="text-bold">Data</span> Table</h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-offset-3 col-md-6">
                        <div class="form-group">
                            <select id="form-field-select-streams" class="form-control">
                                <option value="">Select a stream...</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-offset-3 col-md-6 no-display" id="select-classes-dropdown">
                        <div class="form-group">
                            <select id="form-field-select-classes" class="form-control">
                                <option value="">Select a Class...</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-offset-3 col-md-6 no-display" id="select-sections-dropdown">
                        <div class="form-group">
                            <select id="form-field-select-sections" class="form-control">
                                <option value="">Select a Section...</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-offset-3 col-md-6 no-display" id="select-days-dropdown">
                        <div class="form-group">
                            <select id="form-field-select-days" class="form-control">
                                <option value="">Select a day...</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 space20">
                        <button class="btn btn-green no-display" id="add-row-time-table">
                            Add New <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="errorHandler alert alert-danger no-display">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive no-display" id="section-time-table">
                            <table class="table table-striped table-hover" id="table-time-table">
                                <thead>
                                    <tr>
                                        <th>Period</th>
                                        <th>Subject Name (Subject Code)</th>
                                        <th>Teacher Name</th>
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
    </div>
</div>
<!-- end: PAGE CONTENT-->
@stop

@section('scripts')
<!-- Scripts for This page only -->
<script src="{{ URL::asset('assets/plugins/select2/select2.min.js') }}"></script>
<script src="{{ URL::asset('school/admin/timetable/table-data-time-table.js') }}"></script>        <!-- For creating Time Table -->
<script src="{{ URL::asset('assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>        <!-- For creating Time Table -->
<script src="{{ URL::asset('assets/plugins/TimePicki-master/js/timepicki.js') }}"></script>        <!-- For TimePicki plugin -->
<script>
jQuery(document).ready(function() {
    Main.init();
    SVExamples.init();
    TableDataTimeTableNew.init();
});
</script>

@stop
