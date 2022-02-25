<style type="text/css" media="print">
    @page {
        size: auto;
        margin: 0mm;
    }
</style>
<style>
	.print_layar{
		width:240px;
		height:auto;
		margin-left:8px;
		margin-right:8px;
	}
		
	.print_layar #text_print{
		color:black;
		margin-top:1px;
		font-size:12px;
		text-align:center;
	}
	.print_layar #text_judul_print{
		color:black;
		margin-top:8px;
		margin-bottom:5px;
		font-size:14px;
		font-weight:bold;
		text-align:left;
	}
	.print_layar #text_judul_print_bill{
		color:black;
		margin-top:8px;
		margin-bottom:5px;
		font-size:14px;
		font-weight:bold;
		text-align:center;
	}
	.print_layar #text_deskripsi_print_left{
		color:black;
		width:32%;
		font-size:11px;
		text-align:left;
		float:left;
	}
	.print_layar #text_deskripsi_print_right{
		color:black;
		width:68%;
		font-size:11px;
		text-align:left;
		float:right;
	}
	.print_layar #text_deskripsi_uang_print_left{
		color:black;
		width:42%;
		font-size:11px;
		text-align:left;
		float:left;
	}
	.print_layar #text_deskripsi_uang_print_right{
		color:black;
		width:58%;
		font-size:11px;
		text-align:left;
		float:right;
	}
	.print_layar #text_print_biasa{
		color:black;
		font-size:11px;
		text-align:left;
	}
	.print_layar #garis_print{
		color:black;
		font-size:11px;
		text-align:center;
		margin-bottom:6px;
	}
	.print_layar #garis_printbwh{
		font-size:11px;
		text-align:center;
		margin-top:38px;
		margin-bottom:15px;
	}
	.print_layar #garis_printbwh_bill{
		font-size:11px;
		text-align:center;
		margin-top:38px;
		margin-bottom:15px;
		margin-bottom:-2px;
	}
</style>
<body>
	<?php 
		$pilihan_meja = 0;
		$sql	= "
			SELECT 
				transaksi.id as id_tr,
				transaksi.no_meja,
				transaksi.date_add,
				transaksi.biaya_ppn,
				transaksi.biaya_service,
				transaksi.nama as name_member,
				muser.ckode,
				transaksi_detail.id,
				transaksi_detail.harga,
				transaksi_detail.total,
				transaksi.id_member,
				transaksi.discount_type,
				transaksi_detail.discount_type as dsc,
				transaksi_detail.id_item,
				user.id_user_category,
				user_category.discount,
				mbrg.nama,
				mkat2.dis_otmtis,
				mkat2.dis
			FROM 
				`transaksi_detail`
			inner join
				`transaksi`
			on
				transaksi.id = transaksi_detail.id_trans
			inner join
				`mbrg`
			on
				mbrg.kode = transaksi_detail.id_item
			inner join
				`muser`
			on
				muser.no = transaksi_detail.id_user
			left join
				`user`
			on
				user.id_user = transaksi.id_member
			left join
				`user_category`
			on
				user_category.id_category = user.id_user_category
			inner join
				`mkat2`
			on
				mkat2.kode = mbrg.mkat2
			WHERE 
				transaksi_detail.id_trans = '$id' && transaksi_detail.deleted = '0'
			order by transaksi_detail.id asc";
			

		$result1	= $conn->query($sql);
		$result	= $conn->query($sql);
		$record	= array();
		$spy = "";
		$no = 1;
		$ds1 = 0;
		$ttlds = 0;
		$recsaas = $result1->fetch_assoc();
		$pilihan_meja = $recsaas['no_meja'];
		if($recsaas['discount']!=null){
			$ds1 = $recsaas['discount'];
		}
	?>
	<div class="print_layar">
		<img src="<?php echo $config->base_url();?>images/cilik.png" style="height:28px;display: block; margin-left: auto;margin-right: auto;"/>
		<div id="text_print">
			Raya Kupang Indah 51 - Surabaya<br>
			0821-33593698
		</div>

		<div id="text_judul_print_bill">
			BILL PREVIEW
		</div>
		<?php
			$id_us = $recsaas['id_tr'];
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
		<div id="text_deskripsi_print_left">
			INVOICE
		</div>
		<div id="text_deskripsi_print_right">
			: <?php echo date('ym', $recsaas['date_add']).$sasa;?>
		</div>
		<div id="text_deskripsi_print_left">
			TABLE
		</div>
		<div id="text_deskripsi_print_right">
			: <?php $mj = $recsaas['no_meja'];
			if($recsaas['no_meja'] == '101'){
				$mj = "VIP";
			}else if($recsaas['no_meja'] == '102'){
				$mj = "Delivery";
			}else if($recsaas['no_meja'] == '103'){
				$mj = "Grab";
			}else if($recsaas['no_meja'] == '104'){
				$mj = "Gojek";
			}else if($recsaas['no_meja'] == '105'){
				$mj = "Marketing";
			}else if($recsaas['no_meja'] == '106'){
				$mj = "Operasional";
			}else if($recsaas['no_meja'] == '107'){
				$mj = "Owner";
			}else if($recsaas['no_meja'] == '0'){
				$mj = "Meeting";
			}
			
			echo $mj;?>
		</div>
		<?php if($recsaas['name_member'] != '' || $recsaas['name_member'] != null){ ?>
		<div id="text_deskripsi_print_left">
			NAME
		</div>
		<div id="text_deskripsi_print_right">
			: <?php echo $recsaas['name_member'];?>
		</div>
		<?php } ?>
		<div style="clear: left;"></div>
		<div id="text_print_biasa">
			<?php// echo date('d-m-Y', ($recsaas['date_add']+18000));?>
		</div>
		<div id="garis_print">
			=======================================
		</div>
		
		<?php
			$tl = 0;
			while($rec = $result->fetch_assoc()){
					
				$id_add = $rec['id'];
				$sqls	= "
					SELECT 
						transaksi_addon.nama,
						transaksi_addon.harga,
						transaksi_addon.total
					FROM 
						`transaksi_addon`
					WHERE 
						transaksi_addon.id_transaksi_detail = '$id_add' && transaksi_addon.deleted = '0'
					order by transaksi_addon.id asc";
					

				$results	= $conn->query($sqls);
				$nms = '';
				$tlss = 0;
				while($recs = $results->fetch_assoc()){
					if($nms == ''){
						$nms = $nms.$recs['nama'];
					}else{
						$nms = $nms.', '.$recs['nama'];
					}
					$tlss = $tlss+($recs['total']*$recs['harga']);
				}
				if($nms != ''){
					$nms = ' ( '.$nms.' )';
				}
				
				if($pilihan_meja == 105 || $pilihan_meja == 106){
					if($rec['dis_otmtis']==1){
						$ds2 = $rec['dis'];
					}else{
						$ds2 = 50;
					}
				}else{
					if($rec['dis_otmtis']==1){
						$ds2 = $rec['dis'];
					}else{
						$ds2 = $ds1;
					}		
				}
								
				
				$dsk = 0;
				$dsk = (($rec['harga']+$tlss)*$ds2/100)*$rec['total'];
				$ttlds = $ttlds+$dsk; 
		?>
		<div style="float:left;width:100%;font-size:10px;margin-top:-2px;margin-bottom:1px;"><?php echo $rec['nama'].$nms."";?></div>
		<div style="float:left;text-align:left;width:20%;font-size:10px;margin-left:5%;"><?php echo ($rec['total']);?> X</div>
		<div style="float:left;text-align:right;width:37%;font-size:10px;"><?php echo number_format(($rec['harga']+$tlss)-($rec['dsc']));?></div>
		<div style="float:left;text-align:right;width:37%;font-size:10px;"><?php echo number_format((($rec['harga']+$tlss)*$rec['total'])-($rec['dsc']*$rec['total']));?></div>
		
		<?php
				$tl = $tl + number_format((($rec['harga']+$tlss)*$rec['total']-($rec['dsc']*$rec['total'])), 0, '', '');
			}
		?>
		
		<div id="garis_printbwh_bill">
			=======================================
		</div>
		<div style="float:left;text-align:left;width:40%;font-size:10px;margin-left:5%;"> &nbsp;</div>
		<div style="float:left;text-align:left;width:30%;font-size:10px;">SUBTOTAL</div>
		<div style="float:left;text-align:right;width:25%;font-size:10px;"><?php echo number_format($tl);?></div>
		<div style="float:left;text-align:left;width:40%;font-size:10px;margin-left:5%;"> &nbsp;</div>
		<?php 			
			if($recsaas['discount_type']!=null){
				$ds = $recsaas['discount_type'];
			}
			$ppn = 0;
			$service = 0;
			if($recsaas['biaya_ppn']==1){
				$ppn = ($tl-$ds-$ttlds)*10/100;
			}
			if($recsaas['biaya_service']==1){
				$service = ($tl-$ds-$ttlds)*5/100;
			}
		?>
		<div style="float:left;text-align:left;width:30%;font-size:10px;">DISCOUNT</div>
		<div style="float:left;text-align:right;width:25%;font-size:10px;"><?php echo number_format($ds+$ttlds);?></div>
		<div style="float:left;text-align:left;width:40%;font-size:10px;margin-left:5%;"> &nbsp;</div>
		<div style="float:left;text-align:left;width:30%;font-size:10px;">SERVICE</div>
		<div style="float:left;text-align:right;width:25%;font-size:10px;"><?php echo number_format($service);?></div>
		<div style="float:left;text-align:left;width:40%;font-size:10px;margin-left:5%;"> &nbsp;</div>
		<div style="float:left;text-align:left;width:30%;font-size:10px;">PPN</div>
		<div style="float:left;text-align:right;width:25%;font-size:10px;"><?php echo number_format($ppn);?></div>
		<div style="float:left;text-align:left;width:40%;font-size:10px;margin-left:5%;"> &nbsp;</div>
		<div style="float:left;text-align:left;width:30%;font-size:10px;">TOTAL</div>
		<div style="float:left;text-align:right;width:25%;font-size:10px;"><?php echo number_format(($tl-$ds)+$ppn+$service-$ttlds);?></div>
		

		<div style="float:left;font-size:10px;margin-top:8px;"><?php echo date('d-m-Y H:i:s', ($recsaas['date_add']+18000));?></div>
		<div style="height:25px;">&nbsp;</div>
		<div style="height:25px;"></div>
	</div>
	<div class="w3-clear"></div>
	
	<script type="text/javascript">
		<?php 
			$b = 'RUNDLL32 PRINTUI.DLL,PrintUIEntry /y /n "EPSON A"';
			//system($b);
		?>
		// var mywindow = window.open('', 'PRINT', 'height=auto,width=280');

		// mywindow.document.write('<html><head><title>' + document.title  + '</title>');
		// mywindow.document.write('</head><body >');
		// mywindow.document.write(document.getElementById('utk_print').innerHTML);
		// mywindow.document.close();
		// mywindow.focus();

		//mywindow.print();
		//mywindow.close();
		//$('#utk_print').html("");
		//$.post('<?php echo $config->base_url();?>print_data/<?php echo $id;?>.html',function(data){
		//	$.post('<?php echo $config->base_url();?>list_transaksis/<?php echo $pilihan_meja;?>.html',function(data){
		//		$('#dunia').html(data);
		//	});
		//});
	</script>