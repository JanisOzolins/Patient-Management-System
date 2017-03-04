@extends('layouts.master')

@section('content')
<div class="row">
  	<div class="col-md-4  user-left-container">
        @include('patients.sidebar')
	</div>
    <div class="col-md-8  user-right-container">
        <div class="well">
            <h2 class="bold uppercase">Health Information</h2>
            @if(count($user->conditions))
                @foreach ($user->conditions as $condition)
                    {{ $condition-> a_date }} --- {{ $condition-> a_time }} --- {{ $condition-> a_details }}
                @endforeach
            @else
                <p>There are no future appointments scheduled for this patient.</p>
            @endif
        </div>
        <div class="well">
            <h2 class="bold uppercase">Upcoming Appointments</h2>
            @if(count($user->appointments))
                @foreach ($user->appointments as $appointment)
                    {{ $appointment-> a_date }} --- {{ $appointment-> a_time }} --- {{ $appointment-> a_details }}
                @endforeach
            @else
                <p>There are no future appointments scheduled for this patient.</p>
            @endif
        </div>
        <div class="well">
            <h2 class="bold uppercase">Prescriptions</h2>
            @if(count($user->appointments))
                @foreach ($user->appointments as $appointment)
                    {{ $appointment-> a_date }} --- {{ $appointment-> a_time }} --- {{ $appointment-> a_details }}
                @endforeach
            @else
                <p>There are no future appointments scheduled for this patient.</p>
            @endif
        </div>
    </div>
</div>
<div style="text-align: center" class="col-md-4">
<!-- 
	<img class="img-thumbnail" src="http://placehold.it/300x300" alt="">
	<h3>{{ $user->first_name }} {{ $user->last_name }}</h3>
	<div class="well appointment-info"><h2>{{ $user->birth_date }} </h2></div>
	<div class="well appointment-info"><h2><b>Time: </b>{{ $user->email }} </h2></div>   --> 
</div>
@endsection	