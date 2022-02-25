<div class="card_table" style="margin-left:1%;margin-right:1%;margin-top:1%;">
	<h2>Laporan Rekap Transaksi Penjualan</h2>

	<form>
		Periode Tanggal &nbsp;<input type="date" value="<?php echo date("Y-m-d");?>" />&nbsp;&nbsp;&nbsp;
		Sampai Tanggal &nbsp;<input type="date" value="<?php echo date("Y-m-d");?>" />
		<input type="submit" value="Tampilkan"/>
	</form>
	<div style="width:100%; text-align: center;padding: 5px;font-size: 13px;">
		
		<table id="example" class="display" style="width:100%; padding-right;10px;">
		
			<thead>
				<tr onClick="">
					<th colspan="7">Transaksi</th>
					<th colspan="8">Pembayaran</th>
				</tr>
				<tr onClick="">
					<th>No</th>
					<th>Tanggal</th>
					<th>Meja</th>
					<th>DPP</th>
					<th>Service</th>
					<th>PPN</th>
					<th>Ongkir</th>
					<th>Deposit</th>
					<th>Tunai</th>
					<th>Debit</th>
					<th>Kartu Kredit</th>
					<th>Transfer</th>
					<th>OVO</th>
					<th>GoPay</th>
					<th>Voucher</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$no = 1; 
					foreach($show_laporan as $row){ 
						$hr		 = number_format($row['nominal'],0,"","");
						$service = 0;
						$ppn 	 = 0;
						if($row['biaya_service'] == '1'){
							$service = $hr*5/100;
						}if($row['biaya_ppn'] == '1'){
							$ppn	 = $hr*10/100;
						}
						$ds	 = $hr*10/100;
						$gr_ttl	 = $hr+$service+$ppn;
				?>
							<tr>
								<td><?php echo $no;?></td>
								<td><?php echo date('m/d/Y h:i:s', ($row['date_add']+18000));?></td>
								<td><?php echo $row['no_meja'];?></td>
								<td align="right"><?php echo number_format($row['nominal']);?></td>
								<td><?php echo $service;?></td>
								<td><?php echo $ppn;?></td>
								<td align="right"><?php echo number_format($ongkos_kirim); ?></td>
								<th><?php echo number_format($row['deposit']);?></th>
								<td><?php echo number_format($row['tunai']);?></td>
								<td><?php echo number_format($row['debit']);?></td>
								<td><?php echo number_format($row['kk']);?></td>
								<td><?php echo number_format($row['ovo']);?></td>
								<td><?php echo number_format($row['gopay']);?></td>
								<td><?php echo number_format($row['transfer']);?></td>
								<td><?php echo number_format($row['voucher']);?></td>
							</tr>
				<?php 
						$no++; 
					} 
				?>
				
				</tr>
				
			</tfoot>
		</table>

	</div>
</div>

