<?php require("header.php"); ?>
<script type="text/javascript">
    $(document).ready(function(){
        
    })
</script>
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <?php echo  $TITLE; ?>
        <small><?php echo  $SUBTITLE; ?></small>
        </h1>
        <?php echo  $BREADCRUMB; ?>
       
    </section> 
    <!-- Main content -->
    <section class="content">
        <form role="form" method="post" action="<?php echo base_url() ?>admfooterimg/save">
            <?php if($this->session->flashdata("note") !=""){ ?>
            <div id="notification" class="alert alert-warning" role="alert" ><?php echo $this->session->flashdata("note") ?></div>
            <?php } ?>
            <div class="col-md-8">
                <div class="box box-warning">
                    
                    <div class="box-body">
                        <div class="form-group">
                            <label>Title Image</label>
                            <input type="text" class="form-control" name="title" id="title" value="<?php echo $titleevent ?>">
                        </div>
                        <div class="form-group">
                            <label>Footer Image</label>
                            <input type="file" class="form-control" name="footerimg" id="footerimg">
                        </div>
                    </div>
                    <div class="box-footer">
                        <button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Image</label>
                    <img src="<?php echo $img ?>" class="img-responsive">
                </div>
            </div>
        </form>
    </section><!-- /.content -->
    
</aside><!-- /.right-side -->

<?php require("footer.php"); ?>