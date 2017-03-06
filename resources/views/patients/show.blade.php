@extends('layouts.master')

@section('content')
<div class="row padded">
  	<div class="col-md-4 user-left-container">
        @include('patients.sidebar')
	</div>
    <div class="col-md-8 user-right-container">

    

        <div class="row well">
            <h2 class="bold uppercase">Doctor Notes</h2>
                @include('helpers.note-modal')
                @if(count($user->notes))
                    @foreach ($user->notes as $note)
                        @if(isset($note->n_content))
                            <div class="well well-sm doctor-notes"> {{ $note->n_content }} </div>
                        @endif
                    @endforeach
                @else
                    <p>There are no added conditions for this patient.</p>
                @endif
        </div>
        <div class="row well">
            <h2 class="bold uppercase">Health Information</h2>
                <a href="/user/{{ $user->id }}/conditions/create" class="btn btn-success">Add Condition</a>
                @if(count($user->conditions))
                    @foreach ($user->conditions as $condition)
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <a class="panel-title" data-toggle="collapse" href="#{{ $condition->id }}">{{ $condition-> c_name }}</a>
                                    <i class="fa fa-pencil-square edit-icon" aria-hidden="true"></i>
                                </h3>
                            </div>
                            <div id="{{ $condition->id }}" class="panel-collapse collapse">
                                <ul class="list-group">
                                    <li class="list-group-item"><strong>Diagnosed at:</strong> {{ $condition-> c_diagnosed_at }} </li>
                                    <li class="list-group-item"><strong>Has it been treated?</strong> {{ $condition-> c_isTreated }}</li>
                                    @if(isset( $condition-> c_details ))
                                    <li class="list-group-item"><strong>Details:</strong> {{ $condition-> c_details}}</li> 
                                    @endif 
                            </div>
                        </div>
                    </div>  
                    @endforeach
                @else
                    <p>There are no added conditions for this patient.</p>
                @endif
        </div>
        <div class="row well">
            <h2 class="bold uppercase">Upcoming Appointments</h2>
            @if(count($user->appointments))
                <?php $appNum = 1; ?>
                @foreach ($user->appointments as $appointment)
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">
                            <a class="panel-title">Appointment {{ $appNum }}</a>
                            <i class="fa fa-pencil-square edit-icon" aria-hidden="true"></i>
                        </h3>

                      </div>
                      <div class="panel-body">
                        <strong>Date: </strong>{{ $appointment-> a_date }}<br>
                        <strong>Time: </strong>{{ $appointment-> a_time }}<br>
                        <strong>Details: </strong>{{ $appointment-> a_details }}
                      </div>
                    </div>
                    <?php $appNum = $appNum + 1; ?>
                @endforeach
            @else
                <p>There are no future appointments scheduled for this patient.</p>
            @endif
        </div>
        <div class="row well">
            <h2 class="bold uppercase">Prescriptions</h2>
            @if(count($user->appointments))
                @foreach ($user->appointments as $appointment)
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">Prescription Test Name</h3>
                      </div>
                      <div class="panel-body">
                        PRESCRIPTION TEST CONTENT
                      </div>
                    </div>
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