<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends OxyController {
	public $group = [USER_ALL];

	public function __construct() {
		parent::__construct();
		$this->load->model('login/users');
	}

	public function index(){
		$data['profile'] = $this->users->find_profile($this->session->userdata('id'));
		$this->layout->view('dashboard/member', $data);
	}
	
	public function umum(){
		$data = array(
			'text'=>'ini adalah text'
		);
		$this->layout->view('welcome/index', $data);
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
