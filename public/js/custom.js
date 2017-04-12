$(document).ready(function() {
  $('#doctor-calendar-this-week').fullCalendar({
      header: false,
      defaultView: "listWeek",
      weekends: false,
      events: '/appointments/doctor-this-week'
  });
  var nextweek = moment().add(7, 'days').calendar();
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

  if($('div').is('.app-appointments')){
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

  $('#appointmentsModal').on('show.bs.modal', function(e) {
    var doctor_id = $('#a_doctor_id').val();
    if (doctor_id == null) {
      $("#a_date").prop("disabled", true);
    }
  });


  // Ajax call upon changing the selected doctor
  var array = [];
  $("#a_doctor_id").on('change', function() {
    var doctor_id = $('#a_doctor_id').val();
    if (doctor_id != null) {
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

  function getAvailableDates(doctor_id) 
   {
      return $.ajax({
        url: '/getDoctorsAppointments/' + doctor_id +'/',
        type: "GET",
        dataType: "json"
      }); 
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

});