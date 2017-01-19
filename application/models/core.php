<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class core extends CI_Model {

	var $strUrlReplace = array ('&',' ','#');
    var $shopname ='';
    var $shopweb = '';
    var $shoptelp = '';
    var $shopemail = '';
    var $shopaddress = '';
    var $open_day = '';
    var $open_hour = '';
    var $wa = '';
    var $line = '';
    var $bbm = '';

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $getShopInfo = $this->db->query("SELECT * FROM ss_shopinfo WHERE id = '1'");
        $rows = $getShopInfo->row();

        $this->shopname = $rows->shopname;
        $this->shopweb = $rows->web;
        $this->shoptelp = $rows->phone;
        $this->shopemail = $rows->email;
        $this->shopaddress = $rows->address;
        $this->open_day = $rows->open_day;
        $this->open_hour = $rows->open_hour;
        $this->wa = $rows->wa;
        $this->line = $rows->line;
        $this->bbm = $rows->bbm;
    }

    // ================================ //
    // Shop Information Function
    // ================================ //

    function getShop($val){
        switch ($val) {
            case 'name': return $this->shopname; break;
            case 'address': return $this->shopaddress; break;
            case 'phone': return $this->shoptelp; break;
            case 'email': return $this->shopemail; break;
            case 'web': return $this->shopweb; break;
            case 'open_day': return $this->open_day; break;
            case 'open_hour': return $this->open_hour; break;
            case 'wa': return $this->wa; break;
            case 'line': return $this->line; break;
            case 'bbm': return $this->bbm; break;
        }
    }

    function getFooterImg(){
        $get = $this->db->query("SELECT parametervalue, options FROM ss_parametervalue WHERE parametercode = 'FOOTERIMG' AND parametervaluecode='IMG1'");
        $rows = $get->row();
        if($rows->options != ""){
            $path = base_url() . 'uploads/'.$rows->options;
        } else {
            $path = base_url() . 'themes/'.$theme.'/assets/'.$rows->options;
        }

        return $path;
    }

    // ====================================== //
    // Social Media
    // ====================================== //

    function getLinkSosMed(){
        $getSM = $this->db->query("SELECT * FROM ss_parametervalue WHERE parametercode = 'SOSMED' ");
        $str = '<ul>';
        foreach ($getSM->result_array() as $key => $value) {
            $opt = explode("|", $value['options']);
            $str .= '<li><a href="'.$opt[0].'" target="_blank" title="'.$value['parametervalue'].'"><i class="'.$opt[1].'"></i></a></li>';
        }
        $str .= '</ul>';

        return $str;
    }

    // ====================================== //
    // Nav //
    // ====================================== //
    function listNavPage(){

    	$qpage = $this->db->query("SELECT * FROM cm_post WHERE post_type = 'page' AND publish = '1' ");
    	foreach($qpage->result_array() as $r){
    		$title = str_replace($this->strUrlReplace, "-", strtolower($r['post_title']) ) . ".html";

    		$record['id'] = $r['id']; 
    		$record['post_title'] = $r['post_title']; 
    		$record['post_content'] = $r['post_content']; 
    		$record['meta_title'] = $r['meta_title']; 
    		$record['meta_description'] = $r['meta_description']; 
    		$record['meta_keyword'] = $r['meta_keyword']; 
    		$record['uri_page'] = base_url().'page/view/'.$r['id'] .'/'.$title; 
    		$page[] = $record;
    	}

    	return $page;
    }

    function listNavCategory(){

    	$qpage = $this->db->query("SELECT * FROM ss_category WHERE publish = '1' AND parent = '0' ");
    	foreach($qpage->result_array() as $r){
    		$title = str_replace($this->strUrlReplace, "-", strtolower($r['categoryname']) ) . ".html";

    		$record['categorycode'] = $r['categorycode']; 
    		$record['categoryname'] = $r['categoryname']; 
    		$record['parent'] = $r['parent']; 
    		$record['uri_category'] = base_url().'category/view/'.$r['categorycode'] .'/'.$title; 
    		$category[] = $record;
    	}

    	return $category;
    }

    function listNavSubCategory($parent){

        $qpage = $this->db->query("SELECT * FROM ss_category WHERE publish = '1' AND parent = '$parent' ");
        foreach($qpage->result_array() as $r){
            $title = str_replace($this->strUrlReplace, "-", strtolower($r['categoryname']) ) . ".html";

            $record['categorycode'] = $r['categorycode']; 
            $record['categoryname'] = $r['categoryname']; 
            $record['parent'] = $r['parent']; 
            $record['uri_category'] = base_url().'category/view/'.$r['categorycode'] .'/'.$title; 
            $category[] = $record;
        }

        return $qpage;
    }

    // ====================================== //
    // Dashboard //
    // ====================================== //
    function listLastProduct(){
    	$q = $this->db->query("SELECT a.*, b.discount, a.price - ( (b.discount/100) * a.price) as hargadisk 
            FROM ss_products a
        LEFT JOIN ss_promotiondetails b ON a.productcode = b.productcode
        WHERE a.publish = '1' 
        ORDER BY a.createddate DESC LIMIT 10");

    	$produk = $q->result_array();
    	return $produk;
    }

    function widgetPromo(){
    	$q =  $this->db->query("SELECT * FROM vw_promoperitem LIMIT 5");

    	$promo = $q->result_array();
    	return $promo;
    }

    // ====================================== //
    // Category //
    // ====================================== //
    function listCategoryProduct($id){
    	$q = $this->db->query("SELECT a.*,
				b.discount,
				a.sale - ( (b.discount/100) * a.sale) as hargadisk
			  FROM 
				ss_products a
				LEFT JOIN ss_promotiondetails b ON b.productcode = a.productcode
			WHERE a.publish = '1' 
			  AND a.categorycode = '$id'
			ORDER BY createddate DESC LIMIT 10");
    	
    	$produk = $q->result_array();
    	return $produk;
    }

    function titleCategoryPage($id){
    	$q = $this->db->query("SELECT categoryname FROM ss_category WHERE publish = '1' AND categorycode = '$id'");

    	foreach($q->result_array() as $row){
    		$titleCategory = $row['categoryname'];
    	}
    	return $titleCategory;
    }

    // ====================================== //
    // Single Product //
    // ====================================== //
    function singleProduct($id){
    	$q = $this->db->query("SELECT a.*,
				b.discount,
				a.price - ( (b.discount/100) * a.price) as hargadisk,
                c.categoryname as namakategori
			  FROM 
				ss_products a
				LEFT JOIN ss_promotiondetails b ON b.productcode = a.productcode
                LEFT JOIN ss_category c ON c.categorycode = a.categorycode
			WHERE a.publish = '1' 
			  AND a.productcode = '$id'
			ORDER BY createddate DESC LIMIT 10");

    	$produk = $q->result_array();
    	return $produk;
    }

    function relateproduct($id){
        $q = $this->db->query("SELECT a.*,
                b.discount,
                a.price - ( (b.discount/100) * a.price) as hargadisk
              FROM 
                ss_products a
                LEFT JOIN ss_promotiondetails b ON b.productcode = a.productcode
            WHERE a.publish = '1' 
              AND a.productcode NOT IN ('{$id}')
              AND a.categorycode = (SELECT categorycode FROM ss_products WHERE productcode = '{$id}')
            ORDER BY createddate DESC LIMIT 3");

        $produk = $q->result_array();
        return $produk;
    }

    function titleProduct($id){
    	$q = $this->db->query("SELECT productname FROM ss_products WHERE publish = '1' AND productcode = '$id'");

    	foreach($q->result_array() as $row){
    		$titleProduct = $row['productname'];
    	}
    	return $titleProduct;
    }

    function sizeproduct($id){
        $q = $this->db->query("SELECT * FROM ss_sizeproducts WHERE productcode = '$id' ");
        $size = $q->result_array();
        return $size;
    }

    function colorproduct($id){
        $q = $this->db->query("SELECT * FROM ss_colorproducts WHERE productcode = '$id' ");
        $color = $q->result_array();
        return $color;
    }

    function otherimage($id){
        $otherimg = $this->db->query("SELECT * FROM ss_image WHERE productcode = '$id'");
        return $otherimg;
    }

    function loadbanner(){
        $q = $this->db->query("SELECT * FROM ss_banner where publish = '1' ");
        $banner = $q->result_array();
        return $banner;
    }

    // ====================================== //
    // begin function review
    // ====================================== //
    function countreview($code){
        $q = $this->db->query("SELECT productcode FROM um_reviews WHERE productcode = '$code' AND publish = '1' ");
        return $q->num_rows();
    }

    function listreview($code){
        $q = $this->db->query("SELECT rv.*, us.name 
                FROM um_reviews rv, ss_user us 
                WHERE rv.productcode = '$code' 
                  AND rv.usercode = us.usercode");
        $reviewList = '<ul class="list-group">';
        if( count($q->result_array()) > 0){
            foreach ($q->result_array() as $key) {
                $reviewList .= '<li class="list-group-item" style="padding:10px;"><b><i class="fa fa-user"></i> '.$key['name'].'</b><br>'.$key['review'].'</li>';
            }
        } else {
            $reviewList .= '<p align="center">Belum ada review</p>';
        }
        $reviewList .= '</ul>';
        return $reviewList;
    }

    function getstarreview($code){
        $q = $this->db->query("SELECT productcode FROM um_reviews WHERE productcode = '$code' AND publish = '1' ");
        $jmlReview = $q->num_rows();
    }


    function mainPageContent(){
        $get = $this->db->query("SELECT post_content FROM cm_post WHERE post_title = 'Main Page' AND publish = '1'");
        $r = $get->row();
        return $r->post_content;
    }


    // ====================================== //
    // Kode transaksi
    // ====================================== //
    function generatekode($trx){
        $currDate = date("m-Y");
        $tanggal = date("my");
        
        $seq = $this->db->query("SELECT * FROM ss_kodetransaksi WHERE transaksi = '$trx' ");
        $rows = $seq->row();

        if($currDate == $rows->bulan){
            $seqNo = $rows->seq+1;
            $up = $this->db->query("UPDATE ss_kodetransaksi SET seq = '$seqNo'  WHERE transaksi = '$trx' ");
        } else {
            $seqNo = 1;
            $up = $this->db->query("UPDATE ss_kodetransaksi SET seq = '$seqNo', bulan = '$currDate'  WHERE transaksi = '$trx' ");
        }

        //return $rows->kode .'-'.$tanggal.'-'. str_pad($seqNo, 4, '0', STR_PAD_LEFT);
        if($up){
            return true;
        } else {
            return false;
        }
    }

    function get_transaction_code($trx){
        //$tanggal = date("my");

        $seq = $this->db->query("SELECT * FROM ss_kodetransaksi WHERE transaksi = '$trx' ");
        $rows = $seq->row();

        $tgl = explode("-", $rows->bulan);
        $day = $tgl['0'];
        $bln = substr($tgl['1'], 2);
        $tanggal = $day.$bln;

        return $rows->kode .'-'.$tanggal.'-'. str_pad($rows->seq, 4, '0', STR_PAD_LEFT);
    }

    function updatekode($trx){
        $getSeq = $this->db->query("SELECT seq FROM ss_kodetransaksi WHERE transaksi = '$trx'");
        $get = $getSeq->row();
        $seq = $get->seq;

        $seqBaru = $seq+1;
        $new = $this->db->query("UPDATE ss_kodetransaksi SET seq = '$seqBaru' WHERE transaksi = '$trx' ");

        if($new){
            return true;
        } else {
            return false;
        }
    }

    // =============================================== //
    // Function sending Mail
    // =============================================== //

    function sendmail($email, $subject, $msg){
        //$getShopInfo = $this->db->query("SELECT * FROM ss_shopinfo WHERE id = '1'");
        //$rows = $getShopInfo->row();

        $from = 'no-reply'.$this->shopweb;
        $shopname = $this->shopname;

        $this->email->from($from, $shopname);
        $this->email->to($email); 
        //$this->email->cc('another@another-example.com'); 
        //$this->email->bcc('them@their-example.com'); 

        $this->email->subject($subject);
        $this->email->message($msg);  

        $this->email->send();
    }

    function templateSendMail($search, $replace){
        $getTmp = $this->db->query("SELECT pesan FROM ss_templatemessage WHERE nama = 'EMAILORDER' ");
        $rows = $getTmp->row();

        $str = str_replace($search, $replace, $rows->pesan);

        return $str;
    }

    // =============================================== //
    // Function sending SMS
    // =============================================== //

    function sendSMS($phone, $msg){
        $getLink = $this->getValueOpt('smsgateway_link');
        $getUser = $this->getValueOpt('smsgateway_user');
        $getPass = $this->getValueOpt('smsgateway_pass');
        
        $url = $getLink;// "http://reguler.zenziva.net/apps/smsapi.php?";
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey='.$getUser.'&passkey='.$getPass.'&phone='.$phone.'&msg='.urlencode($msg));
        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
        curl_setopt($curlHandle, CURLOPT_POST, 1);
        $results = curl_exec($curlHandle);
        curl_close($curlHandle);

        return $results;
    }

    function templateSendSMS($search, $replace){
        $getTmp = $this->db->query("SELECT pesan FROM ss_templatemessage WHERE nama = 'SMSORDER' ");
        $rows = $getTmp->row();

        $str = str_replace($search, $replace, $rows->pesan);

        return $str;
    }

    // =============================================== //
    // Option seting
    // =============================================== //
    function getValueOpt($name){
        $name = $this->db->query("SELECT * FROM ss_options WHERE name = '$name'");
        $result = '';
        if($name->num_rows() > 0){
            $r = $name->row();
            $result = $r->value;
        } 
        return $result;
    }

    function updateValueOpt($name, $value){
        $up = $this->db->query("UPDATE ss_options SET value = '$value' WHERE name = '$name' ");
        return $up;
    }


    // =============================================== //
    // Other function
    // =============================================== //
    function generateuniqkode($pass_len){

        $allchars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'; 
        //$allchars = array ($a, "a", "b", "c", "5", "8");
        $string = ''; 
        mt_srand ((double) microtime() * 1000000); 
        for ($i = 0; $i < $pass_len; $i++) { 
            $string .= $allchars{mt_rand (0,strlen($allchars))}; 
        }
        return $string;
    }
}
?>
