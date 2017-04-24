<?php $appointments = Auth::user()->appointments; $user = Auth::user();  ?>

<div class="patients-homepage">

    <!-- LEFT COLUMN -->

    <div class="col-md-7 left-column">
        <div class="col-md-12 personal-information-section">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        <h4>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h4>
                    </div>
                    <div class="col-md-5">
                        <p><strong>Patient ID: </strong> {{ Auth::user()->id }}</p>
                        <p><strong>Gender: </strong>{{ Auth::user()->gender }}</p>
                        <p><strong>Age: </strong>{{ Auth::user()->age }}</p>
                    </div>
                    <div class="col-md-7">
                        <p><strong>Address: </strong> {{ Auth::user()->address }}</p>
                        <p><strong>Email: </strong> {{ Auth::user()->email }}</p>
                        <p><strong>Phone: </strong> {{ Auth::user()->phone }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 shortcuts-section">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row shortcuts-row">
                        <div class="col-md-12">@include('helpers.appointments-btn')</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-12 highlights-section">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row highlights-row">
                        <div class="col-sm-12 col-md-4 highlight-item highlight-1 first active-prescriptions"><h2>{{ $activePrescriptions }}</h2><h3>Active Prescriptions</h3></div>
                        <div class="col-sm-12 col-md-4 highlight-item highlight-2 unread-messages"><h2>0</h2><h3>Unread Messages</h3></div>
                        <div class="col-sm-12 col-md-4 highlight-item highlight-3 last unread-messages"><h2>{{ $diagnoses }}</h2><h3>Health Conditions</h3></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT COLUMN -->

    <div class="col-md-5 left-column">
        <div class="col-md-12  appointments-section">
            <div class="panel panel-default">
                <div class="panel-body"><div id='patient-appointments-calendar'></div></div>
            </div>
        </div>
        <div class="col-md-12  prescriptions-section">

        @foreach( Auth::user()->appointments as $appointment )
            @foreach ($appointment->prescriptions as $prescription)
            @if ($prescription->p_repeat === "Yes")
                @if(count($prescription->repeatUnits) > 0)
                    @if( $prescription->repeatUnits->last()->repeat_expiry <= Carbon\Carbon::now()->addDays(7)->format('Y-m-d'))
                            <div class="panel panel-default">
                                <div class="panel-heading"><h3 class="panel-title">{{ $prescription->p_name }} 
                                <button type="button" class="btn btn-primary btn-xs highlight-3">Ending Soon</button>
                                <button id="repeat_reorder" 
                                data-prescription_name="{{ $prescription->p_name }}" 
                                data-patient_id="{{ $prescription->appointment->user->id }}" 
                                data-appointment_id="{{ $prescription->appointment->id }}" 
                                data-prescription_id="{{ $prescription->id }}" 
                                type="button" 
                                class="btn btn-primary btn-xs highlight-1">Reorder</button>
                                </h3></div>
                                <div class="panel-body">
                                @if( $prescription->repeatUnits->last()->repeat_expiry !== $prescription->p_expiry)
                                    <p class="list-group-item-text">You can reorder this medication now, and it will become available from <strong>{{ $prescription->repeatUnits->last()->repeat_expiry }}</strong>.</p>
                                @else
                                    <p class="list-group-item-text">Your repeat prescription will expire on <strong>{{ $prescription->repeatUnits->last()->repeat_expiry }}</strong>. Please make an appointment should you wish to have this prescription reviewed by the doctor.</p>
                                @endif
                                </div>
                            </div>
                    @endif
                @endif
            @elseif(($prescription->p_repeat === "No") && ($prescription->p_expiry < Carbon\Carbon::now()->addDays(365)->format('Y-m-d')))
                
            @endif
            @endforeach
        @endforeach
    </div>
    </div>
</div>
    





<!-- 

    <div class="">
        <div class="row">
        </div>
    </div>
    <div class="col-md-5 middle-column">
    </div>
    <div class="col-md-4 right-column">
</div> -->