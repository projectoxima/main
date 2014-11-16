<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index(){
		$data = array(
			'text'=>'Ini adalah text'
		);
		$this->layout->view('welcome/index', $data);
	}
}
