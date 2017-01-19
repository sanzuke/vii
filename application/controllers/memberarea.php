<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Memberarea extends CI_Controller {

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

		$data['judulHalaman'] = 'Selamat Datang, '.$this->session->userdata("userlogin");
		$data['contents'] = $this->load->view('../../themes/'.$theme.'/home_member',$data, true);


		//if(! empty($this->session->userdata('userlogin')) ){
			//$this->load->view('themes/default/memberarea', $data);
			$this->load->view('../../themes/'.$theme.'/memberarea', $data);
		//} 
		//$this->load->view('themes/default/memberarea', $data);
	}

	public function auth(){
		$u = $this->input->post("username", TRUE);
		$p = $this->input->post("password", TRUE);

		$cek = $this->db->query("SELECT usercode FROM ss_user WHERE username = '$u' AND password = PASSWORD('$p') ");
		$jml = $cek->num_rows();
		if($jml < 1){
			//echo 'false';
			$this->session->set_flashdata("msg", "Username/Password tidak ditemukan.");
			redirect("memberarea");
		} else {
			//echo 'true';
			$row = $cek->row();
			$this->session->set_userdata('userlogin', $u);
			$this->session->set_userdata('usercode', $row->usercode);
			redirect("memberarea");
		}
	}

	public function logout(){
		$this->session->unset_userdata("userlogin");
		redirect("memberarea");
	}

	public function profile(){
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

		$data['listcart'] = $this->cart->contents();

		$usercode = $this->session->userdata("usercode");
		$data['qry'] = $this->db->query("SELECT us.*, pr.nama_propinsi, kt.nama_kota, kc.nama_kecamatan FROM ss_user us 
			LEFT JOIN ss_propinsi pr ON pr.kode_propinsi = us.kode_propinsi
			LEFT JOIN ss_kota kt ON kt.kode_kota = us.kode_kota
			LEFT JOIN ss_kecamatan kc ON kc.kode_kecamatan = us.kode_kec
			WHERE us.usercode = '$usercode'");
		$data['judulHalaman'] = '<b>Profile</b>';
		$data['contents'] = $this->load->view('../../themes/'.$theme.'/profile_member',$data, true);

		$data['urlwebsite'] = base_url() . $themeurl . $theme . "/"; //'application/views/themes/default/';

		$this->load->view('../../themes/'.$theme.'/memberarea', $data);
	}

	public function saveprofile(){
		$usercode = $this->session->userdata("usercode");
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
		//$act_code = md5($username.$password.date("Y-m-d"));

		$data = array(
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
			'updatedby' => 'SYSTEM',
			'updateddate' => date('Y-m-d')
		);

		$where = array('usercode' => $usercode);

		$ins = $this->db->update("ss_user", $data, $where);
		if($ins){
			$this->session->set_flashdata("msg", "Data telah diubah. ");
		} else {
			$this->session->set_flashdata("msg", "Data gagal diubah.");
		}
		redirect("memberarea/profile");
	}

	public function changepassword(){
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

		$data['listcart'] = $this->cart->contents();

		$data['judulHalaman'] = 'Ubah Password';
		$data['contents'] = $this->load->view('../../themes/'.$theme.'/ubah_member',$data, true);

		$data['urlwebsite'] = base_url() . $themeurl . $theme . "/"; //'application/views/themes/default/';

		$this->load->view('../../themes/'.$theme.'/memberarea', $data);
	}

	public function order(){
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

		$data['listcart'] = $this->cart->contents();

		$data['judulHalaman'] = 'Pesanan';
		$data['contents'] = $this->load->view('../../themes/'.$theme.'/order_member',$data, true);

		$data['urlwebsite'] = base_url() . $themeurl . $theme . "/"; //'application/views/themes/default/';

		$this->load->view('../../themes/'.$theme.'/memberarea', $data);
	}

	public function history(){
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

		$data['listcart'] = $this->cart->contents();

		$data['judulHalaman'] = 'History Pesanan';
		$data['contents'] = $this->load->view('../../themes/'.$theme.'/history_member',$data, true);

		$data['urlwebsite'] = base_url() . $themeurl . $theme . "/"; //'application/views/themes/default/';

		$this->load->view('../../themes/'.$theme.'/memberarea', $data);
	}
}