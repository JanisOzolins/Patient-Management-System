<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Patient extends Eloquent {
 
	// to specify which connection will be used
	protected $connection = "mongodb"; 
	// to specify which collection to use within the database if the collection name is NOT the plural form of class name
	protected $collection = "patientcollection";

}
