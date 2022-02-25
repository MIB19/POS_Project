<div class="card_table" style="margin-left:1%;margin-right:1%;margin-top:1%;">
	<div style="width:100%; text-align: left;padding: 5px;font-size: 13px;">
		<form id="form1" action="update_member.html" method="post" onsubmit="return check(this.action);" class="form-horizontal form-label-left">  
			<input type="hidden" name="id_user" placeholder="id_user" value="<?php echo $id_user; ?>" required class="form-control col-md-10 col-xs-12">		
			<div style="margin-top:10px">
				<label class="control-label col-md-12 col-sm-12 col-xs-12" for="last-name">Nama<span class="required">*</span></label>
				<br>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<input type="text" name="nama" placeholder="nama" value="<?php echo $nama;?>" required class="form_input" disabled>
				</div>
			</div>
			<div style="margin-top:10px">
				<label class="control-label col-md-12 col-sm-12 col-xs-12" for="last-name">nama  <span class="required">*</span></label>
				<br>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<select name="id_user_category" class="form_input">
						<option value="<?php echo $id_user_category; ?>"><?php echo $nama_category; ?></option>
						<?php 
							foreach($show_user_category as $row){
								if($id_user_category != $row['id_category']){
						?>
									<option value="<?php echo $row['id_category']; ?>"><?php echo $row['nama_category']; ?></option>
						<?php 
								}
							} 
						?>
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