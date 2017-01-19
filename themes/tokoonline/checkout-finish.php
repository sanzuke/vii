<?php require("header.php"); ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <?php require("sidebar.php"); ?>

            <!-- Side Right -->
            <div class="col-md-9">
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
                            <h1 style="margin:0 0 10px 0;">Keranjang Belanja</h1>
                        </div>

                        <div class="col-md-12">
                            <?php //echo form_open('cart/updatecart'); ?>
                            <form method="post" id="updateCart">
                            <table cellpadding="6" cellspacing="1" style="width:100%" border="0" class="table table-striped table-hovered">
                            <thead>
                            <tr>
                              <th>No.</th>
                              <th>Item Description</th>
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
                              <td colspan="4"><strong>Total</strong></td>
                              <td class="right" style="text-align:right"><strong><?php echo $this->cart->format_number($this->cart->total()); ?></strong></td>
                              <td></td>
                            </tr>
                            </tbody>
                            </table>
                            <hr>
                            <div class="row">
                              <div class="col-md-4">
                                <div class="panel panel-default">
                                  <div class="panel-heading"><strong>Pilih Jenis Member</strong></div>
                                  <div class="panel-body">
                                    <div class="checkbox">
                                      <input type="radio" name="member" id="memberExsits" onclick="$('#loginArea').fadeIn('slow')"> Login<br>
                                      <input type="radio" name="member" id="member" onclick="$('#loginArea').fadeOut('slow')"> Pengunjung biasa
                                    </div>
                                  </div>
                                </div>

                                <div class="panel panel-default">
                                  <div class="panel-heading"><strong>Jenis Pembayaran</strong></div>
                                  <div class="panel-body">
                                    <div class="form-group">
                                      <input type="radio" name="payment" value="COD" > Cash on Delivery (COD)<br>
                                      <input type="radio" name="payment" value="transfer" > Transfer Bank<br>
                                    </div>
                                  </div>
                                </div>

                                <div class="panel panel-default">
                                  <div class="panel-heading"><strong>Jenis Pengiriman</strong></div>
                                  <div class="panel-body">
                                    <div class="form-group">
                                      <select class="form-control" name="payment" id="payment">
                                        <option value="">[ Pilih Pembayaran ]</option>
                                        <option value="transfer">Transfer BANK</option>
                                        <option value="creditcard">Kartu Kredit</option>
                                        <option value="paypal">PayPal</option>
                                      </select>
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

                                <div class="panel panel-default">
                                  <div class="panel-heading"><strong>Informasi Pengunjung</strong></div>
                                  <div class="panel-body">
                                    <div class="form-group">
                                      <label>Nama</label>
                                      <input type="text" name="nama" id="nama" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label>Alamat</label>
                                      <textarea name="alamat" id="alamat" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                      <label>Pilih Propinsi</label>
                                      <select class="form-control" name="propinsi" id="propinsi">
                                        <option value="">[ Pilih ]</option>
                                        <option value="transfer">Transfer BANK</option>
                                        <option value="creditcard">Kartu Kredit</option>
                                        <option value="paypal">PayPal</option>
                                      </select>
                                    </div>

                                    <div class="form-group">
                                      <label>Pilih Kota</label>
                                      <select class="form-control" name="propinsi" id="propinsi">
                                        <option value="">[ Pilih ]</option>
                                      </select>
                                    </div>

                                    <div class="form-group">
                                      <label>Email</label>
                                      <input type="text" name="email" id="email" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label>No. HP</label>
                                      <input type="text" name="phone" id="phone" class="form-control">
                                    </div>
                                  </div>
                                </div>
                              </div>

                            </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->
    
   <?php require("footer.php"); ?>
   <script type="text/javascript">
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
                $.post("<?php echo base_url() ?>cart/updatecartAll", $(this).serialize(), function(feedback){
                    window.location.reload();
                }).fail(function(){
                    alert("Ada kesalahan pada sistem, coba kembali");
                })
                return false;
            });
        })
    </script>