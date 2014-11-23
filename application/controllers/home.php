<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends OxyController {
	public $group = [USER_ALL];

	public function __construct() {
		parent::__construct();
	}

	public function index(){
		$this->layout->view('dashboard/content', null);
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
