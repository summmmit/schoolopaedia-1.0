@extends('layouts.main-layout')

@section('stylesheets')
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/dropzone/downloads/css/dropzone.css'); }}">
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
    <div class="col-sm-6 col-lg-8">
        <!-- start: CONDENSED TABLE PANEL -->
        <div class="panel panel-white">
            <div class="panel-heading">
                <h4 class="panel-title">Assignments <span class="text-bold">table</span></h4>
            </div>
            <div class="panel-body">
                <table class="table table-condensed table-hover" id="sample-table-3">
                    <thead>
                        <tr>
                            <th class="center">#</th>
                            <th>Assignment Name</th>
                            <th class="hidden-xs">Subject</th>
                            <th><i class="fa fa-time"></i> Due Date </th>
                            <th class="hidden-xs">Status</th>
                            <th>Upload</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="center hidden-xs">
                                <div class="checkbox-table">
                                    <label>
                                        <input type="checkbox" class="flat-grey foocheck">
                                    </label>
                                </div></td>
                            <td>
                                <a href="#">
                                    alpha.com
                                </a>
                            </td>
                            <td>3,330</td>
                            <td>13/February</td>
                            <td class="hidden-xs"><span class="label label-sm label-warning">Expiring</span></td>
                            <td>
                                <a href="#upload-assignment" class="show-sv" data-startFrom="right">
                                    Upload
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="center hidden-xs">
                                <div class="checkbox-table">
                                    <label>
                                        <input type="checkbox" class="flat-grey foocheck">
                                    </label>
                                </div></td>
                            <td>
                                <a href="#">
                                    beta.com
                                </a></td>
                            <td class="hidden-xs">3,330</td>
                            <td>Jen 15</td>
                            <td class="hidden-xs"><span class="label label-sm label-success">Active</span></td>
                            <td>
                                <a href="#upload-assignment" class="show-sv" data-startFrom="right">
                                    Upload
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="center hidden-xs">
                                <div class="checkbox-table">
                                    <label>
                                        <input type="checkbox" class="flat-grey foocheck">
                                    </label>
                                </div></td>
                            <td>
                                <a href="#">
                                    gamma.com
                                </a></td>
                            <td class="hidden-xs">3,330</td>
                            <td>Mar 09</td>
                            <td class="hidden-xs"><span class="label label-sm label-danger">Expired</span></td>
                            <td>
                                <a href="#upload-assignment" class="show-sv" data-startFrom="right">
                                    Upload
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="center hidden-xs">
                                <div class="checkbox-table">
                                    <label>
                                        <input type="checkbox" class="flat-grey foocheck">
                                    </label>
                                </div></td>
                            <td>
                                <a href="#">
                                    delta.com
                                </a></td>
                            <td class="hidden-xs">3,330</td>
                            <td>Feb 10</td>
                            <td class="hidden-xs"><span class="label label-sm label-inverse">Flagged</span></td>
                            <td>
                                <a href="#upload-assignment" class="show-sv" data-startFrom="right">
                                    Upload
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="center hidden-xs">
                                <div class="checkbox-table">
                                    <label>
                                        <input type="checkbox" class="flat-grey foocheck">
                                    </label>
                                </div></td>
                            <td>
                                <a href="#">
                                    epsilon.com
                                </a></td>
                            <td class="hidden-xs">3,330</td>
                            <td>Feb 18</td>
                            <td class="hidden-xs"><span class="label label-sm label-success">Active</span></td>
                            <td>
                                <a href="#upload-assignment" class="show-sv" data-startFrom="right">
                                    Upload
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="center hidden-xs">
                                <div class="checkbox-table">
                                    <label>
                                        <input type="checkbox" class="flat-grey foocheck">
                                    </label>
                                </div></td>
                            <td>
                                <a href="#">
                                    zeta.com
                                </a></td>
                            <td class="hidden-xs">3,330</td>
                            <td>Feb 13</td>
                            <td class="hidden-xs"><span class="label label-sm label-warning">Expiring</span></td>
                            <td>
                                <a href="#upload-assignment" class="show-sv" data-startFrom="right">
                                    Upload
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="center hidden-xs">
                                <div class="checkbox-table">
                                    <label>
                                        <input type="checkbox" class="flat-grey foocheck">
                                    </label>
                                </div></td>
                            <td>
                                <a href="#">
                                    eta.com
                                </a></td>
                            <td class="hidden-xs">3,330</td>
                            <td>Jen 15</td>
                            <td class="hidden-xs"><span class="label label-sm label-success">Active</span></td>
                            <td>
                                <a href="#">
                                    Upload
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="center hidden-xs">
                                <div class="checkbox-table">
                                    <label>
                                        <input type="checkbox" class="flat-grey foocheck">
                                    </label>
                                </div></td>
                            <td>
                                <a href="#">
                                    theta.com
                                </a></td>
                            <td class="hidden-xs">3,330</td>
                            <td>Mar 09</td>
                            <td class="hidden-xs"><span class="label label-sm label-danger">Expired</span></td>
                            <td>
                                <a href="#">
                                    Upload
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="center hidden-xs">
                                <div class="checkbox-table">
                                    <label>
                                        <input type="checkbox" class="flat-grey foocheck">
                                    </label>
                                </div></td>
                            <td>
                                <a href="#">
                                    iota.com
                                </a></td>
                            <td class="hidden-xs">3,330</td>
                            <td>Feb 10</td>
                            <td class="hidden-xs"><span class="label label-sm label-inverse">Flagged</span></td>
                            <td>
                                <a href="#">
                                    Upload
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="center hidden-xs">
                                <div class="checkbox-table">
                                    <label>
                                        <input type="checkbox" class="flat-grey foocheck">
                                    </label>
                                </div></td>
                            <td>
                                <a href="#">
                                    kappa.com
                                </a></td>
                            <td class="hidden-xs">3,330</td>
                            <td>Feb 18</td>
                            <td class="hidden-xs"><span class="label label-sm label-success">Active</span></td>
                            <td>
                                <a href="#">
                                    Upload
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end: CONDENSED TABLE PANEL -->
    </div>
    <div class="col-sm-2">
        <div class="panel">
            <div class="panel-body">
                <button class="btn btn-icon btn-block">
                    <h3 class="no-margin">6</h3> Unfinished Assignments
                </button>
            </div>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="panel">
            <div class="panel-body">
                <button class="btn btn-icon btn-block">
                    <h3 class="no-margin">6</h3> Expired Assignments
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-7 col-lg-4">
        <div class="panel panel-dark">
            <div class="panel-body no-padding">
                <div class="partition-green padding-15 text-center">
                    <h4 class="no-margin">Monthly Statistics</h4>
                    <span class="text-light">Your Assignments Result and Details</span>
                </div>
                <div id="accordion" class="panel-group accordion accordion-white no-margin">
                    <div class="panel no-radius">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="#collapseOne" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle padding-15 collapsed">
                                    <i class="icon-arrow"></i>
                                    This Month <span class="label label-danger pull-right">3</span>
                                </a></h4>
                        </div>
                        <div class="panel-collapse collapse" id="collapseOne" style="height: 0px;">
                            <div class="panel-body no-padding partition-light-grey">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="center">1</td>
                                            <td>Google Chrome</td>
                                            <td class="center">49/50</td>
                                            <td><i class="fa fa-caret-down text-red"></i></td>
                                        </tr>
                                        <tr>
                                            <td class="center">2</td>
                                            <td>Mozilla Firefox</td>
                                            <td class="center">3857</td>
                                            <td><i class="fa fa-caret-up text-green"></i></td>
                                        </tr>
                                        <tr>
                                            <td class="center">3</td>
                                            <td>Safari</td>
                                            <td class="center">1789</td>
                                            <td><i class="fa fa-caret-up text-green"></i></td>
                                        </tr>
                                        <tr>
                                            <td class="center">4</td>
                                            <td>Internet Explorer</td>
                                            <td class="center">612</td>
                                            <td><i class="fa fa-caret-down text-red"></i></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel no-radius">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="#collapseTwo" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle padding-15 collapsed">
                                    <i class="icon-arrow"></i>
                                    Last Month
                                </a></h4>
                        </div>
                        <div class="panel-collapse collapse" id="collapseTwo" style="height: 0px;">
                            <div class="panel-body no-padding partition-light-grey">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="center">1</td>
                                            <td>Google Chrome</td>
                                            <td class="center">5228</td>
                                            <td><i class="fa fa-caret-up text-green"></i></td>
                                        </tr>
                                        <tr>
                                            <td class="center">2</td>
                                            <td>Mozilla Firefox</td>
                                            <td class="center">2853</td>
                                            <td><i class="fa fa-caret-up text-green"></i></td>
                                        </tr>
                                        <tr>
                                            <td class="center">3</td>
                                            <td>Safari</td>
                                            <td class="center">1948</td>
                                            <td><i class="fa fa-caret-up text-green"></i></td>
                                        </tr>
                                        <tr>
                                            <td class="center">4</td>
                                            <td>Internet Explorer</td>
                                            <td class="center">456</td>
                                            <td><i class="fa fa-caret-down text-red"></i></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel no-radius">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="#collapseThree" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle padding-15 collapsed">
                                    <i class="icon-arrow"></i>
                                    Two Months Ago
                                </a></h4>
                        </div>
                        <div class="panel-collapse collapse" id="collapseThree">
                            <div class="panel-body no-padding partition-light-grey">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="center">1</td>
                                            <td>Google Chrome</td>
                                            <td class="center">4256</td>
                                            <td><i class="fa fa-caret-down text-red"></i></td>
                                        </tr>
                                        <tr>
                                            <td class="center">2</td>
                                            <td>Mozilla Firefox</td>
                                            <td class="center">3557</td>
                                            <td><i class="fa fa-caret-up text-green"></i></td>
                                        </tr>
                                        <tr>
                                            <td class="center">3</td>
                                            <td>Safari</td>
                                            <td class="center">1435</td>
                                            <td><i class="fa fa-caret-up text-green"></i></td>
                                        </tr>
                                        <tr>
                                            <td class="center">4</td>
                                            <td>Internet Explorer</td>
                                            <td class="center">423</td>
                                            <td><i class="fa fa-caret-down text-red"></i></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('subview')
<!-- *** NEW EVENT *** -->
<div id="upload-assignment" class="no-display">
    <div class="noteWrap col-md-8 col-md-offset-2">
        <h2 class="event-title">Upload Your Assignment</h2>
        <hr>
        <div class="row">
            <div class="col-sm-9">
                <!-- start: DROPZONE PANEL -->
                <div class="panel panel-white">
                    <div class="panel-body">
                        <div class="alert alert-warning">
                           Drop Your File Here Or click below to Choose.
                        </div>
                        <form action="/file-upload" class="dropzone dz-clickable" id="my-awesome-dropzone"><div class="dz-default dz-message"><span>Drop Assignment here to upload</span></div></form>
                    </div>
                </div>
                <!-- end: DROPZONE PANEL -->
            </div>
            <div class="col-sm-3">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <td class="center">Assignment Details</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>Name</td><td>Chapter-3</td></tr>
                        <tr><td>Subject</td><td>Science</td></tr>
                        <tr><td>Start Date</td><td>12/Feb/2015</td></tr>
                        <tr><td>End Date</td><td>15/Feb/2015</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2 pull-right">
                <p><a href="#" class="btn btn-block btn-azure">Close</a></p>
            </div>
        </div>
    </div>
</div>
@stop
@section('scripts')
<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script src="{{ URL::asset('assets/plugins/dropzone/downloads/dropzone.min.js'); }}"></script>
<script src="{{ URL::asset('assets/js/form-dropzone.js'); }}"></script>
<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<!-- Scripts for This page only -->
<script>
    jQuery(document).ready(function() {
        Main.init();
        SVExamples.init();
    });
</script>

@stop
