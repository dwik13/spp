<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800"><?= $title; ?></h1>
    <!-- tambah petugas masuk pada controller add siswa -->


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Profile</th>
                            <th>NISN</th>
                            <th>NIS</th>
                            <th>Nama Lengkap</th>
                            <th>Kelas</th>
                            <th>Tahun</th>
                            <th>Alamat</th>
                            <th>No.Telp</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <!-- mendapatkan data dari controller masterdata siswa -->
                        <?php $i = 1; ?>
                        <?php foreach ($siswa as $sw) : ?>
                        <tr>

                            <th scope="row"><?= $i; ?></th>
                            <?php if($sw->image == null){ ?>
                            <td><img src="<?= base_url('assets/img/profile/default.png') ?>" class="img-thumbnail">
                                <?php }else{ ?>
                            <td><img src="<?= base_url('assets/img/profile/') . $sw->image; ?>" class="img-thumbnail">
                                <?php } ?>
                            <td><?= $sw->nisn; ?></td>
                            <td><?= $sw->nis; ?></td>
                            <td><?= $sw->nama; ?></td>
                            <td><?= $sw->nama_kelas; ?></td>
                            <td><?= $sw->tahun; ?></td>
                            <td><?= $sw->alamat; ?></td>
                            <td><?= $sw->no_telp; ?></td>
                            <td>
                                <a href="<?= base_url('pembayaran/transaksispp/'. $sw->nisn ) ?>"
                                    class="btn btn-success btn-sm">
                                    Bayar
                                </a>
                            </td>
                        </tr>

                        <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->