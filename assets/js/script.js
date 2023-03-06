$(function () {
	function getSubtotal() {
		let total_bayar = 0;
		$(document)
			//find digunakan untuk mempermudah kita mencari sebuah data dalam suatu array
			.find(".total") //class total
			// fungsi each yang bisa kita gunakan untuk mencari suatu elemen atau bisa digunakan untuk melakukan pengulangan
			.each(function (index, element) {
				//elemen berisi semua inputan dari jumlah bayar yang di klik
				total_bayar += Number($(element).val()); //menjumlahkan semua jumlah bayar yang di inputkan
				// console.log(element);
			});
		return total_bayar;
	}

	// class btn-tambah-det
	$(".btn-tambah-det").click(function (e) {
		e.preventDefault(); //The event.preventDefault() metode menghentikan aksi default dari elemen terjadi. Sebagai contoh: Mencegah tombol kirim dari mengirimkan form

		pembayaran = $(".pembayaran").val(); //class pembayaran (berisi id_pembayaran)
		jumlah_bayar = $(".jumlah_bayar").val(); //class jumlah_bayar (berisi jumlah bayar)

		$.get(
			base_url + "pembayaran/get_pembayaran/" + pembayaran, //masuk ke controller pembayaran dengan function get_pembayaran dengan juga mengirimkan id_pembayaran nya.
			function (response) {
				const data = JSON.parse(response); // JSON.parse() mengambil string JSON dan mengubahnya menjadi objek JavaScript.

				const find = $(document).find(
					'tr[data-id= "' + data.id_pembayaran + '"]'
				);

				if (find.length == 0) {
					// append() adalah salah satu fungsi Jquery yang berfungsi untuk menambahkan sebuah elemen baru tanpa harus menyertakan element tersebut di tag HTML.
					//class det-transaksi (tempat menampilkan data)
					$(".det-transaksi").append(`
				<tr data.id="${data.id_pembayaran}">
				<input type="hidden" name="id_pembayaran[]" value="${data.id_pembayaran}">
					<td class="text-center">${data.bulan_dibayar}</td>
					<td><input disabled class="text-center jumlah_bayar" style="text-align:center ;
					border-left-width: 0px;
					border-top-width: 0px;
					border-right-width: 0px;
					border-bottom-width: 0px;
				" name="jumlah_bayar[]" value="${jumlah_bayar}"></td>
					<input type="hidden" class="text-center total" value="${Number(jumlah_bayar)}"> 
				</tr>
				
				`);
				}
				$(".total_bayar").val(getSubtotal());
			}
		);
	});
});
