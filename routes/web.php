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
			return view('doctors.home')->with('users', $users);
		}

		///// STAFF HOME

		elseif(Auth::user()->user_type == "staff") {
			$users = App\User::orderBy('last_name', 'asc')->get();
			return view('staff.home')->with('users', $users);
		}

		///// PATIENT HOME

		elseif(Auth::user()->user_type == "patient") {
			$test = "hey";
			return view('patients.home')->with('test', $test);
		}

		///// MANAGER HOME

		elseif(Auth::user()->user_type == "manager") {
			return view('managers.home');
		}

	});

	// Appointments
	Route::get('/appointments', 'AppointmentsController@index')->name('appointments.index');
	Route::post('/appointments', 'AppointmentsController@store')->name('appointments.store');
	Route::get('/appointments/create', 'AppointmentsController@create')->name('appointments.create');
	Route::delete('user/{uid}/appointments/{aid}', 'AppointmentsController@delete')->name('appointments.delete');
	Route::get('user/{uid}/appointments/{aid}', 'AppointmentsController@show')->name('appointments.show');
	Route::get('user/{uid}/appointments/{aid}/edit', 'AppointmentsController@edit')->name('appointments.edit');
	Route::put('user/{uid}/appointments/{aid}', 'AppointmentsController@update')->name('appointments.update');

	// Patients
	Route::get('/user/{id}', 'UsersController@show')->name('user.show');
	Route::any('/patients',function(){
	    $q = Input::get ( 'q' );
	    $users = App\User::where('first_name','LIKE','%'.$q.'%')
	    				->orWhere('last_name','LIKE','%'.$q.'%')
	    				->orWhere('birth_date','LIKE','%'.$q.'%')
	    				->orWhere('phone','LIKE','%'.$q.'%')
	    				->orWhere('email','LIKE','%'.$q.'%')->paginate(15);
	    if(count($users) > 0)
	    	return view('patients.index')->with('users', $users)->withQuery ( $q );
    	else {
			$users = App\User::paginate(15);
    		return view ('patients.index')->with('users', $users)->withMessage('No Details found. Try to search again !');
    	}
	})->name('patients.index');

	// Conditions
	Route::get('/user/{id}/conditions/create', 'ConditionsController@create')->name('conditions.create');
	Route::post('/conditions', 'ConditionsController@store')->name('conditions.store');
	Route::delete('user/{uid}/conditions/{cid}', 'ConditionsController@delete')->name('conditions.delete');

	// Notes
	Route::post('/notes', 'NotesController@store')->name('notes.store');
	Route::delete('/user/{uid}/notes/{nid}', 'NotesController@delete')->name('notes.delete');

	// Prescriptions
	Route::post('/prescriptions', 'PrescriptionsController@store')->name('prescriptions.store');
	Route::delete('/user/{uid}/prescriptions/{pid}', 'PrescriptionsController@delete')->name('prescriptions.delete');

	Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');


});



Auth::routes();

