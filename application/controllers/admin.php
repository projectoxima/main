<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends OxyController {
	public $group = [USER_ADMIN];

	public function __construct() {
		parent::__construct();
	}

	public function list_pin(){
		echo 'list pin';
	}
	
	public function list_idb(){
		echo 'list id barang';
	}
}
