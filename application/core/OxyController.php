<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OxyController extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$user_group = USER_PUBLIC;
		
		if(is_object(get_user()))
			$user_group = get_user()->group_id;
		
		if(!isset($this->group))
			$this->group = [USER_PUBLIC];
		
		if($this->group!=USER_PUBLIC){
			if(is_array($this->group)){
				if(!in_array(USER_ALL, $this->group) && !in_array(USER_PUBLIC, $this->group)){
					if(!in_array($user_group, $this->group))
						redirect(base_url());
				}
			}
		}
	}
	
}
