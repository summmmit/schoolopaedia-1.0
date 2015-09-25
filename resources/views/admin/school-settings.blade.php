@extends('layouts.main-layout')

@section('page_header')
<h1><i class="fa fa-home"></i> Home</h1>
@stop

@section('stylesheets')
    <style type="text/css">

        .social-cover{
            position:absolute;
            left:0;
            right:0;
            top:0;
            bottom:0
        ;background-color:rgba(0, 0, 0, 0.7);
        }

        .cover-container {
            height:350px;
            background-image:url(http://www.nuevayork.net/fotos/times-square.jpg);
            background-size:cover;
            position:relative;
            background-position:center
        }

        .btn-brightblue.btn-inverse.btn-outlined {
            color: #fff;
            border-color: #fff;
        }

        .border-black75 {
            border-color: #3F3F3B!important;
        }

        .btn-brightblue.btn-outlined {
            color: #003BFF;
            background: 0 0;
        }

        .social-avatar {
            top: 0;
            right: 0;
            bottom: 0;
            width: 300px;
            position: absolute;
            background: -webkit-linear-gradient(top,rgba(0,0,0,.3) 0,rgba(0,0,0,.5) 100%);
            background: linear-gradient(top,rgba(0,0,0,.3) 0,rgba(0,0,0,.5) 100%);
        }

        .img-avatar{
            display:block;
            border-radius:100px;
            border:2px solid #fff;
            margin:auto;
            margin-top:50px;
        }

        .social-desc {
            top: 0;
            left: 0;
            bottom: 0;
            right: 300px;
            position: absolute;
        }

        .social-desc div {
            margin-left: 10%;
            margin-top: 100px;
        }

        .fg-focus-white:focus,
        .fg-hover-white:hover,
        .fg-white,
        .fg-white .tab-container.plain .nav-tabs .b-tab.active a,
        .fg-white .fg-tab-active .tab-container .nav-tabs .b-tab.active a,
        .fg-white .tab-container .nav-tabs .b-tab a {
            color: #fff;
        }
        .fg-white{
            opacity:0.8;
        }


        .btn-orange75.btn-inverse.btn-outlined {
            color: #fff;
            border-color: #fff;
        }

        .btn-orange75.btn-outlined {
            color: #EE682F;
            background: 0 0;
        }

        .btn.btn-rounded {
            line-height: 1;
            border-radius: 100px;
            height: auto!important;
            padding: 15px!important;
        }

        .btn>.rubix-icon {
            line-height: 1;
            font-size: 18px;
        }

        .social-like-count {
            cursor: pointer;
            display: inline-block;
        }

        .social-like-count>span {
            margin-left: 25px;
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
            <div class="cover-container">
                <div class="social-cover"></div>
                <div class="social-avatar" >
                    <img class="img-avatar" src="http://bootdey.com/img/Content/user-453533-fdadfd.png" height="100" width="100">
                    <h4 class="fg-white text-center">Aum Sun Public School</h4>
                    <h5 class="fg-white text-center" style="opacity:0.8;">Muradnagar, GZB</h5>
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
