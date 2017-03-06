<!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#add-new-note-modal">
    Add New Note
</button>
<!-- Modal -->
<div class="modal fade" id="add-new-note-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add new note to patient's profile</h4>
            </div>
            <div class="modal-body">
                <div class="row padded">
                    <div class="col-md-12">
                        <form id="add-new-note" class="form-horizontal" role="form" method="POST" action="/notes"> 
                            {{ csrf_field() }}
                            <input type="hidden" name="n_user_id" value="{{ $user->id }}">
                            <div class="form-group{{ $errors->has('n_details') ? ' has-error' : '' }}">
                                <label for="n_details" class="col-md-4 form-control-label">Note details:</label>
                                <textarea id="n_details" class="form-control" name="n_details" rows="3"></textarea>
                                @if ($errors->has('n_details'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('n_details') }}</strong>
                                </span>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" form="add-new-note" class="btn bt-default"/>
            </div>
        </div>
    </div>
</div>
