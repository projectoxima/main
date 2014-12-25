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
	
	public function get_user_detail_by_user_id(){
		if(!$this->input->is_ajax_request())
			return;
			
		$user_id = $this->input->post('user_id');
		$user_id = decode_id($user_id);
		if(!test_id($user_id)){
			echo '{}';
			die;
		}
		
		$result = $this->user->user_detail_by_user_id_for_public($user_id);
		echo json_encode($result);
		return;
	}
	
	public function get_paging_member(){
		if(!$this->input->is_ajax_request())
			die;
		
		extract($this->input->post());
		
		$resultdata = array(
			"sEcho"=>intval($sEcho),
			"iTotalRecords"=>($iDisplayLength * ($pagepos+1)) + 1,
			"iTotalDisplayRecords"=>($iDisplayLength * ($pagepos+1)) + 1,
			"aaData"=>array()
		);
		
		if($iSortCol_0==0){
			$iSortCol_0 = 1;
			$sSortDir_0 = 'desc';
		}
		
		$data_kolom = array('','nama_lengkap','alamat','propinsi','ktp','phone', '');
		$sSearch = isset($sSearch) ? $sSearch:'';
		$data = $this->user->user_get_paging($sSearch, 
				$iDisplayStart, $iDisplayLength, $data_kolom[$iSortCol_0], $sSortDir_0,
				true, $mode);
		
		if(count($data)<$iDisplayLength){
			$resultdata['iTotalRecords'] = count($data);
			$resultdata['iTotalDisplayRecords'] = count($data);
		}
		
		foreach($data as $num=>$item){
			array_push($resultdata['aaData'], array(
				(($pagepos*$iDisplayLength) + $num+1),
				$item->nama_lengkap,
				$item->alamat,
				$item->propinsi,
				$item->ktp,
				$item->phone,
				'<button class="btn btn-warning btn-xs" onclick="window.chooseMember(this,\'' .encode_id($item->id). '\')">pilih</button>'
			));
		}
		
		echo json_encode($resultdata);
		die;
	}
	
	public function cek_ktp(){
		if($this->input->is_ajax_request()){
			$ktp = $this->input->post('ktp');
			$info = $this->db->get_where('profiles', array('ktp'=>$ktp))->row();
			if(empty($info))
				echo json_encode(array('result'=>true));
			else
				echo json_encode(array('result'=>false));
		}
		die;
	}
	
	public function cek_norek(){
		if($this->input->is_ajax_request()){
			$norek = $this->input->post('norek');
			$info = $this->db->get_where('profiles', array('no_rekening'=>$norek))->row();
			if(empty($info))
				echo json_encode(array('result'=>true));
			else
				echo json_encode(array('result'=>false));
		}
		die;
	}
	
	public function init(){
		$this->db->query('SET FOREIGN_KEY_CHECKS = 0');
		$this->db->from('member_action'); 
		$this->db->truncate();
		$this->db->from('points'); 
		$this->db->truncate();
		$this->db->from('repeat_order'); 
		$this->db->truncate();
		$this->db->from('reports'); 
		$this->db->truncate();
		$this->db->from('withdraw'); 
		$this->db->truncate();
		$this->db->from('sell_only'); 
		$this->db->truncate();
		$this->db->from('profiles'); 
		$this->db->truncate();
		$this->db->from('reserved_stokis_idbarangs'); 
		$this->db->truncate();
		$this->db->from('reserved_stokis_pins'); 
		$this->db->truncate();
		$this->db->from('parent_childs'); 
		$this->db->truncate();
		$this->db->from('user_bonus'); 
		$this->db->truncate();
		$this->db->from('user_sponsor'); 
		$this->db->truncate();
		$this->db->from('titiks'); 
		$this->db->truncate();
		$this->db->from('users'); 
		$this->db->truncate();
		$this->db->update('pins', array('status'=>STATUS_INACTIVE));
		$this->db->update('idbarangs', array('status'=>STATUS_INACTIVE));
		$this->db->insert('users', array(
			'username'=>'admin',
			'password'=>md5('admin'),
			'group_id'=>USER_ADMIN,
			'status'=>ACTIVE
		));
		$admin_id = $this->db->insert_id();
		$this->db->insert('profiles', array(
			'user_id'=>$admin_id,
			'nama_lengkap'=>'admin',
			'ktp'=>'0000000000',
			'no_rekening'=>'0000000000',
			'photo'=>'assets/img/user.jpg'
		));
		$this->db->insert('users', array(
			'username'=>'operator',
			'password'=>md5('operator'),
			'group_id'=>USER_OPERATOR,
			'status'=>ACTIVE
		));
		$operator_id = $this->db->insert_id();
		$this->db->insert('profiles', array(
			'user_id'=>$operator_id,
			'nama_lengkap'=>'operator',
			'ktp'=>'1111111111',
			'no_rekening'=>'1111111111',
			'photo'=>'assets/img/user.jpg'
		));
		$pin = $this->db->get('pins')->row();
		$this->db->insert('users', array(
			'username'=>'oxima',
			'password'=>md5('oxima'),
			'group_id'=>USER_MEMBER,
			'pin_id'=>$pin->id,
			'status'=>ACTIVE,
			'stokis'=>ACTIVE
		));
		$root_id = $this->db->insert_id();
		$this->db->insert('profiles', array(
			'user_id'=>$root_id,
			'nama_lengkap'=>'oxima',
			'alamat'=>'bandung',
			'ktp'=>'3333333333',
			'no_rekening'=>'333333333',
			'bank'=>'mandiri',
			'nama_rekening'=>'oxima',
			'photo'=>'assets/img/user.jpg'
		));
		$this->db->where('id', $pin->id);
		$this->db->update('pins', array('status'=>STATUS_ACTIVE));
		$idbarang = $this->db->get_where('idbarangs', array('idbarang'=>'00001'))->row();
		$this->db->insert('titiks', array(
			'idbarang_id'=>$idbarang->id,
			'user_id'=>$root_id,
			'biaya_daftar'=>300000
		));
		$titik_id = $this->db->insert_id();
		$this->db->insert('parent_childs', array(
			'titik_id'=>$titik_id
		));
		$this->db->where('id', $idbarang->id);
		$this->db->update('idbarangs', array('status'=>STATUS_ACTIVE));
		$this->db->query('SET FOREIGN_KEY_CHECKS = 1');
		redirect('welcome');
	}
	
	//~ for testing
	public function test(){
		$this->load->model('admin/user_model');
		$res = $this->user_model->get_available_parent();
		print_r($res);
		echo $this->db->last_query();
	}
}
