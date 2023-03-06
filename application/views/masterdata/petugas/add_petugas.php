<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800">Tambah Petugas</h1>

    <div class="card shadow mb-4" style="width: 602px;">
        <div class="card-body">
            <!-- masuk pada controller masterdata add petugas -->
            <form action="<?= base_url('masterdata/add_petugas'); ?>" method="post">
                <div class="form-group">
                    <label for="username" style="text-align:bold;">Username</label>
                    <input type="text" name="username" id="username" value="<?= set_value('username'); ?>"
                        class="form-control" placeholder="Masukan username.." autocomplete="off">
                    <?= form_error('username', '<small class="text-danger ml-2">', '</small>'); ?>

                </div>
                <div class="form-group">
                    <label for="nama_petugas" style="text-align:bold;">Nama Petugas</label>
                    <input type="text" name="nama_petugas" id="nama_petugas" class="form-control"
                        value="<?= set_value('nama_petugas'); ?>" placeholder="Masukan Nama Petugas.."
                        autocomplete="off">
                    <?= form_error('nama_petugas', '<small class="text-danger ml-2">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="password" style="text-align:bold;">Password</label>
                    <input type="password" name="password1" id="password1" class="form-control"
                        placeholder="Masukan password baru.." autocomplete="off">
                    <?= form_error('password1', '<small class="text-danger ml-2">', '</small>'); ?>

                </div>
                <div class="form-group">
                    <label for="password" style="text-align:bold;">Ulangi Password</label>
                    <input type="password" name="password2" id="password2" class="form-control"
                        placeholder="Ulangi password baru.." autocomplete="off">
                    <?= form_error('password2', '<small class="text-danger ml-2">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="level_id" style="text-align:bold;">Level</label>
                    <select class="form-control" id="level_id" name="level_id">
                        <option value="" selected>-- Pilih Level --</option>
                        <?php foreach ($level as $lv) : ?>
                        <option value="<?= $lv['id_level'] ?>"><?= $lv['level'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <?= form_error('level_id', '<small class="text-danger ml-2">', '</small>'); ?>
                </div>
                <div class="form-group mt-5">
                    <button type="submit" class="btn btn-info ">Simpan</button>
                    <a href="<?= base_url('masterdata/petugas'); ?>" class="btn btn-secondary ml-3">Batal</a>
                </div>
            </form>
        </div>
    </div>




</div>
