<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* untuk admin, operator, dan stokis */

class Reservedpin extends OxyController {
	public $group = [USER_ADMIN, USER_OPERATOR, USER_MEMBER];

	public function __construct() {
		parent::__construct();
		$this->load->model('admin/reservedpin_model', 'rpin');
	}

	//~ ============= reserved stokis, hanya untuk admin dan operator
	public function index(){
		if(get_user()->group_id!=USER_MEMBER)
			$this->layout->view('reservedpin/reserved', array(
				'resume'=>$this->rpin->reserved_stokis_resume()
			));
		else
			$this->layout->view('error/401', array());
	}
	
	//~ khusus admin dan operator
	public function add(){
		if(in_array(get_user()->group_id, [USER_ADMIN, USER_OPERATOR])){
			if($this->input->post()){
				extract($this->input->post());
				
				$daftar_idbarang = explode(',', $idbarang);
				foreach($daftar_idbarang as $idb){
					$this->rpin->save(array(
						'idbarang_id'=>$idb,
						'stokis_id'=>$user_id,
						'create_by'=>get_user()->id
					));
					
					//~ update status idbarang
					$this->rpin->update_idbarang_status($idb, STATUS_RESERVED);
				}
			}
			redirect(route_url('reservedpin', 'index'));
		}else
			//~ unauthorize
			$this->layout->view('error/401', array());
	}
	
	//~ all user
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
		
		$data_kolom = array('id','nama_pemilik','idbarang', 'status', 'create_time');
		
		$list_users = array();
		
		if(get_user()->group_id==USER_MEMBER)
			$list_users = $this->rpin->reserved_get_paging($sSearch, 
					$iDisplayStart, $iDisplayLength, $data_kolom[$iSortCol_0], $sSortDir_0,
					get_user()->id);
		else
			$list_users = $this->rpin->reserved_get_paging($sSearch, 
					$iDisplayStart, $iDisplayLength, $data_kolom[$iSortCol_0], $sSortDir_0);
		
		if(count($list_users) < $iDisplayLength){
			$resultdata['iTotalRecords'] = count($list_users);
			$resultdata['iTotalDisplayRecords'] = count($list_users);
		}
		
		foreach($list_users as $num=>$item){
			if(in_array(get_user()->group_id, [USER_ADMIN, USER_OPERATOR]))
				array_push($resultdata['aaData'], array(
					(($pagepos*$iDisplayLength) + $num+1),
					$item->nama_pemilik,
					$item->idbarang,
					$item->status==0 ? print_warna('Belum aktif', 'red'):print_warna('Sudah aktif'),
					$item->create_time,
					'<button class="btn btn-danger btn-xs">hapus</button>'
				));
			else
				array_push($resultdata['aaData'], array(
					(($pagepos*$iDisplayLength) + $num+1),
					$item->nama_pemilik,
					$item->idbarang,
					$item->status==0 ? print_warna('Belum aktif', 'red'):print_warna('Sudah aktif'),
					$item->create_time
				));
		}
		
		echo json_encode($resultdata);
		die;
	}
	
	//~ khusus untuk admin dan operator
	public function delete_reserved($reserved_id){
		if(in_array(get_user()->group_id, [USER_ADMIN, USER_OPERATOR])){
			
		}
	}
	
	//~ ambil pin yang masih belum ada pemiliknya
	public function pin_list($keyword){
		if($this->input->is_ajax_request()){
			$daftar_pin = $this->rpin->search_pin($keyword);
			echo json_encode($daftar_pin);
		}
		die;
	}
	
	//~ ambil idbarang yang masih belum ada pemiliknya
	public function idbarang_list($keyword){
		if($this->input->is_ajax_request()){
			$selected = $this->input->post('selected');
			$daftar_idbarang = $this->rpin->search_idbarang($keyword, $selected);
			echo json_encode($daftar_idbarang);
		}
		die;
	}
	
	//~ ambil data user yang sudah menjadi stokis
	public function stokis_list($keyword){
		if($this->input->is_ajax_request()){
			$daftar_stokis = $this->rpin->search_stokis($keyword);
			echo json_encode($daftar_stokis);
		}
		die;
	}
	
	//~ ambil data user yang childnya  < 3
	public function parent_list($keyword){
		if($this->input->is_ajax_request()){
			$daftar_parent = $this->rpin->search_parent($keyword);
			echo json_encode($daftar_parent);
		}
		die;
	}
	
	//~ =============== start reserved to member
	//~ reserved member dilakukan ketika ada member yang membeli produk
	//~ baik member lama maupun member baru
	//~ dapat diakses admin, operator, dan stokis, 
	//~ hanya saja klw stokis terbatas hanya dapat melihat punya dirinya sendiri
	public function reserved_member(){
		$cekuser = true;
		if(get_user()->group_id==USER_MEMBER && get_user()->stokis==INACTIVE)
			//~ yang dapat mengakses hanya member stokis
			$cekuser = false;
		
		
		if($cekuser)
			$this->layout->view('reservedpin/reserved_to_member', array());
		else
			$this->layout->view('error/401', array('message'=>'Anda belum menjadi stokis'));
	}
	
	//~ =============== end reserved to member
}
