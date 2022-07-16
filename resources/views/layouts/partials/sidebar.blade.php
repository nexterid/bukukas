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
                    <li class=""><a href="">Unit</a></li>
                    <li class=""><a href="">Klasifikasi</a></li>
                    <li class=""><a href="">User Akses</a></li>
                </ul>
            </li>
            @endif
            <li class="submenu">
                <a href="" class=""><i class="fa fa-envelope"></i><span> SURAT MASUK </span> </a>
            </li>
            <li class="submenu">
                <a href="" class=""><i class="fa fa-folder-open"></i><span> SURAT KELUAR </span> </a>
            </li>
        </ul>
        <!-- <div class="clearfix"></div> -->

        </div>

        <!-- <div class="clearfix"></div> -->

    </div>

</div>
