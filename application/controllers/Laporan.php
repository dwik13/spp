<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

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
	public function index()
	{
		$data['title'] = 'Generate Laporan';
		$data['user'] = $this->db->get_where('tb_petugas', ['username' => $this->session->userdata('username')])->row_array();
        $data['siswa'] = $this->db->get_where('tb_siswa', ['nisn' => $this->session->userdata('nisn')])->row_array();

		$data['cetakkelas'] = $this->Data->kelasget();
		
		$this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('laporan/v_laporan', $data);
        $this->load->view('templates/footer');

	}

	public function cetakPetugas(){
		$this->load->library('pdfgenerator');

		//cetak petugas yangg id_level nya 2
		$data['petugas'] = $this->db->get_where('tb_petugas', ['id_level' => 2])->result();
		
		// filename dari pdf ketika didownload
        $file_pdf = 'cetak_data_pdf';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        
		$html = $this->load->view('laporan/cetak_petugas',$data, true);	    
        
        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
	}

	public function laporan_siswa(){
		$data['title'] = 'Generate Laporan';
		$data['user'] = $this->db->get_where('tb_petugas', ['username' => $this->session->userdata('username')])->row_array();
        $data['siswa'] = $this->db->get_where('tb_siswa', ['nisn' => $this->session->userdata('nisn')])->row_array();

		// ambil data kelas
		$data['cetakkelas'] = $this->Data->kelasget();
		
		$this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('laporan/siswa_laporan', $data);
        $this->load->view('templates/footer');
	}

	public function cetakSiswa($id_kelas){
		$this->load->library('pdfgenerator');

		//cetak siswa
		$data['siswa'] = $this->Data->siswa_kelas($id_kelas);
		// $data['siswa'] = $this->Data->siswa_get();
		
		// filename dari pdf ketika didownload
        $file_pdf = 'cetak_data_pdf';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        
		$html = $this->load->view('laporan/cetak_siswa',$data, true);	    
        
        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
	}

	public function cetakPembayaran(){
		$this->load->library('pdfgenerator');

		//input post tanggal awal dan akhir
		$tgl_mulai = $this->input->post('tanggal_mulai');
        $tgl_ahir = $this->input->post('tanggal_ahir');

		//filter laporan berdasarkan tanggal
		$data['laporan'] =  $this->Data->filter_laporan($tgl_mulai, $tgl_ahir);

		//total laporan transaksi sesuai tanggal
        $data['grandtotransaksicetak'] = $this->Data->grandtotransaksicetak($tgl_mulai, $tgl_ahir);

		$this->session->set_userdata('tanggal_mulai', $tgl_mulai);
        $this->session->set_userdata('tanggal_ahir', $tgl_ahir);
		
		// filename dari pdf ketika didownload
        $file_pdf = 'cetak_data_pdf';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        
		$html = $this->load->view('laporan/cetak_pembayaran',$data, true);	    
        
        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
	}
}
