<?php

namespace App\Http\Controllers;

use App\User;
use App\Appointment;
use Illuminate\Http\Request;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use Carbon\Carbon;


class UsersController extends Controller
{
    public function show($id) {

    	$user = User::find($id);
    	$users = User::all();

    	$appointments = $user->appointments;
    	
    	return view('patients.show')->with('user', $user)->with('users', $users)->with('appointments', $appointments);

    }

    public function home() {

    	$users = User::all();

		//return $events;

		return view('layouts.home')->with('users', $users);
    }

    public function getAppointmentsAll() {
    	$users = User::all();
    	$events = [];
    	foreach($users as $user) {
			if($user->user_type === "patient") {
				foreach($user->appointments as $appointment) {
					if(($appointment->a_doctor_id === \Auth::user()->id)) {
						$fullname = $user->first_name . " " . $user->last_name;
						$date = $appointment->a_date;

						$events[] = array(
			                'title' => $fullname,
			                'start' => $appointment->a_date . "T" . $appointment->a_time,
			                'url' => './user/' . $appointment->user->id . '/appointments/' . $appointment->id,
			            );
					}
				}
			}
		}
		return response()->json($events);
    }
}
