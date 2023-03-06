<div class="container">
    <div class="card" style="width: 20rem;">
        <div class="card-header text-white" style="background-image: linear-gradient(195deg, #538b82, #538b82);">
            <?= $title ?>
        </div>
        <ul class="list-group list-group-flush">
            <!-- cetak petugas -->
            <li class="list-group-item">Cetak Petugas <br><br><a href="<?=site_url('laporan/cetakPetugas') ?>"
                    target="_blank" class="btn btnhijau text-white">Cetak Petugas</a></li>
            <!-- cetak siswa -->
            <li class="list-group-item">Cetak Siswa Berdasarkan Kelas <br><br><a
                    href="<?=site_url('laporan/laporan_siswa') ?>" class="btn btnhijau text-white">Cetak
                    Siswa</a></li>

            <!-- modal filter transaksi -->
            <li class="list-group-item">Cetak Transaksi <br><br><button type="button" class="btn btnhijau text-white"
                    data-toggle="modal" data-target="#exampleModalTransaksi">Cetak Transaksi</button></li>
        </ul>
    </div>


    <!-- filter tanggal transaksi -->
    <div class="modal fade" id="exampleModalSiswa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cetak Siswa </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card mb-4">
                    <div class="card-body py-3 d-flex row">


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- filter tanggal transaksi -->
    <div class="modal fade" id="exampleModalTransaksi" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cetak Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="<?= base_url('laporan/cetakPembayaran') ?>" method="post" target="_blank"
                            class="form-user">
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label">
                                    Tanggal Mulai
                                </label>
                                <div class="col-sm-7">
                                    <input type="date" name="tanggal_mulai" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label">
                                    Tanggal Ahir
                                </label>
                                <div class="col-sm-7">
                                    <input type="date" name="tanggal_ahir" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">

                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btnhijau text-white">Submit</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>