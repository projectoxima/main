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
		$member_resume = $this->user->member_resume();
		$this->layout->view('admin/manage_users', array(
			'list_user'=>$list_user,
			'member_resume'=>$member_resume
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
			if($item->group_id==USER_ADMIN)
				$status = '<font color="#0000ff">Admin</font>';
			if($item->group_id==USER_OPERATOR)
				$status = '<font color="#0000aa">Operator</font>';
			if($item->group_id==USER_MEMBER)
				$status = '<font color="#000055">Member</font>';
			
			$buttons = '';
			if($item->group_id==USER_ADMIN){
				$buttons = '<button class="btn btn-success btn-xs marbottom">detail</button>';
			}else{
				$buttons = '<button class="btn btn-success btn-xs marbottom">detail</button>'
					. '<br/><button class="btn btn-success btn-xs marbottom">edit</button>';
				if($item->status==ACTIVE)
					$buttons .= '<br/><button class="btn btn-success btn-xs marbottom">disable</button>';
				else
					$buttons .= '<br/><button class="btn btn-warning btn-xs marbottom">enable</button>';
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
	
	public function add_user(){
		if($this->input->post()){
			$data_user = array(
				'username'=>$this->input->post('username'),
				'password'=>md5($this->input->post('password')),
				'group_id'=>$this->input->post('akses'),
				'status'=>INACTIVE,
				'create_by'=>get_user()->id
			);
			$user_id = $this->user->save_user($data_user);
			if($user_id){
				$data_profile = array(
					'user_id'=>$user_id,
					'sponsor_id'=>null,
					'tgl_pengajuan'=>date('Y-m-d'),
					'nama_lengkap'=>$this->input->post('nama-lengkap'),
					'alamat'=>$this->input->post('alamat'),
					'kota'=>$this->input->post('kota'),
					'propinsi'=>$this->input->post('propinsi'),
					'kodepos'=>$this->input->post('kode-post'),
					'tempat_lahir'=>$this->input->post('tempat-lahir'),
					'tgl_lahir'=>$this->input->post('tgl-lahir'),
					'agama'=>$this->input->post('agama'),
					'jenis_kelamin'=>$this->input->post('jenis-kelamin'),
					'phone'=>$this->input->post('phone'),
					'ktp'=>$this->input->post('no-ktp'),
					'email'=>$this->input->post('email'),
					'no_rekening'=>$this->input->post('no-rekening'),
					'bank'=>$this->input->post('bank'),
					'nama_rekening'=>$this->input->post('nama-rekening'),
					'nama_ahli_waris'=>$this->input->post('nama-ahli-waris'),
					'hubungan_keluarga'=>$this->input->post('hubungan-keluarga')
				);
				$this->user->save_profile($data_profile);
				$this->session->set_flashdata('message_success', $this->lang->line('message_insert_user_success'));
			}else
				$this->session->set_flashdata('message_error', $this->lang->line('message_insert_user_failed'));
		}
		redirect(route_url('manageuser', 'index'));
	}
}
