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
    @if(count($users) > 0)
    <div class="row">
        <div class="patients-list col-md-12">
            <div class="app-list-row">
                <div class="app-list-col header first col-md-1">See Profile</div>
                <div class="app-list-col header col-md-2">First Name</div>
                <div class="app-list-col header col-md-2">Last Name</div>
                <div class="app-list-col header col-md-2">Date of Birth</div>
                <div class="app-list-col header col-md-2">Email</div>
                <div class="app-list-col header col-md-2">Phone</div>
                <div class="app-list-col header last col-md-1">Edit</div>
            </div>
            @foreach ($users as $user)
            @if ($user->user_type === "patient")
                <div class="app-list-row">
                    <div class="app-list-col app-list-item col-sm-1 first">
                        <p><a href='./user/{{ $user->id }}'>Profile</a></p>
                    </div>
                    <div class="app-list-col app-list-item col-sm-2"><p>{{ $user->first_name }}</p></div>
                    <div class="app-list-col app-list-item col-sm-2"><p>{{ $user->last_name }}</p></div>
                    <div class="app-list-col app-list-item col-sm-2"><p>{{ date('d F Y', strtotime($user->birth_date)) }}</p></div>
                    <div class="app-list-col app-list-item col-sm-2"><p>{{ $user->email }}</p></div>
                    <div class="app-list-col app-list-item col-sm-2"><p>{{ $user->phone }}</p></div>
                    <div class="app-list-col app-list-item col-sm-1 last">
                        <p><a href="{{ URL::to('/edit-profile/' . $user->id ) }}" class="btn patientsEditBtn btn-primary btn-xs">Edit</a></p>
                    </div>
                </div>
            @endif
            @endforeach

        {{ $users->links() }}

    </div>
    </div>
    @else
        <center><p style=" padding: 25px; background: white; border: solid 1px gray;">Sorry, nothing was found! 
        @if($q !== NULL)
        <br>Click <a href="{{ URL::to('/patients') }}">HERE</a> to show all patients, or search again!</p></center>
        @endif
    @endif

</div>
@endsection	

