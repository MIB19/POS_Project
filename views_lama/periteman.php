<div class="card_table" style="margin-left:1%;margin-right:1%;margin-top:1%;">

	<div style="width:100%; text-align: center;padding: 5px;font-size: 13px;">
		<div style="z-index: 10;  float:right;  margin-bottom:20px;">
			<a href="<?php echo $config->base_url()."tambah_item";?>.html">
				<img src="<?php echo $config->base_url(); ?>icon/plus.png" style="width:30px;height:30px;"/>
			</a>
		</div>
		<table id="example" class="display" style="width:100%; padding-right;10px;">
		
			<thead>
				<tr onClick="">
					<th hidden>no</th>
					<th>Kode</th>
					<th>Nama_item</th>
					<th>kode_kategory</th>
					<th>nharga</th>
					<th>nhargagrab</th>
					<th>nhargagojek</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$id = 1;
					foreach($show_item as $row){
						
				?>
				<tr>
					<td hidden><?php echo $no; ?></td>
					<td><?php echo $row['kode']; ?></td>
					<td><?php echo $row['nama']; ?></td>
					<td><?php echo $row['nama_kategory']; ?></td>
					<td><?php echo number_format($row['hrg']); ?></td>
					<td><?php echo number_format($row['nhargagrab']); ?></td>
					<td><?php echo number_format($row['nhargagojek']); ?></td>
					<td>
						<!--<a onClick="update('<?php echo $row['id']; ?>')" style="cursor:pointer;"><img src="<?php echo $config->base_url(); ?>icon/edit.png" style="width:20px;height:20px;"/></a>
						<a onClick="status('<?php echo $row['id']; ?>/<?php echo $vars; ?>')" style="cursor:pointer;"><img src="<?php echo $config->base_url(); ?>icon/delete.png" style="width:20px;height:20px;"/></a>			
						-->
						<a onClick="select('<?php echo $row['no']; ?>')" style="cursor:pointer;"><img src="<?php echo $config->base_url(); ?>icon/edit.png" style="width:20px;height:20px;"/></a>
						<a onClick="status('<?php echo $row['no']; ?>')" style="cursor:pointer;"><img src="<?php echo $config->base_url(); ?>icon/delete.png" style="width:20px;height:20px;"/></a>			
					</td>
				</tr>
				<?php
						$id++;
					} 
				?>
				
			</tfoot>
		</table>

	</div>
</div>
<script>
	function select(param){
		// alert(''+param);
		$('#dunia').html('Loading...');
		$.post('select_item/'+param+'.html',function(data){
			$('#dunia').html(data);
		});
	}
	function status(param){
		if(confirm('Apakah Anda Yakin ?'+param)){
			$('#dunia').html('Loading...');
			$.post('hapus_item/'+param+'.html',function(data){
				$('#dunia').html('Loading...');
				$.post('items.html',function(data){
					$('#dunia').html(data);
				});
			});
		}
	}
</script>
