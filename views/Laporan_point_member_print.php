
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
	
	<h2>Laporan Point Member</h2>
	<div style="width:100%; text-align: center;padding: 5px;font-size: 13px;"  id="div_print">
		
		<table id="example" class="display" style="width:100%; padding-right;10px;">
		
			<thead>
				<tr onClick="" style="border: 0.1px solid gray;border-top: 0.1px solid gray;">
					<th>No</th>
					<th>kode_point</th>
					<th>barcode</th>
					<th>kasir</th>
					<th>keterangan</th>
					<th>total_point</th>
					<th>date_add</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$no = 1; 
					foreach($show_laporan as $row){ 
				?>
						<tr style="border: 0.1px solid gray;border-top: 0.1px solid gray;">
							<td><center><?php echo $no;?></center></td>
							<td><center><?php echo $row['kode_point'];?></center></td>
							<td><center><?php echo $row['barcode'];?></center></td>
							<td><center><?php echo $row['kasir'];?></center></td>
							<td><center><?php echo $row['keterangan'];?></center></td>
							<td><center><?php echo $row['total_point'];?></center></td>
							<td><center><?php echo date('d/m/Y h:i:s', ($row['date_add']+18000));?></center></td>
						</tr>
				<?php 
						$no++; 
					}
				?>
				</tr>
				
			</tfoot>
		</table>
		
	</div>

</div>

<script>
// window.print();
	window.close();
</script>