<div class="card_table" style="margin-left:1%;margin-right:1%;margin-top:1%;">
	<div style="width:100%; text-align: left;padding: 5px;font-size: 13px;">
		<form id="form1" action="update_item.html" method="post" onsubmit="return check(this.action);" class="form-horizontal form-label-left">
			<input type="hidden" name="no" placeholder="id_user" value="<?php echo $no; ?>" required class="form-control col-md-10 col-xs-12">		
			<div style="margin-top:10px">
				<label class="control-label col-md-12 col-sm-12 col-xs-12" for="last-name">Kode<span class="required">*</span></label>
				<br>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<input type="text" name="kode" placeholder="kode" value="<?php echo $kode;?>"  required class="form_input">
				</div>
			</div>
			<div style="margin-top:10px">
				<label class="control-label col-md-12 col-sm-12 col-xs-12" for="last-name">Nama Barang<span class="required">*</span></label>
				<br>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<input type="text" name="nama" placeholder="Nama" value="<?php echo $nama;?>" required class="form_input">
				</div>
			</div>
			<div style="margin-top:10px">
				<label class="control-label col-md-12 col-sm-12 col-xs-12" for="last-name">Kategory  <span class="required">*</span></label>
				<br>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<select name="mkat2" class="form_input">
						<option value="<?php echo $mkat2;?>"><?php echo $name;?></option>
						<?php 
						foreach($show_kategori as $row){
							if($mkat2 != $row['kode']){
								?>
							<option value="<?php echo $row['kode'];?>"><?php echo $row['nama'];?></option>
						<?php } } ?>
						
					</select>
				</div>
			</div>
			<div style="margin-top:10px">
				<label class="control-label col-md-12 col-sm-12 col-xs-12" for="last-name">Harga<span class="required">*</span></label>
				<br>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<input type="text" name="harga1" placeholder="nominal" value="<?php echo $hrg;?>" required class="form_input">
				</div>
			</div>
			<div style="margin-top:10px">
				<label class="control-label col-md-12 col-sm-12 col-xs-12" for="last-name">Harga Grab<span class="required">*</span></label>
				<br>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<input type="text" name="harga2" placeholder="nominal" value="<?php echo $nhargagrab;?>" required class="form_input">
				</div>
			</div><div style="margin-top:10px">
				<label class="control-label col-md-12 col-sm-12 col-xs-12" for="last-name">Harga Gojek<span class="required">*</span></label>
				<br>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<input type="text" name="harga3" placeholder="nominal" value="<?php echo $nhargagojek;?>" required class="form_input">
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