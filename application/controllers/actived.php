<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __contruct(){

	}

	public function index(){
		$code = $this->uri->segment("2");

		$cekcode = $this->db->query("SELECT * FROM ss_user WHERE active_code = '$code'");
		if($cekcode->num_rows() > 0){
			$up = $this->db->query("UPDATE ss_user SET enable = '1' WHERE active_code = '$code'");
			if($up){
				$this->session->set_flashdata("msg","Akun anda telah aktif, silakan login untuk masuk ke halaman member area");
				redirect("memberarea");
			} else {
				$this->session->set_flashdata("msg","Kesalahan pada sistem, coba kembali untuk meng aktifasi akun anda");
				redirect("memberarea");
			}
		}
	}

}