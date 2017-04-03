@foreach ($appointment->notes->sortByDesc('updated_at') as $note)

            <div class="row doctor-notes-item"> 
                <div class="col-md-12 note-meta">Posted by <strong>{{ $note->n_author }}</strong> 
                <div style="float: right; line-height: 28px;">{{ $note->updated_at->diffForHumans() }} 
                    {{ Form::open(['method' => 'DELETE', 'route' => ['notes.delete', $note->appointment->user->id, $note->appointment->id, $note->id]]) }}
                    {{ Form::button('<i class="fa fa-minus-circle" aria-hidden="true"></i>', ['class' => 'btn btn-danger btn-xs remove-icon', 'type' => 'submit']) }}
                    {{ Form::close() }}
                </div>
            </div>
                <div class="col-md-12 note-body">{{ $note->n_content }}</div>
            </div>
@endforeach