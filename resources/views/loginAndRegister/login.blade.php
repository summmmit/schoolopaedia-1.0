@extends('layouts.login.registration')
@section('stylesheets')
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/bootstrap-social-buttons/bootstrap-social.css') }}">
@stop
@section('content')
<!-- start: LOGIN BOX -->
<div class="box-login">
    <h3>Sign in to your account</h3>
    <p>
        Please enter your name and password to log in.
    </p>
    <form class="form-login" action="{{ URL::route('account-user-sign-in-post') }}" method="post">
        <!-- Some Message to be Displayed start-->
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
                    <input type="email" class="form-control" name="email" placeholder="Email Address / Username" value="{{ Input::old('identity') or '' }}">
                    <i class="fa fa-user"></i> </span>
            </div>
            <div class="form-group form-actions">
                <span class="input-icon">
                    <input type="password" class="form-control password" name="password" placeholder="Password">
                    <i class="fa fa-lock"></i>
                    <a class="forgot" href="{{ URL::route('account-user-retrieve-password') }}">
                        I forgot my password
                    </a> </span>
            </div>
            <div class="form-actions">
                <label for="remember" class="checkbox-inline">
                    <input type="checkbox" class="grey remember" id="remember" name="remember">
                    Keep me signed in
                </label>
                <button type="submit" class="btn btn-green pull-right">
                    Login <i class="fa fa-arrow-circle-right"></i>
                </button>
            </div>
            <div class="new-account">
                Don't have an account yet?
                <a href="{{ URL::route('account-user-create') }}">
                    Create an account
                </a>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6 text-center">
                    <a href="" class="btn btn-social btn-google-plus"><i class="fa fa-google-plus"></i> Sign in with Google</a>
                </div>
                <div class="col-md-6 text-center">
                    <a href="" class="btn btn-social btn-facebook"><i class="fa fa-facebook"></i> Sign in with Facebook</a>
                </div>
            </div>
        </fieldset>
        {!! csrf_field() !!}
    </form>
    <!-- start: COPYRIGHT -->
    <div class="copyright">
        2015 &copy; Sumit Prasad.
    </div>
    <!-- end: COPYRIGHT -->
</div>
<!-- end: LOGIN BOX -->
@stop
@section('scripts')
@stop