@extends('layouts.main-layout')

@section('page_header')
    <h1><i class="fa fa-home"></i> School Sessions</h1>
@stop


@section('stylesheets')
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/datepicker/css/datepicker.css') }}">
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
                            <a href="#subview-add-new-session" class="btn btn-green show-sv">
                                Add New <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="table-school-sessions">
                            <thead>
                            <tr>
                                <th>Session From</th>
                                <th>Session Untill</th>
                                <th>Current Session</th>
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
@stop


@section('subview')
            <!--Start :  Subview for This page only -->
    <div id="subview-add-new-session" class="no-display">
        <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="col-md-12">
                    <!-- start: DYNAMIC TABLE PANEL -->
                    <div class="panel panel-white panel-add-subjects">
                        <div class="panel-heading">
                            <h3 class="text-center"><strong>New Session</strong></h3>
                        </div>
                        <div class="panel-body">
                            <form role="form" class="form-horizontal">
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-8">
                                        <div class="form-group">
                                            <label for="">
                                                Session Start From
                                            </label>
                                            <div class="input-group">
                                                <input type="text" data-date-format="yyyy-mm-dd" data-date-viewmode="years" class="form-control date-picker text-center" name="start_session_from">
                                                <span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-8">
                                        <div class="form-group">
                                            <label for="">
                                                Session Ends Untill
                                            </label>
                                            <div class="input-group">
                                                <input type="text" data-date-format="yyyy-mm-dd" data-date-viewmode="years" class="form-control date-picker text-center" name="end_session_untill">
                                                <span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-6 col-md-4">
                                        <button class="btn btn-green btn-block" id="create-new-session" type="submit">
                                            Update <i class="fa fa-arrow-circle-right"></i>
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
@stop
@section('scripts')
    <script type="text/javascript" src="{{ URL::asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript"
            src="{{ URL::asset('school/admin/school-settings/table-data-school-sessions.js') }}"></script>
    <!-- Scripts for This page only -->
    <script>
        jQuery(document).ready(function () {
            Main.init();
            SVExamples.init();
            TableDataSchoolSessions.init();
            $('.date-picker').datepicker({
                autoclose: true
            });
        });
    </script>

@stop
