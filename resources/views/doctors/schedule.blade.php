@extends('layouts.master')
@section('content')
<div class="container-fluid schedule-page">
    <div class="row schedule-row">
    	<!-- LEFT COLUMN -->
        <div class="col-md-7 schedule-col">
            <div class="col-md-8 col-md-offset-2 add-schedule-form">
                <h4 class="uppercase center bold">Add new appointment schedule</h4>
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
                            <option value="" disabled selected>Click to select</option>
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
                            <option value="" disabled selected>Click to select</option>
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

                    <!-- Repeat the schedule for X weeks -->
                    <div class="form-group{{ $errors->has('repeat_for') ? ' has-error' : '' }}">
                        <label for="repeat_for" class="col-md-12 form-control-label">Repeat the same schedule for (optional):</label>
                        <select class="form-control" id="repeat_for" name="repeat_for">
                            <option value="1" disabled selected>Click to select</option>
                            <option value="2">2 weeks</option>
                            <option value="3">3 weeks</option>
                            <option value="4">1 month</option>
                            <option value="9">2 months</option>
                            <option value="12">3 months</option>
                            <option value="16">4 months</option>
                            <option value="20">5 months</option>
                            <option value="24">6 months</option>
                        </select>
                        @if ($errors->has('repeat_for'))
                        <span class="help-block">
                            <strong>{{ $errors->first('repeat_for') }}</strong>
                        </span>
                        @endif
                    </div>
                </form>
                <div class="form-group">
                <input type="submit" form="doctors-schedule" class="btn btn-primary submit-btn btn-block"/>
                </div>
            </div>
        </div>
        <!-- RIGHT COLUMN -->
        <div class="col-md-5 schedule-col">
            <div class="col-md-10 col-md-offset-1 select-schedule">
                <h4 class="uppercase center bold">View doctors schedule</h4>
                    <select class="form-control" id="schedule_select_doctor" name="schedule_select_doctor" required>
                    @if( Auth::user()->user_type !== "doctor" )
                        @foreach ($users->sortBy('last_name') as $user)
                        	@if($user->user_type === "doctor")
                                @if($loop->first)
                                    <option selected value="{{ $user->id }}">Dr. {{ $user->first_name }} {{ $user->last_name }}</option>
                                @else
                                    <option value="{{ $user->id }}">Dr. {{ $user->first_name }} {{ $user->last_name }}</option>
                                @endif
                        	@endif
                        @endforeach
                    @elseif( Auth::user()->user_type === "doctor" )
                        <option selected value="{{ Auth::user()->id }}">Dr. {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</option>
                    @endif
                    </select>
                    <button id="submit_select_schedule" type="submit" class="btn btn-primary submit-btn btn-block"/>View Schedule</button>
            </div>
        </div>
    </div>
</div>
@endsection
