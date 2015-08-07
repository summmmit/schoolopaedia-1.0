@extends('layouts.login.registration')
@section('content')
<!-- start: FORGOT BOX -->
<div class="box-forgot">
    <h3>Forget Password?</h3>
    <p>
        Enter your e-mail address below to reset your password.
    </p>
    <form class="form-forgot" method="post" action="{{ URL::route('admin-forgot-password-post'); }}">
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
                    <input type="email" class="form-control" name="email" placeholder="Email">
                    <i class="fa fa-envelope"></i> </span>
            </div>
            <div class="form-actions">
                <a class="btn btn-light-grey go-back" href="{{ URL::route('admin-sign-in'); }}">
                    <i class="fa fa-chevron-circle-left"></i> Log-In
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
        2014 &copy; Rapido by cliptheme.
    </div>
    <!-- end: COPYRIGHT -->
</div>
<!-- end: FORGOT BOX -->
@stop
@section('scripts')
<script>
    jQuery(document).ready(function() {
        Main.init();
        Login.init();
    });
</script>

@stop