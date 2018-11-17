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
            <li>
                <a id="nav-dashboard" href="{{url('/')}}"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li class="heading">FEATURES</li>
            <li id="nav-user">
                <a href="{{route('user.index')}}"><i class="sidebar-item-icon fa fa-user-circle"></i>
                    <span class="nav-label">Users</span></a>
            </li>
    
            <li id="nav-books">
                <a href="#"><i class="sidebar-item-icon fa fa-book"></i>
                    <span class="nav-label">Books</span><i class="fa fa-angle-left arrow"></i></a>
                <ul id="colapse-book" class="nav-2-level collapse">
                    <li>
                        <a id="nav-listbook" href="{{route('book.index')}}">List Books</a>
                    </li>
                    <li>
                        <a id="nav-categories" href="{{route('category.index')}}">Book Categories</a>
                    </li>
                </ul>
            </li>
            
            
            {{--<li>--}}
                {{--<a href="{{route('book.index')}}"><i class="sidebar-item-icon fa fa-book"></i>--}}
                    {{--<span class="nav-label">Books</span></a>--}}
            {{--</li>--}}
            <li>
                <a href="{{url('icon')}}"><i class="sidebar-item-icon fa fa-smile-o"></i>
                    <span class="nav-label">Icons</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
<!-- END SIDEBAR-->




