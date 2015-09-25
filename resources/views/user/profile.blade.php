@extends('layouts.main-layout')

@section('page_header')
    <h1><i class="fa fa-pencil-square"></i> Your Details
        <small>These are the details of you as per our database.</small>
    </h1>
@stop
@section('page_breadcrumb')
    <ol class="breadcrumb">
        <li>
            <a href="#">
                Dashboard
            </a>
        </li>
        <li class="active">
            User Profile
        </li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12"><!-- Some Message to be Displayed start-->
            @if(Session::has('details-changed'))
                <div class="errorHandler alert alert-success">
                    <i class="fa fa-remove-sign"></i>{{ Session::get('details-changed') }}
                </div>
            @elseif(Session::has('details-not-changed'))
                <div class="errorHandler alert alert-danger">
                    <i class="fa fa-remove-sign"></i>{{ Session::get('details-not-changed') }}
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
        <div class="col-md-12">
            <div class="tabbable">
                <ul class="nav nav-tabs tab-padding tab-space-3 tab-blue" id="myTab4">
                    <li class="active">
                        <a data-toggle="tab" href="#panel_overview">
                            Overview
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#panel_edit_account">
                            Edit Account
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#panel_login_details">
                            Login Details
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="panel_overview" class="tab-pane fade in active">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-condensed table-hover" id="table-user-general-information">
                                    <thead>
                                    <tr>
                                        <th colspan="3">General information</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td> Full Name</td>
                                        <td id="full_name"></td>
                                    </tr>
                                    <tr>
                                        <td>User Name</td>
                                        <td><span id="username" class="label label-green label-info"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Date of Birth</td>
                                        <td id="dob"></td>
                                    </tr>
                                    <tr>
                                        <td>Gender</td>
                                        <td id="sex">Male</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <table class="table table-condensed table-hover" id="table-user-contact-information">
                                    <thead>
                                    <tr>
                                        <th colspan="3">Contact information</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td> Email Address</td>
                                        <td id="email"></td>
                                    </tr>
                                    <tr>
                                        <td> Mobile Number</td>
                                        <td id="mobile_number"></td>
                                    </tr>
                                    <tr>
                                        <td> Home Number</td>
                                        <td id="home_number"></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <hr>
                                <div class="center">
                                    <div class="social-icons block" id="social-icons">
                                        <ul>
                                            <li data-placement="left" data-original-title="Twitter"
                                                class="social-twitter tooltips">
                                                <a id="twitter" href="http://www.twitter.com" target="summmmit">
                                                    Twitter
                                                </a>
                                            </li>
                                            <li data-placement="top" data-original-title="Facebook"
                                                class="social-facebook tooltips">
                                                <a id="facebook" href="http://facebook.com" target="_blank">
                                                    Facebook
                                                </a>
                                            </li>
                                            <li data-placement="top" data-original-title="Google"
                                                class="social-google tooltips">
                                                <a id="google" href="http://google.com" target="_blank">
                                                    Google+
                                                </a>
                                            </li>
                                            <li data-placement="right" data-original-title="Skype"
                                                class="social-skype tooltips">
                                                <a id="skype" href="http://skype.com" target="_blank">
                                                    Skype
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="panel_edit_account" class="tab-pane fade">
                        <form action="#" role="form" id="form-edit-user-details" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="user-left">
                                    <div class="col-md-6">
                                        <h3>Account Info</h3>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        First Name
                                                    </label>
                                                    <input type="text" value="" class="form-control" id="first_name"
                                                           name="first_name">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Middle Name <span class="symbol"></span>
                                                    </label>
                                                    <input type="text" value="" class="form-control" id="middle_name"
                                                           name="middle_name">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Last Name <span class="symbol required"></span>
                                                    </label>
                                                    <input type="text" value="" class="form-control" id="last_name"
                                                           name="last_name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group connected-group">
                                                    <label class="control-label">
                                                        Date of Birth <span class="symbol required"></span>
                                                    </label>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <select name="dd" id="dd" class="form-control">
                                                                <option value="">DD</option>
                                                                <option value="01">1</option>
                                                                <option value="02">2</option>
                                                                <option value="03">3</option>
                                                                <option value="04">4</option>
                                                                <!-- Bug here ...........this need to be in blade form -->
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <select name="mm" id="mm" class="form-control">
                                                                <option value="">MM</option>
                                                                <!-- Bug here ...........this need to be in blade form -->
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="text" value="" id="yyyy" name="yyyy"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Gender <span class="symbol required"></span>
                                                    </label>

                                                    <div>
                                                        <label class="radio-inline">
                                                            <input type="radio" class="red" value="1" name="sex" id="female" checked=""> <!-- Bug here -->
                                                            Female
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" class="red" value="0" name="sex" id="male" checked=""> <!-- Bug here -->
                                                            Male
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        <i class="fa fa-skype fa-2x"></i> Skype Id
                                                    </label>
                                                    <input type="text" value="" class="form-control" id="skype"
                                                           name="skype">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        <i class="fa fa-facebook-square fa-2x"></i> Facebook
                                                    </label>
                                                    <input type="text" value="" class="form-control" id="facebook"
                                                           name="facebook">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        <i class="fa fa-google-plus-square fa-2x"></i> Google Plus
                                                    </label>
                                                    <input type="text" value="" class="form-control" id="google"
                                                           name="google">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        <i class="fa fa-twitter-square fa-2x"></i> Twitter
                                                    </label>
                                                    <input type="text" value="" class="form-control" id="twitter"
                                                           name="twitter">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3>Contact Details</h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">
                                                    Mobile Number <span class="symbol required"></span>
                                                </label>
                                                <input type="number" value="" class="form-control" id="mobile_number"
                                                       name="mobile_number">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">
                                                    Home Phone Number
                                                </label>
                                                <input type="number" value="" class="form-control" id="home_number"
                                                       name="home_number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">
                                            Address 1 <span class="symbol required"></span>
                                        </label>
                                        <input class="form-control" type="text" name="add_1" value="" id="add_1">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">
                                            Address 2 <span class="symbol required"></span>
                                        </label>
                                        <input class="form-control" type="text" name="add_2" value="" id="add_2">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">
                                            City
                                        </label>
                                        <input class="form-control tooltips" value="" type="text"
                                               data-original-title="We'll display it when you write reviews"
                                               data-rel="tooltip" title="" data-placement="top" name="city" id="city">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="control-label">
                                                    State <span class="symbol required"></span>
                                                </label>
                                                <select class="form-control" id="state" name="state">
                                                    <option value="">Select...</option>
                                                    <option value="up">Uttar Pradesh</option>
                                                    <option value="dl">Delhi</option>
                                                    <option value="mp">Madhya Pradesh</option>
                                                    <option value="raj">Rajasthan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">
                                                    Pin Code <span class="symbol required"></span>
                                                </label>
                                                <input class="form-control" type="text" name="pin_code" id="pin_code"
                                                       value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">
                                            Country <span class="symbol required"></span>
                                        </label>
                                        <select class="form-control" id="country" name="country">
                                            <option value="">Select...</option>
                                            <option value="IND" selected>India / भारत</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        Required Fields
                                        <hr>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-9">
                                    <p>
                                        Click the Update Button to Update your Details.
                                    </p>
                                </div>
                                <div class="col-sm-3">
                                    <button class="btn btn-green btn-block" type="submit" id="update-user-details">
                                        Update <i class="fa fa-arrow-circle-right"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="panel_login_details" class="tab-pane fade">
                        <div class="row">
                            <div class="user-left">
                                <div class="col-sm-6">
                                    <table class="table table-condensed table-hover">
                                        <thead>
                                        <tr>
                                            <th colspan="3"><h3>Login Details</h3></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="column-left"><i class="fa fa-skype fa-2x"></i> Skype Id</td>
                                            <td class="column-right text-center"><strong>summmmit44</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="column-left"><i class="fa fa-facebook-square fa-2x"></i> Facebook
                                            </td>
                                            <td class="column-right text-center"><a href="">Connect Facebook</a></td>
                                        </tr>
                                        <tr>
                                            <td class="column-left"><i class="fa fa-google-plus-square fa-2x"></i>
                                                Google
                                            </td>
                                            <td class="column-right text-center"><a href="">Connect Facebook</a></td>
                                        </tr>
                                        <tr>
                                            <td class="column-left">Current Email:</td>
                                            <td class="column-right text-center"><strong>summmmit44@gmail.com</strong>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="row" id="update-email-address">
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="email" placeholder="Change Email Address"
                                                   name="email">
                                        </div>
                                        <div class="col-sm-3">
                                            <button class="btn btn-info" id="button-update-email">
                                                Update Email <i class="fa fa-arrow-circle-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <form action="#" role="form" id="form-update-password" method="post">
                                    <h3>Update Details</h3>

                                    <div class="form-group">
                                        <label class="control-label">
                                            Current Password
                                        </label>
                                        <input type="password" placeholder="Old Password" class="form-control"
                                               name="old_password" id="old_password" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">
                                            New Password
                                        </label>
                                        <input type="password" placeholder="password" class="form-control"
                                               name="password" id="password">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">
                                            Confirm Password
                                        </label>
                                        <input type="password" placeholder="Confirm Password" class="form-control"
                                               id="password_again" name="password_again">
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <p>
                                                Click the Update Button to Update your Details.
                                            </p>
                                        </div>
                                        <div class="col-sm-3">
                                            <button class="btn btn-success btn-block" type="submit" id="button-update-password">
                                                Update <i class="fa fa-arrow-circle-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @stop

        @section('scripts')

                <!-- Scripts for This page only -->
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
        <script src="{{ URL::asset('assets/plugins/jquery.pulsate/jquery.pulsate.min.js') }}"></script>
        <script src="{{ URL::asset('assets/js/pages-user-profile.js') }}"></script>
        <script src="{{ URL::asset('assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js') }}"></script>
        <script src="{{ URL::asset('assets/js/modifiedJs/admin/maps.js') }}"></script>
        <script src="{{ URL::asset('school/userProfileSettings.js') }}"></script>
        <script>

            jQuery(document).ready(function () {

                if (location.hash) {
                    $('a[href=' + location.hash + ']').tab('show');
                }
                $(document.body).on("click", "a[data-toggle]", function (event) {
                    location.hash = this.getAttribute("href");
                });

                Main.init();
                SVExamples.init();
                PagesUserProfile.init();
                UserProfileSettings.init();

            });

            $(window).on('popstate', function () {
                var anchor = location.hash || $("a[data-toggle=tab]").first().attr("href");
                $('a[href=' + anchor + ']').tab('show');
            });
        </script>

@stop