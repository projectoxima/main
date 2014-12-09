<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class reservedpin_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}
	
	function reserved_get_paging($keyword, $start, $length, $sortcol, $sorttype, $user_id=null){
		$this->db->select('rp.id, p.pin, idb.idbarang, pem.nama_lengkap AS nama_pemilik, par.nama_lengkap AS nama_parent, rp.status, rp.create_time');
		$this->db->from('reserved_pins rp');
		$this->db->join('pins p', 'p.id=rp.pin_id', 'left');
		$this->db->join('idbarangs idb', 'idb.id=rp.idbarang_id', 'left');
		$this->db->join('profiles pem', 'pem.user_id=rp.user_id', 'left');
		$this->db->join('profiles par', 'par.user_id=rp.parent_id', 'left');
		$this->db->where("( pem.nama_lengkap LIKE '%$keyword%' OR par.nama_lengkap LIKE '%$keyword%' OR p.pin LIKE '%$keyword%' OR idb.idbarang LIKE '%$keyword%')", null, false);
		if(!empty($user_id))
			$this->db->where('rp.user_id', $user_id);
		$this->db->limit($length, $start);
		$this->db->order_by($sortcol, $sorttype);
		return $this->db->get()->result();
	}
	
	function search_pin($keyword, $limit=10){
		$this->db->from('pins');
		$this->db->like('pin', $keyword, 'both');
		$this->db->where('status', STATUS_INACTIVE);
		$this->db->limit($limit);
		return $this->db->get()->result();
	}
	
	function search_idbarang($keyword, $selected, $limit=10){
		$filter_sel = '';
		if(is_array($selected) && count($selected)>0)
			$filter_sel = implode(',', $selected);
		
		$this->db->from('idbarangs');
		$this->db->like('idbarang', $keyword, 'both');
		$this->db->where('status', STATUS_INACTIVE);
		if(!empty($filter_sel))
			$this->db->where("id NOT IN($filter_sel)", null, false);
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
	
	
	public function check_pin_idbarang($pin, $idbarang=array()){
		$str_idbarang = '';
		if(is_array($idbarang) && count($idbarang)>0)
			$str_idbarang = implode(',', $idbarang);
		else
			$str_idbarang = INACTIVE;
		$this->db->select('rp.*, p.pin, i.idbarang');
		$this->db->from('reserved_pins rp');
		$this->db->join('pins p', 'rp.pin_id=p.id', 'left');
		$this->db->join('idbarangs i', 'rp.idbarang_id=i.id', 'left');
		$this->db->where('rp.status', INACTIVE);
		$this->db->where('p.pin', $pin);
		$this->db->where('i.idbarang IN (' .$str_idbarang. ')', null, false);
		$checked = $this->db->get()->result();
		if(count($checked) > 0){
			$this->db->select('rp.*, p.pin, i.idbarang');
			$this->db->from('reserved_pins rp');
			$this->db->join('pins p', 'rp.pin_id=p.id', 'left');
			$this->db->join('idbarangs i', 'rp.idbarang_id=i.id', 'left');
			$this->db->where('rp.status', INACTIVE);
			$this->db->where('p.pin', $pin);
			return $this->db->get()->result();
		}else
			return array();
	}
}
