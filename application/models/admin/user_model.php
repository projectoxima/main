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
	
	function user_get_paging($keyword, $start, $length, $sortcol, $sorttype, $memberonly=true, $mode=null){
		$this->db->select('u.id, u.status, u.group_id, p.nama_lengkap, p.alamat, p.kota, p.propinsi,p.phone,p.ktp');
		$this->db->from('users u');
		$this->db->join('profiles p', 'p.user_id=u.id', 'left');
		if($memberonly)
			$this->db->where('u.group_id', USER_MEMBER);
		$this->db->where("(
			p.nama_lengkap LIKE '%$keyword%'
			OR p.alamat LIKE '%$keyword%'
			OR p.kota LIKE '%$keyword%'
			OR p.propinsi LIKE '%$keyword%'
		)", null, true);
		if($mode!=null){
			if($mode=='stokis')
				$this->db->where('u.stokis', ACTIVE);
		}
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
	
	function user_detail_by_pin_for_public($pin){
		$this->db->select('m.id, m.status, pp.nama_lengkap, pp.alamat, pp.phone, pp.ktp, pp.bank, pp.no_rekening, pp.nama_rekening');
		$this->db->from('users m');
		$this->db->join('pins p', 'p.id=m.pin_id');
		$this->db->join('profiles pp', 'pp.user_id=m.id');
		$this->db->where('p.pin', $pin);
		$result = $this->db->get()->row();
		if(!empty($result))
			$result->id = encode_id($result->id);
		return $result;
	}
	
	function user_detail_by_user_id_for_public($user_id){
		$this->db->select('m.id, pp.nama_lengkap, pp.alamat, pp.phone, pp.ktp, pp.bank, pp.no_rekening, pp.nama_rekening');
		$this->db->from('users m');
		$this->db->join('pins p', 'p.id=m.pin_id');
		$this->db->join('profiles pp', 'pp.user_id=m.id');
		$this->db->where('m.id', $user_id);
		$result = $this->db->get()->row();
		if(!empty($result))
			$result->id = encode_id($result->id);
		return $result;
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
	
	function save_titik($data){
		$this->db->set('create_time', 'NOW()', FALSE);
		$this->db->insert('titiks', $data);
		return $this->db->insert_id();
	}
	
	function save_parent_child($data){
		$this->db->set('create_time', 'NOW()', FALSE);
		$this->db->insert('parent_childs', $data);
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
	
	function save_user_sponsor($data){
		$this->db->set('create_time', 'NOW()', FALSE);
		$this->db->insert('user_sponsor', $data);
		return $this->db->insert_id();
	}
	
	function get_user_top_titik($user_id){
		$this->db->from('titiks t');
		$this->db->where('t.user_id', $user_id);
		$this->db->order_by('t.id ASC');
		return $this->db->get()->row();
	}
	
	function get_user_sponsor($titik_id, $limit){
		$this->db->select('u.*, t.user_id AS user_sponsor_id');
		$this->db->from('user_sponsor u');
		$this->db->join('titiks t', 't.id=u.sponsor_id');
		$this->db->where('u.titik_id', $titik_id);
		$this->db->order_by('u.up_level ASC');
		$this->db->limit($limit);
		return $this->db->get()->result();
	}
	
	function get_pin($pin_id){
		return $this->db->get_where('pins', array('id'=>$pin_id))->row();
	}
	
	//~ ===== networking method
	
	function is_user_child($parent_id, $child_id){
		$this->db->from('parent_childs pc');
		$this->db->join('titiks parent', 'parent.id=pc.parent_child_id');
		$this->db->join('titiks child', 'child.id=pc.titik_id');
		$this->db->where('parent.user_id', $parent_id);
		$this->db->where('child.user_id', $child_id);
		$result = $this->db->get()->row();
		if(empty($result))
			return false;
		else
			return $result;
	}
	
	function is_bottom_child($parent_id, $child_id){
		$this->db->from('user_sponsor u');
		$this->db->where('u.user_id', $child_id);
		$this->db->where('u.sponsor_id', $parent_id);
		$res = $this->db->count_all_results();
		if($res > 0)
			return true;
		else
			return false;
	}
	
	function get_max_up_level($titik_id){
		$this->db->select('COUNT(up_level) AS level');
		$this->db->from('user_sponsor');
		$this->db->where('titik_id', $titik_id);
		return $this->db->get()->row();
	}
	
	function get_available_parent(){
		$this->db->select('m.id, m.titik_id, t.user_id, 
			(SELECT COUNT(*) FROM parent_childs pc WHERE pc.parent_child_id=m.titik_id) AS `order`, p.*');
		$this->db->from('parent_childs m');
		$this->db->join('titiks t', 't.id=m.titik_id');
		$this->db->join('profiles p', 'p.user_id=t.user_id');
		$this->db->where("(
			SELECT COUNT(*) FROM parent_childs c
			WHERE c.parent_child_id=m.titik_id
		)<3", null, false);
		$this->db->group_by('m.parent_child_id');
		$this->db->order_by('t.id ASC, t.order DESC');
		return $this->db->get()->result();
	}
	
	function get_bottom_parent($stokis_id){
		$available_parent = $this->get_available_parent();
		
		if(count($available_parent) > 0){
			foreach($available_parent as $item){
				if($this->is_bottom_child($stokis_id, $item->user_id))
					return $item;
			}
			return $available_parent[0];
		}
		return array();
	}
	
	function generate_up_level($user_id, $titik_id){
		$info = $this->db->get_where('user_sponsor', array('user_id'=>$user_id, 'titik_id'=>$titik_id))->row();
		$up_level = $info->up_level;
		while(!empty($info->sponsor_id)){
			$info = $this->db->get_where('user_sponsor', array('titik_id'=>$info->sponsor_id))->row();
			if(!empty($info->sponsor_id)){
				$up_level++;
				$this->db->set('create_time', 'NOW()', false);
				$this->db->insert('user_sponsor', array(
					'user_id'=>$user_id,
					'titik_id'=>$titik_id,
					'sponsor_id'=>$info->sponsor_id,
					'up_level'=>$up_level
				));
			}
		}
	}
	
	function save_sell_only($data){
		$this->db->set('create_time', 'NOW()', false);
		$this->db->insert('sell_only', $data);
	}
	
	function save_bonus($data){
		$this->db->set('create_time', 'NOW()', false);
		$this->db->insert('user_bonus', $data);
		return $this->db->insert_id();
	}
	
	//~ ===== end networking method
	
	
	
	//~ ======== activation method
	function update_profile($data, $user_id){
		$this->db->where('user_id', $user_id);
		$this->db->update('profiles', $data);
	}
	
	function update_account($username, $password, $user_id){
		$this->db->where('id', $user_id);
		$this->db->set('update_time', 'NOW()', false);
		$this->db->update('users', array(
			'username'=>$username,
			'password'=>md5($password),
			'status'=>ACTIVE
		));
	}
	
	function check_username($username){
		$ada = $this->db->get_where('users', array('username'=>$username))->num_rows();
		if($ada>0)
			return false;
		else
			return true;
	}
	
	
	//~ ======== activation method
	
}
