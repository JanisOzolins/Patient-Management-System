<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Note extends Eloquent
{
	use SoftDeletes;

	// enable soft delete timestamp
	protected $dates = ['deleted_at'];
	// specify mass-assignable fields
    protected $fillable = ['n_content']; 

}
