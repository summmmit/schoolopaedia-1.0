@extends('layouts.login.registration')
@section('content')
<!-- start: REGISTER BOX -->
<div class="box-register">
    <h3>Sign Up</h3>
    <p>
        Enter your School details below:
    </p>
    <form class="form-school-register" action="{{ URL::route('school-register-post') }}" method="post">
        <div class="errorHandler alert alert-danger no-display">
            <i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
        </div>
        @if(Session::has('global'))
            <div class="errorHandler alert alert-danger">
                <i class="fa fa-remove-sign"></i>{{ Session::get('global') }}
            </div>
        @endif
        <fieldset>
            <div class="form-group">
                <input type="text" class="form-control" name="school_name" placeholder="School Name" value="{{ old('school_name') }}">
                @if ($errors->has('school_name')) <p class="help-block alert-danger">{{ $errors->first('school_name') }}</p> @endif
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="manager_name" placeholder="School Manager's Name" value="{{ old('manager_name') }}">
                @if ($errors->has('manager_name')) <p class="help-block alert-danger">{{ $errors->first('manager_name') }}</p> @endif
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="phone_number" placeholder="School Phone Number" value="{{ old('phone_number') }}">
                @if ($errors->has('phone_number')) <p class="help-block alert-danger">{{ $errors->first('phone_number') }}</p> @endif
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="add_1" placeholder="Address 1" value="{{ old('add_1') }}">
                @if ($errors->has('add_1')) <p class="help-block alert-danger">{{ $errors->first('add_1') }}</p> @endif
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="add_2" placeholder="Address 2" value="{{ old('add_2') }}">
                @if ($errors->has('add_2')) <p class="help-block alert-danger">{{ $errors->first('add_2') }}</p> @endif
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="city" placeholder="City" value="{{ old('city') }}">
                           @if ($errors->has('city')) <p class="help-block alert-danger">{{ $errors->first('city') }}</p> @endif
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="state" placeholder="State" value="{{ old('state') }}">
                           @if ($errors->has('state')) <p class="help-block alert-danger">{{ $errors->first('state') }}</p> @endif
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="country" placeholder="Country" value="{{ old('country') }}">
                        @if ($errors->has('country')) <p class="help-block alert-danger">{{ $errors->first('country') }}</p> @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="pin_code" placeholder="Pin Code" value="{{ old('pin_code') }}">
                        @if ($errors->has('pin_code')) <p class="help-block alert-danger">{{ $errors->first('pin_code') }}</p> @endif
                    </div>
                </div>
            </div>
            <p>
                Enter your account details below:
            </p>
            <div class="form-group">
                <span class="input-icon">
                    <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
                           @if ($errors->has('email')) <p class="help-block alert-danger">{{ $errors->first('email') }}</p> @endif
                    <i class="fa fa-envelope"></i> </span>
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
                <a href="">
                    Log-in
                </a>
                <button type="submit" class="btn btn-green pull-right">
                    Submit <i class="fa fa-arrow-circle-right"></i>
                </button>
            </div>
        </fieldset>
        {!! csrf_field() !!}
    </form>
    <!-- start: COPYRIGHT -->
    <div class="copyright">
        2014 &copy; Rapido by cliptheme.
    </div>
    <!-- end: COPYRIGHT -->
</div>
<!-- end: REGISTER BOX -->
@stop
@section('scripts')
@stop