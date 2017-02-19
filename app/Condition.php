<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Condition extends Eloquent
{
    protected $fillable = [
        'c_name', 'c_diagnosed_at', 'c_isTreated', 'c_details'
        ];
}
