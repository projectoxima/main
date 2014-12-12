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

//~ untuk encode id tabel agar tidak terlihat public
if (!function_exists('encode_id')){
	function encode_id($num){
		$ci =& get_instance();
		$user_id_dec = $num;
		$user_id_dec = $ci->encoder->encode($user_id_dec, ENCRYPT_KEY);
		$user_id_dec = urlencode($user_id_dec);
		return $user_id_dec;
	}
}

//~ untuk decode id tabel agar tidak terlihat public
if (!function_exists('decode_id')){
	function decode_id($dec){
		$ci =& get_instance();
		$user_id_dec = urldecode($dec);
		$user_id_dec = $ci->encoder->decode($user_id_dec, ENCRYPT_KEY);
		return $user_id_dec;
	}
}

//~ untuk menguji hasil decode_id
if (!function_exists('test_id')){
	function test_id($user_id){
		return (is_numeric($user_id) && $user_id>0);
	}
}
