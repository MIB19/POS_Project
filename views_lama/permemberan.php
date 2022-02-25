<div class="card_table" style="margin-left:1%;margin-right:1%;margin-top:1%;">

	<div style="width:100%; text-align: center;padding: 5px;font-size: 13px;">
		<div style="z-index: 10;  float:right;  margin-bottom:20px;">

		</div>
		<table id="example" class="display" style="width:100%; padding-right;10px;">
		
			<thead>
				<tr onClick="">
					<th>No</th>
					<th>nama</th>
					<th>alamat</th>
					<th>nama_category</th>
					<th>deposit</th>
					<th>barcode</th>
					<th>point</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$id = 1;
					foreach($show_user as $row){
						
				?>
				<tr>
					<td><?php echo $id; ?></td>
					<td><?php echo $row['nama']; ?></td>
					<td><?php echo $row['alamat']; ?></td>
					<td><?php echo $row['nama_category']; ?></td>
					<td>Rp<?php echo number_format($row['deposit']); ?></td>
					<td><?php echo $row['barcode']; ?></td>
					<td><?php echo $row['point']; ?></td>
					<td>
						<a onClick="update('<?php echo $row['id_user']; ?>')" style="cursor:pointer;"><img src="<?php echo $config->base_url(); ?>icon/edit.png" style="width:20px;height:20px;"/></a>
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
		$.post('select_member/'+param+'.html',function(data){
			$('#dunia').html(data);
		});
	}
</script>
