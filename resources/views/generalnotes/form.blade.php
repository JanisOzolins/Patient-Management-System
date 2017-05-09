<div  class="row doctor-notes">
    <form id="add-gn" class="form-horizontal" role="form" method="POST" action="/gn"> 
        {{ csrf_field() }}
        <input type="hidden" name="patient_id" value="{{ $user->id }}">
        <div class="form-group{{ $errors->has('gn_content') ? ' has-error' : '' }}">
            <textarea id="gn_content" class="form-control" name="gn_content" rows="3"></textarea>
            @if ($errors->has('gn_content'))
            <span class="help-block">
                <strong>{{ $errors->first('gn_content') }}</strong>
            </span>
            @endif
        </div>
    </form>
    <input type="submit" form="add-gn" style="float: right;" class="btn btn-primary submit-btn"/>
</div>
