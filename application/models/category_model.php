<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_category_list()
    {
        $str ='';
        $qryKat = $this->db->query("select * from ss_category WHERE parent = '0' order by categorycode asc");
        $str .= '<ul>';
        foreach ($qryKat->result_array() as $rr){
            $str .= "<li><label>".ucwords(strtolower($rr['categoryname']))."</label> <button name=\"edit\" id=\"edit\" class=\"btn btn-info btn-sm\" >Edit</button><button name=\"edit\" id=\"edit\" class=\"btn btn-danger btn-sm\">Delete</button></li>";
            $qq = $this->db->query("select * from ss_category where parent='".$rr['categorycode']."'");
            $jum = count($qq->result_array());
            if($jum>0){
                //$qq=mysql_query("select * from kategori where child='".$rr['no']."' order by no asc");
                $str .= '<ul>';
                foreach ($qq->result_array() as $rrr){
                    $str .="<li><label>".ucwords(strtolower($rrr['categoryname']))."</label> <button name=\"edit\" id=\"edit\" class=\"btn btn-info btn-sm\">Edit</button><button name=\"edit\" id=\"edit\" class=\"btn btn-danger btn-sm\">Delete</button></li>";
                }
                $str .= '</ul>';
            }
        }
        $str .= '</ul>';   

        return $str;
    }

    function get_category_table(){
        $str ='';
        $qryKat = $this->db->query("select * from ss_category WHERE parent = '0' order by categorycode asc");
        //$str .= '<ul>';
        $x =1;
        foreach ($qryKat->result_array() as $rr){
            $str .= "<tr>
                        <td>".ucwords(strtolower($rr['categoryname']))."<input type='hidden' name='id_".$rr['categorycode']."' id='id_".$rr['categorycode']."' value='".$rr['categorycode']."' /></td>
                        <td><button name=\"edit\" type=\"button\" id=\"edit\" class=\"btn btn-info btn-sm\" onclick='editData(\"".$rr['categorycode']."\",\"".$rr['categoryname']."\",\"".$rr['parent']."\")'>Edit</button>
                            <button name=\"edit\" type=\"button\" id=\"edit\" class=\"btn btn-danger btn-sm\" onclick='delData(\"".$rr['categorycode']."\")'>Delete</button></td>
                    </tr>";
            $qq = $this->db->query("select * from ss_category where parent='".$rr['categorycode']."'");
            $jum = count($qq->result_array());
            if($jum>0){
                //$qq=mysql_query("select * from kategori where child='".$rr['no']."' order by no asc");
                $str .= '<ul>';
                foreach ($qq->result_array() as $rrr){
                    $str .="<tr>
                                <td>".ucwords(strtolower($rr['categoryname']))." > ".ucwords(strtolower($rrr['categoryname']))."<input type='hidden' name='id_".$rrr['categorycode']."' id='id_".$rrr['categorycode']."' value='".$rrr['categorycode']."' /></td>
                                <td><button name=\"edit\" type=\"button\" id=\"edit\" class=\"btn btn-info btn-sm\" onclick='editData(\"".$rrr['categorycode']."\",\"".$rrr['categoryname']."\",\"".$rrr['parent']."\")'>Edit</button>
                                    <button name=\"edit\" type=\"button\" id=\"edit\" class=\"btn btn-danger btn-sm\" onclick='delData(\"".$rrr['categorycode']."\")'>Delete</button></td>
                            </tr>";
                }
                $str .= '</ul>';
            }
            
        }
        //$str .= '</ul>';   

        return $str;
    }
}