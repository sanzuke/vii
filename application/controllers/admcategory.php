
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admcategory extends CI_Controller {

	public function index()
	{
		$query = $this->db->query("SELECT * FROM ss_category WHERE parent = '0'");
		$qryList = $this->db->query("SELECT * FROM ss_category");
		
		$shop_info = $this->shop_info->get_shop_info();
		$data['sitename'] = $shop_info['shopname'];
		$data['slogan'] = $shop_info['slogan'];
		$data['email'] = $shop_info['email'];
		$data['phone'] = $shop_info['phone'];
		$data['web'] = $shop_info['web'];
		$data['logo'] = $shop_info['logo'];
		$data['icon'] = $shop_info['icon'];

		$data['query'] = $query->result_array();
		$data['TITLE'] = 'Kategori';
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
		
		
		$this->load->view('admin/adm_category', $data);
	}

	public function savecategory(){

		$v_categorycode = $this->input->post("categorycode",TRUE);
		$v_categoryname = $this->input->post("categoryname",TRUE);
		$v_parentcode = $this->input->post("parent",TRUE);

		if($v_categorycode == ""){
			$query = $this->db->query("SELECT * FROM ss_category WHERE categoryname = '$v_categoryname' AND parent = '$v_parentcode' ");
		} else {
			$query = $this->db->query("SELECT * FROM ss_category WHERE categorycode = '$v_categorycode' AND parent = '$v_parentcode' ");
		}
		if( count($query->result_array()) <= 0 ){
			$data = array(
			   'categorycode' => '' ,
			   'categoryname' => $v_categoryname,
			   'parent' => $v_parentcode,
			   'createdby' => date("Y-m-d"),
			   'createddate' =>  'ADMIN',
			   'updatedby' =>  '',
			   'updateddate' => ''
			);

			$result = $this->db->insert('ss_category', $data); 
			if($result){
				echo 'Data berhasil disimpan.';
			} else {
				echo 'Data gagal disimpan.';
			}

		} else {
			$data = array(
			   'categoryname' => $v_categoryname,
			   'parent' => $v_parentcode,
			   'updatedby' => date("Y-m-d"),
			   'updateddate' =>  'ADMIN'
			);

			$result = $this->db->update('ss_category', $data, array('categorycode' => $v_categorycode));
			if($result){
				echo 'Data berhasil diubah.';
			} else {
				echo 'Data gagal diubah.';
			}
		}
	}

	public function deldata(){
		$v_categorycode = $this->input->post("categorycode",TRUE);
		$query = $this->db->query("DELETE FROM ss_category WHERE categorycode = '$v_categorycode' ");
		if($query){
			echo 'done';
		} else {
			echo 'fail';
		}
	}

	public function getdatadetail(){
		//$v_paramcode = $this->input->get("paramcode",TRUE);
		//$v_paramcode = $this->uri->segment(3, 0);
		$query = $this->db->query("SELECT * FROM ss_category");

		//$query= $this->db->get();
		foreach ($query->result_array() as $row){
			$record['categorycode'] = $row['categorycode'];
			$record['categoryname'] = $row['categoryname'];
			$record['parent'] = $row['parent'];
			$data[] = $record;
		}
	
		echo json_encode($data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

