<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class NotesController extends Controller
{
    public function store() 
    {
    	// find the user
        $user = User::find(request('n_user_id'));

        // add embedded 'Conditions' instance
        $note = $user->notes()->create(['n_content' => request('n_content')]);


        // save changes
        $user->save();

        // redirect to the user's profile page
        return redirect('/user/' . request('n_user_id'));
    }
}
