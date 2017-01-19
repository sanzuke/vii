<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class shop_info extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_shop_info()
    {
        $select = $this->db->query("SELECT * FROM ss_shopinfo WHERE id ='1'");
        foreach ($select->result_array() as $key => $value) {
            # code...
            $shopinfo['shopname'] = $value['shopname'];
            $shopinfo['slogan'] = $value['slogan'];
            $shopinfo['email'] = $value['email'];
            $shopinfo['phone'] = $value['phone'];
            $shopinfo['address'] = $value['address'];
            $shopinfo['web'] = $value['web'];
            $shopinfo['logo'] = $value['logo'];
            $shopinfo['icon'] = $value['icon'];

            $shopinfo['open_day'] = $value['open_day'];
            $shopinfo['open_hour'] = $value['open_hour'];
            $shopinfo['wa'] = $value['wa'];
            $shopinfo['line'] = $value['line'];
            $shopinfo['bbm'] = $value['bbm'];

        }
        return $shopinfo;
    }

    // Setting load

    function get_option(){
        $select = $this->db->query("SELECT * FROM ss_options WHERE autoload ='1'");
        $shopinfo = $select->result_array();
        return $shopinfo;
    }

    function get_option_theme(){
        $select = $this->db->query("SELECT * FROM ss_options WHERE autoload ='1' AND name = 'theme'");
        //$shopinfo = $select->result_array();
        $theme = 'default';
        foreach ($select->result_array()as $key => $row) {
            # code...
            $theme = $row['value'];
        }
        return $theme;
    }

    function get_option_themeurl(){
        $select = $this->db->query("SELECT * FROM ss_options WHERE autoload ='1' AND name = 'themeurl'");
        //$shopinfo = $select->result_array();
        $themeurl = 'application/views/theme/';
        foreach ($select->result_array()as $key => $row) {
            # code...
            $themeurl = $row['value'];
        }
        return $themeurl;
    }

}