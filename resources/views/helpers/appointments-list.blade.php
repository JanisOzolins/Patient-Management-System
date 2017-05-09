@if(count($appointments) > 0)
		<div class="app-list-row">
		@if(Auth::user()->user_type === "nurse" || Auth::user()->user_type === "doctor")
			<div class="col-sm-2 app-list-col header first">
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
		@else
			<div class="col-sm-2 app-list-col header first">
				Doctor
			</div>
			<div class="col-sm-2 app-list-col header">
				Date
			</div>
			<div class="col-sm-1 app-list-col header">
				Time
			</div>
			<div class="col-sm-6 app-list-col header">
				Details
			</div>
			<div class="col-sm-1 app-list-col header">
				View
			</div>
		@endif
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
			@if(Auth::user()->user_type === "nurse" || Auth::user()->user_type === "doctor")
				<div class="col-sm-4 app-list-col app-list-item app-details">
					<p>{{ $appointment->a_details }}</p>
				</div>
				<div class="col-sm-1 app-list-col app-list-item app-url">
					<a href="/user/{{ $appointment->user->id }}/appointments/{{ $appointment->id }}/">View</a>
				</div>
				<div class="col-sm-1 app-list-col app-list-item app-edit">
					@if ($appointment->datetime > date("Y-m-d H:i:s"))
						<form> <a type="button" data-id="edit-button" class="edit-btn btn-block btn btn-primary btn-xs user-profile-icon appointmentsEditButton" data-toggle="modal" data-appointment-id="{{ $appointment->id }}" data-doctor-id="{{ $appointment->a_doctor_id }}" data-patient-id="{{ $appointment->user->id }}" data-date="{{ $appointment->a_date }}" data-time="{{ $appointment->a_time }}" data-details="{{ $appointment->a_details }}" data-target="#appointmentsModal"> Edit </a> </form>
					@endif
				</div>
				<div class="col-sm-1 app-list-col app-list-item last app-delete">
				@if ($appointment->datetime > date("Y-m-d H:i:s"))
					{{ Form::open(['method' => 'DELETE', 'class' => 'delete-form', 'route' => ['appointments.delete', $appointment->user->id, $appointment->id]]) }} {{ Form::button('Delete', ['class' => 'btn btn-danger btn-block btn-xs user-profile-icon', 'type' => 'submit']) }} {{ Form::close() }}  
				@endif
				</div>
			@else
				<div class="col-sm-6 app-list-col app-list-item app-details">
					<p>{{ $appointment->a_details }}</p>
				</div>
				<div class="col-sm-1 app-list-col app-list-item app-url">
					<a href="/user/{{ $appointment->user->id }}/appointments/{{ $appointment->id }}/">View</a>
				</div>
			@endif
		</div>
@endforeach
@else
<p>This user has not made any appointments yet.</p>
@endif