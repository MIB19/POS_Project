<div class="card_table" style="margin-left:1%;margin-right:1%;margin-top:1%;">
	<div style="width:100%; text-align: center;padding: 5px;font-size: 13px;">
		<div style="z-index: 10;  float:right;  margin-bottom:20px;">
			<a href="<?php echo $config->base_url();?>tambh_transaksi/<?php echo $_REQUEST['param1'];?>.html">
				<img src="<?php echo $config->base_url(); ?>icon/plus.png" style="width:30px;height:30px;"/>
			</a>
		</div>
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
				foreach($show_items as $row){ 
				
					$transaksi_meja =$config->base_url()."transaksi_meja/".$pilihan_meja."/".$row['id'].""; 
				?>
				<tr>
					<td><?php echo $no;?></td>
					<td>klbr<?php echo $row['date_add'];?><?php echo $row['id'];?></td>
					<td>John Doe</td>
					<td><?php echo (date("Y-m-d  H:i:s",$row['date_add'])); ?></td>
					<td><a href="<?php echo $transaksi_meja;?>.html">Detail</a></td>
				</tr>
				<?php $no++; } ?>
			</tfoot>
		</table>

	</div>
</div>

<?php
	if($page_atrs != ""){
		require "views/".$page_atrs.".php";	
	}
?>


