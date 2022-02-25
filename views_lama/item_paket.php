<div class="card_table" style="margin-left:1%;margin-right:1%;margin-top:1%;">

	<div style="width:100%; text-align: center;padding: 5px;font-size: 13px;">
		<div style="z-index: 10;  float:right;  margin-bottom:20px;">
			<a href="<?php echo $config->base_url()."tambah_item_paket";?>.html">
				<img src="<?php echo $config->base_url(); ?>icon/plus.png" style="width:30px;height:30px;"/>
			</a>
		</div>
		<table id="example" class="display" style="width:100%; padding-right;10px;">
		
			<thead>
				<tr onClick="">
					<th hidden>no</th>
					<th>Kode</th>
					<th>Nama Paket</th>
					<th>ckode</th>
					<th>nama</th>
					<th>kategory</th>
					<th>ket_kategory</th>
					<th>qty</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$id = 1;
					foreach($show_item_paket as $row){
						
				?>
				<tr>
					<td hidden><?php echo $no; ?></td>
					<td><?php echo $row['mkat2']; ?></td>
					<td><?php echo $row['name']; ?></td>
					<td><?php echo $row['ckode']; ?></td>
					<td><?php echo $row['nama']; ?></td>
					<td><?php echo $row['kategory']; ?></td>
					<td><?php echo $row['ket_kategory']; ?></td>
					<td><?php echo $row['qty']; ?></td>
					<td>
						<a onClick="status('<?php echo $row['id']; ?>')" style="cursor:pointer;"><img src="<?php echo $config->base_url(); ?>icon/delete.png" style="width:20px;height:20px;"/></a>			
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
	function status(param){
		if(confirm('Apakah Anda Yakin ?'+param)){
			$('#dunia').html('Loading...');
			$.post('hapus_item_paket/'+param+'.html',function(data){
				$('#dunia').html('Loading...');
				$.post('items.html',function(data){
					$('#dunia').html(data);
				});
			});
		}
	}
</script>
