<?php require("header.php"); ?>

    <!-- Page Content -->
    <div class="container">
        <br><br>
        <!-- Side Right -->
        <div class="col-md-12">
            <div id="breadcrumb">
                <ol class="breadcrumb" >
                  <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i></a></li>
                  <li><a href="#">Page</a></li>
                  <li class="active"><?php echo $post_title ?></li>
                </ol>
            </div>
        </div>

        <div class="col-md-12">

                <div class="col-md-12" style="margin:0;">
                    <h1 style="margin:0 0 10px 0;"><?php echo $post_title ?></h1>
                </div>
                <div class="col-md-12">
                    <p>
                        <?php echo $post_content ?>
                    </p>
                    <?php if($this->uri->segment("3") == '1'){ ?>
                        <br>
                        Buka : <?php echo $this->core->getShop('open_day'); ?>, Waktu <?php echo $this->core->getShop('open_hour'); ?><br>
                        WA : <?php echo $this->core->getShop('wa'); ?><br>
                        LINE : <?php echo $this->core->getShop('line'); ?> <br>
                        BBM : <?php echo $this->core->getShop('bbm'); ?>

                   <?php } ?>
                </div>
    
        </div>
    </div>
    </div>
    <!-- /.container -->

   <?php require("footer.php"); ?>