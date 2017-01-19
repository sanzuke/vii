<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admtheme extends CI_Controller {

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
		$data['TITLE'] = 'Setting';
		$data['title'] = 'Admin das-PORTAL';
		$data['SUBTITLE'] = 'Tema';
		$data['BREADCRUMB'] = '';
		$data['MAINPAGE'] = 'Main Page';
		$data['MENU'] = 'Menu';
		$data['SUBMENU'] = 'Submenu';
		$data['SUBSUBMENU'] = 'Susbsubmenu';
		$data['USERID'] = $this->session->userdata('userid');
		$data['EMPCODE'] = 'ADMIN';
		
		$data['treemenu'] = $this->treemenu->get_tree_menu();
		$aktiftheme = 'default';
		$q = $this->db->query("SELECT value FROM ss_options WHERE name = 'theme' ");
		foreach ($q->result_array() as $key => $value) {
			$aktiftheme = $value['value'];
		}
		$data['aktiftheme'] = $aktiftheme;
		$this->load->view('admin/adm_theme', $data);
	}

	public function saveTheme(){
		$theme = $this->input->post("theme",TRUE);
		$up = $this->db->query("UPDATE ss_options SET value = '$theme' WHERE name = 'theme'");
		if($up){
			$this->session->set_flashdata('note','Tema telah diubah');
			$this->session->set_flashdata('status','1');
		} else {
			$this->session->set_flashdata('note','Tema gagal diubah');
			$this->session->set_flashdata('status','0');
		}
		redirect('admtheme');
	}
}
?>