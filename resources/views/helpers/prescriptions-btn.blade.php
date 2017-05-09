<!-- Button trigger modal -->
<div class="prescriptions-controls">
<button type="button" class="btn btn-primary btn-xs prescriptionsAddButton" data-toggle="modal" data-target="#prescriptionsModal">
    New Prescription
</button>
</div>
<!-- Modal -->
<div class="modal fade prescriptions-container" id="prescriptionsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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

                            <!-- Hidden Fields -->
                            <input type="hidden" id="patient_id" name="patient_id" value="{{ $user->id }}">
                            <input type="hidden" id="appointment_id" name="appointment_id" value="{{ $appointment->id }}">
                            <input type="hidden" id="prescription_id" name="prescription_id">

                            <!-- Prescription Name -->
                            <div class="form-group{{ $errors->has('p_name') ? ' has-error' : '' }}">
                                <label for="p_name" class="form-control-label">Prescription name: </label>
                                <input id="p_name" type="text" class="form-control" name="p_name" required></input>
                                @if ($errors->has('p_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('p_name') }}</strong>
                                </span>
                                @endif
                            </div>

                            <!-- Quantity / Supply -->
                            <div class="form-group{{ $errors->has('p_quantity') ? ' has-error' : '' }}">
                                <label for="p_quantity" class="form-control-label">Quantity: </label>
                                <input id="p_quantity" type="text" class="form-control" name="p_quantity" required></input>
                                @if ($errors->has('p_quantity'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('p_quantity') }}</strong>
                                </span>
                                @endif
                            </div>

                            <!-- Condition -->
                            <div class="form-group{{ $errors->has('p_condition') ? ' has-error' : '' }}">
                                <label for="p_condition" class="form-control-label">Associated condition: </label>
                                    <select class="form-control" id="p_condition" name="p_condition" required >
                                                <option value="" disabled selected>Select an option</option>
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
                                <label for="p_active" class="form-control-label">Prescription activation date: </label>
                                <input id="p_active" type="date" class="form-control" name="p_active" value="date('yyyy-MM-dd')"></input>
                                @if ($errors->has('p_active'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('p_active') }}</strong>
                                </span>
                                @endif
                            </div>

                            <!-- Controlled drug? -->
                            <div class="form-group{{ $errors->has('p_controlled') ? ' has-error' : '' }}">
                                <label for="p_controlled" >Is this a controlled drug?</label>
                                <select class="form-control" id="p_controlled" name="p_controlled" required >
                                    <option value="" disabled selected>Select an option</option>
                                    <option value="No">No</option>
                                    <option value="Yes">Yes</option>
                                </select>
                                @if ($errors->has('p_controlled'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('p_controlled') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <!-- Is the Prescription Repeat -->
                            <div  id="p_repeat_group" class="form-group{{ $errors->has('p_repeat') ? ' has-error' : '' }}">
                                <label for="p_controlled">Is this a repeat prescription?</label>
                                <select class="form-control" id="p_repeat" name="p_repeat" value="No" >
                                    <option value="" disabled selected>Select an option</option>
                                    <option value="No">No</option>
                                    <option value="Yes">Yes</option>
                                </select>
                                @if ($errors->has('p_repeat'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('p_repeat') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <!-- Repeat Prescription Expiry Date -->
                            <div id="p_expiry_group" class="form-group{{ $errors->has('p_expiry') ? ' has-error' : '' }}">
                                <label  for="p_expiry" class="form-control-label">Repeat prescription expiry date: </label>
                                <select type="hidden" class="form-control" id="p_expiry" name="p_expiry" >
                                    <option value="" disabled selected>Select an option</option>
                                    <option value="6 months">6 months</option>
                                    <option value="7 months">7 months</option>
                                    <option value="8 months">8 months</option>
                                    <option value="9 months">9 months</option>
                                    <option value="10 months">10 months</option>
                                    <option value="11 months">11 months</option>
                                    <option value="12 months">12 months</option>
                                </select>
                                @if ($errors->has('p_expiry'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('p_expiry') }}</strong>
                                </span>
                                @endif
                            </div>

                            <!-- Prescription Details -->
                            <div class="form-group{{ $errors->has('p_details') ? ' has-error' : '' }}">
                                <label for="p_details" class="form-control-label">Prescription details: </label>
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

