<?php 
	$iaaaa = 0;
	foreach($show_itemssss as $row){ 
		$iaaaa = $iaaaa+1;
	}
	if($iaaaa==0){
		?>
		<script>
			window.location = '<?php echo $config->base_url();?>pindah/<?php echo $id;?>/<?php echo $id1;?>/<?php echo $id2;?>.html';
		</script>
		<?php
		// header("location:$config->base_url"."pindah_meja/".$id."/".$id1."/".$id2.".html");
		// exit;
	}
?>
<div class="card_table" style="margin-left:1%;margin-right:1%;margin-top:1%;">
	<div style="width:100%; text-align: center;padding: 5px;font-size: 13px;">
		<table id="example" class="display" style="width:100%; padding-right;10px;">
			<thead>
				<tr onClick="">
					<th>No</th>
					<th>Kode Transaksi</th>
					<th>Nama</th>
					<th>Tanggal</th>
					<th>Detail</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$no =1;
				foreach($show_itemssss as $row){ 
					$id_us = $row['id'];
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
					$transaksi_meja =$config->base_url()."pindh_meja/".$id."/".$row['id']."/".$id1."/".$id2.""; 
				?>
				<tr>
					<td><?php echo $no;?></td>
					<td><?php echo  date('ym', ($row['date_add']+18000)).$sasa;?></td>
					<td><?php if($row['nama'] == null ){ echo '-'; }else{ echo $row['nama']; } ?></td>
					<td><?php echo (date("Y-m-d  H:i:s",($row['date_add']+18000))); ?></td>
					<td><a href="<?php echo $transaksi_meja;?>.html">Pindah Kesini</a></td>
				</tr>
				<?php $no++; } ?>
			</tfoot>
		</table>

	</div>
</div>