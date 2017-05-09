@extends('layouts.master')

@section('content')
<div class="row padded profile-page">
    <div class="col-md-9 user-middle-container user-notes">
            <ul class="nav nav-tabs user-profile-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#appointments-tab-pane" aria-controls="appointments-tab-pane" role="tab" data-toggle="tab">Appointments</a></li>
                <li role="presentation"><a href="#notes-tab-pane" aria-controls="notes-tab-pane" role="tab" data-toggle="tab">General Notes</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in appointments-tab active" id="appointments-tab-pane">@include('helpers.appointments-list')</div>
                <div role="tabpanel" class="tab-pane fade" id="notes-tab-pane">
                    <p style="margin-top: 20px; padding: 25px; text-align: center; border: #3f51b5 solid 0px; background: #3F51B5; color: white;">In this section you can add general notes related to the patient or his/hers appointments. Do <strong><u>NOT</u></strong> post any health-related or confidential information in this section. Appointment notes can be left on each individual appointment page.</p>
                    @include('generalnotes.form')
                    @include('generalnotes.notes')
                </div>
            </div>
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
            @if( Route::current()->getName() !== 'appointments.show' )
                @if(Auth::user()->user_type === "nurse" || Auth::user()->user_type === "doctor")
                    @include('helpers.appointments-btn')
                @endif
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