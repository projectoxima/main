<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends OxyController {
	public $group = [USER_ALL];

	public function __construct() {
		parent::__construct();
		$this->load->model('member/members');
		$this->load->model('login/users');
	}

	public function index(){
		$data['profile'] = $this->users->find_profile($this->session->userdata('id'));

		// Get Top Parent
		$titiks = $this->members->find_titik_parent($this->session->userdata('id'));
		$parent = $this->members->find_parent_of_childs($titiks['idbarang_id']);		
		$data['tree'] = $this->traverse_tree($parent['parent_child_id'], 0);

		$this->layout->view('member/index', $data);
	}

	public function upline($id){
		$data['profile'] = $this->users->find_profile($this->session->userdata('id'));

		// Get Top Parent
		// $titiks = $this->members->find_titik_parent($this->session->userdata('id'));
		$parent = $this->members->find_parent_of_childs($id);		
		$data['tree'] = $this->traverse_tree($parent['parent_child_id'], 0);

		$this->layout->view('member/index', $data);
	}

	public function add_member(){
		$this->layout->view('member/register', null);
	}

	public function register(){
		// Alocate the pin for new member
		// Get unused pin
		$pin_id = $this->members->get_pin();

		$data_user = array(
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),
				'pin_id' => $pin_id['id'],
				'group_id' => 3
			);

		$new = $this->users->create($data_user);
		$user_id = $this->db->insert_id();

		// Get ID Sponsor
		$id_sponsor = $this->members->get_sponsor($this->input->post('id-sponsor'));

		// Insert biodata to table profiles
		$data = array(
			'user_id' => $user_id,
			// 'no_id' => $this->input->post('no-id'),
			'sponsor_id' => $id_sponsor['id'],
			'tgl_pengajuan' => date("Y-m-d"),
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
			// Update pin status dari unused menjadi used
			$update_pin = $this->members->update_pin($pin_id['id']);

			echo json_encode(array('status' => 'ok'));
		} else {
			echo json_encode(array('status' => 'error'));
		}

		$this->session->set_flashdata('success', 'Register Success.');
		redirect(base_url() . 'member');
	}

	// Fungsi untuk generate member tree
	private function traverse_tree($idx, $count){
		// Find Top Parent
		$parent = $this->members->find_parents($idx);

		if($parent == 0){
			return;
		}

		$tree = ($count === 0) ? '<ul id="org-chart">' : '<ul>';

		for($i=0;$i<count($parent);$i++){
			// Get nama pengguna titik
			$users = $this->users->find_profile($parent[$i]['titik_id']);

			$tree .= '<li data-id="'.$parent[$i]['id'].'">';
			$tree .= $users['nama_lengkap'];

			$tree .= $this->traverse_tree($parent[$i]['id'], 1);
			$tree .= '</li>';
		}

		$tree .= '</ul>';
		return $tree;
	}

	public function get_profile($id){
		$profile = $this->users->find_profile($id);

		if($profile > 0){
			echo json_encode(array('status' => 'ok', 'data' => $profile));
		} else {
			echo json_encode(array('status' => 'error'));
		}
	}
}

/* End of file home.php */
/* Location: ./application/controllers/register.php */
