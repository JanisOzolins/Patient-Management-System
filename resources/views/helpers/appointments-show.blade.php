<div class="panel panel-default app-notes">
	<div class="panel-heading"> @include('helpers.notes-btn')
	</div>
	<div class="panel-body">
		@include('helpers.notes')
	</div>
</div>

<div class="panel panel-default app-conditions">
	<div class="panel-heading">
		<h3 class="panel-title">Conditions @include('helpers.conditions-btn')</h3> 
	</div>
	<div class="panel-body">
	@if(count($appointment->conditions) > 0)
	<ul class="list-group">
		<li class="list-group-item first">
			<div class="col-md-2 app-list-col">
				Condition
			</div>
			<div class="col-md-2 app-list-col">
				Diagnosed on
			</div>
			<div class="col-md-2 app-list-col">
				Treated?
			</div>
			<div class="col-md-4 app-list-col">
				Details
			</div>
			<div class="col-md-1 app-list-col">
				Edit
			</div>
			<div class="col-md-1 app-list-col last">
				Delete
			</div>
		</li>
	@foreach($appointment->conditions->sortByDesc('created_at') as $condition)
		<li class="list-group-item">
			<div class="col-md-2 app-list-col">
				{{ $condition->c_name }}
			</div>
			<div class="col-md-2 app-list-col">
				{{ $condition->c_diagnosed_at }}
			</div>
			<div class="col-md-2 app-list-col">
				{{ $condition->c_isTreated }}
			</div>
			<div class="col-md-4 app-list-col">
				{{ $condition->c_details }}
			</div>
			<div class="col-md-1 app-list-col">
				<form> <a type="button" class="btn btn-primary btn-xs edit-condition-btn" data-toggle="modal"data-condition-id="{{ $condition->id }}"data-patient-id="{{ $condition->appointment->user->id }}"data-name="{{ $condition->c_name }}"data-diagnosed="{{ $condition->c_diagnosed_at }}"data-treated="{{ $condition->c_isTreated }}"data-details="{{ $condition->c_details }}"data-target="#conditionsModal"> Edit </a> </form> 
			</div>
			<div class="col-md-1 app-list-col last">
				{{ Form::open(['method' => 'DELETE', 'class' => 'delete-form', 'route' => ['conditions.delete', $condition->appointment->user->id, $condition->appointment->id, $condition->id]]) }} {{ Form::button('Delete', ['class' => 'btn btn-danger btn-xs', 'type' => 'submit']) }} {{ Form::close() }} 
			</div>
		</li>
	@endforeach
	</ul>
	@else 
	There are no conditions diagnosed during this appointment.
	@endif
	</div>
</div>

<div class="panel panel-default app-prescriptions">
	<div class="panel-heading">
		<h3 class="panel-title">Prescriptions @include('helpers.prescriptions-btn')</h3> 
	</div>
	<div class="panel-body">
			@include('helpers.prescriptions-single')
	</div>
</div>