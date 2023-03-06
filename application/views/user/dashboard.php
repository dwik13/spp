<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>


    <!-- user bisa mengakses bagian ini jika level nya admin -->
    <?php if ($this->session->userdata('level') ==  'Admin') : ?>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Data Petugas
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_petugas ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-solid fa-user-tie fa-2x text-gray-300"></i></i>
                        </div>
                    </div>
                    <a href="<?= base_url('masterdata/petugas'); ?>" class="small-box-footer">Info Lebih <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Data Siswa
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $this->db->get_where('tb_siswa',['status' => 'aktif'])->num_rows(); ?></div>

                        </div>

                        <div class="col-auto">
                            <i class="fas fa-solid fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <a href="<?= base_url('masterdata/siswa'); ?>" class="small-box-footer">Info Lebih <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Pembayaran
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        <?= $this->db->get_where('tb_pembayaran',['KET' => 'LUNAS'])->num_rows(); ?>
                                    </div>
                                </div>
                                <!-- <div class="col">
										<div class="progress progress-sm mr-2">
											<div class="progress-bar bg-info" role="progressbar" style="width: 50%"
												aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div> -->
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <a href="<?= base_url('history/history'); ?>" class="small-box-footer">Info Lebih <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= date('d F Y') ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12 col-lg-12 mb-5">

        <!-- Illustrations -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between "
                style="background-image: linear-gradient(195deg, #538b82, #538b82);">
                <h5 class="text-bold text-white">E-SPP</h5>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 250px;"
                        src="<?=base_url('assets/img/image/spp.png')?>" alt="...">
                </div>
                <p>Aplikasi sistem informasi pembayaran SPP
                    merupakan suatu sistem
                    yang dapat digunakan untuk
                    melakukan transaksi pembayaran SPP (sumbangan pembinaan pendidikan).Aplikasi manajemen spp ini
                    menyajikan informasi data yang dapat diakses melalui web browser pada komputer.</p>
                <!-- <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on
		unDraw &rarr;</a> -->
            </div>
        </div>

    </div>


    <!-- user bisa mengakses bagian ini jika level nya petugas -->
    <?php elseif ($this->session->userdata('level') == 'Petugas') : ?>
    <div class="container-fluid">
        <div class="col-xl-12 col-lg-12 mb-4">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between "
                    style="background-image: linear-gradient(195deg, #538b82, #538b82);">
                    <h5 class="text-bold text-white">E-SPP</h5>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 250px;"
                            src="<?=base_url('assets/img/image/spp.png')?>" alt="...">
                    </div>
                    <p>Aplikasi sistem informasi pembayaran SPP
                        merupakan suatu sistem
                        yang dapat digunakan untuk
                        melakukan transaksi pembayaran SPP (sumbangan pembinaan pendidikan).Aplikasi manajemen spp ini
                        menyajikan informasi data yang dapat diakses melalui web browser pada komputer.</p>
                    <!-- <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on
		unDraw &rarr;</a> -->
                </div>
            </div>

        </div>
    </div>


    <!-- user dapat mengakses bagian ini jika level nya itu siswa -->
    <?php else : ?>
    <div class="row">

        <!-- <div class="col-xl-6 col-lg-6 mb-4">


            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between "
                    style="background-image: linear-gradient(195deg, #538b82, #538b82);">
                    <h5 class="text-bold text-white">E-SPP</h5>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 270px;"
                            src="<?=base_url('assets/img/image/spp.png')?>" alt="...">
                    </div>
                    <p>Aplikasi sistem informasi pembayaran SPP
                        merupakan suatu sistem
                        yang dapat digunakan untuk
                        melakukan transaksi pembayaran SPP (sumbangan pembinaan pendidikan).</p>
                   
                </div>
            </div>

        </div> -->












        <div class="col-xl-12 col-lg-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                    style="background-image: linear-gradient(195deg, #538b82, #538b82);">
                    <h5 class="text-bold text-white">BIODATA SISWA</h5>
                </div>

                <div>
                    <div class="row">
                        <div class="col-md-4 mt-2">
                            <div style=" padding: 20px;">
                                <?php if($siswa['image'] == null){ ?>
                                <img src="<?= base_url('assets/img/profile/default.png') ?>" class="img-thumbnail">
                                <?php }else if($siswa['image'] != null){ ?>
                                <img src="<?= base_url('assets/img/profile/') . $siswa['image']; ?>"
                                    class="img-thumbnail">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div style="margin-top: 30px;">

                                <table class="col-xl-11 col-lg-6 table table-condensed table-striped mb-4">
                                    <tbody>
                                        <tr>
                                            <td width="40%">
                                                NISN
                                            </td>
                                            <td width="10">
                                                :
                                            </td>
                                            <td>
                                                <?= $siswa['nisn'] ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%">
                                                NIS
                                            </td>
                                            <td width="10">
                                                :
                                            </td>
                                            <td>
                                                <?= $siswa['nis'] ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%">
                                                Nama Lengkap
                                            </td>
                                            <td width="10">
                                                :
                                            </td>
                                            <td>
                                                <?= $siswa['nama'] ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%">
                                                kelas
                                            </td>
                                            <td width="10">
                                                :
                                            </td>
                                            <td>
                                                <?= $siswa['nama_kelas'] ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td width="40%">
                                                Kompetensi Keahlian
                                            </td>
                                            <td width="10">
                                                :
                                            </td>
                                            <td>
                                                <?= $siswa['jurusan'] ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%">
                                                Tahun
                                            </td>
                                            <td width="10">
                                                :
                                            </td>
                                            <td>
                                                <?= $siswa['tahun'] ?>
                                            </td>

                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php endif; ?>

    <!-- Content Row -->

    <!-- Content Column -->

    <!-- Illustrations -->




</div>
