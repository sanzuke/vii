<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Treemenu extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_tree_menu()
    {
    	$currentlink = $this->uri->segment(1);
    	$parentcode = '';
    	$q = $this->db->query("SELECT parentcode FROM ss_menu WHERE furl = '$currentlink' ");
    	foreach ($q->result() as $brs)
		{
			$parentcode = $brs->parentcode;
		}

		$query = $this->db->query("SELECT * FROM ss_menu WHERE parentcode = '0' AND enable = '1' ORDER BY seq ASC ");
		
		$str = '<li id="dashboard">
					<a href="'.base_url().'dashboard">
						<i class="ion ion-speedometer"></i> <span>Beranda</span>
					</a>
				</li>';
				
		foreach ($query->result() as $row)
		{
			if($parentcode == $row->formcode){
				$parentActive = 'treeview active';
			} else {
				$parentActive = 'treeview';
			}
			$str .= '<li id="'.$row->formcode.'" class="'.$parentActive.'">
						<a href="'. base_url() .  $row->furl.'">
							<i class="ion '.$row->icon.'"></i> <span>'.$row->formname.'</span>
							<i class="fa pull-right fa-angle-left"></i>
						</a>';
						
			$qry = $this->db->query("SELECT * FROM ss_menu WHERE parentcode like '".$row->formcode."%' AND enable = '1' ORDER BY seq ASC ");
			$count = count($qry->result());
			//$str .= $count;
			if($count > 0){
				$str .= '<ul class="treeview-menu" >';
				foreach ($qry->result() as $r)
				{
					if($r->furl == $currentlink){
						$active = 'class="active"';
						$hijau  = ' hijau';
					} else {
						$active = '';
						$hijau  = '';
					}
					$str .= '<li id="'.$r->formcode.'" '.$active.'><a href="'. base_url() .  $r->furl.'"><i class="ion '.$r->icon.' '.$hijau.'"></i> '.$r->formname.'</a></li>';
				}
				$str .= '</ul></li>';
			} else {
				$str .='</li>';
			}
		} 
		return $str;
		//echo 'Model berhasil';
	}
    
    function get_last_ten_entries()
    {
        $query = $this->db->get('entries', 10);
        return $query->result();
    }

    function insert_entry()
    {
        $this->title   = $_POST['title']; // please read the below note
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->insert('entries', $this);
    }

    function update_entry()
    {
        $this->title   = $_POST['title'];
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->update('entries', $this, array('id' => $_POST['id']));
    }

}
?>
