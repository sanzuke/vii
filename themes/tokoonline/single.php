<?php require("header.php"); ?>
<?php
foreach ($productdetail as $key => $row) {
    # code...
    $photo = base_url() . 'uploads/'.$row['photo'];
    $productcode = $row['productcode'];
    $productname = $row['productname'];
    $price = $row['price'];
    $stock = $row['stock'];
    $min_stock = $row['min_stock'];
    $description = $row['description'];
    $poin = $row['poin'];
}
?>
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
                          <li><a href="#">Product</a></li>
                          <li class="active"><?php echo $productname ?></li>
                        </ol>
                    </div>
                </div>
                </div>

                <div class="col-md-12">

                    <div class="row">
                        <div class="col-md-12" style="margin:0;">
                            <h1 style="margin:0 0 10px 0;"><?php echo $productname ?></h1>
                        </div>

                        <div class="col-sm-4 col-lg-4 col-md-4">
                            <div class="thumbnail">
                                <img src="<?php echo $photo ?>" alt="">
                            </div>
                        </div>

                        <div class="col-md-8">
                            <h3 style="margin:0"> Product Detail</h3>
                            <p><?php echo $description ?></p>
                            <div class="col-md-6">
                                <h3 class="price">Rp. <?php echo number_format($price) ?> </h3>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" name="qty" id="qty" class="form-control" placeholder="Quantity">
                                    <span class="input-group-btn">
                                        <button class="btn btn-info" onclick="addtocart('<?php echo $productcode ?>','<?php echo $productname ?>','<?php echo $price ?>')"><i class="fa fa-shopping-cart fa-lg"></i> Order</button>
                                    </span>
                                </div>
                            </div>
                            </br>
                            <div style="clear:both"></div><br>
                            <div class="ratings">
                                <p class="pull-right"><?php echo $this->core->countreview($productcode)?> reviews</p>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                </p>
                            </div>
                        </div>

                        <div class="col-md-12"> 
                            <div class="panel panel-default">
                                <div class="panel-heading"><b>Review</b></div>
                                <?php echo $this->core->listreview($productcode); ?>
                            </div>
                        </div>

                        <div class="col-md-12"> 
                            <div class="panel panel-default">
                                <div class="panel-heading"><b>Produk Lainnya</b></div>
                                <div class="panel-body">
                                    <?php foreach ($relateproduct as $key => $value) { ?>
                                    <div class="col-sm-4 col-lg-4 col-md-4">
                                        <div class="thumbnail">
                                            <a href="<?php echo base_url().'index.php/product/view/'.$value['productcode'].'/'. str_replace(" ","-", strtolower($value['productname'])).'.html' ?>"><img src="<?php echo base_url() .'uploads/' . $value['photo'] ?>" alt=""></a>
                                            <div class="caption">
                                                <h4>Rp. <?php echo number_format($value['price']) ?></h4>
                                                <h4><a href="<?php echo base_url().'index.php/product/view/'.$value['productcode'].'/'. str_replace(" ","-", strtolower($value['productname'])).'.html' ?>"><?php echo $value['productname'] ?></a></h4>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>  
                    </div>

                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->
    <script type="text/javascript">
        function addtocart(pc,pn, pr){
            var qty = $("#qty").val();
            $.post("<?php echo base_url() ?>cart/add", {product_id: pc, pn:pn, quantity :qty, pr:pr}, function(feedback){
                window.location.reload();
            })
        }
    </script>
   <?php require("footer.php"); ?>