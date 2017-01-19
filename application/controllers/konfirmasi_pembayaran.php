<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Konfirmasi_pembayaran extends CI_Controller {

	public function index()
	{
		
		//$data['treemenu'] = $this->treemenu->get_tree_menu();

		$shop_info = $this->shop_info->get_shop_info();

		$data['sitename'] = $shop_info['shopname'];
		$data['slogan'] = $shop_info['slogan'];
		$data['email'] = $shop_info['email'];
		$data['phone'] = $shop_info['phone'];
		$data['web'] = $shop_info['web'];
		$data['logo'] = $shop_info['logo'];
		$data['icon'] = $shop_info['icon'];

		// page info
		$data['pagetitle'] = 'Halaman';

		$theme = $this->shop_info->get_option_theme();
		$themeurl = $this->shop_info->get_option_themeurl();

		$data['pagelist'] = $this->core->listNavPage();
		$data['listlastproducts'] = $this->core->listLastProduct();
		$data['listNavCategory'] = $this->core->listNavCategory();

		$id = $this->uri->segment(3);
		if($id != ""){
			$str = '';
			$q = $this->db->query("SELECT * FROM cm_post WHERE post_title = '$id' ");
			while($r=$q->result_array()){
				$str = $r['post_content'];
			}
			$data['post_content'] = $str;
		} else {
			$data['post_content'] = 'Page not found';
		}

		$data['bank'] = $this->db->query("SELECT * FROM ss_parametervalue WHERE parametervaluecode <> 'COD' AND parametercode = 'PAYMENT'");

		//$data['urlwebsite'] = base_url() . 'application/views/themes/default/';
		$data['urlwebsite'] = base_url() . $themeurl . $theme . "/"; //'application/views/themes/default/';
		
		//$this->load->view('themes/default/page', $data);
		$this->load->view('../../themes/'.$theme.'/konfirmasi', $data);
	}

	public function save(){
		$kode = $this->input->post("kode", TRUE);
		$tanggal = $this->input->post("tanggal", TRUE);
		$kebank = $this->input->post("kebank", TRUE);
		$an = $this->input->post("an", TRUE);
		$jumlah = $this->input->post("jumlah", TRUE);
		$captcha = $this->input->post("captcha", TRUE);

		// First, delete old captchas
		$expiration = time()-7200; // Two hour limit
		$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);	

		// Then see if a captcha exists:
		$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
		$binds = array($captcha, $this->input->ip_address(), $expiration);
		$query = $this->db->query($sql, $binds);
		$row = $query->row();

		if ($row->count == 0)
		{
		    $this->session->set_flashdata("note", "You must submit the word that appears in the image");
		    redirect("Konfirmasi_pembayaran");
		} else {
			$getKode = $this->db->query("SELECT * FROM um_transaction WHERE transactioncode = '$kode'");
			$jml = $getKode->num_rows();
			if($jml > 0 ){
				$data = array(
					'no' => null,
					'transactioncode' => $kode,
					'tanggal' => $tanggal,
					'kerekening' => $kebank,
					'atasnamapengirim' => $an,
					'jumlah' => $jumlah
				);
				$ins = $this->db->insert("um_konfirmasi", $data);
				if($ins){
					$this->session->set_flashdata("confirm","true");
				} else {
					$this->session->set_flashdata("confirm","false");
				}
			} else {
				$this->session->set_flashdata("confirm","false");
				$this->session->set_flashdata("note","Kode Invoice anda tidak ditemukan, silahkan cek kembali.");
				$getPost = array(
					'transactioncode' => $kode,
					'tanggal' => $tanggal,
					'kerekening' => $kebank,
					'atasnamapengirim' => $an,
					'jumlah' => $jumlah
				);
				$this->session->set_flashdata("post",$getPost);
			}
			redirect("Konfirmasi_pembayaran");
		}
	}
}