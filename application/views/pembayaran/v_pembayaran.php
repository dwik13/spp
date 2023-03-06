<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 text-dark"><?= $title ?></h3>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-12 mt-3 mb-5">
                    <!-- jika input search tidak sama dengan kosong -->
                    <!-- jika data siswa tidak kosong  -->
                    <?php if (!empty($siswa)) : ?>
                    <form action="<?= base_url('pembayaran/add_transaksi/' . $siswa->nisn)?>" method="post"
                        target="_blank">

                        <div class="col-xl-12 col-lg-6">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                                    style="background-image: linear-gradient(195deg, #538b82, #538b82);">
                                    <h5 class="text-bold text-white"><?= $title ?></h5>
                                </div>

                                <div class="row">
                                    <div class="col-md-3 mt-2">
                                        <div style=" padding: 20px;">
                                            <?php if($siswa->image == null){ ?>
                                            <img src="<?= base_url('assets/img/profile/default.png') ?>"
                                                class="img-thumbnail">
                                            <?php }else if($siswa->image != null){ ?>
                                            <img src="<?= base_url('assets/img/profile/') . $siswa->image ?>"
                                                class="img-thumbnail">
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div style="margin-top: 30px;" class="col-xl-11 col-lg-6">


                                            <div class="form-group row">
                                                <label for="inputPassword3" class="col-sm-2 col-form-label">NISN</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" value="<?= $siswa->nisn ?>"
                                                        disabled>
                                                </div>
                                                <label for="inputPassword3" class="col-sm-2 col-form-label">NIS
                                                </label>
                                                <div class="col">
                                                    <input type="text" class="form-control" value="<?= $siswa->nis ?>"
                                                        disabled>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputPassword3" class="col-sm-2 col-form-label">Nama
                                                    Siswa</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" value="<?= $siswa->nama ?>"
                                                        disabled>
                                                </div>
                                                <label for="inputPassword3"
                                                    class="col-sm-2 col-form-label">Kelas</label>
                                                <div class="col">
                                                    <input type="text" class="form-control"
                                                        value="<?= $siswa->nama_kelas ?>" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputPassword3" class="col-sm-2 col-form-label">Kompetensi
                                                    Keahlian
                                                </label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control"
                                                        value="<?= $siswa->jurusan ?>" disabled>
                                                </div>
                                                <label for="inputPassword3"
                                                    class="col-sm-2 col-form-label">Tahun</label>
                                                <div class="col">
                                                    <input type="text" class="form-control" value="<?= $siswa->tahun ?>"
                                                        disabled>
                                                </div>
                                            </div>
                                            <hr>


                                            <!-- proses tambah transaksi masuk di script(bagian assets/js/script.js) -->
                                            <div>
                                                <div class="form-group row">
                                                    <label for="inputPassword3"
                                                        class="col-sm-2 col-form-label">Bulan</label>
                                                    <div class="col-sm-4">
                                                        <select class="form-control pembayaran" id="id_pembayaran"
                                                            name="id_pembayaran">
                                                            <!-- <option value="" selected>-- Pilih Bulan --</option> -->
                                                            <?php foreach ($transaksitambah as $tt) : ?>
                                                            <option value="<?= $tt->id_pembayaran ?>">
                                                                <?= $tt->bulan_dibayar ?>
                                                            </option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>

                                                    <label for="inputPassword3"
                                                        class="col-sm-2 col-form-label">Nominal</label>
                                                    <div class="col">
                                                        <input type="text" id="jumlah_bayar" name="jumlah_bayar"
                                                            class="form-control jumlah_bayar"
                                                            value="<?= $siswa->nominal ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <button
                                                            class="btn btnhijau text-white float-right ml-3  col-md-2 mt-n1 btn-tambah-det">Entry
                                                            Data</button>
                                                    </div>
                                                </div>

                                            </div>

                                            <hr>

                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="card-body">
                                        <table class="table table-striped table-bordered">
                                            <thead class="text-white"
                                                style="background-image: linear-gradient(195deg, #538b82, #538b82);">
                                                <tr>
                                                    <th>Bulan</th>
                                                    <th>Nominal</th>
                                                </tr>
                                            </thead>
                                            <tbody class="det-transaksi">

                                            </tbody>
                                            <tbody>
                                                <tr>
                                                    <td scope="row" colspan="1"
                                                        style="text-align:center ; font-weight:bold; font-size: 20px;background-color: #f9f8f8;">
                                                        Total Bayar
                                                    </td>
                                                    <td
                                                        style="font-weight:bold; font-size: 13px;background-color: #f9f8f8;">

                                                        <input type="text" disabled style="
					border-left-width: 0px;
					border-top-width: 0px;
					border-right-width: 0px;
					border-bottom-width: 0px;" class="col-md-2 form-control  total_bayar">

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                <!-- simpan data dan cetak -->
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btnhijau text-white float-right col-md-2 mt-n1"
                                            style="margin-right: 30px;">Simpan</button>
                                        <a href="<?= base_url('pembayaran/pembayaran'); ?>"
                                            class="btn btn-secondary float-right col-md-2 mt-n1 "
                                            style="margin-right: 15px;">Kembali</a>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <!-- action mengarah ke controller pembayaran add transaksi dengan mengirimkan nisn  -->

                        <!-- data yang di entry masuk pada tabel ini dengan class det-transaksi -->

                    </form>
                    <?php else : ?>
                    <div class="card">
                        <div class="card-body">
                            <p>NISN tidak ditemukan</p>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
    </section>

</div>

<script>
const base_url = '<?= base_url() ?>'
</script>

<!-- 
<script>
// function save() {
//     var input = document.getElementById('pembayaran_id').value;
//     localStorage.setItem('bulan', input);
//     var input = document.getElementById('nominal').value;
//     localStorage.setItem('jumlah_bayar', input);
//     window.location.reload(true);
// }
// document.getElementById('get_bulan').innerHTML = localStorage.getItem('bulan');
// document.getElementById('get_jumlah').innerHTML = localStorage.getItem('jumlah_bayar');
</script> -->

<!-- <script>
$(function() {
    function getSubtotal() {
        let total_bayar = 0;
        $(document)
            .find(".jumlah_bayar")
            .each(function(index, element) {
                total_bayar += Number($(element).val());
            });
        return total_bayar;
    }

    $(".btn-tambah-det").click(function(e) {
        e.preventDefault();
        pembayaran = $(".pembayaran").val();
        jumlah_bayar = $(".jumlah_bayar").val();

        $.get(
            base_url + "pembayaran/get_pembayaran" + pembayaran,
            function(response) {
                const data = JSON.parse(response);

                const find = $(document).find(
                    'tr[data-id= "' + data.id_pembayaran + '"]'
                );

                if (find.length == 0) {
                    $(".det-transaksi").append(`
				<tr data.id="${data.id_pembayaran}">
				<input type="hidden" name="id_pembayaran[]" value="${data.id_pembayaran}">
					<td class="text-center">${data.bulan_dibayar}</td>
					<td class="text-center">${data.jumlah_bayar}</td>
				</tr>
				`);
                }
                // $(".total_bayar").val(getSubtotal());
            }
        );
    });
});








</script> -->
