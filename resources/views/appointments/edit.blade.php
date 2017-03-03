@extends('layouts.master')

@section('content')

<div class="row">
<a href="{{ url()->previous() }}" class="btn btn-default">Back</a>
	<div class="col-md-6 col-sm-offset-3">
		<form class="form-horizontal" role="form" method="post" action="/user/{{ $appointment->user->id }}/appointments/{{ $appointment->id }}"> 
                        <div class="col-md-8 col-md-offset-2">

                        	 {{ csrf_field() }}


                             {{ method_field('put') }}

                            <div class="form-group{{ $errors->has('a_date') ? ' has-error' : '' }}">
                                <label for="a_date" class="col-md-4 form-control-label">Date:</label>

                                    <input id="a_date" type="date" class="form-control form-control-success" name="a_date" value="{{ $appointment->a_date }}" required>

                                    @if ($errors->has('a_date'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('a_date') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="form-group{{ $errors->has('a_time') ? ' has-error' : '' }}">
                                <label for="a_time" class="col-md-4 form-control-label">Time:</label>


                                    <select class="form-control" id="a_time" name="a_time" value="{{ $appointment->a_time }}" required >
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

                            <div class="form-group{{ $errors->has('a_details') ? ' has-error' : '' }}">
                                <label for="a_details" class="col-md-4 form-control-label">Details:</label>
                                    <input id="a_details" type="text" class="form-control" name="a_details" value="{{ $appointment->a_details }}" required >

                                    @if ($errors->has('a_details'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('a_details') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </div>  
                    </form>
	</div>	
</div>

@endsection