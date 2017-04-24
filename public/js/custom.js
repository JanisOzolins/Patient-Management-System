$(document).ready(function() {
  ///////////////////////////////////////////
  //////// CALENDARS
  ///////////////////////////////////////////
  $('#doctor-calendar-this-week').fullCalendar({
      header: false,
      defaultView: "listWeek",
      weekends: false,
      events: '/appointments/doctor-this-week'
  });

  var today = new Date();

  var nextweek = today.setDate(today.getDate() + 7); 

  $('#doctor-calendar-next-week').fullCalendar({
      defaultDate: nextweek,   
      header: false,
      defaultView: "listWeek",
      weekends: false,
      events: '/appointments/doctor-next-week'
  });

  $('#patient-appointments-calendar').fullCalendar({
      timeFormat: 'HH:mm',
      header: false,
      weekends: false,
      defaultView: "listYear",
      events: '/appointments/patient-overview'
  });

  ///////////////////////////////////////////
  //////// PRESCRIPTIONS FORM
  ///////////////////////////////////////////

  if($('div').is('.prescriptions-container')){
    document.getElementById('p_expiry_group').style.display = 'none';
    document.getElementById('p_repeat_group').style.display = 'none';

    // when "p_controlled" field is changed
    document.getElementById('p_controlled').onchange = function () {
    var selectedValue = this.options[this.selectedIndex].value;

      if (selectedValue == "Yes") { 
        document.getElementById('p_repeat_group').style.display = 'none';
      }
      if (selectedValue == "No") { 
        document.getElementById('p_repeat_group').style.display = '';
      }
    };

    // when "p_repeat" field is changed
    document.getElementById('p_repeat').onchange = function () {
      var selectedValue = this.options[this.selectedIndex].value;

      if (selectedValue == "No") { 
        document.getElementById('p_expiry_group').style.display = 'none';
      }
      if (selectedValue == "Yes") { 
        document.getElementById('p_expiry_group').style.display = '';
      }
    };
  }

  ///////////////////////////////////////////
  //////// AVAILABLE APPOINTMENT DATES
  ///////////////////////////////////////////

  var array = [];

  $("#a_doctor_id").on('change', function() {
    $('#a_date').val("");
    $('select[name="a_time"]').empty();
    $("#a_time").prop("disabled", true);
    var doctor_id = $('#a_doctor_id').val();
    var app_id = $('#a_app_id').val();
    console.log("Output: " + app_id);
    if (doctor_id !== null && !app_id) {
      $("#a_date").prop("disabled", false);
      $('#a_date').attr('placeholder','Choose a date');
    } 
    var promise = getAvailableDates(doctor_id);
    promise.done( function(data) {
      //console.log(data);
      var array = data;
       $("#a_date").datepicker("destroy");
      $('#a_date').datepicker({
         dateFormat: "yy-mm-dd",
         beforeShowDay: function (date) {      
            var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
            return [array.indexOf(string) >= 0 ]
         }
      });

    });
  });

  function getAvailableDates(doctor_id) {
      return $.ajax({
        url: '/getDoctorsAppointments/' + doctor_id +'/',
        type: "GET",
        dataType: "json"
      }); 
  }

  ////////////////////////////////////////////////////
  //////// DOCTOR SCHEDULES PAGE  
  ////////////////////////////////////////////////////


  $("#submit_select_schedule").click(function(){
    var doctor_id = $('#schedule_select_doctor').val();

    window.location.href = "./user/" + doctor_id + "/schedule";
  });


  ////////////////////////////////////////////////////
  //////// REPEAT PRESCRIPTIONS - ORDER AND APPROVE  
  ////////////////////////////////////////////////////

  function sendPrescriptionRequest(patient_id, appointment_id, prescription_id) {
    var token = $('meta[name=csrf-token]').attr('content');
    $.post('/sendPrescriptionRequest', {
         _token: token,
         patient_id: patient_id,
         appointment_id: appointment_id,
         prescription_id: prescription_id
     }
    )
    .done(function(data) {
        console.log("OK");
    })
    .fail(function() {
        console.log("ERROR");
    });
  }

  function approveRepeatRequest(patient_id, appointment_id, prescription_id, repeat_unit_id) {
    var token = $('meta[name=csrf-token]').attr('content');
    $.post('/approveRepeatRequest', {
         _token: token,
         patient_id: patient_id,
         appointment_id: appointment_id,
         prescription_id: prescription_id,
         repeat_unit_id: repeat_unit_id,
     }
    )
    .done(function(data) {
        console.log("OK");
    })
    .fail(function() {
        console.log("ERROR");
    });
  }

  $("#repeat_reorder").click(function(){ // send a prescription report upon clicking "Reorder" button
        var prescription_name = $(this).data('prescription_name');
        var prescription_id = $(this).data('prescription_id');
        var patient_id = $(this).data('patient_id');
        var appointment_id = $(this).data('appointment_id');
        swal({
          title: prescription_name,
          text: "Are you sure you want to reorder this repeat prescription medicine?",
          imageUrl: "/img/medicine-icon.png",
          imageSize: "120x120",
          showCancelButton: true,
          confirmButtonColor: "#2196F3",
          confirmButtonText: "Reorder Now",
          cancelButtonText: "Cancel",
          closeOnConfirm: false,
          closeOnCancel: true,
          allowEscapeKey: true,
        },
        function(isConfirm){
          if (isConfirm) {
            sendPrescriptionRequest(patient_id, appointment_id, prescription_id);
            swal("Success!", "We have sent your repeat prescription request to your doctor.", "success");
          } else {
          }
        });
  }); 

  $(".approve_repeat_request").click(function(){ // Approve patient's repeat prescription request
        var repeat_unit_id = $(this).data('repeat_unit_id');
        var prescription_id = $(this).data('prescription_id');
        var patient_id = $(this).data('patient_id');
        var appointment_id = $(this).data('appointment_id');
        swal({
          title: "Are you sure?",
          type: "info",
          showCancelButton: true,
          confirmButtonColor: "#2196F3",
          confirmButtonText: "Approve",
          cancelButtonText: "Cancel",
          closeOnConfirm: false,
          closeOnCancel: true,
          allowEscapeKey: true,
        },
        function(isConfirm){
          if (isConfirm) {
            var thisID = '#item-' + repeat_unit_id;
            approveRepeatRequest(patient_id, appointment_id, prescription_id, repeat_unit_id);
            $(thisID).fadeOut();
            swal("All done!", "Prescription request approved.", "success");
          } else {
          }
        });
  }); 

  ///////////////////////////////////////////
  //////// ADD APPOINTMENT  
  ///////////////////////////////////////////

  $('#appointmentsModal').on('show.bs.modal', function(e) {
    var doctor_id = $('#a_doctor_id').val();
    if (doctor_id == null) {
      $("#a_date").prop("disabled", true);
      $("#a_time").prop("disabled", true);
    }
  });


  $(".appointmentsAddButton").click(function(){
    $("#a_app_id").val(""); // hidden
    $("#a_doctor_id").val("");
    $("#a_date").val("");
    $("#a_time").val("");
    if($('div').is('.appointments-page')){
      $("#a_patient_id").val("");
    }
    $("#a_details").val("");

    $('#appointmentsModal').on('show.bs.modal', function(e) {
      $(".a_doctor_id-form-group").show();
      $(".patient_id-form-group").show();
      $("#patient_selector").show();
      $("#a_patient_id_label").show();
    });

    
    if($('div').is('.patients-homepage')){
      $(".patient_id-form-group").hide();
    }

    $('#a_date').on('change', function(e){

        var doctor_id = $('#a_doctor_id').val();
        var date = $('#a_date').val();

        if(doctor_id && date) {
          $.ajax({
              url: '/getAppointmentTimeslots/'+doctor_id+'/'+date,
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
                      $('select[name="a_time"]').append('<option value="" disabled selected>Choose time</option>');
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

    $('#patient_selector').on('change', function(e){
      var patientid = $("#patient_selector").val();
      $("#a_patient_id").val(patientid);
    });
  });


  $(".appointmentsAddButtonHome").click(function(){
    $(".patient_id-form-group").hide();
    $("#a_patient_id_label").hide();
  });

  ///////////////////////////////////////////
  //////// EDIT APPOINTMENT  
  ///////////////////////////////////////////

  $(".appointmentsEditButton").click(function(){
    $('#appointmentsModal').on('show.bs.modal', function(e) {
        if($(e.relatedTarget).data('id') === "edit-button") {
            $(".a_doctor_id-form-group").hide();
            $(".patient_id-form-group").hide();
            var appid = $(e.relatedTarget).data('appointment-id');
            var patientid = $(e.relatedTarget).data('patient-id');
            var date = $(e.relatedTarget).data('date');
            var time = $(e.relatedTarget).data('time');
            var details = $(e.relatedTarget).data('details');
            var doctor_id = $(e.relatedTarget).data('doctor-id');

            console.log(time);

            $("#a_app_id").val(appid); // hidden
            $("#a_patient_id").val(patientid); // hidden
            $("#a_date").val(date);
            $("#a_date_hidden").val(date);
            $("#a_details").val(details);
            $("#a_doctor_id").val(doctor_id);
            $.ajax({
                url: '/getAppointmentTimeslots/'+doctor_id+'/'+date,
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
                        $('select[name="a_time"]').append('<option selected value="'+ time +'">'+ time +'</option>');
                    $.each(data, function(key, value) {
                        console.log("V: " + value + " T: " + time);
                          $('select[name="a_time"]').append('<option value="'+ value +'">'+ value +'</option>');
                    });

                    }
                }
            });
            $("#a_time").val(time);

        }
        $("#a_patient_id").hide();
        $("#patient_selector").hide();
        $("#a_patient_id_label").hide();
    });
  });

  ///////////////////////////////////////////
  //////// EDIT CONDITION 
  ///////////////////////////////////////////

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

  });

  ///////////////////////////////////////////
  //////// EDIT PRESCRIPTION FORM 
  ///////////////////////////////////////////

  $('#prescriptionsModal').on('show.bs.modal', function(e) {
      var prescriptionid = $(e.relatedTarget).data('prescription-id');
      var appid = $(e.relatedTarget).data('appointment-id');
      var patientid = $(e.relatedTarget).data('patient-id');
      var quantity = $(e.relatedTarget).data('quantity');
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
      $("#p_quanity").val(quantity);
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

});