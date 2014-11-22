<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class contents_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}
	
	function get_content($key){
		$content = $this->db->get_where('contents', array('key'=>$key))->result();
		if(!empty($content))
			return $content[0]->text;
		else
			return null;
	}
	
	function save_content($data){
		$content = $this->db->insert('contents', $data);
		return $content;
	}
	
	function update_content($key, $data){
		$this->db->where('key', $key);
		$content = $this->db->update('contents', $data);
		return $content;
	}

}
