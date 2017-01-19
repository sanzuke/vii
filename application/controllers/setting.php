<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends CI_Controller {

	public function index()
	{
		$this->db->from('ss_menu');
		$query= $this->db->get();

		$data['query'] = $query->result();
		$data['TITLE'] = 'Information Toko';
		$data['title'] = 'Admin das-PORTAL';
		$data['SUBTITLE'] = 'Pengaturan';
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
		$data['address'] = $shop_info['address'];
		$data['email'] = $shop_info['email'];
		$data['phone'] = $shop_info['phone'];
		$data['web'] = $shop_info['web'];
		$data['logo'] = $shop_info['logo'];
		$data['icon'] = $shop_info['icon'];

		$data['open_day'] = $shop_info['open_day'];
		$data['open_hour'] = $shop_info['open_hour'];
		$data['wa'] = $shop_info['wa'];
		$data['line'] = $shop_info['line'];
		$data['bbm'] = $shop_info['bbm'];


		$this->load->view('admin/adm_setting', $data);
	}

	public function save(){
		$namatoko = $this->input->post("namatoko",TRUE);
		$slogantoko = $this->input->post("slogantoko",TRUE);
		$address = $this->input->post("address",TRUE);
		$email = $this->input->post("email",TRUE);
		$telp = $this->input->post("telp",TRUE);
		$web = $this->input->post("web",TRUE);
		$logo = $this->input->post("userfile",TRUE);
		$icon = $this->input->post("userfile",TRUE);

		$open_day = $this->input->post("open_day",TRUE);
		$open_hour = $this->input->post("open_hour",TRUE);
		$wa = $this->input->post("wa",TRUE);
		$line = $this->input->post("line",TRUE);
		$bbm = $this->input->post("bbm",TRUE);

		$data = array(
			'shopname' => $namatoko,
			'address' => $address,
			'slogan' => $slogantoko,
			'email' => $email,
			'phone' => $telp,
			'web' => $web,
			'logo' => $logo,
			'icon' => $icon,

			'open_day' => $open_day,
			'open_hour' => $open_hour,
			'wa' => $wa,
			'line' => $line,
			'bbm' => $bbm
		);
		$up = $this->db->update("ss_shopinfo", $data, array('id'=>'1'));
		if($up){
			$this->session->set_flashdata("note", "Data berhasil disimpan");
		} else {
			$this->session->set_flashdata("note", "Data gagal disimpan");
		}
		redirect("setting");
	}
}
?>