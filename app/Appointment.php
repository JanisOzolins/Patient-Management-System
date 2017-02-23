<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Appointment extends Eloquent
{
    protected $fillable = [
        'a_patient', 'a_date', 'a_time', 'a_details',
        ];
}
