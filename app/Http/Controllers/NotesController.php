<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Auth;

class NotesController extends Controller
{
    public function store() 
    {
    	//return request()->all();
        $user = User::find(request('patient_id'));
        $appointment = $user->appointments()->find(request('appointment_id'));

        $author = Auth::user()->first_name . ' ' . Auth::user()->last_name;

        $note = $appointment->notes()->create(['n_author' => $author, 'n_content' => request('n_content')]);

        $user->save();

        return redirect('/user/' . request('patient_id') . '/appointments/' . request('appointment_id'));
    }

	public function delete($uid, $aid, $nid) 
	{
		$user = User::find($uid);
		$appointment = $user->appointments()->find($aid);

		$note = $appointment->notes()->find($nid);

		//return $note;

		$note->delete();

		$user->save();

		return redirect('/user/' . $uid . '/appointments/' . $aid);
	}
}
