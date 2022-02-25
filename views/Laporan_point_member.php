
<div class="card_table" style="margin-left:1%;margin-right:1%;margin-top:1%;">
	<a onClick="print()" style="cursor:pointer;	float:right;margin-bottom:40px;"/>Print Sekarang</a>
	<h2>Laporan Point</h2>

	<form method="POST" action="<?php echo $config->base_url();?>Laporan_filter_point_member.html">
		Periode Tanggal &nbsp;<input type="date" name="date1" <?php if($d1==null){ ?>value="<?php echo date("Y-m-d");?>" <?php }else{ ?>value="<?php echo $date11;?>"<?php } ?> />&nbsp;&nbsp;&nbsp;
		Sampai Tanggal &nbsp;<input type="date" name="date2"  <?php if($d2==null){ ?>value="<?php echo date("Y-m-d");?>" <?php }else{ ?>value="<?php echo $date21;?>"<?php } ?> />
		<input type="submit" value="Tampilkan"/>
	</form>
	
	<div style="width:100%; text-align: center;padding: 5px;font-size: 13px;"  id="div_print">
		
		<table id="example" class="display" style="width:100%; padding-right;10px;">
		
			<thead>
				<tr onClick="">
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
						<tr>
							<td><?php echo $no;?></td>
							<td><?php echo $row['kode_point'];?></td>
							<td><?php echo $row['barcode'];?></td>
							<td><?php echo $row['kasir'];?></td>
							<td><?php echo $row['keterangan'];?></td>
							<td><?php echo $row['total_point'];?></td>
							<td><?php echo date('d/m/Y H:i:s', ($row['date_add']+18000));?></td>
						</tr>
				<?php 
						$no++; 
					}
				?>
				</tr>
				
			</tfoot>
		</table>
		
	</div>
	
	<!--<input name="b_print" type="button" class="ipt"   onClick="printdiv('div_print');" value=" Print ">
-->
</div>

<script>
	
	
	function printdiv(printpage){
		var headstr = "<html><head><title></title></head><body>";
		var footstr = "</body>";
		var newstr = document.all.item(printpage).innerHTML;
		var oldstr = document.body.innerHTML;
		document.body.innerHTML = headstr+newstr+footstr;
		window.print();
		document.body.innerHTML = oldstr;
		return false;
	}
	function print(){
		window.open('<?php echo $config->base_url();?>print_page/7.html','_blank','_blank');
		// window.location = '<?php echo $config->base_url();?>print_page/7.html';
	}
</script>