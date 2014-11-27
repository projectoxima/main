<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class news_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}
	
	function get_all_news(){
		$news_list = $this->db->get('news')->result();
		return $news_list;
	}
	
	function get_news_detail($id){
		$news = $this->db->get_where('news', array('id'=>$id))->result();
		if(!empty($news))
			return $news;
		else
			return null;
	}
	
	function save_news($data){
		$content = $this->db->insert('news', $data);
		return $content;
	}
	
	function update_content($id, $data){
		$this->db->where('id', $id);
		$content = $this->db->update('news', $data);
		return $content;
	}

}
