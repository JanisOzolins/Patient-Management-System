@extends('layouts.master')

@section('content')
<div class="row padded profile-page">
  	<div class="col-md-3 user-left-container">
        @include('patients.sidebar')
	</div>
    <div class="col-md-6 user-middle-container user-notes">
        @if (Route::current()->getName() === 'patients.show')  
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#notes-tab-pane" aria-controls="notes-tab-pane" role="tab" data-toggle="tab">General Notes</a></li>
                <li role="presentation"><a href="#appointments-tab-pane" aria-controls="appointments-tab-pane" role="tab" data-toggle="tab">Appointments History</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="notes-tab-pane">@include('helpers.notes')</div>
                <div role="tabpanel" class="tab-pane fade" id="appointments-tab-pane">@include('helpers.appointments-list')</div>
            </div>
        @elseif (Route::current()->getName() === 'appointments.show')  
            @include('helpers.appointments-show')
        @else
            Nada
        @endif
    </div>
    <div class="col-md-3 user-right-container">
        <div class="row well user-conditions">
            <h2 class="bold uppercase">Conditions</h2>
            @include('helpers.conditions')        
        </div>
        <div class="row well user-appointments">
            <h2 class="bold uppercase">Appointments</h2>
            @include('helpers.appointments-btn')
            @include('helpers.appointments')
        </div>
        <div class="row well user-prescriptions">
            <h2 class="bold uppercase">Prescriptions</h2>
            @include('helpers.prescriptions-all')
        </div>
    </div>
</div>
@endsection	
@section('page-script')
<script>
$('#appointmentsModal').on('show.bs.modal', function(e) {
    var appid = $(e.relatedTarget).data('appointment-id');
    var patientid = $(e.relatedTarget).data('patient-id');
    var date = $(e.relatedTarget).data('date');
    var time = $(e.relatedTarget).data('time');
    var details = $(e.relatedTarget).data('details');

    $("#a_app_id").val(appid); // hidden
    // $("#a_patient_id").val(patientid); // hidden
    $("#a_date").val(date);
    $("#a_time").val(time);
    $("#a_details").val(details);


    // var $patient = $("#a_patient_id");
    // var $patientLabel = $("#a_patient_id_label");
    // $patient.hide();
    // $patientLabel.hide();
});
$('#conditionsModal').on('show.bs.modal', function(e) {
    var conid = $(e.relatedTarget).data('condition-id');
    var patientid = $(e.relatedTarget).data('patient-id');
    var name = $(e.relatedTarget).data('name');
    var diagnosed = $(e.relatedTarget).data('diagnosed');
    var treated = $(e.relatedTarget).data('treated');
    var details = $(e.relatedTarget).data('details');

    $("#c_condition_id").val(conid); // hidden
    $("#c_patient_id").val(patientid); // hidden
    $("#c_name").val(name);
    $("#c_diagnosed_at").val(diagnosed);
    $("#c_isTreated").val(treated);
    $("#c_details").val(details);


    // var $patient = $("#a_patient_id");
    // var $patientLabel = $("#a_patient_id_label");
    // $patient.hide();
    // $patientLabel.hide();
});
$('#prescriptionsModal').on('show.bs.modal', function(e) {
    var prescriptionid = $(e.relatedTarget).data('prescription-id');
    var appid = $(e.relatedTarget).data('appointment-id');
    var patientid = $(e.relatedTarget).data('patient-id');
    var name = $(e.relatedTarget).data('name');
    var condition = $(e.relatedTarget).data('condition');
    var active = $(e.relatedTarget).data('active');
    var expiry = $(e.relatedTarget).data('expiry');
    var repeat = $(e.relatedTarget).data('repeat');
    var controlled = $(e.relatedTarget).data('controlled');
    var details = $(e.relatedTarget).data('details');

    $("#prescription_id").val(prescriptionid); // hidden
    $("#patient_id").val(patientid); // hidden
    $("#appointment_id").val(appid); // hidden
    $("#p_name").val(name);
    $("#p_condition").val(condition);
    $("#p_active").val(active);
    $("#p_expiry").val(expiry);
    $("#p_repeat").val(repeat);
    $("#p_controlled").val(controlled);
    $("#p_details").val(details);

    $("input[name=p_controlled][value=" + controlled + "]").prop('checked', true);
    $("input[name=p_repeat][value=" + repeat + "]").prop('checked', true);

    // var $patient = $("#p_patient_id");
    // var $patientLabel = $("#p_patient_id_label");
    // $patient.hide();
    // $patientLabel.hide();
});
</script>
@endsection