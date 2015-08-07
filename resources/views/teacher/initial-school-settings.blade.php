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
    <div class="col-md-12"><!-- Some Message to be Displayed start-->
        @if(Session::has('global'))
        <div class="alert alert-info">
            <i class="fa fa-remove-sign"></i>{{ Session::get('global') }}
        </div>
        @endif 
        @if ($errors->has())
        <div class="errorHandler alert alert-danger">
            @foreach ($errors->all() as $error)
            {{ $error }}<br>        
            @endforeach
        </div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-white">
            <div class="panel-heading">
                <h4 class="panel-title">Set <span class="text-bold">Current Session</span></h4>
            </div>
            <div class="panel-body">
                <form action="{{ URL::route('teacher-school-set-sessions-post'); }}" method="post">
                    <div class="row">
                        <div class="col-md-offset-4 col-md-4">
                            <div class="form-group">
                                <label for="">
                                    Choose Your Session To register For
                                </label>
                                <select id="form-field-select-session" class="form-control" name="session_id">
                                    <option value="">Select Current Session....</option>                                    
                                    <option value="{{ $session->id }}">{{ date_format(date_create($session->session_start), "F/Y") }} -- {{ date_format(date_create($session->session_end), "F/Y") }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-6 col-md-2" id="form-button-submit">
                            <button class="btn btn-green btn-block" type="submit">
                                Register <i class="fa fa-arrow-circle-right"></i>
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
<script>
jQuery(document).ready(function() {
    Main.init();
    SVExamples.init();

});
</script>

@stop
