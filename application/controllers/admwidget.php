<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admwidget extends CI_Controller {

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
		$data['TITLE'] = 'Daftar Widget';
		$data['title'] = 'Admin das-PORTAL';
		$data['SUBTITLE'] = 'Panel Control';
		$data['BREADCRUMB'] = '';
		$data['MAINPAGE'] = 'Main Page';
		$data['MENU'] = 'Menu';
		$data['SUBMENU'] = 'Submenu';
		$data['SUBSUBMENU'] = 'Susbsubmenu';
		$data['USERID'] = $this->session->userdata('userid');
		$data['EMPCODE'] = 'ADMIN';

		$data['treemenu'] = $this->treemenu->get_tree_menu();

		$data['widget'] = $this->db->query("SELECT * FROM ss_widget")->result_array();
		
		$this->load->view('admin/adm_widget', $data);
	}

}