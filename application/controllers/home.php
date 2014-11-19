<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if (!get_user()) {
			redirect(base_url());
		}
	}

	public function index(){
		$this->layout->view('dashboard/content', null);
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
