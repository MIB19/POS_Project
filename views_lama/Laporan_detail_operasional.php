<script src="<?php echo $config->base_url();?>styles/nm.js"></script>
<script src="<?php echo $config->base_url();?>styles/st.js"></script>
<div class="card_table" style="margin-left:1%;margin-right:1%;margin-top:1%;">
	<h2>Laporan detail operasional</h2>

	<form method="POST" action="<?php echo $config->base_url();?>laporan_detail_operasional_filter.html">
		Periode Tanggal &nbsp;<input type="date" name="date1" <?php if($d1==null){ ?>value="<?php echo date("Y-m-d");?>" <?php }else{ ?>value="<?php echo $date11;?>"<?php } ?> />&nbsp;&nbsp;&nbsp;
		Sampai Tanggal &nbsp;<input type="date" name="date2"  <?php if($d2==null){ ?>value="<?php echo date("Y-m-d");?>" <?php }else{ ?>value="<?php echo $date21;?>"<?php } ?> />
		<input type="submit" value="Tampilkan"/>
	</form>
	
	<div style="width:100%; text-align: center;padding: 5px;font-size: 13px;"  id="div_print">
		
		<table id="datatable" class="display" style="width:100%; padding-right;10px;">
		
			<thead>
				<tr onClick="">
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
					$disc = 0;
					foreach($show_laporan as $row){ 
						if($row['no_meja'] == '105' || $row['no_meja'] == '106'){
							$disc = 40;
						}
						$nmj = '';
						
						if($row['no_meja'] == '105'){
							$nmj = 'Marketing';
						}else if($row['no_meja'] == '106'){
							$nmj = 'Operasional';
						}
						if($utid != $row['id']){
							$hr		 = number_format($row['hrg'],0,"","")*$row['total'];
							$service = 0;
							$ppn 	 = 0;
							
							$ds	 	 = $hr*number_format($disc,0,"","")/100;
							if($row['biaya_service'] == '1'){
								$service = ($hr-$ds)*5/100;
							}if($row['biaya_ppn'] == '1'){
								$ppn	 = ($hr-$ds)*10/100;
							}
							$sbtl = $hr - $ds;
							$gr_ttl	 = $hr+$service+$ppn-$ds;
							$tls1 = $tls1+number_format($row['hrg'],0,"","");
							$tls2 = $tls2+$row['total'];
							$tls3 = $tls3+$sbtl;
							$tls4 = $tls4+$service;
							$tls5 = $tls5+$ppn;
							$tls6 = $tls6+$gr_ttl;
				?>
							<tr>
								<td hidden><?php echo $no;?></td>
								<td><?php echo date('ymd', ($row['date_add']+18000));?><?php echo $row['id_trans'];?></td>
								<td><?php echo date('m/d/Y h:i:s', ($row['date_add']+18000));?></td>
								<td><?php echo $nmj;?></td>
								<td><?php echo $row['ckode'];?></td>
								<td hidden><?php echo $row['kasir'];?></td>
								<td><?php echo $row['nm_brg'];?></td>
								<td align="right"><?php echo number_format($row['hrg']);?></td>
								<td><?php echo $row['total'];?></td>
								<td><?php echo number_format($ds); ?></td>
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
							
							$ds	 	 = $hr*number_format($disc,0,"","")/100;
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
				?>
							<tr>
								<td hidden><?php echo $no;?></td>
								<td><font color="red"><?php echo date('ymd', ($row['date_add']+18000));?><?php echo $row['id_trans'];?></font></td>
								<td><font color="red"><?php echo date('m/d/Y h:i:s', ($row['date_add']+18000));?></font></td>
								<td><font color="red"><?php echo $nmj;?></font></td>
								<td><font color="red"><?php echo $row['ckode'];?></font></td>
								<td hidden></td>
								<td><?php echo $row['nama_brg_add_on'];?></td>
								<td align="right"><?php echo number_format($row['harga_brg_add_on']);?></td>
								<td><?php echo $row['total_brg_add_on'];?> ( <?php echo $row['total'];?> )</td>
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
				
				</tr>
				
			</tfoot>
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
	
	<input name="b_print" type="button" class="ipt"   onClick="printdiv('div_print');" value=" Print ">

</div>

<script>
	document.getElementById('inputan1').value = "<?php echo number_format($tls1);?>";
	document.getElementById('inputan2').value = "<?php echo number_format($tls2);?>";
	document.getElementById('inputan3').value = "<?php echo number_format($tls3);?>";
	document.getElementById('inputan4').value = "<?php echo number_format($tls4);?>";
	document.getElementById('inputan5').value = "<?php echo number_format($tls5);?>";
	document.getElementById('inputan6').value = "<?php echo number_format($tls6);?>";
	
	$(document).ready(function () {
		var table = $('#datatable').DataTable();
		$('input').on('keyup click', function () {
			var searched = table.rows({
				search: 'applied'
			}).nodes();

			calculatesum(searched);

		});
	});
	
	function calculatesum(all) {
		var columnsToSum = [7],columnsToSum1 = [9],columnsToSum2 = [11],columnsToSum3 = [12],columnsToSum4 = [13],columnsToSum5 = [14];
		sum1 = 0, sum2 = 0, sum3 = 0, sum4 = 0, sum5 = 0, sum6 = 0;
		for (i = 0; i < columnsToSum.length; i++) {
			a = columnsToSum[i],b = columnsToSum1[i],c = columnsToSum2[i],d = columnsToSum3[i],e = columnsToSum4[i],f = columnsToSum5[i];
			for (j = 0; j < all.length; j++) {

				var val = all[j].getElementsByTagName('td')[a].innerHTML;
				var val1 = all[j].getElementsByTagName('td')[b].innerHTML;
				var val2 = all[j].getElementsByTagName('td')[c].innerHTML;
				var val3 = all[j].getElementsByTagName('td')[d].innerHTML;
				var val4 = all[j].getElementsByTagName('td')[e].innerHTML;
				var val5 = all[j].getElementsByTagName('td')[f].innerHTML;
				sum1 += isNaN(val.split(',').join("")) ? 0 : parseInt(val.split(',').join(""));
				sum2 += isNaN(val1.split(',').join("")) ? 0 : parseInt(val1.split(',').join(""));
				sum3 += isNaN(val2.split(',').join("")) ? 0 : parseInt(val2.split(',').join(""));
				sum4 += isNaN(val3.split(',').join("")) ? 0 : parseInt(val3.split(',').join(""));
				sum5 += isNaN(val4.split(',').join("")) ? 0 : parseInt(val4.split(',').join(""));
				sum6 += isNaN(val5.split(',').join("")) ? 0 : parseInt(val5.split(',').join(""));
				
			}
			
		}
		document.getElementById('inputan1').value = numeral(sum1).format('0,0.[00]');
		document.getElementById('inputan2').value = numeral(sum2).format('0,0.[00]');
		document.getElementById('inputan3').value = numeral(sum3).format('0,0.[00]');
		document.getElementById('inputan4').value = numeral(sum4).format('0,0.[00]');
		document.getElementById('inputan5').value = numeral(sum5).format('0,0.[00]');
		document.getElementById('inputan6').value = numeral(sum6).format('0,0.[00]');
	}
	
	function printdiv(printpage){
		var headstr = "<html><head><title></title></head><body>";
		var footstr = "</body>";
		var newstr = document.all.item(printpage).innerHTML;
		var oldstr = document.body.innerHTML;
		document.body.innerHTML = headstr+newstr+footstr;
		window.print();
		document.body.innerHTML = oldstr;
		return false;
	}
</script>