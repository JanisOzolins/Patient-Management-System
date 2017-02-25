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
		<td>{{ $app->a_patient }}</td>
        <td>{{ $app->a_patient }}</td>
        <td>{{ $app->a_date }}</td>
        <td>{{ $app->a_time }}</td>
        <td>{{ $app->a_details }}</td>
        <td>Link</td>
    </tr>
	@endforeach
@endforeach
    </tbody>
  </table>
@endsection	

