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
use DateTime;


class UsersController extends Controller
{
    public function show($id) {

    	$user = User::find($id);
    	$users = User::all();

    	$appointments = $user->appointments;

    	
    	return view('patients.show')->with('user', $user)->with('users', $users)->with('appointments', $appointments);

    }

    public function index() {
        $q = Input::get ( 'q' );
        $users = User::paginate(15);

        if($q != NULL) {
            $users = $this->search($q);
        }

        return view ('patients.index')->with('users', $users)->with('q', $q);
    }

    public function search($q) 
    {
        $patients = User::where('user_type', '=', 'patient');

        $new = $users = User::where('first_name','LIKE','%'.$q.'%')
                        ->orWhere('last_name','LIKE','%'.$q.'%')
                        ->orWhere('birth_date','LIKE','%'.$q.'%')
                        ->orWhere('birth_date','LIKE','%'.$q.'%')
                        ->orWhere('gender','LIKE','%'.$q.'%')
                        ->orWhere('age','===',$q)
                        ->orWhere('address','LIKE','%'.$q.'%')
                        ->orWhere('phone','LIKE','%'.$q.'%')
                        ->orWhere('email','LIKE','%'.$q.'%')->paginate(15);

        return $new;
    }

    public function all() {
        $users = User::all();
        $q = Input::get( 'q' );
        $type = Input::get( 'searchUsers' );
        if ($type === "" || $type === null) {
            $type = "all";
        }
        if($q !== NULL) {
            $users = $this->allUsersSearch($q, $type);
        }
        else {
            $users = $this->filterUsers($type);   
        }
        return view('managers.users')->with('users', $users)->with('type', $type)->with('q', $q);
    }

    public function filterUsers($type) {
        $users = User::all();
        $usertypes = $users->filter(function($user) use ($type)
        {
            if( $user->user_type === $type || $type === "all" || $type === "" || $type === null)  
                return $user;   
        });

        return $usertypes;
    }

    public function allUsersSearch($q, $type) 
    {
        $users = User::all();
        $new = $users->filter(function($user) use ($q, $type)
        {
            if( stripos($user->first_name, $q) !== FALSE )
                return $user;
            if( stripos($user->last_name, $q) !== FALSE )
                return $user;
            if( stripos($user->id, $q) !== FALSE )
                return $user;
            if( stripos($user->birth_date, $q) !== FALSE )
                return $user;    
            if( stripos($user->phone, $q) !== FALSE )
                return $user;  
            if( stripos($user->email, $q) !== FALSE )
                return $user;      
        });
        $usertypes = $new->filter(function($user) use ($type)
        {
            if( $user->user_type === $type || $type === "all" || $type === "")  
                return $user;   
        });

        return $usertypes;
    }

    public function home() {

    	$users = User::all();
    	$currentUser = Auth::user();


    	$activePrescriptions = $this->getActivePrescriptions($currentUser);
    	$totalNumberPatients = $this->totalNumberPatients();
    	$diagnoses = $this->getPatientConditions($currentUser);
    	$prescriptionRequests = $this->getPrescriptionRequests($currentUser);
        $thisMonth = $this->getAppointmentsThisMonth();

        //recalculate user age
        $this->recalculateAge();

		//return $prescriptionRequests;
		return view('layouts.home')->with('users', $users)
								   ->with('activePrescriptions', $activePrescriptions)
								   ->with('diagnoses', $diagnoses)
								   ->with('totalNumberPatients', $totalNumberPatients)
								   ->with('prescriptionRequests', $prescriptionRequests)
                                   ->with('thisMonth', $thisMonth);
    }

    public function recalculateAge() {
        $users = User::all();

        foreach($users as $user) {
             $user->age = $this->calculateAge($user);
             $user->save();
        }
    }

    public function calculateAge($user) 
    {
        $dob = $user->birth_date;

        if(!empty($dob)) 
        {
            $birthdate = new DateTime($dob);
            $today   = new DateTime('today');
            $age = $birthdate->diff($today)->y;
            return $age;
        }
        else
            return 0;
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
        elseif(Auth::user()->user_type === "manager") {
            $validator = Validator::make(request()->all(), [
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
        if ((Hash::check(request('current_password'), $user->password) === true) && (Auth::user()->id === $user->id)) {
            $user->first_name = request('first_name');
            $user->last_name = request('last_name');
            $user->address = request('address');
            $user->phone = request('phone');
            $user->email = request('email');
            $user->save();

        	Alert::success('Profile was updated successfully.', 'Success!');
        }
        elseif (Auth::user()->user_type === "manager") {
            $user->first_name = request('first_name');
            $user->last_name = request('last_name');
            $user->address = request('address');
            $user->phone = request('phone');
            $user->email = request('email');
            $user->save();
            if(request('new_password') !== NULL) {
                $user->fill([
                    'password' => Hash::make(request('new_password'))
                    ])->save();
            }
            Alert::success('Profile was updated successfully.', 'Success!');
        }
        else {
            Alert::error('Please check the entered information and try again!', 'Error!');
        }


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

    public function getAppointmentsThisMonth() {
        $doctor = Auth::user()->id;
        $users = User::all();
        $query_date = date('Y-m-h');
        $first = date('Y-m-01', strtotime($query_date));
        $last = date('Y-m-t', strtotime($query_date));
        $number = 0;
        foreach($users as $user) {
            foreach ($user->appointments as $appointment) {
                if ($appointment->a_date >= $first && $appointment->a_date <= $last && $appointment->a_doctor_id === Auth::user()->id ) {
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
                    'delete' => '<form method="POST" action="/user/' . $appointment->user->id . '/appointments/' . $appointment->id . '" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE">' . csrf_field() . '<input class="btn btn-danger btn-sm" type="submit" value="Cancel"> </form>'
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
                            'desc' => $appointment->a_details,
			                'url' => './user/' . $appointment->user->id . '/appointments/' . $appointment->id,
			            );
					}
				}
			}
		}
		return response()->json($events);
    }

    public function gn_create() {
        $user = User::find(request('patient_id'));

        $author = Auth::user()->first_name . ' ' . Auth::user()->last_name;

        $note = $user->generalnotes()->create(['gn_author' => $author, 'gn_content' => request('gn_content')]);

        $user->save();

        return back();
    }

    public function gn_delete($uid, $gnid) {

        $user = User::find($uid);
        $note = $user->generalnotes()->find($gnid);

        $note->delete();

        $user->save();

        return back();
        
    }
}
