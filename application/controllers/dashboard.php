<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller {

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
		$data['TITLE'] = 'Beranda';
		$data['title'] = 'Admin das-PORTAL';
		$data['SUBTITLE'] = 'Panel Control';
		$data['BREADCRUMB'] = '';
		$data['MAINPAGE'] = 'Main Page';
		$data['MENU'] = 'Menu';
		$data['SUBMENU'] = 'Submenu';
		$data['SUBSUBMENU'] = 'Susbsubmenu';
		$data['USERID'] = $this->session->userdata('userid');
		$data['EMPCODE'] = 'ADMIN';

		// Jumlah Barang
		$q = $this->db->query("SELECT count(*) as sum FROM ss_products");
		foreach($q->result_array() as $r ){
			$jml = $r['sum'];
		}
		$data['sumproduk'] = $jml;

		// Jumlah member
		$q = $this->db->query("SELECT count(*) as sum FROM ss_user WHERE status ='3'");
		foreach($q->result_array() as $r ){
			$jmlmember = $r['sum'];
		}
		$data['jmlmember'] = $jmlmember;

		// Jumlah transaksi
		$q = $this->db->query("SELECT count(*) as sum FROM um_transaction WHERE status ='0'");
		foreach($q->result_array() as $r ){
			$jmltrx = $r['sum'];
		}
		$data['jmltrx'] = $jmltrx;

		//$data['userregister'] = count($this->db->query("SELECT * FROM ss_userinfo WHERE status NOT IN ('1','2') ")->result_array());
	
		$data['treemenu'] = $this->treemenu->get_tree_menu();
		
		//$user = $this->session->userdata('userid');
		//$user = local'userid');

		//if($user != ""){
			$this->load->view('admin/adm_dashboard', $data);
		//} else {
			//echo $user;
			//redirect("adminlogin");
		//}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
