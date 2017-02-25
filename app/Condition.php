<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Condition extends Eloquent
{
	public $timestamps = false;

    protected $fillable = [
        'c_name', 'c_diagnosed_at', 'c_isTreated', 'c_details'
        ];

    public function prescriptions()
    {
        return $this->embedsMany('App\Prescription', 'prescription');
    }
}
