<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use Illuminate\Support\Collection;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use DateTime;

class User extends Eloquent implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Notifiable, Authenticatable, Authorizable, CanResetPassword, HybridRelations, SoftDeletes;

    // enable soft delete timestamp
    protected $dates = ['created_at', 'updated_at', 'deleted_at']; // specify database collection
    protected $collection = "users";
    // specify mass-assignable fields
    protected $fillable = ['_id', 'first_name', 'gender', 'last_name', 'user_type', 'birth_date', 'age', 'email', 'phone', 'address', 'password', 'confirmation_code', 'confirm'];
    // specify protected fields
    protected $hidden = ['password', 'remember_token'];

    public function appointments()
    {
        return $this->embedsMany('App\Appointment', 'appointment');
    }

    public function schedules()
    {
        return $this->embedsMany('App\Schedule', 'schedule');
    }

    public function generalnotes()
    {
        return $this->embedsMany('App\GeneralNote', 'general_notes');
    }

    public function searchUsers($query, $keyword)
    {
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword) {
                $query->where("name", "LIKE","%$keyword%")
                    ->orWhere("email", "LIKE", "%$keyword%")
                    ->orWhere("birth_date", "LIKE", "%$keyword%")
                    ->orWhere("phone", "LIKE", "%$keyword%");
            });
        }
        return $query;
    }



    public function isStaff($user) {
        if ($user->user_type == "staff") {

            return "staff";

        }
        elseif ($user->user_type == "doctor") {

            return "doctor";
            
        }
        elseif ($user->user_type == "manager") {

            return "manager";
            
        }
        else {

            return "patient";

        }
    }
}
