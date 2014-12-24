<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* untuk admin, operator, dan stokis */

class Reservedpin extends OxyController {
	public $group = [USER_ADMIN, USER_OPERATOR, USER_MEMBER];

	public function __construct() {
		parent::__construct();
		$this->load->model('admin/reservedpin_model', 'rpin');
		$this->load->model('login/users', 'users');
		$this->load->model('admin/user_model');
	}

	//~ ============= reserved stokis, hanya untuk admin dan operator
	public function index(){
		if(get_user()->group_id!=USER_MEMBER)
			$this->layout->view('reservedpin/reserved', array(
				'resume_idbarang'=>$this->rpin->reserved_stokis_idbarangs_resume(),
				'resume_pin'=>$this->rpin->reserved_stokis_pins_resume()
			));
		else
			$this->layout->view('error/401', array());
	}
	
	//~ khusus admin dan operator
	public function add(){
		if(in_array(get_user()->group_id, [USER_ADMIN, USER_OPERATOR])){
			if($this->input->post()){
				extract($this->input->post());
				
				if(empty($user_id)){
					$this->session->set_flashdata('message_error', $this->lang->line('message_must_choose_stokis'));
					redirect(route_url('reservedpin', 'index'));
					return;
				}
				
				//~ simpan data reserved id barang
				$daftar_idbarang = explode(',', $idbarang);
				foreach($daftar_idbarang as $idb){
					if(empty($idb))
						continue;
						
					$this->rpin->save_idbarang(array(
						'idbarang_id'=>$idb,
						'stokis_id'=>$user_id,
						'create_by'=>get_user()->id
					));
					
					//~ update status idbarang
					$this->rpin->update_idbarang_status($idb, STATUS_RESERVED);
				}
				
				//~ simpan data reserved pin
				$daftar_pin = explode(',', $pin);
				foreach($daftar_pin as $tp){
					if(empty($tp))
						continue;
						
					$this->rpin->save_pin(array(
						'pin_id'=>$tp,
						'stokis_id'=>$user_id,
						'create_by'=>get_user()->id
					));
					
					//~ update status idbarang
					$this->rpin->update_pin_status($tp, STATUS_RESERVED);
				}
			}
			redirect(route_url('reservedpin', 'index'));
		}else
			//~ unauthorize
			$this->layout->view('error/401', array());
	}
	
	//~ all user
	public function reserved_idbarang_list(){
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
	
	//~ all user
	public function reserved_pin_list(){
		if(!$this->input->is_ajax_request())
			die;
		
		extract($this->input->post());
		
		$resultdata = array(
			"sEcho"=>intval($sEcho),
			"iTotalRecords"=>($iDisplayLength * ($pagepos+1)) + 1,
			"iTotalDisplayRecords"=>($iDisplayLength * ($pagepos+1)) + 1,
			"aaData"=>array()
		);
		
		$data_kolom = array('id','nama_pemilik','pin', 'status', 'create_time');
		
		$list_users = array();
		
		if(get_user()->group_id==USER_MEMBER)
			$list_users = $this->rpin->reserved_pin_get_paging($sSearch, 
					$iDisplayStart, $iDisplayLength, $data_kolom[$iSortCol_0], $sSortDir_0,
					get_user()->id);
		else
			$list_users = $this->rpin->reserved_pin_get_paging($sSearch, 
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
					$item->pin,
					$item->status==0 ? print_warna('Belum aktif', 'red'):print_warna('Sudah aktif'),
					$item->create_time,
					'<button class="btn btn-danger btn-xs">hapus</button>'
				));
			else
				array_push($resultdata['aaData'], array(
					(($pagepos*$iDisplayLength) + $num+1),
					$item->nama_pemilik,
					$item->pin,
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
			$selected = $this->input->post('selected');
			$daftar_pin = $this->rpin->search_pin($keyword, $selected);
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
		
		if($cekuser){
			
			//~ ambil daftar barang
			if(in_array(get_user()->group_id, [USER_ADMIN, USER_OPERATOR]))
				$daftar_barang = $this->rpin->get_barang_from_idbarangs();
			else
				$daftar_barang = $this->rpin->get_barang_from_reserved(get_user()->id);
			//~ ambil daftar pin
			if(in_array(get_user()->group_id, [USER_ADMIN, USER_OPERATOR]))
				$daftar_pin = $this->rpin->get_pins_from_pins();
			else
				$daftar_pin = $this->rpin->get_pins_from_reserved(get_user()->id);
			
			
			$this->layout->view('reservedpin/reserved_to_member', array(
				'daftar_barang'=>$daftar_barang,
				'daftar_pin'=>$daftar_pin
			));
		}else
			$this->layout->view('error/401', array('message'=>'Anda belum menjadi stokis'));
	}
	
	//~ simpan bonus sponsor untuk sponsor
	private function set_bonus_sponsor($sponsor_id, $member_id, $member_titik_id){
		//~ nilai bonus harus didefine
		assert(NILAI_BONUS_CUT>0);
		assert(NILAI_BONUS_SPONSOR>0);
		
		if(NILAI_BONUS_CUT)
			$bonus_cut = (1/NILAI_BONUS_CUT) * NILAI_BONUS_SPONSOR;
		else
			$bonus_cut = 0;
			
		$sponsor_titik_id = $this->user_model->get_user_top_titik($sponsor_id);
		
		if(isset($sponsor_titik_id->id) && $sponsor_titik_id->id!=null){
			$data_bonus = array(
				'user_id'=>$sponsor_id,
				'titik_id'=>$sponsor_titik_id->id,
				'bonus_id'=>1,	//bonus sponsor
				'bonus'=>NILAI_BONUS_SPONSOR,
				'bonus_cut'=>$bonus_cut,
				'newmember_id'=>$member_id,
				'newmember_titik_id'=>$member_titik_id
			);
			
			$this->user_model->save_bonus($data_bonus);
		}
	}
	
	//~ simpan bonus titik untuk parent
	private function set_bonus_parent($member_id, $member_titik_id){
		assert(NILAI_BONUS_TITIK>0);
		assert(NILAI_BONUS_CUT>0);
		if(NILAI_BONUS_CUT)
			$bonus_cut = (1/NILAI_BONUS_CUT) * NILAI_BONUS_TITIK;
		else
			$bonus_cut = 0;
		
		$uspo = $this->user_model->get_user_sponsor($member_titik_id, 10);
		for($par=0; $par<10; $par++){
			if(isset($uspo[$par])){
				$data_bonus = array(
					'user_id'=>$uspo[$par]->user_sponsor_id,
					'titik_id'=>$uspo[$par]->sponsor_id,
					'bonus_id'=>2,	//bonus titik
					'bonus'=>NILAI_BONUS_TITIK,
					'bonus_cut'=>$bonus_cut,
					'newmember_id'=>$member_id,
					'newmember_titik_id'=>$member_titik_id
				);
				
				$this->user_model->save_bonus($data_bonus);
			}
		}
	}
	
	//~ blok proses utama pembuatan jaringan
	private function generate_network($idb, $sponsor_id, $user_id, $biaya, $pin){
		$parent = $this->user_model->get_bottom_parent($sponsor_id);
			
		if(empty($parent))
			$the_order = '0';
		else if($parent->order==0)
			$the_order = '0';
		else if($parent->order==1)
			$the_order = '1';
		else if($parent->order==2)
			$the_order = '2';
			
		//~ data titiks
		$data_titik = array(
			'idbarang_id'=> $idb,
			'user_id'=> $user_id,
			'order'=> $the_order,
			'biaya_daftar'=> $biaya,
			'create_by'=> get_user()->id
		);
		
		$titik_id = $this->user_model->save_titik($data_titik);
				
		//~ data parent childs
		$data_parent_child = array(
			'titik_id'=>$titik_id,
			'parent_child_id'=>empty($parent) ? NULL : $parent->titik_id,
			'create_by'=>get_user()->id
		);
		$this->user_model->save_parent_child($data_parent_child);
		
		//~ data user sponsor
		$level = $this->user_model->get_max_up_level($titik_id);
		
		$data_user_sponsor = array(
			'user_id'=>$user_id,
			'titik_id'=>$titik_id,
			'sponsor_id'=>empty($parent) ? NULL : $parent->titik_id,
			'up_level'=>$level->level+1
		);
		$this->user_model->save_user_sponsor($data_user_sponsor);
		
		//~ generate up level
		$this->user_model->generate_up_level($user_id, $titik_id);
		
		//~ update status pin dan idbarang menjadi aktif
		$this->rpin->update_pin_status($pin, STATUS_ACTIVE);
		$this->rpin->update_reserved_pin_status($pin, ACTIVE);
		$this->rpin->update_idbarang_status($idb, STATUS_ACTIVE);
		$this->rpin->update_reserved_idbarang_status($idb, ACTIVE);
		
		//~ set bonus parent/titik
		$this->set_bonus_parent($user_id, $titik_id);
		
		return $titik_id;
	}
	
	private function generate_sell_only($idb, $nama, $alamat, $kontak, $biaya, $member_id){
		$data_sell_only = array(
			'idbarang_id'=>$idb,
			'buy_date'=>date('Y-m-d'),
			'name'=>$nama,
			'alamat'=>$alamat,
			'kontak'=>$kontak,
			'harga'=>$biaya,
			'member_id'=>$member_id,
			'create_by'=>get_user()->id
		);
		$this->user_model->save_sell_only($data_sell_only);
		
		//~ update status barang
		$this->rpin->update_idbarang_status($idb, STATUS_ACTIVE);
		$this->rpin->update_reserved_idbarang_status($idb, ACTIVE);
	}
	
	//~ proses pembuatan jaringan ada disini
	public function reserved_member_save(){
		if($this->input->post()){
			//~ echo '<pre>';
			//~ print_r($_POST);
			//~ echo '</pre>';
			//~ die;
			
			//~ free
			//~ $this->freeData();
			//~ end free
			
			extract($this->input->post());
			
			try{
				//~ cek idbarang
				if(!is_array($idbarang) || count($idbarang)==0)
					throw new Exception('Pilih satu atau lebih idbarang');
				
				//~ check post
				if($biaya<30000)
					throw new Exception('Biaya daftar minimal lebih dari Rp. 30000');
				if(count($idbarang)==0)
					throw new Exception('Pilih salah satu atau lebih ID Barang');
				
				//~ cek pin sponsor
				$sponsor_id = 0;
				if(get_user()->group_id==USER_MEMBER)
					$sponsor_id = get_user()->id;
				else{
					if(empty($stokis_id))
						throw new Exception('Stokis harus dipilih');
					$stokis_id = decode_id($stokis_id);
					if(!test_id($stokis_id))
						throw new Exception('Stokis tidak valid');
					$sponsor_id = $stokis_id;
				}
				
				//~ cek pembeli barang
				$detail_pembeli = array();
				if(empty($pembeli_id)){
					//~ create data user, tapi harus cek gabung or beli
					//~ bikin jaringan jika gabung
					//~ just insert jika beli
					//~ cek pin
					
					if($mode=='gabung'){
						if(!is_array($pin) || count($pin)==0)
							throw new Exception('PIN harus dipilih salah satu');
						
						if(!isset($name1) || !isset($ktp) || !isset($bank) || !isset($norek) || !isset($namarek))
							throw new Exception('Lengkapi data pembeli');
						
						$pin = decode_id($pin[0], false);
						if(!test_id($pin))
							throw new Exception('PIN tidak valid');
						
						$thepin = $this->user_model->get_pin($pin);
						
						//~ save dulu data member
						//~ prepare data member
						$data_user = array(
							'username'=>$thepin->pin,
							'password'=>md5($thepin->pin),
							'group_id'=>USER_MEMBER,
							'pin_id'=>$pin,
							'status'=>INACTIVE,
							'stokis'=>INACTIVE,
							'point'=>0,
							'sponsor_id'=>$sponsor_id,
							'create_by'=>get_user()->id
						);
						$data_profile = array(
							'user_id'=>0,
							'sponsor_id'=>$sponsor_id,
							'tgl_pengajuan'=>date('Y-m-d'),
							'nama_lengkap'=>$name1,
							'ktp'=>$ktp,
							'bank'=>$bank,
							'no_rekening'=>$norek,
							'nama_rekening'=>$namarek
						);
						$user_id = $this->user_model->save_user($data_user);
						$data_profile['user_id'] = $user_id;
						$this->user_model->save_profile($data_profile);
						
						//todo : call generate_network
						$first_top_titik_id = null;
						foreach($idbarang as $lev=>$barang){
							$idb = decode_id($barang, false);
							if(!test_id($idb))
								throw new Exception('ID Barang tidak valid');
							$ttk = $this->generate_network($idb, $sponsor_id, $user_id, $biaya, $pin);
							if($lev==0)
								$first_top_titik_id = $ttk;
						}
						
						//~ set bonus sponsor
						$this->set_bonus_sponsor($sponsor_id, $user_id, $first_top_titik_id);
						
					}else if($mode=='beli'){
						
						//~ yang membeli adalah bukan member
						foreach($idbarang as $lev=>$barang){
							$idb = decode_id($barang, false);
							if(!test_id($idb))
								throw new Exception('ID Barang tidak valid');
							$this->generate_sell_only($idb, $name2, $alamat, $kontak, $biaya, NULL);
						}
					}else
						throw new Exception('Data tidak valid');
				}else{
					$pembeli_id = decode_id($pembeli_id);
					if(test_id($pembeli_id))
						$detail_pembeli = $this->users->get_user_detail($pembeli_id);
					else
						throw new Exception('ID Pembeli tidak valid');
					//~ bikin jaringan jika gabung
					//~ just insert jika beli
					//~ cek pin
					
					$user_id = $pembeli_id;
					
					if($mode=='gabung'){
						//~ jika user sudah daftar maka tidak butuh pin lagi
						
						//~ if(!is_array($pin) || count($pin)==0)
							//~ throw new Exception('PIN harus dipilih salah satu');
						//~ 
						//~ $pin = decode_id($pin[0], false);
						//~ if(!test_id($pin))
							//~ throw new Exception('PIN tidak valid');
						//~ 
						//~ $thepin = $this->user_model->get_pin($pin);
						
						//todo : call generate_network
						$first_top_titik_id = null;
						foreach($idbarang as $lev=>$barang){
							$idb = decode_id($barang, false);
							if(!test_id($idb))
								throw new Exception('ID Barang tidak valid');
							$ttk = $this->generate_network($idb, $sponsor_id, $user_id, $biaya, $pin);
							if($lev==0)
								$first_top_titik_id = $ttk;
						}
						
						//~ member lama beli lagi, tidak ada bonus sponsor (tambahan)
						//~ $this->set_bonus_sponsor($sponsor_id, $user_id, $first_top_titik_id);
						
					}else if($mode=='beli'){
						
						//~ yang membeli adalah bukan member
						foreach($idbarang as $lev=>$barang){
							$idb = decode_id($barang, false);
							if(!test_id($idb))
								throw new Exception('ID Barang tidak valid');
							$this->generate_sell_only($idb, $detail_pembeli->nama_lengkap, $$detail_pembeli->alamat, $$detail_pembeli->kontak, $biaya, $user_id);
						}
					}else
						throw new Exception('Data tidak valid');
				}
				redirect(route_url('reservedpin', 'reserved_member'));
			}catch(Exception $e){
				$this->layout->view('error/400', array('message'=>$e->getMessage()));
			}
		}else
			$this->layout->view('error/400', array());
	}
	
	//~ =============== end reserved to member
}
