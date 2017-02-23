@extends('layouts.app')

@section('content')
	<center>
		{{ var_dump(Auth::user()->appointments()) }}
	</center>
@endsection	

