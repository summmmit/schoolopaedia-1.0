@extends('layouts.login.registration')
@section('content')
<!-- start: LOGIN BOX -->
<div class="box-login">
    <h3>Sign in to your account</h3>
    <p>
        Please enter your name and password to log in.
    </p>
    <form class="form-login" action="{{ URL::route('teacher-sign-in-post'); }}" method="post">        
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
                    <input type="text" class="form-control" name="identity" placeholder="Email Address" value="{{ Input::old('identity') or '' }}">
                    <i class="fa fa-user"></i> </span>
            </div>
            <div class="form-group form-actions">
                <span class="input-icon">
                    <input type="password" class="form-control password" name="password" placeholder="Password">
                    <i class="fa fa-lock"></i>
                    <a class="forgot" href="{{ URL::route('teacher-forgot-password'); }}">
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
                <a href="{{ URL::route('teacher-account-create'); }}">
                    Create an account
                </a>
            </div>
        </fieldset>
        {{ Form::token() }}
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
<script>
    jQuery(document).ready(function() {
        Main.init();
        Login.init();
    });
</script>

@stop