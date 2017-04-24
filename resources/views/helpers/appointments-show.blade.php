<div class="panel panel-default app-notes">
	<div class="panel-heading"> 
	<h3 class="panel-title">Appointment Notes and Progress Log</h3> 
	</div>
	<div class="panel-body">
		@if(Auth::user()->user_type === "nurse" || Auth::user()->user_type === "doctor")
			@include('helpers.notes-btn')
		@endif
		@include('helpers.notes')
	</div>
</div>

<div class="panel panel-default app-conditions">
	<div class="panel-heading">
		<h3 class="panel-title">Conditions 
		@if(Auth::user()->user_type === "nurse" || Auth::user()->user_type === "doctor")
			@include('helpers.conditions-btn')
		@endif
		</h3>
	</div>
	<div class="panel-body">
	@if(count($appointment->conditions) > 0)
		<div class="app-list-row">
		@if(Auth::user()->user_type === "nurse" || Auth::user()->user_type === "doctor")
			<div class="col-sm-2 app-list-col header first">
				Condition
			</div>
			<div class="col-sm-2 app-list-col header">
				Diagnosed On
			</div>
			<div class="col-sm-1 app-list-col header">
				Treated?
			</div>
			<div class="col-sm-5 app-list-col header">
				Details
			</div>
			<div class="col-sm-1 app-list-col header">
				Edit
			</div>
			<div class="col-sm-1 app-list-col header last">
				Delete
			</div>
		@else
			<div class="col-sm-2 app-list-col header first">
				Condition
			</div>
			<div class="col-sm-2 app-list-col header">
				Diagnosed On
			</div>
			<div class="col-sm-2 app-list-col header">
				Treated?
			</div>
			<div class="col-sm-6 app-list-col header last">
				Details
			</div>
		@endif
		</div>
		@foreach($appointment->conditions->sortByDesc('created_at') as $condition)
			<div class="app-list-row condition-row">
				<div class="col-sm-2 app-list-col app-list-item first">
					<p>{{ $condition->c_name }}</p>
				</div>
				<div class="col-sm-2 app-list-col app-list-item">
					<p>{{ $condition->c_diagnosed_at }}</p>
				</div>
				<div class="col-sm-2 app-list-col app-list-item">
					<p>{{ $condition->c_isTreated }}</p>
				</div>
				@if(Auth::user()->user_type === "nurse" || Auth::user()->user_type === "doctor")
					<div class="col-sm-5 app-list-col app-list-item">
						<p>{{ $condition->c_details }}</p>
					</div>
					<div class="col-sm-1 app-list-col app-list-item">
						<form> <a type="button" class="btn btn-primary btn-xs edit-condition-btn" data-toggle="modal"data-condition-id="{{ $condition->id }}"data-patient-id="{{ $condition->appointment->user->id }}"data-name="{{ $condition->c_name }}"data-diagnosed="{{ $condition->c_diagnosed_at }}"data-treated="{{ $condition->c_isTreated }}"data-details="{{ $condition->c_details }}"data-target="#conditionsModal"> Edit </a> </form> 
					</div>
					<div class="col-sm-1 app-list-col app-list-item last">
						{{ Form::open(['method' => 'DELETE', 'class' => 'delete-form', 'route' => ['conditions.delete', $condition->appointment->user->id, $condition->appointment->id, $condition->id]]) }} {{ Form::button('Delete', ['class' => 'btn btn-danger btn-xs', 'type' => 'submit']) }} {{ Form::close() }}  
					</div>
				@else
					<div class="col-sm-6 app-list-col app-list-item">
						<p>{{ $condition->c_details }}</p>
					</div>
				@endif
			</div>
		@endforeach
		@else
			<p>There are no conditions diagnosed during this appointment.</p>
		@endif
	</div>
</div>

<div class="panel panel-default app-prescriptions">
	<div class="panel-heading">
		<h3 class="panel-title">Prescriptions 
		@if(Auth::user()->user_type === "doctor")
			@include('helpers.prescriptions-btn')
		@endif
		</h3> 
	</div>
	<div class="panel-body">
		@if(count($appointment->prescriptions) > 0)
		    @foreach ($appointment->prescriptions()->sortByDesc('updated_at') as $prescription)
		        @include('helpers.prescriptions-panel')
		    @endforeach
		@else
		    <p>Nothing has been prescribed during this appointment.</p>
		@endif
	</div>
</div>