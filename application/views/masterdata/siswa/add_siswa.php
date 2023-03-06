<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800">Tambah Siswa</h1>

    <div class="card shadow mb-4" style="width: 602px;">
        <div class="card-body">
            <?= form_open_multipart('masterdata/add_siswa'); ?>
            <!-- masuk ke controller masterdata add siswa -->
            <div class="form-group">
                <label for="nisn" style="text-align:bold;">NISN</label>
                <input type="number" name="nisn" id="nisn" class="form-control" value="<?= set_value('nisn'); ?>"
                    placeholder="Masukan NISN.." autocomplete="off">
                <span class="text-secondary ml-2">NISN harus 10 digit.</span> <br>
                <?= form_error('nisn', '<small class="text-danger ml-2">', '</small>'); ?>

            </div>
            <div class="form-group">
                <label for="nis" style="text-align:bold;">NIS</label>
                <input type="number" name="nis" id="nis" class="form-control" value="<?= set_value('nis'); ?>"
                    placeholder=" Masukan NIS.." autocomplete="off">
                <span class="text-secondary ml-2">nis harus 8 digit.</span> <br>
                <?= form_error('nis', '<small class="text-danger ml-2">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="nama" style="text-align:bold;">Nama</label>
                <input type="text" name="nama" id="nama" autocomplete="off" class="form-control"
                    value="<?= set_value('nama'); ?>" placeholder="Masukan nama baru..">
                <?= form_error('nama', '<small class="text-danger ml-2">', '</small>'); ?>

            </div>
            <div class="form-group">
                <label for="kelas_id" style="text-align:bold;">Kelas</label>
                <select class="form-control" id="kelas_id" name="kelas_id" value="<?= set_value('kelas_id'); ?>">
                    <option value="" selected>-- Pilih Kelas --</option>
                    <?php foreach ($kelas as $kls) : ?>
                    <option value="<?= $kls['id_kelas'] ?>"><?= $kls['nama_kelas'] ?></option>
                    <?php endforeach ?>
                </select>
                <?= form_error('kelas_id', '<small class="text-danger ml-2">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="spp_id" style="text-align:bold;">Tahun Ajaran</label>
                <select class="form-control" id="spp_id" name="spp_id">
                    <option value="" selected>-- Pilih Tahun Ajaran --</option>
                    <?php foreach ($spp as $sp) : ?>
                    <option value="<?= $sp['id_spp'] ?>">Tahun: <?= $sp['tahun'] ?> Nominal <?= $sp['nominal'] ?>
                    </option>
                    <?php endforeach ?>
                </select>
                <?= form_error('spp_id', '<small class="text-danger ml-2">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="no_telp">No.Telp</label>
                <input type="number" class="form-control" id="no_telp" name="no_telp"
                    value="<?= set_value('no_telp'); ?>" autocomplete="off">
                <span class="text-secondary ml-2">Nomor Telepon maksimal 13 digit.</span> <br>
                <?= form_error('no_telp', '<small class="text-danger ml-2">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="text" style="text-align:bold;">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" autocomplete="off"
                    placeholder="Masukkan alamat.."><?= set_value('alamat'); ?></textarea>
                <?= form_error('alamat', '<small class="text-danger ml-2">', '</small>'); ?>
            </div>
            <div class="form-group">
                <div>Profile</div>
                <div class="col-sm-4 mb-2">

                    <img src="<?= base_url('assets/img/profile/default.png') ?>" class="img-thumbnail">

                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image" name="image">
                    <label for="image" class="custom-file-label">Choose file</label>
                </div>
            </div>

            <div class="form-group" id="tempo">
                <label for="tempo">Mulai Dibayar Bulan</label>
                <input type="date" class="form-control" id="tempo" name="tempo" value="<?= date('Y-m-d') ?>">
                <span class="text-secondary ml-2"></span> <br>
                <!-- Jatuh tempo digunakan untuk pembayaran spp siswa dari dua
                        semester sesuai tahun pelajaran dengan format mm/dd/yy. -->
                <?= form_error('tempo', '<small class="text-danger ml-2">', '</small>'); ?>
            </div>
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-info ">Simpan</button>
                <a href="<?= base_url('masterdata/siswa'); ?>" class="btn btn-secondary ml-3">Batal</a>
            </div>
            <?= form_close(); ?>

        </div>
    </div>


</div>