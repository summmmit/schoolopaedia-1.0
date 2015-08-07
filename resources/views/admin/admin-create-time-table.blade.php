@extends('layouts.main-layout')

@section('stylesheets')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/select2/select2.css'); }}" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css'); }}" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/ms-Dropdown/css/msdropdown/dd.css'); }}" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/TimePicki-master/css/timepicki.css'); }}" />
@stop

@section('page_header')
<h1><i class="fa fa-pencil-square"></i>Home</h1>
@stop

@section('page_breadcrumb')
<ol class="breadcrumb">
    <li>
        <a href="#">
            Dashboard
        </a>
    </li>
    <li class="active">
        Home
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
                            <label for="field-select-time-table-class">
                                Select a class
                            </label>
                            <select id="field-select-time-table-class" class="form-control">
                                <option value="">Select a class.....</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row no-display" id="form-select-section-day">
                    <div class="col-md-offset-3 col-md-4">
                        <div class="form-group" id="form-select-section">
                            <label for="field-select-time-table-section">
                                Select a section
                            </label>
                            <select id="field-select-time-table-section" class="form-control">
                                <option value="">Select a section.....</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group" id="form-select-day">
                            <label for="field-select-time-table-day">
                                Select a Day..
                            </label>
                            <select id="field-select-time-table-day" class="form-control">
                                <option value="">Select a Day...</option>
                                
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
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="table-add-class-time-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
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
<script src="{{ URL::asset('assets/plugins/select2/select2.min.js'); }}"></script>
<script src="{{ URL::asset('assets/js/modifiedJs/admin/timetable/table-data-time-table.js'); }}"></script>        <!-- For creating Time Table -->
<script src="{{ URL::asset('assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js'); }}"></script>        <!-- For creating Time Table -->
<script src="{{ URL::asset('assets/plugins/TimePicki-master/js/timepicki.js'); }}"></script>        <!-- For TimePicki plugin -->
<script>
jQuery(document).ready(function() {
    Main.init();
    SVExamples.init();
    TableDataTimeTable.init();
});
</script>

@stop
