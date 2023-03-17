<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-color  sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('user'); ?>">
        <div class="sidebar-brand-icon">
            <i class=" fas fa-fw fa-solid fa-school"></i></i>
        </div>
        <div class="sidebar-brand-text mx-3">E-SPP</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->

    <!-- jika url segment 1 = user maka active kan -->
    <li class="nav-item <?php if ($this->uri->segment(1) == "user") {
                                echo "active";
                            } ?>">
        <a class="nav-link" href="<?= base_url('user'); ?>">
            <i class="fas fa-fw fa-solid fa-home"></i>
            <span>Dashboard</span></a>
    </li>








    <!-- jika level nya admin maka tampil kan bagian ini -->
    <?php if ($this->session->userdata('level') ==  'Admin') : ?>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Master Data
    </div>

    <!-- Nav Item - Pages Collapse Menu -->

    <!-- masterdata -->
    <?php if ($this->uri->segment(1) == "masterdata"){ ?>
    <li class="nav-item <?php if ($this->uri->segment(1) == "masterdata") {
                                echo "active";
                            } ?>">
        <a class="nav-link " href="<?= base_url('masterdata'); ?>" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Master Data</span>
        </a>
        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Master Data</h6>
                <a class="collapse-item <?= $title == 'Data Petugas' ? 'active' : '' ?>"
                    href="<?= base_url('masterdata/petugas'); ?>">Data Petugas</a>
                <a class="collapse-item <?= $title == 'Data SPP' ? 'active' : '' ?>"
                    href="<?= base_url('masterdata/spp'); ?>">Data SPP</a>
                <a class="collapse-item <?= $title == 'Data Siswa' ? 'active' : '' ?>"
                    href="<?= base_url('masterdata/siswa'); ?>">Data Siswa</a>
                <a class="collapse-item <?= $title == 'Data Jurusan' ? 'active' : '' ?>"
                    href="<?= base_url('masterdata/jurusan'); ?>">Data Jurusan</a>
                <a class="collapse-item <?= $title == 'Data Kelas' ? 'active' : '' ?>"
                    href="<?= base_url('masterdata/kelas'); ?>">Data Kelas</a>
            </div>
        </div>
    </li>


    <?php }else{ ?>
    <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url('masterdata'); ?>" data-toggle="collapse"
            data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Master Data</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Master Data </h6>
                <a class="collapse-item" href="<?= base_url('masterdata/petugas'); ?>">Data Petugas</a>
                <a class="collapse-item" href="<?= base_url('masterdata/spp'); ?>">Data SPP</a>
                <a class="collapse-item" href="<?= base_url('masterdata/siswa'); ?>">Data Siswa</a>
                <a class="collapse-item" href="<?= base_url('masterdata/jurusan'); ?>">Data Jurusan</a>
                <a class="collapse-item" href="<?= base_url('masterdata/kelas'); ?>">Data Kelas</a>
            </div>
        </div>
    </li>

    <?php } ?>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Transaksi
    </div>

    <!-- Nav Item - Charts -->

    <li class="nav-item <?php if ($this->uri->segment(1) == "pembayaran") {
							echo "active";
						} ?>">
        <a class="nav-link" href="<?= base_url('pembayaran/pembayaran'); ?>">
            <i class="fas fa-fw fa-cash-register"></i>
            <span>Transaksi Pembayaran</span></a>
    </li>
    <li class="nav-item <?php if ($this->uri->segment(1) == "history") {
                                echo "active";
                            } ?> ">
        <a class="nav-link" href="<?= base_url('history/history'); ?>">
            <i class="fas fa-fw fa-solid fa-book"></i>
            <span>History Bayar</span></a>
    </li>

    <?php endif; ?>







    <!-- jika level nya petugas tampilkan bagian ini -->
    <?php if ($this->session->userdata('level') ==  'Petugas' ) : ?>

    <!-- Nav Item - Utilities Collapse Menu -->

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Transaksi
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item <?php if ($this->uri->segment(1) == "pembayaran") {
                                echo "active";
                            } ?>">
        <a class="nav-link" href="<?= base_url('pembayaran/pembayaran'); ?>">
            <i class="fas fa-fw fa-cash-register"></i>
            <span>Transaksi Pembayaran</span></a>
    </li>
    <li class="nav-item <?php if ($this->uri->segment(1) == "history") {
                                echo "active";
                            } ?> ">
        <a class="nav-link" href="<?= base_url('history/history'); ?>">
            <i class="fas fa-fw fa-solid fa-book"></i>
            <span>History Bayar</span></a>
    </li>

    <?php endif; ?>



    <!-- jika level nya siswa maka tampilkan bagian ini -->
    <?php if ($this->session->userdata('level') ==  'Siswa' ) : ?>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Transaksi
    </div>

    <!-- Nav Item - Tables -->
    <li class="nav-item <?php if ($this->uri->segment(1) == "history") {
                                echo "active";
                            } ?> ">
        <a class="nav-link" href="<?= base_url('history/history'); ?>">
            <i class="fas fa-fw fa-solid fa-book"></i>
            <span>History Bayar</span></a>
    </li>
    <?php endif; ?>






    <?php if ($this->session->userdata('level') ==  'Admin') : ?>
    <hr class="sidebar-divider d-none d-md-block">

    <div class="sidebar-heading">
        Laporan
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item <?php if ($this->uri->segment(1) == "laporan") {
                                echo "active";
                            } ?>">
        <a class="nav-link" href="<?= base_url('laporan'); ?>">
            <i class="fas fa-fw fa-solid fa-file-pdf"></i> <span>Generate Laporan</span></a>
    </li>
    <?php endif; ?>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <li class="nav-item">
        <a class="nav-link" onclick="keluar('<?= base_url('auth/logout') ?>')">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>

            </div>
        </div>
    </div>
</div>