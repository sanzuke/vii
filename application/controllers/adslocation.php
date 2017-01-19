<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adslocation extends CI_Controller {
	public function index()
	{
		$this->db->from('ss_menu');
		$query= $this->db->get();

		$qryList = $this->db->query("SELECT * FROM ss_adslocation");
		$var = '[';
		$i = 1;
		foreach ($qryList->result_array() as $row){
			if ($i <= $query->num_rows()){
				$var .= '"'.$row['placename'] . ' (' .$row['adslocationcode'].')",';
			} else {
				$var .= '"'.$row['placename'] . ' (' .$row['adslocationcode'].')"';
			}
			$i++;
		}
		$var .= ']';

		$data['listlocation'] = $var;
		$data['query'] = $query->result();
		$data['TITLE'] = 'Ads Location';
		$data['title'] = 'Admin das-PORTAL';
		$data['SUBTITLE'] = 'Position Advertising';
		$data['BREADCRUMB'] = '';
		$data['MAINPAGE'] = 'Main Page';
		$data['MENU'] = 'Menu';
		$data['SUBMENU'] = 'Submenu';
		$data['SUBSUBMENU'] = 'Susbsubmenu';
		$data['USERID'] = 'ADMIN';
		$data['EMPCODE'] = 'SANZUKE';
		
		$data['treemenu'] = $this->treemenu->get_tree_menu();


		$qryProvince = $this->db->query("SELECT * FROM ss_parametervalue WHERE parametercode = 'PROVINCE'");
		$var = '[';
		$i = 1;
		foreach ($qryProvince->result_array() as $row){
			if ($i <= $query->num_rows()){
				$var .= '"'.$row['parametervalue'] . ' (' .$row['parametervaluecode'].')",';
			} else {
				$var .= '"'.$row['parametervalue'] . ' (' .$row['parametervaluecode'].')"';
			}
			$i++;
		}
		$var .= ']';
		$data['datapropinsi'] = $var;

		$qryCity = $this->db->query("SELECT * FROM ss_parametervalue WHERE parametercode = 'CITY'");
		$var = '[';
		$i = 1;
		foreach ($qryCity->result_array() as $row){
			if ($i <= $query->num_rows()){
				$var .= '"'.$row['parametervalue'] . ' (' . $row['parametervaluecode'].')",';
			} else {
				$var .= '"'.$row['parametervalue'] . ' (' .$row['parametervaluecode'].')"';
			}
			$i++;
		}
		$var .= ']';
		$data['datakota'] = $var;
		
		$this->load->view('view_adslocation', $data);
	}

	public function savedata(){
		$str1  = explode( "(", $this->input->post("propinsi",TRUE) );
		$str2  = explode( "(", $this->input->post("kota",TRUE) );

		$loccode 		= $this->input->post("loccode",TRUE);
		$propinsi 		= str_replace(")", "", $str1[1]);
		$kota 			= str_replace(")", "", $str2[1]);
		$placename 		= $this->input->post("placename",TRUE);
		$opentime 		= $this->input->post("opentime",TRUE);
		$closetime 		= $this->input->post("closetime",TRUE);

		$q = $this->db->query("SELECT * FROM ss_adslocation WHERE adslocationcode = '$loccode' ");

		if( count($q->result_array()) >= 1 ){
			$data = array(
				'provincecode' => $propinsi,
				'citycode' => $kota,
				'status' => '0',
				'placename' => $placename,
				'openingtime' => $opentime,
				'closingtime' => $closetime
			);
			$result = $this->db->update('ss_adslocation', $data, array('adslocationcode' => $loccode));
			if($result){
				echo 'Data berhasil diubah.';
			} else {
				echo 'Data gagal diubah.';
			}

		} else {
			$data = array(
				'adslocationcode' => $loccode ,
				'provincecode' => $propinsi,
				'citycode' => $kota,
				'status' => '0',
				'placename' => $placename,
				'openingtime' => $opentime,
				'closingtime' => $closetime
			);
			$result = $this->db->insert('ss_adslocation', $data); 
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

