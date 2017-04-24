<?php $appointments = Auth::user()->appointments; $user = Auth::user();  ?>

<div class="doctors-homepage">

    <!-- LEFT COLUMN -->

    <div class="col-md-7 left-column">
        <div class="col-md-12 personal-information-section">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        <h4>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h4>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Personal ID: </strong> {{ Auth::user()->id }}</p>
                        <p><strong>Email: </strong> {{ Auth::user()->email }}</p>
                        <p><strong>Phone: </strong> {{ Auth::user()->phone }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 highlights-section">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row highlights-row">
                        <div class="col-sm-12 col-md-4 highlight-item highlight-1 first active-prescriptions"><h2>{{ $totalNumberPatients }}</h2><h3>Total Number of Patients</h3></div>
                        <div class="col-sm-12 col-md-4 highlight-item highlight-2 unread-messages"><h2>0</h2><h3>Unread Messages</h3></div>
                        <div class="col-sm-12 col-md-4 highlight-item highlight-3 last repeat-prescriptions"><a href="" data-toggle="modal" data-target="#repeatPrescriptions"><div class="highlight-inner"><h2>{{ count($prescriptionRequests) }}</h2><h3>Pending Repeat Prescriptions</h3></div></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT COLUMN -->

    <div class="col-md-5 left-column">
        <div class="col-md-12  appointments-section">
            <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Appointments This Week</h3>
                </div>
                <div class="panel-body">
                    <div id='doctor-calendar-this-week'></div>  
                </div>
            </div>
        </div>
        <div class="col-md-12  prescriptions-section">
            <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Appointments Next Week</h3>
                </div>
                <div class="panel-body">
                    <div id='doctor-calendar-next-week'></div>  
                </div>
            </div>
        </div>
    </div>
</div>
    
<!-- Modal -->
<div class="modal fade" id="repeatPrescriptions" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Repeat Prescription Requests</h4>
            </div>
            <!-- Body -->
            <div class="modal-body">
                <div class="row padded">
                    <div class="col-md-12 prescriptionRequestsTable">
                    @if(count($prescriptionRequests))
                    @foreach ($prescriptionRequests as $prescription)
                    <div id="item-{{$prescription->id}}" class="prescriptionRequestRow">
                        <div class='col-sm-3 col-xs-6 table-column first'><div class="custom-row"><p><strong>Requested by:</strong><br>{{ $prescription->prescription->appointment->user->first_name }}  {{ $prescription->prescription->appointment->user->last_name }}</p></div></div>
                        <div class='col-sm-3 col-xs-6 table-column'><div class="custom-row"><p><strong>Medicine:</strong><br> {{ $prescription->prescription->p_name }}</p></div></div>
                        <div class='col-sm-2 col-xs-6 table-column'><div class="custom-row"><p><strong>Expiry date:</strong><br> {{ $prescription->prescription->p_expiry }}</p></div></div>
                        <div class='col-sm-2 col-xs-6 table-column'><div class="custom-row"><p><strong>Quantity:</strong><br> {{ $prescription->prescription->p_quantity }}</p></div></div>
                        <div class='col-sm-2 col-xs-12 table-column last'><div class="custom-row"><p>
                        <button
                        type="button"
                        data-patient_id="{{$prescription->prescription->appointment->user->id}}"
                        data-appointment_id="{{$prescription->prescription->appointment->id}}"
                        data-prescription_id="{{$prescription->prescription->id}}"
                        data-repeat_unit_id="{{$prescription->id}}"
                        class="btn btn-primary btn-block highlight-1 approve_repeat_request">Approve</button>
                        </p></div></div>
                    </div>
                    @endforeach
                    @else
                        <center><p>There are currently no repeat prescription requests.</p></center>
                    @endif
                    </div>
                </div>  
            </div>
            <!-- Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>