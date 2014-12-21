<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
 * untuk user yang login
 * untuk menangani permintaan data yang sering di request user
 * seperti untuk paging pin, idbrang, detail member berdasarkan pin
 * dan lain-lain */

class Userutil extends OxyController {
	public $group = [USER_ADMIN, USER_OPERATOR, USER_MEMBER];

	public function __construct() {
		parent::__construct();
		$this->load->model('admin/user_model', 'user');
	}
	
	public function get_user_detail_by_pin(){
		if(!$this->input->is_ajax_request())
			return;
			
		$pin = $this->input->post('pin');
		
		$result = $this->user->user_detail_by_pin_for_public($pin);
		echo json_encode($result);
		return;
	}
	
	
	//~ for testing
	public function test(){
		$this->load->model('admin/user_model');
		$res = $this->user_model->get_available_parent();
		print_r($res);
		echo $this->db->last_query();
	}
}
