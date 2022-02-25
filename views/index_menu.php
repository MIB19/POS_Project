<div class="sidebar" data-color="purple" data-background-color="white">

	<div class="sidebar-wrapper" style="height:100%;">
		<ul class="nav" >
			<a href="<?php echo $config->base_url();?>">
				<li class="card">
					<div style="margin: auto;">
						<img src="<?php echo $config->base_url()."icon/";?>dashboard.png" style="width:30px;display: block;margin-left: auto;margin-right: auto;margin-bottom: 10px;">
						Dashboard
					</div>
				</li>
			</a>
			
			<a href="<?php echo $config->base_url();?>laporan.html">
				<li class="card">
					<div style="margin: auto;">
						<img src="<?php echo $config->base_url()."icon/";?>report.png" style="width:40px;display: block;margin-left: auto;margin-right: auto;margin-bottom: 10px;">
						Laporan
					</div>
				</li>
			</a>
			<a href="<?php echo $config->base_url();?>index/master.html" >
				<li class="card" >
					<div style="margin: auto;">
						<img src="<?php echo $config->base_url()."icon/";?>master.png" style="width:30px;display: block;margin-left: auto;margin-right: auto;margin-bottom: 10px;">
						Master
					</div>
				</li>
			</a>
			
			<a href="<?php echo $config->base_url();?>pengaturan.html"  hidden>
				<li class="card" >
					<div style="margin: auto;">
						<img src="<?php echo $config->base_url()."icon/";?>setting.png" style="width:30px;display: block;margin-left: auto;margin-right: auto;margin-bottom: 10px;">
						Pengaturan
					</div>
				</li>
			</a>
		</ul>

	</div>
</div>
<script>
	function template(){
		var x = document.getElementById("template1");
		if (x.style.display === "none") {
			x.style.display = "block";
		} else {
			x.style.display = "none";
		}
	}
	function banner(){
		var x = document.getElementById("banner1");
		if (x.style.display === "none") {
			x.style.display = "block";
		} else {
			x.style.display = "none";
		}
	}
	function voucher(){
		var x = document.getElementById("voucher1");
		if (x.style.display === "none") {
			x.style.display = "block";
		} else {
			x.style.display = "none";
		}
	}
	function user(){
		var x = document.getElementById("user1");
		if (x.style.display === "none") {
			x.style.display = "block";
		} else {
			x.style.display = "none";
		}
	}
	function item(){
		var x = document.getElementById("item1");
		if (x.style.display === "none") {
			x.style.display = "block";
		} else {
			x.style.display = "none";
		}
	}
</script>