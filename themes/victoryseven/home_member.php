<?php 
	$hutang  = $this->db->query("SELECT SUM(td.price*td.qty) as total FROM um_transactiondetails td, um_transaction t WHERE td.transactioncode = t.transactioncode AND t.status = '0'"); 
	if($hutang->num_rows() > 0){
		$r = $hutang->row();
		$row = $hutang->num_rows();
		$jml = $r->total;
	} else {
		$row = 0;
		$jml = 0;
	}

	$getHis = $this->db->query("SELECT transactioncode FROM um_transaction WHERE status = '1'");
	if($getHis->num_rows() > 0){
		$hist = $getHis->num_rows();
	} else {
		$hist = 0 ;
	}
?>
<div class="col-md-6">
	<div class="panel panel-default">
		<div class="panel-body">
			Jumlah Transaksi Anda : <h3><i class="fa fa-shopping-cart"></i> <?php echo number_format($row) ?> Faktur</h3>
		</div>
	</div>
</div>

<div class="col-md-6">
	<div class="panel panel-default">
		<div class="panel-body">
			Jumlah yang harus dibayar : <h3><i class="fa fa-money"></i> <?php echo number_format($jml) ?></h3>
		</div>
	</div>
</div>

<div class="col-md-6">
	<div class="panel panel-default">
		<div class="panel-body">
			Histori Pembelian : <h3><i class="fa fa-history"></i> <?php echo number_format($hist) ?></h3>
		</div>
	</div>
</div>

<div class="col-md-6">
	<div class="panel panel-default">
		<div class="panel-body">
			Poin : <h3><i class="fa fa-plus"></i> <?php echo number_format($hist) ?></h3>
		</div>
	</div>
</div>