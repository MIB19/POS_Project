<div class="card_table" style="margin-left:1%;margin-right:1%;margin-top:1%;">

	<div style="width:100%; text-align: center;padding: 5px;font-size: 13px;">
		<div style="z-index: 10;  float:right;  margin-bottom:20px;">
			<a href="<?php echo $config->base_url().$var;?>.html">
				<img src="<?php echo $config->base_url(); ?>icon/plus.png" style="width:30px;height:30px;"/>
			</a>
		</div>
		<table id="example" class="display" style="width:100%; padding-right;10px;">
		
			<thead>
				<tr onClick="">
					<th>No</th>
					<th>Kode</th>
					<th>cnid</th>
					<th>ckdbrg</th>
					<th>cnama</th>
					<th>ckategori</th>
					<th>cketkategori</th>
					<th>nqty</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$id = 1;
					foreach($show_barang_paket as $row){
						
				?>
				<tr>
					<td><?php echo $id; ?></td>
					<td><?php echo $row['ckode']; ?></td>
					<td><?php echo $row['cnid']; ?></td>
					<td><?php echo $row['ckdbrg']; ?></td>
					<td><?php echo $row['cnama']; ?></td>
					<td><?php echo $row['ckategori']; ?></td>
					<td><?php echo $row['cketkategori']; ?></td>
					<td><?php echo $row['nqty']; ?></td>
					<td>
						<a onClick="update('<?php echo $row['id']; ?>')" style="cursor:pointer;"><img src="<?php echo $config->base_url(); ?>icon/edit.png" style="width:20px;height:20px;"/></a>
						<a onClick="status('<?php echo $row['id']; ?>/<?php echo $vars; ?>')" style="cursor:pointer;"><img src="<?php echo $config->base_url(); ?>icon/delete.png" style="width:20px;height:20px;"/></a>			
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

