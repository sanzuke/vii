
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Generalparameter extends CI_Controller {
	public function index()
	{
		$this->db->from('ss_parameter');
		$query= $this->db->get();
		$var = '[';
		$i = 1;
		foreach ($query->result_array() as $row){
			if ($i <= $query->num_rows()){
				$var .= '"'.$row['parametercode'].'",';
			} else {
				$var .= '"'.$row['parametercode'].'"';
			}
			$i++;
		}
		$var .= ']';
		$data['dataparam'] = $var;
		$data['TITLE'] = 'General Parameter';
		$data['title'] = 'Admin das-PORTAL';
		$data['SUBTITLE'] = 'Setting';
		$data['BREADCRUMB'] = '';
		$data['MAINPAGE'] = 'Main Page';
		$data['MENU'] = 'Menu';
		$data['SUBMENU'] = 'Submenu';
		$data['SUBSUBMENU'] = 'Susbsubmenu';
		$data['USERID'] = 'ADMIN';
		$data['EMPCODE'] = 'SANZUKE';
		
		$data['treemenu'] = $this->treemenu->get_tree_menu();
		
		$this->load->view('view_generalparameter', $data);
	}

	public function getdata(){
		$v_paramcode = $this->input->post("paramcode",TRUE);
		//$v_paramcode = $this->uri->segment(4, 0);
		$query = $this->db->query("SELECT * FROM ss_parameter WHERE parametercode = '$v_paramcode' ");
		$var ='';
		//$query= $this->db->get();
		foreach ($query->result_array() as $row){
			$var = $row['parametercode'] ."|" . $row['parametername'];
		}
	
		echo $var;
	}

	public function getdatadetail(){
		$v_paramcode = $this->input->get("paramcode",TRUE);
		//$v_paramcode = $this->uri->segment(3, 0);
		$query = $this->db->query("SELECT * FROM ss_parametervalue WHERE parametercode = '$v_paramcode' ");

		//$query= $this->db->get();
		foreach ($query->result_array() as $row){
			$record['parametervaluecode'] = $row['parametervaluecode'];
			$record['parametervalue'] = $row['parametervalue'];
			$data[] = $record;
		}
	
		echo json_encode($data);
	}

	public function savedatadetail(){
		$paramcode 		= $this->input->post("paramcode",TRUE);
		$paramvaluecode = $this->input->post("paramvaluecode",TRUE);
		$paramname 		= $this->input->post("paramname",TRUE);

		$q = $this->db->query("SELECT * FROM ss_parametervalue WHERE parametercode = '$paramcode' AND parametervaluecode = '$paramvaluecode' ");

		if( count($q->result_array()) >= 1 ){
			$data = array(
				'parametercode' => $paramcode,
				'parametervaluecode' => $paramvaluecode,
				'parametervalue' => $paramname,
				'bucode' => 'TGARSI',
				'updatedby' => 'ADMIN',
				'updateddate' => date("Y-m-d")
			);
			$result = $this->db->update('ss_parametervalue', $data, array('parametercode' => $paramcode, 'parametervaluecode' => $paramvaluecode));
			if($result){
				echo 'Data berhasil diubah.';
			} else {
				echo 'Data gagal diubah.';
			}

		} else {
			$data = array(
				'parametercode' => $paramcode,
				'parametervaluecode' => $paramvaluecode,
				'parametervalue' => $paramname,
				'createdby' => 'ADMIN',
				'createddate' => date("Y-m-d"),
				'updatedby' => NULL,
				'updateddate' => NULL,
				'bucode' => 'TGARSI'
			);
			$result = $this->db->insert('ss_parametervalue', $data); 
			if($result){
				echo 'Data berhasil disimpan.';
			} else {
				echo 'Data gagal disimpan.';
			}
		}
	}

	public function savedata(){
		$parametercode 		= $this->input->post("parametercode",TRUE);
		$parametername 		= $this->input->post("parametername",TRUE);

		$q = $this->db->query("SELECT * FROM ss_parameter WHERE parametercode = '$parametercode' ");

		if( count($q->result_array()) >= 1 ){
			$data = array(
				'parametercode' => $parametercode,
				'parametername' => $parametername,
				'bucode' => 'TGARSI',
				'updatedby' => 'ADMIN',
				'updateddate' => date("Y-m-d")
			);
			$result = $this->db->update('ss_parameter', $data, array('parametercode' => $parametercode));
			if($result){
				echo 'Data berhasil diubah.';
			} else {
				echo 'Data gagal diubah.';
			}

		} else {
			$data = array(
				'parametercode' => $parametercode,
				'parametername' => $parametername,
				'createdby' => 'ADMIN',
				'createddate' => date("Y-m-d"),
				'updatedby' => NULL,
				'updateddate' => NULL,
				'bucode' => 'TGARSI'
			);
			$result = $this->db->insert('ss_parameter', $data); 
			if($result){
				echo 'Data berhasil disimpan.';
			} else {
				echo 'Data gagal disimpan.';
			}
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

