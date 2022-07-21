<div class="left main-sidebar">
    <div class="sidebar-inner leftscroll">
        <div id="sidebar-menu">
        <ul>
            <li class="submenu">
                <a href="{{ route('home') }}" class=""><i class="fa fa-fw fa-home"></i><span> HOME </span> </a>
            </li>
            @if (Auth::user()->role =="Admin")
            <li class="submenu">
                <a href="#"  class="">
                    <i class="fa fa-fw fa-database"></i> <span> MASTER DATA</span> <span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                    <li class=""><a href="">User Akses</a></li>
                </ul>
            </li>
            @endif
            <li class="submenu">
                <a href="{{ route('bukukas.masuk') }}" class=""><i class="fa fa-folder-open"></i><span> KAS MASUK </span> </a>
            </li>
            <li class="submenu">
                <a href="{{ route('bukukas.keluar') }}" class=""><i class="fa fa-folder"></i><span> KAS KELUAR </span> </a>
            </li>
            <li class="submenu">
                <a href="{{ route('bukukas') }}" class=""><i class="fa fa-print bigfonts"></i><span>LAPORAN KAS </span> </a>
            </li>

        </ul>
        <!-- <div class="clearfix"></div> -->

        </div>

        <!-- <div class="clearfix"></div> -->

    </div>

</div>
