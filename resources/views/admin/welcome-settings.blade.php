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
<!-- start: PAGE CONTENT -->
<div class="row">
    <div class="col-sm-12">
        <!-- start: FORM WIZARD PANEL -->
        <div class="panel panel-white">
            <div class="panel-heading">
                <h4 class="panel-title">WelCome <span class="text-bold">Wizard</span></h4>
            </div>
            <div class="panel-body">
                <form action="#" role="form" class="smart-wizard form-horizontal" id="form">
                    <div id="wizard" class="swMain">
                        <ul>
                            <li>
                                <a href="#step-1">
                                    <div class="stepNumber">
                                        1
                                    </div>
                                    <span class="stepDesc"> Step 1
                                        <br />
                                        <small>Register Your School</small> </span>
                                </a>
                            </li>
                            <li>
                                <a href="#step-2">
                                    <div class="stepNumber">
                                        2
                                    </div>
                                    <span class="stepDesc"> Step 2
                                        <br />
                                        <small>Brief Details</small> </span>
                                </a>
                            </li>
                            <li>
                                <a href="#step-3">
                                    <div class="stepNumber">
                                        4
                                    </div>
                                    <span class="stepDesc"> Step 4
                                        <br />
                                        <small>Finished</small> </span>
                                </a>
                            </li>
                        </ul>
                        <div class="progress progress-xs transparent-black no-radius active">
                            <div aria-valuemax="100" aria-valuemin="0" role="progressbar" class="progress-bar partition-green step-bar">
                                <span class="sr-only"> 0% Complete (success)</span>
                            </div>
                        </div>
                        <div id="step-1" class="step-1">
                            <h2 class="StepTitle">Register Your School</h2>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">
                                    School Code <span class="symbol required"></span>
                                </label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="registration-code" name="registration_code" placeholder="School Code Here">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">
                                    Admin Code <span class="symbol required"></span>
                                </label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="code-for-admin" name="code_for_admin" placeholder="Admin Code Here">
                                </div>
                            </div>
                            <input type="hidden" id="group-id" name="group_id" value="1">
                            <div class="form-group">
                                <div class="col-sm-2 col-sm-offset-8">
                                    <button class="btn btn-blue next-step btn-block" id="next-step-1">
                                        Next <i class="fa fa-arrow-circle-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div id="step-2">
                            <h2 class="StepTitle">Your Brief Details</h2>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">
                                    First Name <span class="symbol required"></span>
                                </label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="first-name" name="first_name" placeholder="Your First Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">
                                    Last Name <span class="symbol required"></span>
                                </label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="last-name" name="last_name" placeholder="Your Last Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">
                                    Gender <span class="symbol required"></span>
                                </label>
                                <div class="col-sm-7">
                                    <label class="radio-inline">
                                        <input type="radio" class="grey" value="1" name="sex" id="gender_female" >
                                        Female
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" class="grey" value="0" name="sex"  id="gender_male">
                                        Male
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2 col-sm-offset-3">
                                    <button class="btn btn-light-grey back-step btn-block" id="back-step-2">
                                        <i class="fa fa-circle-arrow-left"></i> Back
                                    </button>
                                </div>
                                <div class="col-sm-2 col-sm-offset-3">
                                    <button class="btn btn-blue next-step btn-block" id="next-step-2">
                                        Next <i class="fa fa-arrow-circle-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div id="step-3">
                            <div class="col-sm-4 col-sm-offset-4">
                                <h2 class="StepTitle">Finished Registration</h2>
                                <h3>Thank You, You Have Been Successfully Registered.</h3>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2 col-sm-offset-8">
                                    <a href="{{ URL::route('admin-school-set-sessions'); }}" class="btn btn-success finish-step btn-block">
                                        Finish <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end: FORM WIZARD PANEL -->
    </div>
</div>
<!-- end: PAGE CONTENT-->
@stop

@section('scripts')

<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script src="{{ URL::asset('assets/plugins/jQuery-Smart-Wizard/js/jquery.smartWizard.js'); }}"></script>
<script src="{{ URL::asset('assets/js/modifiedJs/welcome-settings-wizard.js'); }}"></script>
<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script>
    jQuery(document).ready(function() {
        Main.init();
        SVExamples.init();
        WelcomeSettingsWizard.init();
    });
</script>

@stop
