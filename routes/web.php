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


Route::group(['middleware' => 'auth'], function () {

	Route::get('/', function () {

		///// DOCTOR HOME

		if(Auth::user()->user_type == "doctor") {
			$users = App\User::orderBy('last_name', 'asc')->get();
			return view('doctor.home')->with('users', $users);
		}

		///// STAFF HOME

		elseif(Auth::user()->user_type == "staff") {
			$users = App\User::orderBy('last_name', 'asc')->get();
			return view('staff.home')->with('users', $users);
		}

		///// PATIENT HOME

		elseif(Auth::user()->user_type == "patient") {
			$test = "hey";
			return view('patient.home')->with('test', $test);
		}

		///// MANAGER HOME

		elseif(Auth::user()->user_type == "manager") {
			return view('manager.home');
		}

	});

	Route::get('/appointments', 'AppointmentsController@index')->name('appointments.index');
	Route::post('/appointments', 'AppointmentsController@store')->name('appointments.store');
	Route::get('/appointments/create', 'AppointmentsController@create')->name('appointments.create');
	Route::delete('user/{uid}/appointments/{aid}', 'AppointmentsController@delete')->name('appointments.delete');
	Route::get('user/{uid}/appointments/{aid}', 'AppointmentsController@show')->name('appointments.show');
	Route::get('user/{uid}/appointments/{aid}/edit', 'AppointmentsController@edit')->name('appointments.edit');
	Route::put('user/{uid}/appointments/{aid}', 'AppointmentsController@update')->name('appointments.update');

	Route::get('/user/{user_id}', 'UsersController@show')->name('user.show');

	Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

	// Route::get('/appointments/add', function () {
 	
	// 	return view('appointment.add');

	// });

	// Route::get('/appointments/{appointment}', function () {
 	
	// 	return view('appointment.show');

	// });

});


// Route::group(['middleware' => 'patient'], function () {

// 	Route::get('/', function () {

// 		$test = 'tooo maamaa';

// 		return view('patient.home')->with('test', $test);

// 	});

// });

Auth::routes();

