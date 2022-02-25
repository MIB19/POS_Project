<div class="card_table" style="margin-left:1%;margin-right:1%;margin-top:1%;">

	<div style="width:100%; text-align: center;padding: 5px;font-size: 13px;">
		<div style="z-index: 10;  float:right;  margin-bottom:20px;">
			<a href="<?php echo $config->base_url();?>tambah_user_category.html">
				<img src="<?php echo $config->base_url(); ?>icon/plus.png" style="width:30px;height:30px;"/>
			</a>
		</div>
		<table id="example" class="display" style="width:100%; padding-right;10px;">
			<thead>
				<tr onClick="">
					<th>No</th>
					<th>Nama Category</th>
					<th>Discount</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$id = 1;
					foreach($show_user_category as $row){
						
				?>
				<tr>
					<td><?php echo $id; ?></td>
					<td><?php echo $row['nama_category']; ?></td>
					<td><?php echo $row['discount']; ?> %</td>
					<td>
						<?php if($row['id_category']=='1'){ ?>
						-
						<?php }else{ ?>
						<a onClick="update('<?php echo $row['id_category']; ?>')" style="cursor:pointer;"><img src="<?php echo $config->base_url(); ?>icon/edit.png" style="width:20px;height:20px;"/></a>
						<a onClick="status('<?php echo $row['id_category']; ?>')" style="cursor:pointer;"><img src="<?php echo $config->base_url(); ?>icon/delete.png" style="width:20px;height:20px;"/></a>			
						<?php } ?>
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
		$('#dunia').html('Loading...');
		$.post('select_user_category/'+param+'.html',function(data){
			$('#dunia').html(data);
		});
	}
	function status(param){
		if(confirm('Apakah Anda Yakin ?')){
			$('#dunia').html('Loading...');
			$.post('hapus_user_category/'+param+'.html',function(data){
				$('#dunia').html('Loading...');
				$.post('user_categorys.html',function(data){
					$('#dunia').html(data);
				});
			});
		}
	}
</script>

