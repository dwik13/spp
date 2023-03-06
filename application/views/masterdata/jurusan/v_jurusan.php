<div class="container-fluid">

    <!-- Page Heading -->
    <!-- tambah jurusan mengarah ke controller masterdata add jurusan -->
    <h1 class="h3 mb-3 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-md-12 mb-4">
            <button type="button" class="btn btnhijau text-white" data-toggle="modal"
                data-target="#exampleModaltambahjurusan">
                Tambah Jurusan
            </button>
        </div>
    </div>

    <!-- flashdata -->
    <?php
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
                            <th>Kompetensi Keahlian</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($jurusan as $jr) : ?>
                        <tr>

                            <th scope="row"><?= $i; ?></th>
                            <td><?= $jr['jurusan']; ?></td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                    data-target="#exampleModaleditjurusan<?=$jr['id_jurusan']?>">
                                    edit
                                </button>
                                <button
                                    onclick="hapusjurusan('<?= base_url('masterdata/hapus_jurusan/' . $jr['id_jurusan']) ?>')"
                                    class="btn btn-danger btn-sm tombol-hapus">Delete</button>
                            </td>
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


<!-- Tambah jurusan -->
<div class="modal fade" id="exampleModaltambahjurusan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- mengarah ke controller masterdata add_jurusan -->
            <form action="<?= base_url('masterdata/add_jurusan'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jurusan" style="text-align:bold;">Kompetensi Keahlian</label>
                        <input type="text" name="jurusan" id="jurusan" class="form-control"
                            placeholder="Masukan kompetensi keahlian..">
                        <?= form_error('jurusan', '<small class="text-danger ml-2">', '</small>'); ?>
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


<!-- edit jurusan -->
<?php foreach ($jurusan as $jrs) : ?>
<div class="modal fade" id="exampleModaleditjurusan<?=$jrs['id_jurusan']?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- mengarah ke controller masterdata edit_jurusan -->
            <form action="<?= base_url('masterdata/edit_jurusan'); ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id_jurusan" id="id_jurusan" value="<?= $jrs['id_jurusan']; ?>">
                    <div class="form-group">
                        <label for="jurusan">Kompetensi Keahlian</label>
                        <input type="text" name="jurusan" id="jurusan" value="<?= $jrs['jurusan']; ?>"
                            autocomplete="off" class="form-control">
                        <?= form_error('jurusan', '<small class="text-danger ml-2">', '</small>'); ?>
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
