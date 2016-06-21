<nav class="navbar navbar-default" style="background-color:#EAE6DE;">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!--<a class="navbar-brand" href="/">Xchanger</a>-->
            <a class="navbar-brand" href="/"><img src="{{asset('images/logo.png')}}" style="max-height:35px; margin-top:-3px;"></a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                @if (!Auth::guest())
                @if(Auth::user()->account_type==1)
                <li><a href="{{url('admin/professor/all')}}">{{trans('translations.allProfessors')}}</a></li>
                <li><a href='{{url('admin/student/all')}}'>{{trans('translations.allStudents')}}</a></li>               
                @endif
                @if(Auth::user()->account_type==2)
                <li><a href="{{url('group/all')}}">{{trans('translations.myGroups')}}</a></li>
                <li><a href='{{url('professor/allTasks')}}'>{{trans('translations.allTasks')}}</a></li>               
                @endif
                <li><a href="/course/all">{{trans('translations.allCourses')}}</a></li>
                @if(Auth::user()->account_type==3)
                <li><a href='{{url('studgroup/all')}}'>{{trans('translations.myGroups')}}</a></li>
                <li><a href='{{url('user/uploads/student')}}'>{{trans('translations.myUploads')}}</a></li>
                <li><a href='{{url('user/unresolved/student')}}'>{{trans('translations.unresolved')}}</a></li>                       
                @endif
                @endif
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if(Session::get('locale')=='en')
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">English <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{url('/lang/de')}}">Deutsch</a></li>
                    </ul>
                </li>
                @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Deutsch <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{url('/lang/en')}}">English</a></li>
                    </ul>
                </li>
                @endif
                @if (Auth::guest())
                <li><a href="/auth/login">{{trans('translations.login')}}</a></li>
<!--                <li><a href="/auth/register">Register</a></li>-->
                @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/user/password">{{trans('translations.changePassword')}}</a></li>
                        <li><a href="/auth/logout">{{trans('translations.logout')}}</a></li>
                    </ul>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>