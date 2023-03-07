<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800">Edit Siswa</h1>

    <div class="card shadow mb-4" style="width: 602px;">
        <div class="card-body">
            <?= form_open_multipart('masterdata/edit_siswa/' . $imagesiswa['nisn']); ?>
            <div class="modal-body">
                <input type="hidden" id="id" name="id" value="<?= $imagesiswa['nisn']; ?>">
                <div class="form-group">
                    <label for="nisn">NISN</label>
                    <input type="text" class="form-control" id="nisn" name="nisn" value="<?= $imagesiswa['nisn'] ?>"
                        disabled>
                    <span class="text-secondary ml-2">NISN harus 10 digit.</span> <br>
                    <?= form_error('nisn', '<small class="text-danger ml-2">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="nis">NIS</label>
                    <input type="number" class="form-control" id="nis" name="nis" value="<?= $imagesiswa['nis'] ?>"
                        autocomplete="off">
                    <span class="text-secondary ml-2">nis harus 8 digit.</span> <br>
                    <?= form_error('nis', '<small class="text-danger ml-2">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $imagesiswa['nama'] ?>">
                    <?= form_error('nama', '<small class="text-danger ml-2">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <div>Profile</div>
                    <div class="col-sm-4 mb-2">
                        <?php if($imagesiswa['image'] == null){ ?>
                        <img src="<?= base_url('assets/img/profile/default.png') ?>" class="img-thumbnail">
                        <?php }else{ ?>
                        <img src="<?= base_url('assets/img/profile/') . $imagesiswa['image']; ?>" class="img-thumbnail">
                        <?php } ?>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image"
                            value="<?=$imagesiswa['image'];?>">
                        <label for="image" class="custom-file-label">Choose file</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat"
                        rows="3"><?= $imagesiswa['alamat'] ?></textarea>
                    <?= form_error('alamat', '<small class="text-danger ml-2">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="no_telp">No.Telp</label>
                    <input type="number" class="form-control" id="no_telp" name="no_telp"
                        value="<?= $imagesiswa['no_telp'] ?>" autocomplete="off">
                    <span class="text-secondary ml-2">Nomor Telepon maksimal 13 digit.</span> <br>
                    <?= form_error('no_telp', '<small class="text-danger ml-2">', '</small>'); ?>
                </div>
            </div>
            <div class="modal-footer">
                <a href="<?= base_url('masterdata/siswa'); ?>" class="btn btn-secondary ml-3">Batal</a>
                <button type="button" class="btn btn-warning " data-toggle="modal" data-dismiss="modal"
                    data-target="#exampleModaledittahun<?=$imagesiswa['nisn']?>"><i
                        class="fas fa-solid fa-angle-up"></i>
                    Ubah
                    Kenaikan?
                </button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            <?= form_close(); ?>

        </div>
    </div>


</div>


<!-- edit kenaikan untuk merubah kenaikan kelas siswa jika kenaikan diubah maka pada tabel pembayaran ditambahkan -->
<?php foreach ($siswa as $sw) : ?>
<div class="modal fade" id="exampleModaledittahun<?=$sw->nisn?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Kenaikan Siswa</h5>
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
							$kelas1 = trim($nama_kelas[1] .' '. $nama_kelas[2]); // RPL 1
							$kelas3 = trim($nama_kelas[0].' '. $nama_kelas[1] .' '. $nama_kelas[2]); // X RPL 1

							?>

                            <!-- memecah kelas sesuai nisn siswa -->
                            <?php $namakls = $sw->nama_kelas;
							$namaklskalimat = explode(' ', $namakls);
							$kelas2 = trim($namaklskalimat[1] .' '. $namaklskalimat[2]); // RPL 1
							?>

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
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>




<?php endforeach; ?>