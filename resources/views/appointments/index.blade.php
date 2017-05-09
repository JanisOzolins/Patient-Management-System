@extends('layouts.master')

@section('content')
<?php $allUsers = App\User::all(); ?>
<div class="container-fluid appointments-page col-md-10 col-md-offset-1">
    <div class="row">
        <h2 class="uppercase bold center">Appointments</h2>
    </div>
    <div class="row apponitments-controls">
        <div class="col-md-4 app-control-item-container">
            @include('helpers.appointments-btn')
        </div>
        <div class="col-md-8 app-control-item-container">
            @include('appointments.search')
        </div>
    </div>
    <div class="row">
        <div class="appointments-list col-md-12">
            <table class="table table-responsive table-sm table-bordered table-hover appointments-table">
                <thead>
                    <tr>
                        <th class="col-md-2">Patient</th>
                        <th class="col-md-1">Date</th>
                        <th class="col-md-1">Time</th>
                        <th class="col-md-2">Doctor</th>
                        <th class="col-md-4">Notes</th>
                        <th class="col-md-1">Edit</th>
                        <th class="col-md-1">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $allAppointments->sortByDesc('datetime') as $appointment)
                        @if( $appointment->datetime > date("Y-m-d H:i:s") || Auth::user()->user_type === "manager")
                            <tr>
                                <td><a href='./user/{{ $appointment->user->id }}'>{{ $appointment->user->first_name }} {{ $appointment->user->last_name }}</a></td>
                                <td>{{ date('d F Y', strtotime($appointment->a_date)) }}</td>
                                <td>{{ $appointment->a_time }}</td>
                                <td>{{ $appointment->a_doctor }}</td>
                                <td>{{ $appointment->a_details }}</td>
                                <td>
                                        <form> <a type="button" data-id="edit-button" class="edit-btn btn btn-primary btn-xs user-profile-icon appointmentsEditButton" data-toggle="modal" data-appointment-id="{{ $appointment->id }}" data-doctor-id="{{ $appointment->a_doctor_id }}" data-patient-id="{{ $appointment->user->id }}" data-date="{{ $appointment->a_date }}" data-time="{{ $appointment->a_time }}" data-details="{{ $appointment->a_details }}" data-target="#appointmentsModal" @if(Auth::user()->user_type !== "staff") disable @endif > Edit </a> </form>
                                </td>
                                <td>
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['appointments.delete', $appointment->user->id, $appointment->id]]) }}
                                        {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection	

