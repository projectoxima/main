<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* ambil user session jika sudah login, 
 * return false jika belum login */
if (!function_exists('get_user')){
	function get_user(){
		$ci =& get_instance();
		$userdata = $ci->session->all_userdata();
		if(isset($userdata[USER_STATUS]) && $userdata[USER_STATUS])
			return (object) $userdata;
		else
			return false;
	}
}
