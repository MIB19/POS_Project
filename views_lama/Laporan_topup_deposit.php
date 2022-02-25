<script src="<?php echo $config->base_url();?>styles/nm.js"></script>
<script src="<?php echo $config->base_url();?>styles/st.js"></script>
<div class="card_table" style="margin-left:1%;margin-right:1%;margin-top:1%;">
	<a onClick="print()" style="cursor:pointer;	float:right;margin-bottom:40px;"/>Print Sekarang</a>
	<h2>Laporan TopUp & Deposit Member</h2>

	<form method="POST" action="<?php echo $config->base_url();?>Laporan_topup_deposit_filter.html">
		Periode Tanggal &nbsp;<input type="date" name="date1" <?php if($d1==null){ ?>value="<?php echo date("Y-m-d");?>" <?php }else{ ?>value="<?php echo $date11;?>"<?php } ?> />&nbsp;&nbsp;&nbsp;
		Sampai Tanggal &nbsp;<input type="date" name="date2"  <?php if($d2==null){ ?>value="<?php echo date("Y-m-d");?>" <?php }else{ ?>value="<?php echo $date21;?>"<?php } ?> />
		<input type="submit" value="Tampilkan"/>
	</form>
	
	<div style="width:100%; text-align: center;padding: 5px;font-size: 13px;"  id="div_print">
		
		<table id="datatable" class="display" style="width:100%; padding-right;10px;">
		
			<thead>
				<tr onClick="">
					<th>No</th>
					<th hidden>t1</th>
					<th hidden>t2</th>
					<th hidden>t3</th>
					<th>kode_tr</th>
					<th>barcode</th>
					<th>Keterangan</th>
					<th>kasir</th>
					<th>type_bayar</th>
					<th>nominals</th>
					<th>date_add</th>
					<th>PrintUlang</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$no = 1; $t1 = 0; $t2 = 0; $t3 = 0; 
					foreach($show_laporan as $row){ 
						$tpbyr = '-';
						if($row['type_bayar'] == '1'){
							$tpbyr = 'Tunai';
						}else if($row['type_bayar'] == '2'){
							$tpbyr = 'Debit';
						}else if($row['type_bayar'] == '3'){
							$tpbyr = 'Kartu Kredit';
						}
				?>
						<tr>
							<td><?php echo $no;?></td>
							<td hidden><?php if($row['keterangan'] == 'DEPOSIT AWAL'){ echo $row['nominals']; $t1 = $t1+$row['nominals']; }else{ echo 0; }?></td>
							<td hidden><?php if($row['keterangan'] == 'TOP UP'){ echo $row['nominals']; $t2 = $t2+$row['nominals']; }else{ echo 0; }?></td>
							<td hidden><?php if($row['keterangan'] == 'Pemakaian Deposit'){ echo $row['nominals']; $t3 = $t3+$row['nominals']; }else{ echo 0; }?></td>
							<td><?php echo $row['kode_tr'];?></td>
							<td><?php echo $row['barcode'];?></td>
							<td><?php echo $row['keterangan'];?></td>
							<td><?php echo $row['kasir'];?></td>
							<td><?php echo $tpbyr;?></td>
							<td align=right><?php echo number_format($row['nominals']);?></td>
							<td><?php echo  date('d/m/Y h:i:s', $row['date_add']+18000);?></td>
							<td><?php if($row['keterangan'] != 'Pemakaian Deposit'){ ?><a onClick="printUlang('<?php echo $row['barcode'];?>/<?php echo $row['nominals'];?>/<?php echo $row['nama'];?>')" style="cursor:pointer;">Print Ulang</a><?php }else{ ?>-<?php } ?></td>
						</tr>
				<?php 
						$no++; 
					}
				?>
				</tr>
				
			</tfoot>
		</table>
			<div style="text-align:left;margin-top:16px;">
			<div>
				Deposite Awal &nbsp;<input type="text" id="inputan1" value="<?php echo "0";?>" style="width:100px;text-align:center;" disabled/>&nbsp;&nbsp;&nbsp;
				TopUp Deposit &nbsp;<input type="text" id="inputan2" value="<?php echo "0";?>" style="width:100px;text-align:center;" disabled/>&nbsp;&nbsp;&nbsp;
				Pemakaian Deposit &nbsp;<input type="text" id="inputan3" value="<?php echo "0";?>" style="width:100px;text-align:center;" disabled/>&nbsp;&nbsp;&nbsp;
				<input name="b_print" type="button" class="ipt" style="width:120px"  onClick="printdiv('div_print');" value=" Print ">
			</div>
		</div>
	</div>
	


</div>

<script>
	document.getElementById('inputan1').value = "<?php echo number_format($t1);?>";
	document.getElementById('inputan2').value = "<?php echo number_format($t2);?>";
	document.getElementById('inputan3').value = "<?php echo number_format($t3);?>";
	
	$(document).ready(function () {
		var table = $('#datatable').DataTable();
		$('input').on('keyup click', function () {
			var searched = table.rows({
				search: 'applied'
			}).nodes();

			calculatesum(searched);

		});
	});
	function printUlang(param){
		open('<?php echo $config->base_url();?>print_prints/'+param+'.html');
				
	}
	function calculatesum(all) {
		var columnsToSum1 = [1],columnsToSum2 = [2],columnsToSum3 = [3];
		sum1 = 0, sum2 = 0, sum3 = 0;
		for (i = 0; i < columnsToSum1.length; i++) {
			a = columnsToSum1[i],b = columnsToSum2[i],c = columnsToSum3[i];
			for (j = 0; j < all.length; j++) {

				var val1 = all[j].getElementsByTagName('td')[a].innerHTML;
				var val2 = all[j].getElementsByTagName('td')[b].innerHTML;
				var val3 = all[j].getElementsByTagName('td')[c].innerHTML;
				
				sum1 += isNaN(val1.split(',').join("")) ? 0 : parseInt(val1.split(',').join(""));
				sum2 += isNaN(val2.split(',').join("")) ? 0 : parseInt(val2.split(',').join(""));
				sum3 += isNaN(val3.split(',').join("")) ? 0 : parseInt(val3.split(',').join(""));
				
			}
			
		}

		document.getElementById('inputan1').value = numeral(sum1).format('0,0.[00]');
		document.getElementById('inputan2').value = numeral(sum2).format('0,0.[00]');
		document.getElementById('inputan3').value = numeral(sum3).format('0,0.[00]');
	}

	
	
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
		window.open('<?php echo $config->base_url();?>print_page/6.html','_blank','_blank');
	}
</script>