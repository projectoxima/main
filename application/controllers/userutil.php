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
	
	//~ untuk proses development, clear data
	public function free(){
		$this->db->update('pins', array('status'=>STATUS_INACTIVE));
		$this->db->update('idbarangs', array('status'=>STATUS_INACTIVE));
		
		$this->db->where('id IN (SELECT idbarang_id FROM reserved_stokis_idbarangs)', null, false);
		$this->db->update('idbarangs', array('status'=>STATUS_RESERVED));
		$this->db->where('id IN (SELECT pin_id FROM reserved_stokis_pins)', null, false);
		$this->db->update('pins', array('status'=>STATUS_RESERVED));
		
		$this->db->update('reserved_stokis_idbarangs', array('status'=>INACTIVE));
		$this->db->update('reserved_stokis_pins', array('status'=>INACTIVE));
		$this->db->from('user_bonus'); 
		$this->db->truncate();
		$this->db->from('user_sponsor'); 
		$this->db->truncate(); 
		$this->db->from('parent_childs'); 
		$this->db->truncate();
		$this->db->empty_table('titiks'); 
		$this->db->select('MAX(id) AS ids', null, false);
		$prof = $this->db->get('profiles')->row();
		$this->db->where('id', $prof->ids);
		$this->db->delete('profiles');
		$this->db->select('MAX(id) AS ids', null, false);
		$usr = $this->db->get('users')->row();
		$this->db->where('id', $usr->ids);
		$this->db->delete('users');
		redirect('welcome');
	}
	
	public function clear_reserved(){
		$this->db->where('id IN (SELECT idbarang_id FROM reserved_stokis_idbarangs)', null, false);
		$this->db->update('idbarangs', array('status'=>STATUS_INACTIVE));
		$this->db->where('id IN (SELECT pin_id FROM reserved_stokis_pins)', null, false);
		$this->db->update('pins', array('status'=>STATUS_INACTIVE));
		$this->db->from('reserved_stokis_idbarangs'); 
		$this->db->truncate();
		$this->db->from('reserved_stokis_pins'); 
		$this->db->truncate();
	}
	
	//~ for testing
	public function test(){
		$this->load->model('admin/user_model');
		$res = $this->user_model->get_available_parent();
		print_r($res);
		echo $this->db->last_query();
	}
}
