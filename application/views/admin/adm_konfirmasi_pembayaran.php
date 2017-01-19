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
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-header">
                        <h3 class="box-title">List Konfirmasi Pembayaran</h3>
                        <div class="box-tools">
                            <div class="input-group">
                                <input type="text" name="search" id="search" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-default" id="btn-search"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th width="100">No. Faktur</th>
                        <th>Produk</th>
                        <th>Edit/Delete</th>
                    </tr>
                </thead>
                <tbody id="datadetail">
                    
                </tbody>
                </table>
            </div>
        </div>
    </div>

    </section><!-- /.content -->
    
</aside><!-- /.right-side -->
<?php require("footer.php"); ?>