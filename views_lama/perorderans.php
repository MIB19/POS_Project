
<?php 

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

<div id="pilihan_card" style="margin-left:1%;margin-right:1%;margin-top:1%;display:block;">
	<div>
		<div style="margin:16px">
			<a href="<?php echo $config->base_url()."";?>index/19.html">
				<div class="card_pilihan_meja" <?php if($bbb[19] == '1'){ ?> style="background:#D84949;color:white;"
					<?php }else if($bbb[19] == '2'){ ?> style="background:yellow;color:black;" 
					<?php }else if($bbb[19] == '3'){ ?> style="background:gray;color:white;" <?php } ?> >
					<div style="margin: auto;width: 10%; text-align: center;float:left;">
						<b><?php if($bbb[19] != null){ echo $bbb1[19]; }?></b>
					</div>
					<div <?php if($bbb[19] != null){ ?>style="margin: auto;width: 80%;margin-top: 14px; text-align: center;float:left"
							<?php }else{ ?> style="margin: auto;width: 100%;margin-top: 14px; text-align: center;float:left" <?php } ?>>
						<b>19</b>
					</div>
					<div style="margin: auto;width: 10%; text-align: center;float:left;">
						<b><?php if($bbb[19] != null){ echo $bbb2[19]; }?></b>
					</div>
				</div>
			</a>
		</div>
		<div style="margin:16px">
			<a href="<?php echo $config->base_url()."";?>index/18.html">
				<div class="card_pilihan_meja" <?php if($bbb[18] == '1'){ ?> style="background:#D84949;color:white;"
					<?php }else if($bbb[18] == '2'){ ?> style="background:yellow;color:black;" 
					<?php }else if($bbb[18] == '3'){ ?> style="background:gray;color:white;" <?php } ?> >
					<div style="margin: auto;width: 10%; text-align: center;float:left;">
						<b><?php if($bbb[18] != null){ echo $bbb1[18]; }?></b>
					</div>
					<div <?php if($bbb[18] != null){ ?>style="margin: auto;width: 80%;margin-top: 14px; text-align: center;float:left"
							<?php }else{ ?> style="margin: auto;width: 100%;margin-top: 14px; text-align: center;float:left" <?php } ?>>
						<b>18</b>
					</div>
					<div style="margin: auto;width: 10%; text-align: center;float:left;">
						<b><?php if($bbb[18] != null){ echo $bbb2[18]; }?></b>
					</div>
				</div>
			</a>
		</div>
		<div style="margin:16px">
			<a href="<?php echo $config->base_url()."";?>index/17.html">
				<div class="card_pilihan_meja" <?php if($bbb[17] == '1'){ ?> style="background:#D84949;color:white;"
					<?php }else if($bbb[17] == '2'){ ?> style="background:yellow;color:black;" 
					<?php }else if($bbb[17] == '3'){ ?> style="background:gray;color:white;" <?php } ?> >
					<div style="margin: auto;width: 10%; text-align: center;float:left;">
						<b><?php if($bbb[17] != null){ echo $bbb1[17]; }?></b>
					</div>
					<div <?php if($bbb[17] != null){ ?>style="margin: auto;width: 80%;margin-top: 14px; text-align: center;float:left"
							<?php }else{ ?> style="margin: auto;width: 100%;margin-top: 14px; text-align: center;float:left" <?php } ?>>
						<b>17</b>
					</div>
					<div style="margin: auto;width: 10%; text-align: center;float:left;">
						<b><?php if($bbb[17] != null){ echo $bbb2[17]; }?></b>
					</div>
				</div>
			</a>
		</div>
		<div style="margin:16px">
			<a href="<?php echo $config->base_url()."";?>index/16.html">
				<div class="card_pilihan_meja" <?php if($bbb[16] == '1'){ ?> style="background:#D84949;color:white;"
					<?php }else if($bbb[16] == '2'){ ?> style="background:yellow;color:black;" 
					<?php }else if($bbb[16] == '3'){ ?> style="background:gray;color:white;" <?php } ?> >
					<div style="margin: auto;width: 10%; text-align: center;float:left;">
						<b><?php if($bbb[16] != null){ echo $bbb1[16]; }?></b>
					</div>
					<div <?php if($bbb[16] != null){ ?>style="margin: auto;width: 80%;margin-top: 14px; text-align: center;float:left"
							<?php }else{ ?> style="margin: auto;width: 100%;margin-top: 14px; text-align: center;float:left" <?php } ?>>
						<b>16</b>
					</div>
					<div style="margin: auto;width: 10%; text-align: center;float:left;">
						<b><?php if($bbb[16] != null){ echo $bbb2[16]; }?></b>
					</div>
				</div>
			</a>
		</div>
		<div style="margin:16px">
			<a href="<?php echo $config->base_url()."";?>index/15.html">
				<div class="card_pilihan_meja" <?php if($bbb[15] == '1'){ ?> style="background:#D84949;color:white;"
					<?php }else if($bbb[15] == '2'){ ?> style="background:yellow;color:black;" 
					<?php }else if($bbb[15] == '3'){ ?> style="background:gray;color:white;" <?php } ?> >
					<div style="margin: auto;width: 10%; text-align: center;float:left;">
						<b><?php if($bbb[15] != null){ echo $bbb1[15]; }?></b>
					</div>
					<div <?php if($bbb[15] != null){ ?>style="margin: auto;width: 80%;margin-top: 14px; text-align: center;float:left"
							<?php }else{ ?> style="margin: auto;width: 100%;margin-top: 14px; text-align: center;float:left" <?php } ?>>
						<b>15</b>
					</div>
					<div style="margin: auto;width: 10%; text-align: center;float:left;">
						<b><?php if($bbb[15] != null){ echo $bbb2[15]; }?></b>
					</div>
				</div>
			</a>
		</div>
		<div style="margin:16px">
			<a href="<?php echo $config->base_url()."";?>index/14.html">
				<div class="card_pilihan_meja" <?php if($bbb[14] == '1'){ ?> style="background:#D84949;color:white;"
					<?php }else if($bbb[14] == '2'){ ?> style="background:yellow;color:black;" 
					<?php }else if($bbb[14] == '3'){ ?> style="background:gray;color:white;" <?php } ?> >
					<div style="margin: auto;width: 10%; text-align: center;float:left;">
						<b><?php if($bbb[14] != null){ echo $bbb1[14]; }?></b>
					</div>
					<div <?php if($bbb[14] != null){ ?>style="margin: auto;width: 80%;margin-top: 14px; text-align: center;float:left"
							<?php }else{ ?> style="margin: auto;width: 100%;margin-top: 14px; text-align: center;float:left" <?php } ?>>
						<b>14</b>
					</div>
					<div style="margin: auto;width: 10%; text-align: center;float:left;">
						<b><?php if($bbb[14] != null){ echo $bbb2[14]; }?></b>
					</div>
				</div>
			</a>
		</div>
		<div style="margin:16px">
			<a href="<?php echo $config->base_url()."";?>index/13.html">
				<div class="card_pilihan_meja" <?php if($bbb[13] == '1'){ ?> style="background:#D84949;color:white;"
					<?php }else if($bbb[13] == '2'){ ?> style="background:yellow;color:black;" 
					<?php }else if($bbb[13] == '3'){ ?> style="background:gray;color:white;" <?php } ?> >
					<div style="margin: auto;width: 10%; text-align: center;float:left;">
						<b><?php if($bbb[13] != null){ echo $bbb1[13]; }?></b>
					</div>
					<div <?php if($bbb[13] != null){ ?>style="margin: auto;width: 80%;margin-top: 14px; text-align: center;float:left"
							<?php }else{ ?> style="margin: auto;width: 100%;margin-top: 14px; text-align: center;float:left" <?php } ?>>
						<b>13</b>
					</div>
					<div style="margin: auto;width: 10%; text-align: center;float:left;">
						<b><?php if($bbb[13] != null){ echo $bbb2[13]; }?></b>
					</div>
				</div>
			</a>
		</div>
		<div style="margin:16px">
			<a href="<?php echo $config->base_url()."";?>index/12.html">
				<div class="card_pilihan_meja" <?php if($bbb[12] == '1'){ ?> style="background:#D84949;color:white;"
					<?php }else if($bbb[12] == '2'){ ?> style="background:yellow;color:black;" 
					<?php }else if($bbb[12] == '3'){ ?> style="background:gray;color:white;" <?php } ?> >
					<div style="margin: auto;width: 10%; text-align: center;float:left;">
						<b><?php if($bbb[12] != null){ echo $bbb1[12]; }?></b>
					</div>
					<div <?php if($bbb[12] != null){ ?>style="margin: auto;width: 80%;margin-top: 14px; text-align: center;float:left"
							<?php }else{ ?> style="margin: auto;width: 100%;margin-top: 14px; text-align: center;float:left" <?php } ?>>
						<b>12</b>
					</div>
					<div style="margin: auto;width: 10%; text-align: center;float:left;">
						<b><?php if($bbb[12] != null){ echo $bbb2[12]; }?></b>
					</div>
				</div>
			</a>
		</div>
		<div style="margin:16px">
			<a href="<?php echo $config->base_url()."";?>index/1.html">
				<div class="card_pilihan_meja"  <?php if($bbb[1] == '1'){ ?> style="background:#D84949;color:white;float:right;"
					<?php }else if($bbb[1] == '2'){ ?> style="background:yellow;color:black;float:right;" 
					<?php }else if($bbb[1] == '3'){ ?> style="background:gray;color:white;float:right;" <?php }else{ ?>
					style="float:right;" <?php } ?>>
					<div style="margin: auto;width: 10%; text-align: center;float:left;">
						<b><?php if($bbb[1] != null){ echo $bbb1[1]; }?></b>
					</div>
					<div <?php if($bbb[1] != null){ ?> style="margin: auto;width: 80%;margin-top: 14px; text-align: center;float:left;"
					 <?php }else{ ?> style="margin: auto;width: 100%;margin-top: 14px; text-align: center;float:left;"<?php } ?> >
						<b>1</b>
					</div>
					<div style="margin: auto;width: 10%; text-align: center;float:left;">
						<b><?php if($bbb[1] != null){ echo $bbb2[1]; }?></b>
					</div>
				</div>
			</a>
		</div>

	</div>
	
	<div class="w3-clear"></div>
	<div>
		<div style="margin:16px">
			<a href="<?php echo $config->base_url()."";?>index/20.html">
				<div class="card_pilihan_meja_kiri"  
					<?php if($bbb[20] == '1'){ ?> style="background:#D84949;color:white;"
					<?php }else if($bbb[20] == '2'){ ?> style="background:yellow;color:black;" 
					<?php }else if($bbb[20] == '3'){ ?> style="background:gray;color:white;" <?php } ?> >
					<div style="margin: auto;width: 10%; text-align: center;float:left;">
						<b><?php if($bbb[20] != null){ echo $bbb1[20]; }?></b>
					</div>
					<div  <?php if($bbb[20] != null){ ?>style="margin: auto;float:left;width: 80%;margin-top: 84px; text-align: center;font-size:30px;"
					<?php }else{ ?>style="margin: auto;width: 100%;float:left;margin-top: 84px; text-align: center;font-size:30px;" <?php } ?>>
						<b>20</b>
					</div>
					<div style="margin: auto;width: 10%; text-align: center;float:left;">
						<b><?php if($bbb[20] != null){ echo $bbb2[20]; }?></b>
					</div>
				</div>
			</a>
		</div>
		<div style="margin:16px">
			<div class="card_pilihan_meja_bar">
				<img src="<?php echo $config->base_url()."";?>images/logo_text.png" style="height:100%;width:100%;display: block;margin-left: auto;margin-right: auto;"/>
			</div>
		</div>
		<div style="margin:16px">
			<div class="card_pilihan_meja_samping_bar">
				<a href="<?php echo $config->base_url()."";?>index/33.html">
					<div class="card_dalam_bar" 
						<?php if($bbb[33] == '1'){ ?> style="background:#D84949;color:white;width:80%;"
						<?php }else if($bbb[33] == '2'){ ?> style="background:yellow;color:black;width:80%;" 
						<?php }else if($bbb[33] == '3'){ ?> style="background:gray;color:white;width:80%;" 
						<?php }else{ ?> style="width:80%;" 
						<?php }	?>>
						<div style="margin: auto;width: 10%; text-align: center;float:left;">
							<b><?php if($bbb[33] != null){ echo $bbb1[33]; }?></b>
						</div>
						<div <?php if($bbb[33] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;"
							<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;"<?php } ?> >
							<b>33</b>
						</div>
						<div style="margin: auto;width: 10%; text-align: center;float:left;">
							<b><?php if($bbb[33] != null){ echo $bbb2[33]; }?></b>
						</div>
					</div>
				</a>
				<a href="<?php echo $config->base_url()."";?>index/34.html">
					<div class="card_dalam_bar" 
						<?php if($bbb[34] == '1'){ ?> style="background:#D84949;color:white;margin-left:20px;width:80%;"
						<?php }else if($bbb[34] == '2'){ ?> style="background:yellow;color:black;margin-left:20px;width:80%;" 
						<?php }else if($bbb[34] == '3'){ ?> style="background:gray;color:white;margin-left:20px;width:80%;" 
						<?php }else{ ?>style="margin-left:20px; width:80%;"
						<?php }	?>>
						<div style="margin: auto;width: 10%; text-align: center;float:left;">
							<b><?php if($bbb[34] != null){ echo $bbb1[34]; }?></b>
						</div>
						<div <?php if($bbb[34] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;"
							<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;"<?php } ?> >
							<b>34</b>
						</div>
						<div style="margin: auto;width: 10%; text-align: center;float:left;">
							<b><?php if($bbb[34] != null){ echo $bbb2[34]; }?></b>
						</div>
					</div>
				</a>
				<a href="<?php echo $config->base_url()."";?>index/35.html">
					<div class="card_dalam_bar"
						<?php if($bbb[35] == '1'){ ?> style="background:#D84949;color:white;margin-left:40px;width:80%;"
						<?php }else if($bbb[35] == '2'){ ?> style="background:yellow;color:black;margin-left:40px;width:80%;" 
						<?php }else if($bbb[35] == '3'){ ?> style="background:gray;color:white;margin-left:40px;width:80%;" 
						<?php }else{ ?>style="margin-left:40px; width:80%;"
						<?php }	?>>
						<div style="margin: auto;width: 10%; text-align: center;float:left;">
							<b><?php if($bbb[35] != null){ echo $bbb1[35]; }?></b>
						</div>
						<div  <?php if($bbb[34] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;"
							<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;"<?php } ?> >
							<b>35</b>
						</div>
						<div style="margin: auto;width: 10%; text-align: center;float:left;">
							<b><?php if($bbb[35] != null){ echo $bbb2[35]; }?></b>
						</div>
					</div>
				</a>
				<a href="<?php echo $config->base_url()."";?>index/36.html">
					<div  class="card_dalam_bar"
						<?php if($bbb[36] == '1'){ ?> style="background:#D84949;color:white;margin-left:40px;width:80%;"
						<?php }else if($bbb[36] == '2'){ ?> style="background:yellow;color:black;margin-left:40px;width:80%;" 
						<?php }else if($bbb[36] == '3'){ ?> style="background:gray;color:white;margin-left:40px;width:80%;" 
						<?php }else{ ?>style="margin-left:40px; width:80%;"
						<?php }	?>>
						<div style="margin: auto;width: 10%; text-align: center;float:left;">
							<b><?php if($bbb[36] != null){ echo $bbb1[36]; }?></b>
						</div>
						<div <?php if($bbb[36] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;"
							<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;"<?php } ?> >
							<b>36</b>
						</div>
						<div style="margin: auto;width: 10%; text-align: center;float:left;">
							<b><?php if($bbb[36] != null){ echo $bbb2[36]; }?></b>
						</div>
					</div>
				</a>
				<a href="<?php echo $config->base_url()."";?>index/37.html">
					<div class="card_dalam_bar" 
						<?php if($bbb[37] == '1'){ ?> style="background:#D84949;color:white;margin-left:20px;width:80%;"
						<?php }else if($bbb[37] == '2'){ ?> style="background:yellow;color:black;margin-left:20px;width:80%;" 
						<?php }else if($bbb[37] == '3'){ ?> style="background:gray;color:white;margin-left:20px;width:80%;" 
						<?php }else{ ?>style="margin-left:20px; width:80%;"
						<?php }	?>>
						<div style="margin: auto;width: 10%; text-align: center;float:left;">
							<b><?php if($bbb[37] != null){ echo $bbb1[37]; }?></b>
						</div>
						<div <?php if($bbb[37] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;"
							<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;"<?php } ?> >
							<b>37</b>
						</div>
						<div style="margin: auto;width: 10%; text-align: center;float:left;">
							<b><?php if($bbb[37] != null){ echo $bbb2[37]; }?></b>
						</div>
					</div>
				</a>
				<a href="<?php echo $config->base_url()."";?>index/38.html">
					<div class="card_dalam_bar" 
						<?php if($bbb[38] == '1'){ ?> style="background:#D84949;color:white;width:80%;"
						<?php }else if($bbb[38] == '2'){ ?> style="background:yellow;color:black;width:80%;" 
						<?php }else if($bbb[38] == '3'){ ?> style="background:gray;color:white;width:80%;" 
						<?php }else{ ?>style=" width:80%;"
						<?php }	?>>
						<div style="margin: auto;width: 10%; text-align: center;float:left;">
							<b><?php if($bbb[38] != null){ echo $bbb1[38]; }?></b>
						</div>
						<div <?php if($bbb[38] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;"
							<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;"<?php } ?> >
							<b>38</b>
						</div>
						<div style="margin: auto;width: 10%; text-align: center;float:left;">
							<b><?php if($bbb[38] != null){ echo $bbb2[38]; }?></b>
						</div>
					</div>
				</a>
			</div>
		
			<div class="card_pilihan_meja_samping_turun">
				<a href="<?php echo $config->base_url()."";?>index/11.html">
					<div class="card_dalam_bar" 
						<?php if($bbb[11] == '1'){ ?> style="background:#D84949;color:white;width:97%;height:23%;margin-top:10px;margin-bottom:10px;"
						<?php }else if($bbb[11] == '2'){ ?> style="background:yellow;color:black;width:97%;height:23%;margin-top:10px;margin-bottom:10px;" 
						<?php }else if($bbb[11] == '3'){ ?> style="background:gray;color:white;width:97%;height:23%;margin-top:10px;margin-bottom:10px;" 
						<?php }else{ ?>style=" width:97%;height:23%;margin-top:10px;margin-bottom:10px;"
						<?php }	?>>
						<div style="margin: auto;width: 10%; text-align: center;float:left;">
							<b><?php if($bbb[11] != null){ echo $bbb1[11]; }?></b>
						</div>
						<div 
						<?php if($bbb[11] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;margin-top: 8px;"
							<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;margin-top: 8px;"<?php } ?>>
							<b>11</b>
						</div>
						<div style="margin: auto;width: 10%; text-align: center;float:left;">
							<b><?php if($bbb[11] != null){ echo $bbb2[11]; }?></b>
						</div>
					</div>
				</a>
				<a href="<?php echo $config->base_url()."";?>index/10.html">
					<div class="card_dalam_bar" 
						<?php if($bbb[10] == '1'){ ?> style="background:#D84949;color:white;width:97%;height:23%;margin-top:10px;margin-bottom:10px;"
						<?php }else if($bbb[10] == '2'){ ?> style="background:yellow;color:black;width:97%;height:23%;margin-top:10px;margin-bottom:10px;" 
						<?php }else if($bbb[10] == '3'){ ?> style="background:gray;color:white;width:97%;height:23%;margin-top:10px;margin-bottom:10px;" 
						<?php }else{ ?>style=" width:97%;height:23%;margin-top:10px;margin-bottom:10px;"
						<?php }	?>>
						<div style="margin: auto;width: 10%; text-align: center;float:left;">
							<b><?php if($bbb[10] != null){ echo $bbb1[10]; }?></b>
						</div>
						<div 
						<?php if($bbb[10] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;margin-top: 8px;"
							<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;margin-top: 8px;"<?php } ?>>
							<b>10</b>
						</div>
						<div style="margin: auto;width: 10%; text-align: center;float:left;">
							<b><?php if($bbb[10] != null){ echo $bbb2[10]; }?></b>
						</div>
					</div>
				</a>
				<a href="<?php echo $config->base_url()."";?>index/9.html">
					<div class="card_dalam_bar" 
						<?php if($bbb[9] == '1'){ ?> style="background:#D84949;color:white;width:97%;height:23%;margin-top:10px;margin-bottom:10px;"
						<?php }else if($bbb[9] == '2'){ ?> style="background:yellow;color:black;width:97%;height:23%;margin-top:10px;margin-bottom:10px;" 
						<?php }else if($bbb[9] == '3'){ ?> style="background:gray;color:white;width:97%;height:23%;margin-top:10px;margin-bottom:10px;" 
						<?php }else{ ?>style=" width:97%;height:23%;margin-top:10px;margin-bottom:10px;"
						<?php }	?>>
						<div style="margin: auto;width: 10%; text-align: center;float:left;">
							<b><?php if($bbb[9] != null){ echo $bbb1[9]; }?></b>
						</div>
						<div 
						<?php if($bbb[9] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;margin-top: 8px;"
							<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;margin-top: 8px;"<?php } ?>>
							<b>9</b>
						</div>
						<div style="margin: auto;width: 10%; text-align: center;float:left;">
							<b><?php if($bbb[9] != null){ echo $bbb2[9]; }?></b>
						</div>
					</div>
				</a>
			</div>
		
			<div class="card_pilihan_meja_samping_pojok">
				<a href="<?php echo $config->base_url()."";?>index/2.html">
					<div class="card_dalam_bar"  
						<?php if($bbb[2] == '1'){ ?> style="background:#D84949;color:white;width:97%;height:23%;margin-top:8px;"
						<?php }else if($bbb[2] == '2'){ ?> style="background:yellow;color:black;width:97%;height:23%;margin-top:8px;" 
						<?php }else if($bbb[2] == '3'){ ?> style="background:gray;color:white;width:97%;height:23%;margin-top:8px;" 
						<?php }else{ ?>style=" width:97%;height:23%;margin-top:8px;"
						<?php }	?>>
						<div style="margin: auto;width: 10%; text-align: center;float:left;">
							<b><?php if($bbb[2] != null){ echo $bbb1[2]; }?></b>
						</div>
						<div 
						<?php if($bbb[2] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;margin-top: 8px;"
							<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;margin-top: 8px;"<?php } ?>>
							<b>2</b>
						</div>
						<div style="margin: auto;width: 10%; text-align: center;float:left;">
							<b><?php if($bbb[2] != null){ echo $bbb2[2]; }?></b>
						</div>
					</div>
				</a>
				<a href="<?php echo $config->base_url()."";?>index/3.html">
					<div class="card_dalam_bar" 
						<?php if($bbb[3] == '1'){ ?> style="background:#D84949;color:white;width:97%;height:23%;margin-top:8px;"
						<?php }else if($bbb[3] == '2'){ ?> style="background:yellow;color:black;width:97%;height:23%;margin-top:8px;" 
						<?php }else if($bbb[3] == '3'){ ?> style="background:gray;color:white;width:97%;height:23%;margin-top:8px;" 
						<?php }else{ ?>style=" width:97%;height:23%;margin-top:8px;"
						<?php }	?>>
						<div style="margin: auto;width: 10%; text-align: center;float:left;">
							<b><?php if($bbb[3] != null){ echo $bbb1[3]; }?></b>
						</div>
						<div 
						<?php if($bbb[3] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;margin-top: 8px;"
							<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;margin-top: 8px;"<?php } ?>>
							<b>3</b>
						</div>
						<div style="margin: auto;width: 10%; text-align: center;float:left;">
							<b><?php if($bbb[3] != null){ echo $bbb2[3]; }?></b>
						</div>
					</div>
				</a>
				<a href="<?php echo $config->base_url()."";?>index/4.html">
					<div class="card_dalam_bar" 
						<?php if($bbb[4] == '1'){ ?> style="background:#D84949;color:white;width:97%;height:23%;margin-top:8px;"
						<?php }else if($bbb[4] == '2'){ ?> style="background:yellow;color:black;width:97%;height:23%;margin-top:8px;" 
						<?php }else if($bbb[4] == '3'){ ?> style="background:gray;color:white;width:97%;height:23%;margin-top:8px;" 
						<?php }else{ ?>style=" width:97%;height:23%;margin-top:8px;"
						<?php }	?>>
						<div style="margin: auto;width: 10%; text-align: center;float:left;">
							<b><?php if($bbb[4] != null){ echo $bbb1[4]; }?></b>
						</div>
						<div 
						<?php if($bbb[4] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;margin-top: 8px;"
							<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;margin-top: 8px;"<?php } ?>>
							<b>4</b>
						</div>
						<div style="margin: auto;width: 10%; text-align: center;float:left;">
							<b><?php if($bbb[4] != null){ echo $bbb2[4]; }?></b>
						</div>
					</div>
				</a>
				<a href="<?php echo $config->base_url()."";?>index/5.html">
					<div class="card_dalam_bar" 
						<?php if($bbb[5] == '1'){ ?> style="background:#D84949;color:white;width:97%;height:23%;margin-top:10px;"
						<?php }else if($bbb[5] == '2'){ ?> style="background:yellow;color:black;width:97%;height:23%;margin-top:10px;" 
						<?php }else if($bbb[5] == '3'){ ?> style="background:gray;color:white;width:97%;height:23%;margin-top:10px;" 
						<?php }else{ ?>style=" width:97%;height:23%;margin-top:10px;"
						<?php }	?>>
						<div style="margin: auto;width: 10%; text-align: center;float:left;">
							<b><?php if($bbb[5] != null){ echo $bbb1[5]; }?></b>
						</div>
						<div 
						<?php if($bbb[5] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;margin-top: 8px;"
							<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;margin-top: 8px;"<?php } ?>>
							<b>5</b>
						</div>
						<div style="margin: auto;width: 10%; text-align: center;float:left;">
							<b><?php if($bbb[5] != null){ echo $bbb2[5]; }?></b>
						</div>
					</div>
				</a>
			</div>
		
		</div>
	
	</div>
	<div style="clear: left;"></div>
	
	<div>
		<div style= "width:100%;">
			<div class="card_pilihan_custom">
				<a href="<?php echo $config->base_url()."";?>index/107.html">
					<div class="card_dalam_barssss" 
						<?php if($bbb[107] == '1'){ ?> style="background:#D84949;color:white;width:80%;height:40%;float:left;margin-left:5%;"
						<?php }else if($bbb[107] == '2'){ ?> style="background:yellow;color:black;width:80%;height:40%;float:left;margin-left:5%;" 
						<?php }else if($bbb[107] == '3'){ ?> style="background:gray;color:white;width:80%;height:40%;float:left;margin-left:5%;" 
						<?php }else{ ?>style="width:80%;height:40%;float:left;margin-left:5%;background:#987860;"
						<?php }	?>>
						<div style="margin: auto;width: 10%; text-align: center;float:left;">
							<b><?php if($bbb[107] != null){ echo $bbb1[107]; }?></b>
						</div>
						<div 
						<?php if($bbb[107] != null){ ?> style="margin: auto;margin: auto;width: 40%;text-align: center;margin-top: 10px;float:left;margin-left: 20%;margin-right: 20%;"
							<?php }else{ ?> style="margin: auto;width: 50%;text-align: center;float:left;margin-top: 10px;margin-left: 25%;margin-right: 25%;"<?php } ?>>
							<img src="<?php echo $config->base_url()."";?>images/owner.png" style="height:160%;width:160%;display: block;margin-left: -30%;margin-top: -20%;"/>
						</div>
						<div style="margin: auto;width: 10%; text-align: center;float:left;">
							<b><?php if($bbb[107] != null){ echo $bbb2[107]; }?></b>
						</div>
					</div>
				</a>
				<a href="<?php echo $config->base_url()."";?>deposite_member.html">
					<div class="card_dalam_barssss" style="width:80%;height:40%;float:left;margin-left:5%;margin-top:5%;">
						<div style="margin: auto;width: 50%;text-align: center;margin-top: 10px;">
							<img src="<?php echo $config->base_url()."";?>images/deposit.png" style="height:100%;width:100%;display: block;margin-left: auto;margin-right: auto;"/>
						</div>
					</div>
				</a>
			</div>
			<div style="margin:16px">
				<div class="card_pilihan_meja_bawah">
					<a href="<?php echo $config->base_url()."";?>index/21.html">
						<div class="card_dalam_bar"
							<?php if($bbb[21] == '1'){ ?> style="background:#D84949;color:white;width:15%;height:50px;float:left;margin-left:1%;"
							<?php }else if($bbb[21] == '2'){ ?> style="background:yellow;color:black;width:15%;height:50px;float:left;margin-left:1%;" 
							<?php }else if($bbb[21] == '3'){ ?> style="background:gray;color:white;width:15%;height:50px;float:left;margin-left:1%;" 
							<?php }else{ ?>style="width:15%;height:50px;float:left;margin-left:1%;"
							<?php }	?>>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[21] != null){ echo $bbb1[21]; }?></b>
							</div>
							<div  
								<?php if($bbb[21] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;margin-top: 10px;"
								<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;margin-top: 10px;"<?php } ?>>
								<b>21</b>
							</div>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[21] != null){ echo $bbb2[21]; }?></b>
							</div>
						</div>
					</a>
					<a href="<?php echo $config->base_url()."";?>index/22.html">
						<div class="card_dalam_bar" 
							<?php if($bbb[22] == '1'){ ?> style="background:#D84949;color:white;width:15%;height:50px;float:left;margin-left:1%;"
							<?php }else if($bbb[22] == '2'){ ?> style="background:yellow;color:black;width:15%;height:50px;float:left;margin-left:1%;" 
							<?php }else if($bbb[22] == '3'){ ?> style="background:gray;color:white;width:15%;height:50px;float:left;margin-left:1%;" 
							<?php }else{ ?>style="width:15%;height:50px;float:left;margin-left:1%;"
							<?php }	?>>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[22] != null){ echo $bbb1[22]; }?></b>
							</div>
							<div  
								<?php if($bbb[22] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;margin-top: 10px;"
								<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;margin-top: 10px;"<?php } ?>>
								<b>22</b>
							</div>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[22] != null){ echo $bbb2[22]; }?></b>
							</div>
						</div>
					</a>
					<a href="<?php echo $config->base_url()."";?>index/23.html">
						<div class="card_dalam_bar" 
							<?php if($bbb[23] == '1'){ ?> style="background:#D84949;color:white;width:15%;height:50px;float:left;margin-left:1%;"
							<?php }else if($bbb[23] == '2'){ ?> style="background:yellow;color:black;width:15%;height:50px;float:left;margin-left:1%;" 
							<?php }else if($bbb[23] == '3'){ ?> style="background:gray;color:white;width:15%;height:50px;float:left;margin-left:1%;" 
							<?php }else{ ?>style="width:15%;height:50px;float:left;margin-left:1%;"
							<?php }	?>>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[23] != null){ echo $bbb1[23]; }?></b>
							</div>
							<div  
								<?php if($bbb[23] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;margin-top: 10px;"
								<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;margin-top: 10px;"<?php } ?>>
								<b>23</b>
							</div>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[23] != null){ echo $bbb2[23]; }?></b>
							</div>
						</div>
					</a>
					<a href="<?php echo $config->base_url()."";?>index/24.html">
						<div class="card_dalam_bar" 
							<?php if($bbb[24] == '1'){ ?> style="background:#D84949;color:white;width:15%;height:50px;float:left;margin-left:1%;"
							<?php }else if($bbb[24] == '2'){ ?> style="background:yellow;color:black;width:15%;height:50px;float:left;margin-left:1%;" 
							<?php }else if($bbb[24] == '3'){ ?> style="background:gray;color:white;width:15%;height:50px;float:left;margin-left:1%;" 
							<?php }else{ ?>style="width:15%;height:50px;float:left;margin-left:1%;"
							<?php }	?>>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[24] != null){ echo $bbb1[24]; }?></b>
							</div>
							<div  
								<?php if($bbb[24] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;margin-top: 10px;"
								<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;margin-top: 10px;"<?php } ?>>
								<b>24</b>
							</div>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[24] != null){ echo $bbb2[24]; }?></b>
							</div>
						</div>
					</a>
					<a href="<?php echo $config->base_url()."";?>index/25.html">
						<div class="card_dalam_bar" 
							<?php if($bbb[25] == '1'){ ?> style="background:#D84949;color:white;width:15%;height:50px;float:left;margin-left:1%;"
							<?php }else if($bbb[25] == '2'){ ?> style="background:yellow;color:black;width:15%;height:50px;float:left;margin-left:1%;" 
							<?php }else if($bbb[25] == '3'){ ?> style="background:gray;color:white;width:15%;height:50px;float:left;margin-left:1%;" 
							<?php }else{ ?>style="width:15%;height:50px;float:left;margin-left:1%;"
							<?php }	?>>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[25] != null){ echo $bbb1[25]; }?></b>
							</div>
							<div  
								<?php if($bbb[25] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;margin-top: 10px;"
								<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;margin-top: 10px;"<?php } ?>>
								<b>25</b>
							</div>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[25] != null){ echo $bbb2[25]; }?></b>
							</div>
						</div>
					</a>
					<a href="<?php echo $config->base_url()."";?>index/26.html">
						<div class="card_dalam_bar" 
							<?php if($bbb[26] == '1'){ ?> style="background:#D84949;color:white;width:15%;height:50px;float:left;margin-left:1%;"
							<?php }else if($bbb[26] == '2'){ ?> style="background:yellow;color:black;width:15%;height:50px;float:left;margin-left:1%;" 
							<?php }else if($bbb[26] == '3'){ ?> style="background:gray;color:white;width:15%;height:50px;float:left;margin-left:1%;" 
							<?php }else{ ?>style="width:15%;height:50px;float:left;margin-left:1%;"
							<?php }	?>>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[26] != null){ echo $bbb1[26]; }?></b>
							</div>
							<div  
								<?php if($bbb[26] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;margin-top: 10px;"
								<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;margin-top: 10px;"<?php } ?>>
								<b>26</b>
							</div>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[26] != null){ echo $bbb2[26]; }?></b>
							</div>
						</div>
					</a>
					
					<a href="<?php echo $config->base_url()."";?>index/32.html">
						<div class="card_dalam_bar" 
							<?php if($bbb[32] == '1'){ ?> style="background:#D84949;color:white;width:15%;height:50px;float:left;margin-left:1%;;margin-top:10px;"
							<?php }else if($bbb[32] == '2'){ ?> style="background:yellow;color:black;width:15%;height:50px;float:left;margin-left:1%;;margin-top:10px;" 
							<?php }else if($bbb[32] == '3'){ ?> style="background:gray;color:white;width:15%;height:50px;float:left;margin-left:1%;;margin-top:10px;" 
							<?php }else{ ?>style="width:15%;height:50px;float:left;margin-left:1%;;margin-top:10px;"
							<?php }	?>>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[32] != null){ echo $bbb1[32]; }?></b>
							</div>
							<div  
								<?php if($bbb[32] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;margin-top: 10px;"
								<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;margin-top: 10px;"<?php } ?>>
								<b>32</b>
							</div>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[32] != null){ echo $bbb2[32]; }?></b>
							</div>
						</div>
					</a>
					<a href="<?php echo $config->base_url()."";?>index/31.html">
						<div class="card_dalam_bar" <?php if($bbb[31] == '1'){ ?> style="background:#D84949;color:white;width:15%;height:50px;float:left;margin-left:1%;;margin-top:10px;"
							<?php }else if($bbb[31] == '2'){ ?> style="background:yellow;color:black;width:15%;height:50px;float:left;margin-left:1%;;margin-top:10px;" 
							<?php }else if($bbb[31] == '3'){ ?> style="background:gray;color:white;width:15%;height:50px;float:left;margin-left:1%;;margin-top:10px;" 
							<?php }else{ ?>style="width:15%;height:50px;float:left;margin-left:1%;;margin-top:10px;"
							<?php }	?>>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[31] != null){ echo $bbb1[31]; }?></b>
							</div>
							<div  
								<?php if($bbb[31] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;margin-top: 10px;"
								<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;margin-top: 10px;"<?php } ?>>
								<b>31</b>
							</div>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[31] != null){ echo $bbb2[31]; }?></b>
							</div>
						</div>
					</a>
					<a href="<?php echo $config->base_url()."";?>index/30.html">
					<div class="card_dalam_bar"  <?php if($bbb[30] == '1'){ ?> style="background:#D84949;color:white;width:15%;height:50px;float:left;margin-left:1%;;margin-top:10px;"
							<?php }else if($bbb[30] == '2'){ ?> style="background:yellow;color:black;width:15%;height:50px;float:left;margin-left:1%;;margin-top:10px;" 
							<?php }else if($bbb[30] == '3'){ ?> style="background:gray;color:white;width:15%;height:50px;float:left;margin-left:1%;;margin-top:10px;" 
							<?php }else{ ?>style="width:15%;height:50px;float:left;margin-left:1%;;margin-top:10px;"
							<?php }	?>>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[30] != null){ echo $bbb1[30]; }?></b>
							</div>
							<div  
								<?php if($bbb[30] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;margin-top: 10px;"
								<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;margin-top: 10px;"<?php } ?>>
								<b>30</b>
							</div>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[30] != null){ echo $bbb2[30]; }?></b>
							</div>
					</div>
					</a>
					<a href="<?php echo $config->base_url()."";?>index/29.html">
						<div class="card_dalam_bar"  <?php if($bbb[29] == '1'){ ?> style="background:#D84949;color:white;width:15%;height:50px;float:left;margin-left:1%;;margin-top:10px;"
							<?php }else if($bbb[29] == '2'){ ?> style="background:yellow;color:black;width:15%;height:50px;float:left;margin-left:1%;;margin-top:10px;" 
							<?php }else if($bbb[29] == '3'){ ?> style="background:gray;color:white;width:15%;height:50px;float:left;margin-left:1%;;margin-top:10px;" 
							<?php }else{ ?>style="width:15%;height:50px;float:left;margin-left:1%;;margin-top:10px;"
							<?php }	?>>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[29] != null){ echo $bbb1[29]; }?></b>
							</div>
							<div  
								<?php if($bbb[29] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;margin-top: 10px;"
								<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;margin-top: 10px;"<?php } ?>>
								<b>29</b>
							</div>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[29] != null){ echo $bbb2[29]; }?></b>
							</div>
						</div>
					</a>
					<a href="<?php echo $config->base_url()."";?>index/28.html">
						<div class="card_dalam_bar"  <?php if($bbb[28] == '1'){ ?> style="background:#D84949;color:white;width:15%;height:50px;float:left;margin-left:1%;;margin-top:10px;"
							<?php }else if($bbb[28] == '2'){ ?> style="background:yellow;color:black;width:15%;height:50px;float:left;margin-left:1%;;margin-top:10px;" 
							<?php }else if($bbb[28] == '3'){ ?> style="background:gray;color:white;width:15%;height:50px;float:left;margin-left:1%;;margin-top:10px;" 
							<?php }else{ ?>style="width:15%;height:50px;float:left;margin-left:1%;;margin-top:10px;"
							<?php }	?>>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[28] != null){ echo $bbb1[28]; }?></b>
							</div>
							<div  
								<?php if($bbb[28] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;margin-top: 10px;"
								<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;margin-top: 10px;"<?php } ?>>
								<b>28</b>
							</div>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[28] != null){ echo $bbb2[28]; }?></b>
							</div>
						</div>
					</a>
					<a href="<?php echo $config->base_url()."";?>index/27.html">
						<div class="card_dalam_bar"  <?php if($bbb[27] == '1'){ ?> style="background:#D84949;color:white;width:15%;height:50px;float:left;margin-left:1%;;margin-top:10px;"
							<?php }else if($bbb[27] == '2'){ ?> style="background:yellow;color:black;width:15%;height:50px;float:left;margin-left:1%;;margin-top:10px;" 
							<?php }else if($bbb[27] == '3'){ ?> style="background:gray;color:white;width:15%;height:50px;float:left;margin-left:1%;;margin-top:10px;" 
							<?php }else{ ?>style="width:15%;height:50px;float:left;margin-left:1%;;margin-top:10px;"
							<?php }	?>>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[27] != null){ echo $bbb1[27]; }?></b>
							</div>
							<div  
								<?php if($bbb[27] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;margin-top: 10px;"
								<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;margin-top: 10px;"<?php } ?>>
								<b>27</b>
							</div>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[27] != null){ echo $bbb2[27]; }?></b>
							</div>
						</div>
					</a>
					<a href="<?php echo $config->base_url()."";?>index/0.html">
						<div class="card_dalam_bar"
						  <?php if($bbb[0] == '1'){ ?> style="background:#D84949;color:white;width:98%;height:50px;float:left;margin-left:1%;margin-top:10px;"
							<?php }else if($bbb[0] == '2'){ ?> style="background:yellow;color:black;width:98%;height:50px;float:left;margin-left:1%;margin-top:10px;" 
							<?php }else if($bbb[0] == '3'){ ?> style="background:gray;color:white;width:98%;height:50px;float:left;margin-left:1%;margin-top:10px;" 
							<?php }else{ ?>style="width:98%;height:50px;float:left;margin-left:1%;margin-top:10px;"
							<?php }	?>>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[0] != null){ echo $bbb1[0]; }?></b>
							</div>
							<div 
							<?php if($bbb[0] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;margin-top: 10px;"
								<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;margin-top: 10px;"<?php } ?>>
								<b>Meeting Room</b>
							</div>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[0] != null){ echo $bbb2[0]; }?></b>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
		<div style= "width:100%;">
			<div style="margin:16px">
				<div class="card_pilihan_meja_bawah_kanan">
					<a href="<?php echo $config->base_url()."";?>index/8.html">
						<div class="card_dalam_bar" 
							<?php if($bbb[8] == '1'){ ?> style="background:#D84949;color:white;width:45%;height:50px;margin-right:10px;"
							<?php }else if($bbb[8] == '2'){ ?> style="background:yellow;color:black;width:45%;height:50px;margin-right:10px;" 
							<?php }else if($bbb[8] == '3'){ ?> style="background:gray;color:white;width:45%;height:50px;margin-right:10px;" 
							<?php }else{ ?>style="width:45%;height:50px;margin-right:10px;"
							<?php }	?>>
							
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[8] != null){ echo $bbb1[8]; }?></b>
							</div>
							<div 
							<?php if($bbb[8] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;margin-top: 10px;"
								<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;margin-top: 10px;"<?php } ?>>
								<b>8</b>
							</div>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[8] != null){ echo $bbb2[8]; }?></b>
							</div>
						</div>
					</a>
					<a href="<?php echo $config->base_url()."";?>index/7.html">
						<div class="card_dalam_bar" 
							<?php if($bbb[7] == '1'){ ?> style="background:#D84949;color:white;width:45%;height:50px;float:right;"
							<?php }else if($bbb[7] == '2'){ ?> style="background:yellow;color:black;width:45%;height:50px;float:right;" 
							<?php }else if($bbb[7] == '3'){ ?> style="background:gray;color:white;width:45%;height:50px;float:right;" 
							<?php }else{ ?>style="width:45%;height:50px;float:right;"
							<?php }	?>>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[7] != null){ echo $bbb1[7]; }?></b>
							</div>
							<div 
							<?php if($bbb[7] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;margin-top: 10px;"
								<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;margin-top: 10px;"<?php } ?>>
								<b>7</b>
							</div>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[7] != null){ echo $bbb2[7]; }?></b>
							</div>
						</div>
					</a>
					<a href="<?php echo $config->base_url()."";?>index/39.html">
						<div class="card_dalam_bar" 
							<?php if($bbb[39] == '1'){ ?> style="background:#D84949;color:white;width:70%;height:50px;margin-top:10px;float:right;"
							<?php }else if($bbb[39] == '2'){ ?> style="background:yellow;color:black;width:70%;height:50px;margin-top:10px;float:right;" 
							<?php }else if($bbb[39] == '3'){ ?> style="background:gray;color:white;width:70%;height:50px;margin-top:10px;float:right;" 
							<?php }else{ ?>style="width:70%;height:50px;margin-top:10px;float:right;"
							<?php }	?>>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[39] != null){ echo $bbb1[39]; }?></b>
							</div>
							<div 
							<?php if($bbb[39] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;margin-top: 10px;"
								<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;margin-top: 10px;"<?php } ?>>
								<b>39</b>
							</div>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[39] != null){ echo $bbb2[39]; }?></b>
							</div>
						</div>
					</a>
					<a href="<?php echo $config->base_url()."";?>index/49.html">
						<div class="card_dalam_bar" 
							<?php if($bbb[49] == '1'){ ?> style="background:#D84949;color:white;width:15%;height:50px;margin-top:95px;float:left;"
							<?php }else if($bbb[49] == '2'){ ?> style="background:yellow;color:black;width:15%;height:50px;margin-top:95px;float:left;" 
							<?php }else if($bbb[49] == '3'){ ?> style="background:gray;color:white;width:15%;height:50px;margin-top:95px;float:left;" 
							<?php }else{ ?>style="width:15%;height:50px;margin-top:95px;float:left;"
							<?php }	?>>
							
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[49] != null){ echo $bbb1[49]; }?></b>
							</div>
							<div 
							<?php if($bbb[49] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;margin-top: 10px;"
								<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;margin-top: 10px;"<?php } ?>>
								<b>49</b>
							</div>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[49] != null){ echo $bbb2[49]; }?></b>
							</div>
						</div>
					</a>
					<a href="<?php echo $config->base_url()."";?>index/48.html">
						<div class="card_dalam_bar" 
							<?php if($bbb[48] == '1'){ ?> style="background:#D84949;color:white;width:15%;height:50px;margin-top:34px;float:left;"
							<?php }else if($bbb[48] == '2'){ ?> style="background:yellow;color:black;width:15%;height:50px;margin-top:34px;float:left;" 
							<?php }else if($bbb[48] == '3'){ ?> style="background:gray;color:white;width:15%;height:50px;margin-top:95px;float:left;" 
							<?php }else{ ?>style="width:15%;height:50px;margin-top:34px;float:left;"
							<?php }	?>>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[48] != null){ echo $bbb1[48]; }?></b>
							</div>
							<div 
							<?php if($bbb[48] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;margin-top: 10px;"
								<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;margin-top: 10px;"<?php } ?>>
								<b>48</b>
							</div>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[48] != null){ echo $bbb2[48]; }?></b>
							</div>
						</div>
					</a>
					<a href="<?php echo $config->base_url()."";?>index/47.html">
						<div class="card_dalam_bar" 
							<?php if($bbb[47] == '1'){ ?> style="background:#D84949;color:white;width:15%;height:50px;margin-top:34px;float:left;"
							<?php }else if($bbb[47] == '2'){ ?> style="background:yellow;color:black;width:15%;height:50px;margin-top:34px;float:left;" 
							<?php }else if($bbb[47] == '3'){ ?> style="background:gray;color:white;width:15%;height:50px;margin-top:34px;float:left;" 
							<?php }else{ ?>style="width:15%;height:50px;margin-top:34px;float:left;"
							<?php }	?>>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[47] != null){ echo $bbb1[49]; }?></b>
							</div>
							<div 
							<?php if($bbb[47] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;margin-top: 10px;"
								<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;margin-top: 10px;"<?php } ?>>
								<b>47</b>
							</div>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[47] != null){ echo $bbb2[49]; }?></b>
							</div>
						</div>
					</a>
					<a href="<?php echo $config->base_url()."";?>index/46.html">
						<div class="card_dalam_bar" 
							<?php if($bbb[46] == '1'){ ?> style="background:#D84949;color:white;width:15%;height:50px;margin-top:34px;float:left;"
							<?php }else if($bbb[46] == '2'){ ?> style="background:yellow;color:black;width:15%;height:50px;margin-top:34px;float:left;" 
							<?php }else if($bbb[46] == '3'){ ?> style="background:gray;color:white;width:15%;height:50px;margin-top:34px;float:left;" 
							<?php }else{ ?>style="width:15%;height:50px;margin-top:34px;float:left;"
							<?php }	?>>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[46] != null){ echo $bbb1[46]; }?></b>
							</div>
							<div 
							<?php if($bbb[46] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;margin-top: 10px;"
								<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;margin-top: 10px;"<?php } ?>>
								<b>46</b>
							</div>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[46] != null){ echo $bbb2[46]; }?></b>
							</div>
						</div>
					</a>
					<a href="<?php echo $config->base_url()."";?>index/45.html">
						<div class="card_dalam_bar" 
							<?php if($bbb[45] == '1'){ ?> style="background:#D84949;color:white;width:15%;height:50px;margin-top:34px;float:left;"
							<?php }else if($bbb[45] == '2'){ ?> style="background:yellow;color:black;width:15%;height:50px;margin-top:34px;float:left;" 
							<?php }else if($bbb[45] == '3'){ ?> style="background:gray;color:white;width:15%;height:50px;margin-top:34px;float:left;" 
							<?php }else{ ?>style="width:15%;height:50px;margin-top:34px;float:left;"
							<?php }	?>>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[45] != null){ echo $bbb1[45]; }?></b>
							</div>
							<div 
							<?php if($bbb[45] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;margin-top: 10px;"
								<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;margin-top: 10px;"<?php } ?>>
								<b>45</b>
							</div>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[45] != null){ echo $bbb2[45]; }?></b>
							</div>
						</div>
					</a>
					<a href="<?php echo $config->base_url()."";?>index/44.html">
						<div class="card_dalam_bar" 
							<?php if($bbb[44] == '1'){ ?> style="background:#D84949;color:white;width:15%;height:50px;margin-top:34px;float:left;"
							<?php }else if($bbb[44] == '2'){ ?> style="background:yellow;color:black;width:15%;height:50px;margin-top:34px;float:left;" 
							<?php }else if($bbb[44] == '3'){ ?> style="background:gray;color:white;width:15%;height:50px;margin-top:34px;float:left;" 
							<?php }else{ ?>style="width:15%;height:50px;margin-top:34px;float:left;"
							<?php }	?>>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[44] != null){ echo $bbb1[44]; }?></b>
							</div>
							<div 
							<?php if($bbb[44] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;margin-top: 10px;"
								<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;margin-top: 10px;"<?php } ?>>
								<b>44</b>
							</div>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[44] != null){ echo $bbb2[44]; }?></b>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
		<div style= "width:100%;">
			<div style="margin:16px">
				<div class="card_pilihan_meja_bawah_kanan_pojok">
					<a href="<?php echo $config->base_url()."";?>index/6.html">
						<div class="card_dalam_bar" 
							<?php if($bbb[6] == '1'){ ?> style="background:#D84949;color:white;width:97%;height:23%;"
							<?php }else if($bbb[6] == '2'){ ?> style="background:yellow;color:black;width:97%;height:23%;" 
							<?php }else if($bbb[6] == '3'){ ?> style="background:gray;color:white;width:97%;height:23%;" 
							<?php }else{ ?>style="width:97%;height:23%;"
							<?php }	?>>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[6] != null){ echo $bbb1[6]; }?></b>
							</div>
							<div 
							<?php if($bbb[6] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;margin-top: 10px;"
								<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;margin-top: 10px;"<?php } ?>>
								<b>6</b>
							</div>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[6] != null){ echo $bbb2[6]; }?></b>
							</div>
						</div>
					</a>
					<a href="<?php echo $config->base_url()."";?>index/40.html">
						<div class="card_dalam_bar" 
							<?php if($bbb[40] == '1'){ ?> style="background:#D84949;color:white;width:97%;height:17%;"
							<?php }else if($bbb[40] == '2'){ ?> style="background:yellow;color:black;width:97%;height:17%;" 
							<?php }else if($bbb[40] == '3'){ ?> style="background:gray;color:white;width:97%;height:17%;" 
							<?php }else{ ?>style="width:97%;height:17%;"
							<?php }	?>>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[40] != null){ echo $bbb1[40]; }?></b>
							</div>
							<div 
							<?php if($bbb[40] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;margin-top: 2px;"
								<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;margin-top: 2px;"<?php } ?>>
								<b>40</b>
							</div>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[40] != null){ echo $bbb2[40]; }?></b>
							</div>
						</div>
					</a>
					<a href="<?php echo $config->base_url()."";?>index/41.html">
						<div class="card_dalam_bar" 
							<?php if($bbb[41] == '1'){ ?> style="background:#D84949;color:white;width:97%;height:17%;"
							<?php }else if($bbb[41] == '2'){ ?> style="background:yellow;color:black;width:97%;height:17%;" 
							<?php }else if($bbb[41] == '3'){ ?> style="background:gray;color:white;width:97%;height:17%;" 
							<?php }else{ ?>style="width:97%;height:17%;"
							<?php }	?>>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[41] != null){ echo $bbb1[41]; }?></b>
							</div>
							<div 
							<?php if($bbb[41] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;margin-top: 2px;"
								<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;margin-top: 2px;"<?php } ?>>
								<b>41</b>
							</div>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[41] != null){ echo $bbb2[41]; }?></b>
							</div>
						</div>
					</a>
					<a href="<?php echo $config->base_url()."";?>index/42.html">
						<div class="card_dalam_bar" 
							<?php if($bbb[42] == '1'){ ?> style="background:#D84949;color:white;width:97%;height:17%;"
							<?php }else if($bbb[42] == '2'){ ?> style="background:yellow;color:black;width:97%;height:17%;" 
							<?php }else if($bbb[42] == '3'){ ?> style="background:gray;color:white;width:97%;height:17%;" 
							<?php }else{ ?>style="width:97%;height:17%;"
							<?php }	?>>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[42] != null){ echo $bbb1[42]; }?></b>
							</div>
							<div 
							<?php if($bbb[42] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;margin-top: 2px;"
								<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;margin-top: 2px;"<?php } ?>>
								<b>42</b>
							</div>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[42] != null){ echo $bbb2[42]; }?></b>
							</div>
						</div>
					</a>
					<a href="<?php echo $config->base_url()."";?>index/43.html">
						<div class="card_dalam_bar" 
							<?php if($bbb[43] == '1'){ ?> style="background:#D84949;color:white;width:97%;height:17%;"
							<?php }else if($bbb[43] == '2'){ ?> style="background:yellow;color:black;width:97%;height:17%;" 
							<?php }else if($bbb[43] == '3'){ ?> style="background:gray;color:white;width:97%;height:17%;" 
							<?php }else{ ?>style="width:97%;height:17%;"
							<?php }	?>>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[43] != null){ echo $bbb1[43]; }?></b>
							</div>
							<div 
							<?php if($bbb[43] != null){ ?> style="margin: auto;width: 80%;text-align: center;float:left;margin-top: 2px;"
								<?php }else{ ?> style="margin: auto;width: 100%;text-align: center;float:left;margin-top: 2px;"<?php } ?>>
								<b>43</b>
							</div>
							<div style="margin: auto;width: 10%; text-align: center;float:left;">
								<b><?php if($bbb[43] != null){ echo $bbb2[43]; }?></b>
							</div>
							
						</div>
					</a>
				</div>
				
			</div>
		</div>
	</div>
</div>
<script>
	setTimeout(function() {
		$.post('<?php echo $config->base_url();?>perorderan.html',function(data){
			$('#oyicak').html(data);
		});
	}, 60000);
</script>