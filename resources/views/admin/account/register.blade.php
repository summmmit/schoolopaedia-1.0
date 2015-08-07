@extends('layouts.login.registration')
@section('content')
<!-- start: REGISTER BOX -->
<div class="box-register">
    <h3>Sign Up</h3>
    <form class="form-register" action="{{ URL::route('admin-account-create-post'); }}" method="post">
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
            <p>
                Enter your account details below:
            </p>
            <div class="form-group">
                <span class="input-icon">
                    <input type="email" class="form-control" name="email" placeholder="Email" value="{{ Input::old('email') or '' }}">
                           @if ($errors->has('email')) <p class="help-block alert-danger">{{ $errors->first('email') }}</p> @endif
                    <i class="fa fa-envelope"></i> </span>
            </div>
            <div class="form-group">
                <span class="input-icon">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                           @if ($errors->has('password')) <p class="help-block alert-danger">{{ $errors->first('password') }}</p> @endif
                    <i class="fa fa-lock"></i> </span>
            </div>
            <div class="form-group">
                <span class="input-icon">
                    <input type="password" class="form-control" name="password_again" placeholder="Password Again">
                           @if ($errors->has('password_again')) <p class="help-block alert-danger">{{ $errors->first('password_again') }}</p> @endif
                    <i class="fa fa-lock"></i> </span>
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
                <a href="{{ URL::route('admin-sign-in') }}">
                    Log-in
                </a>
                <button type="submit" class="btn btn-green pull-right">
                    Submit <i class="fa fa-arrow-circle-right"></i>
                </button>
            </div>
        </fieldset>
        {{ Form::token() }}
    </form>
    <!-- start: COPYRIGHT -->
    <div class="copyright">
        2014 &copy; Rapido by Sumit Singh.
    </div>
    <!-- end: COPYRIGHT -->
</div>
<!-- end: REGISTER BOX -->
@stop
@section('scripts')
<script>
    jQuery(document).ready(function() {
        Main.init();
        Login.init();
    });
</script>

@stop