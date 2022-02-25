
<div style="width:100%; text-align: center;padding: 5px;font-size: 13px; height:auto;">
	<table class="display" style="width:100%; padding-right;10px;max-height:200px;overflow-y:"  border=1>
		<thead>
			<tr>
				<th style="width:30px">No</th>
				<th style="width:100px">Kode</th>
				<th style="width:100px">Nama</th>
				<th style="width:100px">Harga</th>
				<th style="width:100px">QTY</th>
				<th style="width:100px">Total</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$no = 1;
				foreach($show_add_ons as $assek){
					$tlsss = $assek['total'] * number_format($assek['hrg'], 0, '', '');
			?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $assek['id_item']; ?></td>
					<td><?php echo $assek['nama']; ?></td>
					<td><?php echo number_format($assek['hrg']); ?></td>
					<td>
						<?php if($assek['stat_simpan']=='0'){ ?> 
						<a onClick="minus('<?php echo $assek['id'].'/'.$assek['total'].'/'.$_REQUEST['param1'];?>')" style="cursor:pointer;">
							<img src="<?php echo $config->base_url()."images/minus.png";?>" style="width:14px;margin-bottom:2px;"/> 
						</a>
						<?php echo $assek['total']; ?>
						<a onClick="plus('<?php echo $assek['id'].'/'.$assek['total'].'/'.$_REQUEST['param1'];?>')" style="cursor:pointer;">
							<img src="<?php echo $config->base_url()."images/plus.png";?>" style="width:14px;margin-bottom:2px;"/>
						</a>
						<?php }else{ ?>
						 <?php echo $assek['total']; ?>
						 <?php } ?>
						</td>
					<td><?php echo number_format($tlsss); ?></td>
				</tr>
			<?php 
					$no++;
				} 
				foreach($show_add_onsss as $aaa){
			?>
			<?php if($assek['stat_simpan']!='1'){ ?> 
			<tr>
				<td onClick="show_hide()">-</td>
				<td onClick="show_hide()">-</td>
				<td onClick="show_hide()">-</td>
				<td onClick="show_hide()">-</td>
				<td onClick="show_hide()">-</td>
				<td onClick="show_hide()">-</td>
			</tr>
				<?php } 
				} ?>
		</tbody>
	</table>

	<?php ?>
	<table id="myTable" style="overflow-y: auto;display:none;height:200px;">
		<?php 
			$a = 0;
			foreach($show_barang as $row){
			$a++;
		?>
		<tr>
			<td align="left" onClick="klik('<?php echo $row['kode']."|".$row['nama']."|".$row['hrg'];?>');"><?php echo '( '.$row['kode'].' ) '.$row['nama'];?></td>
		</tr>
		<?php }
			if($a == '0'){ ?> <br> <h1> <?php echo "tidak ada add ons"; } ?> </h1>
	</table>
</div>
<script>
	var tbl = document.getElementById("myTable");
	function show_hide(){
		if(tbl.style.display === "block" ){
			tbl.style.display = "none" ;
		}else{
			tbl.style.display = "block" ;
		}
	}
	function klik(param){
		var res = param.split("|");
		tbl.style.display = "none" ;

		$.post('<?php echo $config->base_url();?>tambah_order_addons/'+res[0]+'/'+<?php echo $_REQUEST['param1'];?>+'.html',function(data){
			$.post('<?php echo $config->base_url();?>add_onss/'+<?php echo $_REQUEST['param1'];?>+'/'+<?php echo $_REQUEST['param2'];?>+'/'+<?php echo $_REQUEST['param3'];?>+'.html',function(data){
				$('#testerasdasd').html(data);
			});
		});
	}
	function minus(param){
		$.post('<?php echo $config->base_url();?>kurangi_order_addons/'+param+'.html',function(data){
			$.post('<?php echo $config->base_url();?>add_onss/'+<?php echo $_REQUEST['param1'];?>+'/'+<?php echo $_REQUEST['param2'];?>+'/'+<?php echo $_REQUEST['param3'];?>+'.html',function(data){
				$('#testerasdasd').html(data);
			});
		});
	}
	function plus(param){
		$.post('<?php echo $config->base_url();?>tambahi_order_addons/'+param+'.html',function(data){
			$.post('<?php echo $config->base_url();?>add_onss/'+<?php echo $_REQUEST['param1'];?>+'/'+<?php echo $_REQUEST['param2'];?>+'/'+<?php echo $_REQUEST['param3'];?>+'.html',function(data){
				$('#testerasdasd').html(data);
			});
		});
	}
	function close_popup(param){
		x.style.visibility = "hidden" ;
		$.post('<?php echo $config->base_url();?>list_transaksis/'+<?php echo $pilihan_meja;?>+'.html',function(data){
			$('#dunia').html(data);
		});
	}
</script>


