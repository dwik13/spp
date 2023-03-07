<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800"><?= $title; ?></h1>
    <!-- tambah petugas masuk pada controller add siswa -->

    <div class="row">
        <div class="col-md-12 mb-4">
            <a class="btn btnhijau text-white" href="<?= base_url('masterdata/add_siswa')?>">
                Tambah Siswa
            </a>
        </div>
    </div>


    <?php
	// jika tidak kosong flashdata ditampikan
    if (!empty($this->session->flashdata('message'))) { ?>
    <div class="alert alert-success alert-dismissible" id="flash_data" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?= $this->session->flashdata('message'); ?>
    </div>
    <?php } ?>

    <div id="flash_data">
        <?= $this->session->flashdata('info'); ?>
    </div>


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
                            <th>Status</th>
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
                            </td>
                            <td><?= $sw->nis; ?></td>
                            <td><?= $sw->nama; ?></td>
                            <td><?= $sw->nama_kelas; ?></td>
                            <td><?= $sw->tahun; ?></td>
                            <td><?= $sw->alamat; ?></td>
                            <td><?= $sw->no_telp; ?></td>
                            <td>
                                <?php if ($sw->status == "aktif") { ?>
                                <select name="status" class="badge badge-success status">
                                    <option value="<?= $sw->nisn; ?>aktif" selected>Aktif</option>
                                    <option value="<?= $sw->nisn; ?>tdkaktif">Tidak Aktif</option>
                                </select>
                                <?php }else { ?>
                                <button class="btn btn-danger btn-sm dropdown-toggle">Tidak Aktif</button>
                                <?php } ?>
                            </td>

                            <!-- jika siswa ini  aktif maka  bisa mengedit kenaikan ataupun edit data siswa itu jika tidak aktif maka tidakk dapat mengedit -->
                            <?php if($sw->status == 'aktif'){ ?>
                            <td>
                                <a class="btn btn-success btn-sm"
                                    href="<?= base_url('masterdata/edit_siswa/' . $sw->nisn); ?>">Edit</a>
                                <!-- <button onclick="hapusSiswa('<?= base_url('masterdata/hapus_siswa/' . $sw->nisn ) ?>')"
                                    class="btn btn-danger btn-sm tombol-hapus">Delete</button> -->
                            </td>
                            <?php }else{ ?>
                            <td>

                            </td>
                            <?php } ?>
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