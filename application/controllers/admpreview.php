<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admpreview extends CI_Controller {

	public function index(){
		$sup = $this->db->query("SELECT * FROM ss_products");


		$this->db->from('ss_products');
		$query= $this->db->get();
		$var = '[';
		$i = 1;
		foreach ($query->result_array() as $row){
			if ($i <= $query->num_rows()){
				$var .= '"'.$row['productname'].'",';
			} else {
				$var .= '"'.$row['productname'].'"';
			}
			$i++;
		}
		$var .= ']';

		$shop_info = $this->shop_info->get_shop_info();

		$data['sitename'] = $shop_info['shopname'];
		$data['slogan'] = $shop_info['slogan'];
		$data['email'] = $shop_info['email'];
		$data['phone'] = $shop_info['phone'];
		$data['web'] = $shop_info['web'];
		$data['logo'] = $shop_info['logo'];
		$data['icon'] = $shop_info['icon'];

		$data['query'] = $var; //$sup->result_array();
		$data['TITLE'] = 'Ulasan Produk';
		$data['title'] = 'Setting';
		$data['SUBTITLE'] = 'Produk';
		$data['BREADCRUMB'] = '';
		$data['MAINPAGE'] = 'Main Page';
		$data['MENU'] = 'Menu';
		$data['SUBMENU'] = 'Submenu';
		$data['SUBSUBMENU'] = 'Susbsubmenu';
		$data['USERID'] = 'ADMIN';
		$data['EMPCODE'] = 'SANZUKE';
		
		$data['treemenu'] = $this->treemenu->get_tree_menu();

		$data['query'] = $this->db->query("SELECT a.*, b.productname FROM um_productpreview a, ss_products b WHERE a.productcode = b.productcode");

		//echo $this->pagination->create_links();
		$data['pagenumber'] =  $this->pagination->create_links();
		
		$this->load->view('admin/adm_preview', $data);
	}

	public function addpreview(){
		$sup = $this->db->query("SELECT productcode, productname FROM ss_products ");


		// $this->db->from('ss_products');
		// $data['produk']= $this->db->get();

		$data['produk'] = $sup;

		$shop_info = $this->shop_info->get_shop_info();

		$data['sitename'] = $shop_info['shopname'];
		$data['slogan'] = $shop_info['slogan'];
		$data['email'] = $shop_info['email'];
		$data['phone'] = $shop_info['phone'];
		$data['web'] = $shop_info['web'];
		$data['logo'] = $shop_info['logo'];
		$data['icon'] = $shop_info['icon'];

		$data['TITLE'] = 'Tambah Ulasan Produk';
		$data['title'] = 'Setting';
		$data['SUBTITLE'] = 'Produk';
		$data['BREADCRUMB'] = '';
		$data['MAINPAGE'] = 'Main Page';
		$data['MENU'] = 'Menu';
		$data['SUBMENU'] = 'Submenu';
		$data['SUBSUBMENU'] = 'Susbsubmenu';
		$data['USERID'] = 'ADMIN';
		$data['EMPCODE'] = 'SANZUKE';
		
		$data['treemenu'] = $this->treemenu->get_tree_menu();

		$data['query'] = $this->db->query("SELECT a.*, b.productname FROM um_productpreview a, ss_products b WHERE a.productcode = b.productcode");

		//echo $this->pagination->create_links();
		$data['pagenumber'] =  $this->pagination->create_links();
		
		$this->load->view('admin/adm_previewadd', $data);
	}

	public function save(){
		//echo 'hohohooh....';
		$produk = $this->input->post("produk", TRUE);
		$judul = $this->input->post("judul", TRUE);
		$text = $this->input->post("keterangan", TRUE);
		$text_pos = $this->input->post("text-pos", TRUE);
		$kolom = $this->input->post("kolom", TRUE);
		$seq = $this->input->post("seq", TRUE);
		$id = $this->input->post("id", TRUE);

		$userfile = $this->input->post("userfile", TRUE);

		$code = $produk;
		$config['upload_path'] = './uploads/preview/';
		$config['allowed_types'] = 'gif|jpg|png';
		//$config['file_name'] = 'userfile';
		$config['max_size']	= '500';
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';

		$this->load->library('upload',$config);
		//$field_name = "video";
		if( isset($userfile) ){
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

				if( $id == ""){
					$data = array(
						'no' => null,
					   	'productcode' => $produk ,
					   	'judul' => $judul ,
					   	'text' => $text,
					   	'image' => $value['file_name'],
					   	'text-pos' => $text_pos,
					   	'kolom' => $kolom,
					   	'seq' => $seq
					);

					$result = $this->db->insert('um_productpreview', $data); 
					if($result){
						echo 'Data berhasil disimpan.';
					} else {
						echo 'Data gagal disimpan.';
					}
				} else {
					$data = array(
					   'judul' => $judul ,
					   'text' => $text,
					   'image' => $value['file_name'],
					   'text-pos' => $text_pos,
					   'kolom' => $kolom,
					   'seq' => $seq
					);

					$result = $this->db->update('um_productpreview', $data, array('no' => $id));
					if($result){
						echo 'Data berhasil diubah. file foto ada';
					} else {
						echo 'Data gagal diubah.';
					}
				}

				
			}
		} else {
			$data = array(
			   'productcode' => $produk ,
			   'judul' => $judul ,
			   'text' => $text,
			   'image' => $_FILES['userfile'],
			   'text-pos' => $text_pos,
			   'kolom' => $kolom,
			   'seq' => $seq
			);

			$result = $this->db->update('um_productpreview', $data, array('no' => $id));
			if($result){
				echo 'Data berhasil diubah. file foto tak ada';
			} else {
				echo 'Data gagal diubah.';
			}
		}
	}

	public function del(){
		$no = $this->input->post("no", TRUE);
		$img = $this->input->post("img", TRUE);

		$del = $this->db->query("DELETE FROM um_productpreview WHERE no = '$no' ");
		if($del){
			$imgPath = unlink("../uploads/preview/".$img);
			if($imgPath){
				echo 'Data telah dihapus';
			} else {
				echo 'File gagal dihapus';
			}
		} else {
			echo 'Data gagal dihapus';
		}
	}
}