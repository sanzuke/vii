<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inputpattern extends CI_Controller {

	public function index()
	{
		$this->db->from('ss_menu');
		$query= $this->db->get();

		$qryList = $this->db->query("SELECT * FROM ss_pattern");
		

		$data['query'] = $qryList->result_array();
		$data['TITLE'] = 'Input Pattern';
		$data['title'] = 'Setting';
		$data['SUBTITLE'] = 'Activity Log';
		$data['BREADCRUMB'] = '';
		$data['MAINPAGE'] = 'Main Page';
		$data['MENU'] = 'Menu';
		$data['SUBMENU'] = 'Submenu';
		$data['SUBSUBMENU'] = 'Susbsubmenu';
		$data['USERID'] = 'ADMIN';
		$data['EMPCODE'] = 'SANZUKE';
		
		$data['treemenu'] = $this->treemenu->get_tree_menu();
		
		$this->load->view('view_inputpattern', $data);
	}

	public function savedata(){
		$tablename 		= $this->input->post("tablename",TRUE);
		$displaypattern = $this->input->post("displaypattern",TRUE);
		$editpattern 	= $this->input->post("editpattern",TRUE);

		$q = $this->db->query("SELECT * FROM ss_pattern WHERE tablename = '$tablename'");

		if( count($q->result_array()) >= 1 ){
			$data = array(
				'tablename' => $tablename,
				'displaypattern' => $displaypattern,
				'editpattern' => $editpattern,
				'bucode' => 'TGARSI',
				'updatedby' => 'ADMIN',
				'updateddate' => date("Y-m-d")
			);
			$result = $this->db->update('ss_pattern', $data, array('tablename' => $tablename));
			if($result){
				echo 'Data berhasil diubah.';
			} else {
				echo 'Data gagal diubah.';
			}

		} else {
			$data = array(
				'tablename' => $tablename,
				'displaypattern' => $displaypattern,
				'editpattern' => $editpattern,
				'bucode' => 'TGARSI',
				'createdby' => 'ADMIN',
				'createddate' => date("Y-m-d"),
				'updatedby' => NULL,
				'updateddate' => NULL
			);
			$result = $this->db->insert('ss_pattern', $data); 
			if($result){
				echo 'Data berhasil disimpan.';
			} else {
				echo 'Data gagal disimpan.';
			}
		}
	}

	public function deldata(){
		$tablename = $this->input->post("tablename",TRUE);
		$query = $this->db->query("DELETE FROM ss_pattern WHERE tablename = '$tablename' ");
		if($query){
			echo 'done';
		} else {
			echo 'fail';
		}
	}

	public function getdatadetail(){
		//$v_paramcode = $this->input->get("paramcode",TRUE);
		//$v_paramcode = $this->uri->segment(3, 0);
		$query = $this->db->query("SELECT * FROM ss_pattern ");

		//$query= $this->db->get();
		foreach ($query->result_array() as $row){
			$record['tablename'] = $row['tablename'];
			$record['displaypattern'] = $row['displaypattern'];
			$record['editpattern'] = $row['editpattern'];
			$data[] = $record;
		}
	
		echo json_encode($data);
	}
}