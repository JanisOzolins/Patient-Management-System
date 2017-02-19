<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = [
        'p_name', 'p_expiry', 'p_isRepeat', 'p_details'
        ];
}
