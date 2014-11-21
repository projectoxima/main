<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends OxyController {
	public $group = USER_ALL;

	public function __construct() {
		parent::__construct();
	}

	public function index(){
		$this->layout->view('member/register', null);
	}

	public function register(){
		$data = array(
				
			);
	}
}

/* End of file home.php */
/* Location: ./application/controllers/register.php */
