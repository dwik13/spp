<?php
use function foo\func;
defined('BASEPATH') or exit('No direct script access allowed');


class Data_model extends CI_Model
{


	// dashboard 




	
	//mengambil tabel siswa untuk menampilkan informasi siswa yang login
	public function siswaambil(){
		$query = "SELECT `tb_siswa`.*, `tb_spp`.`tahun`, `tb_spp`.`nominal`, `tb_kelas`.`nama_kelas`, `tb_jurusan`.`jurusan`
        FROM `tb_siswa`,`tb_spp`,`tb_kelas`, `tb_jurusan` WHERE `tb_siswa`.`id_kelas` = `tb_kelas`.`id_kelas` AND `tb_siswa`.`id_spp` = `tb_spp`.`id_spp` AND `tb_kelas`.`id_jurusan` = `tb_jurusan`.`id_jurusan` AND `tb_siswa`.`nisn` = '" . $this->session->userdata('nisn') . "'";

        return $this->db->query($query)->row_array();
	}

	//mejumlahkan semua transaksi
	public function count_transaksi()
    {
        $query = $this->db->get('tb_pembayaran');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }








	


	// petugas






	// ambil data tabel petugas (masterdata/petugas)
	public function getpetugas(){
		$query = "SELECT `tb_petugas`.*,`tb_level`.* FROM `tb_petugas`, `tb_level` WHERE `tb_petugas`.`id_level` = `tb_level`.`id_level` ";
		return $this->db->query($query)->result();
	}



















	



	// siswa


	//menampilkan siswa dan memanggil prosedure (masterdata/siswa) dan (masterdata/edit_siswa)
	public function siswa_get()
    {
        $query = $this->db->query("call get_siswa()");
        mysqli_next_result($this->db->conn_id);
        return $query->result();
    }

	//memecah nama kelas (masterdata/siswa)
	public function kelassama(){
		$query ="SELECT `id_kelas`, TRIM(nama_kelas) as nama_kelas FROM tb_kelas JOIN `tb_jurusan` ON `tb_kelas`.`id_jurusan` = `tb_jurusan`.`id_jurusan` ORDER BY `tb_kelas`.`id_jurusan` ASC";
		$this->db->from('tb_kelas');

		return $this->db->query($query)->result();
	}


	// menampilkan tb_siswa di e_siswa.php
	public function imagesiswa($id){
		$query = "SELECT `tb_siswa`.*, `tb_spp`.`tahun`, `tb_spp`.`nominal`, `tb_kelas`.`nama_kelas`, `tb_jurusan`.`jurusan`
        FROM `tb_siswa`,`tb_spp`,`tb_kelas`, `tb_jurusan` WHERE `tb_siswa`.`id_kelas` = `tb_kelas`.`id_kelas` AND `tb_siswa`.`id_spp` = `tb_spp`.`id_spp` AND `tb_kelas`.`id_jurusan` = `tb_jurusan`.`id_jurusan` AND `tb_siswa`.`nisn` = '" . $id . "'";

        return $this->db->query($query)->row_array();
	}



	//ambil data spp (masterdata/add_siswa)
	public function get_id_spp() 	
    {
		// tampilkan tb_spp(tahun ajaran dan nominal) dimana id_spp nya sama dengan spp_id(inputan yang dimasukkan user)
        $query = "SELECT * FROM `tb_spp` WHERE `id_spp` = " . $this->input->post('spp_id');
        return $this->db->query($query)->result();
    }















	


	//kelas

	public function kelasget(){
		$query ="SELECT `tb_kelas`.*, `tb_jurusan`.`jurusan` FROM `tb_kelas` JOIN `tb_jurusan` ON `tb_kelas`.`id_jurusan` = `tb_jurusan`.`id_jurusan` ORDER BY `tb_kelas`.`id_jurusan` ASC";

		return $this->db->query($query)->result();
	}












	








	// pembayaran


	// menampilkan siswa sesuai nisn
	public function search($id)
    {
        $query = "SELECT `tb_siswa`.*,`tb_pembayaran`.*, `tb_spp`.`tahun`, `tb_spp`.`nominal`, `tb_kelas`.`nama_kelas`, `tb_jurusan`.`jurusan`
        FROM `tb_siswa`, `tb_pembayaran`,`tb_spp`,`tb_kelas`, `tb_jurusan` WHERE `tb_siswa`.`id_kelas` = `tb_kelas`.`id_kelas` AND `tb_siswa`.`id_spp` = `tb_spp`.`id_spp` AND `tb_pembayaran`.`nisn` = `tb_siswa`.`nisn` AND `tb_kelas`.`id_jurusan` = `tb_jurusan`.`id_jurusan` AND  `tb_siswa`.`status` = 'aktif' AND `tb_siswa`.`nisn` = '" . $id . "'";

        return $this->db->query($query)->row();
    }

	public function siswapembayaran(){
		$query = "SELECT `tb_siswa`.*, `tb_kelas`.`nama_kelas`, `tb_spp`.`tahun`, `tb_spp`.`nominal`
		FROM `tb_siswa` JOIN `tb_kelas`
		ON `tb_siswa`.`id_kelas` = `tb_kelas`.`id_kelas`
		JOIN `tb_spp` ON `tb_siswa` .`id_spp` = `tb_spp`.`id_spp`  AND  `tb_siswa`.`status` = 'aktif' ORDER BY `tb_siswa`.`nisn`, `tb_siswa`.`id_kelas` ASC";

		return $this->db->query($query)->result();
	}

	//menampilkan siswa yang mau melakukan transaksi
	// public function transaksi($id)
    // {
    //     $query = "SELECT `tb_pembayaran`.*, `tb_siswa`.*, `tb_spp`.`tahun`, `tb_spp`.`nominal`, `tb_kelas`.`nama_kelas`, `tb_jurusan`.`jurusan`
    //     FROM `tb_pembayaran`, `tb_siswa`,`tb_spp`,`tb_kelas`, `tb_jurusan` WHERE `tb_pembayaran`.`nisn` = `tb_siswa`.`nisn` AND `tb_siswa`.`id_kelas` = `tb_kelas`.`id_kelas` AND `tb_siswa`.`id_spp` = `tb_spp`.`id_spp` AND `tb_kelas`.`id_jurusan` = `tb_jurusan`.`id_jurusan` AND `tb_siswa`.`nisn` LIKE '%" . $id . "%'
    //     ";

    //     return $this->db->query($query)->result();
    // }



	// tambah transaksi (untuk menampilkan bulan yang keterangan nya belum lunas sesuai nisn)
	public function transaksitambah($id)
    {
		// jika keterangan kosong dan nisn sama dengan yang dipilih maka tampilkan
        $query = "SELECT `tb_pembayaran`.*, `tb_siswa`.*, `tb_spp`.`tahun`, `tb_spp`.`nominal`, `tb_kelas`.`nama_kelas`
        FROM `tb_pembayaran`, `tb_siswa`,`tb_spp`,`tb_kelas` WHERE `tb_pembayaran`.`nisn` = `tb_siswa`.`nisn` AND `tb_siswa`.`id_kelas` = `tb_kelas`.`id_kelas` AND `tb_siswa`.`id_spp` = `tb_spp`.`id_spp` AND `tb_pembayaran`.`ket` = ''  AND  `tb_siswa`.`nisn` = '" . $id . "'";

        return $this->db->query($query)->result();
    }


	//update pembayaran controller pembayaran function add_transaksi
	public function editpem($post){
		$tgl_bayar = date('Y-m-d'); //set default
        
		for($i=0; $i < count($post['id_pembayaran']); $i++){ //lakukan perulangan sesuai inputan id_pembayaran
			$data = array(
				'id_pembayaran' => $post['id_pembayaran'][$i],
				'tgl_bayar' => $tgl_bayar,
				'ket' => 'LUNAS',
				'id_petugas' => $this->session->userdata('id_petugas')
			);
			$this->db->where('id_pembayaran', $post['id_pembayaran'][$i]); //dimana id pembayaran perulangan tersebut yang telah dimasukkan
			$this->db->update('tb_pembayaran', $data); 
		}
	}

		// cetak pembayaran siswa yang sudah lunas secara row
		public function cetakpembayaran($id)
		{
			$query = "SELECT `tb_pembayaran`.*, `tb_siswa`.* ,`tb_petugas` . `nama_petugas`, `tb_spp`.`tahun`, `tb_spp`.`nominal`, `tb_kelas`.`nama_kelas`
			FROM `tb_pembayaran`,`tb_siswa`, `tb_petugas`,`tb_spp`,`tb_kelas` WHERE
			`tb_pembayaran`.`nisn` = `tb_siswa`.`nisn` AND  `tb_pembayaran`.`id_petugas` = `tb_petugas`.`id_petugas` AND `tb_siswa`.`id_kelas` = `tb_kelas`.`id_kelas` AND`tb_siswa`.`id_spp` = `tb_spp`.`id_spp` AND  `tb_pembayaran`.`ket` = 'LUNAS' AND  `tb_pembayaran`.`id_petugas` = '" . $this->session->userdata('id_petugas') . "' AND `tb_siswa`.`nisn` = '" . $id . "'
			ORDER BY `tb_pembayaran`.`id_pembayaran` ASC
			";
	
			return $this->db->query($query)->row_array();
		}

	//cetak transaksi pembayaran siswa langsung dan tanggal sekarang(tanggal transaksi pembayaran dilakukan)
	public function cetaktransaksi($id, $tgl){
		$this->db->select('*');
        $this->db->from('tb_pembayaran');
		$this->db->join('tb_siswa', 'tb_pembayaran.nisn= tb_siswa.nisn', 'left');
		$this->db->join('tb_petugas', 'tb_pembayaran.id_petugas= tb_petugas.id_petugas', 'left');
        $this->db->join('tb_spp', 'tb_pembayaran.id_spp= tb_spp.id_spp', 'left');
        $this->db->where('tb_pembayaran.ket =', 'LUNAS');
		$this->db->where('tb_pembayaran.tgl_bayar =', $tgl);
		$this->db->where('tb_pembayaran.nisn =', $id);
        return $this->db->get()->result();
	}

	//mejumlahkan transaksi pembayaran siswa yang lunas yang dicari(nisn) dan tanggal sekarang(tanggal transaksi pembayaran dilakukan) 
	public function grandtotaltransaksi($id, $tgl){
		$this->db->select_sum('jumlah_bayar');
        $this->db->from('tb_pembayaran');
		$this->db->join('tb_siswa', 'tb_pembayaran.nisn= tb_siswa.nisn', 'left');
        $this->db->join('tb_spp', 'tb_pembayaran.id_spp= tb_spp.id_spp', 'left');
        $this->db->where('tb_pembayaran.ket =', 'LUNAS');
		$this->db->where('tb_pembayaran.tgl_bayar =', $tgl);
		$this->db->where('tb_pembayaran.nisn =', $id);
        return $this->db->get()->row_array();
	}


	

















	// history








	// tampilkan jika tb_pembayaran kolom ket= lunas bagian ini menampilkan di history admin
	public function history_getsiswaadmin()
    {
        $query = "SELECT `tb_pembayaran`.*, `tb_siswa`.* , `tb_spp`.`tahun`, `tb_spp`.`nominal`, `tb_kelas`.`nama_kelas`, `tb_jurusan`.`jurusan`, `tb_petugas`.`nama_petugas`
        FROM `tb_pembayaran`,`tb_siswa`,`tb_spp`,`tb_kelas`, `tb_jurusan`, tb_petugas WHERE
        `tb_pembayaran`.`nisn` = `tb_siswa`.`nisn` AND  `tb_pembayaran`.`id_petugas` = `tb_petugas`.`id_petugas` AND `tb_siswa`.`id_kelas` = `tb_kelas`.`id_kelas` AND `tb_siswa`.`id_spp` = `tb_spp`.`id_spp` AND `tb_kelas`.`id_jurusan` = `tb_jurusan`.`id_jurusan` AND  `tb_siswa`.`status` = 'aktif' AND `tb_pembayaran`.`ket` = 'LUNAS' ORDER BY `tb_pembayaran`.`id_pembayaran` ASC
        ";

        return $this->db->query($query)->result();
    }

	// tampilkan jika tb_pembayaran kolom ket= lunas bagian ini menampilkan di history petugas

	public function history_getsiswapetugas()
    {
        $query = "SELECT `tb_pembayaran`.*, `tb_siswa`.* , `tb_spp`.`tahun`, `tb_spp`.`nominal`, `tb_kelas`.`nama_kelas`, `tb_jurusan`.`jurusan`, `tb_petugas`.`nama_petugas`
        FROM `tb_pembayaran`,`tb_siswa`,`tb_spp`,`tb_kelas`, `tb_jurusan`, tb_petugas WHERE
        `tb_pembayaran`.`nisn` = `tb_siswa`.`nisn` AND  `tb_pembayaran`.`id_petugas` = `tb_petugas`.`id_petugas` AND `tb_siswa`.`id_kelas` = `tb_kelas`.`id_kelas` AND `tb_siswa`.`id_spp` = `tb_spp`.`id_spp` AND `tb_kelas`.`id_jurusan` = `tb_jurusan`.`id_jurusan` AND `tb_siswa`.`status` = 'aktif' AND `tb_pembayaran`.`ket` = 'LUNAS' AND `tb_pembayaran`.`id_petugas` = '" . $this->session->userdata('id_petugas') . "' ORDER BY `tb_pembayaran`.`id_pembayaran` ASC
        ";

        return $this->db->query($query)->result();
    }

	// tampilkan jika tb_pembayaran kolom ket= lunas, bagian ini menampilkan di history siswa
	public function history_get()
    {
        $query = "SELECT `tb_pembayaran`.*, `tb_siswa`.* , `tb_spp`.`tahun`, `tb_spp`.`nominal`, `tb_kelas`.`nama_kelas`, `tb_jurusan`.`jurusan`
        FROM `tb_pembayaran`,`tb_siswa`,`tb_spp`,`tb_kelas`, `tb_jurusan` WHERE
        `tb_pembayaran`.`nisn` = `tb_siswa`.`nisn` AND `tb_siswa`.`id_kelas` = `tb_kelas`.`id_kelas` AND `tb_siswa`.`id_spp` = `tb_spp`.`id_spp` AND `tb_kelas`.`id_jurusan` = `tb_jurusan`.`id_jurusan` AND `tb_pembayaran`.`ket` = 'LUNAS' AND `tb_siswa`.`nisn` = '" . $this->session->userdata('nisn') . "'
        ORDER BY `tb_pembayaran`.`id_pembayaran` ASC
        ";

        return $this->db->query($query)->result();
    }

	//tagihan siswa yang belum lunas
	public function tagihan(){
        $this->db->where([
            'nisn' => $this->session->userdata('nisn'),
            'ket' => ''
        ]);
        return $this->db->get('tb_pembayaran')->result();
    }

	//menjulamhkan total tagihan yang belum dibayar siswa
	public function total_tagihan($id)
    {
        $this->db->select_sum('jumlah_bayar');
        $this->db->from('tb_pembayaran');
		$this->db->join('tb_siswa', 'tb_pembayaran.nisn= tb_siswa.nisn', 'left');
        $this->db->join('tb_spp', 'tb_pembayaran.id_spp= tb_spp.id_spp', 'left');
        $this->db->where('tb_pembayaran.nisn =', $id);
        $this->db->where('tb_pembayaran.ket =', '');
        return $this->db->get()->row_array();
    }

	// cetak history siswa yang sudah lunas
	// public function cetak_history($id)
    // {
	// 	$query = "SELECT `tb_pembayaran`.*, `tb_siswa`.* , `tb_spp`.`TAHUN`, `tb_spp`.`nominal`, `tb_kelas`.`nama_kelas`
    //     FROM `tb_pembayaran`,`tb_siswa`,`tb_spp`,`tb_kelas` WHERE
    //     `tb_pembayaran`.`nisn` = `tb_siswa`.`nisn` AND `tb_siswa`.`id_kelas` = `tb_kelas`.`id_kelas` AND `tb_siswa`.`id_spp` = `tb_spp`.`id_spp` AND `tb_pembayaran`.`ket` = 'LUNAS' AND `tb_siswa`.`nisn` LIKE '%" . $id . "%' 
    //     ORDER BY `tb_pembayaran`.`id_pembayaran` ASC
    //     ";

    //     return $this->db->query($query)->result();
    // }



	//menjumlahkan total pembayaran yang sudah lunas
	public function grandtotal($id)
    {
        $this->db->select_sum('jumlah_bayar');
        $this->db->from('tb_pembayaran');
		$this->db->join('tb_siswa', 'tb_pembayaran.nisn= tb_siswa.nisn', 'left');
        $this->db->join('tb_spp', 'tb_pembayaran.id_spp= tb_spp.id_spp', 'left');
        $this->db->where('tb_pembayaran.nisn =', $id);
        $this->db->where('tb_pembayaran.ket =', 'LUNAS');
        return $this->db->get()->row_array();
    }










	

    


	// cetakk laporan

	//cetak siswa
	public function siswa_kelas($id_kelas){
		$query = "SELECT `tb_siswa`.*, `tb_spp`.`tahun`, `tb_spp`.`nominal`, `tb_kelas`.`nama_kelas`, `tb_jurusan`.`jurusan`
        FROM `tb_siswa`,`tb_spp`,`tb_kelas`, `tb_jurusan` WHERE `tb_siswa`.`id_kelas` = `tb_kelas`.`id_kelas` AND `tb_siswa`.`id_spp` = `tb_spp`.`id_spp` AND `tb_kelas`.`id_jurusan` = `tb_jurusan`.`id_jurusan` AND  `tb_siswa`.`status` = 'aktif' AND `tb_siswa`.`id_kelas` = '" . $id_kelas . "'";

        return $this->db->query($query)->result();
	}


	//menampilkan yang ket lunas sesuai tanggal bayar
	public function filter_laporan($tgl_mulai, $tgl_ahir)
    {
		$this->db->select('*');
        $this->db->from('tb_pembayaran');
		$this->db->join('tb_siswa', 'tb_pembayaran.nisn= tb_siswa.nisn', 'left');
		$this->db->join('tb_petugas', 'tb_pembayaran.id_petugas= tb_petugas.id_petugas', 'left');
        $this->db->join('tb_spp', 'tb_pembayaran.id_spp= tb_spp.id_spp', 'left');
        $this->db->where('tb_pembayaran.ket =', 'LUNAS');
		$this->db->where('tb_pembayaran.tgl_bayar>=', $tgl_mulai);
        $this->db->where('tb_pembayaran.tgl_bayar<=', $tgl_ahir);
        return $this->db->get()->result();
    }

	//grandtotal semua yang ket lunas
	public function grandtotransaksicetak($tgl_mulai, $tgl_ahir){
		$this->db->select_sum('jumlah_bayar');
        $this->db->from('tb_pembayaran');
		$this->db->join('tb_siswa', 'tb_pembayaran.nisn= tb_siswa.nisn', 'left');
		$this->db->join('tb_petugas', 'tb_pembayaran.id_petugas= tb_petugas.id_petugas', 'left');
        $this->db->join('tb_spp', 'tb_pembayaran.id_spp= tb_spp.id_spp', 'left');
		$this->db->where('tb_pembayaran.ket =', 'LUNAS');
		$this->db->where('tb_pembayaran.tgl_bayar>=', $tgl_mulai);
        $this->db->where('tb_pembayaran.tgl_bayar<=', $tgl_ahir);
        return $this->db->get()->row_array();
	}


}