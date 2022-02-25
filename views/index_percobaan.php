<link href="<?php echo $config->base_url();?>styles/table.css" rel="stylesheet" />

<div id="pilihan_utama" class="card_table" style="margin-left:1%;margin-right:1%;margin-top:1%;display:block;" >
	<div style="width:100%; text-align: center;padding: 5px;font-size: 13px;" >
		<div style="z-index: 10;  float:left;  margin-bottom:20px;margin-top:4px;">
			<a onClick="memilih_meja()" style="font-size:18px;float:left;">
				Meja No 20
			</a>
			<br>
			<div style="font-size:8px;float:left;">29/07/2020 10:24</div>
		</div>
		<div style="float:right;width:auto; ">
			<div class="card_pilihan_meja1" style="width:70px;float:right;height:auto;background:#987860;color:white;">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;">
					<b>Bayar</b>
				</div>
			</div>
			<div class="card_pilihan_meja1" style="width:70px;float:right;height:auto;background:#987860;color:white;">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;">
					<b>Split</b>
				</div>
			</div>
			<div class="card_pilihan_meja1" style="width:70px;float:right;height:auto;background:#987860;color:white;">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;">
					<b>Print</b>
				</div>
			</div>
			<div class="card_pilihan_meja1" style="width:70px;float:right;height:auto;background:#987860;color:white;">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;">
					<b>Simpan</b>
				</div>
			</div>
			<div class="card_pilihan_meja1" style="width:70px;float:right;height:auto;background:#FF6347;border-color:#FF6347;color:white;">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;">
					<b>Batal</b>
				</div>
			</div>
			
		</div>
		<table  class="display" style="width:100%; padding-right;10px;" border=1>
			<thead>
				<tr>
					<th>No</th>
					<th style="width:100px;">Kode</th>
					<th>Nama</th>
					<th>Add On</th>
					<th>Keterangan</th>
					<th>Harga</th>
					<th>QTY</th>
					<th>Discount</th>
					<th>Total Harga</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>1</td>
					<td>3</td>
					<td>FROZEN GEISHA</td>
					<td>-</td>
					<td>-</td>
					<td>Rp 120,000</td>
					<td>
						<a onClick="minus('<?php echo $row['id'].'/'.$row['total'];?>')" style="cursor:pointer;">
							<img src="<?php echo $config->base_url()."images/minus.png";?>" style="width:14px;margin-bottom:2px;"/> 
						</a>
						1
						<a onClick="plus('<?php echo $row['id'].'/'.$row['total'];?>')" style="cursor:pointer;">
							<img src="<?php echo $config->base_url()."images/plus.png";?>" style="width:14px;margin-bottom:2px;"/>
						</a>
					</td>
					<td>-</td>
					<td>Rp 120,000</td>
					<td><input type="checkbox"/></td>
				</tr>
				<tr>
					<td onClick="show_hide()">+</td>
					<td>
						<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Kode" required class="form-control" style="width:100px; text-align:center;">
					</td>
					<td id="nm_mkanan" onClick="show_hide()">-</td>
					<td onClick="show_hide()">-</td>
					<td onClick="show_hide()">-</td>
					<td id="qty_mkanan" onClick="show_hide()">-</td>
					<td id="hrg_mkanan" onClick="show_hide()">-</td>
					<td onClick="show_hide()">-</td>
					<td onClick="show_hide()">-</td>
					<td onClick="show_hide()">-</td>
				</tr>
				
				<tr>
					<td colspan=8; style="border-bottom-style: hidden;border-left-style: hidden;"></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;"><div style="color:red;">SUBTOTAL</div></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;">Rp 120,000</td>
				</tr>
				<tr>
					<td colspan=8; style="border-bottom-style: hidden;border-left-style: hidden;"></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;"><div style="color:red;">SERVICE</div></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;">Rp 6,000</td>
				</tr>
				<tr>
					<td colspan=8; style="border-bottom-style: hidden;border-left-style: hidden;"></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;"><div style="color:red;">PPN</div></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;">Rp 12,000</td>
				</tr>
				<tr>
					<td colspan=8; style="border-bottom-style: hidden;border-left-style: hidden;border"></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;"><div style="color:red;">TOTAL</div></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;">Rp 138,000</td>
				</tr>
				
			</tbody>
		</table>

	</div>
</div>


<div id="pilihan_utama" class="card_table" style="margin-left:1%;margin-right:1%;margin-top:1%;display:block;" >
	<div style="width:100%; text-align: center;padding: 5px;font-size: 13px;" >
		<div style="z-index: 10;  float:left;  margin-bottom:20px;margin-top:4px;">
			<a onClick="memilih_meja()" style="font-size:18px;float:left;">
				Meja No 20
			</a>
			<br>
			<div style="font-size:8px;float:left;">29/07/2020 10:24</div>
		</div>
		<div style="float:right;width:auto; ">
			<div class="card_pilihan_meja1" style="width:70px;float:right;height:auto;background:#987860;color:white;">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;">
					<b>Bayar</b>
				</div>
			</div>
			<div class="card_pilihan_meja1" style="width:70px;float:right;height:auto;background:#987860;color:white;">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;">
					<b>Split</b>
				</div>
			</div>
			<div class="card_pilihan_meja1" style="width:70px;float:right;height:auto;background:#987860;color:white;">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;">
					<b>Print</b>
				</div>
			</div>
			<div class="card_pilihan_meja1" style="width:70px;float:right;height:auto;background:#987860;color:white;">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;">
					<b>Simpan</b>
				</div>
			</div>
			<div class="card_pilihan_meja1" style="width:70px;float:right;height:auto;background:#FF6347;border-color:#FF6347;color:white;">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;">
					<b>Batal</b>
				</div>
			</div>
			
		</div>
		<table  class="display" style="width:100%; padding-right;10px;" border=1>
			<thead>
				<tr>
					<th>No</th>
					<th style="width:100px;">Kode</th>
					<th>Nama</th>
					<th>Add On</th>
					<th>Keterangan</th>
					<th>Harga</th>
					<th>QTY</th>
					<th>Discount</th>
					<th>Total Harga</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>1</td>
					<td>3</td>
					<td>FROZEN GEISHA</td>
					<td>-</td>
					<td>-</td>
					<td>Rp 120,000</td>
					<td>
						<a onClick="minus('<?php echo $row['id'].'/'.$row['total'];?>')" style="cursor:pointer;">
							<img src="<?php echo $config->base_url()."images/minus.png";?>" style="width:14px;margin-bottom:2px;"/> 
						</a>
						1
						<a onClick="plus('<?php echo $row['id'].'/'.$row['total'];?>')" style="cursor:pointer;">
							<img src="<?php echo $config->base_url()."images/plus.png";?>" style="width:14px;margin-bottom:2px;"/>
						</a>
					</td>
					<td>-</td>
					<td>Rp 120,000</td>
					<td><input type="checkbox"/></td>
				</tr>
				<tr>
					<td onClick="show_hide()">+</td>
					<td>
						<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Kode" required class="form-control" style="width:100px; text-align:center;">
					</td>
					<td id="nm_mkanan" onClick="show_hide()">-</td>
					<td onClick="show_hide()">-</td>
					<td onClick="show_hide()">-</td>
					<td id="qty_mkanan" onClick="show_hide()">-</td>
					<td id="hrg_mkanan" onClick="show_hide()">-</td>
					<td onClick="show_hide()">-</td>
					<td onClick="show_hide()">-</td>
					<td onClick="show_hide()">-</td>
				</tr>
				
				<tr>
					<td colspan=8; style="border-bottom-style: hidden;border-left-style: hidden;"></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;"><div style="color:red;">SUBTOTAL</div></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;">Rp 120,000</td>
				</tr>
				<tr>
					<td colspan=8; style="border-bottom-style: hidden;border-left-style: hidden;"></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;"><div style="color:red;">SERVICE</div></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;">Rp 6,000</td>
				</tr>
				<tr>
					<td colspan=8; style="border-bottom-style: hidden;border-left-style: hidden;"></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;"><div style="color:red;">PPN</div></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;">Rp 12,000</td>
				</tr>
				<tr>
					<td colspan=8; style="border-bottom-style: hidden;border-left-style: hidden;border"></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;"><div style="color:red;">TOTAL</div></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;">Rp 138,000</td>
				</tr>
				
			</tbody>
		</table>

	</div>
</div>


<div id="pilihan_utama" class="card_table" style="margin-left:1%;margin-right:1%;margin-top:1%;display:block;" >
	<div style="width:100%; text-align: center;padding: 5px;font-size: 13px;" >
		<div style="z-index: 10;  float:left;  margin-bottom:20px;margin-top:4px;">
			<a onClick="memilih_meja()" style="font-size:18px;float:left;">
				Meja No 20
			</a>
			<br>
			<div style="font-size:8px;float:left;">20/07/2020 10:24</div>
		</div>
		<div style="float:right;width:auto; ">
			<div class="card_pilihan_meja1" style="width:70px;float:right;height:auto;background:#987860;color:white;">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;">
					<b>Bayar</b>
				</div>
			</div>
			<div class="card_pilihan_meja1" style="width:70px;float:right;height:auto;background:#987860;color:white;">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;">
					<b>Split</b>
				</div>
			</div>
			<div class="card_pilihan_meja1" style="width:70px;float:right;height:auto;background:#987860;color:white;">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;">
					<b>Print</b>
				</div>
			</div>
			<div class="card_pilihan_meja1" style="width:70px;float:right;height:auto;background:#987860;color:white;">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;">
					<b>Simpan</b>
				</div>
			</div>
			<div class="card_pilihan_meja1" style="width:70px;float:right;height:auto;background:#FF6347;border-color:#FF6347;color:white;">
				<div style="margin: auto;width: 100%;padding-right: 4px;padding-left: 4px; text-align: center;">
					<b>Batal</b>
				</div>
			</div>
			
		</div>
		<table  class="display" style="width:100%; padding-right;10px;" border=1>
			<thead>
				<tr>
					<th>No</th>
					<th style="width:100px;">Kode</th>
					<th>Nama</th>
					<th>Add On</th>
					<th>Keterangan</th>
					<th>Harga</th>
					<th>QTY</th>
					<th>Discount</th>
					<th>Total Harga</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>1</td>
					<td>3</td>
					<td>FROZEN GEISHA</td>
					<td>-</td>
					<td>-</td>
					<td>Rp 120,000</td>
					<td>
						<a onClick="minus('<?php echo $row['id'].'/'.$row['total'];?>')" style="cursor:pointer;">
							<img src="<?php echo $config->base_url()."images/minus.png";?>" style="width:14px;margin-bottom:2px;"/> 
						</a>
						1
						<a onClick="plus('<?php echo $row['id'].'/'.$row['total'];?>')" style="cursor:pointer;">
							<img src="<?php echo $config->base_url()."images/plus.png";?>" style="width:14px;margin-bottom:2px;"/>
						</a>
					</td>
					<td>-</td>
					<td>Rp 120,000</td>
					<td><input type="checkbox"/></td>
				</tr>
				<tr>
					<td onClick="show_hide()">+</td>
					<td>
						<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Kode" required class="form-control" style="width:100px; text-align:center;">
					</td>
					<td id="nm_mkanan" onClick="show_hide()">-</td>
					<td onClick="show_hide()">-</td>
					<td onClick="show_hide()">-</td>
					<td id="qty_mkanan" onClick="show_hide()">-</td>
					<td id="hrg_mkanan" onClick="show_hide()">-</td>
					<td onClick="show_hide()">-</td>
					<td onClick="show_hide()">-</td>
					<td onClick="show_hide()">-</td>
				</tr>
				
				<tr>
					<td colspan=8; style="border-bottom-style: hidden;border-left-style: hidden;"></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;"><div style="color:red;">SUBTOTAL</div></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;">Rp 120,000</td>
				</tr>
				<tr>
					<td colspan=8; style="border-bottom-style: hidden;border-left-style: hidden;"></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;"><div style="color:red;">SERVICE</div></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;">Rp 6,000</td>
				</tr>
				<tr>
					<td colspan=8; style="border-bottom-style: hidden;border-left-style: hidden;"></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;"><div style="color:red;">PPN</div></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;">Rp 12,000</td>
				</tr>
				<tr>
					<td colspan=8; style="border-bottom-style: hidden;border-left-style: hidden;border"></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;"><div style="color:red;">TOTAL</div></td>
					<td style="border-bottom-style: dotted;border-left-style: dotted;border-right-style: dotted;">Rp 138,000</td>
				</tr>
				
			</tbody>
		</table>

	</div>
</div>
