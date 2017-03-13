@if(count($user->notes) > 0)
    @foreach ($user->notes->sortByDesc('updated_at') as $note)

            <div class="row doctor-notes-item"> 
                <div class="col-md-12 note-meta">Posted by <strong>{{ $note->n_author }}</strong> 
                <div style="float: right; line-height: 28px;">{{ $note->updated_at->diffForHumans() }} 
                    {{ Form::open(['method' => 'DELETE', 'route' => ['notes.delete', $note->user->id, $note->id]]) }}
                    {{ Form::button('<i class="fa fa-minus-circle" aria-hidden="true"></i>', ['class' => 'btn btn-danger btn-xs remove-icon', 'type' => 'submit']) }}
                    {{ Form::close() }}
                </div>
            </div>
                <div class="col-md-12 note-body">{{ $note->n_content }}</div>
            </div>
    @endforeach
@else
    <p>There are doctor's notes for this patient.</p>
@endif