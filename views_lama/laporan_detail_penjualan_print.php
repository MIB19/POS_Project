
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
	<h2>Laporan Detail Transaksi Penjualan</h2>
	<div style="width:100%; text-align: center;padding: 5px;font-size: 13px;"  id="div_print">
		
		<table style="width:100%; padding-right;10px;border: 0.1px solid gray;border-top: 0.1px solid gray;">
		
			<thead>
				<tr onClick="" style="border: 0.1px solid gray;border-top: 0.1px solid gray;">
					<th hidden></th>
					<th>NoTrans</th>
					<th>Tanggal</th>
					<th>Meja</th>
					<th>Pgwai_Input</th>
					<th hidden>Kasir</th>
					<th>Pesanan</th>
					<th>Harga</th>
					<th>QTY</th>
					<th hidden>QTY</th>
					<th>Diskon</th>
					<th>SubTotal</th>
					<th>Service</th>
					<th>PPN</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$no = 1; 
					$tls1 = 0;$tls2 = 0;$tls3 = 0;$tls4 = 0;$tls5 = 0;$tls6 = 0;
					$utid = 0;
					$utaddon = 0;
					foreach($show_laporan as $row){ 
						if($utid != $row['id']){
							if($row['no_meja'] == '103'){ 
								$hr		 = number_format(($row['hrg']*10/11),0,"","")*$row['total'];
							}else{
								$hr		 = number_format($row['hrg'],0,"","")*$row['total'];
							}
							$service = 0;
							$ppn 	 = 0;
							
							if($row['no_meja'] == '103'){ 
								$ds = ($row['discount_type']*10/11)*$row['total'];
							}else if($row['no_meja'] == '104'){ 
								$ds = ($row['discount_type']*$row['total']);
							}else{
								$ds	= $hr*number_format($row['dis'],0,"","")/100;
							}
							
							if($row['biaya_service'] == '1'){
								$service = ($hr-$ds)*5/100;
							}if($row['biaya_ppn'] == '1' || $row['no_meja'] == '103'){
								$ppn	 = ($hr-$ds)*10/100;
							}if($row['no_meja'] == '104'){
								$ppn	 = ($hr)/115*10;
								$service = ($hr)/115*5;
								$hr		 = $hr/115*100;
							}

							$sbtl = $hr - $ds;
							$gr_ttl	 = $hr+$service+$ppn-$ds;
							$tls1 = $tls1+number_format($row['hrg'],0,"","");
							$tls2 = $tls2+$row['total'];
							$tls3 = $tls3+$sbtl;
							$tls4 = $tls4+$service;
							$tls5 = $tls5+$ppn;
							$tls6 = $tls6+$gr_ttl;
							
							$nmj = $row['no_meja'];
							if($row['no_meja'] == '0'){
								$nmj = 'Meeting';
							}else if($row['no_meja'] == '101'){
								$nmj = 'VIP';
							}else if($row['no_meja'] == '102'){
								$nmj = 'Delivery';
							}else if($row['no_meja'] == '103'){
								$nmj = 'Grab';
							}else if($row['no_meja'] == '104'){
								$nmj = 'Gojek';
							}else if($row['no_meja'] == '105'){
								$nmj = 'Marketing';
							}else if($row['no_meja'] == '106'){
								$nmj = 'Operasional';
							}else if($row['no_meja'] == '107'){
								$nmj = 'Owner';
							}
							$id_us = $row['id_trans'];
							$nil = $id_us;
							$sasa = strlen($id_us);
							if($sasa == '1'){
								$sasa = '000'.$id_us;
							}else if($sasa == '2'){
								$sasa = '00'.$id_us;
							}else if($sasa == '3'){
								$sasa = '0'.$id_us;
							}else if($sasa == '4'){
								$sasa = $id_us;
							}else{
								$sasa = $id_us;
							}
						?>
							<tr style="border: 0.1px solid gray;border-top: 0.1px solid gray;">
								<td hidden><?php echo $no;?></td>
								<td><?php echo date('ym', ($row['date_add']+18000));?><?php echo $sasa;?></td>
								<td><?php echo date('m/d/Y h:i:s', ($row['date_add']+18000));?></td>
								<td><?php echo $nmj;?></td>
								<td><?php echo $row['ckode'];?></td>
								<td hidden><?php echo $row['kasir'];?></td>
								<td><?php echo $row['nm_brg'];?></td>
								<td align="right">
									<?php 
										if($row['no_meja'] == '103'){ 
											echo number_format($row['hrg']*10/11);
										}else if($row['no_meja'] == '104'){ 
											echo number_format($row['hrg']/115*100);
										}else{
											echo number_format($row['hrg']);
										}
									?>
								</td>
								<td><?php echo $row['total'];?></td>
								<td><?php echo number_format($ds);?></td>
								<td hidden><?php echo $row['total'];?></td>
								<td align="right"><?php echo number_format($sbtl); ?></td>
								<td align="right"><?php echo number_format($service);?></td>
								<td align="right"><?php echo number_format($ppn);?></td>
								<td align="right"><?php echo number_format($gr_ttl);?></td>
							</tr>
				<?php 
							$no++; 
						}
						if($row['id_addon'] != null){
							$hr		 = (number_format($row['harga_brg_add_on'],0,"","")*$row['total_brg_add_on']) * $row['total'];
							$service = 0;
							$ppn 	 = 0;
							
							$ds	 	 = $hr*number_format($row['dis'],0,"","")/100;
							if($row['biaya_service'] == '1'){
								$service = ($hr-$ds)*5/100;
							}if($row['biaya_ppn'] == '1'){
								$ppn	 = ($hr-$ds)*10/100;
							}
							
							$sbtl = $hr - $ds;
							$gr_ttl	 = $hr+$service+$ppn-$ds;
							$tls1 = $tls1+number_format($row['harga_brg_add_on'],0,"","");
							$tls2 = $tls2+($row['total_brg_add_on']*$row['total']);
							$tls3 = $tls3+$sbtl;
							$tls4 = $tls4+$service;
							$tls5 = $tls5+$ppn;
							$tls6 = $tls6+$gr_ttl;
							$id_us = $row['id_trans'];
							$nil = $id_us;
							$sasa = strlen($id_us);
							if($sasa == '1'){
								$sasa = '000'.$id_us;
							}else if($sasa == '2'){
								$sasa = '00'.$id_us;
							}else if($sasa == '3'){
								$sasa = '0'.$id_us;
							}else if($sasa == '4'){
								$sasa = $id_us;
							}else{
								$sasa = $id_us;
							}
				?>
							<tr style="border: 0.1px solid gray;border-top: 0.1px solid gray;">
								<td hidden><?php echo $no;?></td>
								<td><font color="red"><?php echo date('ym', ($row['date_add']+18000));?><?php echo $sasa;?></font></td>
								<td><font color="red"><?php echo date('m/d/Y h:i:s', ($row['date_add']+18000));?></font></td>
								<td><font color="red"><?php echo $nmj;?></font></td>
								<td><font color="red"><?php echo $row['ckode'];?></font></td>
								<td hidden></td>
								<td><?php echo $row['nama_brg_add_on'];?></td>
								<td align="right"><?php echo number_format($row['harga_brg_add_on']);?></td>
								<td><?php echo $row['total_brg_add_on']*$row['total'];?></td>
								<td><?php echo number_format($ds); ?></td>
								<td hidden><?php echo $row['total']*$row['total_brg_add_on'];?></td>
								<td align="right"><?php echo number_format($sbtl); ?></td>
								<td align="right"><?php echo number_format($service);?></td>
								<td align="right"><?php echo number_format($ppn);?></td>
								<td align="right"><?php echo number_format($gr_ttl);?></td>
							</tr>
				<?php 
						}
						$utid = $row['id'];
						
					} 
				?>
				
			</tbody>
		</table>
		<div style="text-align:center;margin-top:16px;margin-bottom:16px;">
			Total Harga &nbsp;<input type="text" id="inputan1" style="width:100px;border-color:none;" disabled/>&nbsp;&nbsp;&nbsp;
			QTY &nbsp;<input type="text" id="inputan2" value="<?php echo "11";?>" style="width:100px;" disabled/>&nbsp;&nbsp;&nbsp;
			SubTotal &nbsp;<input type="text" id="inputan3" value="<?php echo "100,000";?>" style="width:100px;" disabled/>&nbsp;&nbsp;&nbsp;
			Service &nbsp;<input type="text" id="inputan4" value="<?php echo "100,000";?>" style="width:100px;" disabled/>&nbsp;&nbsp;&nbsp;
			PPN &nbsp;<input type="text" id="inputan5" value="<?php echo "100,000";?>" style="width:100px;" disabled/>&nbsp;&nbsp;&nbsp;
			Total &nbsp;<input type="text" id="inputan6" value="<?php echo "100,000";?>" style="width:100px;" disabled/>
		</div>
	</div>

</div>
<script>
document.getElementById('inputan1').value = "<?php echo number_format($tls1);?>";
	document.getElementById('inputan2').value = "<?php echo number_format($tls2);?>";
	document.getElementById('inputan3').value = "<?php echo number_format($tls3);?>";
	document.getElementById('inputan4').value = "<?php echo number_format($tls4);?>";
	document.getElementById('inputan5').value = "<?php echo number_format($tls5);?>";
	document.getElementById('inputan6').value = "<?php echo number_format($tls6);?>";
	// window.print();
	window.close();
</script>