<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admproducts extends CI_Controller {

	public function index()
	{
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
		$data['TITLE'] = 'Produk';
		$data['title'] = 'Setting';
		$data['SUBTITLE'] = 'Tambah Baru';
		$data['BREADCRUMB'] = '';
		$data['MAINPAGE'] = 'Main Page';
		$data['MENU'] = 'Menu';
		$data['SUBMENU'] = 'Submenu';
		$data['SUBSUBMENU'] = 'Susbsubmenu';
		$data['USERID'] = 'ADMIN';
		$data['EMPCODE'] = 'SANZUKE';
		
		$data['treemenu'] = $this->treemenu->get_tree_menu();

		// Pagination 
		//$config['base_url'] 	= 'http://example.com/index.php/test/page/';
		$config['total_rows'] 	= 200;
		$config['per_page'] 	= 20;

		$this->pagination->initialize($config);

		//echo $this->pagination->create_links();
		$data['pagenumber'] =  $this->pagination->create_links();
		
		$this->load->view('admin/adm_products', $data);
	}

	public function getdatalist(){

		
		$query = $this->db->query("SELECT * FROM ss_products");

		//$query= $this->db->get();
		foreach ($query->result_array() as $row){
			$record['productcode'] = $row['productcode'];
			$record['productname'] = $row['productname'];
			//$record['categorycode'] = $row['categorycode'];
			//$record['categoryname'] = $row['categoryname'];
			//$record['suppliercode'] = $row['suppliercode'];
			//$record['suppliername'] = $row['suppliername'];
			$record['stock'] = $row['stock'];
			$record['price'] = $row['price'];
			$record['sale'] = $row['sale'];
			$record['poin'] = $row['poin'];
			$record['photo'] = $row['photo'];
			$record['description'] = $row['description'];
			$data[] = $record;
		}
	
		echo json_encode($data);

	}

	public function searchdatalist(){
		$productname = $this->input->get("productname");
		
		$query = $this->db->query("SELECT * FROM ss_products WHERE productname like '$productname%' ");

		$data ='';
		//$query= $this->db->get();
		foreach ($query->result_array() as $row){
			$record['productcode'] = $row['productcode'];
			$record['productname'] = $row['productname'];
			//$record['categorycode'] = $row['categorycode'];
			//$record['categoryname'] = $row['categoryname'];
			//$record['suppliercode'] = $row['suppliercode'];
			//$record['suppliername'] = $row['suppliername'];
			$record['stock'] = $row['stock'];
			$record['price'] = $row['price'];
			$record['sale'] = $row['sale'];
			$record['description'] = $row['description'];
			$data[] = $record;
		}
	
		echo json_encode($data);

	}

	public function geteditdata(){
		$productcode = $this->input->get("productcode");

		$query = $this->db->query("SELECT * FROM ss_products WHERE productcode = '$productcode' ");

		foreach ($query->result_array() as $row){
			$record['productcode'] = $row['productcode'];
			$record['productname'] = $row['productname'];
			$record['categorycode'] = $row['categorycode'];
			//$record['categoryname'] = $row['categoryname'];
			$record['suppliercode'] = $row['suppliercode'];
			//$record['suppliername'] = $row['suppliername'];
			$record['stock'] = $row['stock'];
			$record['price'] = $row['price'];
			$record['sale'] = $row['sale'];
			$record['description'] = $row['description'];
			$record['diskon'] = $row['diskon'];
			$record['meta_title'] = $row['meta_title'];
			$record['meta_description'] = $row['meta_description'];
			$record['meta_keyword'] = $row['meta_keyword'];
			$record['poin'] = $row['poin'];
			$record['photo'] = $row['photo'];
			$record['publish'] = $row['publish'];
			$data[] = $record;
		}
	
		echo json_encode($data);
	}

	public function savedata(){
		$productcode = $this->input->post("productcode", TRUE);
		$poin = $this->input->post("poin", TRUE);
		$productname = $this->input->post("productname", TRUE);
		$categorycode = $this->input->post("category", TRUE);
		$suppliercode = $this->input->post("supplier", TRUE);
		$stock = $this->input->post("stock", TRUE);
		$price = $this->input->post("price", TRUE);
		$sale = $this->input->post("sale", TRUE);
		$photo = $this->input->post("photo", TRUE);
		$publish = $this->input->post("publish", TRUE);
		$description = $this->input->post("description", TRUE);
		$metatitle = $this->input->post("metatitle", TRUE);
		$metadesc = $this->input->post("metadesc", TRUE);
		$metakeyword = $this->input->post("metakeyword", TRUE);
		$createdby = $this->input->post("userid", TRUE);
		$createddate = date("Y-m-d");
		$updatedby = $this->input->post("userid", TRUE);
		$updateddate = date("Y-m-d");


		$query = $this->db->query("SELECT * FROM ss_products WHERE productcode = '$productcode' ");
		if( count($query->result_array()) <= 0 ){
			$data = array(
			   'productcode' => $productcode ,
			   'poin' => $poin ,
			   'productname' => $productname,
			   'categorycode' => $categorycode,
			   'suppliercode' => $suppliercode,
			   'stock' => $stock,
			   'price' => $price,
			   'sale' => $sale,
			   'photo' => $photo,
			   'description' => $description,
			   'viewed' => 0,
			   'status' => 0,
			   'meta_title' => $metatitle,
			   'meta_description' => $metadesc,
			   'meta_keyword' => $metakeyword,
			   'createdby' => $createdby,
			   'createddate' => $createddate,
			   'updatedby' => null, //$updatedby,
			   'updateddate' => null, //$updateddate
			   'publish' => $publish
			);

			$result = $this->db->insert('ss_products', $data); 
			if($result){
				echo 'Data berhasil disimpan.';
			} else {
				echo 'Data gagal disimpan.';
			}
		} else {
			$data = array(
			   'poin' => $poin ,
			   'productname' => $productname,
			   'categorycode' => $categorycode,
			   'suppliercode' => $suppliercode,
			   'stock' => $stock,
			   'price' => $price,
			   'sale' => $sale,
			   'description' => $description,
			   'meta_title' => $metatitle,
			   'meta_description' => $metadesc,
			   'meta_keyword' => $metakeyword,
			   'updatedby' => $updatedby,
			   'updateddate' => $updateddate,
			   'publish' => $publish
			);

			$result = $this->db->update('ss_products', $data, array('productcode' => $productcode));
			if($result){
				echo 'Data berhasil diubah.';
			} else {
				echo 'Data gagal diubah.';
			}
		}
	}

	public function deldata(){
		$productcode = $this->input->post("productcode");

		$result = $this->db->query("DELETE FROM ss_products WHERE productcode = '$productcode' ");
		if($result){
			echo 'done';
		} else {
			echo 'fail';
		}
	}


	public function addproduct(){
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
		$data['TITLE'] = 'Produk';
		$data['title'] = 'Setting';
		$data['SUBTITLE'] = 'Tambah Baru';
		$data['BREADCRUMB'] = '';
		$data['MAINPAGE'] = 'Main Page';
		$data['MENU'] = 'Menu';
		$data['SUBMENU'] = 'Submenu';
		$data['SUBSUBMENU'] = 'Susbsubmenu';
		$data['USERID'] = 'ADMIN';
		$data['EMPCODE'] = 'SANZUKE';
		
		$data['treemenu'] = $this->treemenu->get_tree_menu();

		// Pagination 
		//$config['base_url'] 	= 'http://example.com/index.php/test/page/';
		$config['total_rows'] 	= 200;
		$config['per_page'] 	= 20;

		$this->pagination->initialize($config);

		//echo $this->pagination->create_links();
		$data['pagenumber'] =  $this->pagination->create_links();
		
		$this->load->view('admin/adm_productsdetail', $data);
	}

	public function editproduct(){
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
		$data['TITLE'] = 'Produk';
		$data['title'] = 'Setting';
		$data['SUBTITLE'] = 'Tambah Baru';
		$data['BREADCRUMB'] = '';
		$data['MAINPAGE'] = 'Main Page';
		$data['MENU'] = 'Menu';
		$data['SUBMENU'] = 'Submenu';
		$data['SUBSUBMENU'] = 'Susbsubmenu';
		$data['USERID'] = 'ADMIN';
		$data['EMPCODE'] = 'SANZUKE';
		
		$data['treemenu'] = $this->treemenu->get_tree_menu();

		// Pagination 
		//$config['base_url'] 	= 'http://example.com/index.php/test/page/';
		$config['total_rows'] 	= 200;
		$config['per_page'] 	= 20;

		$this->pagination->initialize($config);

		//echo $this->pagination->create_links();
		$data['pagenumber'] =  $this->pagination->create_links();
		
		$this->load->view('admin/adm_productsdetail', $data);
	}
	
	public function uploadfoto(){
		//echo 'hohohooh....';
		$productcode = $this->input->post("productcode", TRUE);
		$poin = $this->input->post("poin", TRUE);
		$productname = $this->input->post("productname", TRUE);
		$categorycode = $this->input->post("category", TRUE);
		$suppliercode = $this->input->post("supplier", TRUE);
		$stock = $this->input->post("stock", TRUE);
		$price = $this->input->post("price", TRUE);
		$sale = $this->input->post("sale", TRUE);
		$photo = $this->input->post("photo", TRUE);
		$publish = $this->input->post("publish", TRUE);
		$description = $this->input->post("description", TRUE);
		$metatitle = $this->input->post("metatitle", TRUE);
		$metadesc = $this->input->post("metadesc", TRUE);
		$metakeyword = $this->input->post("metakeyword", TRUE);
		$diskon = $this->input->post("diskon", TRUE);
		$createdby = $this->input->post("userid", TRUE);
		$createddate = date("Y-m-d");
		$updatedby = $this->input->post("userid", TRUE);
		$updateddate = date("Y-m-d");

		$userfile = $this->input->post("userfile", TRUE);

		$code = $productcode;
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		//$config['file_name'] = 'userfile';
		$config['max_size']	= '200';
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';

		$this->load->library('upload',$config);
		//$field_name = "video";
		if( isset($userfile) ){
			if ( ! $this->upload->do_upload() )
			{
				$error = array('error' => $this->upload->display_errors());
				//$this->load->view('upload_form', $error);
				print_r($error);
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

				$query = $this->db->query("SELECT * FROM ss_products WHERE productcode = '$productcode' ");
				if( count($query->result_array()) <= 0 ){
					$data = array(
					   'productcode' => $productcode ,
					   'poin' => $poin ,
					   'productname' => $productname,
					   'categorycode' => $categorycode,
					   'suppliercode' => $suppliercode,
					   'stock' => $stock,
					   'price' => $price,
					   'sale' => $sale,
					   'photo' => $value['file_name'],
					   'description' => $description,
					   'viewed' => 0,
					   'status' => 0,
					   'meta_title' => $metatitle,
					   'meta_description' => $metadesc,
					   'meta_keyword' => $metakeyword,
					   'diskon' => $diskon,
					   'createdby' => $createdby,
					   'createddate' => $createddate,
					   'updatedby' => null, //$updatedby,
					   'updateddate' => null, //$updateddate
					   'publish' => $publish
					);

					$result = $this->db->insert('ss_products', $data); 
					if($result){
						echo 'Data berhasil disimpan.';
					} else {
						echo 'Data gagal disimpan.';
					}
				} else {
					$data = array(
					   'poin' => $poin ,
					   'productname' => $productname,
					   'categorycode' => $categorycode,
					   'suppliercode' => $suppliercode,
					   'stock' => $stock,
					   'price' => $price,
					   'sale' => $sale,
					   'description' => $description,
					   'meta_title' => $metatitle,
					   'meta_description' => $metadesc,
					   'meta_keyword' => $metakeyword,
					   'updatedby' => $updatedby,
					   'updateddate' => $updateddate,
					   'publish' => $publish
					);

					$result = $this->db->update('ss_products', $data, array('productcode' => $productcode));
					if($result){
						echo 'Data berhasil diubah. file foto ada';
					} else {
						echo 'Data gagal diubah.';
					}
				}

				// ===================================== 
				// create thumbnail
				// =====================================
				//imageResize($record['file_name'],"223x223");
				$config['image_library'] = 'gd2';
				$config['source_image'] = $record['full_path']; 
				$config['new_image'] = $record['file_path']."thumb/".$record['raw_name'] .$record['file_ext']; 
				$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 223;
				$config['height'] = 223;

				//$this->load->library('image_lib', $config);
				//$this->image_lib->initialize($config);
				$this->load->library('image_lib', $config);
				// Set your config up
				$this->image_lib->initialize($config);
				
				//$div = $this->image_lib->resize();
				//$this->load->view('upload_success', $data);
				//echo json_encode($data);
				if ( ! $this->image_lib->resize())
				{
				    echo $this->image_lib->display_errors();
				}

				$config['image_library'] = 'gd2';
				$config['source_image']	= $record['full_path'];
				$config['new_image'] = $record['file_path']."/".$record['raw_name'] ."_750x500".$record['file_ext']; 
				$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['width']	= 750;
				$config['height']	= 500;

				$this->load->library('image_lib', $config); 

				$this->image_lib->resize();

				//echo 'Data berhasil diupload\n' . $div;
				// Do your manipulation
				$this->image_lib->clear();
			}
		} else {
			$data = array(
			   'poin' => $poin ,
			   'productname' => $productname,
			   'categorycode' => $categorycode,
			   'suppliercode' => $suppliercode,
			   'stock' => $stock,
			   'price' => $price,
			   'sale' => $sale,
			   'description' => $description,
			   'meta_title' => $metatitle,
			   'meta_description' => $metadesc,
			   'meta_keyword' => $metakeyword,
			   'updatedby' => $updatedby,
			   'updateddate' => $updateddate,
			   'publish' => $publish
			);

			$result = $this->db->update('ss_products', $data, array('productcode' => $productcode));
			if($result){
				echo 'Data berhasil diubah. file foto tak ada';
			} else {
				echo 'Data gagal diubah.';
			}
		}
	}

	function imageResize($imgName,$size){
		$tmp = explode("x", $size);
		$width = $tmp[0];
		$height = $tmp[1];
		$img_path =  realpath("img")."\\uploads\\thumb\\".$imgName.".jpg";
		
		// Configuration
		$config['image_library'] = 'gd2';
		$config['source_image'] = './uploads/'.$imgName.".jpg";
		$config['new_image'] = './uploads/thumb/'.$imgName."_".$size.".jpg";
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = $width;
		$config['height'] = $height;

		// Load the Library
		$this->load->library('image_lib', $config);
		
		// resize image
		$this->image_lib->resize();
		// handle if there is any problem
		if ( ! $this->image_lib->resize()){
			echo $this->image_lib->display_errors();
		}
	}


	public function loadsizeproduct(){
		$productcode = $this->input->get("productcode", TRUE);

		$q= $this->db->query("SELECT * FROM ss_sizeproducts WHERE productcode = '$productcode'");
		foreach ($q->result_array() as $key => $row) {
			# code...
			$rec['productcode'] = $row['productcode'];
			$rec['size'] = $row['size'];
			$rec['jumlah'] = $row['jumlah'];
			$data[] = $rec;
		}
		echo json_encode($data);
	}

	public function savesizeproduct(){
		$productcode = $this->input->post("productcode", TRUE);
		$size = $this->input->post("size", TRUE);
		$jumlah = $this->input->post("jumlah", TRUE);

		$q = $this->db->query("SELECT * FROM ss_sizeproducts WHERE productcode = '$productcode' AND size ='$size' ");
		$jml = count($q->result_array());

		if($jml >0){
			$data = array(
				"size" => $size,
				"jumlah" => $jumlah,
				"updateddate" => date("m-d-Y H:i:s")
			);	

			$update = $this->db->update("ss_sizeproducts", $data, array('productcode'=>$productcode, 'size' => $size) );
			if($update){
				$msg = 'Data telah diubah';
			} else {
				$msg = 'Data gagal diubah';
			}
		} else {
			$data = array(
				"productcode" => $productcode,
				"size" => $size,
				"jumlah" => $jumlah,
				"createddate" => date("m-d-Y H:i:s"),
				"updateddate" => null
			);
			$insert = $this->db->insert("ss_sizeproducts", $data);
			if($insert){
				$msg = 'Data telah disimpan';
			} else {
				$msg = 'Data gagal disimpan';
			}
		}

		echo $msg;
	}

	public function loadcolorproduct(){
		$productcode = $this->input->get("productcode", TRUE);

		$q= $this->db->query("SELECT * FROM ss_colorproducts WHERE productcode = '$productcode' ");
		foreach ($q->result_array() as $key => $row) {
			# code...
			$rec['productcode'] = $row['productcode'];
			$rec['color'] = $row['color'];
			$rec['jumlah'] = $row['jumlah'];
			$data[] = $rec;
		}
		echo json_encode($data);
	}

	public function savecolorproduct(){
		$productcode = $this->input->post("productcode", TRUE);
		$color = $this->input->post("color", TRUE);
		$jumlah = $this->input->post("jumlah", TRUE);

		$q = $this->db->query("SELECT * FROM ss_colorproducts WHERE productcode = '$productcode' AND color ='$color' ");
		$jml = count($q->result_array());

		if($jml >0){
			$data = array(
				"color" => $color,
				"jumlah" => $jumlah,
				"updateddate" => date("m-d-Y H:i:s")
			);

			$update = $this->db->update("ss_colorproducts", $data, array('productcode'=>$productcode, 'color' => $color) );
			if($update){
				$msg = 'Data telah diubah';
			} else {
				$msg = 'Data gagal diubah';
			}
		} else {
			$data = array(
				"productcode" => $productcode,
				"color" => $color,
				"jumlah" => $jumlah,
				"createddate" => date("m-d-Y H:i:s"),
				"updateddate" => null
			);
			$insert = $this->db->insert("ss_colorproducts", $data);
			if($insert){
				$msg = 'Data telah disimpan';
			} else {
				$msg = 'Data gagal disimpan';
			}
		}

		echo $msg;
	}

}