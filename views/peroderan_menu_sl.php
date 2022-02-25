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
	$dc_tp = '';
	$vc = '';
	foreach($show_items as $rowa){
		$vc = $rowa['voucher'];
		$ongkir = $rowa['ongkos_kirim'];
		$id_trans = $rowa['id'];
		$dc_tp = $row['discount_type'];
		$member = $rowa['id_member'];
		if($member != 0){
			$sql	= "
				SELECT
					transaksi_detail.id,
					transaksi_detail.id_trans,
					transaksi_detail.id_utm,
					transaksi_detail.id_child,
					transaksi_detail.id_item,
					transaksi.id_member,
					transaksi.nama as nm_tr,
					transaksi.biaya_ppn,
					transaksi.discount_type as dsc_tp,
					transaksi.biaya_service,
					user.barcode,
					user.deposit,
					user_category.discount,
					mkat2.dis,
					mkat2.dis_otmtis,
					mbrg.mkat2,
					mbrg.kode,
					mbrg.nama,
					transaksi_detail.harga as hrg,
					transaksi_detail.ckode,
					transaksi_detail.tambahan,
					transaksi_detail.total,
					transaksi_detail.discount_type,
					transaksi_detail.nominal,
					transaksi_detail.harga,
					transaksi_detail.catatan,
					transaksi_detail.stat_print,
					transaksi_detail.stat_simpan,
					transaksi_detail.date_add,
					transaksi_detail.keterangan,
					transaksi_detail.deleted
				FROM
					`transaksi`
				LEFT join
					transaksi_detail
				ON
					transaksi.id = transaksi_detail.id_trans
				LEFT join
					mbrg
				ON
					mbrg.kode = transaksi_detail.id_item
				LEFT join
					user
				ON
					user.id_user = transaksi.id_member
				LEFT join
					user_category
				ON
					user_category.id_category = user.id_user_category
				LEFT join
					mkat2
				ON
					mkat2.kode = mbrg.mkat2
				where
					transaksi_detail.deleted = '0' && transaksi_detail.id_trans = '$id_trans'
				order by
					transaksi_detail.id asc"; 
		}else{
			$sql	= "
				SELECT
					transaksi_detail.id,
					transaksi_detail.id_trans,
					transaksi_detail.id_utm,
					transaksi_detail.id_child,
					transaksi_detail.id_item,
					transaksi.biaya_ppn,
					transaksi.biaya_service,
					transaksi.id_member,
					transaksi.discount_type as dsc_tp,
					transaksi.nama as nm_tr,
					mkat2.dis,
					mkat2.dis_otmtis,
					mbrg.kode,
					mbrg.nama,
					transaksi_detail.harga as hrg,
					transaksi_detail.ckode,
					transaksi_detail.tambahan,
					transaksi_detail.total,
					transaksi_detail.discount_type,
					transaksi_detail.nominal,
					transaksi_detail.harga,
					transaksi_detail.catatan,
					transaksi_detail.keterangan,
					transaksi_detail.stat_print,
					transaksi_detail.stat_simpan,
					transaksi_detail.date_add,
					transaksi_detail.deleted
				FROM
					`transaksi`
				LEFT join
					transaksi_detail
				ON
					transaksi.id = transaksi_detail.id_trans
				LEFT join
					mbrg
				ON
					mbrg.kode = transaksi_detail.id_item
					
				LEFT join
					mkat2
				ON
					mkat2.kode = mbrg.mkat2
				where
					transaksi.id = '$id_trans'
				order by
					transaksi_detail.id asc";
		}
		
		$result	= $conn->query($sql);
		$record	= array();
		$print = 0;
		$simpan = 0;
		$id_member = 0;
		$barcode = 0;
		$discount = 0;
		$service = 0;
		$ppn = 0;
		$deposit = 0;
		$k = 0;
		$nm = 0;
		$date = '';
		$dtss = '';
		while($row = $result->fetch_assoc()){
			if($row['kode'] != null){
				$hid = 'ksg';
			}
			$dc_tp = $row['dsc_tp'];
			$id_member = $row['id_member'];
			$service = $row['biaya_service'];
			$ppn = $row['biaya_ppn'];
			$nm = $row['nm_tr'];
			$dtss = $row['date_add'];
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

<div id="pilihan_utama_<?php echo $id_trans;?>" class="card_table" style="margin-left:1%;margin-right:1%;margin-top:1%;display:block;" >
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
		<div style="font-size:8px;float:left;">29/07/2020 10:24</div>
	</div>
	<div style="width:100%; text-align: center;padding: 5px;font-size: 13px;margin-top:30px;" >
		<div style="z-index: 10;  float:left; margin-top:4px;" <?php if($hid == ''){ ?> hidden <?php } ?>>
			<font style="float:left;margin-top:4px;width:65px;">Nama &nbsp;&nbsp;&nbsp;&nbsp;:</font>
			<input type="text" id="ipt_txt_<?php echo $id_trans;?>" placeholder="masukkan nama" required style="float:left;width: 60%;margin-left:10px;
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
			<div class="card_pilihan_meja1" style="width:70px;float:right;height:auto;background:white;border-color:white;color:black;">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;">
					<b>Void</b>
				</div>
			</div>
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
					<b>Print</b>
				</div>
			</div>
			<div class="card_pilihan_meja1" style="width:70px;float:right;height:auto;background:#987860;color:white;" onClick="simpan<?php echo $id_trans;?>('<?php echo $id_trans; ?>')">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;cursor:pointer;">
					<b>Simpan</b>
				</div>
			</div>
		<?php }else{ ?>
			<?php if($ses[2] == 0 || $ses[2] == 1){ ?>
			<div class="card_pilihan_meja1" <?php if($ses[2] != 0){ ?> hidden <?php } ?> style="width:70px;float:right;height:auto;background:#987860;color:white;" id ="bn_mn1<?php echo $id_trans;?>" onClick="voidss<?php echo $id_trans;?>('<?php echo $id_trans; ?>')">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;cursor:pointer;">
					<b>Void</b>
				</div>
			</div>
			<div class="card_pilihan_meja1" <?php if($ses[2] == 2){ ?> hidden <?php } ?> style="width:70px;float:right;height:auto;background:#987860;color:white;" id ="bn_mn2<?php echo $id_trans;?>" onClick="btnSubmit<?php echo $id_trans;?>('<?php echo $id_trans;?>')">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;cursor:pointer;">
					
					<b>Split</b>
				</div>
			</div>
			<div class="card_pilihan_meja1" <?php if($ses[2] == 2){ ?> hidden <?php } ?> style="width:70px;float:right;height:auto;background:#987860;color:white;" id ="bn_mn3<?php echo $id_trans;?>" onClick="btnPindah<?php echo $id_trans;?>('<?php echo $id_trans;?>')">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;cursor:pointer;">
					
					<b>Pindah</b>
				</div>
			</div>
			<div class="card_pilihan_meja1" <?php if($ses[2] == 2){ ?> hidden <?php } ?> style="width:70px;float:right;height:auto;background:#987860;color:white;" id ="bn_mn4<?php echo $id_trans;?>" onClick="print_data<?php echo $id_trans;?>('<?php echo $id_trans; ?>')">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;cursor:pointer;">
					<b>Print</b>
				</div>
			</div>	
			<?php } ?>
			<div class="card_pilihan_meja1" id="splt1_<?php echo $id_trans;?>" style="width:70px;float:right;height:auto;background:white;border-color:white;color:black;">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;">
					<b>Simpan</b>
				</div>
			</div>
		<?php } ?>
			
		</div>
		<div <?php if($hid == ''){ ?> hidden <?php } ?>>
		<br>
		<br>
		</div>
		<?php
			$id_us = $id_trans;
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
		<br>
		<div style="z-index: 10;  float:left; margin-top:-30px; margin-bottom:20px;" <?php if($hid == ''){ ?> hidden <?php } ?>>
			<font style="float:left;margin-top:4px;width:65px;text-align: left;">No Trans :</font>
			<input type="text" id="ipt_txt" placeholder="masukkan nama" required style="float:left;width: 66%;margin-left:10px;
				height: auto;
				padding: 8px;
				margin-bottom: 10px;
				display: inline-block;
				border: 1px solid #ffffff;
				border-radius: 4px;
				box-sizing: border-box;
				line-height:normal;" value="<?php echo date('ym', ($dtss+18000));?><?php echo $sasa;?>" disabled/>
	
		</div>
		<div style="clear: both;"/>
		<div style="margin-top:-27px;float:left;text-align:left;" <?php if($hid == ''){ ?> hidden <?php } ?>>
			Type &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 
			<input type="radio" id="type_member1_<?php echo $id_trans;?>" name="type_member_<?php echo $id_trans;?>" value="male" style="margin-left:10px;" checked="checked" onClick="type_member<?php echo $id_trans;?>('1')">
			<label for="male">Non Member</label>
			<input type="radio" id="type_member2_<?php echo $id_trans;?>" name="type_member_<?php echo $id_trans;?>" value="female" style="margin-left:10px;" onClick="type_member<?php echo $id_trans;?>('2')">
			<label for="female">Member</label>
		</div>
		<div style="clear: both;"/>
		<div id="kartu_member_<?php echo $id_trans;?>" style="font-size:14px;float:left;text-align:left;width:100%;" <?php if($hid == ''){ ?> hidden <?php } ?>>
			<div style="float:left;margin-top:5px;">Kartu Member : </div>
			<input type="text" name="member_cari" id="member_cari_<?php echo $id_trans;?>" onkeyup="myFunctionmember<?php echo $id_trans;?>()" placeholder="masukkan kode" required class="form_inputs" style="float:left">
			<div class="card_pilihan_meja1" onClick="member_cari()" style="width:30px;height:auto;background:#000000;border-color:#000000;color:white;font-size:12px;border-radius: 4px;margin-top:2px;cursor:pointer;">
				<img src="<?php echo $config->base_url();?>icon/search.png" style="height:20px;margin-top:-2px;margin-left:1px;"/>
			</div>
			<input type="hidden" name="saldo_members" id="saldo_members_<?php echo $id_trans;?>" placeholder="saldo_members" required class="form_inputss" style="float:right;text-align:right;" value='<?php echo $deposit; ?>'>
			<input type="text" name="saldo_member" id="saldo_member_<?php echo $id_trans;?>" placeholder="saldo_member" required class="form_inputss" style="float:right;text-align:right;" value='Rp <?php echo number_format($deposit); ?>' disabled>
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
					<th><a onClick = "checkall<?php echo $id_trans;?>()" style="cursor:pointer">CheckAll</a></th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$id = 1; 
					$duid = 0; 
					$jlh_splt=0;
					$total_uang=0;
					$asdasdasdasd=$discount;
					$total_dss=0;
					$result	= $conn->query($sql);
					while($row = $result->fetch_assoc()){
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
				if($hid != ''){ ?>
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
								mbrg.nama,
								transaksi_addon.harga as hrg,
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
						<input type="text" id="kets<?php echo $row['id'];?>" onClick="action_setiap_perintah('kets<?php echo $row['id'];?>')" value="<?php echo $row['keterangan'];?>" style="width:100px; text-align: center;" onkeypress="raaaa('<?php echo $row['id'];?>')" />
					</td>
					<td><?php echo number_format($row['hrg']);?></td>
					<td>
						 <?php if($row['stat_simpan']=='0'){ ?> 
						<!--<a onClick="minus<?php echo $id_trans;?>('<?php echo $row['id'].'/'.$row['total'].'/'.$row['id_trans'];?>')" style="cursor:pointer;">
							<img src="<?php echo $config->base_url()."images/minus.png";?>" style="width:14px;margin-bottom:2px;"/> 
						</a>-->
						<input type="number" onClick="action_setiap_perintah('qtyaa<?php echo $row['id'];?>')" id="qtyaa<?php echo $row['id'];?>" value="<?php echo $row['total'];?>" style="width:100px; text-align: center;" onkeypress="runScript('<?php echo $row['id'];?>')" />
						
						<!--<a onClick="plus<?php echo $id_trans;?>('<?php echo $row['id'].'/'.$row['total'].'/'.$row['id_trans'];?>')" style="cursor:pointer;">
							<img src="<?php echo $config->base_url()."images/plus.png";?>" style="width:14px;margin-bottom:2px;"/>
						</a>-->
						 <?php }else{ ?>
						 <?php echo $row['total'];?>
						 <?php } ?>
						 
					</td>
					<td class="tl_smentara" id="tl_smentara<?php echo $row['id'];?>" hidden><?php echo $row['hrg']*$row['total']+$ttlads;?></td>
					<td>
						<?php if($pilihan_meja == '103' || $pilihan_meja == '104'){ ?>
						<input type="number" id="discon_percent1<?php echo $row['id'];?>" onClick="action_setiap_perintah('discon_percent1<?php echo $row['id'];?>')" value="<?php echo round($row['discount_type']/(($row['hrg']*$row['total']+$ttlads)/100),2);?>" style="width:40px;text-align: center; " onkeypress="discon_percent1('<?php echo $row['id'];?>')" />
						<?php }else{ echo $discount; }?>%
					</td>
					<td>
						<?php
							if($pilihan_meja == '103' || $pilihan_meja == '104'){ 
						?>
								<input type="number" id="discon_nominal1<?php echo $row['id'];?>" onClick="action_setiap_perintah('discon_nominal1<?php echo $row['id'];?>')" value="<?php echo $row['discount_type'];?>" style="width:70px;margin-left:-3px;margin-right:-3px;text-align: center; " onkeypress="discon_nominal1('<?php echo $row['id'];?>')" />
						<?php 
							}else{ 
								echo number_format((($row['hrg']*$row['total'])+$ttlads)*$discount/100); 
							} 
							$total_dss = $total_dss + number_format((($row['hrg']*$row['total'])+$ttlads)*$discount/100, 0, '', '');
						?>
					</td>
					<td><?php echo number_format((($row['hrg']*$row['total'])+$ttlads)-((($row['hrg']*$row['total'])+$ttlads)*$discount/100)-($row['discount_type']*$row['total']));?></td>
					<td>
						<?php 
							if($simpan=='1'){ ?> 
							<input type="number" id="idkci<?php echo $row['id'];?>" style="width:60px;text-align: center;" onClick="action_setiap_perintah('idkci<?php echo $row['id'];?>')" value='1'/>
							<!--<a onClick="minus1<?php echo $id_trans;?>('<?php echo $row['id'].'/'.$row['total'];?>')" style="cursor:pointer;">
								<img src="<?php echo $config->base_url()."images/minus.png";?>" style="width:14px;margin-bottom:2px;"/> 
							</a>
							<font id="<?php echo $row['id'];?>"><?php echo $jlh_splt;?></font>
							<a onClick="plus1<?php echo $id_trans;?>('<?php echo $row['id'].'/'.$row['total'];?>')" style="cursor:pointer;">
								<img src="<?php echo $config->base_url()."images/plus.png";?>" style="width:14px;margin-bottom:2px;"/>
							</a>
							-->
						<?php 
							}else{
						?>
							-
						<?php } ?>
					</td>
					<td class="name" id="id<?php echo $row['id'];?>" hidden><?php echo $jlh_splt;?></td>
					<td class="check"><?php 
						if($simpan=='1'){ ?>
							<input type="checkbox"  id = "checks_<?php echo $row['id'];?>" />
						<?php 
							}else{
						?>
							-
						<?php } ?>
					</td>
				</tr>
				<?php 
					}
					$duid = $duid+(($row['hrg']*$row['total'])+$ttlads)-((($row['hrg']*$row['total'])+$ttlads)*$discount/100)-($row['discount_type']*$row['total']);
					$service1 = 0;$ppn1 =0;
					if($service == '1'){ $service1 = ($duid-$dc_tp)*5/100; }
					if($ppn == '1'){ $ppn1 = ($duid-$dc_tp)*10/100; }
					$total_uang =$duid-$dc_tp+$service1+$ppn1+$ongkir;
					
					$total_uang = number_format($total_uang, 0, '', '');
					$id++;
				} ?>
				<tr id="ini_tambah_<?php echo $id_trans;?>">
					<td onClick="show_hide<?php echo $id_trans;?>()" style="cursor:pointer;">+</td>
					<td onClick="show_hide<?php echo $id_trans;?>()" style="cursor:pointer;">-</td>
					<td onClick="show_hide<?php echo $id_trans;?>()" style="cursor:pointer;">-</td>
					<td>
						<input type="text" id="myInput_<?php echo $id_trans;?>" onkeyup="myFunction<?php echo $id_trans;?>()" placeholder="Kode" required class="form-control" style="width:100px; text-align:center;cursor:pointer;">
					</td>
					<td id="nm_mkanan_<?php echo $id_trans;?>" onClick="show_hide<?php echo $id_trans;?>()" style="cursor:pointer;">-</td>
					<td onClick="show_hide<?php echo $id_trans;?>()" style="cursor:pointer;">-</td>
					<td onClick="show_hide<?php echo $id_trans;?>()" style="cursor:pointer;">-</td>
					<td id="qty_mkanan_<?php echo $id_trans;?>" onClick="show_hide<?php echo $id_trans;?>()" style="cursor:pointer;">-</td>
					<td id="hrg_mkanan_<?php echo $id_trans;?>" onClick="show_hide<?php echo $id_trans;?>()" style="cursor:pointer;">-</td>
					<td onClick="show_hide<?php echo $id_trans;?>()" style="cursor:pointer;">-</td>
					<td onClick="show_hide<?php echo $id_trans;?>()" style="cursor:pointer;">-</td>
					<td onClick="show_hide<?php echo $id_trans;?>()" style="cursor:pointer;">-</td>
					<td onClick="show_hide<?php echo $id_trans;?>()" style="cursor:pointer;">-</td>
					<td onClick="show_hide<?php echo $id_trans;?>()" style="cursor:pointer;">-</td>
					<td onClick="show_hide<?php echo $id_trans;?>()" style="cursor:pointer;">-</td>
				</tr>
				
				<tr>
					<td colspan=10; style="border-bottom-style: hidden;border-left-style: hidden;" id="clspn_<?php echo $id_trans;?>"></td>
					<td colspan=2; align=left style="border-bottom-style: dotted;border-left-style: dotted;"><div style="color:red;">SUBTOTAL</div></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;">Rp <?php echo number_format($duid);?></td>
					<td colspan=2; style="border-bottom-style: hidden;border-right-style: hidden;border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;" id="clspn1_<?php echo $id_trans;?>"></td>
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
						<td colspan=10; style="border-bottom-style: hidden;border-left-style: hidden;" id="clspn_<?php echo $id_trans;?>"></td>
						<td colspan=2; align=left style="border-bottom-style: dotted;border-left-style: dotted;"><div style="color:red;">Service</div></td>
						<td style="border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;">Rp <?php echo number_format($service1);?></td>
						<td colspan=2; style="border-bottom-style: hidden;border-right-style: hidden;border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;" id="clspn1_<?php echo $id_trans;?>">
							<input id="service_<?php echo $id_trans;?>" type="checkbox" <?php if($service == "1"){ ?>checked="checked" <?php } ?> OnClick="biaya<?php echo $id_trans;?>(1)" />
						</td>
					</tr>
				<?php } ?>
				<?php if($pilihan_meja != '103' && $pilihan_meja != '104'){ ?>
					<tr>
						<td colspan=10; style="border-bottom-style: hidden;border-left-style: hidden;" id="clspn_<?php echo $id_trans;?>"></td>
						<td colspan=2; align=left style="border-bottom-style: dotted;border-left-style: dotted;"><div style="color:red;">PPN</div></td>
						<td style="border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;">Rp <?php echo number_format($ppn1);?></td>
						<td colspan=2; style="border-bottom-style: hidden;border-right-style: hidden;border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;" id="clspn1_<?php echo $id_trans;?>">
							<input id="ppn_<?php echo $id_trans;?>" type="checkbox" <?php if($ppn == "1"){ ?>checked="checked"<?php } ?> OnClick="biaya<?php echo $id_trans;?>(2)" />
						</td>
					</tr>
				<?php } ?>
				
				<tr <?php if($pilihan_meja!='102'){ ?> hidden <?php } ?>>
					<td colspan=10; style="border-bottom-style: hidden;border-left-style: hidden;" id="clspn_<?php echo $id_trans;?>"></td>
					<td colspan=2; align=left style="border-bottom-style: dotted;border-left-style: dotted;"><div style="color:red;">Ongkir</div></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;">
						<input type="number" id="vcaasaa<?php echo $id_trans;?>" value="<?php echo $ongkir;?>" style="width:80px;text-align: center; " onkeypress="runScriptss('<?php echo $id_trans;?>')" />
					</td>
					<td colspan=2; style="border-bottom-style: hidden;border-right-style: hidden;border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;" id="clspn1_<?php echo $id_trans;?>">
						
					</td>
				</tr>
				<tr>
					<td colspan=10; style="border-bottom-style: hidden;border-left-style: hidden;" id="clspn_<?php echo $id_trans;?>"></td>
					<td colspan=2; align=left style="border-bottom-style: dotted;border-left-style: dotted;"><div style="color:red;">TOTAL</div></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;">Rp <?php echo number_format($total_uang);?></td>
					<td colspan=2; style="border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;" id="clspn1_<?php echo $id_trans;?>"></td>
				</tr>
				<?php if($pilihan_meja != '103' && $pilihan_meja != '104'){
						if($deposit == '0'){ ?>
					<tr>
						<td colspan=10; style="border-bottom-style: hidden;border-left-style: hidden;" id="clspn_<?php echo $id_trans;?>"></td>
						<td colspan=2; align=left align=left style="border-bottom-style: dotted;border-left-style: dotted;"><div style="color:red;">Voucher</div></td>
						<td style="border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;">
							<input type="number" id="vcaas<?php echo $id_trans;?>" value="<?php echo $vc;?>" style="width:80px;text-align: center; " onkeypress="runScripts('<?php echo $id_trans;?>')" />
						</td>
						<td colspan=2; style="border-bottom-style: hidden;border-right-style: hidden;border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;" id="clspn1_<?php echo $id_trans;?>">
							
						</td>
					</tr>
				<?php } } ?>
			</tbody>
		</table>
		
		<table id="myTable_<?php echo $id_trans;?>" <?php if($pilihan_meja == '103' || $pilihan_meja == '104'){ ?>style="margin-top:-82px;margin-bottom:100px;;display:none" <?php }else{ ?>style="margin-top:-102px;margin-bottom:100px;;display:none" <?php } ?>>
			<?php 
				foreach($show_barang as $row){
			?>
			<tr>
				<td align="left" onClick="klik<?php echo $id_trans;?>('<?php echo $row['kode']."|".$row['nama']."|".$row['hrg'];?>');" style="border-bottom: 0.1px dotted gray;cursor:pointer;" hidden><?php echo '( '.$row['kode'].' ) '.$row['nama'];?></td>
				<td align="left" onClick="klik<?php echo $id_trans;?>('<?php echo $row['kode']."|".$row['nama']."|".$row['hrg'];?>');" style="border-bottom: 0.1px dotted gray;cursor:pointer; padding-right:8px;"><?php echo $row['kode'];?></td>
				<td align="left" onClick="klik<?php echo $id_trans;?>('<?php echo $row['kode']."|".$row['nama']."|".$row['hrg'];?>');" style="border-bottom: 0.1px dotted gray;cursor:pointer;"><?php echo $row['nama'];?></td>
			</tr>
				<?php } ?>
		</table>
		
		<div id="pbyrn_<?php echo $id_trans;?>" <?php if($pilihan_meja == '103' || $pilihan_meja == '104'){ ?> style="margin-top:-80px;margin-bottom:100px;width:100%;"<?php }else{ ?> style="margin-top:-100px;margin-bottom:100px;width:100%;"<?php } ?> 
		<?php if($simpan == 0 || $ses[2] == 2){ ?> hidden <?php } ?>>
			<div style="float:left;text-align:left;font-size:16px;">
				<div style="margin-top:5px;">
					Pembayaran : <br>
					<div id="ssslole_<?php echo $id_trans;?>" style="float:left;display:none;">
						<input type="checkbox" name="pembayaran" value="male" style="margin-left:10px;" id="check_dpst_<?php echo $id_trans;?>" onClick="pbyrn<?php echo $id_trans;?>('1')">
						<label for="male">Deposit</label>
					</div>
					<div id="ssslole1_<?php echo $id_trans;?>" style="float:left;">
						<input type="checkbox" name="pembayaran" value="male" style="margin-left:10px;" id="check_tunai_<?php echo $id_trans;?>" onClick="pbyrn<?php echo $id_trans;?>('2')" checked="checked">
						<label for="male">Tunai</label>
					</div>
					<div id="ssslole2_<?php echo $id_trans;?>" style="float:left;">
						<input type="checkbox" name="pembayaran" value="female" style="margin-left:10px;" id="check_debit_<?php echo $id_trans;?>" onClick="pbyrn<?php echo $id_trans;?>('3')">
						<label for="female">Debit</label>
					</div>
					<div id="ssslole3_<?php echo $id_trans;?>" style="float:left;">
						<input type="checkbox" name="pembayaran" value="male" style="margin-left:10px;" id="check_kartu_kredit_<?php echo $id_trans;?>" onClick="pbyrn<?php echo $id_trans;?>('4')">
						<label for="male">Kartu Kredit</label>
					</div>
					<div id="ssslole4_<?php echo $id_trans;?>" style="float:left;">
						<input type="checkbox" name="pembayaran" value="female" style="margin-left:10px;" id="check_ovo_<?php echo $id_trans;?>" onClick="pbyrn<?php echo $id_trans;?>('5')">
						<label for="female">OVO</label>
					</div>
					<div id="ssslole5_<?php echo $id_trans;?>" style="float:left;">
						<input type="checkbox" name="pembayaran" value="male" style="margin-left:10px;" id="check_gopay_<?php echo $id_trans;?>" onClick="pbyrn<?php echo $id_trans;?>('6')">
						<label for="male">GoPay</label>
					</div>
					<div id="ssslole6_<?php echo $id_trans;?>" style="float:left;">
						<input type="checkbox" name="pembayaran" value="female" style="margin-left:10px;" id="check_transfer_<?php echo $id_trans;?>" onClick="pbyrn<?php echo $id_trans;?>('7')">
						<label for="female">Transfer</label>
					</div>
				</div>
				<div style="clear: both;"></div>
				
				<div style="width:70%;">
					<div id="pbyrn_deposit_<?php echo $id_trans;?>" style="display:none;">
						<font style="font-size: 12px;">Pembayaran Deposit</font><br>
						<div style = "margin-bottom:-22px;margin-left:6px; font-size:10px;color:gray;">Nominal : </div>
						<input type="number" name="pbyrn_deposit" onkeyup="ip_function<?php echo $id_trans;?>()" id="ip_deposit_<?php echo $id_trans;?>" placeholder="pbyrn_deposit" required class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
					</div>
					<div style="clear: both;"></div>
					<div id="pbyrn_tunai_<?php echo $id_trans;?>">
						<font style="font-size: 12px;">Pembayaran Tunai</font><br>
						<div style = "margin-bottom:-22px;margin-left:6px; font-size:10px;color:gray;">Nominal : </div>
						<input type="number" name="pbyrn_tunai" onkeyup="ip_function<?php echo $id_trans;?>()" placeholder="pbyrn_tunai" id="ip_tunai_<?php echo $id_trans;?>" required class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >

					</div>
					<div style="clear: both;"></div>
					<div id="pbyrn_debit_<?php echo $id_trans;?>">
						<font style="font-size: 12px;">Pembayaran Debit</font><br>
						<div style = "margin-bottom:-22px;margin-left:6px; font-size:10px;color:gray;">Nominal : </div>
						<input type="number" name="pbyrn_debit" placeholder="pbyrn_debit" onkeyup="ip_function<?php echo $id_trans;?>()" id="ip_debit_<?php echo $id_trans;?>" required class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
						<div style = "margin-bottom:-22px;margin-left:6px; font-size:10px;color:gray;">Rek/Kartu/HP : </div>
						<input type="text" name="pbyrn_debit" placeholder="" id="ip_debit1_<?php echo $id_trans;?>" required class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
						<div style = "margin-bottom:-22px;margin-left:6px; font-size:10px;color:gray;">EDC : </div>
						<select name="pbyrn_debit" id="ip_debit2_<?php echo $id_trans;?>" class="form_pbyrn" style="float:left;text-align:left;width:100%;padding-left:42px;">
							<?php foreach($show_edc as $sedc){ ?>
								<option value="<?php echo $sedc['nama'];?>"><?php echo $sedc['nama'];?></option>
							<?php } ?>
						</select>
						<div style = "margin-bottom:-22px;margin-left:6px; font-size:10px;color:gray;">Bank : </div>
						<select name="pbyrn_debit" id="ip_debit3_<?php echo $id_trans;?>" class="form_pbyrn" style="float:left;text-align:left;width:100%;padding-left:42px;">
							<?php foreach($show_bank as $sedc){ ?>
								<option value="<?php echo $sedc['nama'];?>"><?php echo $sedc['nama'];?></option>
							<?php } ?>
						</select>
					</div>
					<div style="clear: both;"></div>
					<div id="pbyrn_kartu_kredit_<?php echo $id_trans;?>">
						<font style="font-size: 12px;">Pembayaran Kartu Kredit</font><br>
						<div style = "margin-bottom:-22px;margin-left:6px; font-size:10px;color:gray;">Nominal : </div>
						<input type="number" name="pbyrn_debit" placeholder="pbyrn_debit" onkeyup="ip_function<?php echo $id_trans;?>()" id="ip_kk_<?php echo $id_trans;?>" required class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
						<div style = "margin-bottom:-22px;margin-left:6px; font-size:10px;color:gray;">Rek/Kartu/HP : </div>
						<input type="text" name="pbyrn_debit" placeholder="" id="ip_kk1_<?php echo $id_trans;?>" required class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
						<div style = "margin-bottom:-22px;margin-left:6px; font-size:10px;color:gray;">EDC : </div>
						<select name="pbyrn_debit" id="ip_kk2_<?php echo $id_trans;?>" class="form_pbyrn" style="float:left;text-align:left;width:100%;padding-left:42px;">
							<?php foreach($show_edc as $sedc){ ?>
								<option value="<?php echo $sedc['nama'];?>"><?php echo $sedc['nama'];?></option>
							<?php } ?>
						</select>
						<div style = "margin-bottom:-22px;margin-left:6px; font-size:10px;color:gray;">Bank : </div>
						<select name="pbyrn_debit" id="ip_kk3_<?php echo $id_trans;?>" class="form_pbyrn" style="float:left;text-align:left;width:100%;padding-left:42px;">
							<?php foreach($show_bank as $sedc){ ?>
								<option value="<?php echo $sedc['nama'];?>"><?php echo $sedc['nama'];?></option>
							<?php } ?>
						</select>
					</div>
					<div style="clear: both;"></div>
					<div id="pbyrn_ovo_<?php echo $id_trans;?>">
						<font style="font-size: 12px;">Pembayaran Ovo Debit</font><br>
						<div style = "margin-bottom:-22px;margin-left:6px; font-size:10px;color:gray;">Nominal : </div>
						<input type="number" name="pbyrn_debit" placeholder="pbyrn_debit" onkeyup="ip_function<?php echo $id_trans;?>()" id="ip_ovo_<?php echo $id_trans;?>" required class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
						<div style = "margin-bottom:-22px;margin-left:6px; font-size:10px;color:gray;">Rek/Kartu/HP : </div>
						<input type="text" name="pbyrn_debit" placeholder="" required id="ip_ovo1_<?php echo $id_trans;?>" class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
					</div>
					<div style="clear: both;"></div>
					<div id="pbyrn_gopay_<?php echo $id_trans;?>">
						<font style="font-size: 12px;">Pembayaran GoPay</font><br>
						<div style = "margin-bottom:-22px;margin-left:6px; font-size:10px;color:gray;">Nominal : </div>
						<input type="number" name="pbyrn_debit" placeholder="pbyrn_debit" onkeyup="ip_function<?php echo $id_trans;?>()" id="ip_gopay_<?php echo $id_trans;?>" required class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
						<div style = "margin-bottom:-22px;margin-left:6px; font-size:10px;color:gray;">Rek/Kartu/HP : </div>
						<input type="text" name="pbyrn_debit" placeholder="" required id="ip_gopay1_<?php echo $id_trans;?>" class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
					</div>
					<div style="clear: both;"></div>
					<div id="pbyrn_transfer_<?php echo $id_trans;?>">
						<font style="font-size: 12px;">Pembayaran Transfer</font><br>
						<div style = "margin-bottom:-22px;margin-left:6px; font-size:10px;color:gray;">Nominal : </div>
						<input type="number" name="pbyrn_debit" placeholder="pbyrn_debit" onkeyup="ip_function<?php echo $id_trans;?>()" id="ip_transfer_<?php echo $id_trans;?>" required class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
						<div style = "margin-bottom:-22px;margin-left:6px; font-size:10px;color:gray;">Rek/Kartu/HP : </div>
						<input type="text" name="pbyrn_debit" placeholder="" required id="ip_transfer1_<?php echo $id_trans;?>" class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
						<input type="text" name="pbyrn_debit" placeholder="EDC" required id="ip_transfer2_<?php echo $id_trans;?>" class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' hidden>
						<div style = "margin-bottom:-22px;margin-left:6px; font-size:10px;color:gray;">Bank : </div>
						<select name="pbyrn_debit" id="ip_transfer3_<?php echo $id_trans;?>" class="form_pbyrn" style="float:left;text-align:left;width:100%;padding-left:42px;">
							<?php foreach($show_bank as $sedc){ ?>
								<option value="<?php echo $sedc['nama'];?>"><?php echo $sedc['nama'];?></option>
							<?php } ?>
						</select>
					</div>
					<div style="clear: both;"></div>
					<font style="font-size: 12px;margin-left:5px;">Total Bayar</font><br>
					<input placeholder="No Trans" required class="form_pbyrn" id="ip_ttl_pmby_<?php echo $id_trans;?>" style="float:left;text-align:right;width:100%;margin-top:-22px;" value='0' disabled>
					<font style="font-size: 12px;margin-left:5px;">Kembalian</font><br>
					<input placeholder="No Trans" required class="form_pbyrn" id="ip_ttl_kmbali_<?php echo $id_trans;?>" style="float:left;text-align:right;width:100%;margin-top:-22px;" value='0' disabled>
					<div style="clear: both;"></div>
					<a onClick="bayar_sekarang<?php echo $id_trans;?>()"  id='bysdfsdafasd<?php echo $id_trans;?>' class="card_pilihan_meja1" style="width:180px;float:right;height:auto;background:#987860;border-color:#987860;color:white;padding-left:16px;">
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
<div id="pilihan_utama1_<?php echo $id_trans;?>" class="card_table" style="margin-left:1%;margin-right:1%;margin-top:1%;display:none;" >
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
	var zzzzzz= '<?php echo $spy;?>';
	<?php 
		$result	= $conn->query($sql);
		while($row = $result->fetch_assoc()){ 
	?>	
			<?php if($barcode != '0'){ ?>
				document.getElementById("check_dpst_<?php echo $id_trans;?>").checked = true;
				document.getElementById("check_tunai_<?php echo $id_trans;?>").checked = false;
				document.getElementById("type_member2_<?php echo $id_trans;?>").checked = true;
				document.getElementById("member_cari_<?php echo $id_trans;?>").value = ''+<?php echo $barcode;?>;
				document.getElementById("ssslole_<?php echo $id_trans;?>").style.display = "block";
			<?php } ?>
			
			<?php if($pilihan_meja == '103'){ ?>
				document.getElementById("check_tunai_<?php echo $id_trans;?>").checked = false;
				document.getElementById("check_ovo_<?php echo $id_trans;?>").checked = true;
				
				document.getElementById("ssslole1_<?php echo $id_trans;?>").style.display = "none";
				document.getElementById("ssslole2_<?php echo $id_trans;?>").style.display = "none";
				document.getElementById("ssslole3_<?php echo $id_trans;?>").style.display = "none";
				document.getElementById("ssslole5_<?php echo $id_trans;?>").style.display = "none";
				document.getElementById("ssslole6_<?php echo $id_trans;?>").style.display = "none";
			<?php } ?>
			<?php if($pilihan_meja == '104'){ ?>
				document.getElementById("check_tunai_<?php echo $id_trans;?>").checked = false;
				document.getElementById("check_gopay_<?php echo $id_trans;?>").checked = true;
				
				document.getElementById("ssslole1_<?php echo $id_trans;?>").style.display = "none";
				document.getElementById("ssslole2_<?php echo $id_trans;?>").style.display = "none";
				document.getElementById("ssslole3_<?php echo $id_trans;?>").style.display = "none";
				document.getElementById("ssslole4_<?php echo $id_trans;?>").style.display = "none";
				document.getElementById("ssslole6_<?php echo $id_trans;?>").style.display = "none";
			<?php } ?>
			var ini_tambah_<?php echo $id_trans;?> = document.getElementById("ini_tambah_<?php echo $id_trans;?>");
			var splt_<?php echo $id_trans;?> = document.getElementById("splt_<?php echo $id_trans;?>");
			var splt1_<?php echo $id_trans;?> = document.getElementById("splt1_<?php echo $id_trans;?>");
			var tbl_<?php echo $id_trans;?> = document.getElementById("myTable_<?php echo $id_trans;?>");
			document.getElementById("myInput_<?php echo $id_trans;?>").addEventListener("click", function() {
				tbl_<?php echo $id_trans;?>.style.display = "block" ;
			}, false);
			
			if(document.getElementById("check_dpst_<?php echo $id_trans;?>").checked === true){
				
				var zaa_<?php echo $id_trans;?> = parseInt(document.getElementById("saldo_members_<?php echo $id_trans;?>").value);
				zaa1_<?php echo $id_trans;?> = parseInt(<?php echo $total_uang-$vc; ?>); 
				tlssss_<?php echo $id_trans;?> = zaa_<?php echo $id_trans;?> - zaa1_<?php echo $id_trans;?>;
				var cuy_<?php echo $id_trans;?> = zaa1_<?php echo $id_trans;?>;
				if(tlssss_<?php echo $id_trans;?> < 0){
					cuy_<?php echo $id_trans;?> = zaa_<?php echo $id_trans;?>;
				}
				document.getElementById("ip_deposit_<?php echo $id_trans;?>").value = document.getElementById("saldo_members_<?php echo $id_trans;?>").value;
				
				document.getElementById("pbyrn_deposit_<?php echo $id_trans;?>").style.display = "block";
				document.getElementById("ip_tunai_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
				document.getElementById("ip_debit_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
				document.getElementById("ip_kk_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
				document.getElementById("ip_ovo_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
				document.getElementById("ip_gopay_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
				document.getElementById("ip_transfer_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
			}else{
				document.getElementById("pbyrn_deposit_<?php echo $id_trans;?>").style.display = "none";
				document.getElementById("ip_deposit_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
			}
			if(document.getElementById("check_tunai_<?php echo $id_trans;?>").checked === true){
				if(document.getElementById("check_dpst_<?php echo $id_trans;?>").checked === true){ 
					document.getElementById("ip_tunai_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
				}else{
					document.getElementById("ip_tunai_<?php echo $id_trans;?>").value = "<?php echo $total_uang-$vc; ?>";
				}
				document.getElementById("ip_debit_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
				document.getElementById("ip_kk_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
				document.getElementById("ip_ovo_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
				document.getElementById("ip_gopay_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
				document.getElementById("ip_transfer_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
				
				document.getElementById("pbyrn_tunai_<?php echo $id_trans;?>").style.display = "block";
			}else{
				document.getElementById("pbyrn_tunai_<?php echo $id_trans;?>").style.display = "none";
				document.getElementById("ip_tunai_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
			}
			if(document.getElementById("check_debit_<?php echo $id_trans;?>").checked === true){
				if(document.getElementById("check_dpst_<?php echo $id_trans;?>").checked === true || document.getElementById("check_tunai_<?php echo $id_trans;?>").checked === true){
					document.getElementById("ip_debit_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
				}else{
					document.getElementById("ip_debit_<?php echo $id_trans;?>").value = "<?php echo $total_uang-$vc; ?>";
				}
				// document.getElementById("ip_kk_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
				// document.getElementById("ip_ovo_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
				// document.getElementById("ip_gopay_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
				// document.getElementById("ip_transfer_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
				
				document.getElementById("pbyrn_debit_<?php echo $id_trans;?>").style.display = "block";
			}else{
				document.getElementById("pbyrn_debit_<?php echo $id_trans;?>").style.display = "none";
				document.getElementById("ip_debit_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
			}
			if(document.getElementById("check_kartu_kredit_<?php echo $id_trans;?>").checked === true){
				if(document.getElementById("check_dpst_<?php echo $id_trans;?>").checked === true || document.getElementById("check_tunai_<?php echo $id_trans;?>").checked === true || document.getElementById("check_debit_<?php echo $id_trans;?>").checked === true){
					document.getElementById("ip_kk_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
				}else{
					document.getElementById("ip_kk_<?php echo $id_trans;?>").value = "<?php echo $total_uang-$vc; ?>";
				}
				document.getElementById("ip_ovo_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
				document.getElementById("ip_gopay_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
				document.getElementById("ip_transfer_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
				
				document.getElementById("pbyrn_kartu_kredit_<?php echo $id_trans;?>").style.display = "block";
			}else{
				document.getElementById("pbyrn_kartu_kredit_<?php echo $id_trans;?>").style.display = "none";
				document.getElementById("ip_kk_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
			}
			if(document.getElementById("check_ovo_<?php echo $id_trans;?>").checked === true){
				if(document.getElementById("check_dpst_<?php echo $id_trans;?>").checked === true || document.getElementById("check_tunai_<?php echo $id_trans;?>").checked === true || document.getElementById("check_debit_<?php echo $id_trans;?>").checked === true
				|| document.getElementById("check_kartu_kredit_<?php echo $id_trans;?>").checked === true){
					document.getElementById("ip_ovo_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
				}else{
					document.getElementById("ip_ovo_<?php echo $id_trans;?>").value = "<?php echo $total_uang-$vc; ?>";
				}
				document.getElementById("ip_gopay_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
				document.getElementById("ip_transfer_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
				
				document.getElementById("pbyrn_ovo_<?php echo $id_trans;?>").style.display = "block";
			}else{
				document.getElementById("pbyrn_ovo_<?php echo $id_trans;?>").style.display = "none";
				document.getElementById("ip_ovo_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
			}
			if(document.getElementById("check_gopay_<?php echo $id_trans;?>").checked === true){
				if(document.getElementById("check_dpst_<?php echo $id_trans;?>").checked === true || document.getElementById("check_tunai_<?php echo $id_trans;?>").checked === true || document.getElementById("check_debit_<?php echo $id_trans;?>").checked === true
				|| document.getElementById("check_kartu_kredit_<?php echo $id_trans;?>").checked === true || document.getElementById("check_ovo_<?php echo $id_trans;?>").checked === true){
					document.getElementById("ip_gopay_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
				}else{
					document.getElementById("ip_gopay_<?php echo $id_trans;?>").value = "<?php echo $total_uang-$vc; ?>";
				}
				document.getElementById("ip_transfer_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
				document.getElementById("pbyrn_gopay_<?php echo $id_trans;?>").style.display = "block";
			}else{
				document.getElementById("pbyrn_gopay_<?php echo $id_trans;?>").style.display = "none";
				document.getElementById("ip_gopay_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
			}
			if(document.getElementById("check_transfer_<?php echo $id_trans;?>").checked === true){
				if(document.getElementById("check_dpst_<?php echo $id_trans;?>").checked === true || document.getElementById("check_tunai_<?php echo $id_trans;?>").checked === true || document.getElementById("check_debit_<?php echo $id_trans;?>").checked === true
				|| document.getElementById("check_kartu_kredit_<?php echo $id_trans;?>").checked === true || document.getElementById("check_ovo_<?php echo $id_trans;?>").checked === true || document.getElementById("check_gopay_<?php echo $id_trans;?>").checked === true){
					document.getElementById("ip_transfer_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
				}else{
					document.getElementById("ip_transfer_<?php echo $id_trans;?>").value = "<?php echo $total_uang-$vc; ?>";
				}
				
				document.getElementById("pbyrn_transfer_<?php echo $id_trans;?>").style.display = "block";
			}else{
				document.getElementById("pbyrn_transfer_<?php echo $id_trans;?>").style.display = "none";
				document.getElementById("ip_transfer_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
			}
			
			if (document.getElementById("type_member1_<?php echo $id_trans;?>").checked) {
				document.getElementById("kartu_member_<?php echo $id_trans;?>").style.display = "none";
			} else {
				document.getElementById("kartu_member_<?php echo $id_trans;?>").style.display = "block";
			}
			
			function show_hide<?php echo $id_trans;?>(){
				if(tbl_<?php echo $id_trans;?>.style.display === "block" ){
					tbl_<?php echo $id_trans;?>.style.display = "none" ;
				}else{
					var zxx = "myInput_"+<?php echo $id_trans;?>;
					document.getElementById(''+zxx).focus();
					tbl_<?php echo $id_trans;?>.style.display = "block" ;
				}
			}
			
			<?php if($simpan == '1'){ ?>
				function bayar_sekarang<?php echo $id_trans;?>(){
					var a1 = "0",a2 = "0",a3 = "0",a4 = "0",a5 = "0",a6 = "0",a7 = "0";
					var b1 = "0",c1 = "0",d1 = "0",d2 = "0",d3 = "0",d4 = "0",e1 = "0",e2 = "0",e3 = "0",e4 = "0";
					var f1 = "0",f2 = "0",g1 = "0",g2 = "0",h1 = "0",h2 = "0",h3 = "0",h4 = "0",id_trans = "0";
					if(document.getElementById("check_dpst_<?php echo $id_trans;?>").checked === true){
						a1 = "1";
						b1 = ""+document.getElementById("ip_deposit_<?php echo $id_trans;?>").value;
					}if(document.getElementById("check_tunai_<?php echo $id_trans;?>").checked === true){
						a2 = "1";
						c1 = ""+document.getElementById("ip_tunai_<?php echo $id_trans;?>").value;
					}if(document.getElementById("check_debit_<?php echo $id_trans;?>").checked === true){
						a3 = "1";
						d1 = document.getElementById("ip_debit_<?php echo $id_trans;?>").value;
						d2 = document.getElementById("ip_debit1_<?php echo $id_trans;?>").value;
						d3 = document.getElementById("ip_debit2_<?php echo $id_trans;?>").value;
						d4 = document.getElementById("ip_debit3_<?php echo $id_trans;?>").value;
					}if(document.getElementById("check_kartu_kredit_<?php echo $id_trans;?>").checked === true){
						a4 = "1";
						e1 = document.getElementById("ip_kk_<?php echo $id_trans;?>").value;
						e2 = document.getElementById("ip_kk1_<?php echo $id_trans;?>").value;
						e3 = document.getElementById("ip_kk2_<?php echo $id_trans;?>").value;
						e4 = document.getElementById("ip_kk3_<?php echo $id_trans;?>").value;
					}if(document.getElementById("check_ovo_<?php echo $id_trans;?>").checked === true){
						a5 = "1";
						f1 = document.getElementById("ip_ovo_<?php echo $id_trans;?>").value;
						f2 = document.getElementById("ip_ovo1_<?php echo $id_trans;?>").value;
					}if(document.getElementById("check_gopay_<?php echo $id_trans;?>").checked === true){
						a6 = "1";
						g1 = document.getElementById("ip_gopay_<?php echo $id_trans;?>").value;
						g2 = document.getElementById("ip_gopay1_<?php echo $id_trans;?>").value;
					}if(document.getElementById("check_transfer_<?php echo $id_trans;?>").checked === true){
						a7 = "1";
						h1 = document.getElementById("ip_transfer_<?php echo $id_trans;?>").value;
						h2 = document.getElementById("ip_transfer1_<?php echo $id_trans;?>").value;
						h3 = document.getElementById("ip_transfer2_<?php echo $id_trans;?>").value;
						h4 = document.getElementById("ip_transfer3_<?php echo $id_trans;?>").value;
					}
					
					var ttllla1<?php echo $id_trans;?> = parseInt(document.getElementById("ip_deposit_<?php echo $id_trans;?>").value) + parseInt(document.getElementById("ip_tunai_<?php echo $id_trans;?>").value) + parseInt(document.getElementById("ip_debit_<?php echo $id_trans;?>").value) +
					parseInt(document.getElementById("ip_kk_<?php echo $id_trans;?>").value) + parseInt(document.getElementById("ip_ovo_<?php echo $id_trans;?>").value) + parseInt(document.getElementById("ip_gopay_<?php echo $id_trans;?>").value) + parseInt(document.getElementById("ip_transfer_<?php echo $id_trans;?>").value);

					var kembalian<?php echo $id_trans;?> = ttllla1<?php echo $id_trans;?> - <?php echo $total_uang-$vc;?>;
					
					if(kembalian<?php echo $id_trans;?> < 0){
						alert('uang kurang'+kembalian<?php echo $id_trans;?>);
					}else{
						a11 = a1+'*'+a2+'*'+a3+'*'+a4+'*'+a5+'*'+a6+'*'+a7;
						a12 = b1+'*'+c1+'*'+d1+'*'+e1+'*'+f1+'*'+g1+'*'+h1;
						open('<?php echo $config->base_url();?>print_bill/'+<?php echo $id_trans;?>+'/'+kembalian<?php echo $id_trans;?>+'/'+a11+'/'+a12+'/<?php echo $total_dss;?>.html');
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
				
				document.getElementById("bysdfsdafasd<?php echo $id_trans;?>").style.cursor = "pointer";
			<?php }else{ ?>
				document.getElementById("bysdfsdafasd<?php echo $id_trans;?>").style.borderColor = "white";
				document.getElementById("bysdfsdafasd<?php echo $id_trans;?>").style.background = "white";
				document.getElementById("bysdfsdafasd<?php echo $id_trans;?>").style.color = "black";
				document.getElementById("bysdfsdafasd<?php echo $id_trans;?>").style.cursor = "dotted";
			<?php } ?>
			
			function bayar(param){
				splt_<?php echo $id_trans;?>.style.display = "none" ;
				splt1_<?php echo $id_trans;?>.style.display = "none" ;
				ini_tambah_<?php echo $id_trans;?>.style.display = "none" ;
				document.getElementById("clspn_<?php echo $id_trans;?>").colSpan = "10";
			}
			function simpan<?php echo $id_trans;?>(param){
				$.post('<?php echo $config->base_url();?>print_checker/'+param+'.html',function(data){
					$('#utk_print').html(data);
				});
				// open('<?php echo $config->base_url();?>print_checker/'+param+'.html');
				// setTimeout( function(){ 	
					// $.post('<?php echo $config->base_url();?>simpan_order/'+param+'.html',function(data){
						// $.post('<?php echo $config->base_url();?>list_transaksis/'+<?php echo $pilihan_meja;?>+'.html',function(data){
							// $('#dunia').html(data);
						// });
					// });
				// }  , 2000 );
			}
			function anm(param){
				// alert(''+param);
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
					// $('#duniasssss_<?php echo $id_trans;?>').html('Loading...');
					$.post('<?php echo $config->base_url();?>cek_trans/'+param+'/'+id_a+'/'+id_b+'.html',function(data){
						$('#duniasssss_<?php echo $id_trans;?>').html(data);
						
					});
					
					
				}
			}
			function btnPindah<?php echo $id_trans;?>(param){
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
					document.getElementById("bn_mn1<?php echo $id_trans;?>").style.display = "none" ;
					document.getElementById("bn_mn2<?php echo $id_trans;?>").style.display = "none" ;
					document.getElementById("bn_mn4<?php echo $id_trans;?>").style.display = "none" ;
					
					document.getElementById("splt1_<?php echo $id_trans;?>").style.display = "none" ;
					document.getElementById("pilihan_utama_<?php echo $id_trans;?>").style.display = "none" ;
					// alert(''+<?php echo $id_trans;?>);
					document.getElementById("pilihan_utama1_<?php echo $id_trans;?>").style.display = "block" ;
				}
			}
			
			function voidss<?php echo $id_trans;?>(param){
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
			function btnSubmit<?php echo $id_trans;?>(param){
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
						// $('#dunia').html('Loading...');
						$.post('<?php echo $config->base_url();?>split_data/'+param+'/'+id_a+'/'+id_b+'/'+<?php echo $pilihan_meja;?>+'.html',function(data){
							$.post('<?php echo $config->base_url();?>list_transaksis/'+<?php echo $pilihan_meja;?>+'.html',function(data){
								$('#dunia').html(data);
							});
						});
					}
				}
				
			}
			function print_data<?php echo $id_trans;?>(param){
				if(confirm('Apakah Anda Yakin ?')){
					$('#dunia').html('Loading...');
					$.post('<?php echo $config->base_url();?>print_data/'+param+'.html',function(data){
						$.post('<?php echo $config->base_url();?>list_transaksis/'+<?php echo $pilihan_meja;?>+'.html',function(data){
							$('#dunia').html(data);
						});
					});
				}
			}
			function type_member<?php echo $id_trans;?>(param){
				var asdfdsf=<?php echo $discount;?>;
				var asdfdsfa='<?php echo $id_member;?>';
				
				if(param == '1'){
					if(asdfdsf == '0'){
						if(asdfdsfa == '0'){
							document.getElementById("kartu_member_<?php echo $id_trans;?>").style.display = "none";
						}else{
							if(confirm('Apakah Anda Yakin ?')){
								// $('#dunia').html('Loading...');
								$.post('<?php echo $config->base_url();?>simpan_members/'+<?php echo $id_trans;?>+'.html',function(data){
									// $('#dunia').html('Loading...');
									window.location = '<?php echo $config->base_url();?>transaksi_meja/'+<?php echo $pilihan_meja;?>+'/'+zzzzzz+'.html';
								});
								document.getElementById("kartu_member_<?php echo $id_trans;?>").style.display = "none";
							}else{
								document.getElementById("type_member2_<?php echo $id_trans;?>").checked = true;
							}
						}
						
					}else{
						if(confirm('Apakah Anda Yakin ?')){
							// $('#dunia').html('Loading...');
							$.post('<?php echo $config->base_url();?>simpan_members/'+<?php echo $id_trans;?>+'.html',function(data){
								// $('#dunia').html('Loading...');
								window.location = '<?php echo $config->base_url();?>transaksi_meja/'+<?php echo $pilihan_meja;?>+'/'+zzzzzz+'.html';
							});
							document.getElementById("kartu_member_<?php echo $id_trans;?>").style.display = "none";
						}else{
							document.getElementById("type_member2_<?php echo $id_trans;?>").checked = true;
						}
					}
				}else if(param == '2'){
					document.getElementById("kartu_member_<?php echo $id_trans;?>").style.display = "block";
					document.getElementById("member_cari_<?php echo $id_trans;?>").focus();
				}
			}
			function add_onss(param) {
				var x = document.getElementById("popup");
				x.style.visibility = "visible" ;
				$.post('<?php echo $config->base_url();?>add_onss/'+param+'/'+<?php echo $pilihan_meja;?>+'.html',function(data){
					$('#testerasdasd').html(data);
				});
			}
			function klik<?php echo $id_trans;?>(param){
				var res = param.split("|");
				tbl_<?php echo $id_trans;?>.style.display = "none" ;
				document.getElementById('myInput_<?php echo $id_trans;?>').value = res[0];
				document.getElementById('nm_mkanan_<?php echo $id_trans;?>').innerHTML = res[1];
				document.getElementById('qty_mkanan_<?php echo $id_trans;?>').innerHTML = 1;
				document.getElementById('hrg_mkanan_<?php echo $id_trans;?>').innerHTML = res[2];	
			
				// $('#dunia').html('Loading...');
				$.post('<?php echo $config->base_url();?>tambah_order/'+res[0]+'/'+<?php echo $id_trans;?>+'.html',function(data){
					$.post('<?php echo $config->base_url();?>list_transaksis/'+<?php echo $pilihan_meja;?>+'.html',function(data){
						$('#dunia').html(data);
					});
				});
			}
			function raaaa(param) {
				var x = event.keyCode;
				if(event.keyCode == 13){
					var zzzzz = document.getElementById("kets"+param).value;
					var zzzzza = param;
					if(zzzzz == ""){
						zzzzz = '-';
					}
					// alert(''+zzzzz+'/'+zzzzza);
					$.post('<?php echo $config->base_url();?>ganti_keterangan/'+zzzzza+'/'+zzzzz+'.html',function(data){
						$.post('<?php echo $config->base_url();?>list_transaksis/'+<?php echo $pilihan_meja;?>+'.html',function(data){
							$('#dunia').html(data);
						});
					});
					return false;
				}
			}
			function minus<?php echo $id_trans;?>(param){
				// $('#dunia').html('Loading...');
				$.post('<?php echo $config->base_url();?>kurangi_order/'+param+'.html',function(data){
					// $('#dunia').html('Loading...');
					$.post('<?php echo $config->base_url();?>list_transaksis/'+<?php echo $pilihan_meja;?>+'.html',function(data){
						$('#dunia').html(data);
					});
				});
			}
			function plus<?php echo $id_trans;?>(param){
				res = param.split("/");
				// $('#dunia').html('Loading...');
				$.post('<?php echo $config->base_url();?>tambahi_order/'+param+'.html',function(data){
					// $('#dunia').html('Loading...');
					$.post('<?php echo $config->base_url();?>list_transaksis/'+<?php echo $pilihan_meja;?>+'.html',function(data){
						$('#dunia').html(data);
					});
				});
			}
			function myFunction<?php echo $id_trans;?>() {
				var input, filter, table, tr, td, i, txtValue;
				input = document.getElementById("myInput_<?php echo $id_trans;?>");
				filter = input.value.toUpperCase();
				table = document.getElementById("myTable_<?php echo $id_trans;?>");
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
			function minus1<?php echo $id_trans;?>(param){
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
			function plus1<?php echo $id_trans;?>(param){
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
			function runScript(param) {
				var x = event.keyCode;
				if(event.keyCode == 13){
					var zzzzz = document.getElementById("qtyaa"+param).value;
					var zzzzza = param;
					
					if(zzzzz == ""){
						zzzzz = 0;
					}
					
					$.post('<?php echo $config->base_url();?>tambahi_order_rubah/'+zzzzza+'/'+zzzzz+'.html',function(data){
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
			function checkall<?php echo $id_trans;?>(){
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
			function anm(param){
				// alert(''+param);
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
					// $('#duniasssss').html('Loading...');
					$.post('<?php echo $config->base_url();?>cek_trans/'+param+'/'+id_a+'/'+id_b+'.html',function(data){
						$('#duniasssss').html(data);
						
					});
					
					
				}
			}
			
			function pbyrn<?php echo $id_trans;?>(param){
				if(param == '1'){
					if(document.getElementById("check_tunai_<?php echo $id_trans;?>").checked === true && document.getElementById("check_debit_<?php echo $id_trans;?>").checked === true){ 
						document.getElementById("check_dpst_<?php echo $id_trans;?>").checked = false;
						alert('pembayaran tidak boleh lebih dari 2');
					}else{
						if(document.getElementById("check_dpst_<?php echo $id_trans;?>").checked === true){
							document.getElementById("pbyrn_deposit_<?php echo $id_trans;?>").style.display = "block";
							if(document.getElementById("check_tunai_<?php echo $id_trans;?>").checked === true){ 
								document.getElementById("ip_tunai_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
							}
							var zaa_<?php echo $id_trans;?> = parseInt(document.getElementById("saldo_members_<?php echo $id_trans;?>").value); 
							// alert(''+zaa);
							zaa1_<?php echo $id_trans;?> = parseInt(<?php echo $total_uang-$vc; ?>); 
							tlssss_<?php echo $id_trans;?> = zaa_<?php echo $id_trans;?> - zaa1_<?php echo $id_trans;?>;
							var cuy_<?php echo $id_trans;?> = zaa1_<?php echo $id_trans;?>;
							if(tlssss_<?php echo $id_trans;?> < 0){
								cuy_<?php echo $id_trans;?> = zaa_<?php echo $id_trans;?>;
							}
							document.getElementById("ip_deposit_<?php echo $id_trans;?>").value = cuy_<?php echo $id_trans;?>;
							
							document.getElementById("check_kartu_kredit_<?php echo $id_trans;?>").checked = false;
							document.getElementById("check_ovo_<?php echo $id_trans;?>").checked = false;
							document.getElementById("check_gopay_<?php echo $id_trans;?>").checked = false;
							document.getElementById("check_transfer_<?php echo $id_trans;?>").checked = false;
							
							document.getElementById("ip_kk_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
							document.getElementById("pbyrn_kartu_kredit_<?php echo $id_trans;?>").style.display = "none";
							document.getElementById("ip_ovo_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
							document.getElementById("pbyrn_ovo_<?php echo $id_trans;?>").style.display = "none";
							document.getElementById("ip_gopay_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
							document.getElementById("pbyrn_gopay_<?php echo $id_trans;?>").style.display = "none";
							document.getElementById("ip_transfer_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
							document.getElementById("pbyrn_transfer_<?php echo $id_trans;?>").style.display = "none";
						}else{
							if(document.getElementById("check_tunai_<?php echo $id_trans;?>").checked === true){ 
								document.getElementById("ip_tunai_<?php echo $id_trans;?>").value = "<?php echo $total_uang-$vc; ?>";
							}else{
								document.getElementById("ip_tunai_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
							}
							document.getElementById("pbyrn_deposit_<?php echo $id_trans;?>").style.display = "none";
							document.getElementById("ip_deposit_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
						}
					}
				}else if(param == '2'){
					if(document.getElementById("check_dpst_<?php echo $id_trans;?>").checked === true && document.getElementById("check_debit_<?php echo $id_trans;?>").checked === true){ 
						document.getElementById("check_tunai_<?php echo $id_trans;?>").checked = false;
						alert('pembayaran tidak boleh lebih dari 2');
					}else{
						if(document.getElementById("check_tunai_<?php echo $id_trans;?>").checked === true){
							if(document.getElementById("check_dpst_<?php echo $id_trans;?>").checked === true){ 
								document.getElementById("ip_tunai_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
							}else{
								document.getElementById("ip_tunai_<?php echo $id_trans;?>").value = "<?php echo $total_uang-$vc; ?>";
							}
							
							document.getElementById("check_kartu_kredit_<?php echo $id_trans;?>").checked = false;
							document.getElementById("check_ovo_<?php echo $id_trans;?>").checked = false;
							document.getElementById("check_gopay_<?php echo $id_trans;?>").checked = false;
							document.getElementById("check_transfer_<?php echo $id_trans;?>").checked = false;
							
							document.getElementById("ip_kk_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
							document.getElementById("pbyrn_kartu_kredit_<?php echo $id_trans;?>").style.display = "none";
							document.getElementById("ip_ovo_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
							document.getElementById("pbyrn_ovo_<?php echo $id_trans;?>").style.display = "none";
							document.getElementById("ip_gopay_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
							document.getElementById("pbyrn_gopay_<?php echo $id_trans;?>").style.display = "none";
							document.getElementById("ip_transfer_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
							document.getElementById("pbyrn_transfer_<?php echo $id_trans;?>").style.display = "none";
							
							document.getElementById("pbyrn_tunai_<?php echo $id_trans;?>").style.display = "block";
						}else{
							document.getElementById("pbyrn_tunai_<?php echo $id_trans;?>").style.display = "none";
							document.getElementById("ip_tunai_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
						}
					}
				}else if(param == '3'){
					if(document.getElementById("check_dpst_<?php echo $id_trans;?>").checked === true && document.getElementById("check_tunai_<?php echo $id_trans;?>").checked === true){ 
						document.getElementById("check_debit_<?php echo $id_trans;?>").checked = false;
						alert('pembayaran tidak boleh lebih dari 2');
					}else{
						if(document.getElementById("check_debit_<?php echo $id_trans;?>").checked === true){
							if(document.getElementById("check_dpst_<?php echo $id_trans;?>").checked === true || document.getElementById("check_tunai_<?php echo $id_trans;?>").checked === true){ 
								document.getElementById("ip_debit_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
							}else{
								document.getElementById("ip_debit_<?php echo $id_trans;?>").value = "<?php echo $total_uang-$vc; ?>";
							}
							
							document.getElementById("check_kartu_kredit_<?php echo $id_trans;?>").checked = false;
							document.getElementById("check_ovo_<?php echo $id_trans;?>").checked = false;
							document.getElementById("check_gopay_<?php echo $id_trans;?>").checked = false;
							document.getElementById("check_transfer_<?php echo $id_trans;?>").checked = false;
							
							document.getElementById("ip_kk_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
							document.getElementById("pbyrn_kartu_kredit_<?php echo $id_trans;?>").style.display = "none";
							document.getElementById("ip_ovo_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
							document.getElementById("pbyrn_ovo_<?php echo $id_trans;?>").style.display = "none";
							document.getElementById("ip_gopay_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
							document.getElementById("pbyrn_gopay_<?php echo $id_trans;?>").style.display = "none";
							document.getElementById("ip_transfer_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
							document.getElementById("pbyrn_transfer_<?php echo $id_trans;?>").style.display = "none";
							
							document.getElementById("pbyrn_debit_<?php echo $id_trans;?>").style.display = "block";
						}else{
							document.getElementById("ip_debit_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
							document.getElementById("pbyrn_debit_<?php echo $id_trans;?>").style.display = "none";
						}
					}
				}else if(param == '4'){
					if(document.getElementById("check_kartu_kredit_<?php echo $id_trans;?>").checked === true){
						document.getElementById("ip_kk_<?php echo $id_trans;?>").value = "<?php echo $total_uang-$vc; ?>";

						document.getElementById("check_dpst_<?php echo $id_trans;?>").checked = false;
						document.getElementById("check_tunai_<?php echo $id_trans;?>").checked = false;
						document.getElementById("check_debit_<?php echo $id_trans;?>").checked = false;
						document.getElementById("check_ovo_<?php echo $id_trans;?>").checked = false;
						document.getElementById("check_gopay_<?php echo $id_trans;?>").checked = false;
						document.getElementById("check_transfer_<?php echo $id_trans;?>").checked = false;
						
						document.getElementById("pbyrn_deposit_<?php echo $id_trans;?>").style.display = "none";
						document.getElementById("ip_deposit_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
						document.getElementById("pbyrn_tunai_<?php echo $id_trans;?>").style.display = "none";
						document.getElementById("ip_tunai_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
						document.getElementById("ip_debit_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
						document.getElementById("pbyrn_debit_<?php echo $id_trans;?>").style.display = "none";
						document.getElementById("ip_ovo_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
						document.getElementById("pbyrn_ovo_<?php echo $id_trans;?>").style.display = "none";
						document.getElementById("ip_gopay_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
						document.getElementById("pbyrn_gopay_<?php echo $id_trans;?>").style.display = "none";
						document.getElementById("ip_transfer_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
						document.getElementById("pbyrn_transfer_<?php echo $id_trans;?>").style.display = "none";
						
						document.getElementById("pbyrn_kartu_kredit_<?php echo $id_trans;?>").style.display = "block";
					}else{
						document.getElementById("ip_kk_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
						document.getElementById("pbyrn_kartu_kredit_<?php echo $id_trans;?>").style.display = "none";
					}
				}else if(param == '5'){
					if(document.getElementById("check_ovo_<?php echo $id_trans;?>").checked === true){
						document.getElementById("ip_ovo_<?php echo $id_trans;?>").value = "<?php echo $total_uang-$vc; ?>";
						
						document.getElementById("check_dpst_<?php echo $id_trans;?>").checked = false;
						document.getElementById("check_tunai_<?php echo $id_trans;?>").checked = false;
						document.getElementById("check_debit_<?php echo $id_trans;?>").checked = false;
						document.getElementById("check_kartu_kredit_<?php echo $id_trans;?>").checked = false;
						document.getElementById("check_gopay_<?php echo $id_trans;?>").checked = false;
						document.getElementById("check_transfer_<?php echo $id_trans;?>").checked = false;
						
						document.getElementById("pbyrn_deposit_<?php echo $id_trans;?>").style.display = "none";
						document.getElementById("ip_deposit_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
						document.getElementById("pbyrn_tunai_<?php echo $id_trans;?>").style.display = "none";
						document.getElementById("ip_tunai_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
						document.getElementById("ip_debit_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
						document.getElementById("pbyrn_debit_<?php echo $id_trans;?>").style.display = "none";
						document.getElementById("ip_kk_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
						document.getElementById("pbyrn_kartu_kredit_<?php echo $id_trans;?>").style.display = "none";
						document.getElementById("ip_gopay_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
						document.getElementById("pbyrn_gopay_<?php echo $id_trans;?>").style.display = "none";
						document.getElementById("ip_transfer_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
						document.getElementById("pbyrn_transfer_<?php echo $id_trans;?>").style.display = "none";
						
						document.getElementById("pbyrn_ovo_<?php echo $id_trans;?>").style.display = "block";
					}else{
						document.getElementById("ip_ovo_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
						document.getElementById("pbyrn_ovo_<?php echo $id_trans;?>").style.display = "none";
					}
				}else if(param == '6'){
					if(document.getElementById("check_gopay_<?php echo $id_trans;?>").checked === true){
						document.getElementById("ip_gopay_<?php echo $id_trans;?>").value = "<?php echo $total_uang-$vc; ?>";
						
						document.getElementById("check_dpst_<?php echo $id_trans;?>").checked = false;
						document.getElementById("check_tunai_<?php echo $id_trans;?>").checked = false;
						document.getElementById("check_debit_<?php echo $id_trans;?>").checked = false;
						document.getElementById("check_kartu_kredit_<?php echo $id_trans;?>").checked = false;
						document.getElementById("check_ovo_<?php echo $id_trans;?>").checked = false;
						document.getElementById("check_transfer_<?php echo $id_trans;?>").checked = false;
						
						document.getElementById("pbyrn_deposit_<?php echo $id_trans;?>").style.display = "none";
						document.getElementById("ip_deposit_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
						document.getElementById("pbyrn_tunai_<?php echo $id_trans;?>").style.display = "none";
						document.getElementById("ip_tunai_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
						document.getElementById("ip_debit_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
						document.getElementById("pbyrn_debit_<?php echo $id_trans;?>").style.display = "none";
						document.getElementById("ip_kk_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
						document.getElementById("pbyrn_kartu_kredit_<?php echo $id_trans;?>").style.display = "none";
						document.getElementById("ip_ovo_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
						document.getElementById("pbyrn_ovo_<?php echo $id_trans;?>").style.display = "none";
						document.getElementById("ip_transfer_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
						document.getElementById("pbyrn_transfer_<?php echo $id_trans;?>").style.display = "none";
						
						document.getElementById("pbyrn_gopay_<?php echo $id_trans;?>").style.display = "block";
					}else{
						document.getElementById("ip_gopay_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
						document.getElementById("pbyrn_gopay_<?php echo $id_trans;?>").style.display = "none";
					}
				}else if(param == '7'){
					if(document.getElementById("check_transfer_<?php echo $id_trans;?>").checked === true){
						document.getElementById("ip_transfer_<?php echo $id_trans;?>").value = "<?php echo $total_uang-$vc; ?>";
						
						document.getElementById("check_dpst_<?php echo $id_trans;?>").checked = false;
						document.getElementById("check_tunai_<?php echo $id_trans;?>").checked = false;
						document.getElementById("check_debit_<?php echo $id_trans;?>").checked = false;
						document.getElementById("check_kartu_kredit_<?php echo $id_trans;?>").checked = false;
						document.getElementById("check_ovo_<?php echo $id_trans;?>").checked = false;
						document.getElementById("check_gopay_<?php echo $id_trans;?>").checked = false;
						
						document.getElementById("pbyrn_deposit_<?php echo $id_trans;?>").style.display = "none";
						document.getElementById("ip_deposit_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
						document.getElementById("pbyrn_tunai_<?php echo $id_trans;?>").style.display = "none";
						document.getElementById("ip_tunai_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
						document.getElementById("ip_debit_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
						document.getElementById("pbyrn_debit_<?php echo $id_trans;?>").style.display = "none";
						document.getElementById("ip_kk_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
						document.getElementById("pbyrn_kartu_kredit_<?php echo $id_trans;?>").style.display = "none";
						document.getElementById("ip_ovo_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
						document.getElementById("pbyrn_ovo_<?php echo $id_trans;?>").style.display = "none";
						document.getElementById("ip_gopay_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
						document.getElementById("pbyrn_gopay_<?php echo $id_trans;?>").style.display = "none";
						
						document.getElementById("pbyrn_transfer_<?php echo $id_trans;?>").style.display = "block";
					}else{
						document.getElementById("ip_transfer_<?php echo $id_trans;?>").value = "<?php echo '0'; ?>";
						document.getElementById("pbyrn_transfer_<?php echo $id_trans;?>").style.display = "none";
					}
				}
				 ip_function<?php echo $id_trans;?>();
			}
			ip_function<?php echo $id_trans;?>();
	
			function ip_function<?php echo $id_trans;?>() {
				if(document.getElementById("ip_deposit_<?php echo $id_trans;?>").value == ''){
					document.getElementById("ip_deposit_<?php echo $id_trans;?>").value = '0';
				}if(document.getElementById("ip_tunai_<?php echo $id_trans;?>").value == ''){
					document.getElementById("ip_tunai_<?php echo $id_trans;?>").value = '0';
				}if(document.getElementById("ip_debit_<?php echo $id_trans;?>").value == ''){
					document.getElementById("ip_debit_<?php echo $id_trans;?>").value = '0';
				}if(document.getElementById("ip_kk_<?php echo $id_trans;?>").value == ''){
					document.getElementById("ip_kk_<?php echo $id_trans;?>").value = '0';
				}if(document.getElementById("ip_ovo_<?php echo $id_trans;?>").value == ''){
					document.getElementById("ip_ovo_<?php echo $id_trans;?>").value = '0';
				}if(document.getElementById("ip_gopay_<?php echo $id_trans;?>").value == ''){
					document.getElementById("ip_gopay_<?php echo $id_trans;?>").value = '0';
				}if(document.getElementById("ip_transfer_<?php echo $id_trans;?>").value == ''){
					document.getElementById("ip_transfer_<?php echo $id_trans;?>").value = '0';
				}
				
				var ttllla1<?php echo $id_trans;?> = parseInt(document.getElementById("ip_deposit_<?php echo $id_trans;?>").value) + parseInt(document.getElementById("ip_tunai_<?php echo $id_trans;?>").value) + parseInt(document.getElementById("ip_debit_<?php echo $id_trans;?>").value) +
				parseInt(document.getElementById("ip_kk_<?php echo $id_trans;?>").value) + parseInt(document.getElementById("ip_ovo_<?php echo $id_trans;?>").value) + parseInt(document.getElementById("ip_gopay_<?php echo $id_trans;?>").value) + parseInt(document.getElementById("ip_transfer_<?php echo $id_trans;?>").value);

				var kembalian<?php echo $id_trans;?> = ttllla1<?php echo $id_trans;?> - <?php echo $total_uang-$vc;?>;
				document.getElementById("ip_ttl_pmby_<?php echo $id_trans;?>").value = ""+new Intl.NumberFormat().format(ttllla1<?php echo $id_trans;?>); 
				document.getElementById("ip_ttl_kmbali_<?php echo $id_trans;?>").value = ""+new Intl.NumberFormat().format(kembalian<?php echo $id_trans;?>); 
			}
			function myFunctionmember<?php echo $id_trans;?>() {
				input_<?php echo $id_trans;?> = document.getElementById("member_cari_<?php echo $id_trans;?>").value;
				if (input_<?php echo $id_trans;?>.length >= 10) {
					member_cari<?php echo $id_trans;?>();
					return false;
				}
				
			}
			function member_cari<?php echo $id_trans;?>(){
				// alert('a');
				var member_cari=document.getElementById("member_cari_<?php echo $id_trans;?>").value;
				if(member_cari===""){
				}else{
					// $('#dunia').html('Loading...');
					$.post('<?php echo $config->base_url();?>simpan_member/'+member_cari+'/'+<?php echo $id_trans;?>+'.html',function(data){
						// $('#dunia').html('Loading...');
						$.post('<?php echo $config->base_url();?>list_transaksis/'+<?php echo $pilihan_meja;?>+'.html',function(data){
							$('#dunia').html(data);
						});
					});
				}
			}
			function action_setiap_perintah(param){
				document.getElementById(param).select();
			}
			function biaya<?php echo $id_trans;?>(param){
				if(param == '1'){
					if(confirm('Apakah Anda Yakin ?')){
						var nil='0';
						if(document.getElementById("service_<?php echo $id_trans;?>").checked === true){
							nil='1';
						}else{
							nil='0';
						}
						$.post('<?php echo $config->base_url();?>biaya_biaya/'+<?php echo $id_trans;?>+'/'+1+'/'+nil+'.html',function(data){
							// $('#dunia').html('Loading...');
							$.post('<?php echo $config->base_url();?>list_transaksis/'+<?php echo $pilihan_meja;?>+'.html',function(data){
								$('#dunia').html(data);
							});
						});
					}else{
						if(document.getElementById("service_<?php echo $id_trans;?>").checked === true){
							document.getElementById("service_<?php echo $id_trans;?>").checked = false;
						}else{
							document.getElementById("service_<?php echo $id_trans;?>").checked = true;
						}
					}
				}else if(param == '2'){
					if(confirm('Apakah Anda Yakin ?')){
						var nil='0';
						if(document.getElementById("ppn_<?php echo $id_trans;?>").checked === true){
							nil='1';
						}else{
							nil='0';
						}
						$.post('<?php echo $config->base_url();?>biaya_biaya/'+<?php echo $id_trans;?>+'/'+2+'/'+nil+'.html',function(data){
							// $('#dunia').html('Loading...');
							$.post('<?php echo $config->base_url();?>list_transaksis/'+<?php echo $pilihan_meja;?>+'.html',function(data){
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
	<?php 
		}
	?>
</script>
<?php
	}
?>
<div id="duniasssss" style="position:fixed; width:94%;margin-bottom:-17px;
   right: 0;
   bottom: 0;">
</div>