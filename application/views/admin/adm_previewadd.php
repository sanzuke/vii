<?php require("header.php"); ?>
<script type="text/javascript">
    $(document).ready(function(){
        // upload foto 
        var options = { 
            url     : "<?php echo base_url();?>admpreview/save/",
            type : "POST",
            data    : $("#myform").serialize(),
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
                alert(response.responseText);
                window.location ='<?php echo base_url() ?>admpreview';
            },
            error: function()
            {
                $("#message").html("<font color='red'> ERROR: unable to upload files</font>");
                alert('ERROR: unable to upload files');
            }
        }
        $("#myform").ajaxForm(options);
    });
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
    	<div class="col-md-12">
            <div class="box box-primary">
                <form id="myform" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="alert alert-success" id="message">qwertyui</div>
                    <div class="form-group">
                        <label for="produk">Produk</label>
                        <select class="form-control" name="produk" id="produk">
                            <option value="">[ Pilih ]</option>
                            <?php 
                            foreach ($produk->result_array() as $key => $value) {
                                echo '<option value="'.$value['productcode'].'">'.$value['productname'].' ['.$value['productcode'].']</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" name="judul" class="form-control">
                        <input type="hidden" name="id" value="<?php echo $this->uri->segment(3) ?>">
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" name="keterangan" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" name="userfile" id="userfile" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Posisi Text</label>
                        <select name="text-pos" class="form-control">
                            <option value="">[ Pilih ]</option>
                            <option value="top-left">Atas Kiri</option>
                            <option value="top-center">Atas Tengah</option>
                            <option value="top-right">Atas Kanan</option>
                            <option value="center-left">Tengah Kiri</option>
                            <option value="center-center">Tengah Tengah</option>
                            <option value="center-right">Tengah Kanan</option>
                            <option value="bottom-left">Bawah Kiri</option>
                            <option value="bottom-center">Bawah Tengah</option>
                            <option value="bottom-right">Bawah Kanan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Kolom</label>
                        <input type="number" name="kolom" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>No. Urut</label>
                        <input type="number" name="seq" class="form-control">
                    </div>
                </div>
                <div class="box-footer">
                    <button class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </div>
        </div>
    </section>
</aside>
<?php require("footer.php"); ?>