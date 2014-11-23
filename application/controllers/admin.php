<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends OxyController {
	public $group = [USER_ADMIN];

	public function __construct() {
		parent::__construct();
	}

	public function index(){
		$this->layout->view('member/register', null);
	}
}
