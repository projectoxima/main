<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Networks extends OxyController{
	
	public function __construct() {
		parent::__construct();
		$this->load->model('admin/reservedpin_model', 'rpin');
		$this->load->model('login/users', 'users');
		$this->load->model('admin/user_model');
	}
	
	//~ simpan bonus sponsor untuk sponsor
	public function set_bonus_sponsor($sponsor_id, $member_id, $member_titik_id){
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
	public function set_bonus_parent($member_id, $member_titik_id){
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
	public function generate_network($idb, $sponsor_id, $user_id, $biaya, $pin){
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
	
	public function generate_sell_only($idb, $nama, $alamat, $kontak, $biaya, $member_id){
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
}
