<?php

namespace App\Http\Controllers;

use App\Appointment;

use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    
	public function index() 

	{

		$appointments = Appointment::all();

		return view('appointment.index')->with('appointments', $appointments);

	}

}
