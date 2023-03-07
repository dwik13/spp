<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterData extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
		
        if (empty($this->session->userdata('username')) || $this->session->userdata('level') != 'Admin') {
            redirect('auth/blocked');
        }		
		
		$this->load->model('Data_model', 'Data');
        $this->load->library('form_validation');
    }















	// petugas




	//menampilkan petugas
	public function petugas(){
		$data['title'] = 'Data Petugas';

		//menampilkan user yang login pada profil
		$data['user'] = $this->db->get_where('tb_petugas', ['username' => $this->session->userdata('username')])->row_array();

		//menampilkan tb_level
		$data['level'] = $this->db->get_where('tb_level')->result_array();

		//menampilkan tb_petugas dan join an nya yaitu tb_level
		$data['petugas'] = $this->Data->getpetugas();
	
		//tampilkan view
		$this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('masterdata/petugas/v_petugas', $data);
        $this->load->view('templates/footer', $data);
	}


	// tambah petugas
	public function add_petugas(){

		// form_validation validasi error
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[tb_petugas.username]', [
			// trim = menghapus spasi
            'required' => 'Username tidak boleh kosong!',
            'is_unique' => 'Username sudah ada.'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|matches[password2]|min_length[5]', [
            'required' => 'Password tidak boleh kosong!',
            'matches' => 'Password tidak sama.',
            'min_length' => 'Password minimal 5 karakter.'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', [
            'required' => 'Password tidak boleh kosong!',
			'matches' => 'Password tidak sama.'
        ]);
        $this->form_validation->set_rules('nama_petugas', 'Nama_petugas', 'required|trim', [
            'required' => 'nama petugas tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('level_id', 'Level', 'required|trim', [
            'required' => 'level tidak boleh kosong!'
        ]);


		//jika form_validation nya tidak ada data yang masuk maka masuk ke view add_petugas
		if ($this->form_validation->run() == false) {

			$data['title'] = 'Data Petugas';
			$data['level'] = $this->db->get_where('tb_level')->result_array();
			$data['user'] = $this->db->get_where('tb_petugas', ['username' => $this->session->userdata('username')])->row_array();
			
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/navbar', $data);
			$this->load->view('masterdata/petugas/add_petugas', $data);
			$this->load->view('templates/footer');

		// jika ada data yang masuk maka jalankan bagian ini
		}else{
			$data = array(
				// htmlspecialchars yaitu untuk mencegah penginputan sebuah kode atau script yang bisa menjalankan sesuai inputan, dengan adanya htmlspecialchars akan menampilkan sesuai user inputkan jadi kode atau script nya ditampilkan.
				'username' => htmlspecialchars($this->input->post('username', true)),
				'password' => md5(
					$this->input->post('password1')
				),
				//menampilkan password asli
				'deskripsi' => $this->input->post('password1'),
				'nama_petugas' =>  htmlspecialchars($this->input->post('nama_petugas', true)),
				// tambah data petugas juga tambah admin
				'id_level' => $this->input->post('level_id')
			);
			$query = $this->db->insert('tb_petugas', $data);
			
			// jika $query berjalan (kondisi true) maka tampilkan flashdata dan di kembalikan pada controller  masterdata petugas
			if ($query == true) {
				$this->session->set_flashdata('message', '  Data petugas berhasil ditambahkan');
				redirect('masterdata/petugas');
			}
		}
		
	}


	// edit petugas
	public function edit_petugas(){
		// username tidak bisa diganti karena untuk login jadi harus uniq(berbeda dengan yang lain)
		$this->form_validation->set_rules('nama_petugas', 'Nama_petugas', 'required|trim');
		$this->form_validation->set_rules('level_id', 'Nama_petugas', 'required|trim');
	
		//jika form_validation nya tidak berjalan maka kirim flash data error dan kembalikan ke controller masterdata petugas
        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger" role"alert">Gagal diubah</div>'
            );
            redirect('masterdata/petugas');

		// jika form_validation berjalan maka jalan kan ini
        } else {
            $data = array(
                'nama_petugas'   => $_POST['nama_petugas'],
                'id_level'   => $_POST['level_id']
            );
            $this->db->where('id_petugas', $_POST['id_petugas']);
            $query = $this->db->update('tb_petugas', $data);
            if ($query == true) {
                $this->session->set_flashdata(
                    'message',
                    'Data Petugas berhasil diedit'
                );
                redirect('masterdata/petugas');
            }
        }
    }


	// ubah password
	public function ubah_pass(){
		
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[5]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]',[
            'required' => 'Password tidak boleh kosong!',
            'matches' => 'Password tidak sama.',
        ]);

		// jika di form_validation terdapat error maka kirimkan flashdata error
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger" role"alert">Gagal diubah</div>'
            );
            redirect('masterdata/petugas');
        } else {
            $data = array(
                'password'     =>  md5($this->input->post('password1')),
				'deskripsi' => $this->input->post('password1')
            );
            $this->db->where('id_petugas', $_POST['id_petugas']);
            $query = $this->db->update('tb_petugas', $data);
            if ($query == true) {
                $this->session->set_flashdata(
                    'message',
                    'Data Petugas berhasil diedit'
                );
                redirect('masterdata/petugas');
            }
        }
	}

	// hapus petugas
	public function hapus_petugas($id_petugas){
		 
		$this->db->trans_start();

		// Cek apakah data di tabel terkait masih ada yang menggunakan nilai ID ini
		$cek = $this->db->get_where('tb_pembayaran', ['id_petugas' => $id_petugas]);
		if ($cek->num_rows() > 0) {
			// Ada data terkait, rollback transaksi dan hentikan proses penghapusan
			$this->db->trans_rollback();
			$this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger" role"alert">Data tidak dapat dihapus karena sudah terpakai</div>'
            );
            redirect('masterdata/petugas');
		}

		// Tidak ada data terkait, lanjutkan dengan penghapusan data
		$this->db->delete('tb_petugas', ['id_petugas' => $id_petugas]);

		$this->db->trans_complete();
		if ($this->db->trans_status() === false) {
			$this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger" role"alert">Gagal diubah</div>'
            );
            redirect('masterdata/petugas');
		} else {
			// Transaksi berhasil, tampilkan pesan sukses
			$this->session->set_flashdata(
				'message',
				'Data Petugas berhasil didelete'
			);
			redirect('masterdata/petugas');
		}
	}






















	// siswa



	// menampilkan siswa
	public function siswa(){
		$data['title'] = 'Data Siswa';

		// mengambil data siswa di model data model nama function nya siswa_get
		$data['siswa'] = $this->Data->siswa_get();
		
		$data['spp'] = $this->db->get('tb_spp')->result();

		//untuk filter kelas sesuai kelas yang dia awal masukkan
		$data['kelassama'] = $this->Data->kelassama();  

		$data['user'] = $this->db->get_where('tb_petugas', ['username' => $this->session->userdata('username')])->row_array();

		$this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('masterdata/siswa/v_siswa', $data);
        $this->load->view('templates/footer');
	}



	// add siswa
	public function add_siswa(){
			$this->form_validation->set_rules('nisn', 'nisn', 'required|trim|is_unique[tb_siswa.nisn]|min_length[10]|max_length[10]', [
				'required' => 'NISN tidak boleh kosong!',
				'is_unique' => 'NISN sudah ada.',
				'min_length' => 'NISN tidak boleh kurang dari 10',
				'max_length' => 'NISN tidak boleh lebih dari 10',
			]);
			$this->form_validation->set_rules('nis', 'nis', 'required|trim|is_unique[tb_siswa.nis]|min_length[8]|max_length[8]', [
				'required' => 'NIS tidak boleh kosong!',
				'is_unique' => 'NIS sudah ada.',
				'min_length' => 'NIS tidak boleh kurang dari 8',
				'max_length' => 'NIS tidak boleh lebih dari 8',
			]);
			$this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
				'required' => 'Nama tidak boleh kosong!',
			]);
			$this->form_validation->set_rules('kelas_id', 'Kelas', 'required|trim', [
				'required' => 'Kelas tidak boleh kosong!',
			]);
			$this->form_validation->set_rules('spp_id', 'Tahun Ajaran', 'required|trim', [
				'required' => 'Tahun Ajaran tidak boleh kosong!',
			]);
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
				'required' => 'Alamat tidak boleh kosong!',
			]);
			$this->form_validation->set_rules('no_telp', 'No.Telp', 'required|trim|min_length[10]|max_length[13]', [
				'required' => 'No.Telp tidak boleh kosong!',
				'min_length' => 'no telp minimal 10 karakter.',
				'max_length' => 'no telp maximal 13 karakter.'
			]);
			$this->form_validation->set_rules('tempo', 'Jatuh Tempo', 'required', [
				'required' => 'Tempo tidak boleh kosong!',
			]);
			
			if ($this->form_validation->run() == false) {

				$data['title'] = 'Data Siswa';

				//menampilkan profil nama
				$data['user'] = $this->db->get_where('tb_petugas', ['username' => $this->session->userdata('username')])->row_array();
				
				$data['siswa'] = $this->db->get_where('tb_siswa', ['nisn' => $this->session->userdata('nisn')])->row_array();

				//mengambil tb kelas dan tb spp
				$data['kelas'] = $this->db->get('tb_kelas')->result_array();
				$data['spp'] = $this->db->get('tb_spp')->result_array();
				
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar', $data);
				$this->load->view('templates/navbar', $data);
				$this->load->view('masterdata/siswa/add_siswa', $data);
				$this->load->view('templates/footer');
			}else{

				// mengambil Data model dengan function get_id_spp()
				$spp = $this->Data->get_id_spp();
				// $spp beisi id_spp tahun dan nominal yang sesuai di inputkan user
				foreach ($spp as $s) : endforeach;

				// ambil inputan tempo
				$awalTempo = $this->input->post('tempo');

				//nilai default 01 adalah nomer urutan bulan
				$bulanData = [
					'01' => 'Januari',
					'02' => 'Februari',
					'03' => 'Maret',
					'04' => 'April',
					'05' => 'Mei',
					'06' => 'Juni',
					'07' => 'Juli',
					'08' => 'Agustus',
					'09' => 'September',
					'10' => 'Oktober',
					'11' => 'November',
					'12' => 'Desember'
				];
				
				$nisn = $this->input->post('nisn');
				$nis = $this->input->post('nis');
				$nama = $this->input->post('nama');
				$kelas_id = $this->input->post('kelas_id');
				$spp_id = $this->input->post('spp_id');
				$no_telp = $this->input->post('no_telp');
				$alamat = $this->input->post('alamat');

					$image = $_FILES['image']['name'];
					
					//jika inputan gambar kosong
					if($image = ''){
						
					}else{ //jika ada inputan gambar
					$config['allowed_types'] = 'gif|jpg|jpeg|png';
					$config['upload_path'] = './assets/img/profile';
					
					$this->load->library('upload', $config);

					//jika tidak ada gambar munculkan erorr
					if (!$this->upload->do_upload('image')) {
						echo $this->upload->display_errors();
					} else {
						$image = $this->upload->data('file_name');
					}
				}

				//mengambil inputan yang sudah dimasukkan
				$data = [
					'nisn' => $nisn,
					'nis' => $nis,
					'nama' => $nama,
					'id_kelas' => $kelas_id,
					'id_spp' => $spp_id,
					'no_telp' => $no_telp,
					'alamat' => $alamat,
					'image' => $image,
					'status' => 'aktif'
				];
		
				// tambahkan ke tb_siswa
				$simpan = $this->db->insert('tb_siswa', $data);
		
				// jika simpan ini tidak berhasil dijalankan maka gagal
				if (!$simpan) {
					echo "Gagal cuy";

				// jika simpan ini berhasil dijalankan maka jalankan kode program
				} else {
		
					// $data['nisn'] berasal dari inputan user
					$nisn = $data['nisn'];
		
					//tetep mengulang sampai batas perulangan habis
					for ($i = 0; $i < 12; $i++) {

						// membuat tanggal jatuh tempo nya setiap tanggal 20
						//perulangan bulan, jatuh tempo
						//pertanyaan jatuh tempo itu kan cuma dibuat perulangan apa perlu? 
						// strtotime = mengubah string waktu dan tanggal menjadi standar times tamp unix
						//+$i month  sama dengan 01 = januari, yang diulang adalah bulan
						$jatuhTempo = date('Y-m-d', strtotime("+$i month", strtotime($awalTempo)));
		
						// perulangan bulan, contoh jatuh tempo 2023-02-12
						//berarti date(m) itu 02 dan nilai 02 di bulandata adalah februari
						$bulan = $bulanData[date('m', strtotime($jatuhTempo))];
						
						//perulangan tahun
						$tahun = date('Y', strtotime($jatuhTempo));
		
						$data = [
							'nisn' => $nisn,
							'jatuh_tempo' => $jatuhTempo,
							'bulan_dibayar' => $bulan,
							'tahun_dibayar' => $tahun,
							'id_spp' => $this->input->post('spp_id'),
							'jumlah_bayar' => $s->nominal
						];

						$this->db->insert('tb_pembayaran', $data);
					}
				}
				//setelah perulangan berhenti maka jalan kan flashdata dibawah ini
				$this->session->set_flashdata('message', '  Data siswa berhasil ditambahkan');
				redirect('masterdata/siswa');
			}
	}


	//edit siswa
	public function edit_siswa($id){
		$this->form_validation->set_rules('nis', 'nis', 'required|trim|min_length[8]|max_length[8]', [
			'required' => 'NIS tidak boleh kosong!',
			'min_length' => 'NIS tidak boleh kurang dari 8',
			'max_length' => 'NIS tidak boleh lebih dari 8'
		]);
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim',[
			'required' => 'Nama tidak boleh kosong!',
		]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim',[
			'required' => 'Alamat tidak boleh kosong!',
		]);
        $this->form_validation->set_rules('no_telp', 'No.Telp', 'required|trim',[
			'required' => 'no_telp tidak boleh kosong!',
		]);

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Data Siswa';

			// mengambil data siswa di model data model nama function nya siswa_get untuk edit kelulusan
			$data['siswa'] = $this->Data->siswa_get();
			
			$data['spp'] = $this->db->get('tb_spp')->result();

			//mengambil data siswa di model data model nama function nya imagesiswa untuk edit siswa
			$data['imagesiswa'] = $this->Data->imagesiswa($id);

			//untuk filter kelas sesuai kelas yang dia awal masukkan
			$data['kelassama'] = $this->Data->kelassama();  
	
			$data['user'] = $this->db->get_where('tb_petugas', ['username' => $this->session->userdata('username')])->row_array();
	
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/navbar', $data);
			$this->load->view('masterdata/siswa/e_siswa', $data);
			$this->load->view('templates/footer');
		}else{
			$data['imagesiswa'] = $this->Data->imagesiswa($id);

			 //jika ada gambar yang diupload
			 $nis = $this->input->post('nis');
			 $nama = $this->input->post('nama');
			 $no_telp = $this->input->post('no_telp');
			 $alamat = $this->input->post('alamat');
			 $upload_image = $_FILES['image']['name'];
			 
			 if ($upload_image) {
				 $config['allowed_types'] = 'gif|jpg|png|jpeg';
				 $config['max_size'] = '2048';
				 $config['upload_path'] = './assets/img/profile';
				 $this->load->library('upload', $config);
 
				 if ($this->upload->do_upload('image')) {
					 $old_image = $data['imagesiswa']['image'];
					 if ($old_image != 'default.png') { //jika gambar lama bukan default.png 
					 }
					 unlink(FCPATH . 'assets/img/profile/' . $old_image); //selain default.png dan berhasil ke upload maka hapus gambar lama
					 $new_image = $this->upload->data('file_name');
					 $this->db->set('image', $new_image);
				 } else {
					 echo $this->upload->display_errors();
				 }
			 }
			$data1 = [
				'nis' => $nis,
				'nama' => $nama,
				'no_telp' => $no_telp,
				'alamat' => $alamat,
			];
			
			$this->db->where('nisn', $_POST['id']);  
			$query = $this->db->update('tb_siswa', $data1);
			
			if ($query == true) {
				$this->session->set_flashdata(
					'message',
					'Data siswa berhasil diedit'
				);
				redirect('masterdata/siswa');
			}
		}
	}


	//edit tahun ajaran
	public function edit_tahun(){
		$this->form_validation->set_rules('kelas_id', 'Kelas', 'required|trim');
        $this->form_validation->set_rules('spp_id', 'Tahun Ajaran', 'required|trim');
		$this->form_validation->set_rules('tempo', 'Jatuh Tempo', 'required');
		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger" role"alert">Gagal diubah</div>'
            );
			redirect('masterdata/siswa');
		}else{
			
			//ambil spp id
			$spp = $this->Data->get_id_spp();
			foreach ($spp as $s) : endforeach;


			$awalTempo = $this->input->post('tempo');
			$bulanData = [
				'01' => 'Januari',
				'02' => 'Februari',
				'03' => 'Maret',
				'04' => 'April',
				'05' => 'Mei',
				'06' => 'Juni',
				'07' => 'Juli',
				'08' => 'Agustus',
				'09' => 'September',
				'10' => 'Oktober',
				'11' => 'November',
				'12' => 'Desember'
			];

		
			$data = [
				'nisn' => $this->input->post('nisn'),
				'id_kelas' => $this->input->post('kelas_id'),
            	'id_spp' => $this->input->post('spp_id')
			];

			$this->db->where('nisn', $_POST['id']);
			$simpan = $this->db->update('tb_siswa', $data);
	
			if (!$simpan) {
				echo "Gagal cuy";
			} else {
	
				$nisn = $data['nisn'];
	
				for ($i = 0; $i < 12; $i++) {
					// membuat tanggal jatuh tempo nya setiap tanggal 20
					$jatuhTempo = date('Y-m-d', strtotime("+$i month", strtotime($awalTempo)));
	
					$bulan = $bulanData[date('m', strtotime($jatuhTempo))];
					$tahun = date('Y', strtotime($jatuhTempo));
	
					$data = [
						'nisn' => $nisn,
						'jatuh_tempo' => $jatuhTempo,
						'bulan_dibayar' => $bulan,
						'tahun_dibayar' => $tahun,
						'id_spp' => $this->input->post('spp_id'),
						'jumlah_bayar' => $s->nominal
					];

					$this->db->insert('tb_pembayaran', $data);
				}
			}
			$this->session->set_flashdata(
				'message',
				'Data siswa berhasil diedit'
			);
			redirect('masterdata/siswa');
			
		}
	}

	//ubah status siswa aktif atau tidak nya
	public function update_status()
    {
        $nisn = $this->input->post('kt'); //nisn
        $status = $this->input->post('stt'); //status

		$this->db->set('status', $status);
        $this->db->where('nisn', $nisn);
        $this->db->update('tb_siswa');

     
    }

	// hapus siswa
	public function hapus_siswa($id){
		
		$this->db->trans_start();

		// Cek apakah data di tabel terkait masih ada yang menggunakan nilai ID ini
		$cek = $this->db->get_where('tb_pembayaran', ['nisn' => $id]);
		if ($cek->num_rows() > 0) {
			// Ada data terkait, rollback transaksi dan hentikan proses penghapusan
			$this->db->trans_rollback();
			$this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger" role"alert">Data tidak dapat dihapus karena sudah terpakai</div>'
            );
            redirect('masterdata/siswa');
		}

		// Tidak ada data terkait, lanjutkan dengan penghapusan data
		$this->db->delete('tb_spp', ['nisn' => $id]);

		$this->db->trans_complete();
		if ($this->db->trans_status() === false) {
			$this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger" role"alert">Gagal diubah</div>'
            );
            redirect('masterdata/siswa');
		} else {
			// Transaksi berhasil, tampilkan pesan sukses
			$this->session->set_flashdata(
				'message',
				'Data SPP berhasil didelete'
			);
			redirect('masterdata/siswa');
		}
	}

















	// SPP



	// tampilan spp
	public function spp(){
		$data['title'] = 'Data SPP';
		$data['user'] = $this->db->get_where('tb_petugas', ['username' => $this->session->userdata('username')])->row_array();
        $data['siswa'] = $this->db->get_where('tb_siswa', ['nisn' => $this->session->userdata('nisn')])->row_array();

		//menampilkan tb_spp
		$data['spp'] = $this->db->get('tb_spp')->result_array();

		$this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('masterdata/spp/v_spp', $data);
        $this->load->view('templates/footer');
	}

	
	// add spp
	public function add_spp(){

        $this->form_validation->set_rules('tahun_awal', 'Tahun Awal', 'required', [
            'required' => 'Tahun Pertama tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('tahun_akhir', 'Tahun Akhir', 'required', [
            'required' => 'Tahun Kedua tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('nominal', 'Nominal', 'required', [
            'required' => 'Nominal tidak boleh kosong!'
        ]);
		
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Data SPP';
			$data['spp'] = $this->db->get('tb_spp')->result();
			$data['user'] = $this->db->get_where('tb_petugas', ['username' => $this->session->userdata('username')])->row_array();
        	$data['siswa'] = $this->db->get_where('tb_siswa', ['nisn' => $this->session->userdata('nisn')])->row_array();
			
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/navbar', $data);
			$this->load->view('masterdata/spp/add_spp', $data);
			$this->load->view('templates/footer');
        } else {
			$data = [
                'tahun' => $this->input->post('tahun_awal') . '/' . $this->input->post('tahun_akhir'),
                'nominal' => $this->input->post('nominal')
            ];

            $query = $this->db->insert('tb_spp', $data);
			if ($query == true) {
				$this->session->set_flashdata('message', '  Data spp berhasil ditambahkan');
				redirect('masterdata/spp');
			}
		}

	}

	// edit spp
	public function edit_spp(){
		
		$this->form_validation->set_rules('nominal', 'Nominal', 'required|trim');
	
        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger" role"alert">Gagal diubah</div>'
            );
            redirect('masterdata/spp');
        } else {
            $data = array(
                'nominal'   => $_POST['nominal']
            );
            $this->db->where('id_spp', $_POST['id_spp']);
            $query = $this->db->update('tb_spp', $data);
            if ($query == true) {
                $this->session->set_flashdata(
                    'message',
                    'Data SPP berhasil diedit'
                );
                redirect('masterdata/spp');
            }
        }
    }

	public function hapus_spp($id_spp){
        
		$this->db->trans_start();

		// Cek apakah data di tabel terkait masih ada yang menggunakan nilai ID ini
		$cek = $this->db->get_where('tb_siswa', ['id_spp' => $id_spp]);
		$cek = $this->db->get_where('tb_pembayaran', ['id_spp' => $id_spp]);
		if ($cek->num_rows() > 0) {
			// Ada data terkait, rollback transaksi dan hentikan proses penghapusan
			$this->db->trans_rollback();
			$this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger" role"alert">Data tidak dapat dihapus karena sudah terpakai</div>'
            );
            redirect('masterdata/spp');
		}

		// Tidak ada data terkait, lanjutkan dengan penghapusan data
		$this->db->delete('tb_spp', ['id_spp' => $id_spp]);

		$this->db->trans_complete();
		if ($this->db->trans_status() === false) {
			$this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger" role"alert">Gagal diubah</div>'
            );
            redirect('masterdata/spp');
		} else {
			$this->session->set_flashdata(
				'message',
				'Data SPP berhasil didelete'
			);
			redirect('masterdata/spp');
			// Transaksi berhasil, tampilkan pesan sukses
		}
	}
	









	// Jurusan
	

	public function jurusan(){
		$data['title'] = 'Data Jurusan';
		$data['user'] = $this->db->get_where('tb_petugas', ['username' => $this->session->userdata('username')])->row_array();
        $data['siswa'] = $this->db->get_where('tb_siswa', ['nisn' => $this->session->userdata('nisn')])->row_array();
		$data['jurusan'] = $this->db->get('tb_jurusan')->result_array();

		$this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('masterdata/jurusan/v_jurusan', $data);
        $this->load->view('templates/footer');
	}


	public function add_jurusan(){
		$this->form_validation->set_rules('jurusan', 'Jurusan', 'required|is_unique[tb_jurusan.jurusan]', [
            'required' => 'Kompetensi Keahlian tidak boleh kosong.',
			'is_unique' => 'jurusan sudah ada'
        ]);

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger" role"alert">Gagal diubah</div>'
            );
            redirect('masterdata/jurusan');
        } else {
            $data = array(
                'jurusan'   => $_POST['jurusan']
            );
            $query = $this->db->insert('tb_jurusan', $data);
            if ($query == true) {
                $this->session->set_flashdata(
                    'message',
                    'Data Jurusan berhasil ditambahkan'
                );
                redirect('masterdata/jurusan');
            }
        }
	}


	public function edit_jurusan(){
		$this->form_validation->set_rules('jurusan', 'Jurusan', 'required');

        if ($this->form_validation->run() == false) {
			$this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger" role"alert">Gagal diubah</div>'
            );
            redirect('masterdata/jurusan');
        } else {
			$data = array(
                'jurusan'   => $_POST['jurusan']
            );
            $this->db->where('id_jurusan', $_POST['id_jurusan']);
            $query = $this->db->update('tb_jurusan', $data);
            if ($query == true) {
                $this->session->set_flashdata(
                    'message',
                    'Data Jurusan berhasil diedit'
                );
                redirect('masterdata/jurusan');
            }
        }
	}


	public function hapus_jurusan($id_jurusan){
		$this->db->trans_start();

		// Cek apakah data di tabel terkait masih ada yang menggunakan nilai ID ini
		$cek = $this->db->get_where('tb_kelas', ['id_jurusan' => $id_jurusan]);
		if ($cek->num_rows() > 0) {
			// Ada data terkait, rollback transaksi dan hentikan proses penghapusan
			$this->db->trans_rollback();
			$this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger" role"alert">Data tidak dapat dihapus karena sudah terpakai</div>'
            );
            redirect('masterdata/jurusan');
		}

		// Tidak ada data terkait, lanjutkan dengan penghapusan data
		$this->db->delete('tb_jurusan', ['id_jurusan' => $id_jurusan]);

		$this->db->trans_complete();
		if ($this->db->trans_status() === false) {
			$this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger" role"alert">Gagal diubah</div>'
            );
            redirect('masterdata/jurusan');
		} else {
			$this->session->set_flashdata(
                'message',
                'Data Jurusan berhasil di Delete'
            );
            redirect('masterdata/jurusan');
			// Transaksi berhasil, tampilkan pesan sukses
		}
	}














	//Kelas




	// menampilkan kelas
	public function kelas(){
		$data['title'] = 'Data Kelas';
		$data['user'] = $this->db->get_where('tb_petugas', ['username' => $this->session->userdata('username')])->row_array();
        $data['siswa'] = $this->db->get_where('tb_siswa', ['nisn' => $this->session->userdata('nisn')])->row_array();
		$data['kelas'] = $this->Data->kelasget();
		$data['jurusan'] = $this->db->get('tb_jurusan')->result();


		$this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('masterdata/kelas/v_kelas', $data);
        $this->load->view('templates/footer');
	}


	// tambah kelas
	public function add_kelas(){
		// $data['spp'] = $this->db->get('tb_kelas')->result();

        $this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required', [
            'required' => 'Nama kelas tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('jurusan_id', 'Jurusan', 'required', [
            'required' => 'Kompetensi Keahlian tidak boleh kosong!'
        ]);

		
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Data Kelas';

			$data['kelas'] = $this->Data->kelasget();
			
			$data['jurusan'] = $this->db->get('tb_jurusan')->result();
			
			$data['user'] = $this->db->get_where('tb_petugas', ['username' => $this->session->userdata('username')])->row_array();
        	$data['siswa'] = $this->db->get_where('tb_siswa', ['nisn' => $this->session->userdata('nisn')])->row_array();
			
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/navbar', $data);
			$this->load->view('masterdata/kelas/add_kelas', $data);
			$this->load->view('templates/footer');
        } else {
			$data = [
                'nama_kelas' => $this->input->post('nama_kelas'),
                'id_jurusan' => $this->input->post('jurusan_id')
            ];

            $query = $this->db->insert('tb_kelas', $data);
			if ($query == true) {
				$this->session->set_flashdata('message', '  Data kelas berhasil ditambahkan');
				redirect('masterdata/kelas');
			}
		}

	}


	// edit kelas
	public function edit_kelas(){
		
		$this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required|trim');
		$this->form_validation->set_rules('jurusan_id', 'Jurusan', 'required|trim');
	
        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger" role"alert">Gagal diubah</div>'
            );
            redirect('masterdata/kelas');
        } else {
            $data = array(
                'nama_kelas'   => $_POST['nama_kelas'],
                'id_jurusan'   => $_POST['jurusan_id']
            );
            $this->db->where('id_kelas', $_POST['id_kelas']);
            $query = $this->db->update('tb_kelas', $data);
            if ($query == true) {
                $this->session->set_flashdata(
                    'message',
                    'Data Kelas berhasil diedit'
                );
                redirect('masterdata/kelas');
            }
        }
    }


	// hapus kelas
	public function hapus_kelas($id_kelas){

		$this->db->trans_start();

		// Cek apakah data di tabel terkait masih ada yang menggunakan nilai ID ini
		$cek = $this->db->get_where('tb_siswa', ['id_kelas' => $id_kelas]);
		if ($cek->num_rows() > 0) {
			// Ada data terkait, rollback transaksi dan hentikan proses penghapusan
			$this->db->trans_rollback();
			$this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger" role"alert">Data tidak dapat dihapus karena sudah terpakai</div>'
            );
            redirect('masterdata/kelas');
		}

		// Tidak ada data terkait, lanjutkan dengan penghapusan data
		$this->db->delete('tb_kelas', ['id_kelas' => $id_kelas]);

		$this->db->trans_complete();
		if ($this->db->trans_status() === false) {
			$this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger" role"alert">Gagal diubah</div>'
            );
            redirect('masterdata/kelas');
		} else {
			$this->session->set_flashdata(
                'message',
                'Data Kelas berhasil di Delete'
            );
            redirect('masterdata/kelas');
			// Transaksi berhasil, tampilkan pesan sukses
		}
	}
	
}