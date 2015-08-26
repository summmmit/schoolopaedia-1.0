@extends('layouts.login.registration')
@section('stylesheets')
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/bootstrap-social-buttons/bootstrap-social.css') }}">
    <style>
        .btn-social{
            text-align: center;
            width: 70%;
        }
    </style>
@stop
@section('content')
    <!-- start: REGISTER BOX -->
    <div class="box-register">
        <h3>Sign Up</h3>
        <p>
            Enter your personal details below:
        </p>
        <form class="form-register" method="post">
            <div class="errorHandler alert alert-danger no-display">
                <i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
            </div>
            @if(Session::has('global'))
                <div class="alert alert-info global-error">
                    <button data-dismiss="alert" class="close">
                        &times;
                    </button>
                    <strong>{{ Session::get('global') }}</strong>
                </div>
            @endif
            <fieldset>
                <div class="form-group">
                <span class="input-icon">
                    <input type="email" class="form-control" name="email" placeholder="Email"
                           value="{{ Input::old('email') or '' }}">
                    <i class="fa fa-envelope"></i>
                </span>
                </div>
                <div class="form-group">
                  <span class="input-icon">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    <i class="fa fa-lock"></i>
                  </span>
                </div>
                <div class="form-group">
                  <span class="input-icon">
                    <input type="password" class="form-control" name="password_again" placeholder="Password Again">
                    <i class="fa fa-lock"></i>
                  </span>
                </div>
                <div class="form-group">
                    <label for="form-field-select-1">
                        Register As
                    </label>
                    <select id="group_to_register_in" class="form-control" name="group_to_register_in">
                        <option value="">Select your Position</option>
                        <option value="2">Student</option>
                        <option value="3">Teacher</option>
                    </select>
                </div>
                <div class="form-group">
                    <div>
                        <label for="agree" class="checkbox-inline">
                            <input type="checkbox" class="grey agree" id="agree" name="agree">
                            I agree to the Terms of Service and Privacy Policy
                        </label>
                    </div>
                </div>
                <div class="form-actions">
                    Already have an account?
                    <a href="{{ URL::route('account-user-sign-in') }}">
                        Log-in
                    </a>
                    <button type="submit" class="btn btn-green pull-right" id="register-user">
                        Submit <i class="fa fa-arrow-circle-right"></i>
                    </button>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6 text-center margin-bottom-10">
                        <a class="btn btn-social btn-google-plus"><i class="fa fa-google-plus"></i> Sign in with Google</a>
                    </div>
                    <div class="col-md-6 text-center">
                        <a class="btn btn-social btn-facebook"><i class="fa fa-facebook"></i> Sign in with Facebook</a>
                    </div>
                </div>
            </fieldset>
            {!! csrf_field() !!}
        </form>
        <!-- start: COPYRIGHT -->
        <div class="copyright">
            2015 &copy; Created B.
        </div>
        <!-- end: COPYRIGHT -->
    </div>
    <!-- end: REGISTER BOX -->
@stop
@section('scripts')
@stop