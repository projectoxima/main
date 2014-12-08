<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* ambil route url berdasarkan nama controller dan action */
if (!function_exists('route_url')){
	function route_url($controller, $action, $params=array()){
		$ci =& get_instance();
		$ci->load->model('layouting/layout_model');
		$route = $ci->layout_model->get_route($controller, $action);
		if(empty($route))
			return '';
		if(strstr($route, '/') != false){
			$tmp = explode('/',$route);
			$route = $tmp[0];
		}
		if(is_array($params))
			$parameter = implode("/", $params);
		else
			$parameter = "";
		return base_url($route . "/" . $parameter);
    }
}

/* ambil route url berdasarkan module id */
if (!function_exists('route_url_id')){
	function route_url_id($module_id, $params=array()){
		$ci =& get_instance();
		$ci->load->model('layouting/layout_model');
		$route = $ci->layout_model->get_route_id($module_id);
		if(empty($route))
			return '';
		if(strstr($route, '/') != false){
			$tmp = explode('/',$route);
			$route = $tmp[0];
		}
		if(is_array($params))
			$parameter = implode("/", $params);
		else
			$parameter = "";
		return base_url($route . "/" . $parameter);
    }
}

/* ambil main menu berdasarkan posisi menu */
if (!function_exists('get_mainmenu')){
	function get_mainmenu($position){
		$ci =& get_instance();
		$ci->load->model('layouting/layout_model');
		$group = get_user() ? get_user()->group_id:false;
		return $ci->layout_model->get_mainmenu($position, $group);
	}
}

/* ambil submenu berdasarkan menu id */
if (!function_exists('get_submenu')){
	function get_submenu($menu_id){
		$ci =& get_instance();
		$ci->load->model('layouting/layout_model');
		$group = get_user() ? get_user()->group_id:false;
		return $ci->layout_model->get_submenu($menu_id, $group);
	}
}

/* generate menu (format bootstrap) berdasarkan posisi */
if (!function_exists('generate_menu')){
	function generate_menu($position, $ctrl, $act){
		$mainmenu = get_mainmenu($position);
		foreach($mainmenu as &$mitem){
			$tmpmenu = get_submenu($mitem->id);
			$mitem->{'submenu'} = [];
			if(count($tmpmenu)>0)
				$mitem->{'submenu'} = $tmpmenu;
		}
		$html = '';
		foreach($mainmenu as $menuitem){
			$menuurl = route_url_id($menuitem->module_id);
			$active = ($ctrl==$menuitem->controller && $act==$menuitem->action) ? ' aktif ':'';
			
			if(count($menuitem->submenu)<=0)
				$html .= '<li class="' .$active. '">' . anchor($menuurl, $menuitem->label, array()) . '</li>';
			else{
				$submenu_text = '<ul class="dropdown-menu" role="menu">';
				foreach($menuitem->submenu as $submenuitem){
					$submenu_text .= '<li class="submenu">' . anchor(route_url_id($submenuitem->module_id), $submenuitem->label, array()) . '</li>';
					if(empty($active))
						$active = $ctrl==$submenuitem->controller ? ' aktif ':'';
				}
				
				$html .= '<li class="dropdown ' .$active. '">';
				$html .= anchor($menuurl, $menuitem->label . '<span class="caret"></span>', array(
					'class'=>'dropdown-toggle',
					'data-toggle'=>'dropdown',
					'role'=>'button',
					'aria-expanded'=>'false'
				)) ;
				$html .= $submenu_text;
				$html .= '</ul>';
				$html .= '</li>';
			}
		}
		return $html;
	}
}

/* ambil konten dari tabel contents */
if (!function_exists('web_content')){
	function web_content($key){
		$ci =& get_instance();
		$ci->load->model('layouting/contents_model');
		$content = $ci->contents_model->get_content($key);
		return $content;
	}
}

/* get link ke image */
if (!function_exists('url_image')){
	function url_image($image_filename){
		return base_url() . 'assets/img/' . $image_filename;
	}
}

/* get link ke photo */
if (!function_exists('url_photo')){
	function url_photo($image_filename){
		return base_url() . 'files/photo/' . $image_filename;
	}
}

/* generate text with color */
if (!function_exists('print_warna')){
	function print_warna($text, $color='blue'){
		return '<font color="' .$color. '">' .$text. '</font>';
	}
}
