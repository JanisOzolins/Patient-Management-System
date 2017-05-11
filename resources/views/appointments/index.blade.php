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
            <div class="app-list-row">
                            <div class="app-list-col header first col-sm-2">Patient</div>
                            <div class="app-list-col header col-sm-1">Date</div>
                            <div class="app-list-col header col-sm-1">Time</div>
                            <div class="app-list-col header col-sm-2">Doctor</div>
                            <div class="app-list-col header col-sm-4">Notes</div>
                            <div class="app-list-col header col-sm-1">Edit</div>
                            <div class="app-list-col header col-sm-1">Delete</div>
            </div>
                @foreach ( $allAppointments->sortByDesc('datetime') as $appointment)
                    @if( $appointment->datetime > date("Y-m-d H:i:s") || Auth::user()->user_type === "manager")
                        <div class="app-list-row">
                            <div class="app-list-col app-list-item col-sm-2 first"><a href='./user/{{ $appointment->user->id }}'>{{ $appointment->user->first_name }} {{ $appointment->user->last_name }}</a></div>
                            <div class="app-list-col app-list-item col-sm-1">{{ date('d F Y', strtotime($appointment->a_date)) }}</div>
                            <div class="app-list-col app-list-item col-sm-1">{{ $appointment->a_time }}</div>
                            <div class="app-list-col app-list-item col-sm-2">{{ $appointment->a_doctor }}</div>
                            <div class="app-list-col app-list-item col-sm-4">{{ $appointment->a_details }}</div>
                            <div class="app-list-col app-list-item col-sm-1">
                                    <form> <a type="button" data-id="edit-button" class="edit-btn btn btn-primary btn-xs appointmentsEditButton" data-toggle="modal" data-appointment-id="{{ $appointment->id }}" data-doctor-id="{{ $appointment->a_doctor_id }}" data-patient-id="{{ $appointment->user->id }}" data-date="{{ $appointment->a_date }}" data-time="{{ $appointment->a_time }}" data-details="{{ $appointment->a_details }}" data-target="#appointmentsModal" @if(Auth::user()->user_type !== "staff") disable @endif > Edit </a> </form>
                            </div>
                            <div class="app-list-col app-list-item col-sm-1 last">
                                {{ Form::open(['method' => 'DELETE', 'route' => ['appointments.delete', $appointment->user->id, $appointment->id]]) }}
                                    {{ Form::submit('Delete', ['class' => 'btn edit-btn btn-danger btn-xs appointmentsDeleteButton']) }}
                                {{ Form::close() }}
                            </div>
                        </div>
                    @endif
                @endforeach
        </div>
    </div>
</div>
@endsection	

