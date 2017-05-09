<!-- Button trigger modal -->
<div  class="row doctor-notes">
    <form id="add-note" class="form-horizontal" role="form" method="POST" action="/notes"> 
        {{ csrf_field() }}
        <input type="hidden" name="patient_id" value="{{ $appointment->user->id }}">
        <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
        <div class="form-group{{ $errors->has('n_content') ? ' has-error' : '' }}">
            <textarea id="n_content" class="form-control" name="n_content" rows="3"></textarea>
            @if ($errors->has('n_content'))
            <span class="help-block">
                <strong>{{ $errors->first('n_content') }}</strong>
            </span>
            @endif
        </div>
    </form>
    <input type="submit" form="add-note" style="float: right;" class="btn btn-primary submit-btn"/>
</div>
