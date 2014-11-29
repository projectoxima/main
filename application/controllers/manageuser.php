<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* untuk admin dan operator */

class Manageuser extends OxyController {
	public $group = [USER_ADMIN, USER_OPERATOR];

	public function __construct() {
		parent::__construct();
		$this->load->model('admin/user_model', 'user');
	}

	public function index(){
		$list_user = $this->user->get_all_user();
		$this->layout->view('admin/manage_users', array(
			'list_user'=>$list_user
		));
	}
	
	/* daftar pin, request ajax, support paging  */
	public function user_list(){
		if(!$this->input->is_ajax_request())
			die;
		
		extract($this->input->post());
		
		$resultdata = array(
			"sEcho"=>intval($sEcho),
			"iTotalRecords"=>($iDisplayLength * ($pagepos+1)) + 1,
			"iTotalDisplayRecords"=>($iDisplayLength * ($pagepos+1)) + 1,
			"aaData"=>array()
		);
		
		$data_kolom = array('id','status','nama_lengkap','alamat','kota', 'propinsi');
		
		$list_pin = $this->user->user_get_paging($sSearch, 
			$iDisplayStart, $iDisplayLength, $data_kolom[$iSortCol_0], $sSortDir_0);
		
		if(count($list_pin) < $iDisplayLength){
			$resultdata['iTotalRecords'] = count($list_pin);
			$resultdata['iTotalDisplayRecords'] = count($list_pin);
		}
		
		foreach($list_pin as $num=>$item){
			$status = '';
			if($item->status==USER_ADMIN)
				$status = '<font color="#0000ff">Admin</font>';
			if($item->status==USER_OPERATOR)
				$status = '<font color="#0000aa">Operator</font>';
			if($item->status==USER_MEMBER)
				$status = '<font color="#000077">Member</font>';
			
			$buttons = '';
			if($item->status==USER_ADMIN){
				$buttons = '<button class="btn btn-success btn-xs marbottom">detail</button> &nbsp; '
					. '<button class="btn btn-danger btn-xs marbottom">disable</button> &nbsp; '
					. '<button class="btn btn-primary btn-xs marbottom">edit</button>';
			}
			
			array_push($resultdata['aaData'], array(
				(($pagepos*$iDisplayLength) + $num+1),
				$status,
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
