@extends('layouts.master')

@section('content')
<div class="row padded profile-page single-appointment-page">
<div style="overflow: auto;" class="col-md-12"><a href="{{ URL::to('/user/' . $user->id )}}" type="button" class="btn-return-user-profile button btn btn-success">Go Back</a></div>
    <div class="col-md-9 user-middle-container user-notes">

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
				<h3 class="conditions-panel-title panel-title">Conditions 
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
					<div class="col-sm-2 app-list-col header">
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
								<form> <a type="button" class="btn btn-primary btn-xs btn-block edit-condition-btn" data-toggle="modal"data-condition-id="{{ $condition->id }}"data-patient-id="{{ $condition->appointment->user->id }}"data-name="{{ $condition->c_name }}"data-diagnosed="{{ $condition->c_diagnosed_at }}"data-treated="{{ $condition->c_isTreated }}"data-details="{{ $condition->c_details }}"data-target="#conditionsModal"> Edit </a> </form> 
							</div>
							<div class="col-sm-1 app-list-col app-list-item last">
								{{ Form::open(['method' => 'DELETE', 'class' => 'delete-form', 'route' => ['conditions.delete', $condition->appointment->user->id, $condition->appointment->id, $condition->id]]) }} {{ Form::button('Delete', ['class' => 'btn btn-danger btn-xs btn-block delete-condition-btn', 'type' => 'submit']) }} {{ Form::close() }}  
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
				<h3 class="prescriptions-panel-title panel-title">Prescriptions 
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
    </div>
    <div class="col-md-3 user-right-container">
        <div class="row well user-info">
            @include('helpers.patient-info')        
        </div>
        <div class="row well user-conditions">
            <h2 class="bold uppercase">Conditions</h2>
            @include('helpers.conditions')        
        </div>
        <div class="row well user-appointments">
            <h2 class="bold uppercase">Upcoming Appointments</h2>
            @include('helpers.appointments')
        </div>
        <div class="row well user-prescriptions">
            <h2 class="bold uppercase">Prescriptions</h2>
            <?php $presNum = 0; ?>
            @foreach( $appointments as $appointment)
                    @foreach ($appointment->prescriptions()->sortByDesc('updated_at') as $prescription)
                    <?php $presNum++ ?>
                        @include('helpers.prescriptions-panel')
                    @endforeach
            @endforeach
            @if ($presNum === 0)
                <p>There are no added prescriptions for this patient.</p>
            @endif
        </div>
    </div>
</div>
@endsection



