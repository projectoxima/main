<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Model {
  public function __construct()
  {
      parent::__construct();
  }

  public function find_all() {
      $query = $this->db->get('tbl_users');

      if($query->num_rows() > 0){
          return $query->result_array();
      } else {
          return 0;
      }
  }

  public function find_by_username_password($username, $password) {
  	$this->db->where(array('name' => $username, 'password' => md5($password)));
  	$query = $this->db->get('tbl_users');

  	if($query->num_rows() > 0){
      $user = $query->result_array();
      return $user[0];
  	} else {
  		return 0;
  	}
  }

  public function find_direktur($company_id) {
    $this->db->where(array('user_type' => 3, 'company_id' => $company_id));
    $query = $this->db->get('tbl_users');

    if($query->num_rows() > 0){
      $user = $query->result_array();
      return $user[0];
    } else {
      return 0;
    }
  }

  public function find_ga() {
    $this->db->where(array('user_type' => 2));
    $query = $this->db->get('tbl_users');

    if($query->num_rows() > 0){
      $user = $query->result_array();
      return $user[0];
    } else {
      return 0;
    }
  }

  public function find_keuangan($company_id) {
    $this->db->where(array('user_type' => 4, 'company_id' => $company_id));
    $query = $this->db->get('tbl_users');

    if($query->num_rows() > 0){
      $user = $query->result_array();
      return $user[0];
    } else {
      return 0;
    }
  }

  public function find_purchasing($company_id) {
    $this->db->where(array('user_type' => 5, 'company_id' => $company_id));
    $query = $this->db->get('tbl_users');

    if($query->num_rows() > 0){
      $user = $query->result_array();
      return $user[0];
    } else {
      return 0;
    }
  }

  function find_username($name) {
      $this->db->where(array('name' => $name));
      $query = $this->db->get('tbl_users');

      if($query->num_rows() > 0) {
          return $query->result_array();
      } else {
          return 0;
      }
  }

  function find($id){
    $this->db->where(array('id' => $id));
    $query = $this->db->get('tbl_users');

    if($query->num_rows() > 0){
      return $query->result_array();
    } else {
      return 0;
    }
  }

  function find_user($id){
    $this->db->where(array('user_type' => $id));
    $query = $this->db->get('tbl_users');

    if($query->num_rows() > 0){
      return $query->result_array();
    } else {
      return 0;
    }
  }

  function create($user){
    $query = $this->db->insert('tbl_users', $user);

    return $query;
  }

  function update($id, $data){
    $this->db->where('id', $id);
    $query = $this->db->update('tbl_users', $data);

    return $query;
  }

  function remove($id){
    $query = $this->db->delete('tbl_users', array('id' => $id));

    return $query; 
  }

  function find_email($email) {
    $this->db->where(array('email' => $email));
    $query = $this->db->get('tbl_users');

    if($query->num_rows() > 0){
      $user = $query->result_array();
      return $user[0];
    } else {
      return 0;
    }      
  }

  function insert_token($data) {
    $query = $this->db->insert('tbl_reset', $data);

    return $query;      
  }

  function find_where($column, $data) {
    $this->db->where(array($column => $data));
    $query = $this->db->get('tbl_users');

    if($query->num_rows() > 0) {
      $result = $query->result_array();
      return $result[0];      
    } else {
      return 0;
    }
  }

  public function getAllData($start, $limit, $sidx, $sord, $where) {
    $this->db->limit($limit);

    if($this->session->userdata('user_type') != 1 AND $this->session->userdata('user_type') != 2)
      $this->db->where('id', $this->session->userdata('id'));

    $this->db->order_by($sidx, $sord);
    $query = $this->db->get('tbl_users', $limit, $start);

    return $query->result();
  }

  public function getAllDataWithString($start, $limit, $sidx, $sord, $string) {
    $this->db->limit($limit);

    $this->db->like('name', $string);
    $this->db->or_like('email', $string);
    
    $this->db->order_by($sidx, $sord);
    $query = $this->db->get('tbl_users', $limit, $start);

    return $query->result();
  }
}