<?php

namespace App\Http\Controllers;

use App\User;
use App\Appointment;

use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    
	public function index() 
	{
		$users = User::all();
		return view('appointments.index')->with('users', $users);
	}

	public function create() 
	{
		$users = User::all();
		return view('appointments.create')->with('users', $users);
	}

	public function store() 
	{
		// find the patient model
		$patient = User::find(request('a_patient_id'));

		// add embedded 'Appointment' instance
		$appointment = $patient->appointments()->create(['a_patient' => $patient->first_name . ' ' . $patient->last_name, 'a_date' => request('a_date'), 'a_time' => request('a_time'), 'a_details' => request('a_details')]);

		// save changes
		$patient->save();

		// redirect to /appointments page
		return redirect('/appointments');
	}

	public function delete($id) {

	}


	// public function show($uid, $aid) 

	// {
	// 	$user = User::find($uid);
	// 	$appointment = $user->appointments()->where('id', $aid)->first();

	// 	return view('appointment.show')->with('appointment', $appointment);

	// }

}
