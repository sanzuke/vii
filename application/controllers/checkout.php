<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkout extends CI_Controller {

	public function index()
	{
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
		$data['pagetitle'] = 'Checkout Pesanan';
		// nav list page on footer
		$data['pagelist'] = $this->core->listNavPage();
		$data['listlastproducts'] = $this->core->listLastProduct();
		$data['listNavCategory'] = $this->core->listNavCategory();

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


		//$data['urlwebsite'] = base_url() . 'application/views/themes/default/';
		$data['urlwebsite'] = base_url() . $themeurl . $theme . "/"; //'application/views/themes/default/';
		
		$theme = $this->shop_info->get_option_theme();
		$themeurl = $this->shop_info->get_option_themeurl();
		//$this->load->view('welcome_message', $data);

		//$this->load->view('themes/default/index', $data);
		$this->load->view('../../themes/'.$theme.'/checkout', $data);
	}

	// Isi Biodata konsumen
	public function langkah1(){
		$shop_info = $this->shop_info->get_shop_info();

		$data['sitename'] = $shop_info['shopname'];
		$data['slogan'] = $shop_info['slogan'];
		$data['email'] = $shop_info['email'];
		$data['phone'] = $shop_info['phone'];
		$data['web'] = $shop_info['web'];
		$data['logo'] = $shop_info['logo'];
		$data['icon'] = $shop_info['icon'];

		// page info
		$data['pagetitle'] = 'Checkout Pesanan';
		// nav list page on footer
		$data['pagelist'] = $this->core->listNavPage();
		$data['listlastproducts'] = $this->core->listLastProduct();
		$data['listNavCategory'] = $this->core->listNavCategory();

		$theme = $this->shop_info->get_option_theme();
		$themeurl = $this->shop_info->get_option_themeurl();

		$data['urlwebsite'] = base_url() . $themeurl . $theme . "/"; //'application/views/themes/default/';
		
		$usercode = $this->session->userdata("usercode");
		$data['step'] = 'step1';
		
		$theme = $this->shop_info->get_option_theme();
		$themeurl = $this->shop_info->get_option_themeurl();

		$this->load->view('../../themes/'.$theme.'/checkout-finish', $data);
	}

	// pilih shipping
	public function langkah2(){
		$shop_info = $this->shop_info->get_shop_info();

		$data['sitename'] = $shop_info['shopname'];
		$data['slogan'] = $shop_info['slogan'];
		$data['email'] = $shop_info['email'];
		$data['phone'] = $shop_info['phone'];
		$data['web'] = $shop_info['web'];
		$data['logo'] = $shop_info['logo'];
		$data['icon'] = $shop_info['icon'];

		// page info
		$data['pagetitle'] = 'Checkout Pesanan';
		// nav list page on footer
		$data['pagelist'] = $this->core->listNavPage();
		$data['listlastproducts'] = $this->core->listLastProduct();
		$data['listNavCategory'] = $this->core->listNavCategory();

		$theme = $this->shop_info->get_option_theme();
		$themeurl = $this->shop_info->get_option_themeurl();

		$data['urlwebsite'] = base_url() . $themeurl . $theme . "/"; //'application/views/themes/default/';
		
		$usercode = $this->session->userdata("usercode");
		$data['step'] = 'step2';
		
		$theme = $this->shop_info->get_option_theme();
		$themeurl = $this->shop_info->get_option_themeurl();

		$this->load->view('../../themes/'.$theme.'/checkout-finish', $data);
	}

	// pilih payment
	public function langkah3(){
		$shop_info = $this->shop_info->get_shop_info();

		$data['sitename'] = $shop_info['shopname'];
		$data['slogan'] = $shop_info['slogan'];
		$data['email'] = $shop_info['email'];
		$data['phone'] = $shop_info['phone'];
		$data['web'] = $shop_info['web'];
		$data['logo'] = $shop_info['logo'];
		$data['icon'] = $shop_info['icon'];

		// page info
		$data['pagetitle'] = 'Checkout Pesanan';
		// nav list page on footer
		$data['pagelist'] = $this->core->listNavPage();
		$data['listlastproducts'] = $this->core->listLastProduct();
		$data['listNavCategory'] = $this->core->listNavCategory();

		$theme = $this->shop_info->get_option_theme();
		$themeurl = $this->shop_info->get_option_themeurl();

		$data['urlwebsite'] = base_url() . $themeurl . $theme . "/"; //'application/views/themes/default/';
		
		$usercode = $this->session->userdata("usercode");
		$data['step'] = 'step3';
		
		$theme = $this->shop_info->get_option_theme();
		$themeurl = $this->shop_info->get_option_themeurl();

		$this->load->view('../../themes/'.$theme.'/checkout-finish', $data);	}

	// Total order
	public function finishorder(){
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
		$data['pagetitle'] = 'Checkout Pesanan';
		// nav list page on footer
		$data['pagelist'] = $this->core->listNavPage();
		$data['listlastproducts'] = $this->core->listLastProduct();
		$data['listNavCategory'] = $this->core->listNavCategory();

		$theme = $this->shop_info->get_option_theme();
		$themeurl = $this->shop_info->get_option_themeurl();

		$data['step'] = 'step1';

		$data['urlwebsite'] = base_url() . $themeurl . $theme . "/"; //'application/views/themes/default/';
		
		$usercode = $this->session->userdata("usercode");
		$data['qry'] = $this->db->query("SELECT us.*, pr.nama_propinsi, kt.nama_kota, kc.nama_kecamatan FROM ss_user us 
			LEFT JOIN ss_propinsi pr ON pr.kode_propinsi = us.kode_propinsi
			LEFT JOIN ss_kota kt ON kt.kode_kota = us.kode_kota
			LEFT JOIN ss_kecamatan kc ON kc.kode_kecamatan = us.kode_kec
			WHERE us.usercode = '$usercode'");
		$data['step'] ='finishorder';
		$theme = $this->shop_info->get_option_theme();
		$themeurl = $this->shop_info->get_option_themeurl();
		//$this->load->view('welcome_message', $data);

		//$this->load->view('themes/default/index', $data);
		$this->load->view('../../themes/'.$theme.'/checkout-finish', $data);
	}

	function getkec(){
		$kota = $this->input->get("kota", TRUE);
		$data = array();
		$get = $this->db->query("SELECT * FROM ss_shipping_jne WHERE kota = '$kota'");
		foreach ($get->result_array() as $key => $value) {
			$rec['kota'] = $value['kota'];
			$rec['kec'] = $value['kec'];
			$rec['price'] = $value['reg'] ."|".$value['oke']."|".$value['yes'];
			$data[] = $rec;
		}
		echo json_encode($data);
	}
}