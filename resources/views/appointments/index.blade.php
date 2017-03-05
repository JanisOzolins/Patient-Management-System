@extends('layouts.master')

@section('content')
<div class="container-fluid appointments-page">
    <div class="row">
        <h2 class="uppercase bold center">Appointments</h2>
    </div>
    <div class="row apponitments-controls">
        <div class="col-md-4 app-control-item-container">
            <a href="./appointments/create" class="btn btn-success btn-block" role="button">Create New Appointment</a>
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
                        <th class="col-md-1">Patient</th>
                        <th class="col-md-2">First Name</th>
                        <th class="col-md-2">Last Name</th>
                        <th class="col-md-1">Date</th>
                        <th class="col-md-1">Time</th>
                        <th class="col-md-3">Notes</th>
                        <th class="col-md-1">Edit</th>
                        <th class="col-md-1">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    @foreach ( $user->appointments as $app)
                    <tr>
                        <td>
                            <a href='./user/{{ $app->user->id }}'>Profile</a>
                        </td>
                        <td>{{ $app->user->first_name }}</td>
                        <td>{{ $app->user->last_name }}</td>
                        <td>{{ $app->a_date }}</td>
                        <td>{{ $app->a_time }}</td>
                        <td>{{ $app->a_details }}</td>
                        <td>
                            <a href="/user/{{ $app->user->id }}/appointments/{{ $app->id }}/edit" method="GET" class="btn btn-primary btn-sm">Edit</a>
                        </td>
                        <td>
                            {{ Form::open(['method' => 'DELETE', 'route' => ['appointments.delete', $app->user->id, $app->id]]) }}
                                {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}
                            {{ Form::close() }}
                        </td>
                    </tr>
                    @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection	

