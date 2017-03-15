<!-- Button trigger modal -->
<div class="prescriptions-controls">
<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#prescriptionsModal">
    New Prescription
</button>
</div>
<!-- Modal -->
<div class="modal fade" id="prescriptionsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New Prescription</h4>
            </div>
            <!-- Body -->
            <div class="modal-body">
                <div class="row padded">
                    <div class="col-md-12">
                        <form id="prescriptions-form" class="form-horizontal" role="form" method="POST" action="/prescriptions"> 
                            {{ csrf_field() }}
                                <input type="hidden" id="patient_id" name="patient_id" value="{{ $user->id }}">
                                <input type="hidden" id="appointment_id" name="appointment_id" value="{{ $appointment->id }}">
                            <input type="hidden" id="prescription_id" name="prescription_id">
                            <!-- Prescription Name -->
                            <div class="form-group{{ $errors->has('p_name') ? ' has-error' : '' }}">
                                <label for="p_name" class="col-md-4 form-control-label">Prescription name: </label>
                                <input id="p_name" type="text" class="form-control" name="p_name"></input>
                                @if ($errors->has('p_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('p_name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- Associated Condition -->
                            <div class="form-group{{ $errors->has('p_condition') ? ' has-error' : '' }}">
                                <label for="p_condition" class="col-md-4 form-control-label">Associated condition: </label>
                                    <select class="form-control" id="p_condition" name="p_condition" required >
                                    @foreach($user->appointments as $appointment)
                                        @foreach($appointment->conditions as $condition)
                                                <option value="{{ $condition->c_name }}">{{ $condition->c_name }}</option>
                                        @endforeach 
                                    @endforeach 
                                    </select>
                                    @if ($errors->has('p_condition'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('p_condition') }}</strong>
                                        </span>
                                    @endif
                            </div>
                            <!-- Active Date -->
                            <div class="form-group{{ $errors->has('p_active') ? ' has-error' : '' }}">
                                <label for="p_active" class="col-md-4 form-control-label">Prescription activation date: </label>
                                <input id="p_active" type="date" class="form-control" name="p_active"></input>
                                @if ($errors->has('p_active'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('p_active') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- Expiry Date -->
                            <div class="form-group{{ $errors->has('p_expiry') ? ' has-error' : '' }}">
                                <label for="p_expiry" class="col-md-4 form-control-label">Prescription expiry date: </label>
                                <input id="p_expiry" type="date" class="form-control" name="p_expiry"></input>
                                @if ($errors->has('p_expiry'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('p_expiry') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- Are you prescribing a controlled drug? -->
                            <div class="form-group{{ $errors->has('p_controlled') ? ' has-error' : '' }}">
                                <label>Are you prescribing a controlled drug?</label>
                                <div class="radio-buttons-container">
                                        <label class="radio-inline">
                                            <input type="radio" name="p_controlled" value="Yes"><p>Yes</p>
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="p_controlled" value="No"><p>No</p>
                                        </label>
                                </div>
                                @if ($errors->has('p_controlled'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('p_controlled') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <!-- Is the Prescription Repeat -->
                            <div class="form-group{{ $errors->has('p_repeat') ? ' has-error' : '' }}">
                                <label>Is this a repeat prescription?</label>
                                <div class="radio-buttons-container">
                                        <label class="radio-inline">
                                            <input type="radio" name="p_repeat" value="Yes"><p>Yes</p>
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="p_repeat" value="No"><p>No</p>
                                        </label>
                                </div>
                                @if ($errors->has('p_repeat'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('p_repeat') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <!-- Prescription Details -->
                            <div class="form-group{{ $errors->has('p_details') ? ' has-error' : '' }}">
                                <label for="p_details" class="col-md-4 form-control-label">Prescription details: </label>
                                <textarea id="p_details" class="form-control" name="p_details" rows="3"></textarea>
                                @if ($errors->has('p_details'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('p_details') }}</strong>
                                </span>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>  
            </div>
            <!-- Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" form="prescriptions-form" class="btn bt-default"/>
            </div>
        </div>
    </div>
</div>

