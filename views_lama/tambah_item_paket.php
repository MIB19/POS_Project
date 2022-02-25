<div class="card_table" style="margin-left:1%;margin-right:1%;margin-top:1%;">
	<div style="width:100%; text-align: left;padding: 5px;font-size: 13px;">
		<form id="form1" action="simpan_item_paket.html" method="post" onsubmit="return check(this.action);" class="form-horizontal form-label-left">  
			<div style="margin-top:10px">
				<label class="control-label col-md-12 col-sm-12 col-xs-12" for="last-name">Nama Paket  <span class="required">*</span></label>
				<br>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<select name="text1" class="form_input">
						<?php foreach($show_kategori as $row){ ?>
							<option value="<?php echo $row['kode'];?>"><?php echo $row['nama'];?></option>
						<?php } ?>
						
					</select>
				</div>
			</div>
			<div style="margin-top:10px">
				<label class="control-label col-md-12 col-sm-12 col-xs-12" for="last-name">Nama Barang  <span class="required">*</span></label>
				<br>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<select name="text2" class="form_input">
						<?php foreach($show as $row){
								if($row['kode_kat'] != 'PK'){ ?>
							<option value="<?php echo $row['kode'];?>"><?php echo $row['nama'];?></option>
								<?php } } ?>
						
					</select>
				</div>
			</div>
			<div style="margin-top:10px">
				<label class="control-label col-md-12 col-sm-12 col-xs-12" for="last-name">qty<span class="required">*</span></label>
				<br>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<input type="number" name="text3" placeholder="qty" value="1" required class="form_input">
				</div>
			</div>
			
			<div class="ln_solid"></div>
			<div class="form-group">
				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
					<button class="btn btn-primary" type="reset">Reset</button>
					<button type="submit" class="btn btn-success">Submit</button>
				</div>
			</div>
		</form>	
	
	</div>
</div>