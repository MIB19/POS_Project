<style type="text/css" media="print">
    @page {
        size: auto;
        margin: 0mm;
    }
</style>
<style>
	.print_layar{
		width:240px;
		height:500px;
		margin-left:8px;
		margin-right:8px;
	}
		
	.print_layar #text_print{
		color:black;
		margin-top:1px;
		font-size:12px;
		text-align:center;
	}
	.print_layar #text_judul_print{
		color:black;
		margin-top:8px;
		margin-bottom:5px;
		font-size:14px;
		font-weight:bold;
		text-align:left;
	}
	.print_layar #text_judul_print_bill{
		color:black;
		margin-top:8px;
		margin-bottom:12px;
		font-size:14px;
		font-weight:bold;
		text-align:center;
	}
	.print_layar #text_deskripsi_print_left{
		color:black;
		width:32%;
		font-size:11px;
		text-align:left;
		float:left;
	}
	.print_layar #text_deskripsi_print_right{
		color:black;
		width:68%;
		font-size:11px;
		text-align:left;
		float:right;
	}
	.print_layar #text_deskripsi_uang_print_left{
		color:black;
		width:42%;
		font-size:11px;
		text-align:left;
		float:left;
	}
	.print_layar #text_deskripsi_uang_print_right{
		color:black;
		width:58%;
		font-size:11px;
		text-align:left;
		float:right;
	}
	.print_layar #text_print_biasa{
		color:black;
		font-size:11px;
		text-align:left;
	}
	.print_layar #garis_print{
		color:black;
		font-size:11px;
		text-align:center;
		margin-bottom:6px;
	}
	.print_layar #garis_printbwh{
		font-size:11px;
		text-align:center;
		margin-top:38px;
		margin-bottom:15px;
	}
	.print_layar #garis_printbwh_bill{
		font-size:11px;
		text-align:center;
		margin-top:38px;
		margin-bottom:15px;
		margin-bottom:-2px;
	}
</style>

	<div class="print_layar">
		<img src="<?php echo $config->base_url();?>images/cilik.png" style="height:28px;display: block; margin-left: auto;margin-right: auto;"/>
		<div id="text_print">
			Raya Kupang Indah 51 - Surabaya<br>
			0821-33593698
		</div>

		<div id="text_judul_print">
			DEPOSIT MEMBER
		</div>

		<div id="text_deskripsi_print_left">
			NO. MEMBER
		</div>
		<div id="text_deskripsi_print_right">
			: <?php echo $id;?>
		</div>
		<div id="text_deskripsi_print_left">
			Nama
		</div>
		<div id="text_deskripsi_print_right">
			: <?php echo $id2;?>
		</div>
		<div id="text_print_biasa">
			<?php echo date("d-m-Y H:i:s");?>
		</div>
		<div id="garis_print">
			=======================================
		</div>
		
		<div id="text_deskripsi_uang_print_left">
			TOPUP DEPOSIT
		</div>
		<div id="text_deskripsi_uang_print_right">
			: <?php echo number_format($id1);?>
		</div>
		<div id="text_deskripsi_uang_print_left">
			TOTAL DEPOSIT
		</div>
		<div id="text_deskripsi_uang_print_right">
			: <?php echo number_format($id1+$id3);?>
		</div>
		<div id="garis_printbwh">
			=======================================
		</div>
		
		<div id="text_print">
			THANK YOU<br>
			PLEASE COME AGAIN
		</div>
		<div style="height:25px;"></div>
	</div>
	<div class="w3-clear"></div>
</body>

<script type="text/javascript">
		<?php 
			$b = 'RUNDLL32 PRINTUI.DLL,PrintUIEntry /y /n "EPSON A"';
			//system($b);
		?>
		window.onload=function(){ 
			//window.print();
			//window.close();
		}
	</script>