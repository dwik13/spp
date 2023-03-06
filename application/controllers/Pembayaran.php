<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();

		if (empty($this->session->userdata('username'))) {
            redirect('auth/blocked');
        }

		$this->load->model('Data_model', 'Data');
        $this->load->library('form_validation');
		$this->load->helper('tgl_indo_helper');

    }








	
	// tapilan awal transaksi
	public function pembayaran(){
		$data['title'] = 'Entri Transaksi Pembayaran';
		$data['user'] = $this->db->get_where('tb_petugas', ['username' => $this->session->userdata('username')])->row_array();

		// mengambil data siswa di model data model nama function nya siswapembayaran
		$data['siswa'] = $this->Data->siswapembayaran();
		// $data['siswa'] = $this->Data->siswa_get();
		
		$this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('pembayaran/s_pembayaran', $data);
        $this->load->view('templates/footer');
	}

	
	// menampilkan biodata siswa dengan NISN yang di cari proses dari s_pembayaran.php
	public function transaksispp($id){
		$data['title'] = 'Entri Transaksi Pembayaran';
		$data['user'] = $this->db->get_where('tb_petugas', ['username' => $this->session->userdata('username')])->row_array();


		// ambil tabel spp di result array
		$data['spp'] = $this->db->get('tb_spp')->result_array();

		// $data['bulanan'] = $this->Data->bulanan()

		// menampilkan siswa yang dicari/yang mau membayar sesuai nisn
        $data['siswa'] = $this->Data->search($id);
		
		//untuk menampilkan bulan yang keterangan nya belum lunas sesuai nisn
        $data['transaksitambah'] = $this->Data->transaksitambah($id);

		//menampilkan siswa yang mau melakukan transaksi
		// $data['tagihan'] = $this->Data->transaksi($id);


		$this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('pembayaran/v_pembayaran', $data);
        $this->load->view('templates/footer');

	}


	//mengambil data tb_pembayaran 
	public function get_pembayaran($id_pembayaran){
		// json_encode adalah fungsi ia mengubah variabel PHP (berisi array) menjadi JSON.
		echo json_encode($this->db->get_where('tb_pembayaran', ['id_pembayaran' => $id_pembayaran])->row_array());
	}


	

	//tambah data pembayaran 
	public function add_transaksi($id)
    {
        $search = $this->db->query("SELECT `tb_siswa`.`nisn`, `tb_pembayaran`.`nisn` FROM `tb_siswa`, `tb_pembayaran` WHERE `tb_pembayaran`.`nisn` = `tb_siswa`.`nisn` AND `tb_pembayaran`.`id_pembayaran` = '" . $id . "'")->row_array();

		// masuk ke Data model function editpem dengan mengirimkan semua inputan yang telah dimasukkan
		$query = $this->Data->editpem($this->input->post());

		//jika success maka cetak data yang sudah disimpan
		redirect('pembayaran/cetaktransaksi/' . $id);
       
    }

	//cetak transaksi pembayaran siswa tersebut di tanggal transaksi pembayaran itu dilakukan
	public function cetaktransaksi($id){
		$this->load->library('pdfgenerator');
			//set tanggal sekarang
			$tgl= date('Y-m-d');

			// menampilkan siswa yang sudah lunas secara result
			$data['transaksi'] = $this->Data->cetaktransaksi($id, $tgl);

			// menampilkan siswa yang sudah lunas secara row
			$data['siswatransaksi'] = $this->Data->cetakpembayaran($id); 

			//menjumlahkan transaksi pada tanggal sekarang
			$data['grandtotaltransaksi'] = $this->Data->grandtotaltransaksi($id, $tgl);
			// filename dari pdf ketika didownload
			$file_pdf = 'cetak_data';
			// setting paper
			$paper = 'A4';
			//orientasi paper potrait / landscape
			$orientation = "portrait";
			
			$html = $this->load->view('pembayaran/cetaktransaksi',$data, true);	    
			
			// run dompdf
			$this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
	}



	// public function add_transaksi($id)
    // {
    //     $search = $this->db->query("SELECT `tb_siswa`.`nisn`, `tb_pembayaran`.`nisn` FROM `tb_siswa`, `tb_pembayaran` WHERE `tb_pembayaran`.`nisn` = `tb_siswa`.`nisn` AND `tb_pembayaran`.`id_pembayaran` = '" . $id . "'")->row_array();

	// 	// masuk ke Data model function editpem dengan mengirimkan semua inputan yang telah dimasukkan
	// 	$query = $this->Data->editpem($this->input->post());

	// 	//kembalikan ke nisn pencarian
	// 	redirect('pembayaran/transaksispp?search=' . $id);
       
    // }

	// //cetak transaksi pembayaran siswa tersebut di tanggal transaksi pembayaran itu dilakukan
	// public function cetaktransaksi($id){
	// 	$this->load->library('pdfgenerator');
	// 		//set tanggal sekarang
	// 		$tgl= date('Y-m-d');

	// 		$data['transaksi'] = $this->Data->cetaktransaksi($id, $tgl);

	// 		// menampilkan siswa yang sudah lunas secara row
	// 		$data['siswatransaksi'] = $this->Data->cetakhis($id); 

	// 		//menjumlahkan transaksi pada tanggal sekarang
	// 		$data['grandtotaltransaksi'] = $this->Data->grandtotaltransaksi($id, $tgl);
	// 		// var_dump($data['transaksi']);die;
	// 		// filename dari pdf ketika didownload
	// 		$file_pdf = 'cetak_data';
	// 		// setting paper
	// 		$paper = 'A4';
	// 		//orientasi paper potrait / landscape
	// 		$orientation = "portrait";
			
	// 		$html = $this->load->view('pembayaran/cetaktransaksi',$data, true);	    
			
	// 		// run dompdf
	// 		$this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
	// }
	
}