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
                          <li><a href="#">Page</a></li>
                          <li class="active"><?php echo $post_title ?></li>
                        </ol>
                    </div>
                </div>
                </div>

                <div class="col-md-12">

                    <div class="row">
                        <div class="col-md-12" style="margin:0;">
                            <h1 style="margin:0 0 10px 0;"><?php echo $post_title ?></h1>
                        </div>
                        <div class="col-md-12">
                            <p>
                                <?php echo $post_content ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->

   <?php require("footer.php"); ?>