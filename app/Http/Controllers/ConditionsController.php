<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ConditionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id) {

        $user = User::find($id);

        return view('conditions.create')->with('user', $user);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store() 
    {
        // find the user
        $user = User::find(request('c_user_id'));

        // add embedded 'Conditions' instance
        $condition = $user->conditions()->create(['c_name' => request('c_name'), 'c_diagnosed_at' => request('c_diagnosed_at'), 'c_isTreated' => request('c_isTreated'), 'c_details' => request('c_details')]);

        // save changes
        $condition->save();

        // redirect to the user's profile page
        return redirect('/user/' . request('c_user_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
