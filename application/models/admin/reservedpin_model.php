<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class reservedpin_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}
	
	function reserved_get_paging($keyword, $start, $length, $sortcol, $sorttype){
		$this->db->select('rp.*');
		$this->db->from('reserved_pins rp');
		$this->db->limit($length, $start);
		$this->db->order_by($sortcol, $sorttype);
		return $this->db->get()->result();
	}
	
	function search_pin($keyword, $limit=10){
		$this->db->from('pins');
		$this->db->like('pin', $keyword, 'both');
		$this->db->where('status', INACTIVE);
		$this->db->limit($limit);
		return $this->db->get()->result();
	}
	
	function search_idbarang($keyword, $limit=10){
		$this->db->from('idbarangs');
		$this->db->like('idbarang', $keyword, 'both');
		$this->db->where('status', INACTIVE);
		$this->db->limit($limit);
		return $this->db->get()->result();
	}
	
	function search_stokis($keyword, $limit=10){
		$this->db->select('u.id, p.nama_lengkap');
		$this->db->from('users u');
		$this->db->join('profiles p', 'p.user_id=u.id', 'left');
		$this->db->where('u.status', ACTIVE);
		$this->db->where('u.stokis', ACTIVE);
		$this->db->where('u.group_id', USER_MEMBER);
		$this->db->where("(p.nama_lengkap LIKE '%$keyword%' OR p.alamat LIKE '%$keyword%' OR p.kota LIKE '%$keyword%' OR p.propinsi LIKE '%$keyword%' OR p.nama_rekening LIKE '%$keyword%')");
		$this->db->limit($limit);
		return $this->db->get()->result();
	}
	
	function search_parent($keyword, $limit=10){
		$this->db->select('u.id, p.nama_lengkap');
		$this->db->from('users u');
		$this->db->join('profiles p', 'p.user_id=u.id', 'left');
		$this->db->join('titiks t', 't.user_id=u.id', 'left');
		$this->db->where('u.status', ACTIVE);
		$this->db->where('u.group_id', USER_MEMBER);
		$this->db->where("(p.nama_lengkap LIKE '%$keyword%' OR p.alamat LIKE '%$keyword%' OR p.kota LIKE '%$keyword%' OR p.propinsi LIKE '%$keyword%' OR p.nama_rekening LIKE '%$keyword%')");
		$this->db->group_by('u.id');
		$this->db->having('COUNT(t.id) < 3', null, false);
		$this->db->limit($limit);
		return $this->db->get()->result();
	}
	
	function save($data){
		$this->db->set('create_time', 'NOW()', FALSE);
		$this->db->insert('reserved_pins', $data);
		return $this->db->insert_id();
	}
	
	function update_pin_status($pin_id, $status){
		$this->db->where('id', $pin_id);
		$this->db->update('pins', array('status'=>$status));
		return true; 
	}
	
	function update_idbarang_status($idbarang_id, $status){
		$this->db->where('id', $idbarang_id);
		$this->db->update('idbarangs', array('status'=>$status));
		return true; 
	}

}
