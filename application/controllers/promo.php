<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promo extends OxyController {

	public function __construct(){
		parent::__construct();
		$this->load->model('contents/promo_model');
	}

	public function create_promo(){
		$data = array(
			'promo_title' => $this->input->post('promo_title'),
			'promo_description' => $this->input->post('promo_description'),
			'create_date' => date('Y-m-d'),
		);

		$new = $this->promo_model->save_promo($data);
	}

	public function promo_list(){
		$promo_list = $this->promo_model->get_all_promo();
		$data = array(
			'promo_list' => $promo_list,
			);
		$this->layout->view('content/promo', $data);
	}
	
	public function promo_detail($id){
		$promo_detail = $this->promo_model->get_promo_detail($id);
		$data = array(
			'promo_detail' => $promo_detail[0],
			);
		$this->layout->view('content/promo_detail', $data);
	}
}