@extends('layouts.main-layout')

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
            <button data-dismiss="alert" class="close">×</button>
        </div>
        @endif 
        @if ($errors->has())
        <div class="errorHandler alert alert-danger">
            @foreach ($errors->all() as $error)
            {{ $error }}<br>        
            @endforeach
            <button data-dismiss="alert" class="close">×</button>
        </div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <!-- start: FULL CALENDAR PANEL -->
        <div class="panel panel-white">
            <div class="panel-heading">
                <h4 class="panel-title"><span class="text-bold">Monday </span>Schedule</h4>
            </div>
            <div class="panel-body panel-scroll height-250 ps-container">
                <table class="table table-striped table-hover" id="table-daily-schedule">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Timings</th>
                            <th>Subject</th>
                            <th>Teacher Name</th>
                            <th class="center">Teacher Pic</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> 1 </td>
                            <td> 9:00 AM - 10:00 PM </td>
                            <td> Hindi </td>
                            <td>Peter Clark</td>
                            <td class="center"><img src="{{ URL::asset('assets/images/avatar-1.jpg'); }}" alt="image"/></td>
                        </tr>
                        <tr>
                            <td> 1 </td>
                            <td> 9:00 AM - 10:00 PM </td>
                            <td> Hindi </td>
                            <td>Peter Clark</td>
                            <td class="center"><img src="{{ URL::asset('assets/images/avatar-1.jpg'); }}" alt="image"/></td>
                        </tr>
                        <tr>
                            <td> 1 </td>
                            <td> 9:00 AM - 10:00 PM </td>
                            <td> Hindi </td>
                            <td>Peter Clark</td>
                            <td class="center"><img src="{{ URL::asset('assets/images/avatar-1.jpg'); }}" alt="image"/></td>
                        </tr>
                        <tr>
                            <td> 1 </td>
                            <td> 9:00 AM - 10:00 PM </td>
                            <td> Hindi </td>
                            <td>Peter Clark</td>
                            <td class="center"><img src="{{ URL::asset('assets/images/avatar-1.jpg'); }}" alt="image"/></td>
                        </tr>
                        <tr>
                            <td> 1 </td>
                            <td> 9:00 AM - 10:00 PM </td>
                            <td> Hindi </td>
                            <td>Peter Clark</td>
                            <td class="center"><img src="{{ URL::asset('assets/images/avatar-1.jpg'); }}" alt="image"/></td>
                        </tr>
                        <tr>
                            <td> 1 </td>
                            <td> 9:00 AM - 10:00 PM </td>
                            <td> Hindi </td>
                            <td>Peter Clark</td>
                            <td class="center"><img src="{{ URL::asset('assets/images/avatar-1.jpg'); }}" alt="image"/></td>
                        </tr>
                        <tr>
                            <td> 1 </td>
                            <td> 9:00 AM - 10:00 PM </td>
                            <td> Hindi </td>
                            <td>Peter Clark</td>
                            <td class="center"><img src="{{ URL::asset('assets/images/avatar-1.jpg'); }}" alt="image"/></td>
                        </tr>
                        <tr>
                            <td> 1 </td>
                            <td> 9:00 AM - 10:00 PM </td>
                            <td> Hindi </td>
                            <td>Peter Clark</td>
                            <td class="center"><img src="{{ URL::asset('assets/images/avatar-1.jpg'); }}" alt="image"/></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end: FULL CALENDAR PANEL -->
    </div>
    <div class="col-sm-6">
        <div class="well">
            <form class="form-horizontal " role="form">
                <div class="form-group" style="padding:5px;">
                    <textarea class="form-control" placeholder="Update your status"></textarea>
                </div>
                <button class="btn btn-primary pull-right" type="button">Update</button>
                <ul class="list-inline">
                    <li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li>
                    <li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li>
                    <li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li>
                </ul>
            </form>
        </div>
    </div>
    <div class="col-sm-6">
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
            <div class="panel-body panel-scroll ps-container height-300">
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
                    <li>
                        <a class="activity" href="javascript:void(0)">
                            <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-green"></i> <i class="fa fa-file-image-o fa-stack-1x fa-inverse"></i> </span> <span class="desc">Peter Clark uploaded a new image.</span>
                            <div class="time">
                                <i class="fa fa-clock-o"></i>
                                12 hours ago
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
                <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px; width: 672px; display: none;"><div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px; height: 370px; display: inherit;"><div class="ps-scrollbar-y" style="top: 0px; height: 220px;"></div></div></div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script src="{{ URL::asset('assets/js/modifiedJs/user/home.js'); }}"></script>
<!-- Scripts for This page only -->
<script>
    jQuery(document).ready(function() {
        Main.init();
        SVExamples.init();
        Home.init();
    });
</script>

@stop
