<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admpage extends CI_Controller {

	public function index()
	{
		$data['TITLE'] = 'Halaman';
		$data['title'] = 'Admin das-PORTAL';
		$data['SUBTITLE'] = 'Tambah Halaman';
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
		
		$this->load->view('admin/adm_page', $data);
	}

	public function getdatadetail(){
		$qry = $this->db->query("SELECT * FROM cm_post WHERE post_type = 'page' ");

		foreach ($qry->result_array() as $key => $value) {
			# code...
			$record['id'] 		= $value['id'];
			$record['post_title'] 		= $value['post_title'];
			$record['post_content'] 	= $value['post_content'];
			$record['post_date'] 		= $value['post_date'];
			$record['publish'] 			= $value['publish'];
			$record['author'] 			= $value['author'];
			$record['meta_title'] 		= $value['meta_title'];
			$record['meta_description'] = $value['meta_description'];
			$record['meta_keyword'] 	= $value['meta_keyword'];
			$record['seq'] 				= $value['seq'];
			$data[] 					= $record;
		}
		echo json_encode($data);
	}

	public function savedata(){
		$id 			= $this->input->post("id");
		$title 			= $this->input->post("title");
		$desc  			= $this->input->post("desc");
		$tagtitle  		= $this->input->post("tagtitle");
		$tagdesc  		= $this->input->post("tagdesc");
		$tagkeyword  	= $this->input->post("tagkeyword");
		$userid 		= $this->input->post("userid");
		$seq 			= $this->input->post("seq");

		if( $id != "" ){
			$data = array(
				'post_title' 		=> $title,
				'post_content' 		=> $desc,
				'post_date' 		=> date("Y-m-d"),
				'publish' 			=> '1',
				'author' 			=> $userid ,
				'meta_title' 		=> $tagtitle,
				'meta_description' 	=> $tagdesc,
				'meta_keyword' 		=> $tagkeyword,
				'updateddate'		=> date("Y-m-d"),
				'seq'				=> $seq
			);
			$result = $this->db->update('cm_post', $data, array('id' => $id) );
			if($result){
				echo 'Data berhasil diubah.';
			} else {
				echo 'Data gagal diubah.';
			}

		} else {
			$data = array(
				'id'				=> null,
				'post_title' 		=> $title,
				'photo'				=> null,
				'post_content' 		=> $desc,
				'categorycode'		=> null,
				'post_type'			=> 'page',
				'post_date' 		=> date("Y-m-d"),
				'publish' 			=> '1',
				'tag'				=> null,
				'rating'			=> 1,
				'viewer'			=> 0,
				'author' 			=> $userid ,
				'meta_title' 		=> $tagtitle,
				'meta_description' 	=> $tagdesc,
				'meta_keyword' 		=> $tagkeyword,
				'createddate'		=> date("Y-m-d"),
				'updateddate'		=> null,
				'seq'				=> $seq
			);
			$result = $this->db->insert('cm_post', $data); 
			if($result){
				echo 'Data berhasil disimpan.';
			} else {
				echo 'Data gagal disimpan.';
			}
		}

	}

	public function edit(){
		header('Content-type: application/json');
		$id = $this->input->get('id');

		$result = $this->db->query("SELECT * FROM cm_post WHERE id = '$id' ");
		foreach ($result->result_array() as $key => $r) {
			# code...
			$record['id'] = $r['id'];
			$record['post_title'] = $r['post_title'];
			$record['photo'] = $r['photo'];
			$record['post_content'] = $r['post_content'];
			$record['categorycode'] = $r['categorycode'];
			$record['post_type'] = $r['post_type'];
			$record['post_date'] = $r['post_date'];
			$record['publish'] = $r['publish'];
			$record['tag'] = $r['tag'];
			$record['rating'] = $r['rating'];
			$record['viewer'] = $r['viewer'];
			$record['author'] = $r['author'];
			$record['meta_title'] = $r['meta_title'];
			$record['meta_description'] = $r['meta_description'];
			$record['meta_keyword'] = $r['meta_keyword'];
			$record['createddate'] = $r['createddate'];
			$record['updateddate'] = $r['updateddate'];
			$record['seq'] = $r['seq'];

			$data[]=$record;
		}

		$hasil = json_encode($data);
		echo $hasil;
	}

	public function delete(){
		$id = $this->input->post("id");

		$del = $this->db->query("DELETE FROM cm_post WHERE id = '$id' ");
		if($del){
			echo 'Data telah dihapus';
		} else {
			echo 'Data gagal dihapus';
		}
	}
}