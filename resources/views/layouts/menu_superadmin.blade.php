<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="/assets/dist/img/avatar3.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p>{{Auth::user()->name}}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

        <li class="">
            <a href="/beranda">
                <i class="fa fa-dashboard"></i> <span>Beranda</span>
                <span class="pull-right-container">
                </span>
            </a>
        </li>

        <li class="header">DATA MASTER</li>
        <li class="">
            <a href="/paket">
                <i class="fa fa-list"></i> <span>Paket</span>
                <span class="pull-right-container">
                </span>
            </a>
        </li>
        <li class="">
            <a href="/pelanggan">
                <i class="fa fa-users"></i> <span>Pelanggan</span>
                <span class="pull-right-container">
                </span>
            </a>
        </li>
        <li class="header">TRANSAKSI</li>

        <li class="">
            <a href="/pemesanan">
                <i class="fa fa-list"></i> <span>Pemesanan</span>
                <span class="pull-right-container">
                </span>
            </a>
        </li>

        <li class="">
            <a href="/pelunasan">
                <i class="fa fa-list"></i> <span>Pelunasan</span>
                <span class="pull-right-container">
                </span>
            </a>
        </li>
        <li class="header">LAPORAN</li>
        <li class="">
            <a href="/laporan/pelanggan">
                <i class="fa fa-file"></i> <span>Lap. Pelanggan</span>
                <span class="pull-right-container">
                </span>
            </a>
        </li>
        <li class="">
            <a href="/laporan/pemesanan">
                <i class="fa fa-file"></i> <span>Lap. Pemesanan</span>
                <span class="pull-right-container">
                </span>
            </a>
        </li>
        <li class="">
            <a href="/laporan/pelunasan">
                <i class="fa fa-file"></i> <span>Lap. Pelunasan</span>
                <span class="pull-right-container">
                </span>
            </a>
        </li>

        <li class="header">SETTING</li>
        <li class="">
            <a href="/logout">
                <i class="fa fa-sign-out"></i> <span>Log Out</span>
                <span class="pull-right-container">
                </span>
            </a>
        </li>

    </ul>
</section>