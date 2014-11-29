<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class promo_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}
	
	function get_all_promo(){
		$promo_list = $this->db->get('promo')->result();
		return $promo_list;
	}
	
	function get_promo_detail($id){
		$promo = $this->db->get_where('promo', array('id'=>$id))->result();
		if(!empty($promo))
			return $promo;
		else
			return null;
	}
	
	function save_promo($data){
		$content = $this->db->insert('promo', $data);
		return $content;
	}
	
	function update_content($id, $data){
		$this->db->where('id', $id);
		$content = $this->db->update('promo', $data);
		return $content;
	}

}
