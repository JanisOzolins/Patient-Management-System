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
        $user = User::find(request('n_user_id'));

        $author = Auth::user()->first_name . ' ' . Auth::user()->last_name;

        $note = $user->notes()->create(['n_author' => $author, 'n_content' => request('n_content')]);

        $user->save();

        return redirect('/user/' . request('n_user_id'));
    }

	public function delete($uid, $nid) 
	{
		$user = User::find($uid);

		$note = $user->notes()->find($nid);

		$note->delete();

		$user->save();

		return redirect()->route('user.show', ['id' => $uid]);
	}
}
