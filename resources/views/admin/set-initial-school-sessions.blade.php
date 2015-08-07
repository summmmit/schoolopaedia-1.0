@extends('layouts.main-layout')

@section('stylesheets')
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/datepicker/css/datepicker.css'); }}">
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
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-white">
            <div class="panel-heading">
                <h4 class="panel-title">Set <span class="text-bold">Current Session</span></h4>
            </div>
            <div class="panel-body">
                <form action="{{ URL::route('admin-school-set-sessions-post'); }}" method="post" id="form">
                    <div class="row">
                        <div class="col-md-offset-4 col-md-4">                                 
                            <!-- Some Message to be Displayed start-->
                            <div class="errorHandler alert alert-danger no-display">
                                <i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-4 col-md-4">
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
                        <div class="col-md-offset-4 col-md-4">
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
                        <div class="col-md-offset-4 col-md-2">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="current_session" class="red" checked="checked">
                                Make it Current Session ?
                            </label>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-green btn-block" type="submit">
                                Update <i class="fa fa-arrow-circle-right"></i>
                            </button>
                        </div>
                    </div>
                    {{ Form::token() }}
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!-- end: PAGE CONTENT-->
@stop

@section('scripts')

<!-- Scripts for This page only -->
<script src="{{ URL::asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'); }}"></script>
<script src="{{ URL::asset('assets/js/modifiedJs/admin/validation.js'); }}"></script>
<script>
jQuery(document).ready(function() {
    Main.init();
    SVExamples.init();
    Validation.init();
    $('.date-picker').datepicker({
        autoclose: true
    });

});
</script>

@stop
