<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company extends OxyController {

	public function index()
	{
		$this->load->view('404.html');	
	}

	public function profile(){
		$link = anchor('profile', 'selengkapnya', array());
		$data = array(
			'text'=>'Ini adalah text',
			// data dummy (sebelum masuk database)
			'product_title' => 'oxima',
			'product_description_1' => 'Antioksidan Maksimal',
			'product_description_2' => '“Antioksidan Penawar Segala Penyakit”',
			'product_context' => '<p>Produk ini dapat membantu menyembuhkan berbagai macam penyakit yang disebabkan oleh faktor pola makan, cara hidup dan lingkungan. Diantara penyakit tersebut adalah: Kanker, Diabetes, Stroke, Asam Urat, Jantung, Paru-paru, Hepatitis A-B-C, Tumor, Penuaan Dini dan lain-lain. '.$link.'</p>',
			'product_image_1' => site_url().'assets/img/maqui-berry2.png',
			'product_image_2' => site_url().'assets/img/oxima2.jpg',
		);
		$this->layout->view('company/profile', $data);
	}
	
	public function product(){
		$link = anchor('profile', 'selengkapnya', array());
		$data = array(
			'text'=>'Ini adalah text',
			// data dummy (sebelum masuk database)
			'product_title' => 'oxima',
			'product_description_1' => 'Antioksidan Maksimal',
			'product_description_2' => '“Antioksidan Penawar Segala Penyakit”',
			'product_context' => '<p>Produk ini dapat membantu menyembuhkan berbagai macam penyakit yang disebabkan oleh faktor pola makan, cara hidup dan lingkungan. Diantara penyakit tersebut adalah: Kanker, Diabetes, Stroke, Asam Urat, Jantung, Paru-paru, Hepatitis A-B-C, Tumor, Penuaan Dini dan lain-lain. '.$link.'</p>',
			'product_image_1' => site_url().'assets/img/maqui-berry2.png',
			'product_image_2' => site_url().'assets/img/oxima2.jpg',
		);
		$this->layout->view('company/product', $data);
	}
}