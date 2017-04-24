@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row">
    	<!-- LEFT COLUMN -->
        <div class="col-md-6">
        	<div class="col-md-8 col-md-offset-2">
            <form id="doctors-schedule" class="form-horizontal" role="form" method="POST" action="/storeSchedule"> 
		        {{ csrf_field() }}
		        <!-- Doctor's Name -->
	            <div class="form-group{{ $errors->has('doctor_id') ? ' has-error' : '' }}">
	                @if( Auth::user()->user_type === "staff" )
	                <label for="doctor_id" class="col-md-12 form-control-label">Doctor's name: </label>
		                <select class="form-control" id="doctor_id" name="doctor_id" required >
			                @foreach ($users as $user)
			                	@if($user->user_type === "doctor")
			                	<option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
			                	@endif
			                @endforeach
						</select>
					@elseif( Auth::user()->user_type === "doctor" )
						 <input id="doctor_id" type="hidden" class="form-control form-control-success" name="doctor_id" value="{{ Auth::user()->id }}">
					@endif
	                @if ($errors->has('doctor_id'))
	                <span class="help-block">
	                    <strong>{{ $errors->first('doctor_id') }}</strong>
	                </span>
	                @endif
	            </div>
		        <!-- Schedule Date -->
		        <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
	                <label for="date" class="col-md-12 form-control-label">Date: </label>
	                <input id="date" type="date" class="form-control" name="date" required></input>
	                @if ($errors->has('date'))
	                <span class="help-block">
	                    <strong>{{ $errors->first('date') }}</strong>
	                </span>
	                @endif
	            </div>
	            <!-- Appointment Times  - From -->
	            <div class="form-group{{ $errors->has('time_from') ? ' has-error' : '' }}">
	                <label for="time_from" class="col-md-12 form-control-label">First appointment of the day: </label>
	                <select class="form-control" id="time_from" name="time_from" required >
		                @foreach ($timeslots as $time)
		                <option value="{{ $time }}">{{ $time }}</option>
		                @endforeach
					</select>
	                @if ($errors->has('time_from'))
	                <span class="help-block">
	                    <strong>{{ $errors->first('time_from') }}</strong>
	                </span>
	                @endif
	            </div>
				<!-- Appointment Times  - To -->
	            <div class="form-group{{ $errors->has('time_to') ? ' has-error' : '' }}">
	                <label for="time_to" class="col-md-12 form-control-label">Last appointment of the day: </label>
	                <select class="form-control" id="time_to" name="time_to" required >
	               		@foreach ($timeslots as $time)
		                <option value="{{ $time }}">{{ $time }}</option>
		                @endforeach
					</select>
	                @if ($errors->has('time_to'))
	                <span class="help-block">
	                    <strong>{{ $errors->first('time_to') }}</strong>
	                </span>
	                @endif
	            </div>
		    </form>
    		<input type="submit" form="doctors-schedule" class="btn btn-primary submit-btn"/>
    		</div>
        </div>
        <!-- RIGHT COLUMN -->
        <div class="col-md-6">
        @if(Auth::user()->user_type === "doctor")
            @foreach ($users as $user)
            	@if($user->user_type === "doctor")
            		@if(count($user->schedules()) > 0)
            			<h3>{{ $user->first_name }} {{ $user->last_name }}:</h3>
            			@foreach ($user->schedules as $day)
            				<strong>{{ $day->date }}</strong>
            				<ul>
            				@foreach($day->timeslots as $slot)
            					<li>{{ $slot }}</li>
            				@endforeach
            				</ul>
            			@endforeach
            		@endif
            	@endif
            @endforeach
        </div>
    </div>
</div>
@endsection
