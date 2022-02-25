
<style>
@media print{
	@page {
		size: landscape
	}
}
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  padding: 2px;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}
</style>
<link href="<?php echo $config->base_url();?>styles/style.css" rel="stylesheet" />
<div class="card_table" style="margin-left:1%;margin-right:1%;margin-top:1%;">
	<h2>Laporan Rekap Penjualan</h2>
	<div style="width:100%; text-align: center;padding: 5px;font-size: 13px;">
		
		<table id="datatable" class="display" style="width:100%; padding-right;10px;border: 0.1px solid gray;">
		
			<thead>
				<tr onClick="">
					<th colspan="10" style="border: 0.1px solid gray;border-top: 0.1px solid gray;">Transaksi</th>
					<th colspan="11" style="border: 0.1px solid gray;border-top: 0.1px solid gray;">Pembayaran</th>
				</tr>
				<tr onClick="" style="border: 0.1px solid gray;border-top: 0.1px solid gray;">
					<th hidden>No</th>
					<th hidden>No</th>
					<th hidden>No</th>
					<th hidden>No</th>
					<th hidden>No</th>
					<th hidden>No</th>
					<th hidden>No</th>
					<th width=50 style="font-size: 12px;" >NoTrans</th>
					<th width=100 style="font-size: 12px;">Tanggal</th>
					<th width=50 style="font-size: 12px;">Meja</th>
					<th width=50 style="font-size: 12px;">Kasir</th>
					<th width=50 style="font-size: 12px;">DPP</th>
					<th width=50 style="font-size: 12px;">Discount</th>
					<th width=50 style="font-size: 12px;">Service</th>
					<th width=50 style="font-size: 12px;">PPN</th>
					<th width=50 style="font-size: 12px;">Ongkir</th>
					<th width=50 style="font-size: 12px;">Total</th>
					<th style="border-left: 0.1px solid gray;font-size: 12px;">Deposit</th>
					<th style="font-size: 12px;">Tunai</th>
					<th style="font-size: 12px;">Debit</th>
					<th style="font-size: 12px;">KKredit</th>
					<th style="font-size: 12px;">Transfer</th>
					<th style="font-size: 12px;">Ovo</th>
					<th style="font-size: 12px;">Gopay</th>
					<th style="font-size: 12px;">Voucher</th>
					<th style="font-size: 12px;">EDC</th>
					<th style="font-size: 12px;">Bank</th>
					<th hidden>Bank</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$no = 1; 
					$utid = 0;
					$nm = 1; 
					$tls1 = 0;$tls2 = 0;$tls3 = 0;$tls4 = 0;$tls5 = 0;$tls6 = 0;$tls7 = 0;$tls8 = 0;$tls9 = 0;$tls10 = 0;
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
						
						if($utid != $row['id']){
							$tls1 = $tls1+1;
							$tls2 = $tls2+$ttt;
							
							$ongkirsinput = $ongkirsinput+number_format($row['ongkos_kirim'],0,"","");
							$tls3 = $tls3+number_format($row['deposit'],0,"","");
							$tls4 = $tls4+number_format($row['tunai'],0,"","");
							$tls5 = $tls5+number_format($row['debit'],0,"","");
							$tls6 = $tls6+number_format($row['kk'],0,"","");
							$tls7 = $tls7+number_format($row['transfer'],0,"","");
							$tls8 = $tls8+number_format($row['ovo'],0,"","");
							$tls9 = $tls9+number_format($row['gopay'],0,"","");
							$tls10 = $tls10+number_format($row['voucher'],0,"","");
							$tls11 = $tls3+$tls4+$tls5+$tls6+$tls7+$tls8+$tls9+$tls10;
				?>
							<tr style="border: 0.1px solid gray;border-top: 0.1px solid gray;">
								<td hidden><?php echo $no;?></td>
								<td hidden>1</td>
								<td hidden><?php echo number_format($row['nominal']);?></td>
								<td hidden><?php echo number_format($row['ongkos_kirim']);?></td>
								<td hidden><?php echo number_format($ppn);?></td>
								<td hidden><?php echo number_format($ttt);?></td>
								<td hidden><?php echo number_format($row['voucher']);?></td>
								<td style="font-size: 12px;"><center><?php echo date('ym', ($row['date_add']+18000));?><?php echo $sasa;?></center></td>
								<td style="font-size: 12px;"><center><?php echo date('d/m/Y h:i:s', ($row['date_add']+18000));?></center></td>
								<td style="font-size: 12px;"><center><?php echo $nmj;?></center></td>
								<td style="font-size: 12px;"><center><?php echo $row['id_user'];?></center></td>
								<td style="font-size: 12px;"><center>
									<?php 
										if($row['no_meja'] == '103'){ 
											echo number_format(($row['nominal']/11*10)); 
										}else if($row['no_meja'] == '104'){ 
											echo number_format(($row['nominal']+$row['disc_all'])/115*100); 
										}else{ 
											echo number_format(($row['nominal'])); 
										};
									?></center>
								</td>
								<td style="font-size: 12px;"><center><?php if($row['no_meja'] == '104'){ echo number_format($row['disc_all']); }else{ echo number_format($row['discount_type']); };?></center></td>
								<td style="font-size: 12px;"><center>
									<?php
										if($row['no_meja'] == '104'){ 
											echo number_format(($row['nominal']+$row['disc_all'])/115*5); 
										}else{
											echo number_format($service);
										};
									?></center>
								</td>
								<td style="font-size: 12px;"><center>
									<?php 
										if($row['no_meja'] == '103'){ 
											echo number_format(($row['nominal']/11*10)/100*10); 
										}else if($row['no_meja'] == '104'){ 
											echo number_format(($row['nominal']+$row['disc_all'])/115*10); 
										}else{
											echo number_format($ppn); 
										};
									?>
								</center></td>
								<td align="right" style="font-size: 12px;"><?php echo number_format($row['ongkos_kirim']);?></center></td>
								<td style="font-size: 12px;"><center><?php echo number_format($ttt);?></center></td>
								
								<th style="border-left: 0.1px solid gray;font-size: 12px;"><center><?php echo number_format($row['deposit']);?></center></th>
								<td style="font-size: 12px;"><center><?php echo number_format($row['tunai']);?></center></td>
								<td style="font-size: 12px;"><center><?php echo number_format($row['debit']);?></center></td>
								<td style="font-size: 12px;"><center><?php echo number_format($row['kk']);?></center></td>
								<td style="font-size: 12px;"><center><?php echo number_format($row['transfer']);?></center></td>
								<td style="font-size: 12px;"><center><?php echo number_format($row['ovo']);?></center></td>
								<td style="font-size: 12px;"><center><?php echo number_format($row['gopay']);?></center></td>
								<td style="font-size: 12px;"><center><?php echo number_format($row['voucher']);?></center></td>
								<td style="font-size: 12px;"><center><?php echo $row['ket1'].$row['ket2'].$row['ket3'];?></center></td>
								<td style="font-size: 12px;"><center><?php echo $row['bank1'].$row['bank2'].$row['bank3'];?></center></td>
								<td hidden><?php echo number_format($row['deposit']);?></td>
							</tr>
				<?php $no++; }
						$utid = $row['id'];
					} ?>
			</tfoot>
		</table>
		
		<div style="text-align:left;margin-top:16px;">
			<div>
				Total Transaksi &nbsp;<input type="text" id="inputan1" style="width:30px;text-align:center;" disabled/>&nbsp;&nbsp;&nbsp;
				Ongkir &nbsp;<input type="text" id="ongkirs" value="<?php echo "0";?>" style="width:90px;text-align:center;" disabled/>&nbsp;&nbsp;&nbsp;
				Total &nbsp;<input type="text" id="inputan2" value="<?php echo "0";?>" style="width:90px;text-align:center;" disabled/>&nbsp;&nbsp;&nbsp;
				
			</div>
		</div>
		<div style="text-align:left;margin-top:16px;">
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
		<div style="text-align:left;margin-top:16px;">
			<div>
				Total Pembayaran &nbsp;<input type="text" id="pbyrnrrr" value="<?php echo "0";?>" style="width:70px;text-align:center;" disabled/>
			</div>
		</div>
	</div>
</div>
<script>
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
	
</script>
<script>
	var css = '@page { size: landscape;margin-top: 0cm; margin-bottom: 0cm; margin-left: 0cm; margin-right: 0cm; } ',
    head = document.head || document.getElementsByTagName('head')[0],
    style = document.createElement('style');

	style.type = 'text/css';
	style.media = 'print';

if (style.styleSheet){
  style.styleSheet.cssText = css;
} else {
  style.appendChild(document.createTextNode(css));
}

head.appendChild(style);

// window.print();
window.close();
</script>
