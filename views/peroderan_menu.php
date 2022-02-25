<style>
input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
	-webkit-appearance: none;
	margin: 0;
}

input[type=number] {
	-moz-appearance: textfield;
}
</style>
<link href="<?php echo $config->base_url();?>styles/table.css" rel="stylesheet" />
<script src="<?php echo $config->base_url();?>styles/st.js"></script>
<?php 
	$print = 0;
	$simpan = 0;
	$id_trans = 0;
	$id_member = 0;
	$barcode = 0;
	$discount = 0;
	$service = 0;
	$ppn = 0;
	$deposit = 0;
	$k = 0;
	$nm = 0;
	$date = '';
	$vc = '';
	$dc_tp = '';
	$ongkir = '';
	$hid = '';
	foreach($show_item as $row){
		if($row['kode'] != null){
			$hid = 'ksg';
		}
		$id_trans = $row['id_trans'];
		$vc = $row['voucher'];
		$dc_tp = $row['dsc_tp'];
		if($dc_tp == ''){
			$dc_tp = 0;
		}
		$ongkir = $row['ongkos_kirim'];
		$id_member = $row['id_member'];
		$service = $row['biaya_service'];
		$date = $row['date_add'];
		$ppn = $row['biaya_ppn'];
		$nm = $row['nm_tr'];
		if($id_member!=0){
			$barcode = $row['barcode'];
			$discount = $row['discount'];
			$deposit = $row['deposit'];
		}
		
		if($k == '0'){
			if($row['stat_simpan']=='1'){
				$simpan = 1;
			}
		}
		if($row['stat_simpan']=='0'){
			$simpan = 0;
			$k = 1;
		}
		
		
		if($row['stat_print']=='1'){
			$print = 1;
		}
	}
	if($pilihan_meja == '105' || $pilihan_meja == '106'){
		$discount = '50';
	}
	
?>

<div id="pilihan_utama" class="card_table" style="margin-left:1%;margin-right:1%;margin-top:1%;display:block;" >
	<div class="card_pilihan_meja1" style="width:auto;float:right;height:auto;background:white;border-color:white;color:black; margin-top:-20px;margin-right:-20px;">
		<div style="z-index: 10;  float:right;">
			<a href="<?php echo $config->base_url();?>tambh_transaksi/<?php echo $_REQUEST['param1'];?>.html">
				<img src="<?php echo $config->base_url(); ?>icon/plus.png" style="width:30px;height:30px;"/>
			</a>
		</div>
	</div>
	<div style="z-index: 10;  float:left;margin-top:-18px;margin-left:-10px">
		<a style="font-size:18px;float:left;">
			<?php 
			$me = $pilihan_meja;
			if($pilihan_meja == '101'){
				$me = "VIP";
			}else if($pilihan_meja == '102'){
				$me = "Delivery";
			}else if($pilihan_meja == '103'){
				$me = "Grab";
			}else if($pilihan_meja == '104'){
				$me = "Gojek";
			}else if($pilihan_meja == '105'){
				$me = "Marketing";
			}else if($pilihan_meja == '106'){
				$me = "Operasional";
			}else if($pilihan_meja == '107'){
				$me = "Owner";
			}else if($pilihan_meja == '0'){
				$me = "Meeting";
			}?>
			Meja <?php echo $me; ?>
		</a>

		<br>
		<div style="font-size:8px;float:left;"><?php echo date('Y-m-d H:i:s', $date); ?></div>
	</div>
	<div style="width:100%; text-align: center;padding: 5px;font-size: 13px;margin-top:30px;" >
		
		<div style="z-index: 10;  float:left;  margin-top:4px;" <?php if($hid == ''){ ?> hidden <?php } ?>>
			<font style="float:left;margin-top:4px;width:65px;text-align: left;">Nama &nbsp;&nbsp;&nbsp;&nbsp;:</font>
			<input type="text" id="ipt_txt" placeholder="masukkan nama" required style="float:left;width: 60%;margin-left:10px;
				height: auto;
				padding: 8px 20px;
				margin-bottom: 10px;
				display: inline-block;
				border: 1px solid #ccc;
				border-radius: 4px;
				box-sizing: border-box;
				line-height:normal;" value="<?php echo $nm; ?>" />
	
		</div>
		<div style="float:right;width:auto; " <?php if($hid == ''){ ?> hidden <?php } ?>>
		<?php if($simpan == 0){ ?>
			<?php if($ses[2] == 0 || $ses[2] == 1){ ?>
			<?php if($ses[2] == 0){ ?>
			<div class="card_pilihan_meja1" style="width:70px;float:right;height:auto;background:white;border-color:white;color:black;">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;">
					<b>Void</b>
				</div>
			</div>
			<?php } ?>
			<div class="card_pilihan_meja1" style="width:70px;float:right;height:auto;background:white;border-color:white;color:black;">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;">
					<b>Split</b>
				</div>
			</div>
			<div class="card_pilihan_meja1" style="width:70px;float:right;height:auto;background:white;border-color:white;color:black;">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;">
					<b>Pindah</b>
				</div>
			</div>
			<div class="card_pilihan_meja1" style="width:70px;float:right;height:auto;background:white;border-color:white;color:black;">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;">
					<b>Preview</b>
				</div>
			</div>
			<?php } ?>
			<div class="card_pilihan_meja1" style="width:70px;float:right;height:auto;background:#987860;color:white;" onClick="simpan('<?php echo $id_trans; ?>')">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;cursor:pointer;">
					<b>Simpan</b>
				</div>
			</div>
		<?php }else{ ?>
			<?php if($ses[2] == 0 || $ses[2] == 1){ ?>
			<div class="card_pilihan_meja1" <?php if($ses[2] != 0){ ?> hidden <?php } ?> style="width:70px;float:right;height:auto;background:#987860;color:white;" id ="bn_mn1" onClick="voidss('<?php echo $id_trans; ?>')">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;cursor:pointer;">
					<b>Void</b>
				</div>
			</div>
			<div class="card_pilihan_meja1" <?php if($ses[2] == 2){ ?> hidden <?php } ?>  style="width:70px;float:right;height:auto;background:#987860;color:white;" id ="bn_mn2" onClick="btnSubmit('<?php echo $id_trans;?>')">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;cursor:pointer;">
					
					<b>Split</b>
				</div>
			</div>
			<div class="card_pilihan_meja1" <?php if($ses[2] == 2){ ?> hidden <?php } ?> style="width:70px;float:right;height:auto;background:#987860;color:white;" id ="bn_mn3" onClick="btnPindah('<?php echo $id_trans;?>')">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;cursor:pointer;">
					
					<b>Pindah</b>
				</div>
			</div>
			<div class="card_pilihan_meja1" <?php if($ses[2] == 2){ ?> hidden <?php } ?> style="width:70px;float:right;height:auto;background:#987860;color:white;" id ="bn_mn4" onClick="print_data('<?php echo $id_trans; ?>')">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;cursor:pointer;">
					<b>Preview</b>
				</div>
			</div>
			<?php } ?>
			<div class="card_pilihan_meja1"  id="splt1" style="width:70px;float:right;height:auto;background:white;border-color:white;color:black;">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;">
					<b>Simpan</b>
				</div>
			</div>
		<?php } ?>
			
		</div>
		<div style="clear: both;"/>
		<?php
			$id_us = $row['id_trans'];
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
		<div style="z-index: 10;  float:left;  margin-bottom:20px;" <?php if($hid == ''){ ?> hidden <?php } ?>>
			<font style="float:left;margin-top:4px;width:65px;text-align: left;">No Trans :</font>
			<input type="text" id="ipt_txt" placeholder="masukkan nama" required style="float:left;width: 66%;margin-left:10px;
				height: auto;
				padding: 8px;
				margin-bottom: 10px;
				display: inline-block;
				border: 1px solid #ffffff;
				border-radius: 4px;
				box-sizing: border-box;
				line-height:normal;" value="<?php echo date('ym', ($row['date_add']+18000));?><?php echo $sasa;?>" disabled/>
	
		</div>
		<div style="clear: both;"/>
		<div style="margin-top:-27px;float:left;text-align:left;" <?php if($hid == ''){ ?> hidden <?php } ?>>
			<font style="float:left;width:65px;text-align: left;">Type &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </font>
			<input type="radio" id="type_member1" name="type_member" value="male" style="margin-left:10px;" checked="checked" onClick="type_member('1')">
			<label for="male">Non Member</label>
			<input type="radio" id="type_member2" name="type_member" value="female" style="margin-left:10px;" onClick="type_member('2')">
			<label for="female">Member</label>
		</div>
		<div style="clear: both;"/>
		<div id="kartu_member" style="font-size:14px;float:left;text-align:left;width:100%;" <?php if($hid == ''){ ?> hidden <?php } ?>>
			<div style="float:left;margin-top:5px;">Kartu Member : </div>
			<input type="text" name="member_cari" id="member_cari" placeholder="masukkan kode" required class="form_inputs"  onkeyup="myFunctionmember()" style="float:left">
			<div class="card_pilihan_meja1" onClick="member_cari()" style="width:30px;height:auto;background:#000000;border-color:#000000;color:white;font-size:12px;border-radius: 4px;margin-top:2px;cursor:pointer;">
				<img src="<?php echo $config->base_url();?>icon/search.png" style="height:20px;margin-top:-2px;margin-left:1px;"/>
			</div>
			<input type="hidden" name="saldo_members" id="saldo_members" placeholder="saldo_members" required class="form_inputss" style="float:right;text-align:right;" value='<?php echo $deposit; ?>'>
			<input type="text" name="saldo_member" id="saldo_member" placeholder="saldo_member" required class="form_inputss" style="float:right;text-align:right;" value='Rp <?php echo number_format($deposit); ?>' disabled>
		</div>
		<div style="clear: both;"/>
		<table class="display" style="width:100%; padding-right;10px;" border=1>
			<thead>
				<tr>
					<th>No</th>
					<th>Save</th>
					<th>Print</th>
					<th style="width:100px;" class="id" hidden>id</th>
					<th style="width:100px;">Kode</th>
					<th>Nama</th>
					<th>AddOn</th>
					<th>HrgAddOn</th>
					<th>Keterangan</th>
					<th>Harga</th>
					<th width=100px>QTY</th>
					<th>Discount</th>
					<th>Nominal</th>
					<th>Total Harga</th>
					<th>Jumlah Split</th>
					<th class="name" hidden>Jumlah Split</th>
					<th><a onClick = "checkall()" style="cursor:pointer">CheckAll</a></th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$id = 1; 
					$duid = 0; 
					$jlh_splt=0;
					$total_uang=0;
					$total_dss=0;
					$asdasdasdasd=$discount;
					foreach($show_item as $row){
						$jlh_splt = $row['total'];
						if($pilihan_meja == '105' || $pilihan_meja == '106'){
							if($row['dis_otmtis'] == '1'){
								$discount=$row['dis'];
							}else{
								$discount = '50';
							}
						}else if($deposit == '0'){
							$discount=0;
						}else{
							if($row['dis_otmtis'] == '1'){
								$discount=$row['dis'];
							}else{
								$discount=$asdasdasdasd;
							}
						}
				?>
				<tr class="row-select">
					<td><?php echo $id;?></td>
					<td>
						<?php 
							if($row['stat_simpan']=='1'){ ?> 
								<img src="<?php echo $config->base_url();?>icon/yes.png" style="height:20px;margin-top:-2px;margin-left:1px;"/>
						<?php 
							}
						?>
					</td>
					<td>
						<?php 
							if($row['stat_print']=='1'){ ?> 
								<img src="<?php echo $config->base_url();?>icon/yes.png" style="height:20px;margin-top:-2px;margin-left:1px;"/>
						<?php 
							}
						?>
					</td>
					<td class="id" hidden><?php echo $row['id'];?></td>
					<td><?php echo $row['kode'];?></td>
					<td>
						<div class="tols_tips"><?php echo $row['nama'];?>
							<span class="tols_tipsa"><?php echo $row['nama_input'];?> <br>( <?php echo date('Y-m-d H:i:s', ($row['date_add']+18000));?> )</span>
						</div>
					</td>
					<?php 
						$adssdsds = $row['id'];
						$sqlads	= "
							SELECT 
								transaksi_addon.id,
								transaksi_addon.id_transaksi_detail,
								transaksi_addon.id_item,
								transaksi_addon.harga as hrg,
								mbrg.nama,
								mbrg.nhargagrab,
								mbrg.nhargagojek,
								transaksi_addon.total
							FROM 
								`transaksi_addon`
							inner join
								`mbrg`
							on
								mbrg.kode = transaksi_addon.id_item
							WHERE 
								transaksi_addon.id_transaksi_detail = '$adssdsds' && transaksi_addon.deleted = 0 
							order by transaksi_addon.id asc";
							
						$resultads	= $conn->query($sqlads);
						$ttlads = 0;
						while($recads = $resultads->fetch_assoc()){
							$ttlads = $ttlads + ($recads['total'] * number_format($recads['hrg'], 0, '', ''));
						}
						$ttlso = $ttlads;
						$ttlads = $ttlads * $row['total'];
					?>
					<td>
						<?php //if($row['stat_simpan']=='0'){ ?> 
							<a onClick="add_onss('<?php echo $row['id'].'/'.$row['id_trans'];?>')" style="cursor:pointer;">
								<img src="<?php echo $config->base_url()."icon/add_ons.png";?>" style="width:14px;margin-bottom:2px;"/>
							</a>
					</td>
					<td><?php echo number_format($ttlso);?></td>
					<td>
						<input type="text" id="kets<?php echo $row['id'];?>" onClick="action_setiap_perintah('kets<?php echo $row['id'];?>')" value="<?php echo $row['keterangan'];?>" style="width:100px;text-align:center;" onkeypress="raaaa('<?php echo $row['id'];?>')" />
					</td>
					<td><?php echo number_format($row['hrg']);?></td>
					<td>
						 <?php if($row['stat_simpan']=='0'){ ?>
							<input type="number" id="qtyaa<?php echo $row['id'];?>" onClick="action_setiap_perintah('qtyaa<?php echo $row['id'];?>')" value="<?php echo $row['total'];?>" style="width:100px;text-align:center;" onkeypress="runScript('<?php echo $row['id'];?>')" />
						 <?php }else{ ?>
						 <?php echo $row['total'];?>
						 <?php } ?>
						 
					</td>
					<td class="tl_smentara" id="tl_smentara<?php echo $row['id'];?>" hidden><?php echo $row['hrg']*$row['total']+$ttlads;?></td>
					<td><?php if($pilihan_meja == '103' || $pilihan_meja == '104'){ ?>
						<input type="number" id="discon_percent1<?php echo $row['id'];?>" onClick="action_setiap_perintah('discon_percent1<?php echo $row['id'];?>')" value="<?php echo round($row['discount_type']/(($row['hrg']*$row['total']+$ttlads)/100),2);?>" style="width:40px;text-align: center; " onkeypress="discon_percent1('<?php echo $row['id'];?>')" />
						<?php }else{ echo $discount; }?>%
					</td>
					<td>
						<?php 
							if($pilihan_meja == '103' || $pilihan_meja == '104'){ ?>
								<input type="number" id="discon_nominal1<?php echo $row['id'];?>" onClick="action_setiap_perintah('discon_nominal1<?php echo $row['id'];?>')" value="<?php echo $row['discount_type'];?>" style="width:70px;margin-left:-3px;margin-right:-3px;text-align: center; " onkeypress="discon_nominal1('<?php echo $row['id'];?>')" />
						<?php 
							}else{ 
								echo number_format((($row['hrg']*$row['total'])+$ttlads)*$discount/100); 
							}
							$total_dss = $total_dss + number_format((($row['hrg']*$row['total'])+$ttlads)*$discount/100, 0, '', '');
							
							
						?>
					</td>
					<td>
						<?php 
							echo number_format((($row['hrg']*$row['total'])+$ttlads)-((($row['hrg']*$row['total'])+$ttlads)*$discount/100)-($row['discount_type']*$row['total']));
						?>
					</td>
					<td>
						<?php 
							if($simpan=='1'){ ?> 
								<input type="number" id="idkci<?php echo $row['id'];?>" style="width:60px;text-align: center;" onClick="action_setiap_perintah('idkci<?php echo $row['id'];?>')" value='1'/>
						
								<!--<a onClick="minus1('<?php echo $row['id'].'/'.$row['total'];?>')" style="cursor:pointer;">
									<img src="<?php echo $config->base_url()."images/minus.png";?>" style="width:14px;margin-bottom:2px;"/> 
								</a>
								<font id="<?php echo $row['id'];?>"><?php echo $jlh_splt;?></font>
								<a onClick="plus1('<?php echo $row['id'].'/'.$row['total'];?>')" style="cursor:pointer;">
									<img src="<?php echo $config->base_url()."images/plus.png";?>" style="width:14px;margin-bottom:2px;"/>
								</a>-->
						<?php 
							}else{
						?>
							-
						<?php } ?>
						 
					</td>
					<td class="name" id="id<?php echo $row['id'];?>" hidden><?php echo $row['id'];?></td>
					<td class="check"><?php 
						if($simpan=='1'){ ?>
							<input type="checkbox" id = "checks_<?php echo $row['id'];?>" />
						<?php 
							}else{
						?>
							-
						<?php } ?>
					</td>
				</tr>
				<?php 
					$duid = $duid+(($row['hrg']*$row['total'])+$ttlads)-((($row['hrg']*$row['total'])+$ttlads)*$discount/100)-($row['discount_type']*$row['total']);
					$service1 = 0;$ppn1 =0;
					if($service == '1'){ $service1 = ($duid-$dc_tp)*5/100; }
					if($ppn == '1'){ $ppn1 = ($duid-$dc_tp)*10/100; }
					$total_uang = $duid-$dc_tp+round(round($service1, 1))+$ppn1+$ongkir;
					$total_uang = number_format($total_uang, 0, '', '');
					$id++;
				} ?>
				<tr id="ini_tambah">
					<td onClick="show_hide()" style="cursor:pointer;">+</td>
					<td onClick="show_hide()" style="cursor:pointer;">-</td>
					<td onClick="show_hide()" style="cursor:pointer;">-</td>
					<td>
						<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Kode" required class="form-control" style="width:100px; text-align:center;cursor:pointer;">
					</td>
					<td id="nm_mkanan" onClick="show_hide()" style="cursor:pointer;">-</td>
					<td onClick="show_hide()" style="cursor:pointer;">-</td>
					<td onClick="show_hide()" style="cursor:pointer;">-</td>
					<td id="qty_mkanan" onClick="show_hide()" style="cursor:pointer;">-</td>
					<td id="hrg_mkanan" onClick="show_hide()" style="cursor:pointer;">-</td>
					<td onClick="show_hide()" style="cursor:pointer;">-</td>
					<td onClick="show_hide()" style="cursor:pointer;">-</td>
					<td onClick="show_hide()" style="cursor:pointer;">-</td>
					<td onClick="show_hide()" style="cursor:pointer;">-</td>
					<td onClick="show_hide()" style="cursor:pointer;">-</td>
					<td onClick="show_hide()" style="cursor:pointer;">-</td>
				</tr>
				
				<tr>
					<td colspan=10; style="border-bottom-style: hidden;border-left-style: hidden;" id="clspn"></td>
					<td colspan=2; align=left style="padding-left:2px;padding-right:2px;border-bottom-style: dotted;border-left-style: dotted;"><div style="color:red;">SUBTOTAL</div></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;"><?php echo number_format($duid);?></td>
					<td colspan=2; style="border-bottom-style: hidden;border-right-style: hidden;border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;" id="clspn1"></td>
				</tr>
				<?php if($pilihan_meja == '103' || $pilihan_meja == '104'){ ?>
					<tr>
						<td colspan=10; style="border-bottom-style: hidden;border-left-style: hidden;" id="clspn_<?php echo $id_trans;?>"></td>
						<td colspan=1; align=left style="padding-left:2px;padding-right:2px;border-bottom-style: dotted;border-left-style: dotted;"><div style="color:red;">Discount</div></td>
						<td colspan=1; align=left style="padding-left:2px;padding-right:2px;border-bottom-style: dotted;border-left-style: dotted;">
							<div style="display: block; margin: 0 auto;text-align: center;font-size: 14px;">
								<input type="number" step="0.01" id="discon_percent<?php echo $id_trans;?>" onClick="action_setiap_perintah('discon_percent<?php echo $id_trans;?>')" value="<?php echo round(($dc_tp/($duid/100)),2);?>" style="width:40px;text-align: center;font-size: 12px;" onkeypress="discon_percent('<?php echo $id_trans;?>')" />
								%
							</div>
						</td>
						<td style="border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;">
							<input type="number" id="discon_nominal<?php echo $id_trans;?>" onClick="action_setiap_perintah('discon_nominal<?php echo $id_trans;?>')" value="<?php echo $dc_tp;?>" style="width:80px;text-align: center; " onkeypress="discon_nominal('<?php echo $id_trans;?>')" />
						</td>
						<td colspan=2; style="border-bottom-style: hidden;border-right-style: hidden;border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;" id="clspn1_<?php echo $id_trans;?>">
							
						</td>
					</tr>
				<?php } ?>
				<?php if($pilihan_meja != '103' && $pilihan_meja != '104'){ ?>
					<tr>
						<td colspan=10; style="border-bottom-style: hidden;border-left-style: hidden;" id="clspn"></td>
						<td colspan=2; align=left style="padding-left:2px;padding-right:2px;border-bottom-style: dotted;border-left-style: dotted;"><div style="color:red;">Service</div></td>
						<td style="border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;"><?php echo number_format(round($service1, 1));?></td>
						<td colspan=2; style="border-bottom-style: hidden;border-right-style: hidden;border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;" id="clspn1">
							<input id="service_<?php echo $id_trans;?>" type="checkbox" <?php if($service == "1"){ ?>checked="checked" <?php } ?> OnClick="biaya<?php echo $id_trans;?>(1)" disabled />
						</td>
					</tr>
				<?php } ?>
				<?php if($pilihan_meja != '103' && $pilihan_meja != '104'){ ?>
					<tr>
						<td colspan=10; style="border-bottom-style: hidden;border-left-style: hidden;" id="clspn"></td>
						<td colspan=2; align=left style="padding-left:2px;padding-right:2px;border-bottom-style: dotted;border-left-style: dotted;"><div style="color:red;">PPN</div></td>
						<td style="border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;"><?php echo number_format($ppn1);?></td>
						<td colspan=2; style="border-bottom-style: hidden;border-right-style: hidden;border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;" id="clspn1">
							<input id="ppn_<?php echo $id_trans;?>" type="checkbox" <?php if($ppn == "1"){ ?>checked="checked"<?php } ?> OnClick="biaya<?php echo $id_trans;?>(2)"  disabled />
						</td>
					</tr>
				<?php } ?>
				<tr <?php if($pilihan_meja!='102'){ ?> hidden <?php } ?>>
					<td colspan=10; style="border-bottom-style: hidden;border-left-style: hidden;" id="clspn_<?php echo $id_trans;?>"></td>
					<td colspan=2; align=left style="padding-left:2px;padding-right:2px;border-bottom-style: dotted;border-left-style: dotted;"><div style="color:red;">Ongkir</div></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;">
						<input type="number" id="vcaasaa<?php echo $id_trans;?>" value="<?php echo $ongkir;?>" style="width:80px;text-align: center; " onkeypress="runScriptss('<?php echo $id_trans;?>')" />
					</td>
					<td colspan=2; style="border-bottom-style: hidden;border-right-style: hidden;border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;" id="clspn1_<?php echo $id_trans;?>">
						
					</td>
				</tr>

				<tr>
					<td colspan=10; style="border-bottom-style: hidden;border-left-style: hidden;" id="clspn"></td>
					<td colspan=2; align=left style="padding-left:2px;padding-right:2px;border-bottom-style: dotted;border-left-style: dotted;"><div style="color:red;">TOTAL</div></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;"><?php echo number_format($total_uang);?></td>
					<td colspan=2; style="border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;" id="clspn1"></td>
				</tr>
				<?php if($pilihan_meja != '103' && $pilihan_meja != '104'){
						if($deposit == '0'){ ?>
					<tr>
						<td colspan=10; style="border-bottom-style: hidden;border-left-style: hidden;" id="clspn_<?php echo $id_trans;?>"></td>
						<td colspan=2; align=left style="padding-left:2px;padding-right:2px;border-bottom-style: dotted;border-left-style: dotted;"><div style="color:red;">Voucher</div></td>
						<td style="border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;">
							<input type="number" id="vcaas<?php echo $id_trans;?>" onClick="action_setiap_perintah('vcaas<?php echo $id_trans;?>')" value="<?php echo $vc;?>" style="width:80px;text-align: center; " onkeypress="runScripts('<?php echo $id_trans;?>')" />
						</td>
						<td colspan=2; style="border-bottom-style: hidden;border-right-style: hidden;border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;" id="clspn1_<?php echo $id_trans;?>">
							
						</td>
					</tr>
				<?php } } ?>
			</tbody>
		</table>
		
		<table id="myTable" <?php if($pilihan_meja == '103' || $pilihan_meja == '104'){ ?>style="margin-top:-82px;margin-bottom:100px;;display:none" <?php }else{ ?>style="margin-top:-102px;margin-bottom:100px;;display:none" <?php } ?>>
			<?php 
				foreach($show_barang as $row){
			?>
			<tr>
				<td align="left" onClick="klik('<?php echo $row['kode']."|".$row['nama']."|".$row['hrg'];?>');" style="border-bottom: 0.1px dotted gray;cursor:pointer;" hidden><?php echo '( '.$row['kode'].' ) '.$row['nama'];?></td>
				<td align="left" onClick="klik('<?php echo $row['kode']."|".$row['nama']."|".$row['hrg'];?>');" style="border-bottom: 0.1px dotted gray;cursor:pointer; padding-right:8px;"><?php echo $row['kode'];?></td>
				<td align="left" onClick="klik('<?php echo $row['kode']."|".$row['nama']."|".$row['hrg'];?>');" style="border-bottom: 0.1px dotted gray;cursor:pointer;"><?php echo $row['nama'];?></td>
			</tr>
				<?php } ?>
		</table>
			<div id="pbyrn" <?php if($pilihan_meja == '103' || $pilihan_meja == '104'){ ?> style="margin-top:-80px;margin-bottom:100px;width:100%;"<?php }else{ ?> style="margin-top:-100px;margin-bottom:100px;width:100%;"<?php } ?>  
				<?php if($simpan == 0 || $ses[2] == 2){ ?> hidden <?php } ?>>
			<div style="float:left;text-align:left;font-size:16px;">
				<div style="margin-top:5px;">
					Pembayaran : <br>
					<div id="ssslole" style="float:left;display:none;">
					<input type="checkbox" name="pembayaran" value="male" style="margin-left:10px;" id="check_dpst" onClick="pbyrn('1')">
					<label for="male">Deposit</label>
					</div>
					<div id="ssslole1" style="float:left;">
					<input type="checkbox" name="pembayaran" value="male" style="margin-left:10px;" id="check_tunai" onClick="pbyrn('2')" checked="checked">
					<label for="male">Tunai</label>
					</div>
					<div id="ssslole2" style="float:left;">
					<input type="checkbox" name="pembayaran" value="female" style="margin-left:10px;" id="check_debit" onClick="pbyrn('3')">
					<label for="female">Debit</label>
					</div>
					<div id="ssslole3" style="float:left;">
					<input type="checkbox" name="pembayaran" value="male" style="margin-left:10px;" id="check_kartu_kredit" onClick="pbyrn('4')">
					<label for="male">Kartu Kredit</label>
					</div>
					<div id="ssslole4" style="float:left;">
					<input type="checkbox" name="pembayaran" value="female" style="margin-left:10px;" id="check_ovo" onClick="pbyrn('5')">
					<label for="female">OVO</label>
					</div>
					<div id="ssslole5" style="float:left;">
					<input type="checkbox" name="pembayaran" value="male" style="margin-left:10px;" id="check_gopay" onClick="pbyrn('6')">
					<label for="male">GoPay</label>
					</div>
					<div id="ssslole6" style="float:left;">
					<input type="checkbox" name="pembayaran" value="female" style="margin-left:10px;" id="check_transfer" onClick="pbyrn('7')">
					<label for="female">Transfer</label>
					</div>
				</div>
				<div style="clear: both;"></div>
				
				<div style="width:70%;">
					<div id="pbyrn_deposit" style="display:none;">
						<font style="font-size: 12px;">Pembayaran Deposit</font><br>
						<div style = "margin-bottom:-22px;margin-left:6px; font-size:10px;color:gray;">Nominal : </div>
						<input type="number" name="pbyrn_deposit" onkeyup="ip_function()" id="ip_deposit" placeholder="pbyrn_deposit" required class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
					</div>
					<div style="clear: both;"></div>
					<div id="pbyrn_tunai">
						<font style="font-size: 12px;">Pembayaran Tunai</font><br>
						<div style = "margin-bottom:-22px;margin-left:6px; font-size:10px;color:gray;">Nominal : </div>
						<input type="number" name="pbyrn_tunai" onkeyup="ip_function()" placeholder="pbyrn_tunai" id="ip_tunai" required class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >

					</div>
					<div style="clear: both;"></div>
					<div id="pbyrn_debit">
						<font style="font-size: 12px;">Pembayaran Debit</font><br>
						<div style = "margin-bottom:-22px;margin-left:6px; font-size:10px;color:gray;">Nominal : </div>
						<input type="number" name="pbyrn_debit" placeholder="pbyrn_debit" onkeyup="ip_function()" id="ip_debit" required class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
						<div style = "margin-bottom:-22px;margin-left:6px; font-size:10px;color:gray;">No Rekening : </div>
						<input type="text" name="pbyrn_debit" placeholder="" id="ip_debit1" required class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
						<div style = "margin-bottom:-22px;margin-left:6px; font-size:10px;color:gray;">EDC : </div>
						<select name="pbyrn_debit" id="ip_debit2" class="form_pbyrn" style="float:left;text-align:left;width:100%;padding-left:42px;">
							<?php foreach($show_edc as $sedc){ ?>
								<option value="<?php echo $sedc['nama'];?>"><?php echo $sedc['nama'];?></option>
							<?php } ?>
						</select>
						<div style = "margin-bottom:-22px;margin-left:6px; font-size:10px;color:gray;">Bank : </div>
						<select name="pbyrn_debit" id="ip_debit3" class="form_pbyrn" style="float:left;text-align:left;width:100%;padding-left:42px;">
							<?php foreach($show_bank as $sedc){ ?>
								<option value="<?php echo $sedc['nama'];?>"><?php echo $sedc['nama'];?></option>
							<?php } ?>
						</select>
					</div>
					<div style="clear: both;"></div>
					<div id="pbyrn_kartu_kredit">
						<font style="font-size: 12px;">Pembayaran Kartu Kredit</font><br>
						<div style = "margin-bottom:-22px;margin-left:6px; font-size:10px;color:gray;">Nominal : </div>
						<input type="number" name="pbyrn_debit" placeholder="pbyrn_debit" onkeyup="ip_function()" id="ip_kk" required class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
						<div style = "margin-bottom:-22px;margin-left:6px; font-size:10px;color:gray;">No Rekening : </div>
						<input type="text" name="pbyrn_debit" placeholder="" id="ip_kk1" required class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
						<div style = "margin-bottom:-22px;margin-left:6px; font-size:10px;color:gray;">EDC : </div>
						<select name="pbyrn_debit" id="ip_kk2" class="form_pbyrn" style="float:left;text-align:left;width:100%;padding-left:42px;">
							<?php foreach($show_edc as $sedc){ ?>
								<option value="<?php echo $sedc['nama'];?>"><?php echo $sedc['nama'];?></option>
							<?php } ?>
						</select>
						<div style = "margin-bottom:-22px;margin-left:6px; font-size:10px;color:gray;">Bank : </div>
						<select name="pbyrn_debit" id="ip_kk3" class="form_pbyrn" style="float:left;text-align:left;width:100%;padding-left:42px;">
							<?php foreach($show_bank as $sedc){ ?>
								<option value="<?php echo $sedc['nama'];?>"><?php echo $sedc['nama'];?></option>
							<?php } ?>
						</select>
					</div>
					<div style="clear: both;"></div>
					<div id="pbyrn_ovo">
						<font style="font-size: 12px;">Pembayaran Ovo Debit</font><br>
						<div style = "margin-bottom:-22px;margin-left:6px; font-size:10px;color:gray;">Nominal : </div>
						<input type="number" name="pbyrn_debit" placeholder="pbyrn_debit" onkeyup="ip_function()" id="ip_ovo" required class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
						<div style = "margin-bottom:-22px;margin-left:6px; font-size:10px;color:gray;">Nomor : </div>
						<input type="text" name="pbyrn_debit" placeholder="" required id="ip_ovo1" class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
					</div>
					<div style="clear: both;"></div>
					<div id="pbyrn_gopay">
						<font style="font-size: 12px;">Pembayaran GoPay</font><br>
						<div style = "margin-bottom:-22px;margin-left:6px; font-size:10px;color:gray;">Nominal : </div>
						<input type="number" name="pbyrn_debit" placeholder="pbyrn_debit" onkeyup="ip_function()" id="ip_gopay" required class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
						<div style = "margin-bottom:-22px;margin-left:6px; font-size:10px;color:gray;">Nomor : </div>
						<input type="text" name="pbyrn_debit" placeholder="" required id="ip_gopay1" class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
					</div>
					<div style="clear: both;"></div>
					<div id="pbyrn_transfer">
						<font style="font-size: 12px;">Pembayaran Transfer</font><br>
						<div style = "margin-bottom:-22px;margin-left:6px; font-size:10px;color:gray;">Nominal : </div>
						<input type="number" name="pbyrn_debit" placeholder="pbyrn_debit" onkeyup="ip_function()" id="ip_transfer" required class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
						<div style = "margin-bottom:-22px;margin-left:6px; font-size:10px;color:gray;">No Rekening : </div>
						<input type="text" name="pbyrn_debit" placeholder="" required id="ip_transfer1" class="form_pbyrn" style="float:left;text-align:right;width:100%;" value=''>
						<input type="text" name="pbyrn_debit" placeholder="EDC" required id="ip_transfer2" class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' hidden>
						<div style = "margin-bottom:-22px;margin-left:6px; font-size:10px;color:gray;">Bank : </div>
						<select name="pbyrn_debit" id="ip_transfer3" class="form_pbyrn" style="float:left;text-align:left;width:100%;padding-left:42px;">
							<?php foreach($show_bank as $sedc){ ?>
								<option value="<?php echo $sedc['nama'];?>"><?php echo $sedc['nama'];?></option>
							<?php } ?>
						</select>
					</div>
					<div style="clear: both;"></div>
					<font style="font-size: 12px;margin-left:5px;">Total Bayar</font><br>
					<input placeholder="No Trans" required class="form_pbyrn" id="ip_ttl_pmby" style="float:left;text-align:right;width:100%;margin-top:-22px;" value='Rp 142,600' disabled>
					<font style="font-size: 12px;margin-left:5px;">Kembalian</font><br>
					<input placeholder="No Trans" required class="form_pbyrn" id="ip_ttl_kmbali" style="float:left;text-align:right;width:100%;margin-top:-22px;" value='Rp 0' disabled>
					<div style="clear: both;"></div>
					<a onClick="bayar_sekarang()"  id='bysdfsdafasd' class="card_pilihan_meja1" style="width:180px;float:right;height:auto;background:#987860;border-color:#987860;color:white;padding-left:16px;">
						Bayar Sekarang <img src="<?php echo $config->base_url()."images/printer.png";?>" style="width:14px;margin-bottom:2px;"/>
					</a>
				</div>
			</div>
		</div>
		
	</div>
</div>
</div>
</div>
</div>
</div>
</div>

<div style="clear: both;"/>


<div id="pilihan_utama1" class="card_table" style="margin-left:1%;margin-right:1%;margin-top:1%;display:none;" >
	<div style="z-index: 10;  float:left;margin-top:-18px;margin-left:-10px">
		<a onClick="memilih_meja()" style="font-size:18px;float:left;">
			Meja No <?php echo $pilihan_meja; ?>
		</a>

		<br>
		<div style="font-size:8px;float:left;">29/07/2020 10:24</div>
	</div>
	<br>
	<div style="width:90%;margin-left:5%;margin-right:5%;">
		
		<?php 
			$visios = 50;
			foreach($show_ok as $rb){
				$aaaaa[$rb['oyi']] = 1;
			}
		?>
		<div style="margin:16px">
			<div class="card_pilihan_mejass" <?php if($aaaaa[107] == '1'){ ?>  style="background:#D84949;border-color:#D84949;width: 11%;" <?php }else{ ?>style="width: 11%;"<?php }?>>
				<div style="margin: auto;width: 100%;margin-top: 5px; text-align: center;cursor:pointer;" onClick = "anm('107')">
					<b>Owner</b>
				</div>
			</div>
		</div>
		<div style="margin:16px">
			<div class="card_pilihan_mejass" <?php if($aaaaa[106] == '1'){ ?>  style="background:#D84949;border-color:#D84949;width: 11%;" <?php }else{ ?>style="width: 11%;"<?php }?>>
				<div style="margin: auto;width: 100%;margin-top: 5px; text-align: center;cursor:pointer;" onClick = "anm('106')">
					<b>Oprsnl</b>
				</div>
			</div>
		</div>
		<div style="margin:16px">
			<div class="card_pilihan_mejass" <?php if($aaaaa[105] == '1'){ ?>  style="background:#D84949;border-color:#D84949;width: 11%;" <?php }else{ ?>style="width: 11%;"<?php }?>>
				<div style="margin: auto;width: 100%;margin-top: 5px; text-align: center;cursor:pointer;" onClick = "anm('105')">
					<b>Mrkting</b>
				</div>
			</div>
		</div>
		<div style="margin:16px">
			<div class="card_pilihan_mejass" <?php if($aaaaa[101] == '1'){ ?>  style="background:#D84949;border-color:#D84949;width: 11%;" <?php }else{ ?>style="width: 11%;"<?php }?>>
				<div style="margin: auto;width: 100%;margin-top: 5px; text-align: center;cursor:pointer;"  onClick = "anm('101')">
					<b>VIP</b>
				</div>
			</div>
		</div>
		<div style="margin:16px">
			<div class="card_pilihan_mejass"  <?php if($aaaaa[0] == '1'){ ?>  style="background:#D84949;border-color:#D84949;width: 11%;" <?php }else{ ?>style="width: 11%;"<?php }?>>
				<div style="margin: auto;width: 100%;margin-top: 5px; text-align: center;cursor:pointer;" onClick = "anm('0')">
					<b>Meeting</b>
				</div>
			</div>
		</div>
		<div style="margin:16px">
			<div class="card_pilihan_mejass" <?php if($aaaaa[102] == '1'){ ?>  style="background:#D84949;border-color:#D84949;width: 11%;" <?php }else{ ?>style="width: 11%;"<?php }?>>
				<div style="margin: auto;width: 100%;margin-top: 5px; text-align: center;cursor:pointer;" onClick = "anm('102')">
					<b>Delivery</b>
				</div>
			</div>
		</div>
		<div style="margin:16px">
			<div class="card_pilihan_mejass" <?php if($aaaaa[103] == '1'){ ?>  style="background:#D84949;border-color:#D84949;width: 11%;" <?php }else{ ?>style="width: 11%;"<?php }?>>
				<div style="margin: auto;width: 100%;margin-top: 5px; text-align: center;cursor:pointer;" onClick = "anm('103')">
					<b>Grab</b>
				</div>
			</div>
		</div><div style="margin:16px">
			<div class="card_pilihan_mejass" <?php if($aaaaa[104] == '1'){ ?>  style="background:#D84949;border-color:#D84949;width: 11%;" <?php }else{ ?>style="width: 11%;"<?php }?>>
				<div style="margin: auto;width: 100%;margin-top: 5px; text-align: center;cursor:pointer;" onClick = "anm('104')">
					<b>Gojek</b>
				</div>
			</div>
		</div>
		
		<?php 
			for($visio = 1; $visio < $visios;$visio++){
		?>
				<div style="margin:16px">
					<div class="card_pilihan_mejass" onClick = "anm('<?php echo $visio;?>')" <?php if($aaaaa[$visio] == '1'){ ?> style="background:#D84949;border-color:#D84949;cursor:pointer;" <?php }else{ ?>style="cursor:pointer;"<?php } ?>>
						<div style="margin: auto;width: 50%;margin-top: 5px; text-align: center;">
							<b><?php echo $visio;?></b>
						</div>
					</div>
				</div>
		<?php
			}
		?>
		
	</div>
</div>
<div style="clear: both;"/>

<script>
	var pilihan_utama = document.getElementById("pilihan_utama");
	var tbl = document.getElementById("myTable");
	var ini_tambah = document.getElementById("ini_tambah");
	var splt = document.getElementById("splt");
	var splt1 = document.getElementById("splt1");

	<?php if($barcode != '0'){ ?>
		document.getElementById("type_member2").checked = true;
		document.getElementById("check_dpst").checked = true;
		document.getElementById("check_tunai").checked = false;
		document.getElementById("member_cari").value = ''+<?php echo $barcode;?>;
		document.getElementById("ssslole").style.display = "block";
	<?php } ?>
	<?php if($pilihan_meja == '103'){ ?>
		document.getElementById("check_tunai").checked = false;
		document.getElementById("check_ovo").checked = true;
		document.getElementById("ssslole1").style.display = "none";
		document.getElementById("ssslole2").style.display = "none";
		document.getElementById("ssslole3").style.display = "none";
		document.getElementById("ssslole5").style.display = "none";
		document.getElementById("ssslole6").style.display = "none";
	<?php } ?>
	<?php if($pilihan_meja == '104'){ ?>
		document.getElementById("check_tunai").checked = false;
		document.getElementById("check_gopay").checked = true;
		document.getElementById("ssslole1").style.display = "none";
		document.getElementById("ssslole2").style.display = "none";
		document.getElementById("ssslole3").style.display = "none";
		document.getElementById("ssslole4").style.display = "none";
		document.getElementById("ssslole6").style.display = "none";
	<?php } ?>
	if (document.getElementById("type_member1").checked) {
		document.getElementById("kartu_member").style.display = "none";
	} else {
		document.getElementById("kartu_member").style.display = "block";
	}
	if(document.getElementById("check_dpst").checked === true){
		var zaa = parseInt(document.getElementById("saldo_members").value);
		zaa1 = parseInt(<?php echo $total_uang-$vc; ?>); 
		tlssss = zaa - zaa1;
		var cuy = zaa1;
		if(tlssss < 0){
			cuy = zaa;
		}
		document.getElementById("ip_deposit").value = cuy;
		document.getElementById("pbyrn_deposit").style.display = "block";
		document.getElementById("ip_tunai").value = "<?php echo '0'; ?>";
		document.getElementById("ip_debit").value = "<?php echo '0'; ?>";
		document.getElementById("ip_kk").value = "<?php echo '0'; ?>";
		document.getElementById("ip_ovo").value = "<?php echo '0'; ?>";
		document.getElementById("ip_gopay").value = "<?php echo '0'; ?>";
		document.getElementById("ip_transfer").value = "<?php echo '0'; ?>";
	}else{
		document.getElementById("pbyrn_deposit").style.display = "none";
		document.getElementById("ip_deposit").value = "<?php echo '0'; ?>";
	}
	if(document.getElementById("check_tunai").checked === true){
		if(document.getElementById("check_dpst").checked === true){ 
			document.getElementById("ip_tunai").value = "<?php echo '0'; ?>";
		}else{
			document.getElementById("ip_tunai").value = "<?php echo $total_uang-$vc; ?>";
		}
		document.getElementById("ip_debit").value = "<?php echo '0'; ?>";
		document.getElementById("ip_kk").value = "<?php echo '0'; ?>";
		document.getElementById("ip_ovo").value = "<?php echo '0'; ?>";
		document.getElementById("ip_gopay").value = "<?php echo '0'; ?>";
		document.getElementById("ip_transfer").value = "<?php echo '0'; ?>";
		
		document.getElementById("pbyrn_tunai").style.display = "block";
	}else{
		document.getElementById("pbyrn_tunai").style.display = "none";
		document.getElementById("ip_tunai").value = "<?php echo '0'; ?>";
	}
	if(document.getElementById("check_debit").checked === true){
		if(document.getElementById("check_dpst").checked === true || document.getElementById("check_tunai").checked === true){
			document.getElementById("ip_debit").value = "<?php echo '0'; ?>";
		}else{
			document.getElementById("ip_debit").value = "<?php echo $total_uang-$vc; ?>";
		}
		// document.getElementById("ip_kk").value = "<?php echo '0'; ?>";
		// document.getElementById("ip_ovo").value = "<?php echo '0'; ?>";
		// document.getElementById("ip_gopay").value = "<?php echo '0'; ?>";
		// document.getElementById("ip_transfer").value = "<?php echo '0'; ?>";
		
		document.getElementById("pbyrn_debit").style.display = "block";
	}else{
		document.getElementById("pbyrn_debit").style.display = "none";
		document.getElementById("ip_debit").value = "<?php echo '0'; ?>";

	}
	if(document.getElementById("check_kartu_kredit").checked === true){
		if(document.getElementById("check_dpst").checked === true || document.getElementById("check_tunai").checked === true || document.getElementById("check_debit").checked === true){
			document.getElementById("ip_kk").value = "<?php echo '0'; ?>";
		}else{
			document.getElementById("ip_kk").value = "<?php echo $total_uang-$vc; ?>";
		}
		document.getElementById("ip_ovo").value = "<?php echo '0'; ?>";
		document.getElementById("ip_gopay").value = "<?php echo '0'; ?>";
		document.getElementById("ip_transfer").value = "<?php echo '0'; ?>";
		
		document.getElementById("pbyrn_kartu_kredit").style.display = "block";
	}else{
		document.getElementById("pbyrn_kartu_kredit").style.display = "none";
		document.getElementById("ip_kk").value = "<?php echo '0'; ?>";
	}
	if(document.getElementById("check_ovo").checked === true){
		if(document.getElementById("check_dpst").checked === true || document.getElementById("check_tunai").checked === true || document.getElementById("check_debit").checked === true
		|| document.getElementById("check_kartu_kredit").checked === true){
			document.getElementById("ip_ovo").value = "<?php echo '0'; ?>";
		}else{
			document.getElementById("ip_ovo").value = "<?php echo $total_uang-$vc; ?>";
		}
		document.getElementById("ip_gopay").value = "<?php echo '0'; ?>";
		document.getElementById("ip_transfer").value = "<?php echo '0'; ?>";
		
		document.getElementById("pbyrn_ovo").style.display = "block";
	}else{
		document.getElementById("pbyrn_ovo").style.display = "none";
		document.getElementById("ip_ovo").value = "<?php echo '0'; ?>";
	}
	if(document.getElementById("check_gopay").checked === true){
		if(document.getElementById("check_dpst").checked === true || document.getElementById("check_tunai").checked === true || document.getElementById("check_debit").checked === true
		|| document.getElementById("check_kartu_kredit").checked === true || document.getElementById("check_ovo").checked === true){
			document.getElementById("ip_gopay").value = "<?php echo '0'; ?>";
		}else{
			document.getElementById("ip_gopay").value = "<?php echo $total_uang-$vc; ?>";
		}
		document.getElementById("ip_transfer").value = "<?php echo '0'; ?>";
		document.getElementById("pbyrn_gopay").style.display = "block";
	}else{
		document.getElementById("pbyrn_gopay").style.display = "none";
		document.getElementById("ip_gopay").value = "<?php echo '0'; ?>";
	}
	if(document.getElementById("check_transfer").checked === true){
		if(document.getElementById("check_dpst").checked === true || document.getElementById("check_tunai").checked === true || document.getElementById("check_debit").checked === true
		|| document.getElementById("check_kartu_kredit").checked === true || document.getElementById("check_ovo").checked === true || document.getElementById("check_gopay").checked === true){
			document.getElementById("ip_transfer").value = "<?php echo '0'; ?>";
		}else{
			document.getElementById("ip_transfer").value = "<?php echo $total_uang-$vc; ?>";
		}
		
		document.getElementById("pbyrn_transfer").style.display = "block";
	}else{
		document.getElementById("pbyrn_transfer").style.display = "none";
		document.getElementById("ip_transfer").value = "<?php echo '0'; ?>";
	}
	
	ip_function();
	
	<?php if($simpan == '1'){ ?>
		function bayar_sekarang(){
			var a1 = "0",a2 = "0",a3 = "0",a4 = "0",a5 = "0",a6 = "0",a7 = "0";
			var b1 = "0",c1 = "0",d1 = "0",d2 = "0",d3 = "0",d4 = "0",e1 = "0",e2 = "0",e3 = "0",e4 = "0";
			var f1 = "0",f2 = "0",g1 = "0",g2 = "0",h1 = "0",h2 = "0",h3 = "0",h4 = "0",id_trans = "0";
			if(document.getElementById("check_dpst").checked === true){
				a1 = "1";
				b1 = ""+document.getElementById("ip_deposit").value;
			}if(document.getElementById("check_tunai").checked === true){
				a2 = "1";
				c1 = ""+document.getElementById("ip_tunai").value;
			}if(document.getElementById("check_debit").checked === true){
				a3 = "1";
				d1 = document.getElementById("ip_debit").value;
				d2 = document.getElementById("ip_debit1").value;
				d3 = document.getElementById("ip_debit2").value;
				d4 = document.getElementById("ip_debit3").value;
			}if(document.getElementById("check_kartu_kredit").checked === true){
				a4 = "1";
				e1 = document.getElementById("ip_kk").value;
				e2 = document.getElementById("ip_kk1").value;
				e3 = document.getElementById("ip_kk2").value;
				e4 = document.getElementById("ip_kk3").value;
			}if(document.getElementById("check_ovo").checked === true){
				a5 = "1";
				f1 = document.getElementById("ip_ovo").value;
				f2 = document.getElementById("ip_ovo1").value;
			}if(document.getElementById("check_gopay").checked === true){
				a6 = "1";
				g1 = document.getElementById("ip_gopay").value;
				g2 = document.getElementById("ip_gopay1").value;
			}if(document.getElementById("check_transfer").checked === true){
				a7 = "1";
				h1 = document.getElementById("ip_transfer").value;
				h2 = document.getElementById("ip_transfer1").value;
				h3 = document.getElementById("ip_transfer2").value;
				h4 = document.getElementById("ip_transfer3").value;
			}
			
			var ttllla1 = parseInt(document.getElementById("ip_deposit").value) + parseInt(document.getElementById("ip_tunai").value) + parseInt(document.getElementById("ip_debit").value) +
			parseInt(document.getElementById("ip_kk").value) + parseInt(document.getElementById("ip_ovo").value) + parseInt(document.getElementById("ip_gopay").value) + parseInt(document.getElementById("ip_transfer").value);

			var kembalian = ttllla1 - <?php echo $total_uang-$vc;?>;
			if(kembalian < 0){
				alert('uang kurang'+kembalian);
			}else{
				a11 = a1+'*'+a2+'*'+a3+'*'+a4+'*'+a5+'*'+a6+'*'+a7;
				a12 = b1+'*'+c1+'*'+d1+'*'+e1+'*'+f1+'*'+g1+'*'+h1;
				open('<?php echo $config->base_url();?>print_bill/'+<?php echo $id_trans;?>+'/'+kembalian+'/'+a11+'/'+a12+'/<?php echo $total_dss;?>.html');
				$.post("<?php echo $config->base_url();?>bayar_sekarang.html",{
					var1: ""+a1, var2: ""+a2, var3: ""+a3, var4: ""+a4, var5: ""+a5, var6: ""+a6, var7: ""+a7,
					b1: ""+b1, c1: ""+c1, d1: ""+d1, d2: ""+d2, d3: ""+d3, d4: ""+d4, e1: ""+e1, e2: ""+e2, e3: ""+e3, e4: ""+e4,
					f1: ""+f1, f2: ""+f2, g1: ""+g1, g2: ""+g2, h1: ""+h1, h2: ""+h2, h3: ""+h3, h4: ""+h4, id_trans: ""+<?php echo $id_trans;?>,
					duid: ""+<?php echo $duid;?>, service1: ""+<?php echo $service1;?>, ppn1: ""+<?php echo $ppn1;?>, total_uang: ""+<?php echo $total_uang;?>
				}, function(data){
					$.post('<?php echo $config->base_url();?>list_transaksis/'+<?php echo $pilihan_meja;?>+'.html',function(data){
						$('#dunia').html(data);
					});
				});
			}
			
		}
		
		document.getElementById("bysdfsdafasd").style.cursor = "pointer";
	<?php }else{ ?>
		document.getElementById("bysdfsdafasd").style.borderColor = "white";
		document.getElementById("bysdfsdafasd").style.background = "white";
		document.getElementById("bysdfsdafasd").style.color = "black";
		document.getElementById("bysdfsdafasd").style.cursor = "dotted";
	<?php } ?>
	
	function add_onss(param) {
		var x = document.getElementById("popup");
		x.style.visibility = "visible" ;
		$.post('<?php echo $config->base_url();?>add_onss/'+param+'/'+<?php echo $pilihan_meja;?>+'.html',function(data){
			$('#testerasdasd').html(data);
		});
	}
	function raaaa(param) {
		var x = event.keyCode;
		if(event.keyCode == 13){
			var zzzzz = document.getElementById("kets"+param).value;
			var zzzzza = param;
			// alert(''+zzzzz+'/'+zzzzza);
			if(zzzzz == ""){
				zzzzz = '-';
			}
			
			$.post('<?php echo $config->base_url();?>ganti_keterangan/'+zzzzza+'/'+zzzzz+'.html',function(data){
				$.post('<?php echo $config->base_url();?>list_transaksis/'+<?php echo $pilihan_meja;?>+'.html',function(data){
					$('#dunia').html(data);
					document.getElementById("qtyaa"+param).focus();
					document.getElementById("qtyaa"+param).select();
				});
			});
			return false;
		}
	}
	function ip_function() {
		if(document.getElementById("ip_deposit").value == ''){
			document.getElementById("ip_deposit").value = '0';
		}if(document.getElementById("ip_tunai").value == ''){
			document.getElementById("ip_tunai").value = '0';
		}if(document.getElementById("ip_debit").value == ''){
			document.getElementById("ip_debit").value = '0';
		}if(document.getElementById("ip_kk").value == ''){
			document.getElementById("ip_kk").value = '0';
		}if(document.getElementById("ip_ovo").value == ''){
			document.getElementById("ip_ovo").value = '0';
		}if(document.getElementById("ip_gopay").value == ''){
			document.getElementById("ip_gopay").value = '0';
		}if(document.getElementById("ip_transfer").value == ''){
			document.getElementById("ip_transfer").value = '0';
		}
		var ttllla1 = parseInt(document.getElementById("ip_deposit").value) + parseInt(document.getElementById("ip_tunai").value) + parseInt(document.getElementById("ip_debit").value) +
		parseInt(document.getElementById("ip_kk").value) + parseInt(document.getElementById("ip_ovo").value) + parseInt(document.getElementById("ip_gopay").value) + parseInt(document.getElementById("ip_transfer").value);

		var kembalian = ttllla1 - <?php echo $total_uang-$vc;?>;
		document.getElementById("ip_ttl_pmby").value = "Rp "+new Intl.NumberFormat().format(ttllla1); 
		document.getElementById("ip_ttl_kmbali").value = "Rp "+new Intl.NumberFormat().format(kembalian); 
	}
	
	function pbyrn(param){
		if(param == '1'){
			if(document.getElementById("check_tunai").checked === true && document.getElementById("check_debit").checked === true){ 
				document.getElementById("check_dpst").checked = false;
				alert('pembayaran tidak boleh lebih dari 2');
			}else{
				if(document.getElementById("check_dpst").checked === true){
					document.getElementById("pbyrn_deposit").style.display = "block";
					if(document.getElementById("check_tunai").checked === true){ 
						document.getElementById("ip_tunai").value = "<?php echo '0'; ?>";
					}
					
					var zaa = parseInt(document.getElementById("saldo_members").value); 
					// alert(''+zaa);
					zaa1 = parseInt(<?php echo $total_uang-$vc; ?>); 
					tlssss = zaa - zaa1;
					var cuy = zaa1;
					if(tlssss < 0){
						cuy = zaa;
					}
					document.getElementById("ip_deposit").value = cuy;
					
					document.getElementById("check_kartu_kredit").checked = false;
					document.getElementById("check_ovo").checked = false;
					document.getElementById("check_gopay").checked = false;
					document.getElementById("check_transfer").checked = false;
					
					document.getElementById("ip_kk").value = "<?php echo '0'; ?>";
					document.getElementById("pbyrn_kartu_kredit").style.display = "none";
					document.getElementById("ip_ovo").value = "<?php echo '0'; ?>";
					document.getElementById("pbyrn_ovo").style.display = "none";
					document.getElementById("ip_gopay").value = "<?php echo '0'; ?>";
					document.getElementById("pbyrn_gopay").style.display = "none";
					document.getElementById("ip_transfer").value = "<?php echo '0'; ?>";
					document.getElementById("pbyrn_transfer").style.display = "none";
					
					// document.getElementById("ip_deposit").value = "<?php echo $total_uang; ?>";
				}else{
					if(document.getElementById("check_tunai").checked === true){ 
						document.getElementById("ip_tunai").value = "<?php echo $total_uang-$vc; ?>";
					}else{
						document.getElementById("ip_tunai").value = "<?php echo '0'; ?>";
					}
					document.getElementById("pbyrn_deposit").style.display = "none";
					document.getElementById("ip_deposit").value = "<?php echo '0'; ?>";
				}
			}
		}else if(param == '2'){
			if(document.getElementById("check_dpst").checked === true && document.getElementById("check_debit").checked === true){ 
				document.getElementById("check_tunai").checked = false;
				alert('pembayaran tidak boleh lebih dari 2');
			}else{
				if(document.getElementById("check_tunai").checked === true){
					if(document.getElementById("check_dpst").checked === true){ 
						document.getElementById("ip_tunai").value = "<?php echo '0'; ?>";
					}else{
						document.getElementById("ip_tunai").value = "<?php echo $total_uang-$vc; ?>";
					}
					
					document.getElementById("check_kartu_kredit").checked = false;
					document.getElementById("check_ovo").checked = false;
					document.getElementById("check_gopay").checked = false;
					document.getElementById("check_transfer").checked = false;
					
					document.getElementById("ip_kk").value = "<?php echo '0'; ?>";
					document.getElementById("pbyrn_kartu_kredit").style.display = "none";
					document.getElementById("ip_ovo").value = "<?php echo '0'; ?>";
					document.getElementById("pbyrn_ovo").style.display = "none";
					document.getElementById("ip_gopay").value = "<?php echo '0'; ?>";
					document.getElementById("pbyrn_gopay").style.display = "none";
					document.getElementById("ip_transfer").value = "<?php echo '0'; ?>";
					document.getElementById("pbyrn_transfer").style.display = "none";
					
					document.getElementById("pbyrn_tunai").style.display = "block";
				}else{
					document.getElementById("pbyrn_tunai").style.display = "none";
					document.getElementById("ip_tunai").value = "<?php echo '0'; ?>";
				}
			}
		}else if(param == '3'){
			if(document.getElementById("check_dpst").checked === true && document.getElementById("check_tunai").checked === true){ 
				document.getElementById("check_debit").checked = false;
				alert('pembayaran tidak boleh lebih dari 2');
			}else{
				if(document.getElementById("check_debit").checked === true){
					if(document.getElementById("check_dpst").checked === true || document.getElementById("check_tunai").checked === true){ 
						document.getElementById("ip_debit").value = "<?php echo '0'; ?>";
					}else{
						document.getElementById("ip_debit").value = "<?php echo $total_uang-$vc; ?>";
					}
					
					document.getElementById("check_kartu_kredit").checked = false;
					document.getElementById("check_ovo").checked = false;
					document.getElementById("check_gopay").checked = false;
					document.getElementById("check_transfer").checked = false;
					
					document.getElementById("ip_kk").value = "<?php echo '0'; ?>";
					document.getElementById("pbyrn_kartu_kredit").style.display = "none";
					document.getElementById("ip_ovo").value = "<?php echo '0'; ?>";
					document.getElementById("pbyrn_ovo").style.display = "none";
					document.getElementById("ip_gopay").value = "<?php echo '0'; ?>";
					document.getElementById("pbyrn_gopay").style.display = "none";
					document.getElementById("ip_transfer").value = "<?php echo '0'; ?>";
					document.getElementById("pbyrn_transfer").style.display = "none";
					
					document.getElementById("pbyrn_debit").style.display = "block";
				}else{
					document.getElementById("ip_debit").value = "<?php echo '0'; ?>";
					document.getElementById("pbyrn_debit").style.display = "none";
				}
			}
		}else if(param == '4'){
			if(document.getElementById("check_kartu_kredit").checked === true){
				document.getElementById("ip_kk").value = "<?php echo $total_uang-$vc; ?>";

				document.getElementById("check_dpst").checked = false;
				document.getElementById("check_tunai").checked = false;
				document.getElementById("check_debit").checked = false;
				document.getElementById("check_ovo").checked = false;
				document.getElementById("check_gopay").checked = false;
				document.getElementById("check_transfer").checked = false;
				
				document.getElementById("pbyrn_deposit").style.display = "none";
				document.getElementById("ip_deposit").value = "<?php echo '0'; ?>";
				document.getElementById("pbyrn_tunai").style.display = "none";
				document.getElementById("ip_tunai").value = "<?php echo '0'; ?>";
				document.getElementById("ip_debit").value = "<?php echo '0'; ?>";
				document.getElementById("pbyrn_debit").style.display = "none";
				document.getElementById("ip_ovo").value = "<?php echo '0'; ?>";
				document.getElementById("pbyrn_ovo").style.display = "none";
				document.getElementById("ip_gopay").value = "<?php echo '0'; ?>";
				document.getElementById("pbyrn_gopay").style.display = "none";
				document.getElementById("ip_transfer").value = "<?php echo '0'; ?>";
				document.getElementById("pbyrn_transfer").style.display = "none";
				
				document.getElementById("pbyrn_kartu_kredit").style.display = "block";
			}else{
				document.getElementById("ip_kk").value = "<?php echo '0'; ?>";
				document.getElementById("pbyrn_kartu_kredit").style.display = "none";
			}
		}else if(param == '5'){
			if(document.getElementById("check_ovo").checked === true){
				document.getElementById("ip_ovo").value = "<?php echo $total_uang-$vc; ?>";
				
				document.getElementById("check_dpst").checked = false;
				document.getElementById("check_tunai").checked = false;
				document.getElementById("check_debit").checked = false;
				document.getElementById("check_kartu_kredit").checked = false;
				document.getElementById("check_gopay").checked = false;
				document.getElementById("check_transfer").checked = false;
				
				document.getElementById("pbyrn_deposit").style.display = "none";
				document.getElementById("ip_deposit").value = "<?php echo '0'; ?>";
				document.getElementById("pbyrn_tunai").style.display = "none";
				document.getElementById("ip_tunai").value = "<?php echo '0'; ?>";
				document.getElementById("ip_debit").value = "<?php echo '0'; ?>";
				document.getElementById("pbyrn_debit").style.display = "none";
				document.getElementById("ip_kk").value = "<?php echo '0'; ?>";
				document.getElementById("pbyrn_kartu_kredit").style.display = "none";
				document.getElementById("ip_gopay").value = "<?php echo '0'; ?>";
				document.getElementById("pbyrn_gopay").style.display = "none";
				document.getElementById("ip_transfer").value = "<?php echo '0'; ?>";
				document.getElementById("pbyrn_transfer").style.display = "none";
				
				document.getElementById("pbyrn_ovo").style.display = "block";
			}else{
				document.getElementById("ip_ovo").value = "<?php echo '0'; ?>";
				document.getElementById("pbyrn_ovo").style.display = "none";
			}
		}else if(param == '6'){
			if(document.getElementById("check_gopay").checked === true){
				document.getElementById("ip_gopay").value = "<?php echo $total_uang-$vc; ?>";
				
				document.getElementById("check_dpst").checked = false;
				document.getElementById("check_tunai").checked = false;
				document.getElementById("check_debit").checked = false;
				document.getElementById("check_kartu_kredit").checked = false;
				document.getElementById("check_ovo").checked = false;
				document.getElementById("check_transfer").checked = false;
				
				document.getElementById("pbyrn_deposit").style.display = "none";
				document.getElementById("ip_deposit").value = "<?php echo '0'; ?>";
				document.getElementById("pbyrn_tunai").style.display = "none";
				document.getElementById("ip_tunai").value = "<?php echo '0'; ?>";
				document.getElementById("ip_debit").value = "<?php echo '0'; ?>";
				document.getElementById("pbyrn_debit").style.display = "none";
				document.getElementById("ip_kk").value = "<?php echo '0'; ?>";
				document.getElementById("pbyrn_kartu_kredit").style.display = "none";
				document.getElementById("ip_ovo").value = "<?php echo '0'; ?>";
				document.getElementById("pbyrn_ovo").style.display = "none";
				document.getElementById("ip_transfer").value = "<?php echo '0'; ?>";
				document.getElementById("pbyrn_transfer").style.display = "none";
				
				document.getElementById("pbyrn_gopay").style.display = "block";
			}else{
				document.getElementById("ip_gopay").value = "<?php echo '0'; ?>";
				document.getElementById("pbyrn_gopay").style.display = "none";
			}
		}else if(param == '7'){
			if(document.getElementById("check_transfer").checked === true){
				document.getElementById("ip_transfer").value = "<?php echo $total_uang-$vc; ?>";
				
				document.getElementById("check_dpst").checked = false;
				document.getElementById("check_tunai").checked = false;
				document.getElementById("check_debit").checked = false;
				document.getElementById("check_kartu_kredit").checked = false;
				document.getElementById("check_ovo").checked = false;
				document.getElementById("check_gopay").checked = false;
				
				document.getElementById("pbyrn_deposit").style.display = "none";
				document.getElementById("ip_deposit").value = "<?php echo '0'; ?>";
				document.getElementById("pbyrn_tunai").style.display = "none";
				document.getElementById("ip_tunai").value = "<?php echo '0'; ?>";
				document.getElementById("ip_debit").value = "<?php echo '0'; ?>";
				document.getElementById("pbyrn_debit").style.display = "none";
				document.getElementById("ip_kk").value = "<?php echo '0'; ?>";
				document.getElementById("pbyrn_kartu_kredit").style.display = "none";
				document.getElementById("ip_ovo").value = "<?php echo '0'; ?>";
				document.getElementById("pbyrn_ovo").style.display = "none";
				document.getElementById("ip_gopay").value = "<?php echo '0'; ?>";
				document.getElementById("pbyrn_gopay").style.display = "none";
				
				document.getElementById("pbyrn_transfer").style.display = "block";
			}else{
				document.getElementById("ip_transfer").value = "<?php echo '0'; ?>";
				document.getElementById("pbyrn_transfer").style.display = "none";
			}
		}
		ip_function();
	}
	
	document.getElementById("myInput").addEventListener("click", function() {
		tbl.style.display = "block" ;
	}, false);
	
	function biaya(param){
		if(param == '1'){
			if(confirm('Apakah Anda Yakin ?')){
				var nil='0';
				if(document.getElementById("service").checked === true){
					nil='1';
				}else{
					nil='0';
				}
				$.post('<?php echo $config->base_url();?>biaya_biaya/'+<?php echo $id_trans;?>+'/'+1+'/'+nil+'.html',function(data){
					$('#dunia').html('Loading...');
					$.post('<?php echo $config->base_url();?>index_order/'+<?php echo $pilihan_meja;?>+'.html',function(data){
						$('#dunia').html(data);
					});
				});
			}else{
				if(document.getElementById("service").checked === true){
					document.getElementById("service").checked = false;
				}else{
					document.getElementById("service").checked = true;
				}
			}
		}else if(param == '2'){
			if(confirm('Apakah Anda Yakin ?')){
				var nil='0';
				if(document.getElementById("ppn").checked === true){
					nil='1';
				}else{
					nil='0';
				}
				$.post('<?php echo $config->base_url();?>biaya_biaya/'+<?php echo $id_trans;?>+'/'+2+'/'+nil+'.html',function(data){
					$('#dunia').html('Loading...');
					$.post('<?php echo $config->base_url();?>index_order/'+<?php echo $pilihan_meja;?>+'.html',function(data){
						$('#dunia').html(data);
					});
				});
			}else{
				if(document.getElementById("ppn").checked === true){
					document.getElementById("ppn").checked = false;
				}else{
					document.getElementById("ppn").checked = true;
				}
			}
		}
	}
	function myFunctionmember() {
		input = document.getElementById("member_cari").value;
		if (input.length >= 10) {
			member_cari();
			return false;
		}
		
	}
	function type_member(param){
		var asdfdsf=<?php echo $discount;?>;
		var asdfdsfa='<?php echo $id_member;?>';
		if(param == '1'){
			if(asdfdsf == '0'){
				if(asdfdsfa == '0'){
					document.getElementById("kartu_member").style.display = "none";
				}else{
					if(confirm('Apakah Anda Yakin ?')){
						// $('#dunia').html('Loading...');
						$.post('<?php echo $config->base_url();?>simpan_members/'+<?php echo $id_trans;?>+'.html',function(data){
							// $('#dunia').html('Loading...');
							$.post('<?php echo $config->base_url();?>list_transaksis/'+<?php echo $pilihan_meja;?>+'.html',function(data){
								$('#dunia').html(data);
							});
							// window.location = '<?php echo $config->base_url();?>list_transaksi/'+<?php echo $pilihan_meja;?>+'.html';
						});
						document.getElementById("kartu_member").style.display = "none";
					}else{
						document.getElementById("type_member2").checked = true;
					}
				}
				
			}else{
				if(confirm('Apakah Anda Yakin ?')){
					// $('#dunia').html('Loading...');
					$.post('<?php echo $config->base_url();?>simpan_members/'+<?php echo $id_trans;?>+'.html',function(data){
						// $('#dunia').html('Loading...');
						$.post('<?php echo $config->base_url();?>list_transaksis/'+<?php echo $pilihan_meja;?>+'.html',function(data){
							$('#dunia').html(data);
						});
							// window.location = '<?php echo $config->base_url();?>list_transaksi/'+<?php echo $pilihan_meja;?>+'.html';
					});
					document.getElementById("kartu_member").style.display = "none";
				}else{
					document.getElementById("type_member2").checked = true;
				}
			}
		}else if(param == '2'){
			document.getElementById("kartu_member").style.display = "block";
			document.getElementById("member_cari").focus();
		}
	}
	
	function member_cari(){
		var member_cari=document.getElementById("member_cari").value;
		if(member_cari===""){
		}else{
			// $('#dunia').html('Loading...');
			$.post('<?php echo $config->base_url();?>simpan_member/'+member_cari+'/'+<?php echo $id_trans;?>+'.html',function(data){
				$.post('<?php echo $config->base_url();?>list_transaksis/'+<?php echo $pilihan_meja;?>+'.html',function(data){
					$('#dunia').html(data);
				});
				// $('#dunia').html('Loading...');
							// window.location = '<?php echo $config->base_url();?>list_transaksi/'+<?php echo $pilihan_meja;?>+'.html';
			});
		}
	}
	function minus1(param){
		var chars = param.split('/');
		var nil_html = document.getElementById(chars[0]).innerHTML;
		var max = chars[1];
		var score = nil_html-1;
		
		if(nil_html == 1){
			alert('minimal data di split 1');
		}else{
			document.getElementById(chars[0]).innerHTML = ""+score;
			document.getElementById("id"+chars[0]).innerHTML = ""+score;
		}
	}
	function plus1(param){
		var chars = param.split('/');
		var nil_html = document.getElementById(chars[0]).innerHTML;
		var max = chars[1];
		var score = Number(nil_html)+1;
		
		if(nil_html == max){
			alert('maximal data di split '+max);
		}else{
			document.getElementById(chars[0]).innerHTML = ""+score;
			document.getElementById("id"+chars[0]).innerHTML = ""+score;
		}
	}
	function minus(param){
		// $('#dunia').html('Loading...');
		$.post('<?php echo $config->base_url();?>kurangi_order/'+param+'.html',function(data){
			// $('#dunia').html('Loading...');
			$.post('<?php echo $config->base_url();?>list_transaksis/'+<?php echo $pilihan_meja;?>+'.html',function(data){
				$('#dunia').html(data);
			});
		});
	}
	function plus(param){
		res = param.split("/");
		// $('#dunia').html('Loading...');
		$.post('<?php echo $config->base_url();?>tambahi_order/'+param+'.html',function(data){
			// $('#dunia').html('Loading...');
			$.post('<?php echo $config->base_url();?>list_transaksis/'+<?php echo $pilihan_meja;?>+'.html',function(data){
				$('#dunia').html(data);
			});
		});
	}
	
	function pop(){
		alert('asd');
	}
	function memilih_meja(){
		alert('milih');
	}
	function back(){
	}
	
	function klik(param){
		var res = param.split("|");
		tbl.style.display = "none" ;
		document.getElementById('myInput').value = res[0];
		document.getElementById('nm_mkanan').innerHTML = res[1];
		document.getElementById('qty_mkanan').innerHTML = 1;
		document.getElementById('hrg_mkanan').innerHTML = res[2];	
	
		// $('#dunia').html('Loading...');
		$.post('<?php echo $config->base_url();?>tambah_order/'+res[0]+'/'+<?php echo $spy; ?>+'.html',function(data){
			// $('#dunia').html('Loading...');
			$.post('<?php echo $config->base_url();?>list_transaksis/'+<?php echo $pilihan_meja;?>+'.html',function(data){
				$('#dunia').html(data);
			});
		});
	}
	
	function show_hide(){
		if(tbl.style.display === "block" ){
			tbl.style.display = "none" ;
		}else{
			// alert('a');
			document.getElementById('myInput').focus();
			tbl.style.display = "block" ;
		}
	}
	
	function myFunction() {
		var input, filter, table, tr, td, i, txtValue;
		input = document.getElementById("myInput");
		filter = input.value.toUpperCase();
		table = document.getElementById("myTable");
		tr = table.getElementsByTagName("tr");
		for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[0];
			if (td) {
				txtValue = td.textContent || td.innerText;
				if (txtValue.toUpperCase().indexOf(filter) > -1) {
					tr[i].style.display = "";
				}else{
					tr[i].style.display = "none";
				}
			}
		}       
	}
	function simpan(param){
		$.post('<?php echo $config->base_url();?>print_checker/'+param+'.html',function(data){
			$('#utk_print').html(data);
		});
	}
	function print_data(param){
		if(confirm('Apakah Anda Yakin ?')){
			open('<?php echo $config->base_url();?>print_bill_preview/'+param+'.html');
			 $.post('<?php echo $config->base_url();?>print_data/'+param+'.html',function(data){
				 $.post('<?php echo $config->base_url();?>list_transaksis/'+<?php echo $pilihan_meja;?>+'.html',function(data){
					 $('#dunia').html(data);
				 });
			 });
		}
	}

	function bayar(param){
		splt.style.display = "none" ;
		splt1.style.display = "none" ;
		ini_tambah.style.display = "none" ;
		document.getElementById("clspn").colSpan = "10";
	}
	function runScript(param) {
		var x = event.keyCode;
		if(event.keyCode == 13){
			var zzzzz = document.getElementById("qtyaa"+param).value;
			var zzzzza = param;
			if(zzzzz == ""){
				zzzzz = 0;
			}
			// alert(''+zzzzz+zzzzza);
			$.post('<?php echo $config->base_url();?>tambahi_order_rubah/'+zzzzza+'/'+zzzzz+'.html',function(data){
				$.post('<?php echo $config->base_url();?>list_transaksis/'+<?php echo $pilihan_meja;?>+'.html',function(data){
					$('#dunia').html(data);
				});
			});
			return false;
		}
	}
	function action_setiap_perintah(param){
		document.getElementById(param).select();
	}
	function discon_percent1(param) {
		var x = event.keyCode;
		if(event.keyCode == 13){
			var zzzzz = document.getElementById("discon_percent1"+param).value;
			var zzzzz1 = document.getElementById("tl_smentara"+param).innerText;
			if(zzzzz == ""){
				zzzzz = 0;
			}
			var subtotal_hitung = zzzzz1*zzzzz/100;
			document.getElementById("discon_nominal1"+param).value = subtotal_hitung;
			$.post('<?php echo $config->base_url();?>ganti_diskonts/'+param+'/'+subtotal_hitung+'.html',function(data){
				$.post('<?php echo $config->base_url();?>list_transaksis/'+<?php echo $pilihan_meja;?>+'.html',function(data){
					$('#dunia').html(data);
				});
			});
			return false;
		}
	}
	function checkall(){
		<?php
			$sql	= "
				SELECT
					transaksi_detail.id
				FROM
					`transaksi_detail`
				where
					transaksi_detail.deleted = '0' && transaksi_detail.id_trans = '$id_trans'
				order by
					transaksi_detail.id asc";
		
		$result	= $conn->query($sql);
		while($row = $result->fetch_assoc()){
			?>
			// alert(''+<?php echo $row['id'];?>);
			if(document.getElementById("checks_<?php echo $row['id'];?>").checked){
				document.getElementById("checks_<?php echo $row['id'];?>").checked = false;
			}else{
				document.getElementById("checks_<?php echo $row['id'];?>").checked = true;
			}
			<?php
		}
		?>
		
	}
	function discon_nominal1(param) {
		var x = event.keyCode;
		if(event.keyCode == 13){
			var zzzzz = document.getElementById("discon_nominal1"+param).value;
			var zzzzz1 = document.getElementById("tl_smentara"+param).innerText;
			if(zzzzz == ""){
				zzzzz = 0;
			}
			var zzzzza = param;
			var subtotal_hitung = zzzzz/(zzzzz1/100);
			document.getElementById("discon_percent1"+param).value = subtotal_hitung.toFixed(2);
			$.post('<?php echo $config->base_url();?>ganti_diskonts/'+param+'/'+zzzzz+'.html',function(data){
				$.post('<?php echo $config->base_url();?>list_transaksis/'+<?php echo $pilihan_meja;?>+'.html',function(data){
					$('#dunia').html(data);
				});
			});
			return false;
		}
	}
	function discon_percent(param) {
		var x = event.keyCode;
		if(event.keyCode == 13){
			var zzzzz = document.getElementById("discon_percent"+param).value;
			if(zzzzz == ""){
				zzzzz = 0;
			}
			var zzzzza = param;
			var subtotal_hitung = <?php echo $duid;?>*zzzzz/100;
			// alert(''+zzzzza);
			document.getElementById("discon_nominal"+param).value = subtotal_hitung;
			$.post('<?php echo $config->base_url();?>ganti_diskont/'+zzzzza+'/'+subtotal_hitung+'.html',function(data){
				$.post('<?php echo $config->base_url();?>list_transaksis/'+<?php echo $pilihan_meja;?>+'.html',function(data){
					$('#dunia').html(data);
				});
			});
			return false;
		}
	}
	function discon_nominal(param) {
		var x = event.keyCode;
		if(event.keyCode == 13){
			var zzzzz = document.getElementById("discon_nominal"+param).value;
			if(zzzzz == ""){
				zzzzz = 0;
			}
			var zzzzza = param;
			var subtotal_hitung = zzzzz/(<?php echo $duid;?>/100);
			document.getElementById("discon_percent"+param).value = subtotal_hitung.toFixed(2);
			$.post('<?php echo $config->base_url();?>ganti_diskont/'+zzzzza+'/'+zzzzz+'.html',function(data){
				$.post('<?php echo $config->base_url();?>list_transaksis/'+<?php echo $pilihan_meja;?>+'.html',function(data){
					$('#dunia').html(data);
				});
			});
			return false;
		}
	}
	function runScripts(param) {
		var x = event.keyCode;
		if(event.keyCode == 13){
			var zzzzz = document.getElementById("vcaas"+param).value;
			var zzzzza = param;
			// alert(''+zzzzz+'/'+zzzzza);
			$.post('<?php echo $config->base_url();?>ganti_voucherrr/'+zzzzza+'/'+zzzzz+'.html',function(data){
				$.post('<?php echo $config->base_url();?>list_transaksis/'+<?php echo $pilihan_meja;?>+'.html',function(data){
					$('#dunia').html(data);
				});
			});
			return false;
		}
	}
	function runScriptss(param) {
		var x = event.keyCode;
		if(event.keyCode == 13){
			var zzzzz = document.getElementById("vcaasaa"+param).value;
			var zzzzza = param;
			// alert(''+zzzzz+'/'+zzzzza);
			$.post('<?php echo $config->base_url();?>ganti_ongkir/'+zzzzza+'/'+zzzzz+'.html',function(data){
				$.post('<?php echo $config->base_url();?>list_transaksis/'+<?php echo $pilihan_meja;?>+'.html',function(data){
					$('#dunia').html(data);
				});
			});
			return false;
		}
	}
	function voidss(param){
		var id_a='';
		var id_b='';
		var vr1='';
		$('.row-select input:checked').each(function() {
			var id, name;
			id = $(this).closest('tr').find('.id').html();
			vr1 = document.getElementById("idkci"+id).value;
			document.getElementById('id'+id).innerHTML = ""+vr1;
			name = $(this).closest('tr').find('.name').html();
			if(id_a===''){
				id_a=id;
				id_b=name;
			}else{
				id_a = id_a+','+id;
				id_b = id_b+','+name;
			}
			
		})
		if(id_a === ""){
			alert('data masih kosong');
		}else{
			if(confirm('Apakah Anda Yakin ?')){
				$.post('<?php echo $config->base_url();?>void_data/'+param+'/'+id_a+'/'+id_b+'/'+<?php echo $pilihan_meja;?>+'.html',function(data){
					$.post('<?php echo $config->base_url();?>list_transaksis/'+<?php echo $pilihan_meja;?>+'.html',function(data){
						$('#dunia').html(data);
					});
				});
				// window.location = '<?php echo $config->base_url();?>split_data/'+param+'/'+id_a+'/'+id_b+'/'+<?php echo $pilihan_meja;?>+'.html';
			}
		}
	}
	function btnSubmit(param){
		var id_a='';
		var id_b='';
		var vr1='';
		$('.row-select input:checked').each(function() {
			var id, name;
			id = $(this).closest('tr').find('.id').html();
			vr1 = document.getElementById("idkci"+id).value;
			document.getElementById('id'+id).innerHTML = ""+vr1;
			// alert(''+vr1);
			name = $(this).closest('tr').find('.name').html();
			if(id_a===''){
				id_a=id;
				id_b=name;
			}else{
				id_a = id_a+','+id;
				id_b = id_b+','+name;
			}
			
		})
		// alert(''+pilihan_meja);
		if(id_a === ""){
			alert('data masih kosong');
		}else{
			if(confirm('Apakah Anda Yakin ?')){
				$.post('<?php echo $config->base_url();?>split_data/'+param+'/'+id_a+'/'+id_b+'/'+<?php echo $pilihan_meja;?>+'.html',function(data){
					$.post('<?php echo $config->base_url();?>list_transaksis/'+<?php echo $pilihan_meja;?>+'.html',function(data){
						$('#dunia').html(data);
					});
				});
			}
		}
		
	}
	function btnPindah(param){
		var id_a='';
		var vr1='';
		$('.row-select input:checked').each(function() {
			var id, name;
			id = $(this).closest('tr').find('.id').html();
			vr1 = document.getElementById("idkci"+id).value;
			document.getElementById('id'+id).innerHTML = ""+vr1;
			name = $(this).closest('tr').find('.name').html();
			if(id_a===''){
				id_a=id;
				id_b=name;
			}else{
				id_a = id_a+','+id;
				id_b = id_b+','+name;
			}
			
		})
		if(id_a === ""){
			alert('data masih kosong');
		}else{
			document.getElementById("bn_mn1").style.display = "none" ;
			document.getElementById("bn_mn2").style.display = "none" ;
			document.getElementById("bn_mn4").style.display = "none" ;
			
			document.getElementById("splt1").style.display = "none" ;
			document.getElementById("pilihan_utama").style.display = "none" ;
			document.getElementById("pilihan_utama1").style.display = "block" ;
		}
	}
	function anm(param){
		var id_a='';
		var id_b='';
		var vr1='';
		$('.row-select input:checked').each(function() {
			var id, name;
			id = $(this).closest('tr').find('.id').html();
			vr1 = document.getElementById("idkci"+id).value;
			document.getElementById('id'+id).innerHTML = ""+vr1;
			name = $(this).closest('tr').find('.name').html();
			if(id_a===''){
				id_a=id;
				id_b=name;
			}else{
				id_a = id_a+','+id;
				id_b = id_b+','+name;
			}
			
		})
		if(id_a === ""){
			alert('data masih kosong');
		}else{
			$('#duniasssss').html('Loading...');
			$.post('<?php echo $config->base_url();?>cek_trans/'+param+'/'+id_a+'/'+id_b+'.html',function(data){
				$('#duniasssss').html(data);
				
			});
			
			
		}
	}
	
	$("#ipt_txt").keyup(function(event) {
		if (event.keyCode === 13) {
			var stg_txt = document.getElementById("ipt_txt").value;
			// $('#dunia').html('Loading...');
			$.post('<?php echo $config->base_url();?>simpan_nama/'+<?php echo $trs;?>+'/'+stg_txt+'.html',function(data){
				// $('#dunia').html('Loading...');
				$.post('<?php echo $config->base_url();?>list_transaksis/'+<?php echo $pilihan_meja;?>+'.html',function(data){
					$('#dunia').html(data);
				});
				// window.location = '<?php echo $config->base_url();?>list_transaksi/'+<?php echo $pilihan_meja;?>+'.html';
			});
		}
	});
</script>

<div id="duniasssss" style="position:fixed; width:94%;margin-bottom:-17px;
   right: 0;
   bottom: 0;">
</div>
