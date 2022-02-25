<style type="text/css" media="print">
    @page {
        size: auto;
        margin: 0mm;
    }
</style>
<style>
	.print_layar{
		width:240px;
		height:500px;
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
		margin-bottom:12px;
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
		$sql	= "
			SELECT 
				transaksi.id as id_tr,
				transaksi.voucher,
				transaksi.no_meja,
				transaksi.date_add,
				transaksi.biaya_ppn,
				transaksi.nama as name_member,
				transaksi.biaya_service,
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
		$recsaas = $result1->fetch_assoc();
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
			BILL
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
			:  <?php $mj = $recsaas['no_meja'];
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
		<div id="text_print_biasa">
			<?php echo date('d-m-Y', $recsaas['date_add']);?>
		</div>
		<div id="garis_print">
			=======================================
		</div>
		
		<?php
			$tl = 0;
			while($rec = $result->fetch_assoc()){
				
				// if($rec['dis_otmtis']=='1'){
				// }else{
					// $ds1 = $rec['dis'];
				// }
				
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
					$dsk = 0;
					$dsk = ($rec['harga']+$tlss)*$ds1/100;
		?>
		<div style="float:left;width:100%;font-size:10px;margin-top:-2px;margin-bottom:1px;"><?php echo $rec['nama'].$nms."";?></div>
		<div style="float:left;text-align:left;width:20%;font-size:10px;margin-left:5%;"><?php echo ($rec['total']);?> X</div>
		<div style="float:left;text-align:right;width:37%;font-size:10px;"><?php echo number_format(($rec['harga']+$tlss)-($rec['dsc']));?></div>
		<div style="float:left;text-align:right;width:37%;font-size:10px;"><?php echo number_format((($rec['harga']+$tlss)*$rec['total'])-($rec['dsc']*$rec['total']));?></div>
		
		<?php
				$tl = $tl + number_format((($rec['harga']+$tlss)*$rec['total']), 0, '', '');
				// $tl = $tl + number_format((($rec['harga']+$tlss-$dsk)*$rec['total']-($rec['dsc']*$rec['total'])), 0, '', '');
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
				$ppn = ($tl-($ds+$_REQUEST['param5']))*10/100;
			}
			if($recsaas['biaya_service']==1){
				$service = ($tl-$ds-$_REQUEST['param5'])*5/100;
			}
			$prmm3 = $_REQUEST['param3'];
			$prmm4 = $_REQUEST['param4'];
			$prmm31 = explode("*", $prmm3);
			$prmm41 = explode("*", $prmm4);
		?>
		<div style="float:left;text-align:left;width:30%;font-size:10px;">DISCOUNT</div>
		<div style="float:left;text-align:right;width:25%;font-size:10px;"><?php echo number_format($ds+$_REQUEST['param5']);?></div>
		<div style="float:left;text-align:left;width:40%;font-size:10px;margin-left:5%;"> &nbsp;</div>
		<div style="float:left;text-align:left;width:30%;font-size:10px;">SERVICE</div>
		<div style="float:left;text-align:right;width:25%;font-size:10px;"><?php echo number_format($service);?></div>
		<div style="float:left;text-align:left;width:40%;font-size:10px;margin-left:5%;"> &nbsp;</div>
		<div style="float:left;text-align:left;width:30%;font-size:10px;">PPN</div>
		<div style="float:left;text-align:right;width:25%;font-size:10px;"><?php echo number_format($ppn);?></div>
		<div style="float:left;text-align:left;width:40%;font-size:10px;margin-left:5%;"> &nbsp;</div>
		<div style="float:left;text-align:left;width:30%;font-size:10px;">TOTAL</div>
		<div style="float:left;text-align:right;width:25%;font-size:10px;"><?php echo number_format(($tl-$ds)+$ppn+$service-$_REQUEST['param5']);?></div>
		<div style="float:left;text-align:left;width:40%;font-size:10px;margin-left:5%;"> &nbsp;</div>
		<div style="float:left;text-align:left;width:30%;font-size:10px;">VOUCHER</div>
		<div style="float:left;text-align:right;width:25%;font-size:10px;"><?php echo number_format($recsaas['voucher']);?></div>
		<?php if($prmm31[0] == 1){ ?>
			<div style="float:left;text-align:left;width:40%;font-size:10px;margin-left:5%;"> &nbsp;</div>
			<div style="float:left;text-align:left;width:30%;font-size:10px;">DEPOSIT</div>
			<div style="float:left;text-align:right;width:25%;font-size:10px;"><?php echo number_format($prmm41[0]);?></div>
		<?php } ?>
		<?php if($prmm31[1] == 1){ ?>
			<div style="float:left;text-align:left;width:40%;font-size:10px;margin-left:5%;"> &nbsp;</div>
			<div style="float:left;text-align:left;width:30%;font-size:10px;">TUNAI</div>
			<div style="float:left;text-align:right;width:25%;font-size:10px;"><?php echo number_format($prmm41[1]);?></div>
		<?php } ?>
		<?php if($prmm31[2] == 1){ ?>
			<div style="float:left;text-align:left;width:40%;font-size:10px;margin-left:5%;"> &nbsp;</div>
			<div style="float:left;text-align:left;width:30%;font-size:10px;">DEBIT</div>
			<div style="float:left;text-align:right;width:25%;font-size:10px;"><?php echo number_format($prmm41[2]);?></div>
		<?php } ?>
		<?php if($prmm31[3] == 1){ ?>
			<div style="float:left;text-align:left;width:40%;font-size:10px;margin-left:5%;"> &nbsp;</div>
			<div style="float:left;text-align:left;width:30%;font-size:10px;">K.KREDIT</div>
			<div style="float:left;text-align:right;width:25%;font-size:10px;"><?php echo number_format($prmm41[3]);?></div>
		<?php } ?>
		<?php if($prmm31[4] == 1){ ?>
			<div style="float:left;text-align:left;width:40%;font-size:10px;margin-left:5%;"> &nbsp;</div>
			<div style="float:left;text-align:left;width:30%;font-size:10px;">OVO</div>
			<div style="float:left;text-align:right;width:25%;font-size:10px;"><?php echo number_format($prmm41[4]);?></div>
		<?php } ?>
		<?php if($prmm31[5] == 1){ ?>
			<div style="float:left;text-align:left;width:40%;font-size:10px;margin-left:5%;"> &nbsp;</div>
			<div style="float:left;text-align:left;width:30%;font-size:10px;">GOPAY</div>
			<div style="float:left;text-align:right;width:25%;font-size:10px;"><?php echo number_format($prmm41[5]);?></div>
		<?php } ?>
		<?php if($prmm31[6] == 1){ ?>
			<div style="float:left;text-align:left;width:40%;font-size:10px;margin-left:5%;"> &nbsp;</div>
			<div style="float:left;text-align:left;width:30%;font-size:10px;">TRANSFER</div>
			<div style="float:left;text-align:right;width:25%;font-size:10px;"><?php echo number_format($prmm41[6]);?></div>
		<?php } ?>
		<?php if($prmm31[1] == 1){ ?>
			<div style="float:left;text-align:left;width:40%;font-size:10px;margin-left:5%;"> &nbsp;</div>
			<div style="float:left;text-align:left;width:30%;font-size:10px;">Kembali</div>
			<div style="float:left;text-align:right;width:25%;font-size:10px;"><?php echo number_format($_REQUEST['param2']);?></div>
		<?php } ?>
		<div style="height:25px;">&nbsp;</div>
		<br>
		&nbsp;
		<div style="text-align:center;font-size:10px;"><b>CLOSED BILL</b></div>
		<div style="text-align:center;font-size:10px;"><b>THANK YOU</b></div>
		<div style="text-align:center;font-size:10px;"><b>PLEASE COME AGAIN</b></div>
		<div style="height:25px;">&nbsp;</div>
		<div style="height:25px;"></div>
	</div>
	<div class="w3-clear"></div>
	
	<script type="text/javascript">
		<?php 
			// $a= 'RUNDLL32 PRINTUI.DLL,PrintUIEntry /y /n "EPSON B"';
			// $a= 'RUNDLL32 PRINTUI.DLL,PrintUIEntry /y /n "Fax"';
			// system($a);
			$b = 'RUNDLL32 PRINTUI.DLL,PrintUIEntry /y /n "EPSON A"';
			//system($b);
		?>
		window.onload=function(){ 
			//window.print();
			// window.close();
			// open('http://localhost/print_cb/index_print2.php');
		}
	</script>
</body>