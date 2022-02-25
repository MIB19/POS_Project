<link href="<?php echo $config->base_url();?>styles/style.css" rel="stylesheet" />
	
</style>
<style>

@page { size: landscape; }
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 16px;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}
</style>
<div class="card_table" style="margin-left:1%;margin-right:1%;margin-top:1%;">
	<h2>Laporan TopUp & Deposit</h2>	
	<div style="width:100%; text-align: center;padding: 5px;font-size: 13px;"  id="div_print">
		
		<table id="datatable" class="display" style="width:100%; padding-right;10px;">
		
			<thead>
				<tr onClick="" style="border: 0.1px solid gray;border-top: 0.1px solid gray;">
					<th>No</th>
					<th hidden>t1</th>
					<th hidden>t2</th>
					<th hidden>t3</th>
					<th>kode_tr</th>
					<th>barcode</th>
					<th>Keterangan</th>
					<th>kasir</th>
					<th>type_bayar</th>
					<th>nominals</th>
					<th>date_add</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$no = 1; $t1 = 0; $t2 = 0; $t3 = 0; 
					foreach($show_laporan as $row){ 
						$tpbyr = '-';
						if($row['type_bayar'] == '1'){
							$tpbyr = 'Tunai';
						}else if($row['type_bayar'] == '2'){
							$tpbyr = 'Debit';
						}else if($row['type_bayar'] == '3'){
							$tpbyr = 'Kartu Kredit';
						}
				?>
						<tr style="border: 0.1px solid gray;border-top: 0.1px solid gray;">
							<td><?php echo $no;?></td>
							<td hidden><?php if($row['keterangan'] == 'DEPOSIT AWAL'){ echo $row['nominals']; $t1 = $t1+$row['nominals']; }else{ echo 0; }?></td>
							<td hidden><?php if($row['keterangan'] == 'TOP UP'){ echo $row['nominals']; $t2 = $t2+$row['nominals']; }else{ echo 0; }?></td>
							<td hidden><?php if($row['keterangan'] == 'Pemakaian Deposit'){ echo $row['nominals']; $t3 = $t3+$row['nominals']; }else{ echo 0; }?></td>
							<td><?php echo $row['kode_tr'];?></td>
							<td><?php echo $row['barcode'];?></td>
							<td><?php echo $row['keterangan'];?></td>
							<td><?php echo $row['kasir'];?></td>
							<td><?php echo $tpbyr;?></td>
							<td align=right><?php echo number_format($row['nominals']);?></td>
							<td><?php echo  date('d/m/Y h:i:s', $row['date_add']+18000);?></td>
						</tr>
				<?php 
						$no++; 
					}
				?>
				</tr>
				
			</tfoot>
		</table>
			<div style="text-align:left;margin-top:16px;">
			<div>
				Deposite Awal &nbsp;<input type="text" id="inputan1" value="<?php echo "0";?>" style="width:100px;text-align:center;" disabled/>&nbsp;&nbsp;&nbsp;
				TopUp Deposit &nbsp;<input type="text" id="inputan2" value="<?php echo "0";?>" style="width:100px;text-align:center;" disabled/>&nbsp;&nbsp;&nbsp;
				Pemakaian Deposit &nbsp;<input type="text" id="inputan3" value="<?php echo "0";?>" style="width:100px;text-align:center;" disabled/>&nbsp;&nbsp;&nbsp;
				<input name="b_print" type="button" class="ipt" style="width:120px"  onClick="printdiv('div_print');" value=" Print ">
			</div>
		</div>
	</div>
	


</div>

<script>
	document.getElementById('inputan1').value = "<?php echo number_format($t1);?>";
	document.getElementById('inputan2').value = "<?php echo number_format($t2);?>";
	document.getElementById('inputan3').value = "<?php echo number_format($t3);?>";
	// window.print();
	window.close();
</script>