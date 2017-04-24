@extends('layouts.master')
@section('content')
<div class="container-fluid single-schedule-page">
    <div class="row">
    	<!-- LEFT COLUMN -->
        <div class="col-md-10 col-md-offset-1">
        <a style="float: left" href="{{ URL::to('schedule') }}" type="button" class="btn-return-user-profile button btn btn-default">Go Back</a><center><h1>{{ $user->first_name }} {{ $user->last_name }}</h1></center>
        <div id="calendar-test"></div>
        </div>
    </div>
</div>
@endsection
@section('page-script')
<script type="text/javascript">
	  $('#calendar-test').fullCalendar({
      defaultView: "agendaWeek",
      weekends: true,
      timeFormat: 'HH:mm',
      slotLabelFormat: 'HH:mm',
      columnFormat: 'DD MMMM',
      titleFormat: 'MMMM D',
      allDaySlot: false,
      firstDay: 1,
      minTime: '04:00:00',
      events: [
      	@foreach($user->schedules as $schedule)
        {
            title  						: "",
            start  						: "{{$schedule->date}}T{{ min($schedule->timeslots) }}",
            end    						: "{{$schedule->date}}T{{ max($schedule->timeslots) }}",
        },
        @endforeach
    ]
  });
</script>
@endsection
