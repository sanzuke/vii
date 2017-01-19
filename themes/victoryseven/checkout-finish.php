<?php require("header.php"); ?>

    <!-- Page Content -->
            <?php //require("sidebar.php"); ?>
            <br><br>
            <!-- Side Right -->
            <div class="col-md-12">
                <div class="col-md-12">
                <div clss="row">
                    <div id="breadcrumb">
                        <ol class="breadcrumb" >
                          <li><a href="#">Home</a></li>
                          <li><a href="#">Order</a></li>
                          <li class="active">Checkout</li>
                        </ol>
                    </div>
                </div>
                </div>

                <div class="col-md-12">

                    <div class="row">
                        <div class="col-md-12" style="margin:0;">
                            <h1 style="margin:0 0 10px 0;">Data Pembeli</h1>
                        </div>

                        <div class="col-md-12">
                            <?php //echo form_open('cart/updatecart'); ?>
                            <form method="post" id="updateCart">
                            
                            <div class="row">
                            <?php
                            switch ($step) {
                              case 'step1':
                                $step1 = 'color:#fff; background-color:#222222;';
                                $step2 = '';
                                $step3 = '';
                                $step4 = '';
                                break;
                              case 'step2':
                                $step1 = '';
                                $step2 = 'color:#fff; background-color:#222222;';
                                $step3 = '';
                                $step4 = '';
                                break;
                              case 'step3':
                                $step1 = '';
                                $step2 = '';
                                $step3 = 'color:#fff; background-color:#222222;';
                                $step4 = '';
                                break;
                              case 'finishorder':
                                $step1 = '';
                                $step2 = '';
                                $step3 = '';
                                $step4 = 'color:#fff; background-color:#222222;';
                                break;
                            }
                            ?>
                            <div class="col-md-3">
                              <div class="panel panel-default">
                                <div class="panel-body" style="<?php echo $step1 ?>">
                                  <a href="<?php echo base_url() ?>checkout/langkah1">
                                  <h2 align="center"><i class="fa fa-user"></i> Langkah 1</h2>
                                  <h4 style="color:#aaa; text-align:center">Isi biodata konsumen</h4>
                                  </a>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="panel panel-default">
                                <div class="panel-body" style="<?php echo $step2 ?>">
                                  <a href="<?php echo base_url() ?>checkout/langkah2">
                                  <h2 align="center"><i class="fa fa-credit-card"></i> Langkah 2</h2>
                                  <h4 style="color:#aaa; text-align:center">Pilih Pembayaran</h4>
                                  </a>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="panel panel-default">
                                <div class="panel-body" style="<?php echo $step3 ?>">
                                  <a href="<?php echo base_url() ?>checkout/langkah3">
                                  <h2 align="center"><i class="fa fa-truck"></i> Langkah 3</h2>
                                  <h4 style="color:#aaa; text-align:center">Pilih Pengiriman</h4>
                                  </a>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="panel panel-default">
                                <div class="panel-body" style="<?php echo $step4 ?>">
                                  <a href="<?php echo base_url() ?>checkout/finishorder">
                                  <h2 align="center"><i class="fa fa-check"></i> Selesai</h2>
                                  <h4 style="color:#aaa; text-align:center">Transaksi Selesai</h4>
                                  </a>
                                </div>
                              </div>
                            </div>
                            <div class="clearfix"></div>
                            </div>
                          <?php
                          $user = $this->session->userdata("usercode");
                          switch ($step) {
                            case 'step1':
                                
                            
                            if( $user != "" ){
                              $checked = 'checked="checked"';
                              $disChecked = 'disabled="disabled"';
                            } else {
                              $checked = '';
                              $disChecked = '';
                            }
                            ?>
                            <input type="hidden" name="op" id="op" value="langkah1">
                            <div class="row">
                              <div class="col-md-4">
                                <div class="panel panel-default">
                                  <div class="panel-heading"><strong>Pilih Jenis Member</strong></div>
                                  <div class="panel-body">
                                    <div class="checkbox">
                                      <input type="radio" name="member" id="memberExsits" onclick="$('#loginArea').fadeIn('slow')" <?php echo $checked ?> > Login<br>
                                      <input type="radio" name="member" id="member" onclick="$('#loginArea').fadeOut('slow')" <?php echo $disChecked ?> > Pengunjung biasa
                                    </div>
                                  </div>
                                </div>

                                
                              </div>

                              <div class="col-md-8" >
                                <div class="panel panel-default" id ="loginArea" style="display: none">
                                  <div class="panel-heading"><strong>Login</strong></div>
                                  <div class="panel-body">
                                    <div class="form-group">
                                      <label>Username</label>
                                      <input type="text" name="username" id="username" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label>Password</label>
                                      <input type="password" name="password" id="password" class="form-control">
                                    </div>
                                  </div>
                                  <div class="panel-footer">
                                    <button class="btn btn-primary"><i class="fa fa-sign-in"></i> Signin</button>
                                  </div>
                                </div>

                                <?php
                                
                                if( $user != "" ){
                                  $getUser = $this->db->query("SELECT us.*, pr.nama_propinsi, k.nama_kota
                                    FROM ss_user us
                                    LEFT JOIN ss_propinsi pr ON us.kode_propinsi = pr.kode_propinsi
                                    LEFT JOIN ss_kota k ON us.kode_kota = k.kode_kota AND pr.kode_propinsi = k.kode_propinsi
                                    WHERE usercode = '$user' 
                                     ");
                                  $name = '';
                                  $address = '';
                                  $nama_propinsi = '';
                                  $nama_kota = '';
                                  $phone = '';
                                  $email = '';
                                  foreach ($getUser->result_array() as $key => $value) {
                                    $name = $value['name'];
                                    $address = $value['address'];
                                    $nama_propinsi = $value['nama_propinsi'];
                                    $nama_kota = $value['nama_kota'];
                                    $phone = $value['phone'];
                                    $email = $value['email'];
                                  }

                                } else {
                                  $name = $this->session->userdata("cusBioa")['nama'];
                                  $address = $this->session->userdata("cusBioa")['alamat'];
                                  $nama_propinsi = $this->session->userdata("cusBioa")['prop'];
                                  $nama_kota = $this->session->userdata("cusBioa")['kota'];
                                  $phone = $this->session->userdata("cusBioa")['telp'];
                                  $email = $this->session->userdata("cusBioa")['email'];
                                }
                                ?>
                                <div class="panel panel-default">
                                  <div class="panel-heading"><strong>Informasi Pembeli</strong></div>
                                  <div class="panel-body">
                                    <div class="form-group">
                                      <label>Nama</label>
                                      <input type="text" name="nama" id="nama" class="form-control" value="<?php echo $name ?>">
                                    </div>
                                    <div class="form-group">
                                      <label>Alamat</label>
                                      <textarea name="alamat" id="alamat" class="form-control"><?php echo $address ?></textarea>
                                    </div>
                                    <div class="form-group">
                                      <label>Propinsi</label>
                                      <select name="prop" id="prop" class="form-control" onchange="getKota(this.value)">
                                        <option value="">[Pilih]</option>
                                        <?php
                                        $prop = $this->db->query("SELECT * FROM ss_propinsi");
                                        foreach ($prop->result_array() as $key) {
                                          if($key['kode_propinsi'] == $propinsi){
                                            $sel = 'selected="selected"';
                                          } else {
                                            $sel = '';
                                          }
                                          echo "<option value=\"".$key['kode_propinsi']."\" ".$sel.">".$key['nama_propinsi']."</option>";
                                        }
                                        ?>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label>Kab. / Kota</label>
                                      <select name="kota" id="kota" class="form-control" onchange="getKec(this.value)">
                                        <option value="">[Pilih]</option>
                                        <?php
                                        $kota = $this->db->query("SELECT DISTINCT kota FROM ss_shipping_jne ORDER BY kota ASC");
                                        foreach ($kota->result_array() as $key => $value) {
                                          echo '<option value="'.$value['kota'].'">'.$value['kota'].'</option>';
                                        }
                                        ?>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label>Kecamatan</label>
                                      <select name="kec" id="kec" class="form-control" onchange="getPrice(this.value)">
                                        <option value="">[Pilih]</option>
                                      </select>
                                    </div>
                                    
                                    <div class="form-group">
                                      <label>Telp.</label>
                                      <input type="text" name="telp" id="telp" class="form-control" required="required" value="<?php echo $phone ?>">
                                    </div>
                                    <div class="form-group">
                                      <label>Email</label>
                                      <input type="email" name="email" id="email" class="form-control" required="required" value="<?php echo $email ?>">
                                    </div>


                                    <div class="form-group">
                                      <button class="btn btn-default" value="langkah1"><i class="fa fa-arrow-right"></i> Selanjutnya</button>
                                    </div>
                                  </div>
                                </div>
                              </div>

                            </div>
                            <?php
                            break;
                            case 'step2' :
                            ?>
                            <input type="hidden" name="op" id="op" value="langkah2">
                            <div class="row">
                              <div class="panel panel-default">
                                <div class="panel-heading"><b>Pilih Jenis Pembayaran</b></div>
                                <div class="panel-body">
                                  <div class="form-group">
                                    <!--<input type="radio" name="payment" id="cod" required="required" value="cod"> Cash On Delivery (COD)<br>
                                    <input type="radio" name="payment" id="cod" required="required" value="transfer_bank"> Transfer Bank-->
                                  </div>
                                  <h4>Pilih Bank Transfer</h4>
                                  <div class="row">
                                  <?php
                                  $getPay = $this->db->query("SELECT * FROM ss_parametervalue WHERE parametercode = 'PAYMENT' AND parametervaluecode NOT IN ('COD')");
                                  $payment = $this->session->userdata("payment");
                                  foreach ($getPay->result_array() as $key ) {
                                    if($key['parametervaluecode'] == $payment){
                                      $select = 'class="btn-success"';
                                    } else {
                                      $select = '';
                                    }
                                    $ex = explode(" | ",$key['options']);
                                    $nameBank = $ex[0];
                                    $img = '<img src="'.base_url() . 'uploads/'.$ex[1]. '" alt="'.$nameBank.'" class="img-responsive" style="height:50px;">';
                                    echo '<div class="col-md-4" align="center"><button type="button" '.$select.' onclick="$(\'#payment\').val(\''.$key['parametervaluecode'].'\'); $(\'button\').removeClass(\'btn-success\'); $(this).addClass(\'btn-success\');"><h3>'.$nameBank.'</h3><h4>'.$key['parametervalue'].'</h4>'.$img.'</button></div>';
                                  }
                                  ?>
                                  <input type="hidden" name="payment" id="payment" >
                                  </div>
                                </div>
                                <div class="panel-footer" align="right">
                                  <button class="btn btn-default" type="submit" value="langkah2"><i class="fa fa-arrow-right"></i> Selanjutnya</button>
                                </div>
                              </div>
                            </div>
                            <?php
                            break;
                            case 'step3' :
                            ?>
                            <input type="hidden" name="op" id="op" value="langkah3">
                            <div class="row">
                            <div class="col-md-8">
                              <div class="panel panel-default">
                                <div class="panel-heading"><b>Pilih Jenis Pengiriman</b></div>
                                <div class="panel-body">
                                  <div class="form-group">
                                    <input type="radio" name="shipping" id="free" required="required" value="free" onclick="$('#freePrice').removeClass('hide');$('#jnePrice').addClass('hide');$('#shipping').val('0')"> Gratis<br>
                                    <input type="radio" name="shipping" id="jne" required="required" value="jne" onclick="$('#jnePrice').removeClass('hide');$('#freePrice').addClass('hide');"> JNE
                                  </div>
                                </div>
                                <div class="panel-footer" align="right">
                                  <button class="btn btn-default" type="submit" value="langkah3"><i class="fa fa-arrow-right"></i> Selanjutnya</button>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="panel panel-default">
                                <div class="panel-heading"><b>Harga</b></div>
                                <div class="panel-body">
                                  <input type="hidden" name="shipping" id="shipping" >
                                  <div id="freePrice" class="hide">
                                    <h2>Rp. 0</h2>
                                  </div>
                                  <div id="jnePrice" class="hide">
                                    <?php
                                    $dump = $this->session->userdata("cusBioa");
                                    $kota = $dump['kota'];
                                    $kec  = $dump['kec'];
                                    $harga = explode("|", $kec);
                                    ?>
                                    <select name="shippingPrice" onchange="changePriceJNE(this.value)" class="form-control">
                                      <option value="">[ Pilih ]</option>
                                      <option value="<?php echo 'JNE REG|'.$harga[0] ?>">JNE REG</option>
                                      <option value="<?php echo 'JNE OKE|'.$harga[1] ?>">JNE OKE</option>
                                      <option value="<?php echo 'JNE YES|'.$harga[2] ?>">JNE YES</option>
                                    </select>
                                    <h2 id="PRC">Rp. 0</h2>
                                  </div>
                                </div>
                              </div>
                            </div>
                            </div>
                            <?php
                            break;
                            case "finishorder" :
                            if($this->uri->segment("3") == 'selesai' && $this->session->flashdata("note") != ""){
                              ?>
                              <div class="row">
                                <div class="panel panel-default">
                                  <div class="panel-heading"><b>Transaksi Selesai</b></div>
                                  <div class="panel-body">
                                    <?php 
                                    echo $this->session->flashdata("note"); 
                                    ?>
                                  </div>
                                </div>
                              </div>
                              
                              <?php
                            } else {
                            ?>
                            <input type="hidden" name="op" id="op" value="finishorder">
                            <div class="row">
                              <div class="panel panel-default">
                                <div class="panel-heading"><b>Transaksi Selesai</b></div>
                                <div class="panel-body">
                                  <table cellpadding="6" cellspacing="1" style="width:100%" border="0" class="table table-striped table-hovered">
                                  <thead>
                                  <tr>
                                    <th>No.</th>
                                    <th>Produk</th>
                                    <th>QTY</th>
                                    <th style="text-align:right">Item Price</th>
                                    <th style="text-align:right">Sub-Total</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  <?php $i = 1; ?>

                                  <?php foreach ($this->cart->contents() as $items): ?>

                                      <?php echo form_hidden('rowid'.$i, $items['rowid']); ?>
                                      <tr>
                                        <td valign="center"><?php echo $i ?></td>
                                        <td valign="top">
                                          <?php echo $items['name']; ?>

                                              <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>

                                                  <p>
                                                      <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

                                                          <strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />

                                                      <?php endforeach; ?>
                                                  </p>

                                              <?php endif; ?>

                                        </td>
                                        <td><?php echo $items['qty'] ?></td>
                                        <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
                                        <td style="text-align:right"><?php echo $this->cart->format_number($items['subtotal']); ?></td>
                                      </tr>

                                  <?php $i++; ?>

                                  <?php endforeach; ?>

                                  <tr>
                                    <td colspan="4"><strong>Jumlah</strong></td>
                                    <td class="right" style="text-align:right"><strong><?php echo $this->cart->format_number($this->cart->total()); ?></strong></td>
                                  </tr>
                                  <tr>
                                    <?php 
                                    $dmp = explode("|",$this->session->userdata("shipping"));
                                    $namaShip = $dmp[0];
                                    $hargaShip = $dmp[1];
                                    ?>
                                    <td colspan="4"><strong>Shipping <?php echo $namaShip ?></strong></td>
                                    <td class="right" style="text-align:right"><strong id="ship"><?php 
                                    echo number_format($hargaShip) ?></strong></td>
                                  </tr>
                                  <tr>
                                    <td colspan="4"><h2>Total</h2></td>
                                    <td class="right" style="text-align:right"><h2>Rp. 
                                      <?php 
                                      $jml = $this->cart->total();
                                      //$ship = $this->session->userdata("shipping");
                                      $total = $jml + $hargaShip;
                                      echo number_format($total);
                                      ?></h2>
                                      <input type="hidden" name="totBelanja" id="totBelanja" value="<?php echo $total ?>" >
                                      </td>
                                  </tr>
                                  </tbody>
                                  </table>
                                  <hr>
                                  <h3>Data Pembeli</h3>
                                  <?php
                                  $bio = $this->session->userdata("cusBioa");
                                  $dumpKec = explode("|",$bio['kec']);
                                  ?>
                                  <table class="table table-striped">
                                    <tr><td>Nama</td><td>: <?php echo $bio['nama'] ?></td></tr>
                                    <tr><td>Alamat</td><td>: <?php echo $bio['alamat'] ?></td></tr>
                                    <tr><td>Kota</td><td>: <?php echo $bio['kota'] ?></td></tr>
                                    <tr><td>Kecamatan</td><td>: <?php echo $dumpKec[3] ?></td></tr>
                                    <tr><td>Telp.</td><td>: <?php echo $bio['telp'] ?></td></tr>
                                    <tr><td>Email</td><td>: <?php echo $bio['email'] ?></td></tr>
                                  </table>
                                  <h2>Keterangan</h2>
                                  <textarea name="ket" id="ket" class="form-control"></textarea>
                                </div>
                                <div class="panel-footer" align="right">
                                  <button class="btn btn-default" name="submit" type="submit" value="finishorder"><i class="fa fa-arrow-right"></i> Selesai</button>
                                </div>
                              </div>
                            </div>
                            <?php
                            }
                            break;
                            }
                            ?>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        

    </div>
    <!-- /.container -->
    
   <?php require("footer.php"); ?>
   <style type="text/css">
     a {
      color:#999;
     }
   </style>
   <script type="text/javascript">
        function changePriceJNE(nil){
          var name = nil.split("|")[0];
          var price = nil.split("|")[1];
          $("#PRC").html('Rp. '+price);

          $("#shipping").val(nil);
        }
        function getKec(kota){
          $.getJSON("<?php echo base_url() ?>checkout/getkec", {kota:kota}, function(json){
            if(json.length > 0){
              $("#kec").html('<option value="">[Pilih]</option>');
              $.each(json, function(i, val){
                var hrg_kec = val.price +'|' +val.kec
                var str = '<option value="'+hrg_kec+'">'+val.kec+'</option>';
                $("#kec").append(str);
              })
            }
          })
        }

        function getPrice(price){
          $reg = price.split("|")[0];
          $oke = price.split("|")[1];
          $yes = price.split("|")[2];

          console.log("Reg : "+ $reg + " Oke : "+$oke+" Yes : "+$yes);
          var cek = $("#jne").is("checked");
          //console.log(cek);
          //if(cek){
            $("#biaya_shipping").val($reg);
            $("#ship").html($reg);
          //}
        }

        function del(rowid){
            var psn = confirm("ANda yakin akan menghapus pesanan anda?");
            if(psn){
                $.post("<?php echo base_url() ?>cart/updateperItem", {rowid : rowid}, function(feedback){
                    window.location.reload();
                });
            }
        }

        function cekQty(nil){
            if(nil < 1){
                alert("Quantity tidak boleh kosong atau nol")
            }
        }

        $(document).ready(function(){
            $("#updateCart").submit(function(){
                var op = $("#op").val();
                
                $.post("<?php echo base_url() ?>cart/save"+op, $(this).serialize(), function(feedback){
                    var n1 = feedback.split(":")[0];
                    var n2 = feedback.split(":")[1];
                    if( n1 === 'true'){
                      window.location = '<?php echo base_url() ?>checkout/'+n2;
                    } else {
                      alert(feedback);
                    }
                }).fail(function(){
                    alert("Ada kesalahan pada sistem, coba kembali");
                })
                
                /*switch( op ){
                  case "langkah1" :
                    $.post("<?php echo base_url() ?>cart/savelangkah1", $(this).serialize(), function(feedback){

                    }).fail(function(){

                    });
                  break;
                  case "" :
                  break;
                }*/
                //var datapost = $(this).serialize();
                //alert( datapost );
                return false;
            });


            <?php if( $user != "" ){ ?>
            $("#updateCart input, textarea, select").attr("readonly", true);
            <?php } ?>
        })
    </script>