@extends('layouts.main-layout')

@section('stylesheets')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/select2/select2.css'); }}" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/ms-Dropdown/css/msdropdown/dd.css'); }}" />
@stop

@section('page_header')
<h1><i class="fa fa-pencil-square"></i> Time Table <small>Timining chart for teachers and classes.</small></h1>
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
<!-- start: PAGE CONTENT -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading">
                <h4 class="panel-title">Session: <span class="text-bold">2015 - 2016</span></h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                        <a class="btn btn-green show-sv" href="#subview-add-streams" data-startFrom="right">
                            Add New Streams <i class="fa fa-plus"></i>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a class="btn btn-green show-sv" href="#subview-add-classes" data-startFrom="right">
                            Add New Classes <i class="fa fa-chevron-right"></i>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a class="btn btn-green show-sv" href="#subview-add-sections" data-startFrom="right">
                            Add New Sections <i class="fa fa-chevron-right"></i>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a class="btn btn-green show-sv" href="#subview-add-subjects" data-startFrom="top">
                            Add New Subjects <i class="fa fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- start: EXPORT DATA TABLE PANEL  -->
        <div class="panel panel-white">
            <div class="panel-heading">
                <h4 class="panel-title">Export <span class="text-bold">Data</span> Table</h4>
            </div>
            <div class="panel-body">
            </div>
        </div>
        <!-- end: EXPORT DATA TABLE PANEL -->
    </div>
</div>
<!-- end: PAGE CONTENT-->
@stop

@section('subview')
<!--Start :  Subview for This page only -->
<div id="subview-add-classes" class="no-display">
    <div class="col-md-8 col-md-offset-2">
        <div class="row">
            <div class="col-md-12">
                <!-- start: DYNAMIC TABLE PANEL -->
                <div class="panel panel-white panel-add-classes">
                    <div class="panel-heading">
                        <h3>Classes Present Now</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 space20">
                                <button class="btn btn-green add-row-classes">
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
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="table-add-classes">
                                <thead>
                                    <tr>
                                        <th>Class Name</th>
                                        <th>Stream</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($classes as $class)
                                    <tr id="{{ $class->id }}">
                                        <td>{{ $class->class }}</td>
                                        <td id="{{ $class->streams_id }}">{{ Streams::find($class->streams_id)->stream_name }}</td>
                                        <td>
                                            <a href="#" class="edit-row-classes">
                                                Edit
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#" class="delete-row-classes">
                                                Delete
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
    </div>
</div>
<div id="subview-add-streams" class="no-display">
    <div class="col-md-8 col-md-offset-2">
        <div class="row">
            <div class="col-md-12">
                <!-- start: DYNAMIC TABLE PANEL -->
                <div class="panel panel-white panel-add-streams">
                    <div class="panel-heading">
                        <h3>Streams Present Now</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 space20">
                                <button class="btn btn-green add-row-streams">
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
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="table-add-streams">
                                <thead>
                                    <tr>
                                        <th>Stream Name</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($streams as $stream)
                                    <tr id="{{ $stream->id }}">
                                        <td>{{ $stream->stream_name }}</td>
                                        <td>
                                            <a href="#" class="edit-row-streams">
                                                Edit
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#" class="delete-row-streams">
                                                Delete
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
    </div>
</div>
<div id="subview-add-sections" class="no-display">
    <div class="col-md-8 col-md-offset-2">
        <div class="row">
            <div class="col-md-12">
                <!-- start: DYNAMIC TABLE PANEL -->
                <div class="panel panel-white panel-add-classes">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-8">
                                <h3>Select a Class ...</h3>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>
                                    </label>
                                    <select id="form-field-select-classes" class="form-control">
                                        <option value="">Select a Class...</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 space20">
                                <button class="btn btn-green add-row-sections no-display" id="add-section-button">
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
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="table-add-sections">
                                <thead>
                                    <tr>
                                        <th>Section Name</th>
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
<div id="subview-add-subjects" class="no-display">
    <div class="col-md-8 col-md-offset-2">
        <div class="row">
            <div class="col-md-12">
                <!-- start: DYNAMIC TABLE PANEL -->
                <div class="panel panel-white panel-add-subjects">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Select a Class ...</h3>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>
                                    </label>
                                    <select id="form-field-select-subjects-classes" class="form-control">
                                        <option value="">Select a Class...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>
                                    </label>
                                    <select id="form-field-select-subjects-sections" class="form-control">
                                        <option value="">Select a section...</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 space20">
                                <button class="btn btn-green add-row-subjects no-display" id="add-subjects-button">
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
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="table-add-subjects">
                                <thead>
                                    <tr>
                                        <th>Subject Name</th>
                                        <th>Subject Code</th>
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
<!--End :  Subview for This page only -->
@stop

@section('scripts')
<!-- Scripts for This page only -->
<script src="{{ URL::asset('assets/plugins/ms-Dropdown/js/msdropdown/jquery.dd.min.js'); }}"></script>
<script src="{{ URL::asset('assets/plugins/select2/select2.min.js'); }}"></script>  
<script src="{{ URL::asset('assets/js/ui-subview.js'); }}"></script>                                                                  <!-- For Subview -->
<script src="{{ URL::asset('assets/js/modifiedJs/admin/timetable/table-data-streams.js'); }}"></script>                               <!-- For streams Table -->
<script src="{{ URL::asset('assets/js/modifiedJs/admin/timetable/table-data-classes.js'); }}"></script>                               <!-- For classes Table -->
<script src="{{ URL::asset('assets/js/modifiedJs/admin/timetable/table-data-sections.js'); }}"></script>                              <!-- For sections Table -->
<script src="{{ URL::asset('assets/js/modifiedJs/admin/timetable/table-data-subjects.js'); }}"></script>                              <!-- For subjects Table -->
<script>
jQuery(document).ready(function() {
    Main.init();
    SVExamples.init();
    UISubview.init();
    TableDataStreams.init();
    TableDataClasses.init();
    TableDataSections.init();
    TableDataSubjects.init();
});
</script>
@stop