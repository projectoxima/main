<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Members extends CI_Model {
  public function __construct()
  {
      parent::__construct();
  }

  function create($data){
    $query = $this->db->insert('profiles', $data);

    return $query;
  }

  function find_pin($id){
    $this->db->where(array('id' => $id));
    $query = $this->db->get('pins');

    if($query->num_rows() > 0){
      $pin = $query->result_array();
      return $pin[0];
    } else {
      return 0;
    }
  }

  // Get unused pin
  function get_pin(){
  	$this->db->where(array('status' => 0));
  	$this->db->order_by('id', 'asc');
  	$this->db->limit(1);
  	$query = $this->db->get('pins');

    if($query->num_rows() > 0){
      $pin = $query->result_array();
      return $pin[0];
    } else {
      return 0;
    }
  }

  function update_pin($id){
		$data = array(
				'status' => 1
			);

		$this->db->where('id', $id);
		$this->db->update('pins', $data);
  }

  function get_sponsor($id){
  	$this->db->where(array('pin' => $id));
  	$query = $this->db->get('pins');

    if($query->num_rows() > 0){
      $sponsor = $query->result_array();

      // Get user with this id sponsor
      $this->db->where(array('pin_id' => $sponsor[0]['id']));
      $query = $this->db->get('users');

	    if($query->num_rows() > 0){
	      $user = $query->result_array();
	      return $user[0];
	    } else {
	      return 0;
	    }
    } else {
      return 0;
    }
  }

  function find_parents($id){
    $this->db->where(array('parent_child_id' => $id));
    $q = $this->db->get('parent_childs');

    if($q->num_rows() > 0){
      return $q->result_array();
    } else {
      return 0;
    }
  }
}
