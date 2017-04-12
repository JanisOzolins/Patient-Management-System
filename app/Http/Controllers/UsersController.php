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
    	$currentUser = \Auth::user();


    	$activePrescriptions = $this->getActivePrescriptions($currentUser);

    	$diagnoses = $this->getPatientConditions($currentUser);
		//return $events;

		return view('layouts.home')->with('users', $users)->with('activePrescriptions', $activePrescriptions)->with('diagnoses', $diagnoses);
    }

    public function edit() {
		return view('layouts.edit-profile');
    }

    public function update()
    {
        $user = \Auth::user();

        $messages = ['new_password_confirmation.same'    => 'The new password fields do not match. Try again!', ];

        $validator = Validator::make(request()->all(), [
        	'current_password' => 'required',
            'new_password' => '',
            'new_password_confirmation' => 'same:new_password',
        ], $messages);

         if ($validator->fails()) {
            return redirect('/edit-profile')
                        ->withErrors($validator)
                        ->withInput();
        }

        $user->first_name = request('first_name');
        $user->last_name = request('last_name');
        $user->address = request('address');
        $user->phone = request('phone');
        $user->email = request('email');

        if ((Hash::check(request('current_password'), $user->password)) && (Input::get('new_password') !== null) && (Input::get('new_password_confirmation') !== null)) { 
        	$user->fill([
                'password' => Hash::make(request('new_password'))
                ])->save();
        }
        if (Hash::check(request('current_password'), $user->password) === false) {
        	return redirect('/edit-profile')->withInput();
        }


        $user->save();
        Alert::success('Profile was updated successfully.', 'Success!');

        return redirect('/edit-profile/');
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
		$user = \Auth::user();
		$events = [];
		foreach($user->appointments as $appointment) {
				$doctor_name = $appointment->a_doctor;
				$date = $appointment->a_date;

				$events[] = array(
	                'title' => $doctor_name,
	                'start' => $appointment->a_date . "T" . $appointment->a_time,
	                'desc' => $appointment->a_details,
	            );
		}
		return response()->json($events);
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
