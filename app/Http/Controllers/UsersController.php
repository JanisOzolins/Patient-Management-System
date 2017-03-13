<?php

namespace App\Http\Controllers;

use App\User;
use App\Appointment;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function show($id) {

    	$user = User::find($id);

    	$prescriptions = $user->prescriptions;

    	$appointments = $user->appointments->sortBy('a_time');

    	//dd($prescriptions);

    	return view('patients.show')->with('user', $user)->with('prescriptions', $prescriptions)->with('appointments', $appointments);

    }
}
