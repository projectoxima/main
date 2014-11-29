<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company extends OxyController {

	public function __construct(){
		parent::__construct();
		$this->load->model('layouting/contents_model');
	}

	public function profile(){
		$content = $this->contents_model->get_content('OXIMA_COMPANY_PROFILE');
		$data = array(
			'content' => $content,
			);
		$this->layout->view('company/profile', $data);
	}
	
	public function product(){
		$content = $this->contents_model->get_content('OXIMA_COMPANY_PRODUCT');
		$data = array(
			'content' => $content,
			);
		$this->layout->view('company/product', $data);
	}
}