<?php require("header.php"); ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <?php require("sidebar.php"); ?>

            <!-- Side Right -->
            <div class="col-md-9">
                <div class="col-md-12">

                    <div class="row carousel-holder">

                        <div class="col-md-12">
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <?php 
                                    $i=1; 
                                    while($i <= count($banner) ) { 
                                        if($i==1){
                                            $ac = 'class="active"';
                                        } else {
                                            $ac = '';
                                        }
                                        ?>
                                        <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i ?>" <?php echo $ac ?> ></li>
                                    <?php $i++; } ?>
                                </ol>
                                <div class="carousel-inner">
                                    <?php 
                                    $x=1;
                                    foreach($banner as $r){
                                        if($x==1){
                                            $ac = ' active';
                                        } else {
                                            $ac = '';
                                        }
                                    ?>
                                    <div class="item <?php echo $ac ?>">
                                        <img class="slide-image" src="<?php echo base_url() . 'uploads/banner/'.$r['foto'] ?>" alt="">
                                    </div>
                                    <?php $x++; } ?>
                                    
                                </div>
                                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-lg-12 col-md-12" >
                        <h2>Produk Terbaru</h2>
                        </div>
                        <?php foreach ($listlastproducts as $key => $value) { ?>    
                        <div class="col-sm-4 col-lg-4 col-md-4" >
                            <div class="thumbnail" >
                                <div class="frame-img">
                                <a href="<?php echo base_url().'product/view/'.$value['productcode'].'/'. str_replace(" ","-", strtolower($value['productname'])).'.html' ?>"><img src="<?php echo base_url().'uploads/'.$value['photo']; ?>" title="<?php echo $value['productcode'] . ' - ' . $value['productname']; ?>" alt=""></a>
                                </div>
                                <div class="caption">
                                    <h4><a href="<?php echo base_url().'product/view/'.$value['productcode'].'/'. str_replace(" ","-", strtolower($value['productname'])).'.html' ?>"><?php echo $value['productname']  ?></a>
                                    </h4>
                                    <h4 class="pull-right-x">Rp. <?php echo number_format($value['price']) ?></h4>
                                    <!--<p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>-->
                                </div>
                                <div class="ratings">
                                    <p class="pull-right"><?php echo $this->core->countreview($value['productcode'])?> reviews</p>
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
