<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;

class DoctorsController extends Controller
{
    public function index() 
    {
    	$users = User::all();
    	$timeslots = $this->getTimeslots('06:00', '21:00', 15);
    	return view('doctors.schedule')->with('timeslots', $timeslots)->with('users', $users);
    }

    public function store() 
    {
    	$user = User::find(request('doctor_id'));
    	if($user->user_type !== "doctor") {
    		return redirect('/schedule');
    	}
    	// create an array of chosen timeslots 
    	$timeslots = $this->getTimeslots(request('time_from'), request('time_to'), '15');

    	if($this->checkDateExists($user, request('date')) === true) {
    		$date = $user->schedules->where('date', request('date'))->first();
    		//return $timeslots;
    		$oldtimeslots = $date->timeslots;
    		$newarray = array_merge_recursive($oldtimeslots, $timeslots);
    		$newarray = array_unique($newarray);
    		sort($newarray);
    		$date->timeslots = $newarray;
    		$date->save();
    	}
    	else {
	        $schedule = $user->schedules()->create(['date' => request('date'), 'timeslots' => $timeslots]);
	        $user->save();
	     }
	     return redirect('/schedule');
    }

    public function checkDateExists($user, $date) {
    	$check = $user->schedules->where('date', $date)->first();
    	if ($check !== null) {
    		return true;
    	}
    	else {
    		return false;
    	}
    }

    public function getTimeslots($start, $finish, $duration) 
    {
    	$today = Carbon::today();
		$timeslots = [];
		for ($i = 0; $i <= 95; $i ++){
		    $today->addMinutes($duration);
		    if (($today->format('H:i') >= $start) and ($today->format('H:i') <= $finish)) 
		    {
		    	array_push($timeslots, $today->format('H:i'));
		    }
		}
		return $timeslots;
    }

    
		

		public function myformAjax($id, $date)
	    {
	    	$doctor = User::find($id);
	        $times = $doctor->schedules->where('date', $date)->pluck('timeslots')->first();
	        if ($times === null)
	        	$times = array();
			return response()->json($times);
	    }
}
