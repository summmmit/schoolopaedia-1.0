@extends('layouts.main-layout')

@section('page_header')
<h1><i class="fa fa-home"></i> Home</h1>
@stop

@section('stylesheets')
<style>
    .sales {
        width: 23.5%;
        margin-right: 2%;
        background: #16a085;
        padding: 1.8em 1.5em;
        float: left;
        cursor: pointer;
    }
    .sales, .orders {
        padding: 1em 0.5em 0.7em 3.5em;
        width: 100%;
        margin-top: 2%;
    }
    .visitors h3,.sales h3,.new-users h3,.orders h3 {
        color:#fff;
        text-align:center;
        font-size:2.6em;
        font-weight:500;
        letter-spacing:1px;
    }
    .visitors p,.sales p,.new-users p,.orders p {
        float:left;
        color:#fff;
        font-size:1.3em;
        font-weight:300;
    }
    .visitors a,.sales a,.users a {
        float:right;
    }
    .total-sales {
        margin: 3em 0;
    }
    .sales,.new-users,.orders {
        padding: 1.8em 1.2em;
    }
    .visitors p, .sales p, .new-users p, .orders p {
        font-size: 1.1em;
    }
    .visitors h4, .sales h4, .users h4 {
        font-size: 1.4em;
    }
    .visitors h3, .sales h3, .users h3 {
        font-size: 2.75em;
    }
    .visitors p, .sales p, .new-users p, .orders p {
        font-size: 1.05em;
        margin-top:0;
    }
    .sales, .new-users, .orders {
        padding: 1.5em 1em;
    }
    i.dollar {
        width: 60px;
        height: 60px;
        display: inline-block;
    }
    .icon {
        float: left;
        margin-right: 5%;
    }
</style>
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
            @if(Session::has('global'))
            <div class="errorHandler alert alert-success">
                <i class="fa fa-remove-sign"></i>{{ Session::get('global') }}
            </div>
            @endif
        </div>
        <div class="col-md-6 col-lg-3 col-sm-6">
            <div class="panel panel-default panel-white core-box">
                <div class="panel-body no-padding">
                    <div class="partition-red padding-20 text-center core-icon">
                        <i class="fa fa-users fa-3x icon-big"></i>
                    </div>
                    <div class="padding-20 core-content text-center">
                        <h1 class="block margin-bottom-5" id="total_students">850</h1>
                        <span class="block">Total Students</span>
                    </div>
                </div>
                <div class="panel-footer clearfix no-padding">
                    <div class=""></div>
                    <a href="#" class="col-xs-12 padding-10 text-center text-white tooltips partition-blue" data-toggle="tooltip" data-placement="top" title="" data-original-title="All Students">All Students</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 col-sm-6">
            <div class="panel panel-default panel-white core-box">
                <div class="panel-body no-padding">
                    <div class="partition-green padding-20 text-center core-icon">
                        <i class="fa fa-male fa-3x icon-big"></i>
                    </div>
                    <div class="padding-20 core-content text-center">
                        <h1 class="block margin-bottom-5" id="total_teachers">1150</h1>
                        <span class="block">Total Teachers</span>
                    </div>
                </div>
                <div class="panel-footer clearfix no-padding">
                    <div class=""></div>
                    <a href="#" class="col-xs-12 padding-10 text-center text-white tooltips partition-blue" data-toggle="tooltip" data-placement="top" title="" data-original-title="All Teachers">All Teachers</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 col-sm-6">
            <div class="panel panel-default panel-white core-box">
                <div class="panel-body no-padding">
                    <div class="partition-azure padding-20 text-center core-icon">
                        <i class="fa fa-user-plus fa-3x icon-big"></i>
                    </div>
                    <div class="padding-20 core-content text-center">
                        <h1 class="block margin-bottom-5" id="total_parents">950</h1>
                        <span class="block">Total Parents Registered</span>
                    </div>
                </div>
                <div class="panel-footer clearfix no-padding">
                    <div class=""></div>
                    <a href="#" class="col-xs-12 padding-10 text-center text-white tooltips partition-blue" data-toggle="tooltip" data-placement="top" title="" data-original-title="All Parents">All Parents</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 col-sm-6">
            <div class="panel panel-default panel-white core-box">
                <div class="panel-body no-padding">
                    <div class="partition-blue padding-20 text-center core-icon">
                        <i class="fa fa-money fa-3x icon-big"></i>
                    </div>
                    <div class="padding-20 core-content text-center">
                        <h1 class="block margin-bottom-5" id="total_students"><i class="fa fa-rupee"></i> 5000</h1>
                        <span class="block">Total Fees Collected</span>
                    </div>
                </div>
                <div class="panel-footer clearfix no-padding">
                    <div class=""></div>
                    <a href="#" class="col-xs-12 padding-10 text-center text-white tooltips partition-blue" data-toggle="tooltip" data-placement="top" title="" data-original-title="Total Fees">Total Fees Collected</a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')

<!-- Scripts for This page only -->
<script>
    jQuery(document).ready(function() {
        Main.init();
        SVExamples.init();
    });
</script>

@stop
