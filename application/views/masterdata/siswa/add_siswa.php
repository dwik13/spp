<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="h3 mb-3 text-gray-800">Tambah Siswa</h1>

                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">

            <!-- Page Heading -->

            <div class="row">
                <div class="col-lg-12 mt-3 mb-5">
                    <div class="col-xl-12 col-lg-6">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                                style="background-image: linear-gradient(195deg, #538b82, #538b82);">
                                <h5 class="text-bold text-white">Tambah Siswa</h5>
                            </div>

                            <div class="row-lg-12">
                                <?= form_open_multipart('masterdata/add_siswa'); ?>
                                <div class="col-md-12">
                                    <div style="margin-top: 30px;" class="col-xl-12 col-lg-6">

                                        <!-- masuk ke controller masterdata add siswa -->
                                        <div class="form-group row mb-4">
                                            <label for="nisn" class="col-sm-1 col-form-label">NISN</label>
                                            <div class="col-sm-5">
                                                <input type="number" name="nisn" id="nisn" class="form-control"
                                                    value="<?= set_value('nisn'); ?>" placeholder="Masukan NISN.."
                                                    autocomplete="off">
                                                <span class="text-secondary ml-2">NISN harus 10 digit.</span> <br>
                                                <?= form_error('nisn', '<small class="text-danger ml-2">', '</small>'); ?>
                                            </div>

                                            <label for="nis" class="col-sm-1 col-form-label">NIS</label>
                                            <div class="col">
                                                <input type="number" name="nis" id="nis" class="form-control"
                                                    value="<?= set_value('nis'); ?>" placeholder=" Masukan NIS.."
                                                    autocomplete="off">
                                                <span class="text-secondary ml-2">nis harus 8 digit.</span> <br>
                                                <?= form_error('nis', '<small class="text-danger ml-2">', '</small>'); ?>

                                            </div>

                                        </div>
                                        <div class="form-group row mb-4">

                                            <label for="nama" class="col-sm-1 col-form-label">Nama</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="nama" id="nama" autocomplete="off"
                                                    class="form-control" value="<?= set_value('nama'); ?>"
                                                    placeholder="Masukan nama baru..">
                                                <?= form_error('nama', '<small class="text-danger ml-2">', '</small>'); ?>
                                            </div>

                                            <label for="kelas_id" class="col-sm-1 col-form-label">Kelas</label>
                                            <div class="col">
                                                <select class="form-control" id="kelas_id" name="kelas_id"
                                                    value="<?= set_value('kelas_id'); ?>">
                                                    <option value="" selected>-- Pilih Kelas --</option>
                                                    <?php foreach ($kelas as $kls) : ?>
                                                    <option value="<?= $kls['id_kelas'] ?>"><?= $kls['nama_kelas'] ?>
                                                    </option>
                                                    <?php endforeach ?>
                                                </select>
                                                <?= form_error('kelas_id', '<small class="text-danger ml-2">', '</small>'); ?>

                                            </div>

                                        </div>

                                        <div class="form-group row ">

                                            <label for="spp_id" class="col-sm-1 col-form-label">Tahun Ajaran</label>
                                            <div class="col-sm-5">

                                                <select class="form-control" id="spp_id" name="spp_id">
                                                    <option value="" selected>-- Pilih Tahun Ajaran --</option>
                                                    <?php foreach ($spp as $sp) : ?>
                                                    <option value="<?= $sp['id_spp'] ?>">Tahun: <?= $sp['tahun'] ?>
                                                        Nominal
                                                        <?= $sp['nominal'] ?>
                                                    </option>
                                                    <?php endforeach ?>
                                                </select>
                                                <?= form_error('spp_id', '<small class="text-danger ml-2">', '</small>'); ?>
                                            </div>

                                            <label for="no_telp" class="col-sm-1 col-form-label">No.Telp</label>
                                            <div class="col">
                                                <input type="number" class="form-control" id="no_telp" name="no_telp"
                                                    value="<?= set_value('no_telp'); ?>" autocomplete="off">
                                                <span class="text-secondary ml-2">Nomor Telepon maksimal 13
                                                    digit.</span>
                                                <br>
                                                <?= form_error('no_telp', '<small class="text-danger ml-2">', '</small>'); ?>

                                            </div>

                                        </div>

                                        <div class="form-group row ">
                                            <label for="text" class="col-sm-1 col-form-label">Alamat</label>
                                            <div class="col-sm-5">

                                                <textarea class="form-control" id="alamat" name="alamat" rows="3"
                                                    autocomplete="off"
                                                    placeholder="Masukkan alamat.."><?= set_value('alamat'); ?></textarea>
                                                <?= form_error('alamat', '<small class="text-danger ml-2">', '</small>'); ?>
                                            </div>

                                            <label for="tempo" class="col-sm-1 col-form-label">Mulai Dibayar
                                            </label>
                                            <div class="col mt-2" id="tempo">
                                                <input type="date" class="form-control" id="tempo" name="tempo"
                                                    value="<?= date('Y-m-d') ?>">
                                                <span class="text-secondary ml-2"></span> <br>
                                                <!-- Jatuh tempo digunakan untuk pembayaran spp siswa dari dua
                        semester sesuai tahun pelajaran dengan format mm/dd/yy. -->
                                                <?= form_error('tempo', '<small class="text-danger ml-2">', '</small>'); ?>
                                            </div>

                                        </div>

                                        <div class="form-group row">

                                            <label for="text" class="col-sm-1 col-form-label">Profile</label>
                                            <div class="col-sm-5">
                                                <div class="col-sm-3 mb-2">
                                                    <img src="<?= base_url('assets/img/profile/default.png') ?>"
                                                        class="img-thumbnail">
                                                </div>
                                                <div class="col">
                                                    <label for="image" class="custom-file-label">Choose file</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="image"
                                                            name="image">
                                                        <small>File type: gif, png, jpeg, jpg<br>Max size:2MB</small>
                                                        <small class="text-danger">
                                                            <?php echo form_error('image') ?>
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group" style="text-align:right;">
                                            <a href="<?= base_url('masterdata/siswa'); ?>"
                                                class="btn btn-secondary ">Batal</a>
                                            <button type="submit" class="btn btnhijau btn-info ml-3">Simpan
                                                Data</button>
                                        </div>
                                        <?= form_close(); ?>
                                    </div>
                                </div>

                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </section>
</div>