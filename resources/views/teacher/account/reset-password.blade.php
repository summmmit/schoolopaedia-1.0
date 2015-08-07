@extends('layouts.login.registration')
@section('content')
<!-- start: LOGIN BOX -->
<div class="box-login">
    <h3>Reset Password</h3>
    <p>
        Please Enter And Confirm New Password
    </p>
    <form class="form-login" action="{{ URL::route('admin-store-new-password-post'); }}" method="post">
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
            <input type="hidden" name="email" value="{{Input::get('email')}}" />
            <input type="hidden" name="resetcode" value="{{Input::get('resetcode')}}" />
            <div class="form-group">
                <span class="input-icon">
                    <input type="password" class="form-control password" name="password" placeholder="Password">
                    <i class="fa fa-user"></i> </span>
            </div>
            <div class="form-group">
                <span class="input-icon">
                    <input type="password" class="form-control password" name="password_again" placeholder="Confirm Password">
                    <i class="fa fa-user"></i> </span>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-green pull-right">
                    Reset Password <i class="fa fa-arrow-circle-right"></i>
                </button>
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