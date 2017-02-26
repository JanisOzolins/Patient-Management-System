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

		return view('appointment.index')->with('users', $users);

	}

	public function show($uid, $aid) 

	{
		$user = User::find($uid);
		$appointment = $user->appointments()->get()->where('id', $aid);

		return view('appointment.show')->with('appointment', $appointment)->with('user', $user);

	}

}
