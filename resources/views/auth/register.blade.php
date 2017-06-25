<form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}
    <div class="col-md-12"> 
        <div class="form-group{{ $errors->has('user_type') ? ' has-error' : '' }}">
            <label for="user_type" class="form-control-label">User Type</label>

                <select class="form-control" id="user_type" name="user_type" value="{{ old('user_type') }}" required >
                  @if (Auth::user()->user_type == "staff" || Auth::user()->user_type == "nurse" || Auth::user()->user_type == "doctor")
                    <option value="patient">Patient</option>
                  @elseif (Auth::user()->user_type == "manager")
                    <option value="staff">Staff</option>
                    <option value="doctor">Doctor</option>
                    <option value="nurse">Nurse</option>
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
            <label for="first_name" class="form-control-label">First Name</label>

                <input id="first_name" type="text" class="form-control form-control-success" name="first_name" value="{{ old('first_name') }}" required autofocus>

                @if ($errors->has('first_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('first_name') }}</strong>
                    </span>
                @endif
        </div>

        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
            <label for="last_name" class="form-control-label">Last Name</label>
                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>

                @if ($errors->has('last_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('last_name') }}</strong>
                    </span>
                @endif
        </div>

        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
            <label for="gender" class="form-control-label">Gender</label>

                <select class="form-control" id="gender" name="gender" value="{{ old('gender') }}" required >
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>

                @if ($errors->has('gender'))
                    <span class="help-block">
                        <strong>{{ $errors->first('gender') }}</strong>
                    </span>
                @endif
        </div>

         <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
            <label for="address" class="form-control-label">Full Address</label>

            
                <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required autofocus>

                @if ($errors->has('address'))
                    <span class="help-block">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                @endif
        </div>

        <div class="form-group{{ $errors->has('birth_date') ? ' has-error' : '' }}">
            <label for="birth_date" class="form-control-label">Date of Birth</label>

            
                <input id="birth_date" type="date" class="form-control" name="birth_date" value="{{ old('birth_date') }}" required autofocus>

                @if ($errors->has('birth_date'))
                    <span class="help-block">
                        <strong>{{ $errors->first('birth_date') }}</strong>
                    </span>
                @endif
        </div>

        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
            <label for="phone" class="form-control-label">Phone</label>

            
                <input id="phone" type="tel" class="form-control" name="phone" value="{{ old('phone') }}" required>

                @if ($errors->has('phone'))
                    <span class="help-block">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="form-control-label">E-mail</label>

            
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
        </div>

        <!-- <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="form-control-label">Password</label>

            
                <input id="password" type="password" class="form-control" name="password" required>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
        </div>

        <div class="form-group">
            <label for="password-confirm" class="form-control-label">Confirm Password</label>

            
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>
        </div> -->

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">
                Register
            </button>
        </div>
    </div>  
</form>
