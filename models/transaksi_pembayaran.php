<?php
class transaksi_pembayaran{
	function point($conn,$point,$no_trans,$tgl,$idmember,$total_uang,$dssdsdsdsd,$duid,$biaya_ppn,$biaya_service,$voucher,$no_meja11,$jnis_byr1,$point11){
		// $connsss	= new mysqli('localhost','root','','kollabora_cafe');
		
		$date = date('Y/m/d h:i:s', ($tgl));
		$kets = "PENAMBAHAN POINT #INV:$no_trans";
		$ppn = 0; $service = 0; 
		if($biaya_ppn == '1'){
			$ppn = $duid*10/100;
		}
		if($biaya_service == '1'){
			$service = $duid*5/100;
		}
		$uang = $total_uang - $voucher;
		
		$ptpoint = $point11+$point;
		
		$sqltbh	= "
			UPDATE
				`user`
					SET
						point = '$ptpoint'
					WHERE
						id_user = '$idmember'";
					
		$sqltbh	= $conn->query($sqltbh);
		
		$sqltbh	= "
			INSERT INTO 
				`history_point`(
				`id_user`, `no_trans`, `tgl_trans`, `ket_trans`, `nilai_trans`, 
				`nilai_subtotal`, `nilai_disc`, `nilai_dpp`, `nilai_svc`, `nilai_ppn`,
				`nilai_total`, `nilai_voucher`, `nilai_bayar`, `nilai_kembali`, `jenis_bayar`,
				`ket_bayar`, `no_inv`, `no_meja`
			) VALUES (
				'$idmember','$no_trans','$date','$kets','$point',
				'$duid','$dssdsdsdsd','$duid','$service','$ppn',
				'$total_uang','$voucher','$uang','0','$jnis_byr1',
				'','$no_trans','$no_meja11')";
				
		$sqltbh	= $conn->query($sqltbh);
	}
	function insert($conn,$id11111){
		$a1 = $_POST['var1']; $a2 = $_POST['var2']; $a3 = $_POST['var3']; $a4 = $_POST['var4']; $a5 = $_POST['var5']; $a6 = $_POST['var6']; $a7 = $_POST['var7'];
		$b1 = $_POST['b1']; $c1 = $_POST['c1']; $d1 = $_POST['d1']; $d2 = $_POST['d2']; $d3 = $_POST['d3']; $d4= $_POST['d4']; $e1 = $_POST['e1'];
		$e2 = $_POST['e2']; $e3 = $_POST['e3'];$e4 = $_POST['e4']; $f1 = $_POST['f1']; $f2 = $_POST['f2']; $g1 = $_POST['g1']; $g2= $_POST['g2']; $h1 = $_POST['h1'];
		$h2 = $_POST['h2']; $h3 = $_POST['h3']; $h4 = $_POST['h4']; $id_trans = $_POST['id_trans']; $duid = $_POST['duid']; $service1 = $_POST['service1']; 
		$ppn1 = $_POST['ppn1']; $total_uang = $_POST['total_uang'];

		$ongkos_kirim = '0';
		$voucher = '0';
		$$point11 = '0';
		
		$date 			= new DateTime();
		$var_time 		= $date->format('U');


		$sqlshift	= "
				SELECT shift FROM `shift` where status = '1' order by id desc limit 1"; 

		$resultshift	= $conn->query($sqlshift);
		$recshift = $resultshift->fetch_assoc();
		$asesaseshift = $recshift['shift'];
		
		$sql	= "
				SELECT
					muser.no,
					muser.ckode
				FROM
					`muser`
				where
					muser.no = '$id11111' && muser.deleted = '0'
				order by
					muser.no desc limit 1"; 

		$result	= $conn->query($sql);
		$rec = $result->fetch_assoc();
		$asesase = $rec['ckode'];
		
		$sqlno_meja	= "
				SELECT
					no_meja,
					id_member,
					discount_type,
					biaya_ppn,
					biaya_service,
					voucher
				FROM
					`transaksi`
				where
					id = '$id_trans'"; 

		$resultno_meja	= $conn->query($sqlno_meja);
		$recno_meja = $resultno_meja->fetch_assoc();
		$no_meja11 = $recno_meja['no_meja'];
		$idmems = $recno_meja['id_member'];
		$dssdsdsdsd = $recno_meja['discount_type'];
		$vouchervoucher = $recno_meja['voucher'];
		$biaya_ppn = $recno_meja['biaya_ppn'];
		$biaya_service = $recno_meja['biaya_service'];
		$jnis_byr1 = '';
		
		$stnomeja = 1;
		if($no_meja11 == '105' || $no_meja11 == '106'){
			$stnomeja = 99;
		}
		
		$id_us = $id_trans;
			
		$datess = date('ym');
	
		$nil = $id_us;
		$sasa = strlen($id_us);
		if($sasa == '1'){
			$sasa = '000'.$id_us;
		}else if($sasa == '2'){
			$sasa = '00'.$id_us;
		}else if($sasa == '3'){
			$sasa = '0'.$id_us;
		}else if($sasa == '4'){
			$sasa = $id_us;
		}else{
			$sasa = $id_us;
		}
		
		$acac = 'PJ/'.$datess.'-'.$sasa;
		
		$pointasadad = $duid / 10000;
		$pnts = explode(".", $pointasadad);
		
		$tldisd = $duid + $ppn1 + $service1;
		
		$tlyoyo = $tldisd ;
		
		
		if($vouchervoucher != null || $vouchervoucher != 0){
			$tlyoyo = $tldisd - $vouchervoucher;
			if($vouchervoucher > $tldisd){
				$vouchervoucher = $tldisd;
			}
			$sqltbh	= "
				INSERT INTO 
					`transaksi_pembayaran`(
					`mprsh`, `mcab`, `id_trans`, `id_jenis`, `nominal`, 
					`keterangan`, `edc`, `bank`, `date_add`
				) VALUES (
					'3','4','$id_trans','8','$vouchervoucher',
					'','','','$var_time')";
					
			$sqltbh	= $conn->query($sqltbh);
		}
		if($tlyoyo > 0){
			if($a1 == '1'){
				if($jnis_byr1 == ''){
					$jnis_byr1 = "DEPOSIT";
				}else{
					$jnis_byr1 = $jnis_byr1+", "+"DEPOSIT";
				}
				$sqltbh	= "
					INSERT INTO 
						`transaksi_pembayaran`(
						`mprsh`, `mcab`, `id_trans`, `id_jenis`, `nominal`, 
						`keterangan`, `edc`, `bank`, `date_add`
					) VALUES (
						'3','4','$id_trans','1','$b1',
						'','','','$var_time')";
						
				$sqltbh	= $conn->query($sqltbh);
				
				$sql	= "
					SELECT
						deposit,
						point
					FROM
						`user`
					where
						id_user = '$idmems' && deleted = '0'"; 

				$result	= $conn->query($sql);
				$rec = $result->fetch_assoc();
				$deposit11 = $rec['deposit'];
				$point11 = $rec['point'];
				
				$sisa1111 = $deposit11 - $b1;
				
				$sqltbh	= "
				UPDATE
					`user`
						SET
							deposit = '$sisa1111'
						WHERE
							id_user = '$idmems'";
						
				$sqltbh	= $conn->query($sqltbh);
				
				$varsasas = 'Pemakaian Deposit';
				
				$date = date('ym');
				
				$sqlcor	= "
					SELECT
						barcode
					FROM
						`user`
					where
						id_user = '$idmems'"; 

				$resultcor	= $conn->query($sqlcor);
				$reccor = $resultcor->fetch_assoc();
				$nobrcor = $reccor['barcode'];
				
				$sql1	= "
				INSERT INTO `tr_popup`
					(
						`mprsh`, `mcab`, `kode_tr`,`id_trans`, `barcode`, `kasir`,
						`keterangan`, `type_bayar`, `nominals`, `date_add`
					) 
				VALUES 
					(
						'3','4','$acac','$id_trans','$nobrcor','$id11111',
						'$varsasas','Pemakaian','$b1','$var_time')";
				$result	= $conn->query($sql1);
				
				$sql1	= "
				INSERT INTO `tr_point`
					(
						`mprsh`, `mcab`, `kode_point`,`id_trans`, `barcode`, `kasir`,
						`keterangan`, `total_point`, `date_add`
					) 
				VALUES 
					(
						'3','4','$acac','$id_trans','$nobrcor','$id11111',
						'Point Masuk','$pnts[0]','$var_time')";
				$result	= $conn->query($sql1);
			}
			if($a2 == '1'){
				if($jnis_byr1 == ''){
					$jnis_byr1 = "CASH";
				}else{
					$jnis_byr1 = $jnis_byr1+", "+"CASH";
				}
				$sisa = $total_uang-$vouchervoucher;
				if($a1 == '1'){
					$sisa = $total_uang - $b1-$vouchervoucher;
				}else if($a3 == '1'){
					$sisa = $total_uang - $d1-$vouchervoucher;
				}
				if($sisa < $c1){
					$c1 = $sisa - $vouchervoucher;
				}
				$sqltbh	= "
					INSERT INTO 
						`transaksi_pembayaran`(
						`mprsh`, `mcab`, `id_trans`, `id_jenis`, `nominal`, 
						`keterangan`, `edc`, `bank`, `date_add`
					) VALUES (
						'3','4','$id_trans','2','$sisa',
						'','','','$var_time')";
						
				$sqltbh	= $conn->query($sqltbh);
			}
			if($a3 == '1'){
				if($jnis_byr1 == ''){
					$jnis_byr1 = "DEBIT";
				}else{
					$jnis_byr1 = $jnis_byr1+", "+"DEBIT";
				}
				$sqltbh	= "
					INSERT INTO 
						`transaksi_pembayaran`(
						`mprsh`, `mcab`, `id_trans`, `id_jenis`, `nominal`, 
						`keterangan`, `edc`, `bank`, `date_add`
					) VALUES (
						'3','4','$id_trans','3','$d1',
						'$d2','$d3','$d4','$var_time')";
						
				$sqltbh	= $conn->query($sqltbh);
			}
			if($a4 == '1'){
				if($jnis_byr1 == ''){
					$jnis_byr1 = "KARTU KREDIT";
				}else{
					$jnis_byr1 = $jnis_byr1+", "+"KARTU KREDIT";
				}
				$sqltbh	= "
					INSERT INTO 
						`transaksi_pembayaran`(
						`mprsh`, `mcab`, `id_trans`, `id_jenis`, `nominal`, 
						`keterangan`, `edc`, `bank`, `date_add`
					) VALUES (
						'3','4','$id_trans','4','$e1',
						'$e2','$e3','$e4','$var_time')";
						
				$sqltbh	= $conn->query($sqltbh);
			}
			if($a5 == '1'){
				if($jnis_byr1 == ''){
					$jnis_byr1 = "OVO";
				}else{
					$jnis_byr1 = $jnis_byr1+", "+"OVO";
				}
				$sqltbh	= "
					INSERT INTO 
						`transaksi_pembayaran`(
						`mprsh`, `mcab`, `id_trans`, `id_jenis`, `nominal`, 
						`keterangan`, `edc`, `bank`, `date_add`
					) VALUES (
						'3','4','$id_trans','5','$f1',
						'$f2','','','$var_time')";
						
				$sqltbh	= $conn->query($sqltbh);
			}if($a6 == '1'){
				if($jnis_byr1 == ''){
					$jnis_byr1 = "GOPAY";
				}else{
					$jnis_byr1 = $jnis_byr1+", "+"GOPAY";
				}
				$sqltbh	= "
					INSERT INTO 
						`transaksi_pembayaran`(
						`mprsh`, `mcab`, `id_trans`, `id_jenis`, `nominal`, 
						`keterangan`, `edc`, `bank`, `date_add`
					) VALUES (
						'3','4','$id_trans','6','$g1',
						'$g2','','','$var_time')";
						
				$sqltbh	= $conn->query($sqltbh);
			}if($a7 == '1'){
				$sqltbh	= "
					INSERT INTO 
						`transaksi_pembayaran`(
						`mprsh`, `mcab`, `id_trans`, `id_jenis`, `nominal`, 
						`keterangan`, `edc`, `bank`, `date_add`
					) VALUES (
						'3','4','$id_trans','7','$h1',
						'$h2','$h3','$h4','$var_time')";
						
				$sqltbh	= $conn->query($sqltbh);
			}

		}
		
		
		$sqltbh	= "
			UPDATE
				`transaksi`
					SET
						nominal = '$duid',
						sub_ttl = '$total_uang',
						status = '$stnomeja',
						date_add = '$var_time',
						shift = '$asesaseshift',
						id_user = '$asesase'
					WHERE
						id = '$id_trans'";
					
		$sqltbh	= $conn->query($sqltbh);

		if($a1 == '1'){
			$this -> point($conn,$pnts[0],$acac,$var_time,$idmems,$total_uang,$dssdsdsdsd,$duid,$biaya_ppn,$biaya_service,$vouchervoucher,$no_meja11,$jnis_byr1,$point11);
		}
		
		$this -> point_check($conn);
		$this -> member_check($conn);
		return $sqltbh;
	}
	function member_check($conn){
		$sql	= "
		SELECT 
			*
		FROM 
			`tr_popup`
        
		where status_upload = '0'";

		$result	= $conn->query($sql);
		while($rec = $result->fetch_assoc()){
			$kone = $rec['id'];
			$a1 = $rec['id_trans'];
			$a2 = $rec['date_add']; $a3 = $rec['nominals'];$a4 = $rec['type_bayar'];$a5 = $rec['barcode'];
			
			$sqlaaa	= "
					SELECT 
						deposit
					FROM 
						`user`
					
					where barcode = '$a5'";

				$resultaaasqlaaa	= $conn->query($sqlaaa);
				$recasresultaaasqlaaa = $resultaaasqlaaa->fetch_assoc();
				$a11 = $recasresultaaasqlaaa['deposit'];
			
			if($rec['id_trans'] == null){
				$a1 = $rec['id'];
			
				$dta = $a1."|".$a2."|".$a3."|".$a4."|".$a5."|".$a11;
				$content = file_get_contents("https://kollabora.id/marketing/transfer_depo/$dta.html");
				// $content = file_get_contents("http://localhost/kollabora_caffe/transfer_depo/$dta.html");
			}else{
				$sqlaa	= "
					SELECT 
						*
					FROM 
						`transaksi`
					
					where id = '$a1'";

				$resultaaa	= $conn->query($sqlaa);
				$recas = $resultaaa->fetch_assoc();
				$a6 = $recas['nominal'];
				$a7 = $recas['biaya_ppn'];
				$a8 = $recas['biaya_service'];
				$a9 = $recas['sub_ttl'];
			
				$dta = $a1."|".$a2."|".$a3."|".$a4."|".$a5."|".$a6."|".$a7."|".$a8."|".$a9."|".$a11;
				
				$content = file_get_contents("https://kollabora.id/marketing/transfer_depo1/$dta.html");
			}  
			if($content != null){
				$sqlaanc	= "
					UPDATE
						tr_popup
					SET
						status_upload 	= '1'
					WHERE
						id = $kone";
								
				$conn->query($sqlaanc);
			}
			
			
		}
		
	}
	
	function point_check($conn){
		$connsss	= new mysqli('localhost','root','','kollabora_cafe');
		
		$sql	= "
		SELECT 
			*
		FROM 
			`history_point`
        
		where status_upload = '0'";

		$result	= $conn->query($sql);
		
		while($rec = $result->fetch_assoc()){
			$a1 = $rec['id_user']; $a2 = $rec['no_trans']; $a3 = $rec['tgl_trans']; $a4 = $rec['ket_trans']; $a5 = $rec['nilai_trans'];
			$b1 = $rec['nilai_subtotal']; $a2 = $rec['nilai_disc']; $b3 = $rec['nilai_dpp']; $b4 = $rec['nilai_svc']; $b5 = $rec['nilai_ppn'];
			$c1 = $rec['nilai_total']; $c2 = $rec['nilai_voucher']; $c3 = $rec['nilai_bayar']; $c4 = $rec['nilai_kembali']; $c5 = $rec['jenis_bayar'];
			$d1 = $rec['ket_bayar']; $d2 = $rec['no_inv']; $d3 = $rec['no_meja'];
			
			$sqlaa	= "
				SELECT 
					barcode,point
				FROM 
					`user`
				where id_user = '$a1'";
			
			$result1	= $conn->query($sqlaa);
			$recaa = $result1->fetch_assoc();
			$barcode = $recaa['barcode'];
			$point = $recaa['point'];
			
			$pieces = explode("/", $rec['no_trans']);
			$a21 = $pieces[0];
			$a22 = $pieces[1];
			$pieces1 = explode(" ", $rec['ket_trans']);
			$a41 = $pieces1[0];
			$a42 = $pieces1[1];
			
			// $dta = $a1."|".$a21."|".$a22;
			$a3 = strtotime($a3);
			$dta = $a1."|".$a21."|".$a22."|".$a3."|".$a41."|".$a42."|".$a5."|".$b1."|".$b2."|".$b3."|".$b4."|".$b5."|".$c1."|".$c2."|".$c3."|".$c4."|".$c5."|".$d1."|".$d3."|".$barcode."|".$point;
			// $dta = $a1."|".$a21."|".$a22."|".$a3."|".$a41."|".$a42."|".$a5."|".$b1."|".$b2."|".$b3."|".$b4."|".$b5."|".$c1."|".$c2."|".$c3."|".$c4."|".$c5."|".$d1."|".$d2."|".$d3;
			
			$content = file_get_contents("http://kollabora.id/marketing/transfer_point/$dta.html");
			if($content != null){
				$sqlaa	= "
					UPDATE
						history_point
					SET
						status_upload 	= '1'
					WHERE
						no_trans = $a2";
								
				$conn->query($sqlaa);
			}
		}
		
	}
	
}
$transaksi_pembayaran	= new transaksi_pembayaran();
?>