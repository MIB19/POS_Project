<style>
input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
	-webkit-appearance: none;
	margin: 0;
}

input[type=number] {
	-moz-appearance: textfield;
}
</style>
<link href="<?php echo $config->base_url();?>styles/table.css" rel="stylesheet" />
<script src="<?php echo $config->base_url();?>styles/st.js"></script>
<div class="card_table" style="margin-left:1%;margin-right:1%;margin-top:1%;">
	<div style="float:left; text-align:left; width:100%">
		Type &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;  
		<input type="radio" id="type_member1" name="type_member" value="male" checked="checked" onClick="tombol_pencet()"/>
		<label for="male">Member Baru</label>
		<input type="radio" id="type_member2" name="type_member" value="female" style="margin-left:10px;" onClick="tombol_pencet()"/>
		<label for="female">Member Lama</label>
		<input type="text" name="n" id="nm" placeholder="Nama Member" required class="form_inputss" style="float:right;text-align:right;width:300px" 
		value='<?php if($_REQUEST['param1']!= null){ echo $data[0]; } ?>' disabled>
		<br>
		Barcode : <input type="text" name="member_cari" id="member_cari" placeholder="barcode" 
			value='<?php if($_REQUEST['param1']!= null){ echo $_REQUEST['param1']; } ?>' onkeyup="myFunctionmember()" required class="form_inputss" style="text-align:right;width:300px">
		<br>
		<input type="text" name="saldo_member" id="saldo_member" placeholder="Sisa Saldo" required class="form_inputss" style="margin-top:-38px;float:right;text-align:right;width:300px;" 
		value='<?php if($_REQUEST['param1']!= null){ echo number_format($data[1]); } ?>' disabled>
		<div style="margin-top:16px;">
				Type Pembayaran : 
			<input type="radio" id="a20" name="a2" value="male" style="margin-left:10px;" checked="checked" onClick="radio_clik()"/>
			<label for="male">Tunai</label>
			<input type="radio" id="a21" name="a2" value="male" style="margin-left:10px;" onClick="radio_clik()"/>
			<label for="female">Debit</label>
			<input type="radio" id="a22" name="a2" value="male" style="margin-left:10px;" onClick="radio_clik()"/>
			<label for="male">Kartu Kredit</label>
		</div>
		Nominal : <input type="text" name="nominal_pop_up" id="nominal_pop_up" placeholder="nominal" required class="form_inputss" style="text-align:right;width:300px" value=''  onkeyup="enter_bayar()">
		<br>
		<a id='byar' onClick="bayar_sekarang()" class="card_pilihan_meja1" style="width:180px;float:left;margin-left:200px;height:auto;background:#987860;border-color:#987860;color:white;padding-left:16px;">
			Bayar Sekarang <img src="<?php echo $config->base_url()."images/printer.png";?>" style="width:14px;margin-bottom:2px;"/>
		</a>
	</div>
</div>

<script>
	document.getElementById("member_cari").focus();
	document.getElementById("member_cari").select();
	
	uag = '<?php echo $data[1]; ?>';

	function tombol_pencet(){
		document.getElementById("member_cari").focus();
		document.getElementById("member_cari").select();
	}
	function radio_clik(){
		document.getElementById("nominal_pop_up").focus();
		document.getElementById("nominal_pop_up").select();
	}

	function myFunctionmember() {
		input = document.getElementById("member_cari").value;
		if (input.length >= 10) {
			member_cari();
			return false;
		}
		
	}
	function enter_bayar(){
		var x = event.keyCode;
		if (event.keyCode == 13) {
			bayar_sekarang();
		}
	}
	
	function member_cari(){
		var member_cari=document.getElementById("member_cari").value;
		var a = '2';
		var b = '';
		try{
			b = '<?php echo $_REQUEST['param1'];?>';
			
		}catch{
			b = '';
		}
		if(document.getElementById("type_member1").checked === true){
			a = '1';
		}
		if(member_cari===""){
		}else if(member_cari==b){
		}else{
			$.post('<?php echo $config->base_url();?>cari_barcode/'+member_cari+'/'+a+'.html',function(data){
					$('#dunia').html(data);
					if(a == "1"){
						document.getElementById("nominal_pop_up").value = '2000000';
					}else{
						document.getElementById("nominal_pop_up").focus();
						document.getElementById("nominal_pop_up").select();
						document.getElementById("type_member2").checked = true;
					}
			});
		}
	}
	
	function bayar_sekarang(){
		var hs = 0;
		totals = parseInt(document.getElementById("nominal_pop_up").value)+parseInt(uag);
		
		if(document.getElementById("type_member1").checked === true){
			if(document.getElementById("nominal_pop_up").value == '2000000'){
				hs = 1;
			}
		}
		
		var mbbr = 0;
		if(document.getElementById("type_member1").checked === true){
			mbbr = 0;
		}else if(document.getElementById("type_member2").checked === true){
			mbbr = 1;
		}
		
		var pilihan = 1;
		if(document.getElementById("a20").checked === true){
			pilihan = 1;
		}else if(document.getElementById("a21").checked === true){
			pilihan = 2;
		}else if(document.getElementById("a22").checked === true){
			pilihan = 3;
		}
		
		if(totals <= 2000000){
			hs = 1;
		}
		
		if(hs == 1){
			open('<?php echo $config->base_url();?>print_print/<?php echo $_REQUEST['param1'];?>'+'/'+document.getElementById("nominal_pop_up").value+'/<?php echo $data[0];?>/<?php echo $data[1];?>.html');
				
			$.post('<?php echo $config->base_url();?>simpan_popups/<?php echo $_REQUEST['param1'];?>/'+mbbr+'/'+pilihan+'/'+document.getElementById("nominal_pop_up").value+'.html',function(data){
				$('#dunia').html(data);
			});
		}else{
			if(document.getElementById("nominal_pop_up").value == '2000000'){
				alert('nominal harus 2,000,000');
			}else{
				alert('maximal total deposit tidak boleh lebih dari 2,000,000');
			}
		}
	}
</script>

