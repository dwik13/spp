<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800">Tambah Kelas</h1>

    <div class="card shadow mb-4" style="width: 602px;">
        <div class="card-body">
            <!-- mengarah ke controller masterdata add kelas -->
            <form action="<?= base_url('masterdata/add_kelas'); ?>" method="post">
                <div class="form-group">
                    <label for="nama_kelas" style="text-align:bold;">Nama Kelas</label>
                    <input type="text" name="nama_kelas" id="nama_kelas" class="form-control" autocomplete="off"
                        placeholder="Masukan nama kelas..">
                    <?= form_error('nama_kelas', '<small class="text-danger ml-2">', '</small>'); ?>

                </div>
                <div class="form-group">
                    <label for="jurusan_id" style="text-align:bold;">jurusan</label>
                    <select class="form-control" id="jurusan_id" name="jurusan_id">
                        <option value="" selected>-- Pilih jurusan --</option>
                        <?php foreach ($jurusan as $jrs) : ?>
                        <option value="<?= $jrs->id_jurusan ?>"><?= $jrs->jurusan ?></option>
                        <?php endforeach ?>
                    </select>
                    <?= form_error('jurusan_id', '<small class="text-danger ml-2">', '</small>'); ?>
                </div>
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-info ">Simpan</button>
                    <a href="<?= base_url('masterdata/kelas'); ?>" class="btn btn-secondary ml-3">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>