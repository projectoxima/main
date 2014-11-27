<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends OxyController {

	public function __construct(){
		parent::__construct();
		$this->load->model('contents/news_model');
	}

	public function create_news(){
		$data = array(
			'news_title' => $this->input->post('news_title'),
			'news_description' => $this->input->post('news_description'),
			'create_date' => date('Y-m-d'),
		);

		$new = $this->news_model->save_news($data);
	}

	public function news_list(){
		$news_list = $this->news_model->get_all_news();
		$data = array(
			'news_list' => $news_list,
			);
		$this->layout->view('content/news', $data);
	}
	
	public function news_detail($id){
		$news_detail = $this->news_model->get_news_detail($id);
		$data = array(
			'news_detail' => $news_detail[0],
			);
		$this->layout->view('content/news_detail', $data);
	}
}