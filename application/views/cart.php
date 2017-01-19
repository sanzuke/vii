<div class="heading">
	<a><span id="cart-total"><?php echo $countitem ?> item(s) <strong>Rp <?php echo $total ?></strong></span></a>
</div>
<div class="content">
	<?php if($countitem < 1) { ?>
	<div class="empty">Keranjang Belanja Anda kosong!</div>
	<?php } else { ?>
	<table class="table table-striped">
	<?php $i = 1; ?>
	<?php foreach ($this->cart->contents() as $items): ?>

		<?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>

		<tr>
		  <td colspan="2"><?php echo $items['name'] ?></td>
		</tr>
		<tr>
		  <td>
			Qty : <?php echo $items['qty']; ?>

				<?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>

					<p>
						<?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

							<strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />

						<?php endforeach; ?>
					</p>

				<?php endif; ?>

		  </td>
		  <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
		</tr>

	<?php $i++; ?>

	<?php endforeach; ?>
	</table>
	<div class="btn-group">
		<button class="btn btn-success" onclick="window.location='<?php echo base_url() ?>checkout'">Check Out <i class="fa fa-arrow-right"></i></button>
		<button class="btn btn-danger" onclick="var psn = confirm('Anda yakin akan menghapus semua item dikeranjang?'); if(psn) window.location='<?php echo base_url() ?>cart/emptycart'">Clear <i class="fa fa-times"></i></button>
	</div>
	<?php } ?>
</div>

<script type="text/javascript">
	var count = '<?php echo $countitem ?>';
	if(count > 0){
		$("#countcart").html('<span class="badge"><?php echo $countitem ?></span>');
	}
</script>