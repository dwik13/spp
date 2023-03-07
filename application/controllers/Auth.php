<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
    {
        parent::__construct();

		// load model dan library
		$this->load->model('Account_model', 'Account');
        $this->load->library('form_validation');
    }

	//login validasi
	public function index(){
		//jika benar maka kembalikan data ke controller user yaitu dashboard
		if ($this->session->userdata('username') || $this->session->userdata('nisn')) {
            redirect('user');
        }

		$this->form_validation->set_rules('username', 'Username', 'required', [
            'required' => 'Username tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required', [
            'required' => 'Password tidak boleh kosong!'
        ]);
		
        if ($this->form_validation->run() == FALSE) {
			    $data['title'] = 'Login';
			    $this->load->view('auth/login', $data);
        } else {
            // menjalankan fungsi login
            $this->_login();
        }
	}

	public function _login()
    {
        $username = $this->input->post('username');
		$password = md5($this->input->post('password'));  //md5 = keperluan dalam membangun keamanan sebuah sebuah aplikasi (untuk merubah sebuah kata/kalimat menjadi kode acak)

		
        $chk = $this->Account->login_check($username, $password); // melakukan cek untuk tabel petugas
        $chk_siswa = $this->Account->siswa_check($username, $this->input->post('password')); // melakukan cek untuk tabel siswa

        // Jika data dari username dan password yang diisi oleh user ada di tabel petugas maka 

        if ($chk == true) {
            $dataget = $this->Account->login_get($username, $password);
            foreach ($dataget as $userdata) : endforeach;

			//mengecek level petugas
            $levelget = $this->Account->level_get($userdata->id_level);
            foreach ($levelget as $leveldata) : endforeach;

            $data = [
                'id_petugas' => $userdata->id_petugas,
                'username' => $username,
                'nama' => $userdata->nama_petugas,
                'level' => $leveldata->level
            ];

            $this->session->set_userdata($data);
            redirect('user');

            // Jika di tabel petugas tidak ada maka cek kembali untuk tabel siswa

        } else if ($chk_siswa) {
            $dataget = $this->Account->siswa_get($username, $this->input->post('password'));
            foreach ($dataget as $userdata) : endforeach;

            $data = [
                'nisn' => $username,
                'nis' => $userdata->nis,
                'nama' => $userdata->nama,
                'kelas' => $userdata->id_kelas,
                'alamat' => $userdata->alamat,
                'level' => 'Siswa',
                'no_Telp' => $userdata->no_telp,
                'image' => $userdata->image,
            ];

			// session adalah data yang disimpan di server, dimana data tersebut dapat diakses secara global di server tersebut.

			// Fitur aplikasi yang sering menggunakan session ini adalah proses login user, dimana biasanya digunakan untuk menyimpan data user yang sedang login, sehingga data tersebut dapat dibaca oleh seluruh file didalam server.

            $this->session->set_userdata($data);
            redirect('user');

            // Jika data yang di masukkan oleh user tidak ada maka tampilkan error 
        } else {
            $this->session->set_flashdata('message',  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>Maaf akun tidak ditemukan!</strong> Mungkin anda salah memasukan username atau password.
			
			</div>');
            redirect('auth');
        }
    }

	public function logout()
    {
		//untuk menghapus session
        $this->session->sess_destroy();

        redirect('auth');
    }

	//membloked access ke dalam aplikasi jika user belum login
	public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}