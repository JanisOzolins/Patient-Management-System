@extends('layouts.app')

@section('content')
<div class="container">
    @if (Auth::guest())
        return redirect()->route('login');
    @else
        <center>
            @foreach($users as $user)
                {{ $user }}
            @endforeach
        </center>
    @endif
</div>
@endsection
