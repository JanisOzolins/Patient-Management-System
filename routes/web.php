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

/* API routes */

Route::get('getAppointmentTimeslots/{uid}/{date}',array('as'=>'myform.ajax','uses'=>'DoctorsController@fetchDoctorSchedules'));
Route::get('/appointments/doctor-this-week', 'UsersController@getAppointmentsAll');
Route::get('/appointments/doctor-next-week', 'UsersController@getAppointmentsAll');
Route::get('/appointments/patient-overview', 'UsersController@getPatientAppointments');
Route::get('/getDoctorsAppointments/{uid}', 'DoctorsController@getAppointmentsDates');
Route::post('/sendPrescriptionRequest', 'PrescriptionsController@sendPrescriptionRequest');
Route::post('/approveRepeatRequest', 'PrescriptionsController@approveRepeatRequest');
Route::get('/schedule/get-doctor-schedule', 'DoctorsController@getDoctorSchedule');

Route::get('register/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'RegistrationController@confirm'
]);

Route::group(['middleware' => 'auth'], function () {

	// General User Routes
	Route::get('/', 'UsersController@home')->name('users.home');
	Route::get('/edit-profile/{uid}', 'UsersController@edit')->name('users.edit')->middleware('ManagerStaffPatient');
	Route::POST('/update-profile/{uid}', 'UsersController@update')->name('users.update')->middleware('ManagerStaffPatient');
	Route::get('/users', 'UsersController@all')->name('users.all')->middleware('Manager');

	// Doctors
	Route::get('/schedule', 'DoctorsController@index')->name('doctors.index')->middleware('MedicalStaff');
	Route::get('/user/{uid}/schedule', 'DoctorsController@show')->name('doctors.show')->middleware('MedicalStaff');
	// Route::get('/addSchedule', 'DoctorsController@create')->name('doctors.create')->middleware('MedicalStaff');
	Route::post('/storeSchedule', 'DoctorsController@store')->name('doctors.store')->middleware('MedicalStaff');




	// Appointments
	Route::get('/appointments', 'AppointmentsController@index')->name('appointments.index')->middleware('MedicalStaffManager');
	Route::post('/appointments', 'AppointmentsController@store')->name('appointments.store');
	Route::delete('user/{uid}/appointments/{aid}/', 'AppointmentsController@delete')->name('appointments.delete')->middleware('MedicalStaffManagerPatient');
	Route::get('user/{uid}/appointments/{aid}/', 'AppointmentsController@show')->name('appointments.single')->middleware('MedicalPatient');
	Route::get('user/{uid}/appointments/{aid}/edit', 'AppointmentsController@edit')->name('appointments.edit')->middleware('MedicalStaff');
	Route::put('user/{uid}/appointments/{aid}/', 'AppointmentsController@update')->name('appointments.update')->middleware('MedicalStaff');

	// Patients
	Route::get('/user/{uid}', 'UsersController@show')->name('patients.show')->middleware('MedicalPatient'); //not sure 
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
	})->name('patients.index')->middleware('MedicalStaff');

	// Conditions
	Route::get('/user/{uid}/conditions/create', 'ConditionsController@create')->name('conditions.create')->middleware('Medical');
	Route::post('/conditions', 'ConditionsController@store')->name('conditions.store')->middleware('Medical');
	Route::delete('user/{uid}/appointments/{aid}/conditions/{cid}', 'ConditionsController@delete')->name('conditions.delete')->middleware('Medical');

	// Appointment Notes
	Route::post('/notes', 'NotesController@store')->name('notes.store');
	Route::delete('/user/{uid}/appointments/{aid}/notes/{nid}', 'NotesController@delete')->name('notes.delete');

	// General Notes
	Route::post('/gn', 'UsersController@gn_create')->name('gn.create');
	Route::delete('/user/{uid}/gn/{gnid}', 'UsersController@gn_delete')->name('gn.delete');

	// Prescriptions
	Route::post('/prescriptions', 'PrescriptionsController@store')->name('prescriptions.store')->middleware('Medical');
	Route::delete('/user/{uid}/appointments/{aid}/prescriptions/{pid}', 'PrescriptionsController@delete')->name('prescriptions.delete')->middleware('Medical');
	Route::get('/approvePrescription/{uid}/{aid}/{pid}/{prid}', 'PrescriptionsController@store')->name('prescriptions.store')->middleware('Medical');

	Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');


	


});



Auth::routes();

