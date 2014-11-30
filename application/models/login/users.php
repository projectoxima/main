<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Model {
  public function __construct()
  {
      parent::__construct();
  }

  public function find_all() {
      $query = $this->db->get('users');

      if($query->num_rows() > 0){
          return $query->result_array();
      } else {
          return 0;
      }
  }

  public function find_by_username_password($username, $password, $with_admin_and_operator) {
	$criteria = array(
		'username' => $username, 
		'password' => md5($password),
		'status' => ACTIVE
	);
	if(!$with_admin_and_operator){
		$criteria['group_id'] = USER_MEMBER;
	}
  	$this->db->where($criteria);
  	$query = $this->db->get('users');

  	if($query->num_rows() > 0){
      $user = $query->result_array();
      return $user[0];
  	} else {
  		return 0;
  	}
  }

  public function find_by_id_pin($pin, $id) {
    $this->db->where(array('pin_id' => $pin, 'idbarang_id' => $id));
    $query = $this->db->get('reserved_pins');

    if($query->num_rows() > 0){
      $pin = $query->result_array();
      return $pin[0];
    } else {
      return 0;
    }
  }

  function find_username($name) {
      $this->db->where(array('username' => $name));
      $query = $this->db->get('users');

      if($query->num_rows() > 0) {
          return $query->result_array();
      } else {
          return 0;
      }
  }

  function find_user($id){
    $this->db->where(array('id' => $id));
    $query = $this->db->get('users');

    if($query->num_rows() > 0){
      $users = $query->result_array();
      return $users[0];
    } else {
      return 0;
    }
  }

  function create($user){
    $query = $this->db->insert('users', $user);

    return $query;
  }

  function update($id, $data){
    $this->db->where('id', $id);
    $query = $this->db->update('users', $data);

    return $query;
  }

  function remove($id){
    $query = $this->db->delete('users', array('id' => $id));

    return $query; 
  }

  function find_email($email) {
    $this->db->where(array('email' => $email));
    $query = $this->db->get('users');

    if($query->num_rows() > 0){
      $user = $query->result_array();
      return $user[0];
    } else {
      return 0;
    }      
  }

  function insert_token($data) {
    $query = $this->db->insert('resets', $data);

    return $query;      
  }

  function find_where($column, $data) {
    $this->db->where(array($column => $data));
    $query = $this->db->get('users');

    if($query->num_rows() > 0) {
      $result = $query->result_array();
      return $result[0];      
    } else {
      return 0;
    }
  }
}
