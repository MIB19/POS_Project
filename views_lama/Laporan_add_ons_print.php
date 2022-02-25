<link href="<?php echo $config->base_url();?>styles/style.css" rel="stylesheet" />

<style>

@page { size: landscape; }
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 16px;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}
</style>
<div class="card_table" style="margin-left:1%;margin-right:1%;margin-top:1%;">
	<h2>Laporan AddOns</h2>
	<div style="width:100%; text-align: center;padding: 5px;font-size: 13px;"  id="div_print">
		
		<table id="example" class="display" style="width:100%; padding-right;10px;">
		
			<thead>
				<tr onClick="" style="border: 0.1px solid gray;border-top: 0.1px solid gray;">
					<th>No</th>
					<th><center>Nama Add Ons</center></th>
					<th><center>Jumlah Terjual</center></th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$no = 1; 
					foreach($show_laporan as $row){ 
				?>
						<tr style="border: 0.1px solid gray;border-top: 0.1px solid gray;">
							<td><?php echo $no;?></td>
							<td><?php echo $row['nama'];?></td>
							<td><center><?php echo $row['ts'];?></center></td>
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