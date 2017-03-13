<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Note extends Eloquent
{

	// specify mass-assignable fields
    protected $fillable = ['n_content', 'n_author']; 


}
