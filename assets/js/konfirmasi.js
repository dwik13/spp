function hapuspetugas(url) {
	Swal.fire({
		title: "Are you sure",
		text: "Yakin ingin hapus data petugas?",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "ya, hapus!",
	}).then((result) => {
		if (result.value) {
			document.location.href = url;
		}
	});
}
function hapusSiswa(url) {
	Swal.fire({
		title: "Are you sure",
		text: "Yakin ingin hapus data siswa?",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "ya, hapus!",
	}).then((result) => {
		if (result.value) {
			document.location.href = url;
		}
	});
}

function hapusspp(url) {
	Swal.fire({
		title: "Are you sure",
		text: "Yakin ingin hapus data spp?",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "ya, hapus!",
	}).then((result) => {
		if (result.value) {
			document.location.href = url;
		}
	});
}

function hapuskelas(url) {
	Swal.fire({
		title: "Are you sure",
		text: "Yakin ingin hapus data kelas?",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "ya, hapus!",
	}).then((result) => {
		if (result.value) {
			document.location.href = url;
		}
	});
}
function hapusjurusan(url) {
	Swal.fire({
		title: "Are you sure",
		text: "Yakin ingin hapus data Jurusan?",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "ya, hapus!",
	}).then((result) => {
		if (result.value) {
			document.location.href = url;
		}
	});
}
function keluar(url) {
	Swal.fire({
		title: "Apa kamu Yakin",
		text: "Yakin ingin keluar?",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "ya, keluar!",
	}).then((result) => {
		if (result.value) {
			document.location.href = url;
		}
	});
}
