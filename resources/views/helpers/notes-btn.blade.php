<!-- Button trigger modal -->
<div  class="row doctor-notes">

    <h2 class="bold uppercase notes-title">Doctor Notes</h2>
    <form id="add-note" class="form-horizontal" role="form" method="POST" action="/notes"> 
        {{ csrf_field() }}
        <input type="hidden" name="n_user_id" value="{{ $user->id }}">
        <div class="form-group{{ $errors->has('n_content') ? ' has-error' : '' }}">
            <label for="n_content" class="col-md-4 form-control-label">Add a note to patient's profile: </label>
            <textarea id="n_content" class="form-control" name="n_content" rows="3"></textarea>
            @if ($errors->has('n_content'))
            <span class="help-block">
                <strong>{{ $errors->first('n_content') }}</strong>
            </span>
            @endif
        </div>
    </form>
    <input type="submit" form="add-note" class="btn btn-primary submit-btn"/>

</div>
