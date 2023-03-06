<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800">Tambah SPP</h1>

    <div class="card shadow mb-4" style="width: 602px;">
        <div class="card-body">
            <form action="<?= base_url('masterdata/add_spp'); ?>" method="post">

                <label for="tahun">Tahun Ajaran</label>
                <div class="form-group d-flex">

                    <select class="form-control col-lg-3 " id="tahun_awal" name="tahun_awal" onchange="tt()">
                        <option value="">-- Pilih --</option>
                        <?php for ($tahun = 2020; $tahun <= 2050; $tahun++) : ?>
                        <option><?= $tahun ?></option>
                        <?php endfor; ?>
                    </select>

                    <span class="ml-2 mr-2 p-1" style="font-size: 20px;">/</span>

                    <input class="form-control col-lg-3" type="text" name="tahun_akhir" id="tahun_akhir"
                        placeholder="tahun akhir" readonly>
                </div>
                <?= form_error('tahun_awal', '<small class="text-danger ml-2">', '</small>'); ?>
                <?= form_error('tahun_akhir', '<small class="text-danger ml-2">', '</small>'); ?>

                <div class="form-group">
                    <label for="nominal">Nominal</label>
                    <input type="number" class="form-control" id="nominal" autocomplete="off" name="nominal"
                        value="<?= set_value('nominal'); ?>">
                    <?= form_error('nominal', '<small class="text-danger ml-2">', '</small>'); ?>
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-info ">Simpan</button>
                    <a href="<?= base_url('masterdata/spp'); ?>" class="btn btn-secondary ml-3">Batal</a>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
//menambah tahun akhir
function tt() {
    var ta = document.getElementById("tahun_awal").value;
    var ambil = parseInt(ta) + 1;
    document.getElementById('tahun_akhir').value = ambil;
}
</script>
