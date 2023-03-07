<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800"><?= $title; ?></h1>
    <!-- tambah petugas masuk pada controller add_petugas -->
    <div class="row">
        <div class="col-md-12 mb-4">
            <a class="btn btnhijau text-white" href="<?= base_url('masterdata/add_petugas')?>">
                Tambah Petugas
            </a>
        </div>
    </div>

    <?php
	// jika tidak kosong flashdata ditampikan
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
                            <th>Username</th>
                            <th>Password</th>
                            <th>Nama Petugas</th>
                            <th>Level</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <!-- mengambil data dari controller petugas -->
                        <?php $i = 1; ?>
                        <?php foreach ($petugas as $p) : ?>
                        <tr>

                            <th scope="row"><?= $i; ?></th>
                            <td><?= $p->username; ?></td>
                            <!-- password ditampilkan karena ketika petugas lupa password maka bertanya ke admin dan admin bisa melihat password petugas itu -->
                            <td><?= $p->deskripsi; ?></td>
                            <td><?= $p->nama_petugas; ?></td>
                            <td><?= $p->level; ?></td>
                            <td>
                                <!-- edit menggunakan modal -->
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                    data-target="#exampleModaledit<?=$p->id_petugas;?>">
                                    edit
                                </button>
                                <!-- hapus menggunakan sweet alert -->
                                <button
                                    onclick="hapuspetugas('<?= base_url('masterdata/hapus_petugas/' . $p->id_petugas) ?>')"
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

<!-- modal -->
<!-- edit petugas -->
<?php foreach ($petugas as $ptg) : ?>
<div class="modal fade" id="exampleModaledit<?=$ptg->id_petugas?>">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit petugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- data masuk pada controller masterdata edit petugas dengan method post -->
            <form action="<?= base_url('masterdata/edit_petugas'); ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id_petugas" id="id_petugas" value="<?= $ptg->id_petugas; ?>">
                    <div class="form-group">
                        <label for="username" style="text-align:bold;">Username</label>
                        <input type="text" name="username" id="username" class="form-control"
                            value="<?= $ptg->username; ?>" disabled required>
                        <?= form_error('username', '<small class="text-danger ml-2">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="nama_petugas" style="text-align:bold;">Nama Petugas</label>
                        <input type="text" name="nama_petugas" id="nama_petugas" class="form-control"
                            value="<?= $ptg->nama_petugas; ?>">
                        <?= form_error('nama_petugas', '<small class="text-danger ml-2">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="level_id" style="text-align:bold;">Level</label>
                        <select class="form-control" id="level_id" name="level_id">
                            <option value="<?= $ptg->id_level ?> " selected><?= $ptg->level ?></option>
                            <?php foreach ($level as $lv) : ?>
                            <option value="<?= $lv['id_level'] ?>"><?= $lv['level'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <?= form_error('jurusan_id', '<small class="text-danger ml-2">', '</small>'); ?>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-warning " data-toggle="modal" data-dismiss="modal"
                        data-target="#exampleModaleditpass<?=$ptg->id_petugas;?>"><i class="fas fa-key"></i> Ubah Kata
                        Sandi?
                    </button>
                    <button type="submit" class="btn btn-info ">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>
<?php endforeach; ?>


<!-- reset password petugas -->
<?php foreach ($petugas as $ptg) : ?>
<div class="modal fade" id="exampleModaleditpass<?=$ptg->id_petugas?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- masuk pada controller masterdata ubah_pass pada method post -->
            <form action="<?= base_url('masterdata/ubah_pass'); ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id_petugas" id="id_petugas" value="<?= $ptg->id_petugas; ?>">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password1" id="password1" autocomplete="off" class="form-control"
                            placeholder="Masukan password baru..">
                        <small>password minimal 5 karakter</small>
                        <?= form_error('password1', '<small class="text-danger ml-2">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="password">Ulangi Password</label>
                        <input type="password" name="password2" id="password2" class="form-control"
                            placeholder="Ulangi password..">
                        <small>password minimal 5 karakter</small>
                        <?= form_error('password2', '<small class="text-danger ml-2">', '</small>'); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="#" class="btn btn-warning text-white" data-toggle="modal" data-dismiss="modal"
                        data-target="#exampleModaledit<?= $ptg->id_petugas; ?>"><i class="fas fa-arrow-left"></i>
                        Kembali?</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php endforeach; ?>