<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class reservedpin_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}
	
	function reserved_get_paging($keyword, $start, $length, $sortcol, $sorttype, $user_id=null){
		$this->db->select('rp.id, idb.idbarang, pem.nama_lengkap AS nama_pemilik, rp.status, rp.create_time');
		$this->db->from('reserved_stokis_idbarangs rp');
		$this->db->join('idbarangs idb', 'idb.id=rp.idbarang_id', 'left');
		$this->db->join('profiles pem', 'pem.user_id=rp.stokis_id', 'left');
		$this->db->where("( pem.nama_lengkap LIKE '%$keyword%' OR idb.idbarang LIKE '%$keyword%')", null, false);
		if(!empty($user_id))
			$this->db->where('rp.stokis_id', $user_id);
		$this->db->limit($length, $start);
		$this->db->order_by($sortcol, $sorttype);
		return $this->db->get()->result();
	}
	
	function reserved_pin_get_paging($keyword, $start, $length, $sortcol, $sorttype, $user_id=null){
		$this->db->select('rp.id, pn.pin, pem.nama_lengkap AS nama_pemilik, rp.status, rp.create_time');
		$this->db->from('reserved_stokis_pins rp');
		$this->db->join('pins pn', 'pn.id=rp.pin_id', 'left');
		$this->db->join('profiles pem', 'pem.user_id=rp.stokis_id', 'left');
		$this->db->where("( pem.nama_lengkap LIKE '%$keyword%' OR pn.pin LIKE '%$keyword%')", null, false);
		if(!empty($user_id))
			$this->db->where('rp.stokis_id', $user_id);
		$this->db->limit($length, $start);
		$this->db->order_by($sortcol, $sorttype);
		return $this->db->get()->result();
	}
	
	function search_pin($keyword, $selected, $limit=10){
		$filter_sel = '';
		if(is_array($selected) && count($selected)>0)
			$filter_sel = implode(',', $selected);
			
		$this->db->from('pins');
		$this->db->like('pin', $keyword, 'both');
		$this->db->where('status', STATUS_INACTIVE);
		if(!empty($filter_sel))
			$this->db->where("id NOT IN($filter_sel)", null, false);
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
	
	function save_idbarang($data){
		$this->db->set('create_time', 'NOW()', FALSE);
		$this->db->insert('reserved_stokis_idbarangs', $data);
		return $this->db->insert_id();
	}
	
	function save_pin($data){
		$this->db->set('create_time', 'NOW()', FALSE);
		$this->db->insert('reserved_stokis_pins', $data);
		return $this->db->insert_id();
	}
	
	function reserved_stokis_idbarangs_resume(){
		$total = $this->db->count_all('reserved_stokis_idbarangs');
		$aktif = $this->db->get_where('reserved_stokis_idbarangs', array('status'=>ACTIVE))->num_rows();
		return (object) array(
			'total' => $total,
			'aktif' => $aktif
		);
	}
	
	function reserved_stokis_pins_resume(){
		$total = $this->db->count_all('reserved_stokis_pins');
		$aktif = $this->db->get_where('reserved_stokis_pins', array('status'=>ACTIVE))->num_rows();
		return (object) array(
			'total' => $total,
			'aktif' => $aktif
		);
	}
	
	//~ reservedpin/reserved_member_save
	function update_pin_status($pin_id, $status){
		$this->db->where('id', $pin_id);
		$this->db->update('pins', array('status'=>$status));
		return true; 
	}
	
	//~ reservedpin/reserved_member_save
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
	
	public function get_reserved_detail_by_pin_id($pin_id){
		return $this->db->get_where('reserved_pins', array('pin_id', $pin_id))->row();
	}
	
	//~ reservedpin/reserved_member
	public function get_barang_from_idbarangs(){
		$this->db->from('idbarangs');
		$this->db->where('status', STATUS_INACTIVE);
		$this->db->limit(10);
		return $this->db->get()->result();
	}
	
	//~ reservedpin/reserved_member
	public function get_pins_from_pins(){
		$this->db->from('pins');
		$this->db->where('status', STATUS_INACTIVE);
		$this->db->limit(10);
		return $this->db->get()->result();
	}
	
	//~ reservedpin/reserved_member
	public function get_barang_from_reserved($user_id){
		$this->db->select('idb.*, m.stokis_id');
		$this->db->from('reserved_stokis_idbarangs m');
		$this->db->join('idbarangs idb', 'idb.id=m.idbarang_id');
		$this->db->where('m.status', INACTIVE);
		$this->db->where('m.stokis_id', $user_id);
		$this->db->limit(10);
		return $this->db->get()->result();
	}
	
	//~ reservedpin/reserved_member
	public function get_pins_from_reserved($user_id){
		$this->db->select('p.*, m.stokis_id');
		$this->db->from('reserved_stokis_pins m');
		$this->db->join('pins p', 'p.id=m.pin_id');
		$this->db->where('m.status', INACTIVE);
		$this->db->where('m.stokis_id', $user_id);
		$this->db->limit(10);
		return $this->db->get()->result();
	}
	
	//~ reserpedpin/reserved_member_save
	public function get_member_active_data($pin){
		$this->db->from('users m');
		$this->db->join('pins p', 'p.id=m.pin_id');
		$this->db->join('profiles pr', 'pr.user_id=m.id');
		$this->db->where('p.pin', $pin);
		return $this->db->get()->row();
	}
	
	//~ reservedpin/reserved_member_save
	public function get_member_by_id($user_id){
		$this->db->from('users m');
		$this->db->join('pins p', 'p.id=m.pin_id');
		$this->db->join('profiles pr', 'pr.user_id=m.id');
		$this->db->where('m.id', $user_id);
		return $this->db->get()->row();
	}
	
	//~ reservedpin/reserved_member_save
	public function get_random_pin(){
		$this->db->from('pins');
		$this->db->where('status', STATUS_INACTIVE);
		return $this->db->get()->row();
	}
	
	//~ reservedpin/reserved_member_save
	public function save_users($data){
		$this->db->set('create_time', 'NOW()', FALSE);
		$this->db->insert('users', $data);
		return $this->db->insert_id();
	}
	
	//~ reservedpin/reserved_member_save
	//~ mengambil data member yang berada pada jaringan sponsor tertentu
	function get_min_level_sponsor($sponsor_id, $user_id){
		$this->db->from('user_sponsor m');
		$this->db->where('m.sponsor_id', $user_id);
		//~ $this->db->where('m.sponsor_id', $sponsor_id);
		$this->db->where('m.up_level IN (SELECT MIN(s.up_level) 
			FROM user_sponsor s
			WHERE 
				s.sponsor_id=$user_id)', null, false);
		$parent = $this->db->get()->row();
		if(empty($parent)){
			$this->db->from('user_sponsor m');
			$this->db->where('m.user_id', $user_id);
			$this->db->where('m.sponsor_id', $sponsor_id);
			$this->db->where('m.up_level IN (SELECT MIN(s.up_level) 
				FROM user_sponsor s
				WHERE 
					s.sponsor_id=$user_id)', null, false);
			$parent = $this->db->get()->row();
			if(empty($parent))
				return false;
		}
		
	}
	
	//~ reservedpin/reserved_member_save
	function get_root_titik(){
		$this->db->from('parent_childs pc');
		$this->db->join('titik t', 't.id=pc.titik_id', 'left');
		$this->db->where('pc.parent_child_id is NULL', null, false);
		return $this->db->get()->row();
	}
	
	//~ reservedpin/reserved_member_save
	function save_titik($user_id, $idbarang_id, $titik_parent_id){
		$childs = $this->get_last_level_sponsor($titik_parent_id);
		
	}
	
	//~ reservedpin/reserved_member_save
	function save_root($user_id){
	}
	
	//~ reservedpin/reserved_member_save
	public function save_profiles($data){
		$this->db->set('create_time', 'NOW()', FALSE);
		$this->db->insert('profiles', $data);
		return $this->db->insert_id();
	}
}
