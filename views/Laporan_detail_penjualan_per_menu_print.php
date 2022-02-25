<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data Pegawai.xls");
?>
<link href="<?php echo $config->base_url();?>styles/style.css" rel="stylesheet" />
	
</style>
<style>

@page { size: landscape;
		font-size:8px; }
table {
  border-collapse: collapse;
  border-spacing: 0;
  font-size:8px;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 16px;
  font-size:10px;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}
</style>
<div style="margin-left:1%;margin-right:1%;margin-top:1%;">
	<h2>Laporan Detail Penjualan Per Menu</h2>
	<div style="width:100%; text-align: center;padding: 5px;font-size: 13px;"  id="div_print">
		<?php 
			$no = 1; 
			$prtgn = 1;
			$kt = '';
			foreach($show_laporan as $row){ 
				if($kt ==  $row['kategory']){
						
		?>
					<tr>	
						<td width = 100px><?php echo $row['nm_brg'];?></td>
						<td width = 100px><?php echo $row['ts'];?></td>

					</tr>
		<?php
				}else{
					if($no == 1){
		?>
						<br>
						<table id="example" class="display" style="width:100%; padding-right;10px;margin-top:100px">
							<thead>
								<tr>
									<td colspan = 1><td>
								</tr>
								<tr>
									<td colspan = 1><?php echo $row['kategory'];?><td>
								</tr>
								<tr onClick="">
									<th width = 100px>Nama Barang</th>
									<th width = 100px>Jumlah Terjual</th>
								</tr>
							</thead>
							<tbody>
							<tr>
								<td width = 100px><?php echo $row['nm_brg'];?></td>
								<td width = 100px><?php echo $row['ts'];?></td>
							</tr>
		<?php
							
						
						// $prtgn = 1;
						
					}else{
		?>
						</tbody>
						</table>
						<br>
						<table id="example" class="display" style="width:100%; padding-right;10px;">
							<thead>
								<tr>
									<td colspan = 1><td>
								</tr>
								<tr>
									<td colspan = 1><?php echo $row['kategory'];?><td>
								</tr>
								<tr onClick="">
									<th width = 100px>Nama Barang</th>
									<th width = 100px>Jumlah Terjual</th>
								</tr>
							</thead>
							<tbody>
							<tr>
								<td width = 100px><?php echo $row['nm_brg'];?></td>
								<td width = 100px><?php echo $row['ts'];?></td>
							</tr>
							
		<?php
							
						$no = 1; 
						
						// $prtgn = $prtgn;
						
					}
					$kt =  $row['kategory'];
				}
			}
		?>
		
	</div>
	

</div>

<script>
	// window.print();
	// window.close();
</script>