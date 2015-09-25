@extends('layouts.main-layout')

@section('page_header')
<h1><i class="fa fa-home"></i> Home</h1>
@stop

@section('stylesheets')
    <style type="text/css">
        .profile {
            width: 100%;
            position: relative;
            background: #FFF;
            border: 1px solid #D5D5D5;
            padding-bottom: 5px;
            margin-bottom: 0px;
        }

        .profile .image {
            display: block;
            position: relative;
            z-index: 1;
            overflow: hidden;
            text-align: center;
            border: 5px solid #FFF;
        }

        .profile .user {
            position: relative;
            padding: 0px 5px 5px;
        }

        .profile .user .avatar {
            position: absolute;
            left: 20px;
            top: -85px;
            z-index: 2;
        }

        .profile .user h2 {
            font-size: 16px;
            line-height: 20px;
            display: block;
            float: left;
            margin: 4px 0px 0px 135px;
            font-weight: bold;
        }

        .profile .user .actions {
            float: right;
        }

        .profile .user .actions .btn {
            margin-bottom: 0px;
        }

        .profile .info {
            float: left;
            margin-left: 20px;
        }

        .img-profile{
            height:100px;
            width:100px;
        }

        .img-cover{
            width:100%;
            height:300px;
        }

        @media (max-width: 768px) {
            .btn-responsive {
                padding:2px 4px;
                font-size:80%;
                line-height: 1;
                border-radius:3px;
            }
        }

        @media (min-width: 769px) and (max-width: 992px) {
            .btn-responsive {
                padding:4px 9px;
                font-size:90%;
                line-height: 1.2;
            }
        }

        @media (max-width: 769px){

            .img-cover{
                height:200px;
            }
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
    </div>
    <div class="panel">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="profile clearfix">
                        <div class="image">
                            <img src="http://www.nuevayork.net/fotos/times-square.jpg" class="img-cover">
                        </div>
                        <div class="user clearfix">
                            <div class="avatar">
                                <img src="http://bootdey.com/img/Content/user-453533-fdadfd.png" class="img-thumbnail img-profile">
                            </div>
                            <h2>Sumit Singh</h2>
                        </div>
                    </div>
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
