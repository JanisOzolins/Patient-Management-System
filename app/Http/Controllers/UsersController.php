<?php

namespace App\Http\Controllers;

use App\User;
use App\Appointment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use Alert;
use Validator;
use Input;
use Auth;


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
    	$currentUser = Auth::user();


    	$activePrescriptions = $this->getActivePrescriptions($currentUser);
    	$totalNumberPatients = $this->totalNumberPatients();
    	$diagnoses = $this->getPatientConditions($currentUser);
    	$prescriptionRequests = $this->getPrescriptionRequests($currentUser);

		//return $prescriptionRequests;
		return view('layouts.home')->with('users', $users)
								   ->with('activePrescriptions', $activePrescriptions)
								   ->with('diagnoses', $diagnoses)
								   ->with('totalNumberPatients', $totalNumberPatients)
								   ->with('prescriptionRequests', $prescriptionRequests);
    }

    public function edit($id) {
    	if(($id !== Auth::user()->id) && (Auth::user()->user_type !== "patient")) { 
    		// if the logged in user has the rights to edit other people's personal information
    		$user = User::find($id);
    	}
    	else {
    		// if the user can only edit his own profile (patients)
    		$user = Auth::user();
    	}
		return view('layouts.edit-profile')->with('user', $user);
    }

    public function update($id)
    {
        $user = User::find($id);

        $messages = ['new_password_confirmation.same'    => 'The new password fields do not match. Try again!', ];

        if( Auth::user()->id === $user->id) {
        	// if editing your own profile -> current password needed
	        $validator = Validator::make(request()->all(), [
	        	'current_password' => 'required',
	            'new_password' => '',
	            'new_password_confirmation' => 'same:new_password',
	        ], $messages);
	    }
	    elseif( (Auth::user()->user_type !== "patient") && ($user->user_type === "patient") || (Auth::user()->user_type !== "manager")){
	    	// staff members do not require to provide current password to change patient's password
	    	$validator = Validator::make(request()->all(), [
	            'new_password' => '',
	            'new_password_confirmation' => 'same:new_password',
	        ], $messages);
	    }

         if ($validator->fails()) {
        	return back()->withErrors($validator)->withInput();
        }

        $user->first_name = request('first_name');
        $user->last_name = request('last_name');
        $user->address = request('address');
        $user->phone = request('phone');
        $user->email = request('email');

        // changing the password if new password is provided
        if (
        		(Hash::check(request('current_password'), $user->password)) 
        		&& (Input::get('new_password') !== null) 
        		&& (Input::get('new_password_confirmation') !== null)
           ) { 
        	$user->fill([
                'password' => Hash::make(request('new_password'))
                ])->save();
        }

        //current password needs to be checked ONLY if the user is editing his own profile
        if ((Hash::check(request('current_password'), $user->password) === false) && (Auth::user()->id === $user->id)) {
        	return back()->withInput();
        }


        $user->save();
        Alert::success('Profile was updated successfully.', 'Success!');

        return back();
    }

    public function getPrescriptionRequests() {
    	$doctor = Auth::user();
    	$users = User::all();
    	$requests = collect();
    	foreach ($users as $user) {
    		foreach ($user->appointments as $appointment) {
    			foreach ($appointment->prescriptions as $prescription) {
    				if ($prescription->p_repeat === "Yes") {
    					if($prescription->repeatUnits->last()->repeat_approved === null) {
    						$requests->push($prescription->repeatUnits->last());
    					}
    				}
    			}
    		}
    	}
    	return $requests;
    }

    public function totalNumberPatients() {
    	$users = User::all();
    	$counter = 0;

    	foreach($users as $user) {
    		if ($user->user_type === "patient") {
    			$counter++;
    		}
    	}
    	return $counter;
    }

    public function getActivePrescriptions($user) {

    	$number = 0;
    	foreach ($user->appointments as $appointment) {
    		foreach($appointment->prescriptions as $prescription) {
    			if ($prescription->p_expiry >= Carbon::now()) {
    				$number++;
    			}
    		}
    	}
    	return $number;
    }

    public function getPatientConditions($user) {
    	$number = 0;
    	foreach ($user->appointments as $appointment) {
    		foreach($appointment->conditions as $condition) {
				$number++;
    		}
    	}
    	return $number;
    }

    public function getPatientAppointments() {
		$user = Auth::user();
		$events = [];
		foreach($user->appointments as $appointment) {
				$doctor_name = $appointment->a_doctor;
				$date = $appointment->a_date;
                if($date >= date('Y-m-d')) {
				$events[] = array(
	                'title' => $doctor_name,
	                'start' => $appointment->a_date . "T" . $appointment->a_time,
	                'desc' => $appointment->a_details,
	            );
            }

		}
		return response()->json($events);
	}

    public function getAppointmentsAll() {
    	$users = User::all();
    	$events = [];
    	foreach($users as $user) {
			if($user->user_type === "patient") {
				foreach($user->appointments as $appointment) {
					if(($appointment->a_doctor_id === Auth::user()->id)) {
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
