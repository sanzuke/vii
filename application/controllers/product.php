<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {

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

		$data['size'] = $this->core->sizeproduct($id);
		//$data['urlwebsite'] = base_url() . 'application/views/themes/default/';
		$data['urlwebsite'] = base_url() . $themeurl . $theme . "/"; //'application/views/themes/default/';
		
		//$this->load->view('themes/default/single', $data);

		$theme = $this->shop_info->get_option_theme();
		$themeurl = $this->shop_info->get_option_themeurl();
		//$this->load->view('welcome_message', $data);

		//$this->load->view('themes/default/index', $data);
		$this->load->view('../../themes/'.$theme.'/single', $data);
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
		$data['titleProduct'] = $this->core->titleProduct($id);
		
		$data['sizeproduct'] = $this->core->sizeproduct($id);
		$data['colorproduct'] = $this->core->colorproduct($id);

		$data['productdetail'] = $this->core->singleProduct($id);
		$data['relateproduct'] = $this->core->relateproduct($id);
		$data['otherimg'] = $this->core->otherimage($id);
		$data['size'] = $this->core->sizeproduct($id);
		$data['color'] = $this->core->colorproduct($id);

		//widget
		$data['widgetpromo'] = $this->core->widgetPromo();
		
		// Set theme
		$theme = $this->shop_info->get_option_theme();
		$themeurl = $this->shop_info->get_option_themeurl();

		//$data['urlwebsite'] = base_url() . 'application/views/themes/default/';
		$data['urlwebsite'] = base_url() . $themeurl . $theme . "/"; //'application/views/themes/default/';
		
		//$this->load->view('themes/default/single', $data);

		$theme = $this->shop_info->get_option_theme();
		$themeurl = $this->shop_info->get_option_themeurl();

		$this->load->view('../../themes/'.$theme.'/single', $data);
	}

	public function addtocart(){
		$pc = $this->input->post("pc", TRUE);
		$pn = $this->input->post("pn", TRUE);
		$qty = $this->input->post("qty", TRUE);
		$pr = $this->input->post("pr", TRUE);

		$data = array(
           'id'      => $pc,
           'qty'     => $qty,
           'price'   => $pr,
           'name'    => $pn,
           'options' => array('Size' => 'L', 'Color' => 'Red')
        );

		$this->cart->insert($data);
		
	}

	public function preview(){
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
		$data['titleProduct'] = $this->core->titleProduct($id);
		
		$data['sizeproduct'] = $this->core->sizeproduct($id);
		$data['colorproduct'] = $this->core->colorproduct($id);

		$data['productdetail'] = $this->core->singleProduct($id);
		$data['relateproduct'] = $this->core->relateproduct($id);
		$data['otherimg'] = $this->core->otherimage($id);
		$data['size'] = $this->core->sizeproduct($id);
		$data['color'] = $this->core->colorproduct($id);

		//widget
		$data['widgetpromo'] = $this->core->widgetPromo();
		
		// Set theme
		$theme = $this->shop_info->get_option_theme();
		$themeurl = $this->shop_info->get_option_themeurl();

		//$data['urlwebsite'] = base_url() . 'application/views/themes/default/';
		$data['urlwebsite'] = base_url() . $themeurl . $theme . "/"; //'application/views/themes/default/';
		
		//$this->load->view('themes/default/single', $data);

		$theme = $this->shop_info->get_option_theme();
		$themeurl = $this->shop_info->get_option_themeurl();

		$this->load->view('../../themes/'.$theme.'/preview', $data);
	}
}