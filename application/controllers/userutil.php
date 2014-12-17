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
	}
	
	public function get_user_detail_by_pin(){
		if(!$this->input->is_ajax_request())
			return;
			
		$pin = $this->input->post('pin');
		
		$this->db->select('m.id, pp.nama_lengkap, pp.alamat, pp.phone, pp.ktp, pp.bank, pp.no_rekening, pp.nama_rekening');
		$this->db->from('users m');
		$this->db->join('pins p', 'p.id=m.pin_id');
		$this->db->join('profiles pp', 'pp.user_id=m.id');
		$this->db->where('p.pin', $pin);
		$result = $this->db->get()->row();
		if(!empty($result))
			$result->id = encode_id($result->id);
		echo json_encode($result);
		return;
	}

}
