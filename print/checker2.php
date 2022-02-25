<?php 
	$dtprit = 'RUNDLL32 PRINTUI.DLL,PrintUIEntry /y /n "EPSON B"';
	// $b = $dtprit;
	system($dtprit);
?>
<style>
  @media print { @page { margin: 0; } 
   body { margin: 0.2cm; } }
</style>
<style>
	.print_layar{
		width:240px;
		height:auto;
		margin-left:8px;
		margin-right:8px;
		font-weight:bold;
	}
		
	.print_layar #text_print{
		color:black;
		margin-top:1px;
		font-size:13px;
		text-align:center;
		font-weight:bold;
	}
	.print_layar #text_judul_print_checker{
		color:black;
		margin-top:8px;
		margin-bottom:5px;
		font-size:15px;
		font-weight:bold;
		text-align:center;
		font-weight:bold;
	}
	.print_layar #text_judul_print_bawah_checker{
		color:black;
		margin-top:8px;
		margin-bottom:5px;
		font-size:15px;
		font-weight:bold;
		text-align:left;
		font-weight:bold;
	}
	.print_layar #text_judul_print{
		color:black;
		margin-top:8px;
		margin-bottom:5px;
		font-size:15px;
		font-weight:bold;
		text-align:left;
		font-weight:bold;
	}
	.print_layar #text_deskripsi_print_left{
		color:black;
		width:32%;
		font-size:13px;
		text-align:left;
		float:left;
		font-weight:bold;
	}
	.print_layar #text_deskripsi_print_right{
		color:black;
		width:68%;
		font-size:13px;
		text-align:left;
		float:right;
		font-weight:bold;
	}
	.print_layar #text_deskripsi_uang_print_left{
		color:black;
		width:42%;
		font-size:13px;
		text-align:left;
		float:left;
		font-weight:bold;
	}
	.print_layar #text_deskripsi_uang_print_right{
		color:black;
		width:58%;
		font-size:13px;
		text-align:left;
		float:right;
		font-weight:bold;
	}
	.print_layar #text_print_biasa{
		color:black;
		font-size:13px;
		text-align:left;
		font-weight:bold;
	}
	.print_layar #garis_print{
		color:black;
		font-size:13px;
		text-align:center;
		margin-bottom:6px;
		font-weight:bold;
	}
	.print_layar #garis_printbwh{
		font-size:13px;
		text-align:center;
		margin-top:38px;
		margin-bottom:15px;
		font-weight:bold;
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
				muser.ckode,
				transaksi_detail.id,
				transaksi_detail.total,
				transaksi_detail.id_item,
				transaksi_detail.keterangan,
				mkat2.kode,
				mbrg.nama
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
			inner join
				`mkat2`
			on
				mkat2.kode = mbrg.mkat2
			WHERE 
				transaksi_detail.stat_simpan = '0' && transaksi_detail.id_trans = '$id' && transaksi_detail.deleted = '0'
			order by transaksi_detail.id asc";
			

		$result1	= $conn->query($sql);
		$result	= $conn->query($sql);
		$record	= array();
		$spy = "";
		$no = 1;
		$recsaas = $result1->fetch_assoc();
		
		$pilihan_meja = $recsaas['no_meja'];
		?>
	
	<div class="print_layar">
		<div id="text_judul_print_checker">
			MASTER CHECKER
		</div>

		<div id="text_deskripsi_print_left">
			ORDER
		</div>
		<div id="text_deskripsi_print_right">
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
			: <?php echo date('ym', $recsaas['date_add']).$sasa;?>
		</div>
		<div id="text_deskripsi_print_left">
			TABLE
		</div>
		<div id="text_deskripsi_print_right">
			: <?php echo $recsaas['no_meja'];?>
		</div>
		<br>
		<br>
		<div id="text_print_biasa">
			<div style="float:left;width:140px;"><?php echo date('d-m-Y', $recsaas['date_add']);?></div>
			<div style="float:left;">ID : <?php echo $recsaas['ckode']?></div>
		</div>
		<div id="garis_print">
			=======================================
		</div>
		<div style="float:left;width:15%;font-size:11px;margin-top:-8px;">QTY</div>
		<div style="float:left;width:85%;font-size:11px;margin-top:-8px;">KETERANGAN</div>
			 
		<div id="garis_print">
			=======================================
		</div>
		<?php
			while($rec = $result->fetch_assoc()){
		?>
				<div style="float:left;width:15%;font-size:10px;margin-top:-2px;font-size:15px;"><?php echo $rec['total'];?> X</div>
				<div style="float:left;width:85%;font-size:10px;margin-top:-2px;font-size:15px;"><?php echo $rec['nama'];?></div>
				
		<?php
				$asdadsad = $rec['id_item'];
				if($rec['kode'] == 'PK'){
					$sqls	= "
						SELECT 
							tbarang_paket.id,
							tbarang_paket.mkat2,
							mkat2.mprint,
							tbarang_paket.ckode,
							tbarang_paket.nama,
							tbarang_paket.kategory,
							tbarang_paket.ket_kategory,
							tbarang_paket.qty,
							tbarang_paket.date_add,
							tbarang_paket.deleted
						FROM `tbarang_paket` 
						inner join `mkat2`
						on mkat2.kode = tbarang_paket.kategory
						where tbarang_paket.mkat2 = '$asdadsad'";
						

					$results	= $conn->query($sqls);
					while($recs = $results->fetch_assoc()){
					?>
						<div style="float:left;width:15%;font-size:10px;margin-top:-2px;font-size:15px;">&nbsp;</div>
						<div style="float:left;width:85%;font-size:10px;margin-top:-2px;font-size:15px;"><?php echo $recs['nama'];?></div>
					<?php
					}
				}
					$id_add = $rec['id'];
					$sqls	= "
						SELECT 
							transaksi_addon.nama,
							transaksi_addon.total
						FROM 
							`transaksi_addon`
						WHERE 
							transaksi_addon.id_transaksi_detail = '$id_add' && transaksi_addon.deleted = '0'
						order by transaksi_addon.id asc";
						

					$results	= $conn->query($sqls);
					while($recs = $results->fetch_assoc()){
					?>
							<div style="float:left;width:15%;font-size:10px;margin-top:-2px;font-size:15px;">&nbsp;</div>
							<div style="float:left;width:85%;font-size:10px;margin-top:-2px;font-size:15px;"><?php echo $recs['total'];?> X &nbsp;<?php echo $recs['nama'];?></div>
					<?php
					}
					if($rec['keterangan']!=null){
				?>
						<div style="float:left;width:15%;font-size:10px;margin-top:-2px;font-size:15px;">&nbsp;</div>
						<div style="float:left;width:85%;font-size:10px;margin-top:-2px;font-size:15px;">( <?php echo $rec['keterangan'];?> )</div>
				<?php
					}
				}
		?>
		<div id="garis_printbwh">
			=======================================
		</div>
		
		<div style="float:left;font-size:10px;margin-top:-16px;"><?php echo date('d/m/Y h:i:s', (time()+18000));?></div>
		<div style="height:25px;"></div>
	</div>
	<div class="w3-clear"></div>
	
	<script type="text/javascript">
		var mywindow = window.open('', 'PRINT', 'height=600,width=280');

		mywindow.document.write('<html><head><title>' + document.title  + '</title>');
		mywindow.document.write('</head><body >');
		mywindow.document.write(document.getElementById('utk_print').innerHTML);
		mywindow.document.write('</body></html>');

		mywindow.document.close();
		mywindow.focus();

		mywindow.print();
		mywindow.close();
		
		$.post('<?php echo $config->base_url();?>print_checker1/<?php echo $id;?>/<?php echo $pilihan_meja;?>.html',function(data){
			$('#utk_print').html(data);
		});
	</script>