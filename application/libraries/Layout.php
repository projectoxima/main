<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Layout{

	var $obj;
	var $layout;

	function __construct(){
		$this->obj =& get_instance();
		/* folder default */
		load_settings();
		$this->layout = LAYOUT;
	}

	function setLayout($layout){
	  $this->layout = $layout;
	}

	function view($view, $data=null, $return=false){
		$loadedData = array();
		$loadedData['content_for_layout'] = $this->obj->load->view($view, $data, true);
		
		/* pass alert */
		if(!$this->obj->input->post()){
			/* key alert otomatis akan dibaca sebagai pesan growl */
			$loadedData['alert_success'] = $this->obj->session->flashdata('message_success');
			$loadedData['alert_error'] = $this->obj->session->flashdata('message_error');
			$loadedData['alert_warning'] = $this->obj->session->flashdata('message_warning');
		}

		/* layout utama disimpan di file index.php */
		if($return){
			$output = $this->obj->load->view('layout/' . $this->layout . '/index', $loadedData, true);
			return $output;
		}else{
			$this->obj->load->view('layout/' . $this->layout . '/index', $loadedData, false);
		}
	}
}
?> 
