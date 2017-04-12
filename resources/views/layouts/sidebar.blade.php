<!-- Sidebar -->
<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li>
            <a href="{{ URL::to('/') }}">Home</a>
        </li>
        <li>
            <a href="{{ URL::to('/patients') }}"">Patients</a>
        </li>
        <li>
            <a href="{{ URL::to('/schedule') }}"">Schedule</a>
        </li>
        <li>
            <a href="{{ URL::to('/appointments') }}"">Appointments</a>
        </li>
        <li>
            <a href="/edit-profile/">Edit Profile</a>
        </li>
        <li>
            <a href="/logout/">Logout</a>
        </li>
    </ul>
</div>
<!-- /#sidebar-wrapper -->