@extends('layouts.main-layout')

@section('page_header')
<h1><i class="fa fa-home"></i> School Sessions</h1>
@stop


@section('stylesheets')
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/select2/select2.css') }}">
@stop

@section('page_breadcrumb')
<ol class="breadcrumb">
    <li>
        <a href="#">
            Dashboard
        </a>
    </li>
    <li class="active">
        School Sessions
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
                        <table class="table table-striped table-hover" id="table-school-sessions">
                            <thead>
                            <tr>
                                <th>Session</th>
                                <th>Current Session</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>From (<strong> 2015-May-25 </strong>) : To <strong> 2015-July-26 </strong></td>
                                <td>
                                    <input type="radio" name="schedule_profile_make_current" class="flat-grey" id="schedule_profile_make_current">
                                </td>
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
<script type="text/javascript" src="{{ URL::asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('school/admin/school-settings/table-data-school-sessions.js') }}"></script>
<!-- Scripts for This page only -->
<script>
    jQuery(document).ready(function() {
        Main.init();
        SVExamples.init();
        TableDataSchoolSessions.init();
    });
</script>

@stop
