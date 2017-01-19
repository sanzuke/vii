<?php
class Admkupon extends CI_Controller {

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

		$data['TITLE'] = 'Buat Kupon';
		$data['title'] = 'Admin Kupon';
		$data['SUBTITLE'] = 'Kupon';
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
			$kode 		= $this->input->post("kode", TRUE);
			$nama 		= $this->input->post("nama", TRUE);
			$startdate 	= $this->input->post("startdate", TRUE);
			$enddate 	= $this->input->post("enddate", TRUE);
			$diskon 	= $this->input->post("diskon", TRUE);
			$jumlah 	= $this->input->post("jumlah", TRUE);

			$data =  array(
				'kode' => $kode,
				'nama' => $nama,
				'startdate' => date('Y-m-d', strtotime($startdate)),
				'enddate' => date('Y-m-d', strtotime($enddate)),
				'diskon' => $diskon,
				'jumlah' => $jumlah
			);

			$cek = $this->db->query("SELECT * FROM ss_kupon WHERE kodekupon='$kode'");
			$jml = $cek->num_rows();
			if($jml < 1){ 
				$up = $this->db->insert("ss_kupon", $data);
			} else {
				$where = array('kodekupon'=>$kode);
				$up = $this->db->update("ss_kupon", $data, $where);
			}
			if($up){
				$this->session->set_flashdata("msg","Data berhasil diubah");
			} else {
				$this->session->set_flashdata("msg","Data gagal diubah");
			}
		} 

		$data['query'] = $this->db->query("SELECT * FROM ss_kupon");

		$this->load->view('admin/adm_kupon', $data);
	}

}