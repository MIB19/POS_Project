<script src="<?php echo $config->base_url();?>styles/nm.js"></script>
<script src="<?php echo $config->base_url();?>styles/st.js"></script>
<style>
	.btn_crd{
		cursor:pointer;
		box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
		transition: 0.3s;
		border-radius: 15px;
		float: right;
		color:#000000;
		background:#ffffff;
		font-weight: bold;
		padding:5px;
		padding-left:15px;
		padding-right:15px;
		text-align:center;
		overflow-x:auto;
	}
</style>
<div class="card_table" style="margin-left:1%;margin-right:1%;margin-top:1%;">
	<a onClick="print(2)" class="btn_crd" />Print Shift 2</a>
	<a onClick="print(1)"  class="btn_crd" style="margin-right:10px;" />Print Shift 1</a>
	<h2>Laporan Rekap Transaksi Penjualan</h2>

	<form method="POST" action="<?php echo $config->base_url();?>laporan_rekap_penjualan_filter.html">
		Periode Tanggal &nbsp;<input type="date" name="date1" id="date1" <?php if($d1==null){ ?>value="<?php echo date("Y-m-d");?>" <?php }else{ ?>value="<?php echo $date11;?>"<?php } ?> />&nbsp;&nbsp;&nbsp;
		Sampai Tanggal &nbsp;<input type="date" name="date2"  id="date2" <?php if($d2==null){ ?>value="<?php echo date("Y-m-d");?>" <?php }else{ ?>value="<?php echo $date21;?>"<?php } ?> />
		<input type="submit" value="Tampilkan"/>
	</form>
	<div style="width:100%; text-align: center;padding: 5px;font-size: 13px;">
		
		<table id="datatable" class="display" style="width:100%; padding-right;10px;">
		
			<thead>
				<tr onClick="">
					<th colspan="11" style="border-top: 0.1px solid black;">Transaksi</th>
					<th colspan="11" style="border-left: 0.1px solid black;border-top: 0.1px solid black;">Pembayaran</th>
				</tr>
				<tr onClick="">
					<th hidden>No</th>
					<th hidden>No</th>
					<th hidden>No</th>
					<th hidden>No</th>
					<th hidden>No</th>
					<th hidden>No</th>
					<th hidden>No</th>
					<th width=50>NoTrans</th>
					<th width=100>Tanggal</th>
					<th width=50>Meja</th>
					<th width=50>Kasir</th>
					<th width=50>DPP</th>
					<th>total</th>
					<th width=50>Discount</th>
					<th width=50>Service</th>
					<th width=50>PPN</th>
					<th width=50>Ongkir</th>
					<th width=50>Total</th>
					<th style="border-left: 0.1px solid black;">Deposit</th>
					<th>Tunai</th>
					<th>Debit</th>
					<th>KKredit</th>
					<th>Transfer</th>
					<th>Ovo</th>
					<th>Gopay</th>
					<th>Voucher</th>
					<th>EDC</th>
					<th>Bank</th>
					<th hidden>Bank</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$no = 1; 
					$utid = 0;
					$nm = 1; 
					$tls1 = 0;$tls2 = 0;$tls3 = 0;$tls4 = 0;$tls5 = 0;$tls6 = 0;$tls7 = 0;$tls8 = 0;$tls9 = 0;$tls10 = 0;
					$tls12 = 0;$tls13 = 0;$tls14 = 0;
					$ongkirsinput = 0;
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
						
						$ttt = 0;
						$biaya = 0; 
						$ppn = 0; 
						$service = 0;
						$dctp = 0;
						if($row['discount_type']!=null){
							$dctp = $row['discount_type'];
						}
						$biaya = number_format($row['nominal'],0,"","");
						if($row['biaya_service'] == '1'){
							$service = ($biaya-$dctp)*5/100;
						}if($row['biaya_ppn'] == '1'){
							$ppn	 = ($biaya-$dctp)*10/100;
						}
						$ttt = $biaya + $service + $ppn + $row['ongkos_kirim']-$dctp;
						
						$id_us = $row['id'];
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
							
							$ongkirsinput = $ongkirsinput+number_format($row['ongkos_kirim'],0,"","");
							$tls6 = $tls6+number_format($row['kk'],0,"","");
							$tls7 = $tls7+number_format($row['transfer'],0,"","");
							$tls8 = $tls8+number_format($row['ovo'],0,"","");
							$tls9 = $tls9+number_format($row['gopay'],0,"","");
							$tls10 = $tls10+number_format($row['voucher'],0,"","");
							$tls11 = $tls3+$tls4+$tls5+$tls6+$tls7+$tls8+$tls9+$tls10;
						if($utid != $row['id']){
							
							$tls3 = $tls3+number_format($row['deposit'],0,"","");
							$tls4 = $tls4+number_format($row['tunai'],0,"","");
							$tls5 = $tls5+number_format($row['debit'],0,"","");
							$tls2 = $tls2+$ttt;
				?>
							<tr>
								<td hidden><?php echo $no;?></td>
								<td hidden>1</td>
								<td hidden><?php echo number_format($row['nominal']);?></td>
								<td hidden><?php echo number_format($row['ongkos_kirim']);?></td>
								<td hidden><?php echo number_format($ppn);?></td>
								<td hidden><?php echo number_format($ttt);?></td>
								<td hidden><?php echo number_format($row['voucher']);?></td>
								<td><?php echo date('ym', ($row['date_add']+18000));?><?php echo $sasa;?>
								<br><a onClick="printUlang('<?php echo $row['id'];?>')" style="cursor:pointer;color:red;">Re-Print</a></td>
								<td><?php echo date('d/m/Y H:i:s', ($row['date_add']+18000));?></td>
								<td><?php echo $nmj;?></td>
								<td><?php echo $row['id_user'];?></td>
								<td>
									<?php 
										if($row['no_meja'] == '103'){ 
											echo number_format(($row['nominal']/11*10)); 
											$tls12 = $tls12+number_format(($row['nominal']/11*10),0,"","");
										}else if($row['no_meja'] == '104'){ 
											echo number_format(($row['nominal']+$row['disc_all'])/115*100); 
											$tls12 = $tls12+number_format((($row['nominal']+$row['disc_all'])/115*100),0,"","");
										}else{ 
											echo number_format(($row['nominal'])); 
											$tls12 = $tls12+number_format($row['nominal'],0,"","");
										};
									?>
								</td>
								
								<td><?php echo number_format($tls12);?></td>
								<td><?php if($row['no_meja'] == '104'){ echo number_format($row['disc_all']); }else{ echo number_format($row['discount_type']); };?></td>
								<td>
									<?php
										if($row['no_meja'] == '104'){ 
											echo number_format(($row['nominal']+$row['disc_all'])/115*5); 
											
											$tls13 = $tls13+ number_format((($row['nominal']+$row['disc_all'])/115*5),0,"",""); 
										}else{
											echo number_format($service);
											$tls13 = $tls13+$service; 
										};
									?>
								</td>
								<td>
									<?php 
										if($row['no_meja'] == '103'){ 
											echo number_format(($row['nominal']/11*10)/100*10);
											$tls14 = $tls14+number_format((($row['nominal']/11*10)/100*10),0,"","");											
										}else if($row['no_meja'] == '104'){ 
											echo number_format(($row['nominal']+$row['disc_all'])/115*10);
											$tls14 = $tls14+number_format((($row['nominal']+$row['disc_all'])/115*10),0,"","");
										}else{
											echo number_format($ppn);
											$tls14 = $tls14+$ppn;
										};
									?>
								</td>
								<td align="right"><?php echo number_format($row['ongkos_kirim']);?></td>
								<td><?php echo number_format($ttt);?></td>
								
								<th style="border-left: 0.1px solid black;"><?php echo number_format($row['deposit']);?></th>
								<td><?php echo number_format($row['tunai']);?></td>
								<td><?php echo number_format($row['debit']);?></td>
								<td><?php echo number_format($row['kk']);?></td>
								<td><?php echo number_format($row['transfer']);?></td>
								<td><?php echo number_format($row['ovo']);?></td>
								<td><?php echo number_format($row['gopay']);?></td>
								<td><?php echo number_format($row['voucher']);?></td>
								<td><?php echo $row['ket1'].$row['ket2'].$row['ket3'];?></td>
								<td><?php echo $row['bank1'].$row['bank2'].$row['bank3'];?></td>
								<td hidden><?php echo number_format($row['deposit']);?></td>
							</tr>
				<?php 
							$tls1 = $tls1+1;						
							$no++;	
						}
						$utid = $row['id'];
					} ?>
			</tbody>
		</table>
		
		<div style="text-align:left;margin-top:16px;font-size: 12px;">
			<div>
				Total Transaksi &nbsp;<input type="text" id="inputan1" style="width:30px;text-align:center;" disabled/>&nbsp;&nbsp;&nbsp;
				DPP &nbsp;<input type="text" id="dpps" value="<?php echo "0";?>" style="width:90px;text-align:center;" disabled/>&nbsp;&nbsp;&nbsp;
				Service &nbsp;<input type="text" id="sevices" value="<?php echo "0";?>" style="width:90px;text-align:center;" disabled/>&nbsp;&nbsp;&nbsp;
				PPN &nbsp;<input type="text" id="ppns" value="<?php echo "0";?>" style="width:90px;text-align:center;" disabled/>&nbsp;&nbsp;&nbsp;
				Ongkir &nbsp;<input type="text" id="ongkirs" value="<?php echo "0";?>" style="width:90px;text-align:center;" disabled/>&nbsp;&nbsp;&nbsp;
				Total &nbsp;<input type="text" id="inputan2" value="<?php echo "0";?>" style="width:90px;text-align:center;" disabled/>&nbsp;&nbsp;&nbsp;
				
			</div>
		</div>
		<div style="text-align:left;margin-top:16px;font-size: 10px;">
			<div>
				Deposite &nbsp;<input type="text" id="inputan3" value="<?php echo "0";?>" style="width:70px;text-align:center;" disabled/>&nbsp;&nbsp;&nbsp;
				Tunai &nbsp;<input type="text" id="inputan4" value="<?php echo "0";?>" style="width:70px;text-align:center;" disabled/>&nbsp;&nbsp;&nbsp;
				Debit &nbsp;<input type="text" id="inputan5" value="<?php echo "0";?>" style="width:70px;text-align:center;" disabled/>&nbsp;&nbsp;&nbsp;
				KKredit &nbsp;<input type="text" id="inputan6" value="<?php echo "0";?>" style="width:70px;text-align:center;" disabled/>&nbsp;&nbsp;&nbsp;
				Transfer &nbsp;<input type="text" id="inputan7" value="<?php echo "0";?>" style="width:70px;text-align:center;" disabled/>&nbsp;&nbsp;&nbsp;
				Ovo &nbsp;<input type="text" id="inputan8" value="<?php echo "0";?>" style="width:70px;text-align:center;" disabled/>&nbsp;&nbsp;&nbsp;
				Gopay &nbsp;<input type="text" id="inputan9" value="<?php echo "0";?>" style="width:70px;text-align:center;" disabled/>&nbsp;&nbsp;&nbsp;
				Voucher &nbsp;<input type="text" id="inputan10" value="<?php echo "0";?>" style="width:70px;text-align:center;" disabled/>
			</div>
		</div>
		<div style="text-align:left;margin-top:16px;font-size: 10px;">
			<div>
				Total Pembayaran &nbsp;<input type="text" id="pbyrnrrr" value="<?php echo "0";?>" style="width:70px;text-align:center;" disabled/>
			</div>
		</div>
	</div>
</div>
<script>
	document.getElementById('dpps').value = "<?php echo number_format($tls12);?>";
	document.getElementById('sevices').value = "<?php echo number_format($tls13);?>";
	document.getElementById('ppns').value = "<?php echo number_format($tls14);?>";
	document.getElementById('ongkirs').value = "<?php echo number_format($ongkirsinput);?>";
	document.getElementById('inputan1').value = "<?php echo number_format($tls1);?>";
	document.getElementById('inputan2').value = "<?php echo number_format($tls2);?>";
	document.getElementById('inputan3').value = "<?php echo number_format($tls3);?>";
	document.getElementById('inputan4').value = "<?php echo number_format($tls4);?>";
	document.getElementById('inputan5').value = "<?php echo number_format($tls5);?>";
	document.getElementById('inputan6').value = "<?php echo number_format($tls6);?>";
	document.getElementById('inputan7').value = "<?php echo number_format($tls7);?>";
	document.getElementById('inputan8').value = "<?php echo number_format($tls8);?>";
	document.getElementById('inputan9').value = "<?php echo number_format($tls9);?>";
	document.getElementById('inputan10').value = "<?php echo number_format($tls10);?>";
	document.getElementById('pbyrnrrr').value = "<?php echo number_format($tls11);?>";
	
	$(document).ready(function () {
		var table = $('#datatable').DataTable();
		$('input').on('keyup click', function () {
			var searched = table.rows({
				search: 'applied'
			}).nodes();

			calculatesum(searched);

		});
	});
	
	function printUlang(param){
		open('<?php echo $config->base_url();?>print_bill_preview/'+param+'.html');
		// alert(''+param);	
	}
	
	function calculatesum(all) {
		var columnsToSum1 = [1],columnsToSum2 = [16],columnsToSum3 = [26],columnsToSum4 = [17],columnsToSum5 = [18],columnsToSum6 = [19];columnsToSum7 = [20];
		var columnsToSum8 = [21],columnsToSum9 = [22],columnsToSum10 = [23];
		var ongkiraaas = [16],ongkiraaas1 = [2],ongkiraaas2 = [4],ongkiraaas3 = [14];
		ongkiraaasaa =0, sum1 = 0, sum2 = 0, sum3 = 0, sum4 = 0, sum5 = 0, sum6 = 0, sum7 = 0, sum8 = 0, sum9 = 0, sum10 = 0;
		tester1 = 0;tester2 = 0;tester3 = 0;
		for (i = 0; i < columnsToSum1.length; i++) {
			a = columnsToSum1[i],b = columnsToSum2[i],asdasdb = ongkiraaas[i];
			c3 = columnsToSum3[i],c4 = columnsToSum4[i],c5 = columnsToSum5[i],c6 = columnsToSum6[i],c7 = columnsToSum7[i],c8 = columnsToSum8[i];
			c9 = columnsToSum9[i],c10 = columnsToSum10[i];
			d1 = ongkiraaas1[i],d2 = ongkiraaas2[i],d3 = ongkiraaas3[i];
			for (j = 0; j < all.length; j++) {

				var val = all[j].getElementsByTagName('td')[a].innerHTML;
				var val1 = all[j].getElementsByTagName('td')[b].innerHTML;
				var okir = all[j].getElementsByTagName('td')[asdasdb].innerHTML;
				var val3 = all[j].getElementsByTagName('td')[c3].innerHTML;
				var val4 = all[j].getElementsByTagName('td')[c4].innerHTML;
				var val5 = all[j].getElementsByTagName('td')[c5].innerHTML;
				var val6 = all[j].getElementsByTagName('td')[c6].innerHTML;
				var val7 = all[j].getElementsByTagName('td')[c7].innerHTML;
				var val8 = all[j].getElementsByTagName('td')[c8].innerHTML;
				var val9 = all[j].getElementsByTagName('td')[c9].innerHTML;
				var val10 = all[j].getElementsByTagName('td')[c10].innerHTML;
				var val11 = all[j].getElementsByTagName('td')[d1].innerHTML;
				var val12 = all[j].getElementsByTagName('td')[d2].innerHTML;
				var val13 = all[j].getElementsByTagName('td')[d3].innerHTML;
				ongkiraaasaa += isNaN(val.split(',').join("")) ? 0 : parseInt(okir.split(',').join(""));
				sum1 += isNaN(val.split(',').join("")) ? 0 : parseInt(val.split(',').join(""));
				sum2 += isNaN(val1.split(',').join("")) ? 0 : parseInt(val1.split(',').join(""));
				sum3 += isNaN(val3.split(',').join("")) ? 0 : parseInt(val3.split(',').join(""));
				sum4 += isNaN(val4.split(',').join("")) ? 0 : parseInt(val4.split(',').join(""));
				sum5 += isNaN(val5.split(',').join("")) ? 0 : parseInt(val5.split(',').join(""));
				sum6 += isNaN(val6.split(',').join("")) ? 0 : parseInt(val6.split(',').join(""));
				sum7 += isNaN(val6.split(',').join("")) ? 0 : parseInt(val7.split(',').join(""));
				sum8 += isNaN(val6.split(',').join("")) ? 0 : parseInt(val8.split(',').join(""));
				sum9 += isNaN(val6.split(',').join("")) ? 0 : parseInt(val9.split(',').join(""));
				sum10 += isNaN(val6.split(',').join("")) ? 0 : parseInt(val10.split(',').join(""));
				tester1 += isNaN(val11.split(',').join("")) ? 0 : parseInt(val11.split(',').join(""));
				tester2 += isNaN(val12.split(',').join("")) ? 0 : parseInt(val12.split(',').join(""));
				tester3 += isNaN(val13.split(',').join("")) ? 0 : parseInt(val13.split(',').join(""));
				
			}
			
		}
		document.getElementById('dpps').value = numeral(tester1).format('0,0.[00]');
		document.getElementById('ppns').value = numeral(tester2).format('0,0.[00]');
		document.getElementById('sevices').value = numeral(tester3).format('0,0.[00]');
		document.getElementById('ongkirs').value = numeral(ongkiraaasaa).format('0,0.[00]');
		document.getElementById('inputan1').value = numeral(sum1).format('0,0.[00]');
		document.getElementById('inputan2').value = numeral(sum2).format('0,0.[00]');
		document.getElementById('inputan3').value = numeral(sum3).format('0,0.[00]');
		document.getElementById('inputan4').value = numeral(sum4).format('0,0.[00]');
		document.getElementById('inputan5').value = numeral(sum5).format('0,0.[00]');
		document.getElementById('inputan6').value = numeral(sum6).format('0,0.[00]');
		document.getElementById('inputan7').value = numeral(sum7).format('0,0.[00]');
		document.getElementById('inputan8').value = numeral(sum8).format('0,0.[00]');
		document.getElementById('inputan9').value = numeral(sum9).format('0,0.[00]');
		document.getElementById('inputan10').value = numeral(sum10).format('0,0.[00]');
		tl =parseInt(numeral(ongkiraaasaa).format('0,0.[00]'))+parseInt(document.getElementById('inputan4').value),
		document.getElementById('pbyrnrrr').value = numeral(sum2).format('0,0.[00]');
	}
	function print(param){
		var a = ''+document.getElementById('date1').value;
		var b = ''+document.getElementById('date2').value;
		// alert(''+a);
		
		// alert(''+document.getElementById('date1').value);
		window.open('<?php echo $config->base_url();?>print_page/2/'+a+'/'+b+'/'+param+'.html','_blank','_blank');
	}
</script>



