<?php

namespace App\Http\Controllers;

use App\User;
use App\Appointment;
use Input;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AppointmentsController extends Controller
{

	public function show($uid, $aid)
	{
		$user = User::find($uid);
    	$appointments = $user->appointments;
		$appointment = $user->appointments()->find($aid);

		return view('patients.show')->with('appointment', $appointment)->with('appointments', $appointments)->with('user', $user);		
	}
    
	public function index() 
	{
		$q = Input::get ( 'q' );
	    if($q != NULL) {
	    	$users = $this->search($q);
	    	return view('appointments.index')->with('users', $users);
	    }
	    else { 
			$users = User::all();
			return view('appointments.index')->with('users', $users);
		}

    		
	}

	public function search($q) 
	{
		$users = User::all();

	    $new = $users->filter(function($user) use ($q)
	    {
	    	if( stripos($user->first_name, $q) !== FALSE )
	    		return $user;
	    	if( stripos($user->last_name, $q) !== FALSE )
	    		return $user;
	    	if( stripos($user->birth_date, $q) !== FALSE )
	    		return $user;        
	    });

    	return $new;
	}
	

	public function create() 
	{
		$users = User::all();
		return view('appointments.create')->with('users', $users);
	}

	public function store() 
	{
		// find the user
		$user = User::find(request('a_patient_id'));

		if ($user->appointments()->find(request('a_app_id')) != NULL) // checks if appointment needs to be updated instead of created
		{
			$appointment = $user->appointments()->find(request('a_app_id'));

			$appointment->a_time = request('a_time');
			$appointment->a_date = request('a_date');
			$appointment->a_details = request('a_details');

			$datetime = strtotime(request('a_date') . ' ' . request('a_time'));
			$datetime = date('Y-m-d H:i', $datetime);
			$appointment->datetime = $datetime;

			$appointment->save();

			return redirect('/user/' . request('a_patient_id'));
		}

		// add embedded 'Appointment' instance
		$datetime = strtotime(request('a_date') . ' ' . request('a_time'));
		$datetime = date('Y-m-d H:i', $datetime);
			

		$appointment = $user->appointments()->create([
			'a_patient' => $user->first_name . ' ' . $user->last_name, 
			'a_date' => request('a_date'), 
			'a_time' => request('a_time'), 
			'datetime' => $datetime,
			'a_details' => request('a_details')]);

		// save changes
		$user->save();

		return redirect('/user/' . request('a_patient_id'));
	}

	public function delete($uid, $aid) {

		// find the patient
		$user = User::find($uid);

		// find the appointment
		$appointment = $user->appointments()->find($aid);

		// delete the appointment
		$appointment->delete();

		// save changes
		$user->save();

		return redirect('/user/' . $uid);

	}

	public function edit($uid, $aid) {

		//find the user
		$user = User::find($uid);

		// find the appointment
		$appointment = $user->appointments()->find($aid);

		// return variables to the "edit" view
		return view('appointments.edit')->with('user', $user)->with('appointment', $appointment);

	}

	public function update($uid, $aid, $request) {

		// find the user
		$user = User::find($uid);

		// find the appointment
		$appointment = $user->appointments()->find($aid);

		// update data
		$appointment->a_time = $request['a_time'];
		$appointment->a_date = $request['a_date'];
		$appointment->a_details = $request['a_details'];

		$appointment->save();

		return redirect('/user/' . $uid);
 	}
}
