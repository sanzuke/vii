<table class="table table-striped table-bordered" id="dataTabel">
	<thead>
		<tr>
			<th>No.</th>
			<th>Kode Transaksi</th>
			<th>Tanggal</th>
			<th>Qty</th>
			<th>Jumlah</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$list = $this->db->query("SELECT *, 
			(
			SELECT SUM(qty) FROM um_transactiondetails WHERE transactioncode = t.transactioncode
			) as qty_sum,
			(
				SELECT SUM(price*qty) FROM um_transactiondetails WHERE transactioncode = t.transactioncode
			) as total 
			FROM um_transaction t WHERE t.status = '0'");
		$i = 1;
		foreach ($list->result_array() as $key => $value) {
			echo '<tr>
					<td>'.$i.'</td>
					<td>'.$value['transactioncode'].'</td>
					<td>'.date("d/m/Y", strtotime($value['date'])).'</td>
					<td>'.number_format($value['qty_sum']).'</td>
					<td>'.number_format($value['total']).'</td>
					<td>Proses</td>
				</tr>';
			$i++;
		}
		?>
	</tbody>
</table>