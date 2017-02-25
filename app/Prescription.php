<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Prescription extends Eloquent
{
	public $timestamps = false;

    protected $fillable = [
        'p_name', 'p_expiry', 'p_isRepeat', 'p_details'
        ];
}
