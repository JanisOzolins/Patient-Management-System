@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="col-md-8 col-md-offset-2">

                            
                            <div class="form-group{{ $errors->has('user_type') ? ' has-error' : '' }}">
                                <label for="user_type" class="col-md-4 form-control-label">User Type</label>

                                    <select class="form-control" id="user_type" name="user_type" value="{{ old('user_type') }}" required >
                                      @if (Auth::user()->isStaff(Auth::user()) == "staff")
                                        <option value="patient">Patient</option>
                                      @endif
                                      @if (Auth::user()->isStaff(Auth::user()) == "manager")
                                        <option value="staff">Staff/Nurse</option>
                                        <option value="doctor">Doctor</option>
                                        <option value="manager">Manager</option>
                                      @endif
                                    </select>

                                    @if ($errors->has('user_type'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('user_type') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label for="first_name" class="col-md-4 form-control-label">First Name</label>

                                    <input id="first_name" type="text" class="form-control form-control-success" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <label for="last_name" class="col-md-4 form-control-label">Last Name</label>
                                    <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>

                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                            </div>

                             <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address" class="col-md-4 form-control-label">Full Address</label>

                                
                                    <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required autofocus>

                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="form-group{{ $errors->has('birth_date') ? ' has-error' : '' }}">
                                <label for="birth_date" class="col-md-4 form-control-label">Date of Birth</label>

                                
                                    <input id="birth_date" type="date" class="form-control" name="birth_date" value="{{ old('birth_date') }}" required autofocus>

                                    @if ($errors->has('birth_date'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('birth_date') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-md-4 form-control-label">Phone</label>

                                
                                    <input id="phone" type="tel" class="form-control" name="phone" value="{{ old('phone') }}" required>

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 form-control-label">E-mail</label>

                                
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 form-control-label">Password</label>

                                
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 form-control-label">Confirm Password</label>

                                
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </div>  
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
