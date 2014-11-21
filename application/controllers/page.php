<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends OxyController {
	
	public function newpage(){
		$data = array(
			'kode_content' => '',
			'judul_content' => '',
			'header_post' => '',
			'deskripsi' => '',
			'status' => 'baru',
			'status_content' => '',
			'label_post' => array(),
			'tags' => '',
			'isi' => '',
			'title' => 'Dasboard admin calonpresident.blogspot.com - isi content'
		);
		$this->layout->view('page/new');
	}

}
