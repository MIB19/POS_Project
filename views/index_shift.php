<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="<?php echo $config->base_url();?>assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>
		Kollabora Caffe
	</title>
	<link href="<?php echo $config->base_url();?>styles/dataTables.css" rel="stylesheet" />
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link href="<?php echo $config->base_url();?>assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
	<link href="<?php echo $config->base_url();?>styles/style.css" rel="stylesheet" />
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
	<div id="popup" class="latar_popup">
		<div class="main-panel"  style="position: fixed;
			z-index: 3;
			background:white;
			text-align:center;
			width:500px;
			height:auto;
			color:#887860;
			padding: 10px;
			border-radius:20px;
			align-content: center;
			box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
			transition: 0.3s;
			font-size:14px;
			margin-top:80px;
			left: 50%;
			transform: translate(-50%, 0%);margin-top:100px;">
			<a href="<?php echo $config->base_url()."";?>index/shift1.html">
				<div class="card1" style="margin-left:1%;margin-right:1%;width:48%;font-size:16px;">
					<b>SHIFT 1</b>
					<div style="width:100%; text-align: center;padding: 5px;font-size: 13px;">
						<img src="<?php echo $config->base_url()."icon/";?>login.png" style="width:50%;display: block;margin-left: auto;margin-right: auto;margin-bottom: 10px;"/>
						
					</div>
				</div>
			</a>
			<a href="<?php echo $config->base_url()."";?>index/shift2.html">
				<div class="card1" style="margin-left:1%;margin-right:1%;width:48%;font-size:16px;">
					<b>SHIFT 2</b>
					<div style="width:100%; text-align: center;padding: 5px;font-size: 13px;">
						<img src="<?php echo $config->base_url()."icon/";?>login.png" style="width:50%;display: block;margin-left: auto;margin-right: auto;margin-bottom: 10px;"/>
						
					</div>
				</div>
			</a>
		</div>
	</div>
	<div class="wrapper ">
	
		<?php require "views/index_menu.php"; ?>
		
	
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
		document.getElementById("username").focus();
		var y = document.getElementById("input1");
		
		var x = document.getElementById("popup");
		function open_pop_up(param){
			y.value  = ""+param;
			x.style.visibility = "visible" ;
		}
		function close_popup(param){
			x.style.visibility = "hidden" ;
		}
		function kluarexit(){
			if(confirm('Apakah Anda Yakin ?')){
				open('<?php echo $config->base_url();?>exit.html','self');
			}
		}
	</script>
	<script>
		$(document).ready(function () {
			$('#dtBasicExample').DataTable();
			$('.dataTables_length').addClass('bs-select');
		});
	</script>
</body>

</html>