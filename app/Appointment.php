<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Model;


class Appointment extends Model
{

    protected $fillable = [
        'a_patient', 'a_date', 'a_time', 'a_details', 'datetime'
        ];

    public function notes()
    {
        return $this->embedsMany('App\Note', 'note');
    }

    public function prescriptions()
    {
        return $this->embedsMany('App\Prescription', 'prescription');
    }

    public function conditions()
    {
        return $this->embedsMany('App\Condition', 'condition');
    }
}
