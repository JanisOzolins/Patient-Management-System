@extends('layouts.master')

@section('content')
<div style="margin-top: 40px;" class="container-fluid users-page">
	<div class="col-md-10 col-md-offset-1">
		<div style="margin-bottom: 30px;" class="row">
			<div class="col-md-3">
				@include('patients.add')
			</div>
			<div class="col-md-12">
				<form method="GET" role="search">
				    {{ csrf_field() }}
				    <div style="margin: 20px 0;" class="input-group">
				        <input type="text" class="form-control" name="q" value="{{ $q }}"
				            placeholder="Search Users"> <span class="input-group-btn">
				            <button type="submit" class="btn btn-default">
				                <span class="glyphicon glyphicon-search"></span>
				            </button>
				        </span>
				    </div>
				<label>Search:</label>
				<label class="radio-inline">
				  <input type="radio" name="searchUsers" id="searchUsersAll"  value="all" @if($type === "all" || $type === "" || $type === null) checked @endif> All
				</label>
				<label class="radio-inline">
				  <input type="radio" name="searchUsers" id="searchUsersPatients" value="patient" @if($type === "patient") checked @endif> Patients
				</label>
				<label class="radio-inline">
				  <input type="radio" name="searchUsers" id="searchUsersDoctors" value="doctor" @if($type === "doctor") checked @endif> Doctors
				</label>
				<label class="radio-inline">
				  <input type="radio" name="searchUsers" id="searchUsersNurses" value="nurse" @if($type === "nurse") checked @endif> Nurses
				</label>
				<label class="radio-inline">
				  <input type="radio" name="searchUsers" id="searchUsersStaff" value="staff" @if($type === "staff") checked @endif> Staff
				</label>
				</form>
			</div>
		</div>
	    <div class="row">
			<div class="col-md-12">
				@if(count($users) > 0)
				<div class="app-list-row">
					<div class="col-sm-2 app-list-col header first">
						First Name
					</div>
					<div class="col-sm-2 app-list-col header">
						Last Name
					</div>
					<div class="col-sm-2 app-list-col header">
						Date of Birth
					</div>
					<div class="col-sm-2 app-list-col header">
						Phone
					</div>
					<div class="col-sm-2 app-list-col header">
						Email
					</div>
					<div class="col-sm-1 app-list-col header">
						Role
					</div>
					<div class="col-sm-1 app-list-col header">
						Edit
					</div>
				</div>
				@foreach($users as $user)
						<div class="app-list-row">
							<div class="col-sm-2 app-list-col app-list-item first">
								<p>{{ $user->first_name }}</p>
							</div>
							<div class="col-sm-2 app-list-col app-list-item">
								<p>{{ $user->last_name }}</p>
							</div>
							<div class="col-sm-2 app-list-col app-list-item">
								<p>{{ str_replace("-"," ", date('d-F-Y', strtotime($user->birth_date))) }}</p>
							</div>
							<div class="col-sm-2 app-list-col app-list-item">
								<p>{{ $user->phone }}</p>
							</div>
							<div class="col-sm-2 app-list-col app-list-item">
								<p>{{ $user->email }}</p>
							</div>
							<div class="col-sm-1 app-list-col app-list-item">
								<p>{{ ucwords($user->user_type) }}</p>
							</div>
							<div class="col-sm-1 app-list-col app-list-item last">
								<p><a href="{{ URL::to('/edit-profile/' . $user->id ) }}" class="btn btn-primary btn-sm edit-user-profile-btn">Edit</a></p>
							</div>
						</div>
				@endforeach
				@else
				<p>No users matching this criteria were found!</p>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection