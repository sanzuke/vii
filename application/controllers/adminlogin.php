<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminlogin extends CI_Controller {

	public function __contruct(){
		if(!$this->session->userdata('userid')){
			$this->_redirect("adminlogin");
		} else {
			$this->_redirect("dashboard");
		}
	}

	public function index()
	{
		$this->db->from('ss_menu');
		$query= $this->db->get();
		$qryList = $this->db->query("SELECT * FROM ss_category");
		
		/*if($this->session->userdata('userid')){
			$this->_redirect("dashboard");
		}*/
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
		
		$this->load->view('view_login');
	}
	
	public function auth(){
		error_reporting(0);
		$u = $this->input->post('u', TRUE);
		$p = $this->input->post('p', TRUE);

		if($u == 'admin' && $p == 'admin'){
			echo 'true';
			$this->session->set_userdata('userid',$u);
			//$this->core_model->setUserlogonLog($u); // add to user logon log
		} else {
			echo 'false';
		}
	}

	public function logout(){
		echo '<script>';
		echo "localStorage.removeItem('userid');";
		echo "window.location = 'http://babymushop.com/index.php/adminlogin/';";
		echo '</script>';
		//redirect("adminlogin");
	}

}
?>