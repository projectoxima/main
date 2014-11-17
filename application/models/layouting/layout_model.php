<?php

class layout_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }
	
	/* ambil route url berdasarkan nama controller dan action */
	public function get_route($controller, $action){
		$query = $this->db->get_where(
			"modules", array(
				'controller'=>$controller,
				'action'=>$action
			))->result();
		if(!empty($query))
			return $query[0]->routes;
		else
			return $query;
	}

	/* ambil route url berdasarkan nama module id */
	public function get_route_id($module_id){
		$query = $this->db->get_where(
			"modules", array(
				'id'=>$module_id
			))->result();
		if(!empty($query))
			return $query[0]->routes;
		else
			return $query;
	}

	/* ambil module id berdasarkan nama controller dan action */
	public function get_module_id($controller, $action){
		$query = $this->db->get_where(
			"modules", array(
				'controller'=>$controller,
				'action'=>$action
			))->result();
		if(!empty($query))
			return $query[0]->id;
		else
			return $query;
	}
	
	/* ambil main menu */
	public function get_mainmenu($position){
		$query = $this->db->get_where(
			"menus", array(
				'menu_id'=>'0',
				'position'=>$position
			))->result();
		return $query;
	}
	
	/* ambil sub menu */
	public function get_submenu($menu_id){
		$query = $this->db->get_where(
			"menus", array(
				'menu_id'=>$menu_id
			))->result();
		return $query;
	}
}
?>
