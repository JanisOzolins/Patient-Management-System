        <nav class="navbar navbar-inverse" role="navigation">

            <!-- BRAND AND TOGGLE -->

            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">North Hill Surgery</a>
            </div>

            <!-- TOP RIGHT MENU -->

            <ul class="nav navbar-right top-nav desktop-only">
                @if (Auth::user())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                            {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ url('/logout') }}"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>

            <!-- SIDEBAR --> 

<!--             <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="dropdown mobile-only">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="#">Profile</a></li>
                        <li><a href="{{ url('/logout') }}">Logout</a></li>
                      </ul>
                    </li>

                    <li><a href="{{ url('/') }}"> Dashboard</a></li>

                    <li>
                        <a href="{{ route('appointments.index') }}"> Appointments</a>
                    </li>

                    <li>
                        <a href="{{ route('patients.index') }}"> Patients</a>
                    </li>
                    
                </ul>
            </div> -->
            <!-- /.navbar-collapse -->
        </nav>