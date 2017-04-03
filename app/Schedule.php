<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Schedule extends Eloquent
{
    protected $fillable = ['date', 'timeslots'];
}
