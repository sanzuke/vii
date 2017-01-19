<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admfooterimg extends CI_Controller {

	public function index()
	{
		$this->db->from('ss_menu');
		$query= $this->db->get();

		$data['query'] = $query->result();
		$data['TITLE'] = 'Footer Image';
		$data['title'] = 'Admin san-PORTAL';
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

		$theme = $this->shop_info->get_option_theme();

		$get = $this->db->query("SELECT parametervalue, options FROM ss_parametervalue WHERE parametercode = 'FOOTERIMG' AND parametervaluecode='IMG1'");

		$rows = $get->row();
		$data['titleevent']= $rows->parametervalue;
		if($rows->options != ""){
			$data['img'] = base_url() . 'uploads/'.$rows->options;
		} else {
			$data['img'] = base_url() . 'themes/'.$theme.'/assets/'.$rows->options;
		}

		$this->load->view('admin/adm_footerimg', $data);
	}

	public function save(){
		$userfile = $this->input->post("footerimg", TRUE);
		$title = $this->input->post("title", TRUE);

		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		//$config['file_name'] = 'userfile';
		$config['max_size']	= '200';
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';

		$this->load->library('upload',$config);
		if ( ! $this->upload->do_upload() )
		{
			$error = array('error' => $this->upload->display_errors());
			//$this->load->view('upload_form', $error);
			//print_r($error);
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

			    //$this->db->query("UPDATE ss_products SET photo = '".$value['file_name']."' WHERE productcode = '$code' ");
			}

			//$query = $this->db->query("SELECT * FROM ss_products WHERE productcode = '$productcode' ");
			//if( count($query->result_array()) <= 0 ){
				$data = array(
					'parametervalue' => $title,
					'options' => $value['file_name']
				);

				$where = array('parametervaluecode'=>'IMG1','parametercode'=>'FOOTERIMG');

				$result = $this->db->update('ss_parametervalue', $data, $where); 
				if($result){
					echo 'Data berhasil disimpan.';
				} else {
					echo 'Data gagal disimpan.';
				}
			//}
		}
		redirect("admfooterimg");
	}
}