<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Cetak siswa berdasarkan kelas</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kelas</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach($cetakkelas as $ctkls ): ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $ctkls->nama_kelas; ?></td>
                            <td>
                                <a class="btn btnhijau text-white mr-3" target="_blank"
                                    href="<?= base_url('Laporan/cetakSiswa/' . $ctkls->id_kelas)?>">
                                    Cetak
                                </a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach; ?>
            </div>


            </tbody>
            </table>
        </div>
    </div>
</div>
</div>