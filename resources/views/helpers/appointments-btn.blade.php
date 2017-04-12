<!-- Button trigger modal -->
<div class="appointments-controls">
@if(Route::currentRouteName() === "patients.show")
<button type="button" class="btn btn-success btn-xs" data-id="new-button" data-toggle="modal" data-target="#appointmentsModal">
    New Appointment
</button>
@elseif(Route::currentRouteName() === "appointments.index")
<button type="button" class="btn btn-success btn-block" data-id="new-button" data-toggle="modal" data-target="#appointmentsModal">
    New Appointment
</button>
@endif
</div>
<!-- scripts -->
<script>
  $( function() {
    $( "#a_date" ).datepicker();
  });
  </script>
<!-- Modal -->
<div class="modal fade" id="appointmentsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New appointment</h4>
            </div>
            <!-- Body -->
            <div class="modal-body">
                <div class="row padded">
                    <div class="col-md-12">
                        <form id="appointments-form" class="form-horizontal" role="form" method="POST" action="/appointments"> 
                            <div class="col-md-8 col-md-offset-2">
                                {{ csrf_field() }}

                                <!-- Hidden Appointment ID field (for editing) -->
                                <input id="a_app_id" type="hidden" class="form-control form-control-success" name="a_app_id" >

                                <!-- Patient ID selector -->
                                <div class="form-group{{ $errors->has('a_patient_id') ? ' has-error' : '' }}">
                                    <label id="a_patient_id_label" for="a_patient_id" class="form-control-label">Patient</label>
                                    @if(Route::currentRouteName() === "patients.show")
                                        <input id="a_patient_id" type="text" class="form-control form-control-success" name="a_patient_id" value="{{ $user->id }}" >
                                        @if ($errors->has('a_patient_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('a_patient_id') }}</strong>
                                            </span>
                                        @endif
                                    @elseif(Route::currentRouteName() === "appointments.index")
                                        <select class="form-control" id="a_patient_id" name="a_patient_id" value="{{ old('a_patient_id') }}" required >
                                                <option value="" disabled selected>Select a patient</option>
                                            @foreach($allUsers as $user)
                                                @if ($user->user_type === "patient")
                                                <option value="{{$user->id}}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    @endif
                                </div>

                                <!-- Doctor Selector -->
                                <div class="form-group{{ $errors->has('a_doctor_id') ? ' has-error' : '' }}">
                                    <label for="a_doctor_id" class="col-md-4 form-control-label">Doctor</label>
                                        <select class="form-control" id="a_doctor_id" name="a_doctor_id" value="{{ old('a_doctor_id') }}" required >
                                                        <option value="" disabled selected>Select a specialist</option>
                                            @if(Route::currentRouteName() === "appointments.index")
                                                @foreach ($allUsers as $user) 
                                                    @if ($user->user_type === "doctor")
                                                        @if( old('a_doctor_id') == $user->id )
                                                            <option value="{{$user->id}}" selected="selected">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                        @else
                                                            <option value="{{$user->id}}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                        @endif
                                                    @endif
                                                @endforeach 
                                            @elseif(Route::currentRouteName() === "patients.show")
                                                @foreach ($users as $user) 
                                                    @if ($user->user_type === "doctor")
                                                        @if( old('a_doctor_id') == $user->id )
                                                            <option value="{{$user->id}}" selected="selected">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                        @else
                                                            <option value="{{$user->id}}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                        @endif
                                                    @endif
                                                @endforeach 
                                            @endif
                                        </select>

                                        @if ($errors->has('a_doctor_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('a_doctor_id') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                
                                <!-- Appointment Date -->
                                <div class="form-group{{ $errors->has('a_date') ? ' has-error' : '' }}">
                                    <label for="a_date" class="form-control-label">Date:</label>
                                        <input id="a_date" type="text" class="form-control form-control-success" name="a_date" value="{{ old('a_date') }}" required>
                                        @if ($errors->has('a_date'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('a_date') }}</strong>
                                            </span>
                                        @endif
                                </div>

                                <!-- Appointment Time -->
                                <div class="form-group{{ $errors->has('a_time') ? ' has-error' : '' }}">
                                    <label for="a_time" class="form-control-label">Time:</label>
                                        <select class="form-control" id="a_time" name="a_time" value="{{ old('a_time') }}" disabled required >
                                        </select>
                                        @if ($errors->has('a_time'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('a_time') }}</strong>
                                            </span>
                                        @endif
                                </div>

                                <!-- Appointment Details -->
                                <div class="form-group{{ $errors->has('a_details') ? ' has-error' : '' }}">
                                    <label for="a_details" class="form-control-label">Details:</label>
                                        <input id="a_details" type="text" class="form-control" name="a_details" value="{{ old('a_details') }}" required>
                                        @if ($errors->has('a_details'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('a_details') }}</strong>
                                            </span>
                                        @endif
                                </div>
                            </div>  
                        </form>
                    </div>
                </div>  
            </div>
            <!-- Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" form="appointments-form" class="btn bt-default"/>
            </div>
        </div>
    </div>
</div>