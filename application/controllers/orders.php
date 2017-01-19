<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends CI_Controller {

	public function index()
	{
		$data['TITLE'] = 'Pesanan';
		$data['title'] = 'Admin das-PORTAL';
		$data['SUBTITLE'] = 'Daftar Pesanan';
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

		$q = $this->db->query("SELECT 
			a.*, 
			b.nama as name,
			(SELECT SUM(qty) FROM um_transactiondetails WHERE transactioncode = a.transactioncode) as qty,
			(SELECT SUM(qty*price) FROM um_transactiondetails WHERE transactioncode = a.transactioncode) as total
			 FROM um_transaction a, um_customerinfo b 
			 WHERE a.transactioncode = b.transactioncode
			 ORDER BY date desc");
		$data['query'] = $q->result_array();
		
		$this->load->view('admin/adm_orders', $data);
	}

	public function getdetail(){
		$trx = $this->input->get("p", TRUE);

		$get = $this->db->query("SELECT a.*, b.productname, c.*, (SELECT options FROM ss_parametervalue WHERE parametercode = 'PAYMENT' AND parametervaluecode = c.paymentcode) as payment
			FROM um_transactiondetails a, ss_products b, um_customerinfo c 
			WHERE a.transactioncode = '$trx'
			AND a.transactioncode = c.transactioncode
			AND a.productcode = b.productcode ");
		$data = array();

		foreach ($get->result_array() as $key) {
			$rec['nama'] = $key['nama'];
			$rec['alamat'] = $key['alamat'];
			$rec['kec'] = $key['kec'];
			$rec['kota'] = $key['kota'];
			$rec['telp'] = $key['telp'];
			$rec['email'] = $key['email'];
			$rec['payment'] = $key['payment'];
			$rec['shipping'] = $key['shippingcode'];

			$rec['transactioncode'] = $key['transactioncode'];
			$rec['productcode'] = $key['productcode'];
			$rec['productname'] = $key['productname'];
			$rec['qty'] = $key['qty'];
			$rec['price'] = $key['price'];
			$rec['subtotal'] = $key['subtotal'];
			$data[] = $rec;
		}
		echo json_encode($data);
	}

}