<?php $appointments = Auth::user()->appointments; $user = Auth::user();  ?>

<div class="manager-homepage">

    <!-- LEFT COLUMN -->

    <div class="col-md-7 left-column">
        <div class="col-md-12 personal-information-section">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        <h4>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }} (manager)</h4>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Personal ID: </strong> {{ Auth::user()->id }}</p>
                        <p><strong>Email: </strong> {{ Auth::user()->email }}</p>
                        <p><strong>Phone: </strong> {{ Auth::user()->phone }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 highlights-section">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row highlights-row">
                        <div class="col-sm-12 col-md-4 highlight-item highlight-1 first active-prescriptions">
                            <h2>{{ count(App\User::where('user_type', 'doctor')->orWhere('user_type', 'nurse')->get()) }}</h2>
                            <h4>Medical Personnel</h4>
                        </div>
                        <div class="col-sm-12 col-md-4 highlight-item highlight-2 unread-messages">
                            <h2>{{ count(App\User::where('user_type', 'staff')->orWhere('user_type', 'manager')->get()) }}</h2>
                            <h4>Staff Members</h4></div>
                        <div class="col-sm-12 col-md-4 highlight-item highlight-3 last repeat-prescriptions"><div class="highlight-inner">
                        <h2>{{ count(App\User::where('user_type', 'patient')->get()) }}</h2>
                        <h4>Patients</h4></div></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12  select-schedule">
            <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Lookup Users</h3>
                </div>
                <div class="panel-body">
                    <!-- <select class="form-control" id="user_selector" name="user_selector" required>
                        @foreach ($users->sortBy('last_name') as $user)
                            @if($loop->first)
                                <option selected value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                            @else
                                <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                            @endif
                        @endforeach
                    </select> -->
                    <form action="/users" method="GET" role="search">
                        {{ csrf_field() }}
                        <div class="input-group">
                            <input type="text" class="form-control" name="q"
                                placeholder="Search users"> <span class="input-group-btn">
                                <button type="submit" class="btn btn-default">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>



    <!-- RIGHT COLUMN -->

    <div class="col-md-5 left-column">
        <div class="col-md-12  add-new-user-section">
            <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Add New User</h3>
                </div>
                <div class="panel-body">
                    @include('auth.register')
                </div>
            </div>
        </div>
    </div>
</div>
