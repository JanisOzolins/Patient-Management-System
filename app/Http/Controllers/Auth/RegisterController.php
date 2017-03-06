<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    public function generateRandomNumber()
    {
        do {
            $randomInt = rand(1000, 9999);
        } 
        while ($this->checkUserId($randomInt));

        return $randomInt;

    }

    public function checkUserId($num)
    {
        $foundUser = User::find($num);

        if ($foundUser === NULL) {
            return false;
        }
        else {
            return true;
        }
    }

    // calculates person's age upon registration
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
            return 0;
    }

    protected function create(array $data)
    {
        $userObjectID = $this->generateRandomNumber();
        $user = User::create([
            '_id' => strval($userObjectID),
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'user_type' => $data['user_type'],
            'address' => $data['address'],
            'birth_date' => $data['birth_date'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $age = $this->calculateAge($user);
        $user->age = $age;

        $one = $user->appointments()->create(['a_patient' => $user->first_name . $user->first_name, 'a_date' => '2017-06-06', 'a_time' => '19:00']);
        $two = $user->appointments()->create(['a_patient' => $user->first_name . $user->first_name, 'a_date' => '2017-04-04', 'a_time' => '12:00']);


        $user->save();

        return $user;

    }
}
