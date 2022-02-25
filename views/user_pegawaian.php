<div class="card_table" style="margin-left:1%;margin-right:1%;margin-top:1%;">

	<div style="width:100%; text-align: center;padding: 5px;font-size: 13px;">
		<div style="z-index: 10;  float:right;  margin-bottom:20px;">
			<a href="<?php echo $config->base_url()."tambah_user_pegawai";?>.html">
				<img src="<?php echo $config->base_url(); ?>icon/plus.png" style="width:30px;height:30px;"/>
			</a>
			
		</div>
		<table id="example" class="display" style="width:100%; padding-right;10px;">
		
			<thead>
				<tr onClick="">
					<th>No</th>
					<th>kode</th>
					<th>password</th>
					<th>keterangan</th>
					<th>Action</th>
					
				</tr>
			</thead>
			<tbody>
				<?php 
					$id = 1;
					foreach($show_user as $row){
						$kunci			= 'o0oNagreMo0o';
						$id2			= md5(md5($kunci).$row['cpwd'].md5($row['cpwd']));
				?>
				<tr>
					<td><?php echo $id; ?></td>
					<td><?php echo $row['ckode']; ?></td>
					<td><?php echo $id2; ?></td>
					<td><?php echo $row['keterangan']; ?></td>
					<td>
						<a onClick="update('<?php echo $row['no']; ?>')" style="cursor:pointer;"><img src="<?php echo $config->base_url(); ?>icon/edit.png" style="width:20px;height:20px;"/></a>
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
	function update(param){
		// alert(''+param);
		$('#dunia').html('Loading...');
		$.post('select_user_pegawai/'+param+'.html',function(data){
			$('#dunia').html(data);
		});
	}
	function status(param){
		if(confirm('Apakah Anda Yakin ?'+param)){
			$('#dunia').html('Loading...');
			$.post('hapus_user_pegawai/'+param+'.html',function(data){
				$('#dunia').html('Loading...');
				$.post('user_pegawais.html',function(data){
					$('#dunia').html(data);
				});
			});
		}
	}
</script>

