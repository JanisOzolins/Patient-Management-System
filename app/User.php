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
use DateTime;

class User extends Eloquent implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Notifiable, Authenticatable, Authorizable, CanResetPassword, HybridRelations;

    protected $collection = "patientcollection";

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        '_id', 'first_name', 'last_name', 'user_type', 'birth_date', 'age', 'email', 'phone', 'address', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function conditions()
    {
        return $this->embedsMany('App\Condition', 'condition');
    }

    public function appointments()
    {
        return $this->embedsMany('App\Appointment', 'appointment');
    }

    public function calculateAge($user) 
    {
        $dob = $user->birth_date;

        if(!empty($dob))
        {
            $birthdate = new DateTime($dob);
            $today   = new DateTime('today');
            $age = $birthdate->diff($today)->y;
            return $age;
        }
        else
        {
            return 0;
        }
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
