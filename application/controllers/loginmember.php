<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Loginmember extends CI_Controller {

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
		
		if(! empty($this->session->userdata('userlogin')) ){
			$this->load->view('themes/default/memberarea', $data);
		} else {
			$this->load->view('themes/default/login', $data);
			//redirect("login");
		}
	}

}