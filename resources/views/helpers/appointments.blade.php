<?php $appNum = 1; ?>
@foreach ($appointments as $appointment)
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">
      <div class="title-bar">
        <a class="panel-title">Appointment {{ $appNum++ }}</a>
        {{ Form::open(['method' => 'DELETE', 'class' => 'delete-form', 'route' => ['appointments.delete', $appointment->user->id, $appointment->id]]) }}
        {{ Form::button('<i class="fa fa-times" aria-hidden="true"></i>', ['class' => 'btn btn-danger btn-xs user-profile-icon', 'type' => 'submit']) }}
        {{ Form::close() }}
        <form>
          <a 
            type="button" 
            class="btn btn-default btn-xs user-profile-icon" 
            data-toggle="modal"
            data-appointment-id="{{ $appointment->id }}"
            data-patient-id="{{ $appointment->user->id }}"
            data-date="{{ $appointment->a_date }}"
            data-time="{{ $appointment->a_time }}"
            data-details="{{ $appointment->a_details }}"
            data-target="#appointmentsModal">
            <i class="fa fa-pencil" aria-hidden="true"></i>
        </a>
      </form>
    </div>
  </h3>
</div>
<div class="panel-body">
  <strong>Date: </strong>{{ $appointment-> a_date }}<br>
  <strong>Time: </strong>{{ $appointment-> a_time }}<br>
  <strong>Details: </strong>{{ $appointment-> a_details }}
</div>
</div>
@endforeach