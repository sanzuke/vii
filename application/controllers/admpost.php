<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admpost extends CI_Controller {

	public function index()
	{
		$data['TITLE'] = 'Posting';
		$data['title'] = 'Admin das-PORTAL';
		$data['SUBTITLE'] = 'Tambah Halaman';
		$data['BREADCRUMB'] = '';
		$data['MAINPAGE'] = 'Main Page';
		$data['MENU'] = 'Menu';
		$data['SUBMENU'] = 'Submenu';
		$data['SUBSUBMENU'] = 'Susbsubmenu';
		$data['USERID'] = 'ADMIN';
		$data['EMPCODE'] = 'SANZUKE';
		
		$data['treemenu'] = $this->treemenu->get_tree_menu();

		$shop_info = $this->shop_info->get_shop_info();

		$data['sitename'] = $shop_info['shopname'];
		$data['slogan'] = $shop_info['slogan'];
		$data['email'] = $shop_info['email'];
		$data['phone'] = $shop_info['phone'];
		$data['web'] = $shop_info['web'];
		$data['logo'] = $shop_info['logo'];
		$data['icon'] = $shop_info['icon'];
		
		$this->load->view('admin/adm_post', $data);
	}

}