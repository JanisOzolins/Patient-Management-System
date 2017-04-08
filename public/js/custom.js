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

    document.getElementById('p_expiry_group').style.display = 'none';
    document.getElementById('p_repeat_group').style.display = 'none';

    

    document.getElementById('p_controlled').onchange = function () {
      var selectedValue = this.options[this.selectedIndex].value;

      if (selectedValue == "Yes") { 
        document.getElementById('p_repeat_group').style.display = 'none';
      }
      if (selectedValue == "No") { 
        document.getElementById('p_repeat_group').style.display = '';
      }
    };


    document.getElementById('p_repeat').onchange = function () {
      var selectedValue = this.options[this.selectedIndex].value;

      if (selectedValue == "No") { 
        document.getElementById('p_expiry_group').style.display = 'none';
      }
      if (selectedValue == "Yes") { 
        document.getElementById('p_expiry_group').style.display = '';
      }
    };


    
});