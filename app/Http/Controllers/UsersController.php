<?php

namespace App\Http\Controllers;

use App\User;
use App\Appointment;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function show($id) {

    	$user = User::find($id);
    	$users = User::all();

    	$appointments = $user->appointments;
    	
    	return view('patients.show')->with('user', $user)->with('users', $users)->with('appointments', $appointments);

    }
}
