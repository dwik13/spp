<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- tambah spp mengarah pada controller masterdata add_spp -->
    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-md-12 mb-4">
            <a class="btn btnhijau text-white" href="<?= base_url('masterdata/add_spp')?>">
                Tambah SPP
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
                            <th>Tahun Ajaran</th>
                            <th>Nominal</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <!-- $spp berasal dari controler masterdata spp -->
                        <?php $i = 1; ?>
                        <?php foreach ($spp as $sp) : ?>
                        <tr>

                            <th scope="row"><?= $i; ?></th>
                            <td><?= $sp['tahun']; ?></td>
                            <td><?= "Rp. " . number_format($sp['nominal'], 0, '.', '.'); ?></td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                    data-target="#exampleModaleditspp<?=$sp['id_spp']?>">
                                    edit
                                </button>
                                <button onclick="hapusspp('<?= base_url('masterdata/hapus_spp/' . $sp['id_spp']) ?>')"
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

<!-- modal edit petugas -->
<?php foreach ($spp as $sp) : ?>
<div class="modal fade" id="exampleModaleditspp<?=$sp['id_spp']?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit SPP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- mengarah ke controller masterdata edit_spp -->
            <form action="<?= base_url('masterdata/edit_spp'); ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id_spp" id="id_spp" value="<?= $sp['id_spp']; ?>">
                    <div class="form-group">
                        <label for="tahun">Tahun Ajaran</label>
                        <input type="text" name="tahun" id="tahun" disabled value="<?= $sp['tahun']; ?>"
                            autocomplete="off" class="form-control">
                        <?= form_error('tahun', '<small class="text-danger ml-2">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="nominal">Nominal</label>
                        <input type="number" name="nominal" id="nominal" value="<?= $sp['nominal']; ?>"
                            autocomplete="off" class="form-control">
                        <?= form_error('nominal', '<small class="text-danger ml-2">', '</small>'); ?>
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
