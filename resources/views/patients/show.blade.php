@extends('layouts.master')

@section('content')
<div class="row padded profile-page">
  	<div class="col-md-4 user-left-container">
        @include('patients.sidebar')
	</div>
    <div class="col-md-6 user-middle-container user-notes">
        @include('helpers.notes-btn')
        @include('helpers.notes')

    </div>
    <div class="col-md-2 user-right-container">
        <div class="row well user-conditions">
            <h2 class="bold uppercase">Health Information</h2>
                @include('helpers.conditions-btn')
                @include('helpers.conditions')
                    
        </div>
        <div class="row well user-appointments">
            <h2 class="bold uppercase">Upcoming Appointments</h2>
            @include('helpers.appointments-btn')
            @include('helpers.appointments')
        </div>
        <div class="row well user-prescriptions">
            @include('helpers.prescriptions-btn')
            @include('helpers.prescriptions')
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
    $("#a_patient_id").val(patientid); // hidden
    $("#a_date").val(date);
    $("#a_time").val(time);
    $("#a_details").val(details);


    var $patient = $("#a_patient_id");
    var $patientLabel = $("#a_patient_id_label");
    $patient.hide();
    $patientLabel.hide();
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


    var $patient = $("#a_patient_id");
    var $patientLabel = $("#a_patient_id_label");
    $patient.hide();
    $patientLabel.hide();
});
$('#prescriptionsModal').on('show.bs.modal', function(e) {
    var prescriptionid = $(e.relatedTarget).data('prescription-id');
    var patientid = $(e.relatedTarget).data('patient-id');
    var name = $(e.relatedTarget).data('name');
    var condition = $(e.relatedTarget).data('condition');
    var active = $(e.relatedTarget).data('active');
    var expiry = $(e.relatedTarget).data('expiry');
    var repeat = $(e.relatedTarget).data('repeat');
    var controlled = $(e.relatedTarget).data('controlled');
    var details = $(e.relatedTarget).data('details');

    $("#p_prescription_id").val(prescriptionid); // hidden
    $("#p_patient_id").val(patientid); // hidden
    $("#p_name").val(name);
    $("#p_condition").val(condition);
    $("#p_active").val(active);
    $("#p_expiry").val(expiry);
    $("#p_repeat").val(repeat);
    $("#p_controlled").val(controlled);
    $("#p_details").val(details);


    var $patient = $("#p_patient_id");
    var $patientLabel = $("#p_patient_id_label");
    $patient.hide();
    $patientLabel.hide();
});
</script>
@endsection