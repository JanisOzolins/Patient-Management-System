<div class="container-fluid patients-homepage">
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard
                </li>
            </ol>
        </div>
    </div>
    <div class="col-md-8">
    </div>
    <div class="col-md-4">
        <h3>Your Upcoming Appointments </h3>
        <?php $appointments = Auth::user()->appointments ?>
        @include('helpers.appointments')
        <h3>Prescriptions ending in 7 days</h3>
        @foreach( Auth::user()->appointments as $appointment )
            @foreach ($appointment->prescriptions as $prescription)
            @if ($prescription->p_repeat === "Yes")
                @if(count($prescription->repeatUnits) > 0)
                    @if( $prescription->repeatUnits->last()->repeat_expiry <= Carbon\Carbon::now()->addDays(31)->format('Y-m-d'))
                            <div class="panel panel-default">
                                <div class="panel-heading"><h3 class="panel-title">{{ $prescription->p_name }}</h3></div>
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