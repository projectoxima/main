<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OxyController extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$user_group = USER_PUBLIC;
		
		if(is_object(get_user()))
			$user_group = get_user()->groups;
		
		if(!isset($this->group))
			$this->group = USER_PUBLIC;
			
		if($this->group==USER_ALL && $user_group==USER_PUBLIC)
			redirect(base_url());
		if($this->group==USER_ADMIN && $user_group!=USER_ADMIN)
			redirect(base_url());
		if($this->group==USER_OPERATOR && $user_group!=USER_OPERATOR)
			redirect(base_url());
		if($this->group==USER_MEMBER && $user_group!=USER_MEMBER)
			redirect(base_url());
	}
	
}
