<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    
	public function index() 

	{

		$users = User::all();

		return view('appointment.index')->with('users', $users);

	}

}
