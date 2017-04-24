<!-- Sidebar -->
<div id="sidebar-wrapper">
    <div class="logged-in-as">
        <center><p><strong>{{ Auth::user()->first_name}} {{ Auth::user()->last_name}}</strong></p></center>
    </div>
    <ul class="sidebar-nav">
        <li> <a href="{{ URL::to('/') }}">Home</a> </li>
        @if(Auth::user()->user_type !== "patient")
            <li> <a href="{{ URL::to('/patients') }}">Patients</a> </li>
        @endif
        @if(Auth::user()->user_type !== "patient" && Auth::user()->user_type !== "manager")
            <li> <a href="{{ URL::to('/schedule') }}">Schedule</a> </li>
        @endif
        @if(Auth::user()->user_type !== "patient")
            <li> <a href="{{ URL::to('/appointments') }}">Appointments</a> </li> 
        @endif
        @if(Auth::user()->user_type === "patient")
            <li> <a href="{{ URL::to('/user/' . Auth::user()->id ) }}">Your Medical Profile</a> </li> 
        @endif
        <li> <a href="{{ URL::to('/edit-profile/' . Auth::user()->id ) }}">Edit Profile</a> </li> 
        <li> <a href="/logout/">Logout</a> </li> 
    </ul>
</div>
<!-- /#sidebar-wrapper -->