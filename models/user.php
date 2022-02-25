<?php
class user{
	function show_dpst($conn,$id11111){
		$sql	= "
		SELECT
			*
		FROM
			`user`
		where 
			user.deleted = '0' && user.barcode = '$id11111'
		";

		$result	= $conn->query($sql);
		$record	= '';
		$spy = "";
		$no = 1;
		if($result){
			if(!empty($result)){
				$rec = $result->fetch_assoc();
				$record	= '["'.$rec['nama'].'", "'.$rec['deposit'].'", "'.$rec['alamat'].'", "'.$rec['no_hp'].'"]';
				
			}
		}
		
		return $record;
	}
	function insert_popups($conn,$id11111,$ed1,$ed2,$ed3,$ed4){
		
		$date 			= new DateTime();
		$var_time 		= $date->format('U');
		
		$varsasas = '';
		
		if($ed2 == '0'){
			$varsasas = 'DEPOSIT AWAL';
		}else if($ed2 == '1'){
			$varsasas = 'TOP UP';
		}
		$sql1	= "
			INSERT INTO `tr_popup`
				(
					`mprsh`, `mcab`, `kode_tr`, `barcode`, `kasir`,
					`keterangan`, `type_bayar`, `nominals`, `date_add`
				) 
			VALUES 
				(
					'3','4','','$ed1','$id11111',
					'$varsasas','$ed3','$ed4','$var_time')";
		$result	= $conn->query($sql1);
		
		$id_us = $this -> panggil_id($conn,$ed1,$var_time);
		
		$this -> update_id($conn,$ed1,$var_time,$id_us);
		
		if($ed2 == '0'){
			$this -> insert_user_baru($conn,$id11111,$ed1,$ed2,$ed3,$ed4,$id_us,$var_time);
		}else{
			$this -> update_user_saldo($conn,$id11111,$ed1,$ed2,$ed3,$ed4,$id_us,$var_time);
		}
		
		$this -> member_check($conn);
		return $record;
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
				
				$content = file_get_contents("http://localhost/kollabora_caffe/transfer_depo1/$dta.html");
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
	
	function update_user_saldo($conn,$id11111,$ed1,$ed2,$ed3,$ed4,$id_us,$var_time){
		$json	= $this -> show_dpst($conn,$ed1);
		$data = json_decode($json);
		
		$tl = $data[1]+$ed4;
		
		$sql	= "
			UPDATE
				`user`
			SET
				deposit = '$tl'
			WHERE
				barcode = '$ed1'";
						
		$result	= $conn->query($sql);
	}
	function insert_user_baru($conn,$id11111,$ed1,$ed2,$ed3,$ed4,$id_us,$var_time){

		$json = file_get_contents('https://www.kollabora.id/kollabora_caffe/cek_deposites/'.$ed1.'.html');
		$data = json_decode($json);

		$varrrr = date('Y-m-d H:i:s', $var_time);
		$sql1	= "
			INSERT INTO `user`
			(
				`id_user_category`, `nama`, `no_hp`, `alamat`, `created_at`,
				`deposit`, `barcode`, `point`
			)
			VALUES 
			(
				'2','$data[0]','$data[3]','$data[2]','$varrrr',
				'$ed4','$ed1','0')";
		$result	= $conn->query($sql1);
	}
	
	function update_id($conn,$ed1,$var_time,$id_us){
		
		$date = date('ym');
		
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
		}
		
		$acac = 'DP/'.$date.'-'.$sasa;
		$sql	= "
			UPDATE
				tr_popup
			SET
				kode_tr = '$acac'
			WHERE
				date_add = '$var_time' && barcode = '$ed1'";
						
		$result	= $conn->query($sql);
	}
	
	function panggil_id($conn,$ed1,$var_time){
		$sql1	= "
			SELECT
				id
			FROM
				`tr_popup`
			where 
				date_add = '$var_time' && barcode = '$ed1'";
		$result	= $conn->query($sql1);
		
		$rec = $result->fetch_assoc();
		$sas = $rec['id'];
		return $sas;
	}
	
	function show($conn){
		$sql	= "
		SELECT
			user.id_user,
			user.id_user_category,
			user_category.nama_category,
			user.nama,
			user.alamat,
			user.deposit,
			user.barcode,
			user.point
		FROM
			`user`
		INNER JOIN
			user_category
		ON
			user_category.id_category = user.id_user_category
		where 
			user.deleted = '0' order by id_user desc
		";

		$result	= $conn->query($sql);
		$record	= array();
		$spy = "";
		$no = 1;
		if($result){
			if(!empty($result)){
				while($rec = $result->fetch_assoc()){
					$record[]	= $rec;
				}
			}
		}
		
		return $record;
	}
	
	function select($conn,$id){
		$sql	= "
		SELECT
			user.id_user,
			user.id_user_category,
			user_category.nama_category,
			user.nama,
			user.alamat,
			user.deposit,
			user.barcode,
			user.point
		FROM
			`user`
		INNER JOIN
			user_category
		ON
			user_category.id_category = user.id_user_category
		where 
			user.deleted = '0' && user.id_user = '$id'
		";

		$result	= $conn->query($sql);
		$record	= array();
		if($result){
			if(!empty($result)){
				$rec	= $result->fetch_assoc();
				$record	= $rec;
			}
		}
		
		return $record;
	}
	function update($conn){
		$id_user			= $_POST['id_user'];
		$id_user_category	= $_POST['id_user_category'];
		
		$sql	= "
			UPDATE
				user
			SET
				id_user_category = '$id_user_category'
			WHERE
				id_user = '$id_user'";
						
		$result	= $conn->query($sql);
		
		header("location:$config->base_url"."member.html");
	}
	
}
$user	= new user();
?>