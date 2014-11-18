<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* helper ini untuk meload constant setting pada table settings */

if (!function_exists('load_settings')){
	function load_settings(){
		$ci =& get_instance();

		$ci->load->model('layouting/layout_model');

		$list_settings = $ci->layout_model->get_all_settings();

		foreach($list_settings as $svalue)
			define($svalue->setupkey, $svalue->setupvalue);
	}
}

