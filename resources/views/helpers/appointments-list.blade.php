@if(count($appointments) > 0)
<ul class="list-group">
	<li class="list-group-item first">
		<div class="col-md-2 app-list-col">
			Doctor
		</div>
		<div class="col-md-2 app-list-col">
			Date
		</div>
		<div class="col-md-1 app-list-col">
			Time
		</div>
		<div class="col-md-4 app-list-col">
			Details
		</div>
		<div class="col-md-1 app-list-col">
			View
		</div>
		<div class="col-md-1 app-list-col">
			Edit
		</div>
		<div class="col-md-1 app-list-col last">
			Delete
		</div>
	</li>
@foreach($appointments->sortByDesc('datetime') as $appointment)
	<li class="list-group-item">
		<div class="col-md-2 app-list-col">
			{{ $appointment->a_doctor }}
		</div>
		<div class="col-md-2 app-list-col">
			{{ $appointment->a_date }}
		</div>
		<div class="col-md-1 app-list-col">
			{{ $appointment->a_time }}
		</div>
		<div class="col-md-4 app-list-col">
			{{ $appointment->a_details }}
		</div>
		<div class="col-md-1 app-list-col">
			<a href="/user/{{ $appointment->user->id }}/appointments/{{ $appointment->id }}/">View</a>
		</div>
		<div class="col-md-1 app-list-col">
		@if ($appointment->datetime > date("Y-m-d H:i:s"))
			<form> <a type="button"data-id="edit-button"class="edit-btn btn btn-primary btn-xs user-profile-icon"data-toggle="modal"data-appointment-id="{{ $appointment->id }}"data-patient-id="{{ $appointment->user->id }}"data-date="{{ $appointment->a_date }}"data-time="{{ $appointment->a_time }}"data-details="{{ $appointment->a_details }}"data-target="#appointmentsModal"> Edit </a> </form>
		@endif
		</div>
		<div class="col-md-1 app-list-col last">
		@if ($appointment->datetime > date("Y-m-d H:i:s"))
			{{ Form::open(['method' => 'DELETE', 'class' => 'delete-form', 'route' => ['appointments.delete', $appointment->user->id, $appointment->id]]) }} {{ Form::button('Delete', ['class' => 'btn btn-danger btn-xs user-profile-icon', 'type' => 'submit']) }} {{ Form::close() }}  
		@endif
		</div>
	</li>
@endforeach
</ul>
@else
<p>This user has not made any appointments yet.</p>
@endif