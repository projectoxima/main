<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends OxyController {

	public function __construct(){
		parent::__construct();
		$this->load->model('login/users');
		$this->load->model('login/reset_passwords');
	}

	public function index(){
		$this->load->view('404.html');	
	}

	public function login(){
		$this->load->view('dashboard/login');
	}

	public function do_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$pin 			= $this->input->post('pin');
		$id 			= $this->input->post('id');

		$user = $this->users->find_by_username_password($username, $password, false);

		// Jika username terdaftar
		if($user) {
			$user['logged_in'] = TRUE;
			$this->session->set_userdata($user);
			$this->session->set_flashdata('message_success', $this->lang->line('member_login_success'));
			redirect(base_url() . 'member');

		// Jika username tidak terdaftar
		} else {
			$pins = $this->users->find_by_id_pin($pin, $id);
			if($pins){
				$user = $this->users->find_user($pins['user_id']);

				if($user){
					$user['logged_in'] = TRUE;
					$this->session->set_userdata($user);
					$this->session->set_flashdata('message_success', $this->lang->line('member_login_success'));
					redirect(base_url() . 'member');
				} else {
					$user['logged_in'] = TRUE;
					$user['pin_id'] = $pins['pin_id'];
					$user['idbarang_id'] = $pins['idbarang_id'];
					$this->session->set_userdata($user);
					$this->session->set_flashdata('message_error', $this->lang->line('member_login_failed'));
					// redirect(base_url() . 'register');
				}

			// Jika pin dan id tidak cocok
			} else {
				$this->session->set_flashdata('message', 'Pin dan id tidak cocok');
				// $this->session->set_flashdata('message_error', $this->lang->line('member_login_failed'));
				redirect(base_url() . 'auth/login');
			}
		}
	}
	
	/* login method untuk admin dan operator */
	public function dashboard_login(){
		$captcha = '';
		
		/* delete image captcha sebelumnya */
		$capimage = getcwd() . '/files/images/' . $this->session->userdata('captcha.time') . '.jpg';
		if(file_exists($capimage))
			unlink($capimage);
		
		if ($this->input->post()){
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$captcha = $this->input->post('captcha');
			$user = $this->users->find_by_username_password($username, $password, true);
			if($user && $captcha===$this->session->userdata('captcha')) {
				$user['logged_in'] = TRUE;
				$this->session->set_userdata($user);
				$this->session->set_flashdata('message_success', $this->lang->line('message_login_success'));
				redirect(route_url('welcome', 'index'));
			}else{
				$this->session->set_flashdata('message_error', $this->lang->line('message_login_failed'));
				redirect(route_url('auth', 'dashboard_login'));
			}
		}else{
			/* generate captha */
			$this->load->helper('captcha');
			$word = substr(md5(time()), 0, 5);
			/* save captcha to session, untuk proses login */
			$this->session->set_userdata('captcha', $word);
			$vals = array(
				'word'	=> $word,
				'img_path'	=> './files/images/',
				'img_url'	=>  base_url() . '/files/images/',
				'img_width'	=> '150',
				'img_height' => 30,
				'expiration' => 36000
				);

			$cap = create_captcha($vals);
			/* simpan time (filename captcha), agar bisa didelete */
			$this->session->set_userdata('captcha.time', $cap['time']);
			$captcha = $cap['image'];
		}
		$this->layout->view('dashboard/dashboard_login', array(
			'captcha'=>$captcha
		));
	}

	public function logout() {
		$this->session->sess_destroy();	
		redirect(base_url());
	}

	public function forgot_password() {
		$pesan = $this->input->post('email');
		$find_email = $this->users->find_email($pesan);

		if($find_email == 0) {
			// $this->session->set_flashdata('message_error', $this->lang->line('email_not_recognized'));
			echo json_encode(array('status' => 'error'));
		} else {
				$email_config = Array(
		    'protocol'  => 'smtp',
		    'smtp_host' => 'ssl://smtp.googlemail.com',
		    'smtp_port' => '465',
		    'smtp_user' => 'taufik.oxima@gmail.com',
		    'smtp_pass' => 'taufikoximaproject',
		    'mailtype'  => 'html',
		    'starttls'  => true,
		    'newline'   => "\r\n"
	    );
	 
	    $this->load->library('email', $email_config);

	    $this->email->from('noreply@Oxima.co.id', 'Password Reset');
	    $this->email->to($pesan);
	 
	    $this->email->subject('Reset Password');

	    //Data for email content
	    $string = substr(md5(mt_rand()),0,31);
	    $url = base_url();
	    $username = $find_email['nama_lengkap'];
	    $email = $find_email['email'];
	    $mailContent = "
	    Hi $username, <br><br>

	    Kami menerima permintaan untuk melakukan reset password login untuk akun $username dengan alamat email $email. <br>

	    Klik link berikut ini untuk melakukan reset password <a href='" . $url . "auth/reset_password/$string'>Reset Password</a>. <br><br>
	    Mohon abaikan email ini bila anda tidak bermaksud melakukan reset password. <br><br>

	    Terima kasih atas perhatiannya.<br><br>

	    Admin.";

	    // Insert string into database
			$data = array(
					'token' => $string,
					'user_id' => $find_email['id']
				);

			$new = $this->reset_passwords->create($data);
	 		
	 		// Send email
	    $this->email->message($mailContent);
	    $this->email->send();
	    // $this->session->set_flashdata('message_error', $this->lang->line('link_reset_password_sent'));
			echo json_encode(array('status' => 'ok'));
		}
	}

	public function reset_password($token) {
		// Find match token
		$token_id = $this->reset_passwords->find($token);
		if($token_id == 0) {
			redirect(base_url() . 'auth/login');
		} else {
			$data['data_user']	= $token_id;
			$this->load->view('dashboard/reset_password', $data);
		}
	}

	public function change_password() {
		// Change user password
		$id = $this->input->post('id_user');
		$password = $this->input->post('password');

		$data = array(
				'password' => md5($password)
			);

		$update = $this->users->update($id, $data);

		// Delete last token
		$delete = $this->reset_passwords->remove($id);
		echo json_encode(array('status' => 'ok'));
	}
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */
