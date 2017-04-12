@extends('layouts.master')

@section('content')
<div class="container edit-profile-page">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 form-container">
            <form class="form-horizontal" role="form" method="POST" action="/update-profile">
                {{ csrf_field() }}
                <div class="col-md-8 col-md-offset-2">

                    <!-- hidden user type -->
                    <!-- hidden user ID -->
                    <input type="hidden" id="id" name="id" value="{{ Auth::user()->id }}">


                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                        <label for="first_name" class="col-md-4 form-control-label">First Name</label>

                            <input id="first_name" type="text" class="form-control form-control-success" name="first_name" value="{{ Auth::user()->first_name }}" required>

                            @if ($errors->has('first_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                    </div>

                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                        <label for="last_name" class="col-md-4 form-control-label">Last Name</label>
                            <input id="last_name" type="text" class="form-control" name="last_name" value="{{ Auth::user()->last_name }}" required>

                            @if ($errors->has('last_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                            @endif
                    </div>

                    <!-- <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                        <label for="gender" class="col-md-4 form-control-label">Gender</label>

                            <select class="form-control" id="gender" name="gender" required >
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>

                            @if ($errors->has('gender'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                            @endif
                    </div> -->

                     <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                        <label for="address" class="col-md-4 form-control-label">Full Address</label>

                        
                            <input id="address" type="text" class="form-control" name="address" value="{{ Auth::user()->address }}" required>

                            @if ($errors->has('address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                    </div>

                    <!-- <div class="form-group{{ $errors->has('birth_date') ? ' has-error' : '' }}">
                        <label for="birth_date" class="col-md-4 form-control-label">Date of Birth</label>

                        
                            <input id="birth_date" type="date" class="form-control" name="birth_date" value="{{ Auth::user()->birth_date }}" disabled required>

                            @if ($errors->has('birth_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('birth_date') }}</strong>
                                </span>
                            @endif
                    </div> -->

                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                        <label for="phone" class="col-md-4 form-control-label">Phone</label>

                        
                            <input id="phone" type="tel" class="form-control" name="phone" value="{{ Auth::user()->phone }}" required>

                            @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 form-control-label">E-mail</label>

                        
                            <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                    </div>

                    <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                        <label for="current_password" class="col-md-4 form-control-label">Current Password</label>

                        
                            <input id="current_password" type="password" class="form-control" name="current_password" required>

                            @if ($errors->has('current_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('current_password') }}</strong>
                                </span>
                            @endif
                    </div>

                    <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                        <label for="new_password" class="col-md-4 form-control-label">New Password</label>
                            <input id="new_password" type="password" class="form-control" name="new_password">
                            @if ($errors->has('new_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('new_password') }}</strong>
                                </span>
                            @endif
                    </div>

                    <div class="form-group{{ $errors->has('new_password_confirmation') ? ' has-error' : '' }}">
                        <label for="new_password_confirmation" class="col-md-4 form-control-label">Confirm New Password</label>
                            <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation">
                             @if ($errors->has('new_password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                                </span>
                            @endif
                    </div>

                    <div class="form-group">
                        <button style="width: 100%; margin: 10px 0;" type="submit" class="btn btn-primary">
                            Update Profile
                        </button>
                    </div>
                </div>  
            </form>
        </div>
    </div>
</div>
@endsection
