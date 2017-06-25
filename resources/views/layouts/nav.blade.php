<nav class="navbar navbar-inverse mobile-only">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">{{ config('app.name', 'Laravel') }}</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav mobile-menu">
            <li> <a href="{{ URL::to('/') }}">Home</a> </li>
        @if(Auth::user()->user_type !== "patient" && Auth::user()->user_type !== "manager")
            <li role="separator" class="divider"></li>
            <li> <a href="{{ URL::to('/patients') }}">Patients</a> </li>
        @endif
        @if(Auth::user()->user_type === "manager")
            <li role="separator" class="divider"></li>
            <li> <a href="{{ URL::to('/users') }}">All System Users</a> </li>
        @endif
        @if(Auth::user()->user_type !== "patient" && Auth::user()->user_type !== "manager")
            <li role="separator" class="divider"></li>
            <li> <a href="{{ URL::to('/schedule') }}">Schedule</a> </li>
        @endif
        @if(Auth::user()->user_type !== "patient")
            <li role="separator" class="divider"></li>
            <li> <a href="{{ URL::to('/appointments') }}">Appointments</a> </li> 
        @endif
        @if(Auth::user()->user_type === "patient")
            <li role="separator" class="divider"></li>
            <li> <a href="{{ URL::to('/user/' . Auth::user()->id ) }}">Your Medical Profile</a> </li> 
        @endif
            <li role="separator" class="divider"></li>
            <li> <a href="{{ URL::to('/edit-profile/' . Auth::user()->id ) }}">Edit Profile</a> </li>
            <li role="separator" class="divider"></li>
            <li> <a href="/logout/">Logout</a> </li> 
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>