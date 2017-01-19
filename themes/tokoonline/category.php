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
                          <li><a href="index.php">Home</a></li>
                          <li><a href="#">Kategori</a></li>
                          <li class="active"><?php echo $titleCategoryPage ?></li>
                        </ol>
                    </div>
                </div>
                </div>

                <div class="col-md-12">

                    <div class="row">
                        <div class="col-md-12" style="margin:0;">
                            <h1 style="margin:0 0 10px 0;"><?php echo $titleCategoryPage ?></h1>
                        </div>

                        <?php foreach ($listlastproducts as $key => $value) { ?>

                        <div class="col-sm-4 col-lg-4 col-md-4">
                            <div class="thumbnail">
                                <div class="frame-img">
                                    <img src="<?php echo base_url().'uploads/'.$value['photo']; ?>" alt="">
                                </div>
                                <div class="caption">
                                    <h4><a href="<?php echo base_url().'index.php/product/view/'.$value['productcode'].'/'. str_replace(" ","-", strtolower($value['productname'])).'.html' ?>"><?php echo $value['productname']  ?></a>
                                    </h4>
                                    <h4 class="pull-right-x">Rp. <?php echo number_format($value['price']) ?></h4>
                                    <!--<p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>-->
                                </div>
                                <div class="ratings">
                                    <p class="pull-right">15 reviews</p>
                                    <p>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                    </div>

                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->

   <?php require("footer.php"); ?>