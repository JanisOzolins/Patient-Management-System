@extends('layouts.app')

@section('content')
<div class="container">
    @if (Auth::guest())
        return redirect()->route('login');
    @else
        <center>
                <center><ul>
                @foreach ($conditions as $condition)
                    <li>{{ $condition->d_name }}</li>
                @endforeach
                </center></ul>

                <center><ul>

                </center></ul>
        </center>
    @endif
</div>
@endsection
