<?php

namespace App\Http\Controllers;

use App\User;
use App\Appointment;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function show($id) {

    	$user = User::find($id);

    	return view('patient.show')->with('user', $user);

    }
}
