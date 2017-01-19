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
    <form role="form">

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Daftar Banner</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <a href="<?php echo base_url() .'admbanner/add' ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Keterangan</th>
                    <th>Publish</th>
                    <th>Link</th>
                    <th>Option</th>
                </tr>
            </thead>
            <?php
            $i = 1;
            foreach ($banner as $key => $value) {
                # code...
                $jmlLink = explode("|",$value['link']);
                $jmlTitle = explode("|",$value['judul']);
                $str='';
                if( count($jmlLink) > 1){
                    $x = 0;

                    while ($x < count($jmlLink)) {
                        $str .= '<a href="'.$jmlLink[$x].'" class="btn btn-default">'.$jmlTitle[$x].'</a>';
                        $x++;
                    }
                } else {
                    $str .= '<a href="'.$jmlLink[0].'" class="btn">'.$jmlTitle[0].'</a>';
                }
                echo '<tr>
                        <td>'.$i.'</td>
                        <td><img src="'.base_url().'uploads/banner/'.$value['foto'].'" class="thumnail" width="150"></td>
                        <td>'.$value['title'].'</td>
                        <td>'.$value['keterangan'].'</td>
                        <td>'.$value['publish'].'</td>
                        <td>'.$str.'</td>
                        <td>
                            <button class="btn btn-primary" type="button" onclick="editBanner(\''.$value['id'].'\',\''.$value['foto'].'\')"><i class="fa fa-edit"></i> Ubah</button>
                            <button class="btn btn-danger" type="button" onclick="deleteBanner(\''.$value['id'].'\',\''.$value['foto'].'\')"><i class="fa fa-trash-o"></i> Hapus</button>
                        </td>
                      </tr>';
                $i++;
            }
            ?>
            </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->

    </form>
    </section><!-- /.content -->

</aside><!-- /.right-side -->


<?php require("footer.php"); ?>
<script type="text/javascript">
    function deleteBanner(id, name){
        var psn = confirm("ANda yakin akan menghapus data?");
        if(psn == true){
            $.post("<?php echo base_url() . 'index.php/admbanner/delBanner' ?>",{id:id, name:name},function(data){
                if(data === 'true'){
                    //window.location.reload();
                } else {
                    alert("Data gagal dihapus");
                }
            });
        }
    }

    function editBanner(id){
        window.location = '<?php echo base_url() ?>admbanner/add/'+id;
    }
</script>
