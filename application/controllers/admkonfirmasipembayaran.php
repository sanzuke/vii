<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admkonfirmasipembayaran extends CI_Controller {

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

		$data['TITLE'] = 'Konfirmasi Pembayaran';
		$data['title'] = 'Penjualan';
		$data['SUBTITLE'] = 'Tambah Baru';
		$data['BREADCRUMB'] = '';
		$data['MAINPAGE'] = 'Main Page';
		$data['MENU'] = 'Menu';
		$data['SUBMENU'] = 'Submenu';
		$data['SUBSUBMENU'] = 'Susbsubmenu';
		$data['USERID'] = 'ADMIN';
		$data['EMPCODE'] = 'SANZUKE';
		
		$data['treemenu'] = $this->treemenu->get_tree_menu();

		$this->load->view('admin/adm_konfirmasi_pembayaran', $data);
	}

}