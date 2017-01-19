<?php require("header.php"); ?>
<?php
$foto = "";
$title ="";
$keterangan = "";
$pub = "";
$link = "";
$judul = "";
$updateFile = "false";
if($id != ""){
  foreach ($banner as $value) {
    # code...
    $foto = $value['foto'];
    $title = $value['title'];
    $keterangan = $value['keterangan'];
    $pub = $value['publish'];
    $link = $value['link'];
    $judul = $value['judul'];
    $updateFile = "true";
  }
}
?>
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
    <form role="form" id="myformfoto">
        <input type="hidden" name="updateFile" id="updateFile" value="<?php echo $updateFile ?>" >
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Daftar Banner</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="form-group">
                    <label>Judul</label>
                    <input class="form-control" type="text" name="title" id="title" value="<?php echo $title ?>" >
                </div>
                <div class="form-group">
                    <label>Foto</label>
                    <input class="form-control" type="file" name="userfile" id="userfile" accept="image/*" value="<?php echo $foto ?>"  >
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <input class="form-control" type="text" name="ket" id="ket" value="<?php echo $keterangan ?>" >
                </div>
                <div class="form-group">
                    <label>Judul Tombol</label>
                    <input class="form-control" type="text" name="judul1" id="judul1" value="<?php echo $judul ?>" >
                </div>
                <div class="form-group">
                    <label>Link</label>
                    <select name="link1" id="link1" class="form-control">
                        <option value="">[Pilih]</option>
                        <?php
                        $qry = $this->db->query("
                            SELECT id, post_title as title, post_type as type FROM cm_post WHERE publish ='1'
                            UNION
                            SELECT productcode as id, productname as title, 'product' as type FROM ss_products WHERE publish = '1' ");
                        foreach ($qry->result_array() as $key => $value) {
                            $title = "(".$value['type'].") ".$value['title'];
                            switch($value['type']){
                                case "page":
                                    $link = base_url() .'page/view/'.$value['id'];
                                break;
                                case "post":
                                    $link = base_url() .'post/view/'.$value['id'];
                                break;
                                case "product" :
                                    $link = base_url() .'product/view/'.$value['id'].'/'.str_replace(" ","-",$value['title']).'.html';
                                break;
                            }
                            echo '<option value="'.$link.'">'.$title.'</option>';
                        }
                        ?>
                    </select>
                </div>
                <!--<div class="form-group">
                    <label>Judul Link 2</label>
                    <input class="form-control" type="text" name="judul2" id="judul2" >
                </div>
                <div class="form-group">
                    <label>Link 2</label>
                    <select name="link2" id="link2" class="form-control">
                        <option value="">[Pilih]</option>
                        <?php
                        $qry = $this->db->query("
                            SELECT id, post_title as title, post_type as type FROM cm_post WHERE publish ='1'
                            UNION
                            SELECT productcode as id, productname as title, 'product' as type FROM ss_products WHERE publish = '1' ");
                        foreach ($qry->result_array() as $key => $value) {
                            $title = "(".$value['type'].") ".$value['title'];
                            switch($value['type']){
                                case "page":
                                    $link = base_url() .'page/view/'.$value['id'];
                                break;
                                case "post":
                                    $link = base_url() .'post/view/'.$value['id'];
                                break;
                                case "product" :
                                    $link = base_url() .'product/view/'.$value['id'].'/'.str_replace(" ","-",$value['title']).'.html';
                                break;
                            }
                            echo '<option value="'.$link.'">'.$title.'</option>';
                        }
                        ?>
                    </select>
                </div>-->
                <span class="msg" ></span>
                <div class="progress">
                    <div class="bar progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div >
                    <div class="percent">0%</div >
                </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div><!-- /.box -->

    </form>
    </section><!-- /.content -->

</aside><!-- /.right-side -->


<?php require("footer.php"); ?>
<script type="text/javascript">
    function deleteBanner(id){
        var psn = confirm("Anda yakin akan menghapus data ini?");
        if(psn){
            $.post("<?php echo base_url() . 'index.php/admbanner/delBanner' ?>",{id:id},function(data){
                if(data === 'true'){
                    window.location.reload();
                } else {
                    alert("Data gagal dihapus");
                }
            })
        }
    }
    $(document).ready(function(){
        // upload foto
        var options = {
            url     : "<?php echo base_url();?>index.php/admbanner/uploadfoto/",
            type : "POST",
            data    : '&ket='+$("#ket").val(),
            beforeSend: function()
            {
                $(".progress").show();
                //clear everything
                $(".bar").width('0%');
                $("#message").html("");
                $(".percent").html("0%");
            },
            uploadProgress: function(event, position, total, percentComplete)
            {
                $(".bar").width(percentComplete+'%');
                $(".percent").html(percentComplete+'%');
            },
            success: function()
            {
                $(".bar").width('100%');
                $(".percent").html('100%');

            },
            complete: function(response)
            {
                $("#message").html("<font color='green'>"+response.responseText+"</font>");
                $(".msg").html("<font color='green'>"+response.responseText+"</font>");
                //alert($("#userfile").val());
                $("#imgproduk").attr("src","<?php echo base_url() . "uploads/" ?>"+$("#userfile").val() )
                window.location.reload();
            },
            error: function()
            {
                $("#message").html("<font color='red'> ERROR: unable to upload files</font>");
            }
        }
        $("#myformfoto").ajaxForm(options);


    })
</script>
