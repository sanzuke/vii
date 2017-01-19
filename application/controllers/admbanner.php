<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admbanner extends CI_Controller {

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

		$data['TITLE'] = 'Setting';
		$data['title'] = 'Admin das-PORTAL';
		$data['SUBTITLE'] = 'Banner';
		$data['BREADCRUMB'] = '';
		$data['MAINPAGE'] = 'Main Page';
		$data['MENU'] = 'Menu';
		$data['SUBMENU'] = 'Submenu';
		$data['SUBSUBMENU'] = 'Susbsubmenu';
		$data['USERID'] = $this->session->userdata('userid');
		$data['EMPCODE'] = 'ADMIN';

		$data['treemenu'] = $this->treemenu->get_tree_menu();
		$aktiftheme = 'default';
		$data['banner'] = $this->db->query("SELECT * FROM ss_banner")->result_array();

		$this->load->view('admin/adm_banner', $data);
	}

	public function add(){
		$shop_info = $this->shop_info->get_shop_info();
		$data['sitename'] = $shop_info['shopname'];
		$data['slogan'] = $shop_info['slogan'];
		$data['email'] = $shop_info['email'];
		$data['phone'] = $shop_info['phone'];
		$data['web'] = $shop_info['web'];
		$data['logo'] = $shop_info['logo'];
		$data['icon'] = $shop_info['icon'];

		$data['TITLE'] = 'Setting';
		$data['title'] = 'Admin das-PORTAL';
		$data['SUBTITLE'] = 'Banner';
		$data['BREADCRUMB'] = '';
		$data['MAINPAGE'] = 'Main Page';
		$data['MENU'] = 'Menu';
		$data['SUBMENU'] = 'Submenu';
		$data['SUBSUBMENU'] = 'Susbsubmenu';
		$data['USERID'] = $this->session->userdata('userid');
		$data['EMPCODE'] = 'ADMIN';

		$data['treemenu'] = $this->treemenu->get_tree_menu();
		$aktiftheme = 'default';
		$id = $this->uri->segment("3");
		$data["id"] = $id;
		if($id == ""){
			$data['banner'] = $this->db->query("SELECT * FROM ss_banner")->result_array();
		} else {
			$data['banner'] = $this->db->query("SELECT * FROM ss_banner WHERE id = '{$id}' ")->result_array();
		}

		$this->load->view('admin/adm_banner_add', $data);
	}

	public function uploadfoto(){
		//echo 'hohohooh....';
		$ket = $this->input->post("ket", TRUE);
		$title = $this->input->post("title", TRUE);
		$judul1 = $this->input->post("judul1", TRUE);
		$judul2 = $this->input->post("judul2", TRUE);
		$link1 = $this->input->post("link1", TRUE);
		$link2 = $this->input->post("link2", TRUE);
		$updateFile = $this->input->post("updateFile", TRUE);
		$judul = $judul1 ."|" .$judul2;
		$link = $link1 ."|" .$link2;
		$config['upload_path'] = './uploads/banner/';
		$config['allowed_types'] = 'gif|jpg|png';
		//$config['file_name'] = 'userfile';
		$config['max_size']	= '10000000000';
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';
		$this->load->library('upload',$config);
		//$field_name = "video";

		if($updateFile == "false"){
			if ( ! $this->upload->do_upload() )
			{
				$error = array('error' => $this->upload->display_errors());
				//$this->load->view('upload_form', $error);
				// print_r';($error);
				echo $error['error'];
				//shell_exec("ffmpeg -i ".$config['upload_path']. $error['file_name']."  -y -an -sameq -f image2 -s 400x270 ./uploads/mythumb.jpg");
			}
			else
			{
				$dataup = array('upload_data' => $this->upload->data());
				foreach ($dataup as $key => $value) {
					# code...
					$record['file_name'] = $value['file_name']; //    => mypic.jpg
				    $record['file_type'] = $value['file_type'];    //=> image/jpeg
				    $record['file_path'] = $value['file_path'];    //=> /path/to/your/upload/
				    $record['full_path'] = $value['full_path'];    //=> /path/to/your/upload/jpg.jpg
				    $record['raw_name'] = $value['raw_name'];     //=> mypic
				    $record['orig_name'] = $value['orig_name'];    //=> mypic.jpg
				   	$record['client_name'] = $value['client_name'];  //=> mypic.jpg
				    $record['file_ext'] = $value['file_ext'];     //=> .jpg
				    $record['file_size'] = $value['file_size'];    //=> 22.2
				    $record['is_image'] = $value['is_image'];     //=> 1
				    $record['image_width'] = $value['image_width'];  //=> 800
				    $record['image_height'] = $value['image_height']; //=> 600
				    $record['image_type'] = $value['image_type'];   //=> jpeg
				    $record['image_size_str'] = $value['image_size_str'];// => width="800" height="200"
				    $data[] =$record;
				    //secho $record['file_path']."thumb/".$record['raw_name'];
				    $this->db->query("INSERT ss_banner VALUES(NULL,'".$value['file_name']."','{$title}','{$ket}','1','{$link}', '{$judul}')");
				}
			} else {
				if()

			}
			//imageResize($record['file_name'],"223x223");
			/*$config['image_library'] = 'gd';
			$config['source_image'] = $record['full_path'];
			$config['new_image'] = $record['file_path']."thumb/".$record['raw_name'] ."_223x223".$record['file_ext'];
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 223;
			$config['height'] = 223;

			//$this->load->library('image_lib', $config);
			//$this->image_lib->initialize($config);
			$this->load->library('image_lib');
			// Set your config up
			$this->image_lib->initialize($config);

			//$div = $this->image_lib->resize();
			//$this->load->view('upload_success', $data);
			//echo json_encode($data);
			if ( ! $this->image_lib->resize())
			{
			    echo $this->image_lib->display_errors();
			}
			//echo 'Data berhasil diupload\n' . $div;
			// Do your manipulation
			$this->image_lib->clear();*/
		}
	}

	public function delBanner(){
		$id = $this->input->post("id",TRUE);
		$name = $this->input->post("name",TRUE);
		$q = $this->db->query("DELETE FROM ss_banner WHERE id= '{$id}' ");
		if($q){
			echo 'true';
			unlink(base_url() . 'uploads/banner/'.$name);
		} else {
			echo 'false';
		}
	}

	public function editBanner(){
		$id = $this->uri->segment("3");

		$del = $this->db->query("SELECT * FROM ss_banner WHERE id='$id'");
		if($del){
			$this->session->set_flashdata("note","Data telah dihapus");
		} else {
			$this->session->set_flashdata("note","Data gagal dihapus");
		}
		redirect("admbanner/add");
	}
}
?>
