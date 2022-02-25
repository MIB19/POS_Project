<div class="card_table" style="margin-left:1%;margin-right:1%;margin-top:1%;">
	<div style="width:100%; text-align: left;padding: 5px;font-size: 13px;">
		<form id="form1" action="update_user_pegawai.html" method="post" onsubmit="return check(this.action);" class="form-horizontal form-label-left">  
			<input type="hidden" name="no" placeholder="id_user" value="<?php echo $no; ?>" required class="form-control col-md-10 col-xs-12">		
			
			<div style="margin-top:10px">
				<label class="control-label col-md-12 col-sm-12 col-xs-12" for="last-name">Username<span class="required">*</span></label>
				<br>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<input type="text" name="username" placeholder="Username ..." value="<?php echo $ckode;?>" required class="form_input" disabled>
				</div>
			</div>
			<div style="margin-top:10px">
				<label class="control-label col-md-12 col-sm-12 col-xs-12" for="last-name">Password<span class="required">*</span></label>
				<br>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<input type="Password" name="password" placeholder="Password ..." value="<?php echo $cpwd;?>" required class="form_input">
				</div>
			</div>
			<div style="margin-top:10px">
				<label class="control-label col-md-12 col-sm-12 col-xs-12" for="last-name">Akses  <span class="required">*</span></label>
				<br>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<select name="akses" class="form_input">
						<?php if($nlvl == 2){ ?>
							<option value="2">Waiter</option>
							<option value="1">Kasir</option>
							<option value="0">HOD</option>
						<?php }else if($nlvl == 1){ ?>
							<option value="1">Kasir</option>
							<option value="2">Waiter</option>
							<option value="0">HOD</option>
						<?php }else{ ?>
							<option value="0">HOD</option>
							<option value="2">Waiter</option>
							<option value="1">Kasir</option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div style="margin-top:10px">
				<label class="control-label col-md-12 col-sm-12 col-xs-12" for="last-name">Keterangan<span class="required">*</span></label>
				<br>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<select name="keterangan" class="form_input">
						<?php if($keterangan == "WAITER"){ ?>
							<option value="WAITER">Waiter</option>
							<option value="KASIR">KASIR</option>
							<option value="CAPTAIN">CAPTAIN</option>
						<?php }else if($keterangan == "KASIR"){ ?>
							<option value="KASIR">KASIR</option>
							<option value="WAITER">Waiter</option>
							<option value="CAPTAIN">CAPTAIN</option>
						<?php }else{ ?>
							<option value="CAPTAIN">CAPTAIN</option>
							<option value="WAITER">Waiter</option>
							<option value="KASIR">KASIR</option>
						<?php } ?>
					</select>
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