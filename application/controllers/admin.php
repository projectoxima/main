<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends OxyController {
	public $group = [USER_ADMIN];

	public function __construct() {
		parent::__construct();
		$this->load->model('admin/pinidbarang_model', 'pib');
	}
	
	/* daftar pin, request ajax, support paging  */
	public function pin_list(){
		if(!$this->input->is_ajax_request())
			die;
		
		extract($this->input->post());
		
		$resultdata = array(
			"sEcho"=>intval($sEcho),
			"iTotalRecords"=>($iDisplayLength * ($pagepos+1)) + 1,
			"iTotalDisplayRecords"=>($iDisplayLength * ($pagepos+1)) + 1,
			"aaData"=>array()
		);
		
		$data_kolom = array('id','pin','status','nama_lengkap','create_time');
		
		$list_pin = $this->pib->pin_get_paging($sSearch, 
			$iDisplayStart, $iDisplayLength, $data_kolom[$iSortCol_0], $sSortDir_0);
		
		if(count($list_pin) < $iDisplayLength){
			$resultdata['iTotalRecords'] = count($list_pin);
			$resultdata['iTotalDisplayRecords'] = count($list_pin);
		}
		
		foreach($list_pin as $num=>$item){
			array_push($resultdata['aaData'], array(
				(($pagepos*$iDisplayLength) + $num+1),
				$item->pin,
				$item->status==ACTIVE ? '<font color="green">Aktif</font>':'<font color="blue">Belum Aktif</font>',
				empty($item->nama_lengkap) ? '-':$item->nama_lengkap,
				$item->create_time
			));
		}
		
		echo json_encode($resultdata);
		die;
	}
	
	/* logic pembuatan pin */
	public function generate_pin(){
		if($this->input->post()){
			$jumlah = $this->input->post('num');
			if(intval($jumlah) > 0){
				$generated = 0;
				while($generated<$jumlah){
					/* pin 12 digit, upercase */
					$thepin = strtoupper( substr(md5(time() * rand(1, 100)), 0, 12) );
					if($this->pib->pin_exists($thepin)==0){
						$this->pib->pin_save(array(
							'pin'=>$thepin,
							'create_by'=>intval(get_user()->id)
						));
						$generated++;
					}
				}
			}
		}
		redirect(route_url('admin', 'pin_and_idbarang'));
	}
	
	public function idbarang_list(){}

	public function pin_and_idbarang(){
		
		$this->layout->view('admin/manage_pin_idbarang', array(
			'pin_resume'=>$this->pib->pin_resume()
		));
	}
}
