<!-- Button trigger modal -->
<div class="prescriptions-controls">
<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#conditionsModal">
    New Condition
</button>
</div>
<!-- Modal -->
<div class="modal fade" id="conditionsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add new health condition</h4>
            </div>
            <!-- Body -->
            <div class="modal-body">
                <div class="row padded">
                    <div class="col-md-12">
                        <form id="conditions-form" class="form-horizontal" role="form" method="POST" action="/conditions"> 
                            <div class="col-md-8 col-md-offset-2">
                                {{ csrf_field() }}

                                <input type="hidden" id="patient_id" name="patient_id" value="{{ $user->id }}">

                                <input type="hidden" id="appointment_id" name="appointment_id" value="{{ $appointment->id }}">

                                <input type="hidden" id="condition_id" name="condition_id" value="" >

                                <div class="form-group{{ $errors->has('c_name') ? ' has-error' : '' }}">
                                    <label for="c_name" class="col-md-4 form-control-label">Condition Name</label>
                                    <input id="c_name" type="text" class="form-control form-control-success" name="c_name" required autofocus>
                                    @if ($errors->has('c_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('c_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="form-group{{ $errors->has('c_diagnosed_at') ? ' has-error' : '' }}">
                                    <label for="c_diagnosed_at" class="col-md-12 form-control-label">Date diagnosed:</label>
                                        <input id="c_diagnosed_at" type="date" class="form-control form-control-success" name="c_diagnosed_at" required>
                                        @if ($errors->has('c_diagnosed_at'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('c_diagnosed_at') }}</strong>
                                            </span>
                                        @endif
                                </div>

                                <div class="form-group{{ $errors->has('c_isTreated') ? ' has-error' : '' }}">
                                    <label for="c_isTreated" class="col-md-12 form-control-label">Has it been treated yet?</label>
                                    <div class="row padded">
                                    <div class="radio col-md-12">
                                        <label class="radio-inline"> <input type="radio" name="c_isTreated" id="conditions-yes" value="Yes"> Yes </label> 
                                    </div>
                                    <div class="radio col-md-12">
                                        <label class="radio-inline"> <input type="radio" name="c_isTreated" id="conditions-no" value="No"> No </label>
                                    </div>
                                    <div class="radio col-md-12">
                                        <label class="radio-inline"> <input type="radio" name="c_isTreated" id="conditions-unknown" value="Unknown" checked> Unknown </label>
                                    </div>
                                    </div>
                                    @if ($errors->has('c_isTreated'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('c_isTreated') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('c_details') ? ' has-error' : '' }}">
                                    <label for="c_details" class="col-md-4 form-control-label">Details:</label>
                                        <textarea id="c_details" class="form-control" name="c_details" rows="3"></textarea>
                                        @if ($errors->has('c_details'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('c_details') }}</strong>
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
                <input type="submit" form="conditions-form" class="btn bt-default"/>
            </div>
        </div>
    </div>
</div>

