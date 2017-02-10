<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class Patient extends Eloquent implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract {
 
	use Authenticatable, Authorizable, CanResetPassword; 
 	
	// to specify which connection will be used
	protected $connection = "mongodb"; 
	// to specify which collection to use within the database if the collection name is NOT the plural form of class name
	protected $collection = "patientcollection";

}
