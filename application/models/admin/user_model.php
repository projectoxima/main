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
		$this->db->select('u.id, u.status, u.group_id, p.nama_lengkap, p.alamat, p.kota, p.propinsi');
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
	
	function user_detail($user_id){
		$this->db->select('u.*, p.*');
		$this->db->from('users u');
		$this->db->join('profiles p', 'p.user_id=u.id', 'left');
		$this->db->where('u.id', $user_id);
		return $this->db->get()->row();
	}
	
	function set_status($user_id, $stat){
		$this->db->where('id', $user_id);
		$this->db->update('users', array('status'=>$stat ? 1:0));
		return true; 
	}
	
	function member_resume(){
		$total = $this->db->get_where('users', array('group_id'=>USER_MEMBER))->num_rows();
		$aktif = $this->db->get_where('users', array('group_id'=>USER_MEMBER, 'status'=>ACTIVE))->num_rows();
		return (object) array('total'=>$total, 'aktif'=>$aktif);
	}
	
	function save_user($data){
		$this->db->set('create_time', 'NOW()', FALSE);
		$this->db->insert('users', $data);
		return $this->db->insert_id();
	}
	
	function update_user($data, $user_id){
		$this->db->where('user_id', $user_id);
		$this->db->set('update_time', 'NOW()', FALSE);
		$this->db->update('users', $data);
		return true;
	}
	
	function save_profile($data){
		$this->db->insert('profiles', $data);
		return $this->db->insert_id();
	}
	
	function update_profile($data, $user_id){
		$this->db->where('user_id', $user_id);
		$this->db->update('profiles', $data);
		return true;
	}
}
