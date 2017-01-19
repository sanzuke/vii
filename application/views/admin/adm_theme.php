<?php require("header.php"); ?>
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
    <form role="form" method="post" action="<?php echo base_url() ?>admtheme/saveTheme">
    <?php
    $msg = $this->session->flashdata('note');
    $status = $this->session->flashdata('status');
    if($status == "1" && $msg != ""){
        echo '<div class="alert alert-success"><strong>Berhasil!</strong>'.$msg.'</div>';
    } elseif($status == "0" && $msg != ""){
        echo '<div class="alert alert-danger"><strong>Gagal!</strong>'.$status.'</div>';
    } else {
        echo '';
    }
    ?>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Daftar Tema</h3>
            <!--<div class="box-tools">
                <button name="edit" id="edit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
            </div>-->
            <div class="input-group" style=" margin-top:10px; margin-right:10px;">
                <input name="table_search" class="form-control input-sm pull-right" style="width: 250px;" placeholder="Search" type="text">
                <div class="input-group-btn">
                    <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body table-responsive">
            <?php
                //$target = realpath(dirname(__FILE__) ) . '\..\..\..\themes\\'; // for window server
                $target = realpath(dirname(__FILE__) ) . '/../../../themes/'; // for linux server
                //$target = '/var/www/html/product/dev-portal/application/views/theme/';
                $weeds = array('.', '..');
                $directories = array_diff(scandir($target), $weeds);
                   
                foreach($directories as $value)
                {
                   if(is_dir($target.$value))
                   {

                    $string = file_get_contents($target.$value."/readme.json");
                    //$imgPath = $target.$value."/screenshot.png";
                    $json_a = json_decode($string, true);

                    foreach ($json_a as $person_name => $person_a) {
                        $name = $person_a['name'];
                        $versi = $person_a['version'];
                        $author = $person_a['author'];
                        $keterangan = $person_a['keterangan'];
                    }
                    /*
                    $cek = $this->db->query("SELECT * FROM app_themes WHERE themesname = '$value' ");
                
                    if(count($cek->result_array()) < 1 ){
                        $data = array(
                            'themesname'    => $value,
                            'themeversion'  => $versi, //'1.5',
                            'enable'        => 0,
                            'themesdesc'    => $keterangan, //'tester'
                            'author'        => $author
                        );
                        $result = $this->db->insert('app_themes', $data );
                    }
                    */
                    ?>
                    <div class="col-md-6" >
                        <div class="panel panel-default">
                            <div class="panel-heading"><b><?php echo $name ?></b></div>
                            <div class="panel-body">
                                <div style="min-height:300px;">
                                    <div class="col-md-6" style="height:120px; overflow:hidden" >
                                        <img src="<?php echo base_url() ."themes/" .$value."/screenshot.png" ?>" class="thumbnail">
                                    </div>
                                    <div class="col-md-6">
                                        <p><b>Name : </b><?php echo $name ?></p>
                                        <p><b>Versi : </b><?php echo $versi ?></p>
                                        <p><b>Author: </b><?php echo $author ?></p>
                                    </div>
                                    <div class="col-md-12"><br>
                                        <p><?php echo $keterangan ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <?php if($aktiftheme == $value){ ?>
                                <button class="btn btn-success" disabled="disabled" ><i class="fa fa-check"></i> Tema Digunakan</button>
                                <?php } else { ?>
                                <button class="btn btn-primary" id="save" name="theme" value="<?php echo $value ?>" ><i class="fa fa-cycle-o"></i> Gunakan Tema</button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php
                  }
                }
            ?>
            <div style="clear:both"></div>
        </div><!-- /.box-body -->
    </div><!-- /.box -->

    </form>
    </section><!-- /.content -->
    
</aside><!-- /.right-side -->


<?php require("footer.php"); ?>