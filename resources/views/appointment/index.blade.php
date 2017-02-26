@extends('layouts.app')

@section('content')
		<table class="table table-hover">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Date</th>
        <th>Time</th>
        <th>Notes</th>
        <th>User Profile</th>
      </tr>
    </thead>
    <tbody>

@foreach ($users as $user)
	@foreach ( $user->appointments as $app)
	<tr>
		<td>{{ $app->user->first_name }}</td>
        <td>{{ $app->user->last_name }}</td>
        <td>{{ $app->a_date }}</td>
        <td>{{ $app->a_time }}</td>
        <td>{{ $app->a_details }}</td>
        <td><a href='./appointments/{{ $app->user->id }}/{{ $app->id }}/'>See details</a></td>
    </tr>
	@endforeach
@endforeach
    </tbody>
  </table>
@endsection	

