<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* untuk admin, operator, dan stokis */

class Graph extends OxyController {
	public $group = [USER_ADMIN, USER_OPERATOR, USER_MEMBER];
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		$this->layout->view('dashboard/graph', array());
	}
	
	private function get_child($parent_id){
		$parent_id = decode_id($parent_id, false);
		$this->db->select('t.id AS titik_id, p.*, m.id');
		$this->db->join('titiks t', 't.id=m.titik_id');
		$this->db->join('profiles p', 'p.user_id=t.user_id');
		$childs = $this->db->get_where('parent_childs m', array('m.parent_child_id'=>$parent_id))->result();
		foreach($childs as &$item){
			$item->id = encode_id($item->id, false);
			$item->titik_id = encode_id($item->titik_id, false);
			$item->user_id = encode_id($item->user_id, false);
			$item->{'childs'} = $this->get_child($item->titik_id);
		}
		return $childs;
	}
	
	public function generate_graph(){
		$this->load->model('admin/user_model');
		
		if($this->input->post())
			extract($this->input->post());
		
		if(get_user()->group_id==USER_MEMBER){
			if(!empty($titik_id)){
				//~ todo : periksa apakah tidak request yang parent
				$titik_id = decode_id($titik_id, false);
				if(test_id($titik_id))
					$this->db->where('m.titik_id', $titik_id);
			}else{
				$titik = $this->user_model->get_user_top_titik(get_user()->id);
				$titik_id = $titik->id;
				$this->db->where('m.titik_id', $titik_id);
			}
		}else{
			if(!empty($titik_id)){
				$titik_id = decode_id($titik_id, false);
				if(test_id($titik_id))
					$this->db->where('m.titik_id', $titik_id);
			}else
				$this->db->where('m.parent_child_id IS NULL', null, false);
		}
		
		$this->db->select('t.id AS titik_id, p.*, m.id');
		$this->db->join('titiks t', 't.id=m.titik_id');
		$this->db->join('profiles p', 'p.user_id=t.user_id');
		$root = $this->db->get('parent_childs m')->row();
		$root->id = encode_id($root->id, false);
		$root->titik_id = encode_id($root->titik_id, false);
		$root->user_id = encode_id($root->user_id, false);
		$root->{'childs'} = $this->get_child($root->titik_id);
		echo json_encode($root);
		die;
	}
}
