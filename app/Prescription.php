<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Prescription extends Eloquent
{

    protected $fillable = [
        'p_doctor', 'p_name', 'p_condition', 'p_active', 'p_expiry', 'p_controlled', 'p_repeat', 'p_details', 'p_repeat_next', 'p_quantity'
        ];

    public function repeatUnits()
    {
        return $this->embedsMany('App\RepeatUnit', 'RepeatUnits');
    }
}
