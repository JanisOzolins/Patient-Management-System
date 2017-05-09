<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class GeneralNote extends Eloquent
{
    protected $fillable = ['gn_content', 'gn_author']; 
}
