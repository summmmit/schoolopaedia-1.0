@extends('layouts.main-layout')

@section('stylesheets')

<link rel="stylesheet" href="{{ URL::asset('assets/plugins/ladda-bootstrap/dist/ladda.min.css'); }}">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/ladda-bootstrap/dist/ladda-themeless.min.css'); }}">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/bootstrap-social-buttons/bootstrap-social.css'); }}">
<style>

</style>
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
    <div class="col-md-6 col-lg-3 col-sm-6">
        <div class="panel panel-default panel-white core-box">
            <div class="panel-body no-padding">
                <div class="padding-20 text-center core-icon">
                     <img class="img-thumbnail" src="{{ URL::asset('assets/projects/images/rotating_card_profile2.png'); }}" style="width: 90px;height:90px;">
                </div>
                <div class="padding-20 core-content">
                    <h4 class="title block no-margin text-right">Hardik Sondagar</h4>
                    <h5 class="text-right">( 20098087 )</h5>
                </div>
            </div>
            <div class="panel-footer clearfix no-padding">
                <div class=""></div>
                <div class="col-xs-4 padding-10 text-center text-white">                    
                    <label class="checkbox-inline">
                        <input type="checkbox" class="red" value="" checked="checked">
                        Absent
                    </label>
                </div>
                <div class="col-xs-4 padding-10 text-center text-white">  
                    <label class="checkbox-inline">
                        <input type="checkbox" class="green" value="" checked="checked">
                        Present
                    </label>
                </div>
                <div class="col-xs-4 padding-10 text-center text-white">  
                    <label class="checkbox-inline">
                        <input type="checkbox" class="teal" value="" checked="checked">
                        Leave
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
    @stop

    @section('scripts')
    <script src="{{ URL::asset('assets/plugins/ladda-bootstrap/dist/ladda.min.js'); }}"></script>
    <script src="{{ URL::asset('assets/plugins/ladda-bootstrap/dist/spin.min.js'); }}"></script>
    <script src="{{ URL::asset('assets/js/ui-buttons.js'); }}"></script>
    <!-- Scripts for This page only -->
    <script>
jQuery(document).ready(function() {
    Main.init();
    SVExamples.init();
    UIButtons.init();
});
    </script>

    @stop
