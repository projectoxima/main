<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pinidbarang_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}
	
	function pin_resume(){
		$total = $this->db->count_all('pins');
		/* pin yang sudah aktif (sudah diregistrasi oleh member) */
		$active = $this->db->get_where('pins', array('status'=>ACTIVE))->num_rows();
		/* pin sudah direserved, tapi member belum register */
		$reserved = $this->db->get_where('reserved_pins', array('status'=>INACTIVE))->num_rows();
		
		return (object)array(
			'total'=>$total-$reserved,
			'active'=>$active,
			'inactive'=>$total-$reserved-$active,
			'reserved'=>$reserved,
		);
	}
	
	function pin_get_paging($keyword, $start, $length, $sortcol, $sorttype){
		$this->db->select('pi.id, pi.pin, pi.status, pr.nama_lengkap, pi.create_time');
		$this->db->from('pins pi');
		$this->db->join('profiles pr', 'pr.user_id=pi.user_id', 'left');
		$this->db->or_like('pi.pin', $keyword, 'both');
		$this->db->or_like('pi.status', $keyword, 'both');
		$this->db->or_like('pr.nama_lengkap', $keyword, 'both');
		$this->db->limit($length, $start);
		$this->db->order_by($sortcol, $sorttype);
		return $this->db->get()->result();
	}
	
	function pin_exists($pintest){
		return $this->db->get_where('pins', array('pin'=>$pintest))->num_rows();
	}
	
	function pin_save($data){
		$this->db->set('create_time', 'NOW()', FALSE);
		$this->db->insert('pins', $data);
		return $this->db->insert_id();
	}
}
