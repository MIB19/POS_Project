<script src="<?php echo $config->base_url();?>styles/nm.js"></script>
<script src="<?php echo $config->base_url();?>styles/st.js"></script>
<div class="card_table" style="margin-left:1%;margin-right:1%;margin-top:1%;">
	<a onClick="print()" style="cursor:pointer;	float:right;margin-bottom:40px;"/>Print Sekarang</a>
	<h2>Laporan Void</h2>

	<form method="POST" action="<?php echo $config->base_url();?>laporan_void_filter.html">
		Periode Tanggal &nbsp;<input type="date" name="date1" <?php if($d1==null){ ?>value="<?php echo date("Y-m-d");?>" <?php }else{ ?>value="<?php echo $date11;?>"<?php } ?> />&nbsp;&nbsp;&nbsp;
		Sampai Tanggal &nbsp;<input type="date" name="date2"  <?php if($d2==null){ ?>value="<?php echo date("Y-m-d");?>" <?php }else{ ?>value="<?php echo $date21;?>"<?php } ?> />
		<input type="submit" value="Tampilkan"/>
	</form>
	
	<div style="width:100%; text-align: center;padding: 5px;font-size: 13px;"  id="div_print">
		
		<table id="datatable" class="display" style="width:100%; padding-right;10px;">
		
			<thead>
				<tr onClick="">
					<th hidden></th>
					<th>NoTrans</th>
					<th>Tanggal</th>
					<th>Meja</th>
					<th>Pgwai_Input</th>
					<th hidden>Kasir</th>
					<th>Pesanan</th>
					<th>Total Void</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$no = 1; 
					$tls1 = 0;$tls2 = 0;$tls3 = 0;$tls4 = 0;$tls5 = 0;$tls6 = 0;
					$utid = 0;
					$utaddon = 0;
					foreach($show_laporan as $row){ 
						if($utid != $row['id']){
							$hr		 = number_format($row['hrg'],0,"","")*$row['total'];
							$service = 0;
							$ppn 	 = 0;
							
							$ds	 	 = $hr*number_format($row['dis'],0,"","")/100;
							if($row['biaya_service'] == '1'){
								$service = ($hr-$ds)*5/100;
							}if($row['biaya_ppn'] == '1'){
								$ppn	 = ($hr-$ds)*10/100;
							}
							$sbtl = $hr - $ds;
							$gr_ttl	 = $hr+$service+$ppn-$ds;
							$tls1 = $tls1+number_format($row['hrg'],0,"","");
							$tls2 = $tls2+$row['total'];
							$tls3 = $tls3+$sbtl;
							$tls4 = $tls4+$service;
							$tls5 = $tls5+$ppn;
							$tls6 = $tls6+$gr_ttl;
							
							$nmj = $row['no_meja'];
							if($row['no_meja'] == '0'){
								$nmj = 'Meeting';
							}else if($row['no_meja'] == '101'){
								$nmj = 'VIP';
							}else if($row['no_meja'] == '102'){
								$nmj = 'Delivery';
							}else if($row['no_meja'] == '103'){
								$nmj = 'Grab';
							}else if($row['no_meja'] == '104'){
								$nmj = 'Gojek';
							}else if($row['no_meja'] == '105'){
								$nmj = 'Marketing';
							}else if($row['no_meja'] == '106'){
								$nmj = 'Operasional';
							}else if($row['no_meja'] == '107'){
								$nmj = 'Owner';
							}
							
							$id_us = $row['id_trans'];
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
							<tr>
								<td hidden><?php echo $no;?></td>
								<td><?php echo date('ym', ($row['date_add']+18000));?><?php echo $sasa;?></td>
								<td><?php echo date('d/m/Y H:i:s', ($row['date_add']+18000));?></td>
								<td><?php echo $nmj;?></td>
								<td><?php echo $row['ckode'];?></td>
								<td hidden><?php echo $row['kasir'];?></td>
								<td><?php echo $row['nm_brg'];?></td>
								<td><?php echo $row['total'];?></td>
								
							</tr>
				<?php 
							$no++; 
						}
						if($row['id_addon'] != null){
							$hr		 = (number_format($row['harga_brg_add_on'],0,"","")*$row['total_brg_add_on']) * $row['total'];
							$service = 0;
							$ppn 	 = 0;
							
							$ds	 	 = $hr*number_format($row['dis'],0,"","")/100;
							if($row['biaya_service'] == '1'){
								$service = ($hr-$ds)*5/100;
							}if($row['biaya_ppn'] == '1'){
								$ppn	 = ($hr-$ds)*10/100;
							}
							
							$sbtl = $hr - $ds;
							$gr_ttl	 = $hr+$service+$ppn-$ds;
							$tls1 = $tls1+number_format($row['harga_brg_add_on'],0,"","");
							$tls2 = $tls2+($row['total_brg_add_on']*$row['total']);
							$tls3 = $tls3+$sbtl;
							$tls4 = $tls4+$service;
							$tls5 = $tls5+$ppn;
							$tls6 = $tls6+$gr_ttl;
							
				?>
							<tr>
								<td hidden><?php echo $no;?></td>
								<td><?php echo date('ym', ($row['date_add']+18000));?><?php echo $sasa;?></td>
								<td><font color="red"><?php echo date('m/d/Y h:i:s', ($row['date_add']+18000));?></font></td>
								<td><font color="red"><?php echo $nmj;?></font></td>
								<td><font color="red"><?php echo $row['ckode'];?></font></td>
								<td hidden></td>
								<td><?php echo $row['nama_brg_add_on'];?></td>
								<td><?php echo $row['total_brg_add_on']*$row['total'];?></td>
							</tr>
				<?php 
						}
						$utid = $row['id'];
						
					} 
				?>
				
				</tr>
				
			</tfoot>
		</table>
		
	</div>
	
</div>

<script>
	function print(){
		window.open('<?php echo $config->base_url();?>print_page/5.html','_blank','_blank');
	}
	$(document).ready(function () {
		var table = $('#datatable').DataTable();
		$('input').on('keyup click', function () {
			var searched = table.rows({
				search: 'applied'
			}).nodes();

			calculatesum(searched);

		});
	});
</script>