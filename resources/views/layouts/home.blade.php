@extends('layouts.master')

@section('content')
	@if (Auth::user()->user_type === "doctor")
		@include('doctors.home')
	@elseif (Auth::user()->user_type === "staff")
		@include('staff.home')
	@elseif (Auth::user()->user_type === "manager")
		@include('managers.home')
	@elseif (Auth::user()->user_type === "patient")
		 @include('patients.home')
	@endif
@endsection

@section('page-scripts')
@endsection