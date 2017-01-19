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
        <form role="form" method="post" action="<?php echo base_url() ?>setting/save">
            <?php if($this->session->flashdata("note") !=""){ ?>
            <div id="notification" class="alert alert-warning" role="alert" ><?php echo $this->session->flashdata("note") ?></div>
            <?php } ?>
            <div class="col-md-8">
                <div class="box box-warning">
                    <div class="box-header"><h3 class="box-title">Informasi Toko</h3></div>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Nama Toko</label>
                            <input type="text" class="form-control" name="namatoko" id="namatoko" value="<?php echo $sitename ?>">
                        </div>
                        <div class="form-group">
                            <label>Alamat Toko</label>
                            <input type="text" class="form-control" name="address" id="address" value="<?php echo $address ?>">
                        </div>
                        <div class="form-group">
                            <label>Slogan Toko</label>
                            <input type="text" class="form-control" name="slogantoko" id="slogantoko" value="<?php echo $slogan ?>">
                        </div>
                        <div class="form-group">
                            <label>Email Toko</label>
                            <input type="email" class="form-control" name="email" id="email" value="<?php echo $email ?>">
                        </div>
                        <div class="form-group">
                            <label>Telp. Toko</label>
                            <input type="text" class="form-control" name="telp" id="telp" value="<?php echo $phone ?>">
                        </div>
                        <div class="form-group">
                            <label>Alamat Web</label>
                            <input type="text" class="form-control" name="web" id="web" value="<?php echo $web ?>">
                        </div>
                    </div>
                    <div class="box-footer">
                        <button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box box-warning">
                    <div class="box-header"><h3 class="box-title">Logo</h3></div>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Logo Toko</label>
                            <input type="file" class="form-control" name="userfile" id="userfile">
                        </div>
                        <div class="form-group">
                            <img src="" class="thumbnail">
                        </div>
                        <div class="form-group">
                            <label>Hari Buka Toko</label>
                            <input type="text" class="form-control" name="open_day" id="open_day" value="<?php echo $open_day ?>">
                        </div>

                        <div class="form-group">
                            <label>Jam Buka Toko</label>
                            <input type="text" class="form-control" name="open_hour" id="open_hour" value="<?php echo $open_hour ?>">
                        </div>

                        <div class="form-group">
                            <label>Whatsapp</label>
                            <input type="text" class="form-control" name="wa" id="wa" value="<?php echo $wa ?>">
                        </div>

                        <div class="form-group">
                            <label>Line</label>
                            <input type="text" class="form-control" name="line" id="line" value="<?php echo $line ?>">
                        </div>
                        <div class="form-group">
                            <label>BBM</label>
                            <input type="text" class="form-control" name="bbm" id="bbm" value="<?php echo $bbm ?>">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section><!-- /.content -->
    
</aside><!-- /.right-side -->

<?php require("footer.php"); ?>