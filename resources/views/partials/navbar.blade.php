<header class="header">
    <div class="page-brand">
        <a class="link" href="/">
            <span class="brand">My
                <span class="brand-tip">PERPUS</span>
            </span>
            {{--<span class="brand-mini">AC</span>--}}
        </a>
    </div>
    <div class="flexbox flex-1">
        <!-- START TOP-LEFT TOOLBAR-->
        <ul class="nav navbar-toolbar">
            <li>
                <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
            </li>
            <li>
                <form class="navbar-search" method="GET" action={{route('book.index')}}>
                    <div class="rel">
                        <span class="search-icon"><i class="ti-search"></i></span>
                        <input class="form-control" name="search" placeholder="Search here..." value="">
                    </div>
                </form>
            </li>
        </ul>
        <!-- END TOP-LEFT TOOLBAR-->
        <!-- START TOP-RIGHT TOOLBAR-->
        <ul class="nav navbar-toolbar">
            <li>
                <span>Welcome!</span>
            </li>
            <li class="dropdown dropdown-user">
                <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                    @if(Auth::user()->gambar=='')
                        <img class="usernotif" src="{{asset('images/user/default.jpg')}}" width="45px"/>
                    @else
                        <img class="usernotif" src="{{asset('images/user/'. Auth::user()->gambar)}}" width="45px"/>
                    @endif
                    <span>{{ Auth::user()->name }}</span><i class="fa fa-angle-down m-l-5"></i></a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ url('user', Auth::user()->id)}}"><i class="fa fa-user"></i>Profile</a>
                    <a class="dropdown-item" href="{{ route('user.edit', Auth::user()->id)}}"><i class="fa fa-cog"></i>Settings</a>
                    <li class="dropdown-divider"></li>
                    
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i>Logout
                    </a>
                    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf </form>
                </ul>
            </li>
        </ul>
        <!-- END TOP-RIGHT TOOLBAR-->
    </div>
</header>
