@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
	    <a href="{{ url()->previous() }}" class="btn btn-default">Back</a>
	    <div class="col-md-6 col-sm-offset-3">
			<form class="form-horizontal" role="form" method="POST" action="/appointments"> 
	            <div class="col-md-8 col-md-offset-2">
	            	{{ csrf_field() }}

	            	<!-- name of the condition -->

	            	<div class="form-group{{ $errors->has('a_patient_id') ? ' has-error' : '' }}">
	                    <label for="a_patient_id" class="col-md-4 form-control-label">Patient</label>
	                        <select class="form-control" id="a_patient_id" name="a_patient_id" required >
	                            @foreach($users as $user)
	                            		<option value="{{ $user->id}}">{{ $user->first_name }} {{ $user->last_name }}</option>
	                            @endforeach	
	                        </select>
	                        @if ($errors->has('a_patient_id'))
	                            <span class="help-block">
	                                <strong>{{ $errors->first('a_patient_id') }}</strong>
	                            </span>
	                        @endif
	                </div>

	                <!-- has it been treated yet -->
	                
	                <div class="form-group{{ $errors->has('a_date') ? ' has-error' : '' }}">
	                    <label for="a_date" class="col-md-4 form-control-label">Date:</label>
	                        <input id="a_date" type="date" class="form-control form-control-success" name="a_date" required autofocus>
	                        @if ($errors->has('a_date'))
	                            <span class="help-block">
	                                <strong>{{ $errors->first('a_date') }}</strong>
	                            </span>
	                        @endif
	                </div>

	                <!-- date of diagnosis -->

	                <div class="form-group{{ $errors->has('a_time') ? ' has-error' : '' }}">
	                    <label for="a_time" class="col-md-4 form-control-label">Time:</label>
	                        <select class="form-control" id="a_time" name="a_time" required >
	                        		<option value="9:00">9:00</option>
	                        		<option value="9:30">9:30</option>
	                        		<option value="10:00">10:00</option>
	                        		<option value="10:30">10:30</option>
	                        		<option value="11:00">11:00</option>
	                        		<option value="11:30">11:30</option>
	                        </select>
	                        @if ($errors->has('a_time'))
	                            <span class="help-block">
	                                <strong>{{ $errors->first('a_time') }}</strong>
	                            </span>
	                        @endif
	                </div>

	                <!-- detailed information about the condition -->

	                <div class="form-group{{ $errors->has('a_details') ? ' has-error' : '' }}">
	                    <label for="a_details" class="col-md-4 form-control-label">Details:</label>
	                        <input id="a_details" type="text" class="form-control" name="a_details" required autofocus>
	                        @if ($errors->has('a_details'))
	                            <span class="help-block">
	                                <strong>{{ $errors->first('a_details') }}</strong>
	                            </span>
	                        @endif
	                </div>

	                <!-- submit button -->

	                <div class="form-group">
	                    <div class="col-md-6 col-md-offset-4">
	                        <button type="submit" class="btn btn-primary">Register</button>
	                    </div>
	                </div>
	            </div>  
	        </form>
		</div>	
	</div>
</div>
@endsection