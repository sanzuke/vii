<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function index()
	{
		$order = array();
		foreach ($this->cart->contents() as $r) {
			# code...
			//$rec['row_id'] = $r['row_id'];
			$rec['productcode'] = $r['id'];
			$rec['productname'] = $r['name'] ;
			$rec['price'] = $r['price'];
			$rec['qty'] = $r['qty'];
			$order[] = $rec;
		}
		echo json_encode($order);
	}

	public function add(){
		
		$productcode 	= $this->input->post('product_id', TRUE);
		$qty 			= $this->input->post('quantity', TRUE);
		$size 			= $this->input->post('size', TRUE);
		$color 			= $this->input->post('color', TRUE);
		$name 			= $this->input->post('pn', TRUE);;
		$price 			= $this->input->post('pr', TRUE);;

		$q = $this->db->query("SELECT productcode, productname, price, sale, diskon, photo, poin FROM ss_products WHERE productcode = '$productcode' ");
		foreach ($q->result_array() as $key => $row) {
			# code...
			$name = $row['productname'];
			$price= $row['sale'] - $row['diskon'];
			$photo= $row['photo'];
			$poin= $row['poin'];

			/*$record['productcode'] = $row['productcode'];
			$record['productname'] = $row['productcode'];
			$record['price'] = $row['productcode'];
			$record['qty'] = $qty;
			$data[] = $record;*/
		}

		$cart = array(
               'id'      => $productcode,
               'qty'     => $qty,
               'price'   => $price,
               'name'    => $name,
               'photo' => $photo,
               'options' => array('Size' => $size, 'Color' => $color)
            );

		$this->cart->insert($cart); 
		$order = array();
		foreach ($this->cart->contents() as $r) {
			# code...
			$rec['rowid'] = $r['rowid'];
			$rec['productcode'] = $r['id'];
			$rec['productname'] = $r['name'] ;
			$rec['price'] = $r['price'];
			$rec['qty'] = $r['qty'];
			$rec['photo'] = $r['photo'];
			$rec['poin'] = 0;//$r['poin'];
			$rec['size'] = $r['options']['Size'];
			$order[] = $rec;
		}
		//echo json_encode($order);
		//print_r($this->cart->contents());

		$checkout = $this->uri->segment("1");
	    if($checkout != 'checkout'){
	      
            $t = 0;
            foreach ($this->cart->contents() as $items){
                $t+= $items['subtotal'];
            }
            $isi['countitem'] = count($this->cart->contents());
            $isi['total'] = $this->cart->format_number($t);
            echo $this->load->view('cart', $isi, true); 
        }
	}

	public function removecart(){
		//$productcode 	= $this->input->post('product_id', TRUE);
		$rowid 			= $this->input->post('rowid', TRUE);

		$data = array(
			'rowid'   => $rowid,
			'qty'     => 0
		);

		$this->cart->update($data); 
	}

	public function emptycart(){
		$this->cart->destroy();
		//redirect("");
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}

	public function updatecartAll(){
		$jumRow = $this->input->post("jumRow", TRUE);
		$i = 1;
		$msg = '';

		while($i <= $jumRow){
			$rowid 			= $this->input->post('rowid'.$i, TRUE);
			$qty 			= $this->input->post('qty'.$i, TRUE);

			$data = array(
				'rowid'   => $rowid,
				'qty'     => $qty
			);

			$this->cart->update($data); 
			$i++;
			$msg .= 'rowid '.$i .' = ' . $rowid;
			$msg .= 'qty '.$i .' = ' . $qty;
		}
		//echo $msg;
	}

	public function updateperItem(){
		$rowid 			= $this->input->post('rowid', TRUE);
		$qty 			= 0; //$this->input->post('qty', TRUE);

		$data = array(
			'rowid'   => $rowid,
			'qty'     => $qty
		);

		$this->cart->update($data); 
	}

	public function savelangkah1(){
		//$str = $this->core->generatekode(10);
		//echo $str;
		$nama = $this->input->post("nama", TRUE);
		$alamat = $this->input->post("alamat", TRUE);
		$prop = $this->input->post("prop", TRUE);
		$kota = $this->input->post("kota", TRUE);
		$kec = $this->input->post("kec", TRUE);
		$telp = $this->input->post("telp", TRUE);
		$email = $this->input->post("email", TRUE);

		$setToArray =  array(
			"nama" => $nama,
			"alamat" => $alamat,
			"prop" => $prop,
			"kota" => $kota,
			"kec" => $kec,
			"telp" => $telp,
			"email" => $email,
		);

		$this->session->set_userdata("cusBioa", $setToArray);
		$jml = count( $this->session->userdata("cusBioa") ) ;
		if($jml > 0){
			echo 'true:langkah2';
			//redirect("checkout/langkah2");
			//print_r( $this->session->userdata("cusBioa") );
		} else {
			echo 'false';
		}

	}

	public function savelangkah2(){
		$payment = $this->input->post("payment", TRUE);
		$this->session->set_userdata("payment", $payment);
		echo 'true:langkah3';
	}

	public function savelangkah3(){
		$shipping = $this->input->post("shipping", TRUE);
		$this->session->set_userdata("shipping", $shipping);
		echo 'true:finishorder';
	}

	public function savefinishorder(){
		error_reporting(0);
		$nofak = $this->core->get_transaction_code('SALE');
		//$kode  =$this->core->generateuniqkode(10);

		$ket  = $this->input->post("ket", TRUE);
		$totBelanja = $this->input->post("totBelanja", TRUE);

		$bio = $this->session->userdata("cusBioa");
		$kec = explode("|", $bio['kec']);

		$data = array(
			'no' => null,
			'transactioncode' => $nofak,
			'nama' => $bio['nama'],
			'alamat' => $bio['alamat'],
			'prop' => $bio['prop'],
			'kota' => $bio['kota'],
			'kec' => $kec[3],
			'telp' => $bio['telp'],
			'email' => $bio['email'],
			'paymentcode' => $this->session->userdata("payment"),
			'shippingcode' => $this->session->userdata("shipping"),
			'tanggal' => date("Y-m-d H:i:s")
		);

		$address = $bio['alamat'] . '<br>Kec. ' . $kec[3] . '<br> Kota ' . $bio['kota'];

		$insBio = $this->db->insert("um_customerinfo", $data);
		if($insBio){
			// Insert master detail barang pesanan
			$masterTrx = array(
				'transactioncode' => $nofak,
				'date' => date("Y-m-d"),
				'description' => $ket,
				'payment_method' => '1',
				'status' => 0,
				'usercode' => $this->session->userdata("usercode"),
				'total' => $totBelanja
			);
			$mstrTrx = $this->db->insert("um_transaction", $masterTrx);
			if($mstrTrx) {
				$jmlItem = count($this->cart->contents());
				$i =0;
				foreach ($this->cart->contents() as $items){
					$detailTrx = array(
						'transactioncode' => $nofak,
						'productcode' => $items['id'],
						'qty' => $items['qty'],
						'price' => $items['price'],
						'subtotal' => $items['subtotal']
					);
					$ins = $this->db->insert("um_transactiondetails", $detailTrx);
					if($ins){
						$i++;
					}
				}
				if($jmlItem != $i){
					$this->session->set_flashdata("note", "Kegagalan penyimpanan data, coba kembali");
					$this->session->set_flashdata("status", "0");
					echo 'false:finishorder';
				} else {
					$subject = 'Pemesanan Produk '. $this->core->getShop('name');
					$this->core->sendmail($bio['email'], $subject, $msg);
					$this->session->set_flashdata("note", "<h2 align='center'>Pesanan anda telah kami proses, cek email anda untuk mengetahui rincian pemesanan anda.</h2>");
					$this->session->set_flashdata("status", "1");
					
					echo 'true:finishorder/selesai';
					$up = $this->core->updatekode("SALE");
					if($up){
						$ship = explode("|", $this->session->userdata("shipping"));
						$subject = "Pembelian Produk ". $this->core->getShop("name");
						$product = '';
						$product .= '<table cellpadding="6" cellspacing="1" style="width:100%" border="1" class="table table-striped table-hovered">
                            <thead>
                            <tr>
                              <th>No.</th>
                              <th>Item Description</th>
                              <th>QTY</th>
                              <th style="text-align:right">Item Price</th>
                              <th style="text-align:right">Sub-Total</th>
                            </tr>
                            </thead>
                            <tbody>';
                            $i = 1;
							$tot = 0;
                            foreach ($this->cart->contents() as $items){

                              $product .='
                                <tr>
                                  <td valign="center">'.$i .'</td>
                                  <td valign="top">'.$items['name'];

                                        if ($this->cart->has_options($items['rowid']) == TRUE){
                                            $product .='<p>';
                                                foreach ($this->cart->product_options($items['rowid']) as$option_name => $option_value){
                                                    $product .='<strong>'.$option_name .':</strong> '.$option_value.'<br />';
                                                }
                                            $product .='</p>';
                                        }

                                  $product .='</td>
                                  <td align="center">'.$items['qty'].'</td>
                                  <td style="text-align:right">'.$this->cart->format_number($items['price']).'</td>
                                  <td style="text-align:right">'.$this->cart->format_number($items['subtotal']).'</td>
                                </tr>';
                            	$i++;

                            }
							$tot = $ship[1] +$this->cart->total();
                            $product .='
							<tr>
                              <td colspan="4"><strong>Shipping</strong></td>
                              <td class="right" style="text-align:right"><strong>'.number_format($ship[1]).'</strong></td>
                            </tr>
							<tr>
                              <td colspan="4"><strong>Total</strong></td>
                              <td class="right" style="text-align:right"><strong>'.number_format($tot).'</strong></td>
                            </tr>
                            </tbody>
                            </table>';

						$search = array('{NAME}', 
							'{SHOPNAME}',
							'{INVOICE}',
							'{DATE}',
							'{PAYMENT}',
							'{SHIPPING}',
							'{PRODUCT}',
							'{ADDRESS}');
							
						
						$replace = array($bio['nama'], 
							$this->core->getShop("name"),
							$nofak,
							date("d-m-Y H:i:s"),
							$this->session->userdata("payment"),
							$ship[0],
							$product,
							$address
							 );

						$msg = $this->core->templateSendMail($search, $replace);
						//$msg = 'Terima kasih, anda telah belanja, total belanja anda : Rp. '. number_format($totBelanja) ;
						$this->core->sendmail($bio['email'], $subject, $msg);

						$phone = $bio['telp'];
						$search = array('{INVOICE}', '{TOTALHARGA}');
						$replace = array($nofak, number_format($totBelanja) );

						$msg = $this->core->templateSendSMS($search, $replace);
						$this->core->sendSMS($phone, $msg);

						$this->cart->destroy();
						$this->session->unset_userdata("payment");
						$this->session->unset_userdata("shipping");
						$this->session->unset_userdata("cusBioa");
					}
				}
			}
		}
	}

}