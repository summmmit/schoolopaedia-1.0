@extends('layouts.main-layout')

@section('page_header')
<h1><i class="fa fa-pencil-square"></i> Your Details<small>These are the details of you as per our database.</small></h1>
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
                        <div class="col-sm-5">
                            <div class="user-left">
                                <h2><i class="fa fa-users"></i> Overview</h2>
                                <hr>
                                <div class="center">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="user-image">
                                            <div class="fileupload-new thumbnail"><img src="{{ URL::asset('assets/projects/images/profilepics/'.$user_details->pic) }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-condensed table-hover">
                                    <thead>
                                        <tr>
                                            <th colspan="3">General information</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td> Full Name </td>
                                            <td> {{ ucfirst($user_details->first_name) }} {{ ucfirst($user_details->middle_name) }} {{ ucfirst($user_details->last_name) }} </td>
                                            <td><a href="#panel_edit_account" class="show-tab"><i
                                                        class="fa fa-pencil edit-user-info"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>UserName</td>
                                            <td><span class="label label-green label-info">{{ $user_details->username }}</span></td>
                                            <td><a href="#panel_edit_account" class="show-tab"><i
                                                        class="fa fa-pencil edit-user-info"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Date of Birth</td>
                                            <td>{{ $user_details->dob }}</td>
                                            <td><a href="#panel_edit_account" class="show-tab"><i
                                                        class="fa fa-pencil edit-user-info"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Gender</td>
                                            @if($user_details->sex == 0)
                                            <td>Female</td>
                                            @elseif($user_details->sex == 1)                                        
                                            <td>Male</td>
                                            @endif
                                            <td><a href="#panel_edit_account" class="show-tab"><i
                                                        class="fa fa-pencil edit-user-info"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Marriage Status</td>
                                            @if($user_details->marriage_status == 0)
                                            <td><span class="label label-sm label-info">Unmarried</span></td>
                                            @elseif($user_details->marriage_status == 1)      
                                            <td><span class="label label-sm label-info">Married</span></td>
                                            @endif
                                            <td><a href="#panel_edit_account" class="show-tab"><i
                                                        class="fa fa-pencil edit-user-info"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table table-condensed table-hover">
                                    <thead>
                                        <tr>
                                            <th colspan="3">Contact Information</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Email:</td>
                                            <td>{{ $user->email }}</td>
                                            <td><small>(updated on 12/22/2015) </small><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>Mobile Number:</td>
                                            <td>{{ $user_details->mobile_number }}</td>
                                            <td><small>(updated on {{ $user_details->mobile_updated_at }}) </small><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
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
                                            <td>Last Logged In</td>
                                            <td></td>
                                            <td>(22/12/2015 22:15 PM)</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> 
                        <div class="col-sm-7">
                            <div class="row">
                                <div class="col-sm-12">
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
                                        <div class="panel-body panel-scroll ps-container">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="panel_edit_account" class="tab-pane fade">
                    <form action="{{ URL::route('admin-edit-post'); }}" role="form" id="form" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="user-left">
                                <div class="col-md-6">
                                    <h2><i class="fa fa-users"></i> Overview</h2>
                                    <hr>
                                    <div class="form-group center">
                                        <label>
                                            Update Image
                                        </label>
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail"><img src="{{ URL::asset('assets/projects/images/profilepics/'.$user_details->pic) }}" alt="">
                                            </div>
                                            <div class="fileupload-preview fileupload-exists thumbnail"></div> <br>
                                            <div class="user-edit-image-buttons">
                                                <span class="btn btn-azure btn-file "><span class="fileupload-new"><i class="fa fa-picture"></i> Select image</span><span class="fileupload-exists"><i class="fa fa-picture"></i> Change</span>
                                                    <input type="file" name="pic">
                                                </span>
                                                <a href="#" class="btn fileupload-exists btn-red" data-dismiss="fileupload">
                                                    <i class="fa fa-times"></i> Remove
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <h3>Account Info</h3>
                                    <div class="row">
                                        <div class="col-md-4">                                            
                                            <div class="form-group">
                                                <label class="control-label">
                                                    First Name
                                                </label>
                                                <input type="text" value="{{ $user_details->first_name or '' }}" class="form-control" id="first_name" name="first_name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">
                                                    Middle Name <span class="symbol"></span>
                                                </label>
                                                <input type="text" value="{{ $user_details->middle_name or '' }}" class="form-control" id="middle_name" name="middle_name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">
                                                    Last Name <span class="symbol required"></span>
                                                </label>
                                                <input type="text" value="{{ $user_details->last_name or '' }}" class="form-control" id="last_name" name="last_name">
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
                                                            <option value="">DD</option>  <!-- Bug here ...........this need to be in blade form -->
                                                            <?php for ($i = 01; $i <= 31; $i++) { ?>                                                    
                                                                <option value="<?php echo $i; ?>" <?php if (date('d', strtotime($user_details->dob)) == $i) echo"selected"; ?>><?php echo $i; ?></option>
                                                            <?php } ?>                    
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <select name="mm" id="mm" class="form-control">
                                                            <option value="">MM</option>  <!-- Bug here ...........this need to be in blade form -->
                                                            <?php for ($i = 01; $i <= 12; $i++) { ?>                                                    
                                                                <option value="<?php echo $i; ?>" <?php if (date('m', strtotime($user_details->dob)) == $i) echo"selected"; ?>><?php echo $i; ?></option>
                                                            <?php } ?>                                                
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" value="{{ (strtotime($user_details->dob) == '') ? '' : date('Y', strtotime($user_details->dob)) }}" id="yyyy" name="yyyy" class="form-control">
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
                                                        <input type="radio" class="grey" value="0" name="sex" id="sex_female" {{ (($user_details->sex) == '0') ? 'checked' : '' }}>  <!-- Bug here -->
                                                        Female
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" class="grey" value="1" name="sex"  id="sex_male" {{ (($user_details->sex) == '1') ? 'checked' : '' }}>  <!-- Bug here -->
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
                                                    Marriage Status <span class="symbol required"></span>
                                                </label>
                                                <div>
                                                    <label class="radio-inline">
                                                        <input type="radio" class="grey" value="0" name="marriage_status" id="unmarried" {{ (($user_details->marriage_status) == '0') ? 'checked' : '' }}>  <!-- Bug here -->
                                                        UnMarried
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" class="grey" value="1" name="marriage_status"  id="married" {{ (($user_details->marriage_status) == '1') ? 'checked' : '' }}>  <!-- Bug here -->
                                                        Married
                                                    </label>
                                                </div>
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
                                            <input type="number" value="{{ $user_details->mobile_number or '' }}" class="form-control" id="mobile_number" name="mobile_number">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                Home Phone Number
                                            </label>
                                            <input type="number" value="{{ $user_details->home_number or '' }}" class="form-control" id="home_number" name="home_number">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">
                                        Address 1 <span class="symbol required"></span>
                                    </label>
                                    <input class="form-control" type="text" name="add_1" value="{{ $user_details->add_1 or '' }}" id="add_1">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">
                                        Address 2 <span class="symbol required"></span>
                                    </label>
                                    <input class="form-control" type="text" name="add_2" value="{{ $user_details->add_2 or '' }}" id="add_2">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">
                                        City
                                    </label>
                                    <input class="form-control tooltips" value="{{ $user_details->city or '' }}" type="text" data-original-title="We'll display it when you write reviews" data-rel="tooltip"  title="" data-placement="top" name="city" id="city">
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
                                            <input class="form-control" type="text" name="pin_code" id="pin_code" value="{{ $user_details->pin_code or '' }}">
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
                                        <option value="dl">Delhi</option>
                                        <option value="mp">Madhya Pradesh</option>
                                        <option value="raj">Rajasthan</option>
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
                            <div class="col-md-8">
                                <p>
                                    Click the Update Button to Update your Details.
                                </p>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-green btn-block" type="submit">
                                    Update <i class="fa fa-arrow-circle-right"></i>
                                </button>
                            </div>
                        </div>
                        {{ Form::token() }}
                    </form>
                </div>                
                <div id="panel_login_details" class="tab-pane fade">
                    <div class="row">
                        <div class="user-left">
                            <div class="col-md-6">
                                <table class="table table-condensed table-hover">
                                    <thead>
                                        <tr>
                                            <th colspan="3"><h3>Login Details</h3></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="column-left">Current Email:</td>
                                            <td class="column-right text-center">{{ $user->email }}</td>
                                        </tr>
                                        <tr>
                                            <td class="column-left">Last Login</td>
                                            <td class="column-right text-center">{{ $user->last_login }}</td>
                                        </tr>
                                        <tr>
                                            <td class="column-left">Skype Id</td>
                                            <td class="column-right text-center">{{ $user->skype }}</td>
                                        </tr>
                                        <tr>
                                            <td class="column-left">
                                                <img src="{{ URL::asset('assets/projects/images/no_img.png'); }}" width="90px" height="90px">
                                            </td>
                                            <td class="column-right text-center"><a href="">Connect Facebook</a></td>
                                        </tr>
                                        <tr>
                                            <td class="column-left">
                                                <img src="{{ URL::asset('assets/projects/images/no_img.png'); }}" width="90px" height="90px">
                                            </td>
                                            <td class="column-right text-center"><a href="#">Connect Google</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <form action="{{ URL::route('user-login-details-post'); }}" role="form" id="form" method="post">
                                <h3>Update Details</h3>
                                <div class="form-group">
                                    <label class="control-label">
                                        Current Password
                                    </label>
                                    <input type="password" placeholder="Old Password" class="form-control" name="old_password" id="old_password" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">
                                        New Password
                                    </label>
                                    <input type="password" placeholder="password" class="form-control" name="password" id="password">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">
                                        Confirm Password
                                    </label>
                                    <input type="password"  placeholder="Confirm Password" class="form-control" id="password_again" name="password_again">
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <p>
                                            Click the Update Button to Update your Details.
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-blue btn-block" type="submit">
                                            Update <i class="fa fa-arrow-circle-right"></i>
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
    </div>

    @stop

    @section('scripts')

    <!-- Scripts for This page only -->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.pulsate/jquery.pulsate.min.js'); }}"></script>
    <script src="{{ URL::asset('assets/js/pages-user-profile.js'); }}"></script>
    <script src="{{ URL::asset('assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js'); }}"></script>
    <script src="{{ URL::asset('assets/js/modifiedJs/admin/maps.js'); }}"></script>
    <script src="{{ URL::asset('assets/plugins/gmaps/gmaps.js'); }}"></script>
    <script>

jQuery(document).ready(function() {

    if (location.hash) {
        $('a[href=' + location.hash + ']').tab('show');
    }
    $(document.body).on("click", "a[data-toggle]", function(event) {
        location.hash = this.getAttribute("href");
    });

    Main.init();
    SVExamples.init();
    PagesUserProfile.init();
    Maps.init();

});

$(window).on('popstate', function() {
    var anchor = location.hash || $("a[data-toggle=tab]").first().attr("href");
    $('a[href=' + anchor + ']').tab('show');
});
    </script>

    @stop