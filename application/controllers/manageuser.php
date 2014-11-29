<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* untuk admin dan operator */

class Manageuser extends OxyController {
	public $group = [USER_ADMIN, USER_OPERATOR];

	public function __construct() {
		parent::__construct();
		$this->load->model('admin/user_model', 'user');
	}

	public function index(){
		$this->layout->view('admin/manage_users', array(
		));
	}
}
