@extends('layouts.main-layout')

@section('stylesheets')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/modifiedCss/user/classusers.css'); }}" />
<style>
    .new-badge-icon .badge {
        border-radius: 12px 12px 12px 12px !important;
        border-style: solid;
        border-width: 0;
        box-shadow: none;
        color: #FFFFFF !important;
        font-size: 11px !important;
        font-weight: 300;
        padding: 3px 7px;
        position: absolute;
        right: -5px;
        text-shadow: none;
        top: -5px;
    }
</style>
@stop

@section('page_header')
<h1><i class="fa fa-pencil-square"></i> Class Members </h1>
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
<!-- Start: Page Content -->

<div class="row">
    <div class="col-md-4 col-lg-4 col-sm-6">
        <a class="show-sv" href="#user-details">
            <div class="panel panel-default panel-white core-box">
                <div class="panel-body no-padding">
                    <div class="padding-20 text-center core-icon">
                        <img class="img-thumbnail" src="{{ URL::asset('assets/projects/images/rotating_card_profile2.png'); }}" style="width: 90px; height:90px;">
                    </div>
                    <div class="padding-20 core-content new-badge-icon">
                        <h4 class="title block no-margin text-right">Hardik Sondagar</h4>
                        <h5 class="text-right">( 20098087 )</h5>
                        <span class="badge badge-danger"> Happy Birthday </span>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-4 col-lg-4 col-sm-6">
        <a class="show-sv" href="#user-details">
            <div class="panel panel-default panel-white core-box">
                <div class="panel-body no-padding">
                    <div class="padding-20 text-center core-icon">
                        <img class="img-thumbnail" src="{{ URL::asset('assets/projects/images/rotating_card_profile2.png'); }}" style="width: 90px; height:90px;">
                    </div>
                    <div class="padding-20 core-content new-badge-icon">
                        <h4 class="title block no-margin text-right">Hardik Sondagar</h4>
                        <h5 class="text-right">( 20098087 )</h5>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4 col-lg-4 col-sm-6">
        <a class="show-sv" href="#user-details">
            <div class="panel panel-default panel-white core-box">
                <div class="panel-body no-padding">
                    <div class="padding-20 text-center core-icon">
                        <img class="img-thumbnail" src="{{ URL::asset('assets/projects/images/rotating_card_profile2.png'); }}" style="width: 90px; height:90px;">
                    </div>
                    <div class="padding-20 core-content new-badge-icon">
                        <h4 class="title block no-margin text-right">Sumit Singh</h4>
                        <h5 class="text-right">( 20098087 )</h5>
                        <span class="label label-sm label-green pull-right">Monitor</span>
                        <a class="show-sv" href="#user-details">Show Top Subview <i class="fa fa-chevron-up"></i></a>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
<!-- End: Page Content -->
@stop
@section('subview')
<!-- *** NEW EVENT *** -->
<div id="user-details" class="no-display">
    <div class="noteWrap col-md-10 col-lg-8 col-lg-offset-2">
        <div class="row">
            <div class="col-sm-5 col-md-4">
                <div class="user-left">
                    <div class="center">
                        <h4>Peter Clark</h4>
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="user-image">
                                <div class="fileupload-new thumbnail">
                                    <img src="{{ URL::asset('assets/images/avatar-1-xl.jpg'); }}" alt="">
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail"></div>
                                <div class="user-image-buttons">
                                    <span class="btn btn-azure btn-file btn-sm"><span class="fileupload-new"><i class="fa fa-pencil"></i></span><span class="fileupload-exists"><i class="fa fa-pencil"></i></span>
                                        <input type="file">
                                    </span>
                                    <a href="#" class="btn fileupload-exists btn-red btn-sm" data-dismiss="fileupload">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="social-icons block">
                            <ul>
                                <li data-placement="top" data-original-title="Twitter" class="social-twitter tooltips">
                                    <a href="http://www.twitter.com" target="_blank">
                                        Twitter
                                    </a>
                                </li>
                                <li data-placement="top" data-original-title="Facebook" class="social-facebook tooltips">
                                    <a href="http://facebook.com" target="_blank">
                                        Facebook
                                    </a>
                                </li>
                                <li data-placement="top" data-original-title="Google" class="social-google tooltips">
                                    <a href="http://google.com" target="_blank">
                                        Google+
                                    </a>
                                </li>
                                <li data-placement="top" data-original-title="LinkedIn" class="social-linkedin tooltips">
                                    <a href="http://linkedin.com" target="_blank">
                                        LinkedIn
                                    </a>
                                </li>
                                <li data-placement="top" data-original-title="Github" class="social-github tooltips">
                                    <a href="#" target="_blank">
                                        Github
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <hr>
                    </div>
                    <table class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th colspan="3">Contact Information</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>url</td>
                                <td>
                                    <a href="#">
                                        www.example.com
                                    </a></td>
                                <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                            </tr>
                            <tr>
                                <td>email:</td>
                                <td>
                                    <a href="">
                                        peter@example.com
                                    </a></td>
                                <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                            </tr>
                            <tr>
                                <td>phone:</td>
                                <td>(641)-734-4763</td>
                                <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                            </tr>
                            <tr>
                                <td>skye</td>
                                <td>
                                    <a href="">
                                        peterclark82
                                    </a></td>
                                <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th colspan="3">General information</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Position</td>
                                <td>UI Designer</td>
                                <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                            </tr>
                            <tr>
                                <td>Last Logged In</td>
                                <td>56 min</td>
                                <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                            </tr>
                            <tr>
                                <td>Position</td>
                                <td>Senior Marketing Manager</td>
                                <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                            </tr>
                            <tr>
                                <td>Supervisor</td>
                                <td>
                                    <a href="#">
                                        Kenneth Ross
                                    </a></td>
                                <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td><span class="label label-sm label-info">Administrator</span></td>
                                <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th colspan="3">Additional information</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Birth</td>
                                <td>21 October 1982</td>
                                <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                            </tr>
                            <tr>
                                <td>Groups</td>
                                <td>New company web site development, HR Management</td>
                                <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-7 col-md-8">
                <div class="panel panel-white space20">
                    <div class="panel-heading">
                        <i class="clip-menu"></i>
                        Recent Activities
                        <div class="panel-tools">
                            <a class="btn btn-xs btn-link panel-close" href="#">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body panel-scroll height-350 ps-container">
                        <ul class="activities">
                            <li>
                                <a class="activity" href="javascript:void(0)">
                                    <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-blue"></i> <i class="fa fa-code fa-stack-1x fa-inverse"></i> </span> <span class="desc">You uploaded a new release.</span>
                                    <div class="time">
                                        <i class="fa fa-clock-o"></i>
                                        2 hours ago
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="activity" href="javascript:void(0)">
                                    <img alt="image" src="assets/images/avatar-2.jpg"> <span class="desc">Nicole Bell sent you a message.</span>
                                    <div class="time">
                                        <i class="fa fa-clock-o"></i>
                                        3 hours ago
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="activity" href="javascript:void(0)">
                                    <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-orange"></i> <i class="fa fa-database fa-stack-1x fa-inverse"></i> </span> <span class="desc">DataBase Migration.</span>
                                    <div class="time">
                                        <i class="fa fa-clock-o"></i>
                                        5 hours ago
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="activity" href="javascript:void(0)">
                                    <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-orange"></i> <i class="fa fa-database fa-stack-1x fa-inverse"></i> </span> <span class="desc">DataBase Migration.</span>
                                    <div class="time">
                                        <i class="fa fa-clock-o"></i>
                                        5 hours ago
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="activity" href="javascript:void(0)">
                                    <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-orange"></i> <i class="fa fa-database fa-stack-1x fa-inverse"></i> </span> <span class="desc">DataBase Migration.</span>
                                    <div class="time">
                                        <i class="fa fa-clock-o"></i>
                                        5 hours ago
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="activity" href="javascript:void(0)">
                                    <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-orange"></i> <i class="fa fa-database fa-stack-1x fa-inverse"></i> </span> <span class="desc">DataBase Migration.</span>
                                    <div class="time">
                                        <i class="fa fa-clock-o"></i>
                                        5 hours ago
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="activity" href="javascript:void(0)">
                                    <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-orange"></i> <i class="fa fa-database fa-stack-1x fa-inverse"></i> </span> <span class="desc">DataBase Migration.</span>
                                    <div class="time">
                                        <i class="fa fa-clock-o"></i>
                                        5 hours ago
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="activity" href="javascript:void(0)">
                                    <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-orange"></i> <i class="fa fa-database fa-stack-1x fa-inverse"></i> </span> <span class="desc">DataBase Migration.</span>
                                    <div class="time">
                                        <i class="fa fa-clock-o"></i>
                                        5 hours ago
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="activity" href="javascript:void(0)">
                                    <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-yellow"></i> <i class="fa fa-calendar-o fa-stack-1x fa-inverse"></i> </span> <span class="desc">You added a new event to the calendar.</span>
                                    <div class="time">
                                        <i class="fa fa-clock-o"></i>
                                        8 hours ago
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="activity" href="javascript:void(0)">
                                    <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-green"></i> <i class="fa fa-file-image-o fa-stack-1x fa-inverse"></i> </span> <span class="desc">Kenneth Ross uploaded new images.</span>
                                    <div class="time">
                                        <i class="fa fa-clock-o"></i>
                                        9 hours ago
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="activity" href="javascript:void(0)">
                                    <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-green"></i> <i class="fa fa-file-image-o fa-stack-1x fa-inverse"></i> </span> <span class="desc">Peter Clark uploaded a new image.</span>
                                    <div class="time">
                                        <i class="fa fa-clock-o"></i>
                                        12 hours ago
                                    </div>
                                </a>
                            </li>
                        </ul>
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
