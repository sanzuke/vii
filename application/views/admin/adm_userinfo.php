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
            <h3 class="box-title">Daftar Pengguna</h3>
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

            <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama Pengguna</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Edit</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($userinfo as $key => $value) {
                        ?>
                        <tr>
                            <td><?php echo $value['name'] ?></td>
                            <td><?php echo $value['email'] ?></td>
                            <td><?php 
                                switch($value['status']){
                                    case '1' : echo 'Admin';
                                    break;
                                    case '2' : echo 'Operator';
                                    break;
                                    case '3' : echo 'Konsumen';
                                }
                                ?></td>
                            <?php 
                            if($value['usercode'] != 'USR-00000000000'){
                            ?>
                            <td><button name="edit" id="edit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button></td>
                            <td><button name="del" id="del" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button></td>
                            <?php 
                            } else {
                            ?>
                            <td>-</td>
                            <td>-</td>
                            <?php
                            } 
                            ?>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->

    </form>
    </section><!-- /.content -->
    
</aside><!-- /.right-side -->

<form id="myform">
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Tambah Halaman Baru</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="title">Judul Halaman</label>
                    <input type="text" name="title" id="title" class="form-control" >
                    <input type="hidden" name="id" id="id" class="form-control" >
                    <input type="hidden" name="userid" id="userid" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="desc">Deskripsi</label>
                    <textarea id="desc" name="desc" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="tagtitle">Meta Tag title</label>
                    <input type="text" name="tagtitle" id="tagtitle" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="tagdesc">Meta Tag Description</label>
                    <input type="text" name="tagdesc" id="tagdesc" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="tagkeyword">Meta Tag Keyword</label>
                    <input type="text" name="tagkeyword" id="tagkeyword" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="seq">Urutan</label>
                    <input type="text" name="seq" id="seq" class="form-control" >
                </div>
                <!--<p>Do you want to save changes you made to document before closing?</p>
                <p class="text-warning"><small>If you don't save, your changes will be lost.</small></p>-->
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</form>

<?php require("footer.php"); ?>