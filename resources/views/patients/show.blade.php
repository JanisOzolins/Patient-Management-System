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
                <div role="tabpanel" class="tab-pane fade in active" id="appointments-tab-pane">@include('helpers.appointments-list')</div>
                <div role="tabpanel" class="tab-pane fade" id="notes-tab-pane"></div>
            </div>
        @elseif (Route::current()->getName() === 'appointments.show')  
            <a href="{{ URL::to('/user/' . $user->id )}}" type="button" class="btn-return-user-profile button btn btn-default">Return to patient's profile</a>
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
    if($(e.relatedTarget).data('id') === "edit-button") {
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



    }
    if($(e.relatedTarget).data('id') === "new-button") {
        $("#a_app_id").val(""); // hidden
        $("#a_date").val("");
        $("#a_time").val("");
        $("#a_details").val("");
    }
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

@if(Session::has('errors'))
    <script>
    $(document).ready(function(){
        $('#appointmentsModal').modal('show')
    });
    </script>
@endif 

<script type="text/javascript">
    $(document).ready(function() {
           $('#a_date').on('change', function(e){
            var doctor_id = $('#a_doctor_id').val();
            var date = $('#a_date').val();
            if(doctor_id && date) {
                
                $.ajax({
                    url: '/myform/ajax/'+doctor_id+'/'+date,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        //if there are no free timeslots left
                        if( data.length === 0 ) {
                            $('select[name="a_time"]').empty();
                            $('select[name="a_time"]').append('<option value="" disabled selected>There are no available appointments for the chosen date!</option>');
                            $("#a_time").prop("disabled", true);
                        }
                        //if there are any timeslots available that day
                        else {
                            $("#a_time").prop("disabled", false);
                            $('select[name="a_time"]').empty();
                            $('select[name="a_time"]').append('<option value="" disabled selected>Select your option</option>');
                        $.each(data, function(key, value) {
                            $('select[name="a_time"]').append('<option value="'+ value +'">'+ value +'</option>');
                        });

                        }

                    }
                });
            }else{
                $('#a_time').empty();
            }
        });
    });
</script>
@endsection