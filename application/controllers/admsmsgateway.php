<?php
class Admsmsgateway extends CI_Controller {

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

		$data['TITLE'] = 'SMS Gateway';
		$data['title'] = 'Admin Category';
		$data['SUBTITLE'] = 'Setting';
		$data['BREADCRUMB'] = '';
		$data['MAINPAGE'] = 'Main Page';
		$data['MENU'] = 'Menu';
		$data['SUBMENU'] = 'Submenu';
		$data['SUBSUBMENU'] = 'Susbsubmenu';
		$data['USERID'] = 'ADMIN';
		$data['EMPCODE'] = 'SANZUKE';
		
		$data['treemenu'] = $this->treemenu->get_tree_menu();
		//$data['treemenu'] = '';
		$data['listkategori'] = $this->category_model->get_category_table();
		
		$submit = $this->input->post("submit", true);
		if($submit == "simpan"){
			$link = $this->input->post("link", TRUE);
			$user = $this->input->post("user", TRUE);
			$pass = $this->input->post("pass", TRUE);

			$up = $this->core->updateValueOpt("smsgateway_link", $link);
			$up = $this->core->updateValueOpt("smsgateway_user", $user);
			$up = $this->core->updateValueOpt("smsgateway_pass", $pass);

			if($up){
				$this->session->set_flashdata("msg","Data berhasil diubah");
			} else {
				$this->session->set_flashdata("msg","Data gagal diubah");
			}
		} 

		$data['getLink'] = $this->core->getValueOpt('smsgateway_link');
        $data['getUser'] = $this->core->getValueOpt('smsgateway_user');
        $data['getPass'] = $this->core->getValueOpt('smsgateway_pass');

		$this->load->view('admin/adm_smsgateway', $data);
	}

}
		