<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Condition extends Eloquent
{
    protected $fillable = [
        'd_name',
        ];
}
