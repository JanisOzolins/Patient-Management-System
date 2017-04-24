@extends('layouts.master')

@section('content')
<div class="row padded profile-page">
    <div class="col-md-9 user-middle-container user-notes">
        @if (Route::current()->getName() === 'patients.show')  
            <ul class="nav nav-tabs user-profile-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#appointments-tab-pane" aria-controls="appointments-tab-pane" role="tab" data-toggle="tab">Appointments</a></li>
                <li role="presentation"><a href="#notes-tab-pane" aria-controls="notes-tab-pane" role="tab" data-toggle="tab">General Notes</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in appointments-tab active" id="appointments-tab-pane">@include('helpers.appointments-list')</div>
                <div role="tabpanel" class="tab-pane fade" id="notes-tab-pane"></div>
            </div>
        @elseif (Route::current()->getName() === 'appointments.show')  
            <a href="{{ URL::to('/user/' . $user->id )}}" type="button" class="btn-return-user-profile button btn btn-default">Go Back</a>
            @include('helpers.appointments-show')
        @else
            Nada
        @endif
    </div>
    <div class="col-md-3 user-right-container">
        <div class="row well user-info">
            @include('helpers.patient-info')        
        </div>
        <div class="row well user-conditions">
            <h2 class="bold uppercase">Conditions</h2>
            @include('helpers.conditions')        
        </div>
        <div class="row well user-appointments">
            <h2 class="bold uppercase">Upcoming Appointments</h2>
            @if(Auth::user()->user_type === "nurse" || Auth::user()->user_type === "doctor")
                @include('helpers.appointments-btn')
            @endif
            @include('helpers.appointments')
        </div>
        <div class="row well user-prescriptions">
            <h2 class="bold uppercase">Prescriptions</h2>
            <?php $presNum = 0; ?>
            @foreach( $appointments as $appointment)
                    @foreach ($appointment->prescriptions()->sortByDesc('updated_at') as $prescription)
                    <?php $presNum++ ?>
                        @include('helpers.prescriptions-panel')
                    @endforeach
            @endforeach
            @if ($presNum === 0)
                <p>There are no added prescriptions for this patient.</p>
            @endif
        </div>
    </div>
</div>
@endsection