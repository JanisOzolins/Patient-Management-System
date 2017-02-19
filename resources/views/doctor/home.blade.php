@extends('layouts.app')

@section('content')
<div class="container">
    @if (Auth::guest())
        return redirect()->route('login');
    @else
        <center>
                <h1>THIS IS DOCTOR'S DASHBOARD</h1>

                <div class="col-md-4">
                    <ul class="list-group">
                        @foreach($users as $user)
                            <li class="list-group-item"> {{ $user->last_name }}, {{ $user->first_name }} </li>
                        @endforeach
                    </ul>
                </div>

        </center>
    @endif
</div>
@endsection
