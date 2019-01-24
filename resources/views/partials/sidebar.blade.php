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
            @if(Auth::user()->level == 'admin')
                <li id="nav-user">
                    <a href="{{route('user.index')}}"><i class="sidebar-item-icon fa fa-user-circle"></i>
                        <span class="nav-label">Users</span></a>
                </li>
        
                <li id="nav-members">
                    <a href="{{route('member.index')}}"><i class="sidebar-item-icon fa fa-users"></i>
                        <span class="nav-label">Members</span></a>
                </li>
            @endif
            <li id="nav-books">
                <a href="{{route('book.index')}}"><i class="sidebar-item-icon fa fa-book"></i>
                    <span class="nav-label">List Books</span></a>
            </li>
            <li id="nav-transactions">
                <a href="{{route('transaction.index')}}"><i class="sidebar-item-icon fa fa-address-book"></i>
                    <span class="nav-label">Transaction</span></a>
            </li>
    
    
            <li id="nav-laporan">
                <a href="#"><i class="sidebar-item-icon fa fa-tasks"></i>
                    <span class="nav-label">Laporan</span><i class="fa fa-angle-left arrow"></i></a>
                <ul id="colapse-laporan" class="nav-2-level collapse">
                    <li>
                        <a id="nav-lapbook" href="{{url('laporan/book')}}">Laporan Buku</a>
                    </li>
                    <li>
                        <a id="nav-laptrans" href="{{url('laporan/trs')}}">Laporan Transaksi</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<!-- END SIDEBAR-->




