<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	function get_all_user(){
		$this->db->from('users u');
		$this->db->join('profiles p', 'p.user_id=u.id', 'left');
		return $this->db->get()->result();
	}
	
	function user_get_paging($keyword, $start, $length, $sortcol, $sorttype){
		$this->db->select('u.id, u.status, p.nama_lengkap, p.alamat, p.kota, p.propinsi');
		$this->db->from('users u');
		$this->db->join('profiles p', 'p.user_id=u.id', 'left');
		$this->db->or_like('p.nama_lengkap', $keyword, 'both');
		$this->db->or_like('p.alamat', $keyword, 'both');
		$this->db->or_like('p.kota', $keyword, 'both');
		$this->db->or_like('p.propinsi', $keyword, 'both');
		$this->db->limit($length, $start);
		$this->db->order_by($sortcol, $sorttype);
		return $this->db->get()->result();
	}
}
