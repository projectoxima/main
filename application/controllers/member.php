<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends OxyController {
	public $group = [USER_ALL];

	public function __construct() {
		parent::__construct();
		$this->load->model('member/members');
		$this->load->model('login/users');
	}

	public function index(){
		$this->layout->view('member/register', null);
	}

	public function register(){
		$data = array(
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),
				'pin_id' => $this->session->userdata('pin_id'),
				'group_id' => 3,
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone')
			);

		$new = $this->users->create($data);

		$user_id = $this->db->insert_id();

		$data = array(
			'user_id' => $user_id,
			// 'no_id' => $this->input->post('no-id'),
			// 'no_sponsor' => $this->input->post('no-sponsor'),
			// 'tgl_pengajuan' => $this->input->post('tanggal-pengajuan'),
			'nama_lengkap' => $this->input->post('nama-lengkap'),
			'alamat' => $this->input->post('alamat'),
			'kota' => $this->input->post('kota'),
			'propinsi' => $this->input->post('propinsi'),
			'kodepos' => $this->input->post('kode-post'),
			'tempat_lahir' => $this->input->post('tempat-lahir'),
			'tgl_lahir' => $this->input->post('tgl-lahir'),
			'agama' => $this->input->post('agama'),
			'jenis_kelamin' => $this->input->post('jenis-kelamin'),
			'phone' => $this->input->post('phone'),
			'ktp' => $this->input->post('no-ktp'),
			'email' => $this->input->post('email'),
			'no_rekening' => $this->input->post('no-rekening'),
			'bank' => $this->input->post('bank'),
			'nama_rekening' => $this->input->post('nama-rekening'),
			'nama_ahli_waris' => $this->input->post('nama-ahli-waris'),
			'hubungan_keluarga' => $this->input->post('hubungan-keluarga'),
		);

		$new = $this->members->create($data);

		if($new > 0) {
			echo json_encode(array('status' => 'ok'));
		} else {
			echo json_encode(array('status' => 'error'));
		}

		$this->session->set_flashdata('success', 'Register Success.');
		redirect(base_url() . 'home');
	}
}

/* End of file home.php */
/* Location: ./application/controllers/register.php */
