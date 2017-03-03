@extends('layouts.master')

@section('content')

<div class="row apponitments-controls">
    <div class="col-md-4 app-control-item-container">
     <a href="./appointments/create" class="btn btn-success btn-block" role="button">Create New Appointment</a>
 </div>
 <div class="col-md-4 app-control-item-container">
     <a href="./appointments/search" class="btn btn-primary btn-block disabled" role="button">Find Appointment</a>
 </div>
 <div class="col-md-4 app-control-item-container"></div>
</div>
<div class="row appointments-list">
    <table class="table table-sm table-bordered table-hover appointments-table">
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
@endsection	

