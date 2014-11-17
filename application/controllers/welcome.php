<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index(){
		$data = array(
			'text'=>'Ini adalah text'
		);
		$this->layout->view('welcome/index', $data);
	}
	
	public function test($num){
		$angka = $num*10;
		$data = array(
			'text'=>'hasilnya adalah ' . $angka
		);
		$this->layout->view('welcome/index', $data);
	}
	
	/* untuk simpan routing [JANGAN DIHAPUS] */
	function save_routing(){
		$this->load->model('layouting/layout_model');
		$list_module = $this->layout_model->get_all_modules();
		$data[] = "<?php";
		foreach($list_module as $k=>$y){
			if(!empty($y->params)){
				if(strstr($y->routes, '/') != false){
					$tmp = explode('/',$y->routes);
					$yroute = $tmp[0];
				}
				$data[] = "\$route['" . $yroute . "'] = '" . $y->controller . "/" . $y->action . "/';";
			}
			$data[] = "\$route['" . $y->routes . "'] = '" . $y->controller . "/" . $y->action . "/" . $y->params . "';";
		}
		$data[] = "?>";
		$output = implode("\n", $data);
		unlink(APPPATH . "cache/new_routes.php");
		touch(APPPATH . "cache/new_routes.php");
		file_put_contents(APPPATH . "cache/new_routes.php", $output);
		redirect(base_url());
	}
}
