<?php

namespace App\Http\Controllers;

use App\User;
use App\Appointment;
use Alert;
use Input;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AppointmentsController extends Controller
{

	public function show($uid, $aid)
	{
		$user = User::find($uid);
    	$appointments = $user->appointments;
		$appointment = $user->appointments()->find($aid);

		return view('appointments.single')->with('appointment', $appointment)->with('appointments', $appointments)->with('user', $user);		
	}
    
	public function index() 
	{
		$q = Input::get ( 'q' );
		$allAppointments = $this->getAllAppointments();
	    if($q != NULL) {
	    	$allAppointments = $this->search($q);
	    }
	    
	    return view('appointments.index')->with('allAppointments', $allAppointments)->with('q', $q);
	}

	public function getAllAppointments() {
		$users = User::all();
		$getAllAppointments = collect();
		foreach($users as $user) {
			foreach($user->appointments as $appointment) {
				$getAllAppointments->push($appointment);
			}
		}
		return $getAllAppointments;
	}

	public function search($q) 
	{
		$appointments = $this->getAllAppointments();

	    $new = $appointments->filter(function($appointment) use ($q)
	    {
	    	if( stripos($appointment->user->first_name, $q) !== FALSE )
	    		return $appointment;
	    	if( stripos($appointment->user->last_name, $q) !== FALSE )
	    		return $appointment;
	    	if( stripos($appointment->user->id, $q) !== FALSE )
	    		return $appointment;
	    	if( stripos($appointment->a_date, $q) !== FALSE )
	    		return $appointment;    
	    	if( stripos($appointment->user->date_birth, $q) !== FALSE )
	    		return $appointment;    
	    	if( stripos($appointment->a_doctor, $q) !== FALSE )
	    		return $appointment;            
	    });

    	return $new;
	}
	

	public function store() 
	{
		// find the user
		$user = User::find(request('a_patient_id'));
		// find the doctor
		$doctor = User::find(request('a_doctor_id'));
		// set datetime
		$datetime = strtotime(request('a_date') . ' ' . request('a_time'));
		$datetime = date('Y-m-d H:i', $datetime);
		
		if ($user->appointments()->find(request('a_app_id')) !== NULL) // checks if appointment needs to be updated instead of created
		{

			$appointment = $user->appointments()->find(request('a_app_id'));

			$appointment->a_doctor_id = $doctor->id;
			$appointment->a_doctor = $doctor->first_name . ' ' . $doctor->last_name;
			$appointment->a_time = request('a_time');
			$appointment->a_date = request('a_date_hidden');
			$datetime = strtotime(request('a_date_hidden') . ' ' . request('a_time'));
			$datetime = date('Y-m-d H:i', $datetime);
			$appointment->a_details = request('a_details');
			$appointment->datetime = $datetime;

			$appointment->save();

			return back();
		}

		// add embedded 'Appointment' instance
		$appointment = $user->appointments()->create([
			'a_patient' => $user->first_name . ' ' . $user->last_name,
			'a_doctor_id' => $doctor->id,
			'a_doctor' => $doctor->first_name . ' ' . $doctor->last_name,
			'a_date' => request('a_date'), 
			'a_time' => request('a_time'), 
			'datetime' => $datetime,
			'a_details' => request('a_details')]);

		// save changes
		$user->save();
		
		return back();
		
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
		Alert::warning('The appointment was sucessfully cancelled!', 'Appointment cancelled!');
		return back();

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
