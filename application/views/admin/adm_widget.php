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
		<!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning">
                    <div class="box-header"><h3 class="box-title"><i class="fa fa-list" ></i> Daftar Widget</h3></div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th><input onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" type="checkbox"></th>
                                <th>Nama Widget</th>
                                <th>Keterangan Widget</th>
                                <th>Urutan</th>
                                <th align="right">Tampilkan</th>
                                <th align="right">Edit</th>
                            </tr>
                            </thead>
                            <tbody id="datadetail">
                                <?php
                                foreach ($widget as $k) {
                                    # code...
                                    echo '<tr>
                                            <td></td>
                                            <td>'.$k['nama'].'</td>
                                            <td>'.$k['keterangan'].'</td>
                                            <td>'.$k['urutan'].'</td>
                                            <td>'.$k['publish'].'</td>
                                            <td></td>
                                        </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <!--<a data-original-title="Add New" href="#" data-toggle="tooltip" title="" class="btn btn-primary"><i class="fa fa-plus"></i></a>-->
                        <button type="button" class="btn btn-primary" name="add" id="add" ><i class="fa fa-plus"></i></button>
                        <!--<a type="button" title="" class="btn btn-danger" onclick="confirm('Are you sure?') ? $('#form-information').submit() : false;"><i class="fa fa-trash-o"></i></a>-->
                    </div>
                </div>
            </div>
        </div>
    </section>
</aside>
<?php require("footer.php"); ?>