<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* untuk admin, operator, dan stokis */

class Reservedpin extends OxyController {
	public $group = [USER_ADMIN, USER_OPERATOR, USER_MEMBER];

	public function __construct() {
		parent::__construct();
		$this->load->model('admin/reservedpin_model', 'rpin');
	}

	public function index(){
		
		$this->layout->view('reservedpin/reserved', array(
		));
	}
	
	public function add(){
		//~ khusus admin dan operator
		if(in_array(get_user()->group_id, [USER_ADMIN, USER_OPERATOR])){
		
		}
		die('Not implemented yet');
	}
	
	public function reserved_list(){
		if(!$this->input->is_ajax_request())
			die;
		
		extract($this->input->post());
		
		$resultdata = array(
			"sEcho"=>intval($sEcho),
			"iTotalRecords"=>($iDisplayLength * ($pagepos+1)) + 1,
			"iTotalDisplayRecords"=>($iDisplayLength * ($pagepos+1)) + 1,
			"aaData"=>array()
		);
		
		$data_kolom = array('id','pin','nama_lengkap','alamat','kota', 'propinsi');
		
		$list_users = array();
		if(get_user()->group_id==USER_ADMIN)
			$list_users = $this->rpin->user_get_paging($sSearch, 
				$iDisplayStart, $iDisplayLength, $data_kolom[$iSortCol_0], $sSortDir_0);
		else{
			//todo : pik ente bikin uset_get_paging buat operator, nampilin member aza
		}
		
		if(count($list_users) < $iDisplayLength){
			$resultdata['iTotalRecords'] = count($list_users);
			$resultdata['iTotalDisplayRecords'] = count($list_users);
		}
		
		foreach($list_users as $num=>$item){
			$status = '';
			if($item->group_id==USER_ADMIN)
				$status = '<font color="#0000ff">Admin</font>';
			if($item->group_id==USER_OPERATOR)
				$status = '<font color="#0000aa">Operator</font>';
			if($item->group_id==USER_MEMBER)
				$status = '<font color="#000055">Member</font>';
			
			$buttons = '';
			//~ generate url ke page user detail, user_id diencode
			$user_id_dec = $item->id;
			$user_id_dec = $this->encoder->encode($user_id_dec, ENCRYPT_KEY);
			$user_id_dec = urlencode($user_id_dec);
			$url_detail = route_url('manageuser', 'user_detail', array($user_id_dec));
			$url_toggle = route_url('manageuser', 'toggle_status_user', array($user_id_dec));
			
			if($item->group_id==USER_ADMIN){
				$buttons = '<a class="btn btn-success btn-xs marbottom" href="' .$url_detail. '">detail</a>';
			}else{
				$buttons = '<a class="btn btn-success btn-xs marbottom" href="' .$url_detail. '">detail</a>'
					. '<br/><a class="btn btn-success btn-xs marbottom">edit</a>';
				if($item->status==ACTIVE)
					$buttons .= '<br/><a class="btn btn-success btn-xs marbottom button-status" href="' .$url_toggle. '">disable</a>';
				else
					$buttons .= '<br/><a class="btn btn-warning btn-xs marbottom button-status" href="' .$url_toggle. '">enable</a>';
			}
			
			array_push($resultdata['aaData'], array(
				(($pagepos*$iDisplayLength) + $num+1),
				$status,
				$item->status==ACTIVE ? '<font color="green">Aktif</font>':'<font color="red">Belum Aktif</font>',
				$item->nama_lengkap,
				$item->alamat,
				$item->kota,
				$item->propinsi,
				$buttons
			));
		}
		
		echo json_encode($resultdata);
		die;
	}
	
	
}
