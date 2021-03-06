@foreach ($appointment->notes->sortByDesc('updated_at') as $note)

            <div class="row doctor-notes-item"> 
                <div class="col-md-12 note-meta">Posted by <strong>{{ $note->n_author }}</strong> 
                <div style="float: right; line-height: 28px;">{{ $note->updated_at->diffForHumans() }} 
                @if(Auth::user()->user_type === "nurse" || Auth::user()->user_type === "doctor")
                    {{ Form::open(['method' => 'DELETE', 'route' => ['notes.delete', $note->appointment->user->id, $note->appointment->id, $note->id]]) }}
                    {{ Form::button('<i class="fa fa-minus-circle" aria-hidden="true"></i>', ['class' => 'btn btn-danger btn-xs remove-icon', 'type' => 'submit']) }}
                    {{ Form::close() }}
                @endif
                </div>
            </div>
                <div class="col-md-12 note-body">{{ $note->n_content }}</div>
            </div>
@endforeach
@if(count($appointment->notes) === 0) 
    <p>There are no added notes for this appointment.</p>
@endif