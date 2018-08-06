<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                @if(Auth::user()->gambar=='')
                    <img class="rounded-circle" src="{{asset('images/user/default.jpg')}}" width="50px"/>
                @else
                    <img class="rounded-circle" src="{{asset('images/user/'. Auth::user()->gambar)}}" width="50px"/>
                @endif
            </div>
            <div class="admin-info">
                <div class="font-strong uppercase">{{ Auth::user()->name }}</div>
                <small>{{ Auth::user()->level }}</small>
            </div>
        </div>
        <ul class="side-menu metismenu">
            <li id="nav-dashboard" class="">
                <a href="/"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li class="heading">FEATURES</li>
            <li id="nav-user" class="">
                <a href="{{url('user')}}"><i class="sidebar-item-icon fa fa-user-circle"></i>
                    <span class="nav-label">Users</span></a>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-edit"></i>
                    <span class="nav-label">Forms</span></a>
            </li>
            <li>
                <a href="#"><i class="sidebar-item-icon fa fa-smile-o"></i>
                    <span class="nav-label">Icons</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
<!-- END SIDEBAR-->




