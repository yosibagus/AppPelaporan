<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct(){
		parent::__construct();
	}

	public function index(){
		$data = array(
			'login_title' => 'Login',
		);
		$this->load->view('login',$data);
	}

	public function register(){
		$data = array(
			'login_title' => 'Register',
		);
		$this->load->view('register',$data);
	}

	public function register_action(){

		$a = $this->input->post('nama');
		$b = $this->input->post('email');
		$c = $this->input->post('username');
		$d = $this->input->post('password');

		$data = array(
			'id_adm' => null, 
			'nm_adm' => $a, 
			'email_adm' => $b, 
			'username_adm' => $c, 
			'password_adm' => $d, 
		);

		$this->M_perpus->insert_data($data,'tb_admin');
        redirect(base_url().'welcome');


	}
	

	public function login(){

		$a = $this->input->post('username');
		$b = $this->input->post('password');

		$where = array('username_adm' => $a, 'password_adm' => $b);
		$q = $this->M_perpus->edit_data($where, 'tb_admin');
		$cek = $q->num_rows();

		if ($cek > 0) {
			$d = $this->M_perpus->edit_data($where, 'tb_admin')->row();
			$session = array('id' => $d->id_adm, 'nama' => $d->nm_adm, 'status' => 'login');
			$this->session->set_userdata($session);
			redirect(base_url().'Admin');
		}else {
			echo "
				<script> alert('Username atau Password anda salah'); history.go(-1);</script>
			";
		}
	}

	public function forgot_password(){
		$this->load->view('forgot_password');
	}

	public function forgot_password_action()
	{
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => 'yaninurhasanah12@gmail.com',
            'smtp_pass'   => 'yani120198',
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];

        $where = array('email_adm' => $this->input->post('email'));
		$q = $this->M_perpus->edit_data($where, 'tb_admin');
		$d = $this->M_perpus->edit_data($where, 'tb_admin')->row();
		$cek = $q->num_rows();

		if ($cek > 0) {
			$this->load->library('email', $config);
	        $this->email->from('yaninurhasanah12@gmail.com', 'Yani Nur Hasanah');
	        $this->email->to($this->input->post('email'));
	        $this->email->subject('Forgot Password');
	        $this->email->message("Password : ".$d->password_adm);
			if ($this->email->send()) {
	            echo "
					<script> alert('Password anda sudah dikirim ke email, silahkan cek email anda.'); history.go(-1);</script>
				";
	        } else {
	            echo 'Error! email tidak dapat dikirim.';
	        }
		}else {
			echo "
				<script> alert('Email anda tidak terdaftar di akun manapun.'); history.go(-1);</script>
			";
		}

	}
}
