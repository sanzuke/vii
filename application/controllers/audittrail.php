<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Audittrail extends CI_Controller {

	public function index()
	{
		$this->db->from('ss_menu');
		$query= $this->db->get();
		$qryList = $this->db->query("SELECT * FROM ss_category");
		
		$shop_info = $this->shop_info->get_shop_info();
		$data['sitename'] = $shop_info['shopname'];
		$data['slogan'] = $shop_info['slogan'];
		$data['email'] = $shop_info['email'];
		$data['phone'] = $shop_info['phone'];
		$data['web'] = $shop_info['web'];
		$data['logo'] = $shop_info['logo'];
		$data['icon'] = $shop_info['icon'];

		$data['query'] = $query->result();
		$data['TITLE'] = 'Audit Trail Log';
		$data['title'] = 'Admin das-PORTAL';
		$data['SUBTITLE'] = 'Activity Log';
		$data['BREADCRUMB'] = '';
		$data['MAINPAGE'] = 'Main Page';
		$data['MENU'] = 'Menu';
		$data['SUBMENU'] = 'Submenu';
		$data['SUBSUBMENU'] = 'Susbsubmenu';
		$data['USERID'] = 'ADMIN';
		$data['EMPCODE'] = 'SANZUKE';
		
		$data['treemenu'] = $this->treemenu->get_tree_menu();
		
		$this->load->view('view_audittrail', $data);
	}
}