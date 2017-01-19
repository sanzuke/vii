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
                          <li><a href="#">Product</a></li>
                          <li class="active">Product Name</li>
                        </ol>
                    </div>
                </div>
                </div>

                <div class="col-md-12">

                    <div class="row">
                        <div class="col-md-12" style="margin:0;">
                            <h1 style="margin:0 0 10px 0;">Product Name</h1>
                        </div>

                        <div class="col-sm-4 col-lg-4 col-md-4">
                            <div class="thumbnail">
                                <img src="images/320x150.png" alt="">
                            </div>
                        </div>

                        <div class="col-md-8">
                            <h3 style="margin:0"> Product Detail</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
                            <div class="col-md-6">
                                <h3 class="price">Rp. 100.000 </h3>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" name="qty" class="form-control" placeholder="Quantity">
                                    <span class="input-group-btn">
                                        <button class="btn btn-info"><i class="fa fa-shopping-cart fa-lg"></i> Order</button>
                                    </span>
                                </div>
                            </div>
                            </br>
                            <div style="clear:both"></div><br>
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

                        <div class="col-md-12"> 
                            <div class="panel panel-default">
                                <div class="panel-heading"><b>Related Product</b></div>
                                <div class="panel-body">
                                    <div class="col-sm-4 col-lg-4 col-md-4">
                                        <div class="thumbnail">
                                            <img src="images/320x150.png" alt="">
                                            <div class="caption">
                                                <h4>Rp. 100.000</h4>
                                                <h4><a href="#">Second Product</a></h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-lg-4 col-md-4">
                                        <div class="thumbnail">
                                            <img src="images/320x150.png" alt="">
                                            <div class="caption">
                                                <h4>Rp. 100.000</h4>
                                                <h4><a href="#">Second Product</a></h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-lg-4 col-md-4">
                                        <div class="thumbnail">
                                            <img src="images/320x150.png" alt="">
                                            <div class="caption">
                                                <h4>Rp. 100.000</h4>
                                                <h4><a href="#">Second Product</a></h4>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>  
                    </div>

                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->

   <?php require("footer.php"); ?>