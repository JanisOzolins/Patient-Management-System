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

Route::get('/', function () {
	$patients = "HELLO";
    return view('welcome')->with('patients', $patients);
});

Auth::routes();

Route::get('/home', function () {
	$users = App\User::all();
	return view('home')->with('users', $users);

});
