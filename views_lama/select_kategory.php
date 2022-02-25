<div class="card_table" style="margin-left:1%;margin-right:1%;margin-top:1%;">
	<div style="width:100%; text-align: left;padding: 5px;font-size: 13px;">
		<form id="form1" action="update_kategory.html" method="post" onsubmit="return check(this.action);" class="form-horizontal form-label-left">  
			<input type="hidden" name="no" placeholder="id_user" value="<?php echo $no; ?>" required class="form-control col-md-10 col-xs-12">		
			<div style="margin-top:10px">
				<label class="control-label col-md-12 col-sm-12 col-xs-12" for="last-name">kode<span class="required">*</span></label>
				<br>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<input type="text" name="kode" placeholder="kode" value="<?php echo $kode;?>" required class="form_input" disabled>
				</div>
			</div>
			<div style="margin-top:10px">
				<label class="control-label col-md-12 col-sm-12 col-xs-12" for="last-name">nama<span class="required">*</span></label>
				<br>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<input type="text" name="nama" placeholder="nama" value="<?php echo $nama;?>" required class="form_input">
				</div>
			</div>
			<div style="margin-top:10px">
				<label class="control-label col-md-12 col-sm-12 col-xs-12" for="last-name">print<span class="required">*</span></label>
				<br>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<input type="text" name="mprint" placeholder="print" value="<?php echo $mprint;?>" required class="form_input">
				</div>
			</div>
			<div style="margin-top:10px">
				<label class="control-label col-md-12 col-sm-12 col-xs-12" for="last-name">dis otomatis  <span class="required">*</span></label>
				<br>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<select name="dis_otmtis" class="form_input">
						<?php 
							if($dis_otmtis == '0'){
						?>
								<option value="0">Ya</option>
								<option value="1">Tidak</option>
						<?php
							}else{
						?>
								<option value="1">Tidak</option>
								<option value="0">Ya</option>
						<?php
							}
						?>
					</select>
				</div>
			</div>
			<div style="margin-top:10px">
				<label class="control-label col-md-12 col-sm-12 col-xs-12" for="last-name">dis<span class="required">*</span></label>
				<br>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<input type="text" name="dis" placeholder="dis" value="<?php echo $dis;?>" required class="form_input">
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