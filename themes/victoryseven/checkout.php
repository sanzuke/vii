<?php require("header.php"); ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

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
                            <h1 style="margin:0 0 10px 0;">Keranjang Belanja</h1>
                        </div>

                        <div class="col-md-12">
                            <?php //echo form_open('cart/updatecart'); ?>
                            <form method="post" id="updateCart">
                            <table cellpadding="6" cellspacing="1" style="width:100%" border="0" class="table table-striped table-hovered">
                            <thead>
                            <tr>
                              <th>No.</th>
                              <th>Foto</th>
                              <th>Item Description</th>
                              <th>QTY</th>
                              <th style="text-align:right">Item Price</th>
                              <th style="text-align:right">Sub-Total</th>
                              <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>

                            <?php foreach ($this->cart->contents() as $items): ?>

                                <?php echo form_hidden('rowid'.$i, $items['rowid']); ?>
                                <tr>
                                  <td valign="center"><?php echo $i ?></td>
                                  <td>
                                      <?php 
                                      $prd = $this->db->query("SELECT productcode, photo FROM ss_products WHERE productcode = '".$items['id']."'");
                                      $row = $prd->row();
                                      echo "<img src=".base_url() . "uploads/" .$row->photo ." class='thumbnail' width='100' >" ; 
                                      ?>
                                  </td>
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
                                  <td><?php echo form_input(array('name' => 'qty'.$i, 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?></td>
                                  <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
                                  <td style="text-align:right"><?php echo $this->cart->format_number($items['subtotal']); ?></td>
                                  <td><button class="btn btn-danger btn-xs" onclick="del('<?php echo $items['rowid'] ?>')"><i class="fa fa-times"></i></button></td>
                                </tr>

                            <?php $i++; ?>

                            <?php endforeach; ?>

                            <tr>
                              <td colspan="5"><strong>Total</strong></td>
                              <td class="right" style="text-align:right"><strong><?php echo $this->cart->format_number($this->cart->total()); ?></strong></td>
                              <td></td>
                            </tr>
                            </tbody>
                            </table>
                            <div class="pull-right">
                                <button type="button" class="btn btn-primary" onclick="window.location = '<?php echo base_url() ?>checkout/langkah1'"><i class="fa fa-checkout"></i>Checkout</button>
                            </div>
                            <div class="btn-group">
                                <input type="hidden" name="jumRow" id="jumRow" value="<?php echo $i ?>">
                                <button type="submit" class="btn btn-success"><i class="fa fa-refresh"></i> Perbaharui Keranjang</button>
                                <button type="button" class="btn btn-info" onclick="window.location = '<?php echo base_url() ?>'"><i class="fa fa-shopping-cart"></i> Belanja Lagi</button>
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