<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* untuk admin dan operator */

class Manageuser extends OxyController {
	public $group = [USER_ADMIN, USER_OPERATOR];

	public function __construct() {
		parent::__construct();
		$this->load->model('admin/user_model', 'user');
		//~ $this->load->library('Encoder');
	}

	/* halaman daftar user */
	public function index(){
		/* member resume, berisi jumlah member dan jumlah member aktif */
		$member_resume = $this->user->member_resume();
		$this->layout->view('admin/manage_users', array(
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
		
		$list_users = array();
		if(get_user()->group_id==USER_ADMIN)
			$list_users = $this->user->user_get_paging($sSearch, 
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
			$user_id_dec = encode_id($item->id);
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
	
	/* enable/disable user */
	public function toggle_status_user($user_id){
		$user_id_dec = urldecode($user_id);
		$user_id_dec = $this->encoder->decode($user_id_dec, ENCRYPT_KEY);
		$user_id = $user_id_dec;
		
		if($user_id > 0){
			$detail_user = $this->user->user_detail($user_id);
			if($detail_user->status==ACTIVE){
				$this->user->set_status($user_id, false);
			}else{
				$this->user->set_status($user_id, true);
			}
			redirect(route_url('manageuser', 'index'));
		}else
			//~ bad request
			$this->layout->view('error/400', array());
	}
	
	/* simpan data user, dipanggil oleh method add_user */
	private function _save_user(){
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
			
		redirect(route_url('manageuser', 'index'));
	}
	
	/* tambah data user (admin/operator/member) */
	public function add_user(){
		if($this->input->post()){
			
			//~ cek user, jika bukan admin, maka tidak bisa entry admin & operator
			if(get_user()->group_id!=USER_ADMIN){
				if(in_array(intval($this->input->post('akses')), array(USER_ADMIN, USER_OPERATOR))){
					//~ unauthorize
					$this->layout->view('error/401', array());
				}else
					$this->_save_user();
			}else
				$this->_save_user();
		}else
			//~ bad request
			$this->layout->view('error/400', array());
	}
	
	/* detail user */
	function user_detail($user_id){
		$user_id = decode_id($user_id);
		if(test_id($user_id)){
			$detail_user = $this->user->user_detail($user_id);
			$this->layout->view('admin/detail_user', array(
				'user'=>$detail_user
			));
		}else
			//~ bad request
			$this->layout->view('error/400', array());
	}
}
