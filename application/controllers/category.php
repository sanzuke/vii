<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {

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
		$data['pagetitle'] = 'Halaman';

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
		//$data['urlwebsite'] = base_url() . $themeurl . $theme . "/"; //'application/views/themes/default/';
		
		//$this->load->view('themes/default/page', $data);

		$theme = $this->shop_info->get_option_theme();
		//$data['urlwebsite'] = base_url() . 'application/views/themes/default/';
		$data['urlwebsite'] = base_url() . $themeurl . $theme . "/"; //'application/views/themes/default/';
		
		//$this->load->view('themes/default/page', $data);
		$this->load->view('../../themes/'.$theme.'/category', $data);
	}

	public function view(){
		//$data['treemenu'] = $this->treemenu->get_tree_menu();

		$shop_info = $this->shop_info->get_shop_info();

		$data['sitename'] = $shop_info['shopname'];
		$data['slogan'] = $shop_info['slogan'];
		$data['email'] = $shop_info['email'];
		$data['phone'] = $shop_info['phone'];
		$data['web'] = $shop_info['web'];
		$data['logo'] = $shop_info['logo'];
		$data['icon'] = $shop_info['icon'];

		// nav list page on footer
		$data['pagelist'] = $this->core->listNavPage();
		$id = $this->uri->segment(3);
		
		//$data['listCategoryProduct'] = $this->core->listCategoryProduct($id);
		$data['listlastproducts'] = $this->core->listCategoryProduct($id);
		$data['listNavCategory'] = $this->core->listNavCategory();
		$data['titleCategoryPage'] = $this->core->titleCategoryPage($id);

		//widget
		$data['widgetpromo'] = $this->core->widgetPromo();

		// Set theme
		$theme = $this->shop_info->get_option_theme();
		$themeurl = $this->shop_info->get_option_themeurl();

		//$data['urlwebsite'] = base_url() . 'application/views/themes/default/';
		//$data['urlwebsite'] = base_url() . $themeurl . $theme . "/"; //'application/views/themes/default/';
		
		//$this->load->view('themes/default/category', $data);

		$theme = $this->shop_info->get_option_theme();
		//$data['urlwebsite'] = base_url() . 'application/views/themes/default/';
		$data['urlwebsite'] = base_url() . $themeurl . $theme . "/"; //'application/views/themes/default/';
		
		//$this->load->view('themes/default/page', $data);
		$this->load->view('../../themes/'.$theme.'/category', $data);
	}

	public function lastproduct(){
		//$data['treemenu'] = $this->treemenu->get_tree_menu();

		$shop_info = $this->shop_info->get_shop_info();

		$data['sitename'] = $shop_info['shopname'];
		$data['slogan'] = $shop_info['slogan'];
		$data['email'] = $shop_info['email'];
		$data['phone'] = $shop_info['phone'];
		$data['web'] = $shop_info['web'];
		$data['logo'] = $shop_info['logo'];
		$data['icon'] = $shop_info['icon'];

		// nav list page on footer
		$data['pagelist'] = $this->core->listNavPage();
		$id = $this->uri->segment(3);
		
		//$data['listCategoryProduct'] = $this->core->listCategoryProduct($id);
		$data['listlastproducts'] = $this->core->listLastProduct();
		$data['listNavCategory'] = $this->core->listNavCategory();
		$data['titleCategoryPage'] = 'Produk Terbaru';

		//widget
		$data['widgetpromo'] = $this->core->widgetPromo();

		// Set theme
		$theme = $this->shop_info->get_option_theme();
		$themeurl = $this->shop_info->get_option_themeurl();

		//$data['urlwebsite'] = base_url() . 'application/views/themes/default/';
		$data['urlwebsite'] = base_url() . $themeurl . $theme . "/"; //'application/views/themes/default/';
		
		$this->load->view('themes/default/category', $data);
	}

	public function getsize(){
		$pc = $this->input->get("pc");
		$size = $this->core->sizeproduct($pc);
		$data = array();
		foreach ($size as $key => $value) {
			$rec['size'] = $value['size'];
			$rec['jumlah'] = $value['jumlah'];
			$data[] = $rec;
		}
		 echo json_encode($data);
	}

	public function getcolor(){
		$pc = $this->input->get("pc");
		$color = $this->core->colorproduct($pc);
		$data = array();
		foreach ($color as $key => $value) {
			$rec['color'] = $value['color'];
			$rec['jumlah'] = $value['jumlah'];
			$data[] = $rec;
		}
		 echo json_encode($data);
	}
}