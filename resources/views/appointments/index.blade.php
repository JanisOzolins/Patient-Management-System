@extends('layouts.master')

@section('content')
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
        <td><a href='./user/{{ $app->user->id }}'>Profile</a></td>
		<td>{{ $app->user->first_name }}</td>
        <td>{{ $app->user->last_name }}</td>
        <td>{{ $app->a_date }}</td>
        <td>{{ $app->a_time }}</td>
        <td>{{ $app->a_details }}</td>
        <td>Edit</td>
        <td>Delete</td>
    </tr>
	@endforeach
@endforeach
    </tbody>
  </table>
@endsection	

