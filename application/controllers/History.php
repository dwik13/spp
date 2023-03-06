<?php
defined('BASEPATH') or exit('No direct script access allowed');

class History extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
		// jika userdata nya selain username dan nisn maka dia ke blok
		if (empty($this->session->userdata('username') || $this->session->userdata('nisn'))) {
            redirect('auth/blocked');
        }

		$this->load->model('Data_model', 'Data');
        $this->load->library('form_validation');
		//untuk mengubah Ymd anggka menjadi Ymd string di indonesia
		$this->load->helper('tgl_indo_helper');

    }
	

	public function history()
    {
		//menampilkan nama profil di sidebar
		$data['user'] = $this->db->get_where('tb_petugas', ['username' => $this->session->userdata('username')])->row_array();
        $data['siswa'] = $this->db->get_where('tb_siswa', ['nisn' => $this->session->userdata('nisn')])->row_array();

		$data['title'] = ' History Pembayaran';

		// mengambil data siswa di model data model nama function nya siswa_get
		// $data['siswaget'] = $this->Data->siswa_get();
		// $data['siswaget'] = $this->Data->siswapembayaran();

		//history milik admin
		$data['pembayaransiswaadmin'] = $this->Data->history_getsiswaadmin();

		//history milik petugas
		$data['pembayaransiswapetugas'] = $this->Data->history_getsiswapetugas();

		//menampilkan data di halaman history siswa
		$data['pembayaran'] = $this->Data->history_get();
		

		//menampilkan tagihan siswa yang belum lunas 
        $data['tagihan'] = $this->Data->tagihan();

		// jika null maka
        if($this->session->userdata('nisn') == null){
        } else {
			// menampilkan total tagihan siswa
        $data['total'] = $this->Data->total_tagihan($this->session->userdata('nisn'));
        }
		
		$this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('history/v_history', $data);
        $this->load->view('templates/footer');
    }
	

	// public function cetakHistory($id){
	// 	//load library pdfgenerator
	// 	$this->load->library('pdfgenerator');

	// 	//menampilkan cetak history yang sudah lunas
	// 	$data['cetakhistory'] = $this->Data->cetak_history($id);
		
	// 	//menampilkan data siswa secara row
	// 	$data['transaksi'] = $this->Data->cetakhis($id); 

	// 	//menjumlahkan semua pembayaran yang sudah lunas
	// 	$data['grandtotal'] = $this->Data->grandtotal($id);
	// 	// filename dari pdf ketika didownload
    //     $file_pdf = 'cetak_data';
    //     // setting paper
    //     $paper = 'A4';
    //     //orientasi paper potrait / landscape
    //     $orientation = "portrait";
        
	// 	//load view
	// 	$html = $this->load->view('history/cetakhistory',$data, true);	    
        
    //     // run dompdf
    //     $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
	// }


	
}
