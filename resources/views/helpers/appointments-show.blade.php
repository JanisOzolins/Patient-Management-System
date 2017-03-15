<div class="panel panel-default app-notes">
	<div class="panel-heading">
		<h3 class="panel-title">Notes</h3> <a href="#" class="btn btn-success btn-xs">New Condition</a>
	</div>
	<div class="panel-body">
		@foreach ($appointment->notes as $note)
			{{ $note->n_author }} <br>
			{{ $note->n_content }}
		@endforeach
	</div>
</div>

<div class="panel panel-default app-conditions">
	<div class="panel-heading">
		<h3 class="panel-title">Conditions</h3> @include('helpers.conditions-btn')
	</div>
	<div class="panel-body">
		@foreach ($appointment->conditions as $condition)
			{{ $condition->c_name }} <br>
			{{ $condition->c_diagnosed_at }} <br>
		@endforeach
	</div>
</div>

<div class="panel panel-default app-prescriptions">
	<div class="panel-heading">
		<h3 class="panel-title">Prescriptions</h3> @include('helpers.prescriptions-btn')
	</div>
	<div class="panel-body">
			@include('helpers.prescriptions-app')
	</div>
</div>