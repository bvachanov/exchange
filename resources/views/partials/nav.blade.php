<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Xchanger</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="/">Home</a></li>
                @if (!Auth::guest())
                @if(Auth::user()->account_type==2)
                <li><a href="/group/all">My Groups</a></li>
                <li><a href='{{url('professor/allTasks')}}'>All Tasks</a></li>
                
                @endif
                <li><a href="/course/all">Courses</a></li>
                @if(Auth::user()->account_type==3)
                <li><a href='{{url('studgroup/all')}}'>My groups</a></li>
                <li><a href='{{url('user/uploads/student')}}'>My uploads</a></li>
                <li><a href='{{url('user/unresolved/student')}}'>Unresolved tasks</a></li>                       
                @endif
                @endif
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if(Session::get('locale')=='en')
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">English <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/lang/de">Deutsch</a></li>
                    </ul>
                </li>
                @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Deutsch <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/lang/en">English</a></li>
                    </ul>
                </li>
                @endif
                @if (Auth::guest())
                <li><a href="/auth/login">Login</a></li>
                <li><a href="/auth/register">Register</a></li>
                @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/auth/logout">Logout</a></li>
                    </ul>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>