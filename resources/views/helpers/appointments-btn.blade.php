<!-- Button trigger modal -->
<div class="appointments-controls">
<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#appointmentsModal">
    New appointment
</button>
</div>
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

                                        <input id="a_app_id" type="hidden" class="form-control form-control-success" name="a_app_id" >

                                        <div class="form-group{{ $errors->has('a_patient_id') ? ' has-error' : '' }}">
                                            <label id="a_patient_id_label" for="a_patient_id" class="col-md-4 form-control-label">Patient</label>
                                                <input id="a_patient_id" type="hidden" class="form-control form-control-success" name="a_patient_id" value="{{ $user->id }}" >
                                                @if ($errors->has('a_patient_id'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('a_patient_id') }}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                        
                                        <div class="form-group{{ $errors->has('a_date') ? ' has-error' : '' }}">
                                            <label for="a_date" class="col-md-4 form-control-label">Date:</label>
                                                <input id="a_date" type="date" class="form-control form-control-success" name="a_date" required autofocus>
                                                @if ($errors->has('a_date'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('a_date') }}</strong>
                                                    </span>
                                                @endif
                                        </div>

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

                                        <div class="form-group{{ $errors->has('a_details') ? ' has-error' : '' }}">
                                            <label for="a_details" class="col-md-4 form-control-label">Details:</label>
                                                <input id="a_details" type="text" class="form-control" name="a_details" value="" required autofocus>
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