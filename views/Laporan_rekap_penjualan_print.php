<?php
	// header("Content-type: application/vnd-ms-excel");
	// header("Content-Disposition: attachment; filename=Data Pegawai.xls");
?>	
	<?php 
		// $dtprit = 'RUNDLL32 PRINTUI.DLL,PrintUIEntry /y /n "EPSON B"';
		// system($dtprit);
	
	?>
<style>
@media print{
	@page {
		size: landscape;
		font-size: 6px;
		width: 100%;
		margin: 4mm;
	}
}
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  padding: 0px;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}
</style>
<link href="<?php echo $config->base_url();?>styles/style.css" rel="stylesheet" />
<div style="margin-left:1%;margin-right:1%;">
	<h2>Laporan Rekap Penjualan</h2>
	Shift 1
	<div style="width:100%; text-align: center;padding: 5px;font-size: 13px;">
		
		<table id="datatable" class="display" style="width:100%; padding-right;10px;border: 0.1px solid gray;">
		
			<?php
			$tlk =0;
			$tlk1 =0;
			$tlk2 =0;
			foreach($show_laporan1 as $row){
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
				if($utid != $row['id']){
					if($row['no_meja'] == '103'){ 
						$tlk = $tlk+number_format(($row['nominal']/11*10),0,"","");
						$tlk2 = $tlk2+number_format((($row['nominal']/11*10)/100*10),0,"","");	
					}else if($row['no_meja'] == '104'){ 
						$tlk = $tlk+number_format((($row['nominal']+$row['disc_all'])/115*100),0,"","");
						$tlk2 = $tlk2+number_format((($row['nominal']+$row['disc_all'])/115*10),0,"","");
						$tlk1 = $tlk1+ number_format((($row['nominal']+$row['disc_all'])/115*5),0,"",""); 
					}else{ 
						$tlk = $tlk+number_format($row['nominal'],0,"","");
						$tlk2 = $tlk2+number_format((($row['nominal'] - $dctp)/100*10),0,"","");
						$tlk1 = $tlk1+number_format((($row['nominal'] - $dctp)*5/100),0,"","");
					};
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
				}
				$utid = $row['id'];
			}
			?>
			
		
			<thead>
				<tr onClick="">
					<th colspan="10" style="border: 0.1px solid gray;border-top: 0.1px solid gray;">Transaksi</th>
					<th colspan="11" style="border: 0.1px solid gray;border-top: 0.1px solid gray;">Pembayaran</th>
				</tr>
				<tr onClick="" style="border: 0.1px solid gray;border-top: 0.1px solid gray;">
					<th width=50 style="font-size: 12px;">NoTrans</th>
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
					foreach($show_laporan1 as $row){ 
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
						$tls12 = $tls12+$biaya;
						if($row['biaya_service'] == '1'){
							$service = ($biaya-$dctp)*5/100;
							$tls13 = $tls13+$service; 
						}if($row['biaya_ppn'] == '1'){
							$ppn	 = ($biaya-$dctp)*10/100;
							$tls14 = $tls14+$ppn;
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
				?>
						<tr style="border: 0.1px solid gray;border-top: 0.1px solid gray;">
							<td style="font-size: 12px;"><center><?php echo date('ym', ($row['date_add']+18000));?><?php echo $sasa;?></center></td>
							<td style="font-size: 12px;"><center><?php echo date('d/m/Y H:i:s', ($row['date_add']+18000));?></center></td>
							<td style="font-size: 12px;"><center><?php echo $nmj;?></center></td>
							<td style="font-size: 12px;"><center><?php echo $row['id_user'];?></center></td>
							<td style="font-size: 12px;"><center>
								<?php 
									if($row['no_meja'] == '103'){ 
										echo number_format(($row['nominal']/11*10),0,"",""); 
									}else if($row['no_meja'] == '104'){ 
										echo number_format((($row['nominal']+$row['disc_all'])/115*100),0,",","."); 
									}else{ 
										echo number_format(($row['nominal']),0,",","."); 
									};
								?></center>
							</td>
							<td style="font-size: 12px;"><center><?php if($row['no_meja'] == '104'){ echo number_format($row['disc_all'],0,",","."); }else{ echo number_format($row['discount_type'],0,",","."); };?></center></td>
							<td style="font-size: 12px;"><center>
								<?php
									if($row['no_meja'] == '104'){ 
										echo number_format((($row['nominal']+$row['disc_all'])/115*5),0,",","."); 
									}else{
										echo number_format($service,0,",",".");
									};
								?></center>
							</td>
							<td style="font-size: 12px;"><center>
								<?php 
									if($row['no_meja'] == '103'){ 
										echo number_format((($row['nominal']/11*10)/100*10),0,",","."); 
									}else if($row['no_meja'] == '104'){ 
										echo number_format((($row['nominal']+$row['disc_all'])/115*10),0,",","."); 
									}else{
										echo number_format($ppn,0,",","."); 
									};
								?>
							</center></td>
							<td style="font-size: 12px;"><center><?php echo number_format($row['ongkos_kirim'],0,",",".");?></center></td>
							<td style="font-size: 12px;"><center><?php echo number_format($ttt,0,",",".");?></center></td>
							
							<th style="border-left: 0.1px solid gray;font-size: 12px;"><center><?php echo number_format($row['deposit'],0,",",".");?></center></th>
							<td style="font-size: 12px;"><center><?php echo number_format($row['tunai'],0,",",".");?></center></td>
							<td style="font-size: 12px;"><center><?php echo number_format($row['debit'],0,",",".");?></center></td>
							<td style="font-size: 12px;"><center><?php echo number_format($row['kk'],0,",",".");?></center></td>
							<td style="font-size: 12px;"><center><?php echo number_format($row['transfer'],0,",",".");?></center></td>
							<td style="font-size: 12px;"><center><?php echo number_format($row['ovo'],0,",",".");?></center></td>
							<td style="font-size: 12px;"><center><?php echo number_format($row['gopay'],0,",",".");?></center></td>
							<td style="font-size: 12px;"><center><?php echo number_format($row['voucher'],0,",",".");?></center></td>
							<td style="font-size: 12px;"><center><?php echo $row['ket1'].$row['ket2'].$row['ket3'];?></center></td>
							<td style="font-size: 12px;"><center><?php echo $row['bank1'].$row['bank2'].$row['bank3'];?></center></td>
							<td hidden><?php echo number_format($row['deposit']);?></td>
						</tr>
						<?php $no++; } 
					$utid = $row['id'];
				} ?>
		</table>
		
		<table border="1" >
			<tr><td>&nbsp;</td></tr>
			<tr>
				<td>Total Transaksi</td>
				<td><?php echo $tls1;?></td>
				<td>&nbsp;</td>
				<td>DPP</td>
				<td><?php echo number_format($tlk,0,",",".");?></td>
				<td>&nbsp;</td>
				<td>Service</td>
				<td><?php echo number_format($tlk1,0,",",".");?></td>
				<td>&nbsp;</td>
				<td>PPN</td>
				<td><?php echo number_format($tlk2,0,",",".");?></td>
				<td>&nbsp;</td>
				<td>Ongkir</td>
				<td><?php echo number_format($ongkirsinput,0,",",".");?></td>
				<td>&nbsp;</td>
				<td>Total</td>
				<td><?php echo number_format($tls11,0,",",".");?></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Deposite</td>
				<td><?php echo number_format($tls3,0,",",".");?></td>
				<td>&nbsp;</td>
				<td>Tunai</td>
				<td><?php echo number_format($tls4,0,",",".");?></td>
				<td>&nbsp;</td>
				<td>Debit</td>
				<td><?php echo number_format($tls5,0,",",".");?></td>
				<td>&nbsp;</td>
				<td>KKredit</td>
				<td><?php echo number_format($tls6,0,",",".");?></td>
				<td>&nbsp;</td>
				<td>Transfer</td>
				<td><?php echo number_format($tls7,0,",",".");?></td>
				<td>&nbsp;</td>
				<td>Ovo</td>
				<td><?php echo number_format($tls8,0,",",".");?></td>
				<td>&nbsp;</td>
				<td>Gopay</td>
				<td><?php echo number_format($tls9,0,",",".");?></td>
				<td>&nbsp;</td>
				<td>Voucher</td>
				<td><?php echo number_format($tls10,0,",",".");?></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Total Pembayaran </td>
				<td><?php echo number_format($tls11,0,",",".");?></td>
				<td>&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<script type="text/javascript">

// alert('a');
		print();
		setTimeout( function(){ 
		// alert('a');
			close();
		}  , 1000 );
		
	</script>