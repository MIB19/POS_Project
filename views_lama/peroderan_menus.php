<link href="<?php echo $config->base_url();?>styles/table.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
	foreach($show_item as $row){
		$id_trans = $row['id_trans'];
		$id_member = $row['id_member'];
		$service = $row['biaya_service'];
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
	

?>
<div id="pilihan_utama" class="card_table" style="margin-left:1%;margin-right:1%;margin-top:1%;display:block;" >
	<div class="card_pilihan_meja1" style="width:170px;float:right;height:auto;background:white;border-color:white;color:black; margin-top:-22px;margin-right:-25px;">
		<a href="http://localhost/ujicoba/list_transaksi/<?php echo $pilihan_meja; ?>.html" style="z-index: 100;">
		<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;">
			<b>List Transaksi</b>
		</div>
		</a>
	</div>
	<div style="z-index: 10;  float:left;margin-top:-18px;margin-left:-10px">
		<a onClick="memilih_meja()" style="font-size:18px;float:left;">
			Meja No <?php echo $pilihan_meja; ?>
		</a>

		<br>
		<div style="font-size:8px;float:left;">29/07/2020 10:24</div>
	</div>
	<div style="width:100%; text-align: center;padding: 5px;font-size: 13px;margin-top:30px;" >
		<div style="z-index: 10;  float:left;  margin-bottom:20px;margin-top:4px;">
			<font style="float:left;margin-top:4px;">Nama :</font>
			<input type="text" id="ipt_txt" placeholder="masukkan nama" required style="float:left;width: 76%;margin-left:10px;
				height: auto;
				padding: 8px 20px;
				margin-bottom: 10px;
				display: inline-block;
				border: 1px solid #ccc;
				border-radius: 4px;
				box-sizing: border-box;
				line-height:normal;" value="<?php echo $nm; ?>" />
	
		</div>
		<div style="float:right;width:auto; ">
		<?php if($simpan == 0){ ?>
			<div class="card_pilihan_meja1" style="width:70px;float:right;height:auto;background:white;border-color:white;color:black;">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;">
					<b>Bayar</b>
				</div>
			</div>
			<div class="card_pilihan_meja1" style="width:70px;float:right;height:auto;background:white;border-color:white;color:black;">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;">
					<b>Split</b>
				</div>
			</div>
			<div class="card_pilihan_meja1" style="width:70px;float:right;height:auto;background:white;border-color:white;color:black;">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;">
					<b>Print</b>
				</div>
			</div>
			<div class="card_pilihan_meja1" style="width:70px;float:right;height:auto;background:#987860;color:white;" onClick="simpan('<?php echo $id_trans; ?>')">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;cursor:pointer;">
					<b>Simpan</b>
				</div>
			</div>
		<?php }else{ ?>
			<div class="card_pilihan_meja1" style="width:70px;float:right;height:auto;background:#987860;color:white;" id ="bn_mn1" onClick="bayar('<?php echo $id_trans; ?>')">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;cursor:pointer;">
					<b>Bayar</b>
				</div>
			</div>
			<div class="card_pilihan_meja1"style="width:70px;float:right;height:auto;background:#987860;color:white;" id ="bn_mn2" onClick="btnSubmit('<?php echo $id_trans;?>')">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;cursor:pointer;">
					
					<b>Split</b>
				</div>
			</div>
			<div class="card_pilihan_meja1"style="width:70px;float:right;height:auto;background:#987860;color:white;" id ="bn_mn3" onClick="btnPindah('<?php echo $id_trans;?>')">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;cursor:pointer;">
					
					<b>Pindah</b>
				</div>
			</div>
			<div class="card_pilihan_meja1" style="width:70px;float:right;height:auto;background:#987860;color:white;" id ="bn_mn4" onClick="print_data('<?php echo $id_trans; ?>')">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;cursor:pointer;">
					<b>Print</b>
				</div>
			</div>
			<div class="card_pilihan_meja1" id="splt1" style="width:70px;float:right;height:auto;background:white;border-color:white;color:black;">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;">
					<b>Simpan</b>
				</div>
			</div>
		<?php } ?>
			
			<div class="card_pilihan_meja1" style="width:70px;float:right;height:auto;background:#FF6347;border-color:#FF6347;color:white;">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;cursor:pointer;">
					<b>Back</b>
				</div>
			</div>
			
		</div>
		<div style="clear: both;"/>
		<div style="margin-top:-27px;float:left;text-align:left;">
			Type : 
			<input type="radio" id="type_member1" name="type_member" value="male" style="margin-left:10px;" checked="checked" onClick="type_member('1')">
			<label for="male">Non Member</label>
			<input type="radio" id="type_member2" name="type_member" value="female" style="margin-left:10px;" onClick="type_member('2')">
			<label for="female">Member</label>
		</div>
		<div style="clear: both;"/>
		<div id="kartu_member" style="font-size:14px;float:left;text-align:left;width:100%;">
			<div style="float:left;margin-top:5px;">Kartu Member : </div>
			<input type="text" name="member_cari" id="member_cari" placeholder="masukkan kode" required class="form_inputs" style="float:left">
			<div class="card_pilihan_meja1" onClick="member_cari()" style="width:30px;height:auto;background:#000000;border-color:#000000;color:white;font-size:12px;border-radius: 4px;margin-top:2px;cursor:pointer;">
				<img src="<?php echo $config->base_url();?>icon/search.png" style="height:20px;margin-top:-2px;margin-left:1px;"/>
			</div>
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
					<th>Add On</th>
					<th>Keterangan</th>
					<th>Harga</th>
					<th width=50px>QTY</th>
					<th>Discount</th>
					<th>Nominal</th>
					<th>Total Harga</th>
					<th>Jumlah Split</th>
					<th class="name" hidden>Jumlah Split</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$id = 1; 
					$duid = 0; 
					$jlh_splt=0;
					$total_uang=0;
					$asdasdasdasd=$discount;
					foreach($show_item as $row){
						$jlh_splt = $row['total'];
						if($row['dis_otmtis'] == '1'){
							$discount=$row['dis'];
						}else{
							$discount=$asdasdasdasd;
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
					<td><?php echo $row['nama'];?></td>
					<td>-</td>
					<td>-</td>
					<td>Rp <?php echo number_format($row['hrg']);?></td>
					<td>
						 <?php if($row['stat_simpan']=='0'){ ?> 
						<a onClick="minus('<?php echo $row['id'].'/'.$row['total'].'/'.$row['id_trans'];?>')" style="cursor:pointer;">
							<img src="<?php echo $config->base_url()."images/minus.png";?>" style="width:14px;margin-bottom:2px;"/> 
						</a>
						<?php echo $row['total'];?>
						<a onClick="plus('<?php echo $row['id'].'/'.$row['total'].'/'.$row['id_trans'];?>')" style="cursor:pointer;">
							<img src="<?php echo $config->base_url()."images/plus.png";?>" style="width:14px;margin-bottom:2px;"/>
						</a>
						 <?php }else{ ?>
						 <?php echo $row['total'];?>
						 <?php } ?>
						 
					</td>
					<td><?php echo $discount;?>%</td>
					<td>Rp <?php echo number_format(($row['hrg']*$row['total'])*$discount/100);?></td>
					<td>Rp <?php echo number_format(($row['hrg']*$row['total'])-(($row['hrg']*$row['total'])*$discount/100));?></td>
					<td>
						<a onClick="minus1('<?php echo $row['id'].'/'.$row['total'];?>')" style="cursor:pointer;">
							<img src="<?php echo $config->base_url()."images/minus.png";?>" style="width:14px;margin-bottom:2px;"/> 
						</a>
						<font id="<?php echo $row['id'];?>"><?php echo $jlh_splt;?></font>
						<a onClick="plus1('<?php echo $row['id'].'/'.$row['total'];?>')" style="cursor:pointer;">
							<img src="<?php echo $config->base_url()."images/plus.png";?>" style="width:14px;margin-bottom:2px;"/>
						</a>
						 
					</td>
					<td class="name" id="id<?php echo $row['id'];?>" hidden><?php echo $jlh_splt;?></td>
					<td class="check"><input type="checkbox" /></td>
				</tr>
				<?php 
					$duid = $duid+($row['hrg']*$row['total'])-(($row['hrg']*$row['total'])*$discount/100);
					$service1 = 0;$ppn1 =0;
					if($service == '1'){ $service1 = $duid*5/100; }
					if($ppn == '1'){ $ppn1 = $duid*10/100; }
					$total_uang = $duid+$service1+$ppn1;
					$id++;
				} ?>
				<tr id="ini_tambah">
					<td onClick="show_hide()">+</td>
					<td onClick="show_hide()">-</td>
					<td onClick="show_hide()">-</td>
					<td>
						<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Kode" required class="form-control" style="width:100px; text-align:center;">
					</td>
					<td id="nm_mkanan" onClick="show_hide()">-</td>
					<td onClick="show_hide()">-</td>
					<td onClick="show_hide()">-</td>
					<td id="qty_mkanan" onClick="show_hide()">-</td>
					<td id="hrg_mkanan" onClick="show_hide()">-</td>
					<td onClick="show_hide()">-</td>
					<td onClick="show_hide()">-</td>
					<td onClick="show_hide()">-</td>
					<td onClick="show_hide()">-</td>
					<td onClick="show_hide()">-</td>
				</tr>
				
				<tr>
					<td colspan=10; style="border-bottom-style: hidden;border-left-style: hidden;" id="clspn"></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;"><div style="color:red;">SUBTOTAL</div></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;">Rp <?php echo number_format($duid);?></td>
					<td colspan=2; style="border-bottom-style: hidden;border-right-style: hidden;border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;" id="clspn1"></td>
				</tr>
				<tr>
					<td colspan=10; style="border-bottom-style: hidden;border-left-style: hidden;" id="clspn"></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;"><div style="color:red;">Service</div></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;">Rp <?php echo number_format($service1);?></td>
					<td colspan=2; style="border-bottom-style: hidden;border-right-style: hidden;border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;" id="clspn1">
						<input id="service" type="checkbox" <?php if($service == "1"){ ?>checked="checked" <?php } ?> OnClick="biaya(1)" />
					</td>
				</tr>
				<tr>
					<td colspan=10; style="border-bottom-style: hidden;border-left-style: hidden;" id="clspn"></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;"><div style="color:red;">PPN</div></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;">Rp <?php echo number_format($ppn1);?></td>
					<td colspan=2; style="border-bottom-style: hidden;border-right-style: hidden;border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;" id="clspn1">
						<input id="ppn" type="checkbox" <?php if($ppn == "1"){ ?>checked="checked"<?php } ?> OnClick="biaya(2)" />
					</td>
				</tr>
				<tr>
					<td colspan=10; style="border-bottom-style: hidden;border-left-style: hidden;" id="clspn"></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;"><div style="color:red;">TOTAL</div></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;">Rp <?php echo number_format($total_uang);?></td>
					<td colspan=2; style="border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;" id="clspn1"></td>
				</tr>
				
			</tbody>
		</table>
		
		<table id="myTable" style="margin-top:-100px;margin-bottom:100px;;display:none">
			<?php 
				foreach($show_barang as $row){
			?>
			<tr>
				<td align="left" onClick="klik('<?php echo $row['kode']."|".$row['nama']."|".$row['hrg'];?>');"><?php echo '( '.$row['kode'].' ) '.$row['nama'];?></td>
			</tr>
				<?php } ?>
		</table>
		
		<div id="pbyrn" style="margin-top:-100px;margin-bottom:100px;width:100%;">
			<div style="float:left;text-align:left;font-size:16px;">
				<div style="margin-top:5px;">
					Pembayaran : <br>
					<input type="checkbox" name="pembayaran" value="male" style="margin-left:10px;" id="check_dpst" onClick="pbyrn('1')">
					<label for="male">Deposit</label>
					<input type="checkbox" name="pembayaran" value="male" style="margin-left:10px;" id="check_tunai" onClick="pbyrn('2')" checked="checked">
					<label for="male">Tunai</label>
					<input type="checkbox" name="pembayaran" value="female" style="margin-left:10px;" id="check_debit" onClick="pbyrn('3')">
					<label for="female">Debit</label>
					<input type="checkbox" name="pembayaran" value="male" style="margin-left:10px;" id="check_kartu_kredit" onClick="pbyrn('4')">
					<label for="male">Kartu Kredit</label>
					<input type="checkbox" name="pembayaran" value="female" style="margin-left:10px;" id="check_ovo" onClick="pbyrn('5')">
					<label for="female">OVO</label>
					<input type="checkbox" name="pembayaran" value="male" style="margin-left:10px;" id="check_gopay" onClick="pbyrn('6')">
					<label for="male">GoPay</label>
					<input type="checkbox" name="pembayaran" value="female" style="margin-left:10px;" id="check_transfer" onClick="pbyrn('7')">
					<label for="female">Transfer</label>
				</div>
				<div style="clear: both;"></div>
				
				<div style="width:70%;">
					<div id="pbyrn_deposit" style="display:none;">
						<font style="font-size: 12px;">Pembayaran Deposit</font><br>
						<input type="number" name="pbyrn_deposit" onkeyup="ip_function()" id="ip_deposit" placeholder="pbyrn_deposit" required class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
					</div>
					<div style="clear: both;"></div>
					<div id="pbyrn_tunai">
						<font style="font-size: 12px;">Pembayaran Tunai</font><br>
						<input type="number" name="pbyrn_tunai" onkeyup="ip_function()" placeholder="pbyrn_tunai" id="ip_tunai" required class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >

					</div>
					<div style="clear: both;"></div>
					<div id="pbyrn_debit">
						<font style="font-size: 12px;">Pembayaran Debit</font><br>
						<input type="number" name="pbyrn_debit" placeholder="pbyrn_debit" onkeyup="ip_function()" id="ip_debit" required class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
						<input type="text" name="pbyrn_debit" placeholder="Rek/Kartu/HP" id="ip_debit1" required class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
						<input type="text" name="pbyrn_debit" placeholder="EDC" required id="ip_debit2" class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
						<input type="text" name="pbyrn_debit" placeholder="Bank" required id="ip_debit3" class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
					</div>
					<div style="clear: both;"></div>
					<div id="pbyrn_kartu_kredit">
						<font style="font-size: 12px;">Pembayaran Kartu Kredit</font><br>
						<input type="number" name="pbyrn_debit" placeholder="pbyrn_debit" onkeyup="ip_function()" id="ip_kk" required class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
						<input type="text" name="pbyrn_debit" placeholder="Rek/Kartu/HP" id="ip_kk1" required class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
						<input type="text" name="pbyrn_debit" placeholder="EDC" required id="ip_kk2" class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
						<input type="text" name="pbyrn_debit" placeholder="Bank" required id="ip_kk3" class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
					</div>
					<div style="clear: both;"></div>
					<div id="pbyrn_ovo">
						<font style="font-size: 12px;">Pembayaran Ovo Debit</font><br>
						<input type="number" name="pbyrn_debit" placeholder="pbyrn_debit" onkeyup="ip_function()" id="ip_ovo" required class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
						<input type="text" name="pbyrn_debit" placeholder="Rek/Kartu/HP" required id="ip_ovo1" class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
					</div>
					<div style="clear: both;"></div>
					<div id="pbyrn_gopay">
						<font style="font-size: 12px;">Pembayaran GoPay</font><br>
						<input type="number" name="pbyrn_debit" placeholder="pbyrn_debit" onkeyup="ip_function()" id="ip_gopay" required class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
						<input type="text" name="pbyrn_debit" placeholder="Rek/Kartu/HP" required id="ip_gopay1" class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
					</div>
					<div style="clear: both;"></div>
					<div id="pbyrn_transfer">
						<font style="font-size: 12px;">Pembayaran Transfer</font><br>
						<input type="number" name="pbyrn_debit" placeholder="pbyrn_debit" onkeyup="ip_function()" id="ip_transfer" required class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
						<input type="text" name="pbyrn_debit" placeholder="Rek/Kartu/HP" required id="ip_transfer1" class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
						<input type="text" name="pbyrn_debit" placeholder="EDC" required id="ip_transfer2" class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
						<input type="text" name="pbyrn_debit" placeholder="Bank" required id="ip_transfer3" class="form_pbyrn" style="float:left;text-align:right;width:100%;" value='' >
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
<div id="duniasssss">
</div>
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
		
		<div style="margin:16px">
			<div class="card_pilihan_mejass" style="width: 11%;background:#FF6347;border-color:#FF6347;color:white;">
				<div style="margin: auto;width: 100%;margin-top: 5px; text-align: center;cursor:pointer;" onClick = "anm('100')">
					<b>Oprsnl</b>
				</div>
			</div>
		</div>
		<div style="margin:16px">
			<div class="card_pilihan_mejass" style="width: 11%;background:#FF6347;border-color:#FF6347;color:white;">
				<div style="margin: auto;width: 100%;margin-top: 5px; text-align: center;cursor:pointer;" onClick = "anm('101')">
					<b>Mrkting</b>
				</div>
			</div>
		</div>
		<div style="margin:16px">
			<div class="card_pilihan_mejass" style="width: 11%;">
				<div style="margin: auto;width: 100%;margin-top: 5px; text-align: center;cursor:pointer;"  onClick = "anm('102')">
					<b>VIP</b>
				</div>
			</div>
		</div>
		<div style="margin:16px">
			<div class="card_pilihan_mejass" style="width: 11%;">
				<div style="margin: auto;width: 100%;margin-top: 5px; text-align: center;cursor:pointer;" onClick = "anm('104')">
					<b>Meeting</b>
				</div>
			</div>
		</div>
		<?php 
			$visios = 50;
			foreach($show_ok as $rb){
				$aaaaa[$rb['oyi']] = 1;
			}
			
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
		document.getElementById("member_cari").value = ''+<?php echo $barcode;?>;
	<?php } ?>
	if (document.getElementById("type_member1").checked) {
		document.getElementById("kartu_member").style.display = "none";
	} else {
		document.getElementById("kartu_member").style.display = "block";
	}
	if(document.getElementById("check_dpst").checked === true){
		document.getElementById("pbyrn_deposit").style.display = "block";
		document.getElementById("ip_deposit").value = "<?php echo $total_uang; ?>";
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
			document.getElementById("ip_tunai").value = "<?php echo $total_uang; ?>";
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
			document.getElementById("ip_debit").value = "<?php echo $total_uang; ?>";
		}
		document.getElementById("ip_kk").value = "<?php echo '0'; ?>";
		document.getElementById("ip_ovo").value = "<?php echo '0'; ?>";
		document.getElementById("ip_gopay").value = "<?php echo '0'; ?>";
		document.getElementById("ip_transfer").value = "<?php echo '0'; ?>";
		
		document.getElementById("pbyrn_debit").style.display = "block";
	}else{
		document.getElementById("pbyrn_debit").style.display = "none";
		document.getElementById("ip_debit").value = "<?php echo '0'; ?>";
	}
	if(document.getElementById("check_kartu_kredit").checked === true){
		if(document.getElementById("check_dpst").checked === true || document.getElementById("check_tunai").checked === true || document.getElementById("check_debit").checked === true){
			document.getElementById("ip_kk").value = "<?php echo '0'; ?>";
		}else{
			document.getElementById("ip_kk").value = "<?php echo $total_uang; ?>";
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
			document.getElementById("ip_ovo").value = "<?php echo $total_uang; ?>";
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
			document.getElementById("ip_gopay").value = "<?php echo $total_uang; ?>";
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
			document.getElementById("ip_transfer").value = "<?php echo $total_uang; ?>";
		}
		
		document.getElementById("pbyrn_transfer").style.display = "block";
	}else{
		document.getElementById("pbyrn_transfer").style.display = "none";
		document.getElementById("ip_transfer").value = "<?php echo '0'; ?>";
	}
	
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
			$.post("<?php echo $config->base_url();?>bayar_sekarang.html",{
				var1: ""+a1, var2: ""+a2, var3: ""+a3, var4: ""+a4, var5: ""+a5, var6: ""+a6, var7: ""+a7,
				b1: ""+b1, c1: ""+c1, d1: ""+d1, d2: ""+d2, d3: ""+d1, d4: ""+d4, e1: ""+e1, e2: ""+e2, e3: ""+e3, e4: ""+e4,
				f1: ""+f1, f2: ""+f2, g1: ""+g1, g2: ""+g2, h1: ""+h1, h2: ""+h2, h3: ""+h3, h4: ""+h4, id_trans: ""+<?php echo $id_trans;?>,
				duid: ""+<?php echo $duid;?>, service1: ""+<?php echo $service1;?>, ppn1: ""+<?php echo $ppn1;?>, total_uang: ""+<?php echo $total_uang;?>
			}, function(data){
				window.location = '<?php echo $config->base_url();?>';
			});
		}
		
		document.getElementById("bysdfsdafasd").style.cursor = "pointer";
	<?php }else{ ?>
		document.getElementById("bysdfsdafasd").style.borderColor = "white";
		document.getElementById("bysdfsdafasd").style.background = "white";
		document.getElementById("bysdfsdafasd").style.color = "black";
		document.getElementById("bysdfsdafasd").style.cursor = "dotted";
	<?php } ?>
	
	
	ip_function();
	
	function ip_function() {
		var ttllla1 = parseInt(document.getElementById("ip_deposit").value) + parseInt(document.getElementById("ip_tunai").value) + parseInt(document.getElementById("ip_debit").value) +
		parseInt(document.getElementById("ip_kk").value) + parseInt(document.getElementById("ip_ovo").value) + parseInt(document.getElementById("ip_gopay").value) + parseInt(document.getElementById("ip_transfer").value);

		var kembalian = ttllla1 - <?php echo $total_uang;?>;
		document.getElementById("ip_ttl_pmby").value = "Rp "+new Intl.NumberFormat().format(ttllla1); 
		document.getElementById("ip_ttl_kmbali").value = "Rp "+new Intl.NumberFormat().format(kembalian); 
	}
	
	function pbyrn(param){
		if(param == '1'){
			if(document.getElementById("check_dpst").checked === true){
				document.getElementById("pbyrn_deposit").style.display = "block";
				if(document.getElementById("check_tunai").checked === true){ 
					document.getElementById("ip_tunai").value = "<?php echo '0'; ?>";
				}
				document.getElementById("ip_deposit").value = "<?php echo $total_uang; ?>";
			}else{
				if(document.getElementById("check_tunai").checked === true){ 
					document.getElementById("ip_tunai").value = "<?php echo $total_uang; ?>";
				}else{
					document.getElementById("ip_tunai").value = "<?php echo '0'; ?>";
				}
				document.getElementById("pbyrn_deposit").style.display = "none";
				document.getElementById("ip_deposit").value = "<?php echo '0'; ?>";
			}
		}else if(param == '2'){
			if(document.getElementById("check_tunai").checked === true){
				if(document.getElementById("check_dpst").checked === true){ 
					document.getElementById("ip_tunai").value = "<?php echo '0'; ?>";
				}else{
					document.getElementById("ip_tunai").value = "<?php echo $total_uang; ?>";
				}
				document.getElementById("pbyrn_tunai").style.display = "block";
			}else{
				document.getElementById("pbyrn_tunai").style.display = "none";
				document.getElementById("ip_tunai").value = "<?php echo '0'; ?>";
			}
		}else if(param == '3'){
			if(document.getElementById("check_debit").checked === true){
				if(document.getElementById("check_dpst").checked === true || document.getElementById("check_tunai").checked === true){ 
					document.getElementById("ip_debit").value = "<?php echo '0'; ?>";
				}else{
					document.getElementById("ip_debit").value = "<?php echo $total_uang; ?>";
				}
				document.getElementById("pbyrn_debit").style.display = "block";
			}else{
				document.getElementById("ip_debit").value = "<?php echo '0'; ?>";
				document.getElementById("pbyrn_debit").style.display = "none";
			}
		}else if(param == '4'){
			if(document.getElementById("check_kartu_kredit").checked === true){
				// if(document.getElementById("check_dpst").checked === true || document.getElementById("check_tunai").checked === true || document.getElementById("check_debit").checked === true){ 
					document.getElementById("ip_kk").value = "<?php echo '0'; ?>";
				// }else{
					// document.getElementById("ip_kk").value = "<?php echo $total_uang; ?>";
				// }
				document.getElementById("pbyrn_kartu_kredit").style.display = "block";
			}else{
				document.getElementById("ip_kk").value = "<?php echo '0'; ?>";
				document.getElementById("pbyrn_kartu_kredit").style.display = "none";
			}
		}else if(param == '5'){
			if(document.getElementById("check_ovo").checked === true){
				if(document.getElementById("check_dpst").checked === true || document.getElementById("check_tunai").checked === true || document.getElementById("check_debit").checked === true ||
				document.getElementById("check_kartu_kredit").checked === true){ 
					document.getElementById("ip_ovo").value = "<?php echo '0'; ?>";
				}else{
					document.getElementById("ip_ovo").value = "<?php echo $total_uang; ?>";
				}
				document.getElementById("pbyrn_ovo").style.display = "block";
			}else{
				document.getElementById("ip_ovo").value = "<?php echo '0'; ?>";
				document.getElementById("pbyrn_ovo").style.display = "none";
			}
		}else if(param == '6'){
			if(document.getElementById("check_gopay").checked === true){
				if(document.getElementById("check_dpst").checked === true || document.getElementById("check_tunai").checked === true || document.getElementById("check_debit").checked === true ||
				document.getElementById("check_kartu_kredit").checked === true || document.getElementById("check_ovo").checked === true){ 
					document.getElementById("ip_gopay").value = "<?php echo '0'; ?>";
				}else{
					document.getElementById("ip_gopay").value = "<?php echo $total_uang; ?>";
				}
				document.getElementById("pbyrn_gopay").style.display = "block";
			}else{
				document.getElementById("ip_gopay").value = "<?php echo '0'; ?>";
				document.getElementById("pbyrn_gopay").style.display = "none";
			}
		}else if(param == '7'){
			if(document.getElementById("check_transfer").checked === true){
				if(document.getElementById("check_dpst").checked === true || document.getElementById("check_tunai").checked === true || document.getElementById("check_debit").checked === true ||
				document.getElementById("check_kartu_kredit").checked === true || document.getElementById("check_ovo").checked === true || document.getElementById("check_gopay").checked === true){ 
					document.getElementById("ip_transfer").value = "<?php echo '0'; ?>";
				}else{
					document.getElementById("ip_transfer").value = "<?php echo $total_uang; ?>";
				}
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
	function type_member(param){
		var asdfdsf=<?php echo $discount;?>;
		var asdfdsfa='<?php echo $id_member;?>';
		if(param == '1'){
			if(asdfdsf == '0'){
				if(asdfdsfa == '0'){
					document.getElementById("kartu_member").style.display = "none";
				}else{
					if(confirm('Apakah Anda Yakin ?')){
						$('#dunia').html('Loading...');
						$.post('<?php echo $config->base_url();?>simpan_members/'+<?php echo $id_trans;?>+'.html',function(data){
							$('#dunia').html('Loading...');
							window.location = '<?php echo $config->base_url();?>transaksi_meja/'+<?php echo $pilihan_meja;?>+'/'+<?php echo $spy;?>+'.html';
						});
						document.getElementById("kartu_member").style.display = "none";
					}else{
						document.getElementById("type_member2").checked = true;
					}
				}
				
			}else{
				if(confirm('Apakah Anda Yakin ?')){
					$('#dunia').html('Loading...');
					$.post('<?php echo $config->base_url();?>simpan_members/'+<?php echo $id_trans;?>+'.html',function(data){
						$('#dunia').html('Loading...');
						window.location = '<?php echo $config->base_url();?>transaksi_meja/'+<?php echo $pilihan_meja;?>+'/'+<?php echo $spy;?>+'.html';
					});
					document.getElementById("kartu_member").style.display = "none";
				}else{
					document.getElementById("type_member2").checked = true;
				}
			}
		}else if(param == '2'){
			document.getElementById("kartu_member").style.display = "block";
		}
	}
	
	function member_cari(){
		var member_cari=document.getElementById("member_cari").value;
		if(member_cari===""){
		}else{
			$('#dunia').html('Loading...');
			$.post('<?php echo $config->base_url();?>simpan_member/'+member_cari+'/'+<?php echo $id_trans;?>+'.html',function(data){
				$('#dunia').html('Loading...');
				
				window.location = '<?php echo $config->base_url();?>transaksi_meja/'+<?php echo $pilihan_meja;?>+'/'+<?php echo $spy;?>+'.html';
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
		$('#dunia').html('Loading...');
		$.post('<?php echo $config->base_url();?>kurangi_order/'+param+'.html',function(data){
			$('#dunia').html('Loading...');
			window.location = '<?php echo $config->base_url();?>transaksi_meja/'+<?php echo $pilihan_meja;?>+'/'+<?php echo $spy;?>+'.html';
		});
	}
	function plus(param){
		res = param.split("/");
		$('#dunia').html('Loading...');
		$.post('<?php echo $config->base_url();?>tambahi_order/'+param+'.html',function(data){
			$('#dunia').html('Loading...');
			window.location = '<?php echo $config->base_url();?>transaksi_meja/'+<?php echo $pilihan_meja;?>+'/'+<?php echo $spy;?>+'.html';
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
	
		$('#dunia').html('Loading...');
		$.post('<?php echo $config->base_url();?>tambah_order/'+res[0]+'/'+<?php echo $spy; ?>+'.html',function(data){
			$('#dunia').html('Loading...');
			window.location = '<?php echo $config->base_url();?>transaksi_meja/'+<?php echo $pilihan_meja;?>+'/'+<?php echo $spy;?>+'.html';
		});
	}
	
	function show_hide(){
		if(tbl.style.display === "block" ){
			tbl.style.display = "none" ;
		}else{
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
		if(confirm('Apakah Anda Yakin ?')){
			$('#dunia').html('Loading...');
			$.post('<?php echo $config->base_url();?>simpan_order/'+param+'.html',function(data){
				$('#dunia').html('Loading...');
				window.location = '<?php echo $config->base_url();?>transaksi_meja/'+<?php echo $pilihan_meja;?>+'/'+<?php echo $spy;?>+'.html';

			});
		}
	}
	function print_data(param){
		if(confirm('Apakah Anda Yakin ?')){
			$('#dunia').html('Loading...');
			$.post('<?php echo $config->base_url();?>print_data/'+param+'.html',function(data){
				$('#dunia').html('Loading...');
				window.location = '<?php echo $config->base_url();?>transaksi_meja/'+<?php echo $pilihan_meja;?>+'/'+<?php echo $spy;?>+'.html';
			});
		}
	}

	function bayar(param){
		splt.style.display = "none" ;
		splt1.style.display = "none" ;
		ini_tambah.style.display = "none" ;
		document.getElementById("clspn").colSpan = "10";
	}
	function btnSubmit(param){
		var id_a='';
		var id_b='';
		$('.row-select input:checked').each(function() {
			var id, name;
			id = $(this).closest('tr').find('.id').html();
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
				window.location = '<?php echo $config->base_url();?>split_data/'+param+'/'+id_a+'/'+id_b+'/'+<?php echo $pilihan_meja;?>+'.html';
			}
		}
		
	}
	function btnPindah(param){
		var id_a='';
		$('.row-select input:checked').each(function() {
			var id, name;
			id = $(this).closest('tr').find('.id').html();
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
		$('.row-select input:checked').each(function() {
			var id, name;
			id = $(this).closest('tr').find('.id').html();
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
			$('#dunia').html('Loading...');
			$.post('<?php echo $config->base_url();?>simpan_nama/'+<?php echo $spy;?>+'/'+stg_txt+'.html',function(data){
				$('#dunia').html('Loading...');
				window.location = '<?php echo $config->base_url();?>transaksi_meja/'+<?php echo $pilihan_meja;?>+'/'+<?php echo $spy;?>+'.html';
			});
		}
	});
</script>