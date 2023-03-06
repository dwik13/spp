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

                            <!-- jika siswa ini tidak aktif maka tidak bisa mengedit kenaikan ataupun edit data siswa itu -->
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

<!-- edit kenaikan untuk merubah kenaikan kelas siswa -->
<?php foreach ($siswa as $sw) : ?>
<div class="modal fade" id="exampleModaledittahun<?=$sw->nisn?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('masterdata/edit_tahun'); ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" id="id" name="id" value="<?= $sw->nisn; ?>">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="nisn" name="nisn" value="<?= $sw->nisn ?>">
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select class="form-control" id="kelas_id" name="kelas_id">
                            <option value="<?= $sw->id_kelas ?>"><?= $sw->nama_kelas ?></option>

                            <!-- memecah kelas dengan spasi -->
                            <?php foreach ($kelassama as $row){
							$nama_kelas = explode(' ', $row->nama_kelas);
							$kelas1 = trim($nama_kelas[1] .' '. $nama_kelas[2]);
							$kelas3 = trim($nama_kelas[0].' '. $nama_kelas[1] .' '. $nama_kelas[2]);

							?>

                            <!-- memecah kelas sesuai nisn siswa -->
                            <?php $namakls = $sw->nama_kelas;
							$namaklskalimat = explode(' ', $namakls);
							$kelas2 = trim($namaklskalimat[1] .' '. $namaklskalimat[2]);?>

                            <!-- menyamakan kelas untuk diambil -->
                            <?php if($kelas2 === $kelas1) : ?>
                            <option value="<?= $row->id_kelas ?>"><?= $kelas3 ?></option>
                            <?php endif; ?>

                            <?php } ?>
                        </select>

                        <?= form_error('kelas_id', '<small class="text-danger ml-2">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="spp">Tahun</label>
                        <select class="form-control" id="spp_id" name="spp_id">
                            <option value="<?= $sw->id_spp ?>">Tahun: <?= $sw->tahun ?> Nominal: <?= $sw->nominal?>
                            </option>
                            <?php foreach ($spp as $sp) : ?>
                            <option value="<?= $sp->id_spp ?>">Tahun: <?= $sp->tahun ?> Nominal: <?= $sp->nominal ?>
                            </option>
                            <?php endforeach ?>
                        </select>
                        <?= form_error('spp_id', '<small class="text-danger ml-2">', '</small>'); ?>
                    </div>
                    <div class="form-group" id="tempo">
                        <label for="spp">Bulan Awal Bayar</label>
                        <input type="date" class="form-control" id="tempo" name="tempo" value="<?= date('Y-m-d') ?>">
                        <?= form_error('tempo', '<small class="text-danger ml-2">', '</small>'); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="#" class="btn btn-warning text-white" data-toggle="modal" data-dismiss="modal"
                        data-target="#exampleModaleditsiswa<?= $sw->nisn ?>"><i class="fas fa-arrow-left"></i>
                        Kembali?</a>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php endforeach; ?>