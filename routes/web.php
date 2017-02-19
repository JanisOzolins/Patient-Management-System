<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/welcome', function () {

		return view('welcome');

	});


Route::group(['middleware' => 'auth'], function () 

{
	Route::get('/', function () {

		if(Auth::user()->user_type == "doctor") {
			$users = App\User::orderBy('last_name', 'asc')->get();
			return view('doctor.home')->with('users', $users);
		}
		elseif(Auth::user()->user_type == "staff") {
			$test = "hey";
			return view('staff.home')->with('test', $test);
		}
		elseif(Auth::user()->user_type == "patient") {
			$test = "hey";
			return view('patient.home')->with('test', $test);
		}
		else {
			return "SORRY, UNAUTHORIZED ACCESS.";
		}

	});

});


// Route::group(['middleware' => 'patient'], function () {

// 	Route::get('/', function () {

// 		$test = 'tooo maamaa';

// 		return view('patient.home')->with('test', $test);

// 	});

// });

Auth::routes();

