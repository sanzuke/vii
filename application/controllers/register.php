<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __contruct(){
		if(!$this->session->userdata('userlogin')){
			$this->_redirect("login");
		} 
	}

	public function index()
	{
		//$data['treemenu'] = $this->treemenu->get_tree_menu();

		//$data['treemenu'] = $this->treemenu->get_tree_menu();

		$shop_info = $this->shop_info->get_shop_info();

		$data['sitename'] = $shop_info['shopname'];
		$data['slogan'] = $shop_info['slogan'];
		$data['email'] = $shop_info['email'];
		$data['phone'] = $shop_info['phone'];
		$data['web'] = $shop_info['web'];
		$data['logo'] = $shop_info['logo'];
		$data['icon'] = $shop_info['icon'];

		// page info
		$data['pagetitle'] = 'Halaman';
		// nav list page on footer
		$data['pagelist'] = $this->core->listNavPage();
		$data['listlastproducts'] = $this->core->listLastProduct();
		$data['listNavCategory'] = $this->core->listNavCategory();
		
		//widget
		$data['widgetpromo'] = $this->core->widgetPromo();


		$theme = $this->shop_info->get_option_theme();
		$themeurl = $this->shop_info->get_option_themeurl();

		$id = $this->uri->segment(3);
		if($id != ""){
			$str = '';
			$q = $this->db->query("SELECT * FROM cm_post WHERE post_title = '$id' ");
			while($r=$q->result_array()){
				$str = $r['post_content'];
			}
			$data['post_content'] = $str;
		} else {
			$data['post_content'] = 'Page not found';
		}
		//$this->cart->destroy();
		$data['listcart'] = $this->cart->contents();

		//$data['urlwebsite'] = base_url() . 'application/views/themes/default/';
		$data['urlwebsite'] = base_url() . $themeurl . $theme . "/"; //'application/views/themes/default/';

		//if(! empty($this->session->userdata('userlogin')) ){
			//$this->load->view('themes/default/memberarea', $data);
			$this->load->view('../../themes/'.$theme.'/register', $data);
		//} 
		//$this->load->view('themes/default/memberarea', $data);
	}

	public function save(){
		$usercode = $this->core->get_transaction_code("USER");
		$nama = $this->input->post("nama", TRUE);
		$tmp_lahir = $this->input->post("tmp_lahir", TRUE);
		$tgl_lahir = $this->input->post("tgl_lahir", TRUE);
		$jk = $this->input->post("jk", TRUE);
		$prop = $this->input->post("prop", TRUE);
		$kota = $this->input->post("kota", TRUE);
		$kec = $this->input->post("kec", TRUE);
		$alamat = $this->input->post("alamat", TRUE);
		$telp = $this->input->post("telp", TRUE);
		$email = $this->input->post("email", TRUE);
		$captcha = $this->input->post("captcha", TRUE);
		$username = $this->input->post("username", TRUE);
		$password = $this->input->post("password", TRUE);
		$act_code = md5($username.$password.date("Y-m-d"));

		// First, delete old captchas
		$expiration = time()-7200; // Two hour limit
		$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);	

		// Then see if a captcha exists:
		$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
		$binds = array($captcha, $this->input->ip_address(), $expiration);
		$query = $this->db->query($sql, $binds);
		$row = $query->row();

		if ($row->count == 0)
		{
		    $this->session->set_flashdata("msg", "You must submit the word that appears in the image");
		    redirect("register");
		} else {
			$data = array(
				'usercode' => $usercode,
				'name' => $nama,
				'tempat_lahir' => $tmp_lahir,
				'tgl_lahir' => date("Y-m-d", strtotime($tgl_lahir)),
				'address' => $alamat,
				'kode_propinsi' => $prop,
				'kode_kota' => $kota,
				'kode_kec' => $kec,
				'jenis_kelamin' => $jk,
				'phone' => $telp,
				'email' => $email,
				'status' => '3',
				'username' => $username,
				'password' => $password,
				'enable' => '0',
				'active_code' => $act_code,
				'createdby' => 'SYSTEM',
				'createddate' => date('Y-m-d')
			);

			$ins = $this->db->insert("ss_user", $data);
			if($ins){
				$this->session->set_flashdata("msg", "Data telah disimpan, cek email anda untuk aktifasi akun anda.");
				$this->core->updatekode("USER");
				//$this->load->library('email');
				$subject = 'Registerasi Member';
				$msg = '<p>Selamat anda telah berhasil mendaftar, untuk mengaktifkan akun member anda klik pada link dibawah ini atau copy dan paste pada alamat browser anda</p><p><a href="'.base_url().'actived/'.$act_code.'">'.base_url().'actived/'.$act_code.'</a></p><br><p>Terima kasih atas partisipasi anda.</p>';
				$this->core->sendmail($email, $subject, $msg);

				//echo $this->email->print_debugger();
			} else {
				$this->session->set_flashdata("msg", "Data gagal disimpan.");
			}
			redirect("register");
		}

	}


	public function getkota(){
		$prop = $this->input->get("prop", TRUE);
		$data = array();
		$k = $this->db->query("SELECT * FROM ss_kota WHERE kode_propinsi = '$prop' ");
		foreach ($k->result_array() as $key => $value) {
			$rec['kode_propinsi'] = $value['kode_propinsi'];
			$rec['kode_kota'] = $value['kode_kota'];
			$rec['nama_kota'] = $value['nama_kota'];
			$data[] = $rec;
		}
		echo json_encode($data);
	}
}