@if(count($appointments) > 0)
		<div class="app-list-row">
			<div class="col-sm-2 app-list-col header">
				Doctor
			</div>
			<div class="col-sm-2 app-list-col header">
				Date
			</div>
			<div class="col-sm-1 app-list-col header">
				Time
			</div>
			<div class="col-sm-4 app-list-col header">
				Details
			</div>
			<div class="col-sm-1 app-list-col header">
				View
			</div>
			<div class="col-sm-1 app-list-col header">
				Edit
			</div>
			<div class="col-sm-1 app-list-col header last">
				Delete
			</div>
		</div>
@foreach($appointments->sortByDesc('datetime') as $appointment)
		<div class="app-list-row">
			<div class="col-sm-2 app-list-col app-list-item first app-doctor">
				<p>{{ $appointment->a_doctor }}</p>
			</div>
			<div class="col-sm-2 app-list-col app-list-item app-date">
				<p>{{ $appointment->a_date }}</p>
			</div>
			<div class="col-sm-1 app-list-col app-list-item app-time">
				<p>{{ $appointment->a_time }}</p>
			</div>
			<div class="col-sm-4 app-list-col app-list-item app-details">
				<p>{{ $appointment->a_details }}</p>
			</div>
			<div class="col-sm-1 app-list-col app-list-item app-url">
				<a href="/user/{{ $appointment->user->id }}/appointments/{{ $appointment->id }}/">View</a>
			</div>
			<div class="col-sm-1 app-list-col app-list-item app-edit">
			@if ($appointment->datetime > date("Y-m-d H:i:s"))
				<form> <a type="button"data-id="edit-button"class="edit-btn btn btn-primary btn-xs user-profile-icon"data-toggle="modal"data-appointment-id="{{ $appointment->id }}"data-patient-id="{{ $appointment->user->id }}"data-date="{{ $appointment->a_date }}"data-time="{{ $appointment->a_time }}"data-details="{{ $appointment->a_details }}"data-target="#appointmentsModal"> Edit </a> </form>
			@endif
			</div>
			<div class="col-sm-1 app-list-col app-list-item last app-delete">
			@if ($appointment->datetime > date("Y-m-d H:i:s"))
				{{ Form::open(['method' => 'DELETE', 'class' => 'delete-form', 'route' => ['appointments.delete', $appointment->user->id, $appointment->id]]) }} {{ Form::button('Delete', ['class' => 'btn btn-danger btn-xs user-profile-icon', 'type' => 'submit']) }} {{ Form::close() }}  
			@endif
			</div>
		</div>
@endforeach
@else
<p>This user has not made any appointments yet.</p>
@endif