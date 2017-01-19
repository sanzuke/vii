<!-- Slide left -->
<div class="col-md-3">
    <div class="col-md-12">
        <p class="lead">Toko Online</p>
        <div class="list-group">
            <?php foreach ($listNavCategory as $key => $value) { ?>
            <a class="list-group-item" href="<?php echo $value['uri_category'] ?>"><span><?php echo $value['categoryname'] ?></span></a>
            <?php } ?>                
        </div>
    </div>
    <?php
    $checkout = $this->uri->segment("1");
    if($checkout != 'checkout'){
    ?>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-shopping-cart"></i> Keranjang Belanja</b></div>
            <div class="panel-body">
                <?php   
                    $t = 0;
                    foreach ($this->cart->contents() as $items){
                        $t+= $items['subtotal'];
                    }
                    $isi['countitem'] = count($this->cart->contents());
                    $isi['total'] = $this->cart->format_number($t);
                    echo $this->view('cart', $isi, true); 
                ?>
            </div>
        </div>
    </div>
    <?php } ?>

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-credit-card"></i> Pembayaran</b></div>
            <div class="panel-body">
                Bank MANDIRI 900-00-200985-2
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-truck"></i> Pengiriman</b></div>
            <div class="panel-body">
                JNE
            </div>
        </div>
    </div>
</div>