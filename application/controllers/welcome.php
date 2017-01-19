<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->db->from('ss_menu');
		$query= $this->db->get();

		$shop_info = $this->shop_info->get_shop_info();

		$data['sitename'] = $shop_info['shopname'];
		$data['slogan'] = $shop_info['slogan'];
		$data['email'] = $shop_info['email'];
		$data['phone'] = $shop_info['phone'];
		$data['web'] = $shop_info['web'];
		$data['logo'] = $shop_info['logo'];
		$data['icon'] = $shop_info['icon'];

		$data['query'] = $query->result();
		$data['TITLE'] = 'Dashboard';
		$data['title'] = 'Admin das-PORTAL';
		$data['SUBTITLE'] = 'Control Panel';
		$data['BREADCRUMB'] = '';
		$data['MAINPAGE'] = 'Main Page';
		$data['MENU'] = 'Menu';
		$data['SUBMENU'] = 'Submenu';
		$data['SUBSUBMENU'] = 'Susbsubmenu';
		$data['USERID'] = 'ADMIN';
		$data['EMPCODE'] = 'SANZUKE';

		$data['urlwebsite'] = base_url() . 'application/views/themes/default/';

		// nav list page on footer
		$data['pagelist'] = $this->core->listNavPage();
		$data['listlastproducts'] = $this->core->listLastProduct();
		$data['listNavCategory'] = $this->core->listNavCategory();
		
		//widget
		$data['widgetpromo'] = $this->core->widgetPromo();

		$data['treemenu'] = $this->treemenu->get_tree_menu();
		
		$theme = $this->shop_info->get_option_theme();
		$themeurl = $this->shop_info->get_option_themeurl();

		$data['banner'] = $this->core->loadbanner();
		//$this->load->view('welcome_message', $data);

		$data['mainpageContent'] = $this->core->mainPageContent();

		//$this->load->view('themes/default/index', $data);
		$this->load->view('../../themes/'.$theme.'/index', $data);
		//$this->load->theme('tokoonline');
	}

	public function sendsms(){
		$phone = '089687038641';
		$msg = 'testing sms gateway ==> ok ok ok ok';
		$result = $this->core->sendSMS($phone, $msg);
		echo 'Hasil : ';
		echo $result;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
