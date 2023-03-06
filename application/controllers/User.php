<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();

		//jika username dan nisn kosong maka mengeblok dan mengembalikan ke auth/login dan mengirimkan pesan
		if (empty($this->session->userdata('username') || $this->session->userdata('nisn'))) {
            $this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert">Maaf! Anda harus login terlebih dahulu.</div>');
            redirect('auth');
        }
		$this->load->model('Data_model', 'Data');
		

    }

	// mengarah ke dashboard
	public function index(){
		$data['title'] = 'Dashboard';
		
		//mengambil tb_petugas untuk hak akses
		$data['user'] = $this->db->get_where('tb_petugas', ['username' => $this->session->userdata('username')])->row_array();
        $data['siswa'] = $this->db->get_where('tb_siswa', ['nisn' => $this->session->userdata('nisn')])->row_array();

		//model siswarow untuk menampilkan informasi siswa
        $data['siswa'] = $this->Data->siswaambil();
		// var_dump($data['siswa']);die;

		//menjumlah data petugas, data siswa, dan transaksi
		$data['total_petugas'] = $this->db->get('tb_petugas')->num_rows();
		$data['total_siswa'] = $this->db->get('tb_siswa')->num_rows();
		$data['jumlahTransaksi'] = $this->Data->count_transaksi();

		
		//load view
		$this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('user/dashboard', $data);
        $this->load->view('templates/footer');
	}
	
}
