<div class="card_table" style="margin-left:1%;margin-right:1%;margin-top:1%;">

	<div style="width:100%; text-align: center;padding: 5px;font-size: 13px;">
		<div style="z-index: 10;  float:right;  margin-bottom:20px;">
			<a href="<?php echo $config->base_url().$var;?>tambah_kategory.html">
				<img src="<?php echo $config->base_url(); ?>icon/plus.png" style="width:30px;height:30px;"/>
			</a>
		</div>
		<table id="example" class="display" style="width:100%; padding-right;10px;">
		
			<thead>
				<tr onClick="">
					<th>No</th>
					<th>Kode</th>
					<th>Nama</th>
					<th>Print</th>
					<th>Dis_otmts</th>
					<th>Disc</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$id = 1;
					foreach($show_kategori as $row){
						
						$dis_otmtis ='Ya';
						if($row['dis_otmtis'] == '1'){ $dis_otmtis ='Tidak'; };
				?>
				<tr>
					<td><?php echo $id; ?></td>
					<td><?php echo $row['kode']; ?></td>
					<td><?php echo $row['nama']; ?></td>
					<td><?php echo $row['mprint']; ?></td>
					<td><?php echo $dis_otmtis; ?></td>
					<td><?php echo $row['dis']; ?></td>
					<td>
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
		$('#dunia').html('Loading...');
		$.post('select_kategory/'+param+'.html',function(data){
			$('#dunia').html(data);
		});
	}
	function status(param){
		if(confirm('Apakah Anda Yakin ?'+param)){
			$('#dunia').html('Loading...');
			$.post('hapus_category/'+param+'.html',function(data){
				$('#dunia').html('Loading...');
				$.post('categorys.html',function(data){
					$('#dunia').html(data);
				});
			});
		}
	}
</script>