</div>
</div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<!-- <footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2021</span>
        </div>
    </div>
</footer> -->
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- sweet alert -->
<script src="<?= base_url('assets/js/konfirmasi.js') ?>"></script>
<script src="<?= base_url('assets/swal/dist/sweetalert2.all.min.js') ?>"></script>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/')?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/')?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- search pada tabel -->
<script src="<?= base_url('assets/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/js/demo/datatables-demo.js') ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/')?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/')?>js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url('assets/')?>vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('assets/')?>js/demo/chart-area-demo.js"></script>
<script src="<?= base_url('assets/')?>js/demo/chart-pie-demo.js"></script>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> -->
<script src="<?= base_url('assets/')?>js/script.js"></script>

<script>
$('.custom-file-input').on('change', function() {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
});
</script>

<!-- menghapus flasdata secara otomatis -->
<script>
window.setTimeout(function() {
    $("#flash_data").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
    });
}, 3000);
</script>

<!-- ubah status siswa -->
<script>
$('.status').change(function() {
    var status = $(this).val();
    var kt = status.substr(0, 10);
    var stt = status.substr(10, 10);

    console.log(stt);

    $.ajax({
        url: "<?= base_url('masterdata/update_status') ?>",
        method: "post",
        data: {
            kt: kt,
            stt: stt
        }

    });
    location.reload();
});
</script>




<!-- <script>
$.widget.bridge('uibutton', $.ui.button)
</script> -->


<!-- fungsi search pada transaksi pembayaran -->
<!-- <script>
function search() {

    $.ajax({
        url: '<?= base_url('history/search_history') ?>', // File Tujuan nya
        type: 'POST', //Tentukan Tipe nya POST
        data: {
            keyword: $("#keyword").val() //id=keyword
        }, //set data keyword yang akan dikirim
        dataType: "json",
        beforeSend: function(e) {
            if (e && e.overrideMimeType) {
                e.overrideMimeType("application/json;charset=UTF-8");
            }
        },
        success: function(result) { // Ketika proses pengiriman berhasil
            // Ubah text tombol search menjadi cari... 
            // Dan tambahkan atribut disable pada tombol nya agar tidak bisa diklik lagi
            $('#btn-search').html("Cari").removeAttr("disabled");
            $('#view').html(result
                .Hasil
            ); // Ganti isi dari div id view dengan view yang diambil dari controller history function search_history
        },
        error: function(xhr, ajaxOptions, thrownError) { // Ketika terjadi error
            alert(xhr.responseText); // munculkan alert
        }
    });

};

$('#view').html('');

$('#btn-search').click(function() { //jika button diklik maka cari input an 
    $search = $('#keyword').val(); //ambil data keyword
    if ($search != '') { //jika search(kolom pencarian diisi)/ tidak kosong maka jalankan ini
        $('#btn-search').html("Mencari...").attr("disabled", "disabled");
        search(); //kalo berhasil kembalikan ke function search
    } else { //jika search(kolom pencarian tidak diisi) maka jalankan ini
        $('#view').html(`<div class="card">
                                    <div class="card-body text-center">
                                        <h3 class="text-danger">Isi kolom pencarian.</h3>
                                    </div>
                                </div>`);
    }
});

$('#keyword').on('keyup', function(e) { //keyup merupakan event ketika tombol dilepaskan pada keyboard
    if (e.keyCode ===
        13) { // Atribut keyCode mengambil kode kunci ASCII jika tombol ditekan saat peristiwa terjadi.
        $search = $(this).val();
        if ($search != '') {
            $('#btn-search').html("Mencari...").attr("disabled", "disabled");
            search(); //kalo berhasil kembalikan ke function search
        } else {
            $('#view').html(`<div class="card">
                                    <div class="card-body text-center">
                                        <h3 class="text-danger">Isi kolom pencarian.</h3>
                                    </div>
                                </div>`);
        }
    }
});
</script> -->

</body>



</html>