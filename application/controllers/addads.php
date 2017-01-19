<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Addads extends CI_Controller {

	public function index()
	{
		$this->db->from('ss_menu');
		$query= $this->db->get();

		$qryList = $this->db->query("SELECT * FROM ss_adslocation");
		$var = '[';
		$i = 1;
		foreach ($qryList->result_array() as $row){
			if ($i <= $query->num_rows()){
				$var .= '"'.$row['placename'] . ' (' .$row['adslocationcode'].')",';
			} else {
				$var .= '"'.$row['placename'] . ' (' .$row['adslocationcode'].')"';
			}
			$i++;
		}
		$var .= ']';

		$data['listlocation'] = $var;

		$data['countLocation'] = count($qryList->result_array());
		$data['query'] = $query->result();
		$data['TITLE'] = 'Add Advertising';
		$data['title'] = 'Admin das-PORTAL';
		$data['SUBTITLE'] = 'Add New Video Content';
		$data['BREADCRUMB'] = '';
		$data['MAINPAGE'] = 'Main Page';
		$data['MENU'] = 'Menu';
		$data['SUBMENU'] = 'Submenu';
		$data['SUBSUBMENU'] = 'Susbsubmenu';
		$data['USERID'] = 'ADMIN';
		$data['EMPCODE'] = 'SANZUKE';
		
		$data['treemenu'] = $this->treemenu->get_tree_menu();
		
		$this->load->view('view_addads', $data);
	}
}