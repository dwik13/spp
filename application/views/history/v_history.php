<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 text-dark"><?= $title ?></h3>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->

        <!-- jika levelnya admin atau petugas maka dia bisa mengakses bagian ini -->
        <?php if ($this->session->userdata('level') == "Admin" ): ?>
        <div class="card shadow mb-5">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>NISN</td>
                                <td>Nama Siswa</td>
                                <td>Nama Kelas</td>
                                <td>Tahun Ajaran</td>
                                <td>Nama Petugas</td>
                                <td>Pembayaran Bulan</td>
                                <td>Tanggal Bayar</td>
                                <td>Nominal</td>
                                <td class="text-center">Keterangan</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
               								foreach ($pembayaransiswaadmin as $pem) : ?>
                            <input type="hidden" value="<?= $pem->id_pembayaran ?>">
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $pem->nisn ?></td>
                                <td><?= $pem->nama ?></td>
                                <td><?= $pem->nama_kelas ?></td>
                                <td><?= $pem->tahun ?></td>
                                <td><?= $pem->nama_petugas ?></td>
                                <td><?= $pem->bulan_dibayar ?></td>
                                <td><?= $pem->tgl_bayar ?></td>
                                <td><?= "Rp. " . number_format($pem->jumlah_bayar, 0, '.', '.') ?></td>
                                <?php if ($pem->ket == null) : ?>
                                <td class="text-center text-danger">---</td>
                                <?php else : ?>
                                <td class="text-center text-success"><?= $pem->ket ?></td>
                                <?php endif; ?>
                            </tr>
                            <?php endforeach; ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- DataTales Example -->


        <!-- jika selain level admin dan petugas maka tampilkan bagian ini -->
        <?php elseif($this->session->userdata('level') == "Petugas") : ?>
        <div class="card shadow mb-5">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>NISN</td>
                                <td>Nama Siswa</td>
                                <td>Nama Kelas</td>
                                <td>Tahun Ajaran</td>
                                <td>Nama Petugas</td>
                                <td>Pembayaran Bulan</td>
                                <td>Tanggal Bayar</td>
                                <td>Nominal</td>
                                <td class="text-center">Keterangan</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
               								foreach ($pembayaransiswapetugas as $pem) : ?>
                            <input type="hidden" value="<?= $pem->id_pembayaran ?>">
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $pem->nisn ?></td>
                                <td><?= $pem->nama ?></td>
                                <td><?= $pem->nama_kelas ?></td>
                                <td><?= $pem->tahun ?></td>
                                <td><?= $pem->nama_petugas ?></td>
                                <td><?= $pem->bulan_dibayar ?></td>
                                <td><?= $pem->tgl_bayar ?></td>
                                <td><?= "Rp. " . number_format($pem->jumlah_bayar, 0, '.', '.') ?></td>
                                <?php if ($pem->ket == null) : ?>
                                <td class="text-center text-danger">---</td>
                                <?php else : ?>
                                <td class="text-center text-success"><?= $pem->ket ?></td>
                                <?php endif; ?>
                            </tr>
                            <?php endforeach; ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php else: ?>

        <!-- tampilan untuk siswa -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow card-default">
                    <div class="card-header" style="background-image: linear-gradient(195deg, #538b82, #538b82);">
                        <h5 class="card-title text-bold text-white">History Pembayaran</h5>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead class="text-bold text-white"
                                style="background-image: linear-gradient(195deg, #538b82, #538b82);">
                                <tr>
                                    <th>No</th>
                                    <th>Pembayaran Bulan</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Nominal</th>
                                    <th class="text-center">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                        foreach ($pembayaran as $pem) : ?>
                                <input type="hidden" value="<?= $pem->id_pembayaran ?>">

                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $pem->bulan_dibayar ?></td>
                                    <td><?= mediumdate_indo($pem->tgl_bayar) ?></td>
                                    <td><?= "Rp. " . number_format($pem->jumlah_bayar, 0, '.', '.'); ?></td>
                                    <?php if ($pem->ket == null) : ?>
                                    <td class="text-center text-danger">---</td>
                                    <?php else : ?>
                                    <td class="text-center text-success"><i class="fas fa-check"></i>
                                        <?= $pem->ket ?></td>
                                    <?php endif; ?>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-lg-12 mt-5">
                    <div class="card shadow card-default">
                        <div class="card-header " style="background-image: linear-gradient(195deg, #538b82, #538b82);">
                            <h5 class="card-title text-white text-bold">Tagihan Pembayaran</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead class="text-white"
                                    style="background-image: linear-gradient(195deg, #538b82, #538b82);">
                                    <tr>
                                        <th>No</th>
                                        <th>Bulan Pembayaran</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Nominal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                                        foreach($tagihan as $t){
                                                        ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $t->bulan_dibayar; ?></td>
                                        <td><?= mediumdate_indo($t->jatuh_tempo); ?></td>
                                        <td><?= "Rp. " . number_format($t->jumlah_bayar, 0, '.', '.'); ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <th scope="row" colspan="3"
                                            style="text-align:center ; font-weight:bold; font-size: 20px;">
                                            Total
                                            Tagihan</th>
                                        <th colspan="2" style="font-weight:bold; font-size: 20px; color:red;">
                                            <?= "Rp. " . number_format( $total['jumlah_bayar'], 0, '.', '.'); ?>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php endif; ?>

    </div>




</div>
