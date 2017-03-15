<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ConditionsController extends Controller
{

    public function index()
    {
        //
    }

    public function create($id) {

        $user = User::find($id);

        return view('conditions.create')->with('user', $user);

    }

    public function store() 
    {
        $user = User::find(request('patient_id'));

        $appointment = $user->appointments()->find(request('appointment_id'));

        if ($appointment->conditions()->find(request('condition_id')) != NULL) // checks if condition needs to be updated instead of created
        {
            $condition = $user->conditions()->find(request('condition_id'));

            $condition->c_name = request('c_name');
            $condition->c_diagnosed_at = request('c_diagnosed_at');
            $condition->c_isTreated = request('c_isTreated');
            $condition->c_details = request('c_details');

            $condition->save();

            return redirect('/user/' . request('patient_id'));
        }

        $condition = $appointment->conditions()->create([
            'c_name' => request('c_name'), 
            'c_diagnosed_at' => request('c_diagnosed_at'), 
            'c_isTreated' => request('c_isTreated'), 
            'c_details' => request('c_details')
        ]);

        $condition->save();

        return redirect('/user/' . request('patient_id'));
    }

    public function delete($uid, $cid) 
    {
        $user = User::find($uid);

        $condition = $user->conditions()->find($cid);

        $condition->delete();

        $user->save();

        return redirect('/user/' . $uid);
    }

}
