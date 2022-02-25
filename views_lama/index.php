<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>
		Kollabora Caffe
	</title>
	<link href="<?php echo $config->base_url();?>styles/dataTables.css" rel="stylesheet" />
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link href="<?php echo $config->base_url();?>assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
	<link href="<?php echo $config->base_url();?>styles/style.css" rel="stylesheet" />
	
	<script src="<?php echo $config->base_url();?>styles/nm.js"></script>
	<style type="text/css" media="print">
		* { display: none; }
	</style>
	<style>
		.card_pilihan_meja1{
			background:#ffffff;
			box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
			transition: 0.3s;
			width: 15%;
			height:40px;
			border-radius: 10px;
			float: left;
			border-style: solid;
			border-color: #987860;
			color:black;
			margin: 4px;
		}
	</style>
</head>

<body class="">
	<div id="popup" class="latar_popup" style="visibility: hidden;">
		<div id="popups">
			<img onClick="close_popup()" id="exit_popup" src="<?php echo $config->base_url()."icon/";?>close.png"/>
			<div id="testerasdasd"  style="margin-top:40px;">
			</div>
		</div>
	</div>
	<div id="utk_print" style="height:auto;width:280px;background:white;margin-left:150px;">
	</div>
	<div class="wrapper ">
	
		<?php require "views/index_menu.php"; ?>
		
		<div class="main-panel">
		  <!-- Navbar -->
		  <div id="dunia" style="margin-left:20px;">
			<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
				<div class="container-fluid">
					<?php if($page_adj == "perorderan"){
						foreach($show_ok as $aaaaaa){
							$tlasd= 0;
							$tlasd1= 0;
							$asdasdasdsad =$aaaaaa['oyi'];
							
							$sqlsss	= "
								SELECT 
									DISTINCT(transaksi.id) as 'oyiss', 
									transaksi_detail.stat_print as 'oyisssssss' 
								FROM 
									`transaksi_detail`
								inner join transaksi	
								on transaksi.id = transaksi_detail.id_trans
								where 
									transaksi.status = '0' && 
									transaksi.deleted = '0' &&
									transaksi.no_meja = '$asdasdasdsad'
								order by 
									transaksi.id 
								desc"; 

							$resultssss	= $conn->query($sqlsss);
							$rowcount=mysqli_num_rows($resultssss);
						
							if($rowcount == 1){
								$recsss = $resultssss->fetch_assoc();
								if($recsss['oyisssssss']=='1'){
									$tlasd1 = $tlasd1 + 1;
								}
								$tlasd = $tlasd + 1;
							}else{
								// $tlasd = $tlasd + 1;
								// $tlasd1 = $tlasd1 + 1;
								// $try = 0;
								$ds=0;
								while($recsss = $resultssss->fetch_assoc()){
									if($try == $recsss['oyiss']){
										if($ds==1){
											if($recsss['oyisssssss']=='1'){
												$tlasd1 = $tlasd1 + 1;
												// $tlasd1 = $tlasd1 + 1;
											}if($recsss['oyisssssss']=='0'){
												$tlasd1 = $tlasd1 - 1;
											}
										}else{
											$tlasd1 = $tlasd1 + 1;
											$ds=1;
										}
										
										// $tlasd = $tlasd + 1;
										
											// $tlasd1 = $tlasd1 + 1;
									}else{
										$try = $recsss['oyiss'];
										$ds=0;
										$tlasd = $tlasd + 1;
										if($recsss['oyisssssss']=='1'){
											$tlasd1 = $tlasd1 + 1;
											$ds=1;
										}
									}
									
								}
								// }
							}
							
							// $bbb[$aaaaaa['oyi']]  = 1;
							$bbb1[$aaaaaa['oyi']] = $tlasd;
							$bbb2[$aaaaaa['oyi']] = $tlasd1;
							if($bbb1[$aaaaaa['oyi']] == $bbb2[$aaaaaa['oyi']]){
								$bbb[$aaaaaa['oyi']] = 2;
							}else{
								if($bbb2[$aaaaaa['oyi']] == 0){
									$bbb[$aaaaaa['oyi']] = 1;
								}else{
									$bbb[$aaaaaa['oyi']] = 3;
								}
							}
						}
						?>
						<div style="float:left;width:85%;">
							<a href="<?php echo $config->base_url()."";?>index/101.html">
								<div class="card_pilihan_meja1" width="100px;float:left;" <?php if($bbb[101] == '1'){ ?> style="background:#D84949;color:white;"
								<?php }else if($bbb[101] == '2'){ ?> style="background:yellow;color:black;" 
								<?php }else if($bbb[101] == '3'){ ?> style="background:gray;color:white;" <?php } ?> >
									<div style="margin: auto;width: 10%; text-align: center;float:left;">
										<b><?php if($bbb[101] != null){ echo $bbb1[101]; }?></b>
									</div>
									<div <?php if($bbb[101] != null){ ?>style="margin: auto;width: 80%;margin-top: 4px; text-align: center;float:left;" <?php }else{ ?> style="margin: auto;width: 100%;margin-top: 4px; text-align: center;float:left;"<?php } ?> >
										<b>VIP</b>
									</div>
									<div style="margin: auto;width: 10%; text-align: center;float:left;">
										<b><?php if($bbb[101] != null){ echo $bbb2[101]; }?></b>
									</div>
								</div>
							</a>
							<a href="<?php echo $config->base_url()."";?>index/102.html">
								<div class="card_pilihan_meja1" width="100px;float:left;"  <?php if($bbb[102] == '1'){ ?> style="background:#D84949;color:white;"
								<?php }else if($bbb[102] == '2'){ ?> style="background:yellow;color:black;" 
								<?php }else if($bbb[102] == '3'){ ?> style="background:gray;color:white;" <?php } ?> >
									<div style="margin: auto;width: 10%; text-align: center;float:left;">
										<b><?php if($bbb[102] != null){ echo $bbb1[102]; }?></b>
									</div>
									<div <?php if($bbb[102] != null){ ?>style="margin: auto;width: 80%;margin-top: 4px; text-align: center;float:left;" <?php }else{ ?> style="margin: auto;width: 100%;margin-top: 4px; text-align: center;float:left;"<?php } ?> >
										<b>Delivery</b>
									</div>
									<div style="margin: auto;width: 10%; text-align: center;float:left;">
										<b><?php if($bbb[102] != null){ echo $bbb2[102]; }?></b>
									</div>
								</div>
							</a>
							<a href="<?php echo $config->base_url()."";?>index/103.html">
								<div class="card_pilihan_meja1" width="100px;float:left;"  <?php if($bbb[103] == '1'){ ?> style="background:#D84949;color:white;"
								<?php }else if($bbb[103] == '2'){ ?> style="background:yellow;color:black;" 
								<?php }else if($bbb[103] == '3'){ ?> style="background:gray;color:white;" <?php } ?> >
									<div style="margin: auto;width: 10%; text-align: center;float:left;">
										<b><?php if($bbb[103] != null){ echo $bbb1[103]; }?></b>
									</div>
									<div <?php if($bbb[103] != null){ ?>style="margin: auto;width: 80%;margin-top: 4px; text-align: center;float:left;" <?php }else{ ?> style="margin: auto;width: 100%;margin-top: 4px; text-align: center;float:left;"<?php } ?> >
										<b>Grab</b>
									</div>
									<div style="margin: auto;width: 10%; text-align: center;float:left;">
										<b><?php if($bbb[103] != null){ echo $bbb2[103]; }?></b>
									</div>
								</div>
							</a>
							<a href="<?php echo $config->base_url()."";?>index/104.html">
								<div class="card_pilihan_meja1" width="100px;float:left;"  <?php if($bbb[104] == '1'){ ?> style="background:#D84949;color:white;"
								<?php }else if($bbb[104] == '2'){ ?> style="background:yellow;color:black;" 
								<?php }else if($bbb[104] == '3'){ ?> style="background:gray;color:white;" <?php } ?> >
									<div style="margin: auto;width: 10%; text-align: center;float:left;">
										<b><?php if($bbb[104] != null){ echo $bbb1[104]; }?></b>
									</div>
									<div <?php if($bbb[104] != null){ ?>style="margin: auto;width: 80%;margin-top: 4px; text-align: center;float:left;" <?php }else{ ?> style="margin: auto;width: 100%;margin-top: 4px; text-align: center;float:left;"<?php } ?> >
										<b>Gojek</b>
									</div>
									<div style="margin: auto;width: 10%; text-align: center;float:left;">
										<b><?php if($bbb[104] != null){ echo $bbb2[104]; }?></b>
									</div>
								</div>
							</a>
							<a href="<?php echo $config->base_url()."";?>index/105.html">
								<div class="card_pilihan_meja1" width="100px;" width="100px;float:left;"  <?php if($bbb[105] == '1'){ ?> style="background:#D84949;color:white;"
								<?php }else if($bbb[105] == '2'){ ?> style="background:yellow;color:black;" 
								<?php }else if($bbb[105] == '3'){ ?> style="background:gray;color:white;" <?php } ?> >
									<div style="margin: auto;width: 10%; text-align: center;float:left;">
										<b><?php if($bbb[105] != null){ echo $bbb1[105]; }?></b>
									</div>
									<div <?php if($bbb[105] != null){ ?>style="margin: auto;width: 80%;margin-top: 4px; text-align: center;float:left;" <?php }else{ ?> style="margin: auto;width: 100%;margin-top: 4px; text-align: center;float:left;"<?php } ?> >
										<b>Marketing</b>
									</div>
									<div style="margin: auto;width: 10%; text-align: center;float:left;">
										<b><?php if($bbb[105] != null){ echo $bbb2[105]; }?></b>
									</div>
								</div>
							</a>
							<a href="<?php echo $config->base_url()."";?>index/106.html">
								<div class="card_pilihan_meja1" width="100px;" width="100px;float:left;"  <?php if($bbb[106] == '1'){ ?> style="background:#D84949;color:white;"
								<?php }else if($bbb[106] == '2'){ ?> style="background:yellow;color:black;" 
								<?php }else if($bbb[106] == '3'){ ?> style="background:gray;color:white;" <?php } ?> >
									<div style="margin: auto;width: 10%; text-align: center;float:left;">
										<b><?php if($bbb[106] != null){ echo $bbb1[106]; }?></b>
									</div>
									<div <?php if($bbb[106] != null){ ?>style="margin: auto;width: 80%;margin-top: 4px; text-align: center;float:left;" <?php }else{ ?> style="margin: auto;width: 100%;margin-top: 4px; text-align: center;float:left;"<?php } ?> >
										<b>Operasional</b>
									</div>
									<div style="margin: auto;width: 10%; text-align: center;float:left;">
										<b><?php if($bbb[106] != null){ echo $bbb2[106]; }?></b>
									</div>
								</div>
							</a>
						</div>
						<div class="navbar-wrapper">
							<a class="navbar-brand" href="javascript:;"></a>
						</div>
						
						<button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
							<span class="sr-only">Toggle navigation</span>
							<span class="navbar-toggler-icon icon-bar"></span>
							<span class="navbar-toggler-icon icon-bar"></span>
							<span class="navbar-toggler-icon icon-bar"></span>
						</button>
						<div class="collapse navbar-collapse justify-content-end">
							<ul class="navbar-nav">
								<li class="nav-item dropdown">
									<a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onClick="kluarexit()">
										<i class="material-icons"><img src="<?php echo $config->base_url();?>images/exit.png" style="width:45px;height:45px;"/></i>
									</a>
								</li>

							</ul>		
						</div>
					<?php } ?>
					
				</div>
				
			</nav>
			<?php if($page_adj == "perorderan"){ ?>
			<br>
			<br>
			<br>
			<?php } ?>
					
				<?php
					if(isset($page_adj)){
						require "views/".$page_atr.$page_adj.".php";	
					}
				?>
			</div>
		</div>
		
	</div>
		<script src="<?php echo $config->base_url();?>styles/jquery-3.5.1.js"></script>
		<script src="<?php echo $config->base_url();?>styles/datatables.js"></script>
		<script>
			$(document).ready(function() {
			$('#example').DataTable( {
				"pagingType": "full_numbers"
			} );
		} );
		</script>
		<!--<script src="<?php echo $config->base_url();?>assets/js/core/jquery.min.js"></script>-->
		<script src="<?php echo $config->base_url();?>assets/js/core/popper.min.js"></script>
		<script src="<?php echo $config->base_url();?>assets/js/core/bootstrap-material-design.min.js"></script>
		<script src="<?php echo $config->base_url();?>assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
		<script src="<?php echo $config->base_url();?>assets/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>
	<script>
		var y = document.getElementById("input1");
		
		var x = document.getElementById("popup");
		function open_pop_up(param){
			y.value  = ""+param;
			x.style.visibility = "visible" ;
		}
		function close_popup(){
			x.style.visibility = "hidden" ;
		}
	</script>
	<script>
		$(document).ready(function () {
			$('#dtBasicExample').DataTable();
			$('.dataTables_length').addClass('bs-select');
		});
		$(document).on('keydown', function(e) {
			if((e.ctrlKey || e.metaKey) && (e.key == "p" || e.charCode == 16 || e.charCode == 112 || e.keyCode == 80) ){
				// alert("Please use tombol print");
				e.cancelBubble = true;
				e.preventDefault();

				e.stopImmediatePropagation();
			}if (e.which === 8 && !$(e.target).is("input, textarea")) {
				// alert("test");
				e.preventDefault();
			}  
		});
		function kluarexit(){
			if(confirm('Apakah Anda Yakin ?')){
				open('<?php echo $config->base_url();?>exit.html','self');
			}
		}
	</script>
</body>

</html>