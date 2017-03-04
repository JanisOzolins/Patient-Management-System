@extends('layouts.master')

@section('content')

<div class="row apponitments-controls">
    <div class="col-md-4 app-control-item-container">
       <a href="./register" class="btn btn-success btn-block" role="button">Add New Patient</a>
    </div>
    <div class="col-md-8 app-control-item-container">
        @include('patients.search')
    </div>
</div>
<div class="row appointments-list">
    <table class="table table-sm table-bordered table-hover appointments-table">
        <thead>
          <tr>
            <th class="col-md-1">See Profile</th>
            <th class="col-md-2">First Name</th>
            <th class="col-md-2">Last Name</th>
            <th class="col-md-1">Date of Birth</th>
            <th class="col-md-1">Email</th>
            <th class="col-md-3">Phone</th>
            <th class="col-md-1">Edit</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>
                <a href='./user/{{ $user->id }}'>Profile</a>
            </td>
            <td>{{ $user->first_name }}</td>
            <td>{{ $user->last_name }}</td>
            <td>{{ $user->birth_date }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>
                <a href="#" method="GET" class="btn btn-primary btn-sm">Edit</a>
            </td>
        </tr>
        @endforeach

    {{ $users->links() }}
    </tbody>
</table>
</div>
@endsection	

