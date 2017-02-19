@extends('layouts.app')

@section('content')
<div class="container">
    @if (Auth::guest())
        return redirect()->route('login');
    @else
        <center>
                I'm in a staff view and I'm a {{ $test }}

                </center></ul>
        </center>
    @endif
</div>
@endsection
