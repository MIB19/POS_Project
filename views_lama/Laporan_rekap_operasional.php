<script src="<?php echo $config->base_url();?>styles/nm.js"></script>
<script src="<?php echo $config->base_url();?>styles/st.js"></script>
<div class="card_table" style="margin-left:1%;margin-right:1%;margin-top:1%;">
	<h2>Laporan Rekap Operasional</h2>

	<form method="POST" action="<?php echo $config->base_url();?>laporan_rekap_operasional_filter.html">
		Periode Tanggal &nbsp;<input type="date" name="date1" <?php if($d1==null){ ?>value="<?php echo date("Y-m-d");?>" <?php }else{ ?>value="<?php echo $date11;?>"<?php } ?> />&nbsp;&nbsp;&nbsp;
		Sampai Tanggal &nbsp;<input type="date" name="date2"  <?php if($d2==null){ ?>value="<?php echo date("Y-m-d");?>" <?php }else{ ?>value="<?php echo $date21;?>"<?php } ?> />
		<input type="submit" value="Tampilkan"/>
	</form>
	<div style="width:100%; text-align: center;padding: 5px;font-size: 13px;">
		
		<table id="datatable" class="display" style="width:100%; padding-right;10px;">
		
			<thead>
				<tr onClick="">
					<th colspan="10" style="border-top: 0.1px solid black;">Transaksi</th>
					<th colspan="5" style="border-left: 0.1px solid black;border-top: 0.1px solid black;">Pembayaran</th>
				</tr>
				<tr onClick="">
					<th hidden>No</th>
					<th hidden>No</th>
					<th hidden>No</th>
					<th hidden>No</th>
					<th hidden>No</th>
					<th hidden>No</th>
					<th hidden>No</th>
					<th>NoTrans</th>
					<th>Tanggal</th>
					<th>Meja</th>
					<th>Kasir</th>
					<th>DPP</th>
					<th>Service</th>
					<th>PPN</th>
					<th>Ongkir</th>
					<th>Voucher</th>
					<th>Total</th>
					<th style="border-left: 0.1px solid black;">TypeBayar</th>
					<th>Rek/Kartu/Hp</th>
					<th>EDC</th>
					<th>Bank</th>
					<th>Nominal</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$no = 1; 
					$utid = 0;
					$nm = 1; 
					$tls1 = 0;$tls2 = 0;$tls3 = 0;$tls4 = 0;$tls5 = 0;$tls6 = 0;$tls7 = 0;
					foreach($show_laporan as $row){ 
						$jnis = '';
						if($row['id_jenis'] == '1'){
							$jnis = 'Deposit';
						}else if($row['id_jenis'] == '2'){
							$jnis = 'Tunai';
						}else if($row['id_jenis'] == '3'){
							$jnis = 'Debit';
						}else if($row['id_jenis'] == '4'){
							$jnis = 'KKredit';
						}else if($row['id_jenis'] == '5'){
							$jnis = 'Ovo';
						}else if($row['id_jenis'] == '6'){
							$jnis = 'Gopay';
						}else if($row['id_jenis'] == '7'){
							$jnis = 'Transfer';
						}
						$ttt = 0;
						$biaya = 0; 
						$ppn = 0; 
						$service = 0;
						$nmj = '';
						
						if($row['no_meja'] == '105'){
							$nmj = 'Marketing';
						}else if($row['no_meja'] == '106'){
							$nmj = 'Operasional';
						}
						
						$biaya = number_format($row['nominal'],0,"","");
						if($row['biaya_service'] == '1'){
							$service = $biaya*5/100;
						}if($row['biaya_ppn'] == '1'){
							$ppn	 = $biaya*10/100;
						}
						$ttt = $biaya + $service + $ppn - $row['voucher'] + $row['ongkos_kirim'];
						
						if($utid != $row['id']){
							$tls1 = $tls1+1;
							$tls2 = $tls2+$row['nominal'];
							$tls3 = $tls3+$row['ongkos_kirim'];
							$tls4 = $tls4+$ppn;
							$tls5 = $tls5+$ttt;
							$tls6 = $tls6+number_format($row['duids'],0,"","");
							$tls7 = $tls7+number_format($row['voucher'],0,"","");
				?>
							<tr>
								<td hidden><?php echo $no;?></td>
								<td hidden>1</td>
								<td hidden><?php echo number_format($row['nominal']);?></td>
								<td hidden><?php echo number_format($row['ongkos_kirim']);?></td>
								<td hidden><?php echo number_format($ppn);?></td>
								<td hidden><?php echo number_format($ttt);?></td>
								<td hidden><?php echo number_format($row['voucher']);?></td>
								<td><?php echo date('ymd', ($row['date_add']+18000));?><?php echo $row['id'];?></td>
								<td><?php echo date('d/m/Y h:i:s', ($row['date_add']+18000));?></td>
								<td><?php echo $nmj;?></td>
								<td><?php echo $row['id_user'];?></td>
								<td><?php echo number_format($row['nominal']);?></td>
								<td><?php echo number_format($service);?></td>
								<td><?php echo number_format($ppn);?></td>
								<td align="right"><?php echo number_format($row['ongkos_kirim']);?></td>
								<td><?php echo number_format($row['voucher']);?></td>
								<td><?php echo number_format($ttt);?></td>
								<td style="border-left: 0.1px solid black;"><?php echo $jnis;?></td>
								<td><?php echo $row['keterangan'];?></td>
								<td><?php if($row['edc'] != null){ echo "EDC_".$row['edc']; }?></td>
								<td><?php if($row['bank'] != null){ echo "Bank_".$row['bank']; }?></td>
								<td><?php echo number_format($row['duids']);?></td>
							</tr>
				<?php $no++; }else{ ?>
							<tr>
								<td hidden><?php echo $no;?></td>
								<td hidden>0</td>
								<td hidden>0</td>
								<td hidden>0</td>
								<td hidden>0</td>
								<td hidden>0</td>
								<td hidden>0</td>
								<td><font color="red"><?php echo date('ymd', ($row['date_add']+18000));?><?php echo $row['id'];?></font></td>
								<td><font color="red"><?php echo date('d/m/Y h:i:s', ($row['date_add']+18000));?></font></td>
								<td><font color="red"><?php echo $row['nmj'];?></font></td>
								<td><font color="red"><?php echo $row['id_user'];?></font></td>
								<td><font color="red"><?php echo number_format($row['nominal']);?></font></td>
								<td><font color="red"><?php echo number_format($service);?></font></td>
								<td><font color="red"><?php echo number_format($ppn);?></font></td>
								<td><font color="red"><?php echo number_format($row['ongkos_kirim']);?></font></td>
								<td><font color="red"><?php echo number_format($row['voucher']);?></font></td>
								<td><font color="red"><?php echo number_format($ttt);?></font></td>
								<td style="border-left: 0.1px solid black;"><?php echo $jnis;?></td>
								<td><?php echo $row['keterangan'];?></td>
								<td><?php echo $row['edc'];?></td>
								<td><?php if($row['bank'] != null){ echo "Bank_".$row['bank']; }?></td>
								<td><?php echo number_format($row['duids']);?></td>
							</tr>
					<?php $tls6 = $tls6+number_format($row['duids'],0,"",""); }
						$utid = $row['id'];
					} ?>
			</tfoot>
		</table>
		<div style="text-align:center;margin-top:16px;margin-bottom:16px;">
			Total Transaksi &nbsp;<input type="text" id="inputan1" style="width:30px;text-align:center;" disabled/>&nbsp;&nbsp;&nbsp;
			Voucher &nbsp;<input type="text" id="inputan7" value="<?php echo "0";?>" style="width:90px;text-align:center;" disabled/>&nbsp;&nbsp;&nbsp;
			Ongkir &nbsp;<input type="text" id="inputan3" value="<?php echo "0";?>" style="width:70px;text-align:center;" disabled/>&nbsp;&nbsp;&nbsp;
			SubTotal &nbsp;<input type="text" id="inputan5" value="<?php echo "0";?>" style="width:90px;text-align:center;" disabled/>&nbsp;&nbsp;&nbsp;
			<input type="text" id="inputan4" value="<?php echo "0";?>" style="width:70px;text-align:center;" hidden/>
			<input type="text" id="inputan2" value="<?php echo "0";?>" style="width:90px;text-align:center;" hidden/>
			Pembayaran &nbsp;<input type="text" id="inputan6" value="<?php echo "0";?>" style="width:90px;text-align:center;" disabled/>
		</div>
	</div>
</div>
<script>
	document.getElementById('inputan1').value = "<?php echo number_format($tls1);?>";
	document.getElementById('inputan3').value = "<?php echo number_format($tls3);?>";
	document.getElementById('inputan4').value = "<?php echo number_format($tls4);?>";
	document.getElementById('inputan5').value = "<?php echo number_format($tls5);?>";
	document.getElementById('inputan6').value = "<?php echo number_format($tls6);?>";
	document.getElementById('inputan7').value = "<?php echo number_format($tls7);?>";
	
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
		var columnsToSum = [1],columnsToSum1 = [2],columnsToSum2 = [3],columnsToSum3 = [4],columnsToSum4 = [5],columnsToSum5 = [21];columnsToSum6 = [6];
		sum1 = 0, sum2 = 0, sum3 = 0, sum4 = 0, sum5 = 0, sum6 = 0, sum7 = 0;
		for (i = 0; i < columnsToSum.length; i++) {
			a = columnsToSum[i],b = columnsToSum1[i],c = columnsToSum2[i],d = columnsToSum3[i],e = columnsToSum4[i],f = columnsToSum5[i],g = columnsToSum6[i];
			for (j = 0; j < all.length; j++) {

				var val = all[j].getElementsByTagName('td')[a].innerHTML;
				var val1 = all[j].getElementsByTagName('td')[b].innerHTML;
				var val2 = all[j].getElementsByTagName('td')[c].innerHTML;
				var val3 = all[j].getElementsByTagName('td')[d].innerHTML;
				var val4 = all[j].getElementsByTagName('td')[e].innerHTML;
				var val5 = all[j].getElementsByTagName('td')[f].innerHTML;
				var val6 = all[j].getElementsByTagName('td')[g].innerHTML;
				sum1 += isNaN(val.split(',').join("")) ? 0 : parseInt(val.split(',').join(""));
				sum2 += isNaN(val1.split(',').join("")) ? 0 : parseInt(val1.split(',').join(""));
				sum3 += isNaN(val2.split(',').join("")) ? 0 : parseInt(val2.split(',').join(""));
				sum4 += isNaN(val3.split(',').join("")) ? 0 : parseInt(val3.split(',').join(""));
				sum5 += isNaN(val4.split(',').join("")) ? 0 : parseInt(val4.split(',').join(""));
				sum6 += isNaN(val5.split(',').join("")) ? 0 : parseInt(val5.split(',').join(""));
				sum7 += isNaN(val6.split(',').join("")) ? 0 : parseInt(val6.split(',').join(""));
				
			}
			
		}
		document.getElementById('inputan1').value = numeral(sum1).format('0,0.[00]');
		document.getElementById('inputan2').value = numeral(sum2).format('0,0.[00]');
		document.getElementById('inputan3').value = numeral(sum3).format('0,0.[00]');
		document.getElementById('inputan4').value = numeral(sum4).format('0,0.[00]');
		document.getElementById('inputan5').value = numeral(sum5).format('0,0.[00]');
		document.getElementById('inputan6').value = numeral(sum6).format('0,0.[00]');
		document.getElementById('inputan7').value = numeral(sum7).format('0,0.[00]');
	}
</script>

