<div class="container-fluid">

    <!-- Page Heading -->
    <!-- tambah kelas mengarah ke controller masterdata add kelas -->
    <h1 class="h3 mb-3 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-md-12 mb-4">
            <a class="btn btnhijau text-white" href="<?= base_url('masterdata/add_kelas')?>">
                Tambah Kelas
            </a>
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
                            <th>Kelas</th>
                            <th>Kompetensi Keahlian</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($kelas as $kl) : ?>
                        <tr>

                            <th scope="row"><?= $i; ?></th>
                            <td><?= $kl->nama_kelas; ?></td>
                            <td><?= $kl->jurusan; ?></td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                    data-target="#exampleModaleditkelas<?=$kl->id_kelas ?>">
                                    edit
                                </button>
                                <button
                                    onclick="hapuskelas('<?= base_url('masterdata/hapus_kelas/' . $kl->id_kelas) ?>')"
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


<!-- edit kelas -->
<?php foreach ($kelas as $kls) : ?>
<div class="modal fade" id="exampleModaleditkelas<?=$kls->id_kelas?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- mengarah ke controller masterdata edit_kelas -->
            <form action="<?= base_url('masterdata/edit_kelas'); ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id_kelas" id="id_kelas" value="<?= $kls->id_kelas; ?>">
                    <div class="form-group">
                        <label for="nama_kelas">Nama Kelas</label>
                        <input type="text" name="nama_kelas" id="nama_kelas" value="<?= $kls->nama_kelas; ?>"
                            autocomplete="off" class="form-control">
                        <?= form_error('nama_kelas', '<small class="text-danger ml-2">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="jurusan_id" style="text-align:bold;">jurusan</label>
                        <select class="form-control" id="jurusan_id" name="jurusan_id">
                            <option value="<?= $kls->id_jurusan?>" selected><?= $kls->jurusan?></option>
                            <?php foreach ($jurusan as $jrs) : ?>
                            <option value="<?= $jrs->id_jurusan ?>"><?= $jrs->jurusan ?></option>
                            <?php endforeach ?>
                        </select>
                        <?= form_error('jurusan_id', '<small class="text-danger ml-2">', '</small>'); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>
