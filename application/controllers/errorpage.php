<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Errorpage extends CI_Controller {
 
	public function index()
	{
		$shop_info = $this->shop_info->get_shop_info();

		$data['sitename'] = $shop_info['shopname'];
		$data['slogan'] = $shop_info['slogan'];
		$data['email'] = $shop_info['email'];
		$data['phone'] = $shop_info['phone'];
		$data['web'] = $shop_info['web'];
		$data['logo'] = $shop_info['logo'];
		$data['icon'] = $shop_info['icon'];

		// page list

		$data['pagelist'] = $this->core->listNavPage();

		$theme = $this->shop_info->get_option_theme();
		$themeurl = $this->shop_info->get_option_themeurl();

		$data['listNavCategory'] = $this->core->listNavCategory();
		//$data['urlwebsite'] = base_url() . 'application/views/themes/default/';
		$data['urlwebsite'] = base_url() . $themeurl . $theme . "/"; //'application/views/themes/default/';

		$this->load->view('../../themes/'.$theme.'/errorpage',$data);

		//$this->load->view('view_errorpage',$data);
		//echo "404 - not found";
	}
}