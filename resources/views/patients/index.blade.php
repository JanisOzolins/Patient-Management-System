@extends('layouts.master')

@section('content')
<div class="container-fluid patients-page">
    <div class="row">
        <h2 class="uppercase bold center">Patients</h2>
    </div>
    <div class="row patients-controls">
        <div class="col-md-4 patients-control-item-container">
           @include('patients.add')
        </div>
        <div class="col-md-8 patients-control-item-container">
            @include('patients.search')
        </div>
    </div>
    <div class="row patients-list">
        <table class="table table-responsive table-sm table-bordered table-hover patients-table">
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
            @if ($user->user_type === "patient")
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
                        <a href="{{ URL::to('/edit-profile/' . $user->id ) }}" class="btn btn-primary btn-sm">Edit</a>
                    </td>
                </tr>
            @endif
            @endforeach

        {{ $users->links() }}
        </tbody>
    </table>
    </div>
</div>
@endsection	

