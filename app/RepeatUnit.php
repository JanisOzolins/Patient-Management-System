<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class RepeatUnit extends Eloquent
{
    protected $fillable = [
        'repeat_requested', // when the user requests another month
        'repeat_approved',  // when it got approved by the doctor 
        'repeat_expiry', // when it ends (also date for the NEXT)
        ];
}
