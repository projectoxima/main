<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Members extends CI_Model {
  public function __construct()
  {
      parent::__construct();
  }

  function create($data){
    $query = $this->db->insert('tbl_members', $data);

    return $query;
  }
}