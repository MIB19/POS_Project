<?php
class transaksi{
	function show_tbll($conn){		
		$sql	= "
			SELECT 
				DISTINCT(transaksi.no_meja) as 'oyi' 
			FROM 
				`transaksi_detail`
			inner join transaksi	
			on transaksi.id = transaksi_detail.id_trans
			where 
				transaksi.status = '0' && 
				transaksi.deleted = '0'
			order by 
				transaksi.id 
			desc"; 

		$result	= $conn->query($sql);
		if($result){
			if(!empty($result)){
				while($rec = $result->fetch_assoc()){
					$record[]	= $rec;
				}
			}
		}
		return $record;
	}
	function show_trs($conn,$pilihan_meja){		
		$sql	= "
			SELECT
				id
			FROM
				`transaksi`
			where
				transaksi.no_meja  = '$pilihan_meja' && transaksi.status = '0'"; 

		$result	= $conn->query($sql);
		$rec = $result->fetch_assoc();
		
		$a = $rec['id'];
		
		return $a;
	}
	function pindh_meja($conn,$id,$id1,$id2,$id3){		
		$arr = explode(",", $id2);
		$arr2 = explode(",", $id3);
		$arrhitung = count($arr);
		$assaasasassa = $arr[0];
	
		$date 			= new DateTime();
		$var_time 		= $date->format('U');
	
		for($ini = 0;$ini<$arrhitung;$ini++){
			$thx = $arr[$ini];
			$thx1 = $arr2[$ini];
			
			$sql3	= "
				SELECT
					*
				FROM
					`transaksi_detail`
				where
					id = '$thx' && deleted = '0'
				order by
					id desc limit 1"; 

			$result3	= $conn->query($sql3);
			$rec3 = $result3->fetch_assoc();
			
			$aa = $rec3['mprsh']; $ba = $rec3['mcab']; $ca = $rec3['id_trans']; $da = $rec3['id_utm']; $ea = $rec3['id_child'];
			$aa1 = $rec3['id_item']; $ba1 = $rec3['ckode']; $ca1 = $rec3['tambahan']; $da1 = $rec3['total']; $ea1 = $rec3['discount_type'];
			$aa2 = $rec3['nominal']; $ba2 = $rec3['harga']; $ca2 = $rec3['catatan']; $da2 = $rec3['stat_simpan']; $ea2 = $rec3['stat_print'];
			
			$oyiaa = $rec3['total'];
			
			$oyis = $oyiaa-$thx1;
			
			if($oyis == '0'){
				$sqlhasil	= "
					UPDATE
						`transaksi_detail`
					SET
						id_trans = '$id1'
					WHERE
						id = '$thx'";
				
				$resulthasil	= $conn->query($sqlhasil);
			}else{
				$sqltbh	= "
					INSERT INTO `transaksi_detail` 
					(
					`mprsh`, `mcab`,`id_trans`, `id_utm`, `id_child`, 
					`id_item`, `ckode`, `tambahan`, `total`, `discount_type`, 
					`nominal`, `harga`, `catatan`, `stat_simpan`, `stat_print`, `date_add`
					) VALUES 
					(
					'$aa', '$ba','$id1', '$da', '$ea',
					'$aa1', '$ba1', '$ca1', '$thx1', '$ea1',
					'$aa2', '$ba2', '$ca2', '$da2', '$ea2', '$var_time'
					);";
						
				$resulttbh	= $conn->query($sqltbh);
				
				
				$sqlhasil	= "
					UPDATE
						`transaksi_detail`
					SET
						total = '$oyis'
					WHERE
						id = '$thx'";
							
				$resulthasil	= $conn->query($sqlhasil);
			}	
		}

		$cors = $id."/".$id1;
		return $cors;
		// header("location:$config->base_url"."transaksi_meja.html/".$id3."/".$aassa."");
		// return $resulthasil;
	}
	
	
	
	function pindah_meja($conn,$id,$id1,$id2){		
		$arr = explode(",", $id1);
		$arr2 = explode(",", $id2);
		$arrhitung = count($arr);
		$assaasasassa = $arr[0];
		$sql	= "
			SELECT
				transaksi.mprsh,
				transaksi.mcab,
				transaksi.kode,
				transaksi.id_member,
				transaksi.no_meja,
				transaksi.discount_type,
				transaksi.nominal,
				transaksi.biaya_ppn,
				transaksi.biaya_service,
				transaksi.ongkos_kirim,
				transaksi.sub_ttl,
				transaksi.catatan,
				transaksi.ket_pmbyrn,
				transaksi.status,
				transaksi.date_add
			FROM
				`transaksi_detail`
			inner join
				transaksi
			on
				transaksi.id = transaksi_detail.id_trans
			where
				transaksi_detail.id  = '$assaasasassa'"; 

		$result	= $conn->query($sql);
		$rec = $result->fetch_assoc();
		
		$a = $rec['mprsh'];
		$b = $rec['mcab'];
		$c = $rec['kode'];
		$d = '';
		$e = $id;
		$f = $rec['discount_type'];
		$g = $rec['nominal'];
		$h = $rec['biaya_ppn'];
		$i = $rec['biaya_service'];
		$j = $rec['ongkos_kirim'];
		$a1 = $rec['sub_ttl'];
		$a2 = $rec['catatan'];
		$a3 = $rec['ket_pmbyrn'];
		$a4 = $rec['status'];
		$a5 = $rec['date_add'];
		$nj12 = $rec['no_meja'];
		
		
		$date 			= new DateTime();
		$var_time 		= $date->format('U');
		$z = 0;
		if($nj12 == '105' || $nj12 == '106' || $nj12 == '103' || $nj12 == '104'){
			if($e == '105' || $e == '106' || $e == '103' || $e == '104'){
				$h = '0';
				$i = '0';
			}else{
				$h = '1';
				$i = '1';
			}
		}else{
			if($e == '105' || $e == '106' || $e == '103' || $e == '104'){
				$h = '0';
				$i = '0';
			}
		}
		
		
		$sql1	= "
			INSERT INTO `transaksi`(
				`mprsh`, `mcab`, `kode`, `id_member`, `no_meja`, 
				`discount_type`, `nominal`, `biaya_ppn`, `biaya_service`, `ongkos_kirim`, 
				`sub_ttl`, `catatan`, `ket_pmbyrn`, `status`, `date_add`
			) VALUES (
				'$a','$b','$c','$d','$e',
				'$f','$g','$h','$i','$j',
				'$a1','$a2','$a3','$a4','$var_time')";
		$result	= $conn->query($sql1);
		
		$sql2	= "
				SELECT
					transaksi.id
				FROM
					`transaksi`
				where
					transaksi.no_meja = '$e' && transaksi.deleted = '0'
				order by
					transaksi.id desc limit 1"; 

		$result	= $conn->query($sql2);
		$rec = $result->fetch_assoc();
		$aassa = $rec['id'];

		
	
		$date 			= new DateTime();
		$var_time 		= $date->format('U');
	
		for($ini = 0;$ini<$arrhitung;$ini++){
			$thx = $arr[$ini];
			$thx1 = $arr2[$ini];
			
			$sql3	= "
				SELECT
					*
				FROM
					`transaksi_detail`
				where
					id = '$thx' && deleted = '0'
				order by
					id desc limit 1"; 

			$result3	= $conn->query($sql3);
			$rec3 = $result3->fetch_assoc();
			
			$aa = $rec3['mprsh']; $ba = $rec3['mcab']; $ca = $rec3['id_trans']; $da = $rec3['id_utm']; $ea = $rec3['id_child'];
			$aa1 = $rec3['id_item']; $ba1 = $rec3['ckode']; $ca1 = $rec3['tambahan']; $da1 = $rec3['total']; $ea1 = $rec3['discount_type'];
			$aa2 = $rec3['nominal']; $ba2 = $rec3['harga']; $ca2 = $rec3['catatan']; $da2 = $rec3['stat_simpan']; $ea2 = $rec3['stat_print'];
			$eaid_user2 = $rec3['id_user'];
			
			$oyiaa = $rec3['total'];
			
			$oyis = $oyiaa-$thx1;
			
			if($oyis == '0'){
				$sqlhasil	= "
					UPDATE
						`transaksi_detail`
					SET
						id_trans = '$aassa'
					WHERE
						id = '$thx'";
				
				$resulthasil	= $conn->query($sqlhasil);
			}else{
				$sqltbh	= "
					INSERT INTO `transaksi_detail` 
					(
					`mprsh`, `mcab`,`id_trans`, `id_utm`, `id_child`, 
					`id_item`, `ckode`, `tambahan`, `total`, `discount_type`, 
					`nominal`, `harga`, `catatan`, `stat_simpan`, `stat_print`, `date_add`, `id_user`
					) VALUES 
					(
					'$aa', '$ba','$aassa', '$da', '$ea',
					'$aa1', '$ba1', '$ca1', '$thx1', '$ea1',
					'$aa2', '$ba2', '$ca2', '$da2', '$ea2', '$var_time','$eaid_user2'
					);";
						
				$resulttbh	= $conn->query($sqltbh);
				
				
				$sqlhasil	= "
					UPDATE
						`transaksi_detail`
					SET
						total = '$oyis'
					WHERE
						id = '$thx'";
							
				$resulthasil	= $conn->query($sqlhasil);
				
				$sqllstadons1	= "
					SELECT
						id
					FROM
						`transaksi_detail`
					where
						id_trans = '$aassa' && id_item = '$aa1' && total = '$thx1' && harga = '$ba2' && date_add = '$var_time' && deleted = '0'&& deleted = '0'
					order by
						id desc limit 1"; 

				$resultlstadons1	= $conn->query($sqllstadons1);
				$reclstadons1 = $resultlstadons1->fetch_assoc();
				
				$aalstadons1111 = $reclstadons1['id'];
				
				$sqllstadons	= "
					SELECT
						*
					FROM
						`transaksi_addon`
					where
						id_transaksi_detail = '$thx' && deleted = '0'
					order by
						id desc"; 

				$resultlstadons	= $conn->query($sqllstadons);
				
				while($reclstadons1 = $reclstadons = $resultlstadons->fetch_assoc()){
				
					$aalstadons1 = $reclstadons['id_transaksi_detail'];
					$aalstadons2 = $reclstadons['id_item'];
					$aalstadonsnm = $reclstadons['nama'];
					$aalstadons3 = $reclstadons['total'];
					$aalstadons4 = $reclstadons['harga'];
					$aalstadons5 = $reclstadons['date_add'];
					
					$sqlhasil1111	= "
						INSERT INTO `transaksi_addon` 
						(
						`mprsh`, `mcab`,`id_transaksi_detail`, `id_item`, `nama`, `ckode`, 
						`keterangan`, `tambahan`, `total`, `discount_type`, `nominal`, 
						`harga`, `catatan`, `stat_simpan`, `stat_print`, `date_add`
						) VALUES 
						(
						'3', '4','$aalstadons1111', '$aalstadons2', '$aalstadonsnm', '0',
						'', '0', '$aalstadons3', '1', '0',
						'$aalstadons4', '', '0', '0', '$var_time'
						);";
					
					$resulthasil1111	= $conn->query($sqlhasil1111);
				}
			}	
		}
		$sql2	= "
				SELECT
					transaksi.id
				FROM
					`transaksi`
				where
					transaksi.no_meja = '$e' && transaksi.deleted = '0'
				order by
					transaksi.id desc limit 1"; 

		$result	= $conn->query($sql2);
		$rec = $result->fetch_assoc();
		$cor = $rec['id'];
		$cors = $e."/".$cor;
		return $cors;
		// header("location:$config->base_url"."transaksi_meja.html/".$id3."/".$aassa."");
		// return $resulthasil;
	}
	
	
	function split_data($conn,$id,$id1,$id2,$id3){		
		$sql	= "
			SELECT
				*
			FROM
				`transaksi`
			where
				transaksi.id  = '$id'"; 

		$result	= $conn->query($sql);
		$rec = $result->fetch_assoc();
		
		$a = $rec['mprsh'];
		$b = $rec['mcab'];
		$c = $rec['kode'];
		$d = '';
		$e = $rec['no_meja'];
		$f = $rec['discount_type'];
		$g = $rec['nominal'];
		$h = $rec['biaya_ppn'];
		$i = $rec['biaya_service'];
		$j = $rec['ongkos_kirim'];
		$a1 = $rec['sub_ttl'];
		$a2 = $rec['catatan'];
		$a3 = $rec['ket_pmbyrn'];
		$a4 = $rec['status'];
		$a5 = $rec['date_add'];
		
		
		$date 			= new DateTime();
		$var_time 		= $date->format('U');
		
		if($e == '105' || $e == '106' || $e == '103' || $e == '104'){
			$h = '0';
			$i = '0';
		}
		
		$sql1	= "
			INSERT INTO `transaksi`(
				`mprsh`, `mcab`, `kode`, `id_member`, `no_meja`, 
				`discount_type`, `nominal`, `biaya_ppn`, `biaya_service`, `ongkos_kirim`, 
				`sub_ttl`, `catatan`, `ket_pmbyrn`, `status`, `date_add`
			) VALUES (
				'$a','$b','$c','$d','$e',
				'$f','$g','$h','$i','$j',
				'$a1','$a2','$a3','$a4','$var_time')";
		$result	= $conn->query($sql1);
		
		$sql2	= "
				SELECT
					transaksi.id
				FROM
					`transaksi`
				where
					transaksi.no_meja = '$e' && transaksi.deleted = '0'
				order by
					transaksi.id desc limit 1"; 

		$result	= $conn->query($sql2);
		$rec = $result->fetch_assoc();
		$aassa = $rec['id'];

		$arr = explode(",", $id1);
		$arr2 = explode(",", $id2);
		$arrhitung = count($arr);
	
		$date 			= new DateTime();
		$var_time 		= $date->format('U');
	
		for($ini = 0;$ini<$arrhitung;$ini++){
			$thx = $arr[$ini];
			$thx1 = $arr2[$ini];
			
			$sql3	= "
				SELECT
					*
				FROM
					`transaksi_detail`
				where
					id = '$thx' && deleted = '0'
				order by
					id desc limit 1"; 

			$result3	= $conn->query($sql3);
			$rec3 = $result3->fetch_assoc();
			
			$aa = $rec3['mprsh']; $ba = $rec3['mcab']; $ca = $rec3['id_trans']; $da = $rec3['id_utm']; $ea = $rec3['id_child'];
			$aa1 = $rec3['id_item']; $ba1 = $rec3['ckode']; $ca1 = $rec3['tambahan']; $da1 = $rec3['total']; $ea1 = $rec3['discount_type'];
			$aa2 = $rec3['nominal']; $ba2 = $rec3['harga']; $ca2 = $rec3['catatan']; $da2 = $rec3['stat_simpan']; $ea2 = $rec3['stat_print'];
			$aaid_user2 = $rec3['id_user'];
			
			$oyiaa = $rec3['total'];
			
			$oyis = $oyiaa-$thx1;
			
			if($oyis == '0'){
				$sqlhasil	= "
					UPDATE
						`transaksi_detail`
					SET
						id_trans = '$aassa'
					WHERE
						id = '$thx'";
				
				$resulthasil	= $conn->query($sqlhasil);
				
			}else{
				$sqltbh	= "
					INSERT INTO `transaksi_detail` 
					(
					`mprsh`, `mcab`,`id_trans`, `id_utm`, `id_child`, 
					`id_item`, `ckode`, `tambahan`, `total`, `discount_type`, 
					`nominal`, `harga`, `catatan`, `stat_simpan`, `stat_print`, `date_add`,`id_user`
					) VALUES 
					(
					'$aa', '$ba','$aassa', '$da', '$ea',
					'$aa1', '$ba1', '$ca1', '$thx1', '$ea1',
					'$aa2', '$ba2', '$ca2', '$da2', '$ea2', '$var_time', '$aaid_user2'
					);";
						
				$resulttbh	= $conn->query($sqltbh);
				
				
				$sqlhasil	= "
					UPDATE
						`transaksi_detail`
					SET
						total = '$oyis'
					WHERE
						id = '$thx'";
							
				$resulthasil	= $conn->query($sqlhasil);
				
				$sqllstadons1	= "
					SELECT
						id
					FROM
						`transaksi_detail`
					where
						id_trans = '$aassa' && id_item = '$aa1' && total = '$thx1' && harga = '$ba2' && date_add = '$var_time' && deleted = '0'&& deleted = '0'
					order by
						id desc limit 1"; 

				$resultlstadons1	= $conn->query($sqllstadons1);
				$reclstadons1 = $resultlstadons1->fetch_assoc();
				
				$aalstadons1111 = $reclstadons1['id'];
				
				$sqllstadons	= "
					SELECT
						*
					FROM
						`transaksi_addon`
					where
						id_transaksi_detail = '$thx' && deleted = '0'
					order by
						id desc"; 

				$resultlstadons	= $conn->query($sqllstadons);
				
				while($reclstadons1 = $reclstadons = $resultlstadons->fetch_assoc()){
				
					$aalstadons1 = $reclstadons['id_transaksi_detail'];
					$aalstadons2 = $reclstadons['id_item'];
					$aalstadonsnm = $reclstadons['nama'];
					$aalstadons3 = $reclstadons['total'];
					$aalstadons4 = $reclstadons['harga'];
					$aalstadons5 = $reclstadons['date_add'];
					
					$sqlhasil1111	= "
						INSERT INTO `transaksi_addon` 
						(
						`mprsh`, `mcab`,`id_transaksi_detail`, `id_item`, `nama`, `ckode`, 
						`keterangan`, `tambahan`, `total`, `discount_type`, `nominal`, 
						`harga`, `catatan`, `stat_simpan`, `stat_print`, `date_add`
						) VALUES 
						(
						'3', '4','$aalstadons1111', '$aalstadons2', '$aalstadonsnm', '0',
						'', '0', '$aalstadons3', '1', '0',
						'$aalstadons4', '', '0', '0', '$var_time'
						);";
					
					$resulthasil1111	= $conn->query($sqlhasil1111);
				}
			}	
		}
		$sql2	= "
				SELECT
					transaksi.id
				FROM
					`transaksi`
				where
					transaksi.no_meja = '$e' && transaksi.deleted = '0'
				order by
					transaksi.id desc limit 1"; 

		$result	= $conn->query($sql2);
		$rec = $result->fetch_assoc();
		$cor = $rec['id'];
		
		$sql1	= "
			SELECT
				transaksi.id
			FROM
				`transaksi`
			where 
			status = '0' && 
			deleted = '0' && 
			no_meja = '$e' "; 

		$result1	= $conn->query($sql1);
		
		$aassa = 0;
		
		while($rec1 = $result1->fetch_assoc()){
			$asdsad = $rec1['id'];
			$sql2	= "
				SELECT DISTINCT(`id_trans`) as asasas FROM `transaksi_detail` where id_trans = '$asdsad' && deleted = '0' "; 

			$result2	= $conn->query($sql2);
			$rec2 = $result2->fetch_assoc();
			if($rec2['asasas']==""){
				$sql3	= "
					DELETE FROM `transaksi` WHERE `transaksi`.`id` = ".$asdsad.""; 

				$result3	= $conn->query($sql3);
			}else{
				$aassa = $rec['id'];
			}
		}
		
		return $cor;
	}
	
	function void_data($conn,$id,$id1,$id2,$id3,$id11111){		
		$sql	= "
			SELECT
				*
			FROM
				`transaksi`
			where
				transaksi.id  = '$id'"; 

		$result	= $conn->query($sql);
		$rec = $result->fetch_assoc();
		
		$aas = $rec['id'];
		$a = $rec['mprsh'];
		$b = $rec['mcab'];
		$c = $rec['kode'];
		$d = '';
		$e = $rec['no_meja'];
		$f = $rec['discount_type'];
		$g = $rec['nominal'];
		$h = $rec['biaya_ppn'];
		$i = $rec['biaya_service'];
		$j = $rec['ongkos_kirim'];
		$a1 = $rec['sub_ttl'];
		$a2 = $rec['catatan'];
		$a3 = $rec['ket_pmbyrn'];
		$a4 = $rec['status'];
		$a5 = $rec['date_add'];
		
		
		$date 			= new DateTime();
		$var_time 		= $date->format('U');
		
		if($e == '105' || $e == '106' || $e == '103' || $e == '104'){
			$h = '0';
			$i = '0';
		}
		
		$sql1	= "
			INSERT INTO `tr_void`(
				`mprsh`, `mcab`, `id_trans`, `kode`, `id_member`, `no_meja`, 
				`discount_type`, `nominal`, `biaya_ppn`, `biaya_service`, `ongkos_kirim`, 
				`sub_ttl`, `catatan`, `ket_pmbyrn`, `status`, `date_add`, `id_user`
			) VALUES (
				'$a','$b','$aas','$c','$d','$e',
				'$f','$g','$h','$i','$j',
				'$a1','$a2','$a3','$a4','$var_time','$id11111')";
		$result	= $conn->query($sql1);
		
		$sql2	= "
				SELECT
					tr_void.id
				FROM
					`tr_void`
				where
					tr_void.no_meja = '$e' && tr_void.deleted = '0'
				order by
					tr_void.id desc limit 1"; 

		$result	= $conn->query($sql2);
		$rec = $result->fetch_assoc();
		$aassa = $rec['id'];

		$arr = explode(",", $id1);
		$arr2 = explode(",", $id2);
		$arrhitung = count($arr);
	
		$date 			= new DateTime();
		$var_time 		= $date->format('U');
	
		for($ini = 0;$ini<$arrhitung;$ini++){
			$thx = $arr[$ini];
			$thx1 = $arr2[$ini];
			
			$sql3	= "
				SELECT
					*
				FROM
					`transaksi_detail`
				where
					id = '$thx' && deleted = '0'
				order by
					id desc limit 1"; 

			$result3	= $conn->query($sql3);
			$rec3 = $result3->fetch_assoc();
			
			$aa = $rec3['mprsh']; $ba = $rec3['mcab']; $ca = $rec3['id_trans']; $da = $rec3['id_utm']; $ea = $rec3['id_child'];
			$aa1 = $rec3['id_item']; $ba1 = $rec3['ckode']; $ca1 = $rec3['tambahan']; $da1 = $rec3['total']; $ea1 = $rec3['discount_type'];
			$aa2 = $rec3['nominal']; $ba2 = $rec3['harga']; $ca2 = $rec3['catatan']; $da2 = $rec3['stat_simpan']; $ea2 = $rec3['stat_print'];
			$aaid_user2 = $rec3['id_user'];
			
			$oyiaa = $rec3['total'];
			
			$oyis = $oyiaa-$thx1;
			
			
			
			if($oyis == '0'){
				$sqlhasil	= "
					UPDATE
						`transaksi_detail`
					SET
						id_trans = '',
						id_tr_void = '$aassa'
					WHERE
						id = '$thx'";
				
				$resulthasil	= $conn->query($sqlhasil);
				
			}else{
				$sqltbh	= "
					INSERT INTO `transaksi_detail` 
					(
					`mprsh`, `mcab`,`id_tr_void`, `id_utm`, `id_child`, 
					`id_item`, `ckode`, `tambahan`, `total`, `discount_type`, 
					`nominal`, `harga`, `catatan`, `stat_simpan`, `stat_print`, `date_add`,`id_user`
					) VALUES 
					(
					'$aa', '$ba','$aassa', '$da', '$ea',
					'$aa1', '$ba1', '$ca1', '$thx1', '$ea1',
					'$aa2', '$ba2', '$ca2', '$da2', '$ea2', '$var_time', '$aaid_user2'
					);";
						
				$resulttbh	= $conn->query($sqltbh);
				
				
				$sqlhasil	= "
					UPDATE
						`transaksi_detail`
					SET
						total = '$oyis'
					WHERE
						id = '$thx'";
							
				$resulthasil	= $conn->query($sqlhasil);
				
				$sqllstadons1	= "
					SELECT
						id
					FROM
						`transaksi_detail`
					where
						id_trans = '$aassa' && id_item = '$aa1' && total = '$thx1' && harga = '$ba2' && date_add = '$var_time' && deleted = '0'&& deleted = '0'
					order by
						id desc limit 1"; 

				$resultlstadons1	= $conn->query($sqllstadons1);
				$reclstadons1 = $resultlstadons1->fetch_assoc();
				
				$aalstadons1111 = $reclstadons1['id'];
				
				$sqllstadons	= "
					SELECT
						*
					FROM
						`transaksi_addon`
					where
						id_transaksi_detail = '$thx' && deleted = '0'
					order by
						id desc"; 

				$resultlstadons	= $conn->query($sqllstadons);
				
				while($reclstadons1 = $reclstadons = $resultlstadons->fetch_assoc()){
				
					$aalstadons1 = $reclstadons['id_transaksi_detail'];
					$aalstadons2 = $reclstadons['id_item'];
					$aalstadonsnm = $reclstadons['nama'];
					$aalstadons3 = $reclstadons['total'];
					$aalstadons4 = $reclstadons['harga'];
					$aalstadons5 = $reclstadons['date_add'];
					
					$sqlhasil1111	= "
						INSERT INTO `transaksi_addon` 
						(
						`mprsh`, `mcab`,`id_transaksi_detail`, `id_item`, `nama`, `ckode`, 
						`keterangan`, `tambahan`, `total`, `discount_type`, `nominal`, 
						`harga`, `catatan`, `stat_simpan`, `stat_print`, `date_add`
						) VALUES 
						(
						'3', '4','$aalstadons1111', '$aalstadons2', '$aalstadonsnm', '0',
						'', '0', '$aalstadons3', '1', '0',
						'$aalstadons4', '', '0', '0', '$var_time'
						);";
					
					$resulthasil1111	= $conn->query($sqlhasil1111);
				}
			}	
		}
		$sql2	= "
				SELECT
					transaksi.id
				FROM
					`transaksi`
				where
					transaksi.no_meja = '$e' && transaksi.deleted = '0'
				order by
					transaksi.id desc limit 1"; 

		$result	= $conn->query($sql2);
		$rec = $result->fetch_assoc();
		$cor = $rec['id'];
		
		$sql1	= "
			SELECT
				transaksi.id
			FROM
				`transaksi`
			where 
			status = '0' && 
			deleted = '0' && 
			no_meja = '$e' "; 

		$result1	= $conn->query($sql1);
		
		$aassa = 0;
		
		while($rec1 = $result1->fetch_assoc()){
			$asdsad = $rec1['id'];
			$sql2	= "
				SELECT DISTINCT(`id_trans`) as asasas FROM `transaksi_detail` where id_trans = '$asdsad' && deleted = '0' "; 

			$result2	= $conn->query($sql2);
			$rec2 = $result2->fetch_assoc();
			if($rec2['asasas']==""){
				$sql3	= "
					DELETE FROM `transaksi` WHERE `transaksi`.`id` = ".$asdsad.""; 

				$result3	= $conn->query($sql3);
			}else{
				$aassa = $rec['id'];
			}
		}
		
		return $cor;
	}
	
	function biaya_biaya($conn,$id,$id1,$id2){
		if($id1 == 1){
			$sql	= "
				UPDATE
					`transaksi`
				SET
					biaya_service = '$id2'
				WHERE
					id = '$id'";
		}else if($id1 == 2){
			$sql	= "
				UPDATE
					`transaksi`
				SET
					biaya_ppn = '$id2'
				WHERE
					id = '$id'";
		}
		$result	= $conn->query($sql);
		
		return $result;
	}
	function simpan_nama($conn,$id,$id1){
		$sql	= "
			UPDATE
				`transaksi`
			SET
				nama = '$id1'
			WHERE
				id = '$id'";
		
		$result	= $conn->query($sql);
		
		return $result;
	}
	
	function simpan_members($conn,$id){
		$sql	= "
			UPDATE
				transaksi
			SET
				id_member = '0'
			WHERE
				id = '$id'";

		$result	= $conn->query($sql);
		
		return $result;
	}
	
	function simpan_member($conn,$id,$id1){	
		$sql	= "
			SELECT 
				user.id_user,
				user.barcode, 
				user.nama, 
				user.id_user_category, 
				user_category.discount
			FROM `user`
			inner join 
				user_category
			on
				user_category.id_category = user.id_user_category
			where
				user.deleted = 0 && user_category.deleted = 0 && user.barcode = '$id'"; 

		$result	= $conn->query($sql);
		$record	= array();
		$rec = $result->fetch_assoc();
		$nmm = $rec['nama'];
		$id_user = $rec['id_user'];
	
		$sql	= "
			UPDATE
				transaksi
			SET
				nama = '$nmm',
				id_member = '$id_user'
			WHERE
				id = '$id1'";

		$result	= $conn->query($sql);
		
		return $result;
	}
	function shows($conn,$pilihan_meja){
		
		$date 			= new DateTime();
		$var_time 		= $date->format('U');
		
		$h = '1';
		$i = '1';
		
		if($pilihan_meja == '105' || $pilihan_meja == '106' || $pilihan_meja == '103' || $pilihan_meja == '104'){
			$h = '0';
			$i = '0';
		}
		
		$sql	= "
			INSERT INTO `transaksi` 
				(
				`id`, `mprsh`, `mcab`, `kode`, `id_member`,
				`no_meja`, `discount_type`, `nominal`, `biaya_ppn`, `biaya_service`, 
				`ongkos_kirim`, `sub_ttl`, `catatan`,
				`ket_pmbyrn`, `status`, `date_add`, `deleted`
				) 
				VALUES
				(
				NULL, '3', '4', '', '',
				'$pilihan_meja', NULL, '', '$h', '$i',
				NULL, NULL, '', '', '0', '$var_time', '0'
				);";
				
		$result	= $conn->query($sql);
		
		$sql	= "
			SELECT
				id
			FROM
				`transaksi`
			where
				status = '0' && deleted = '0' && no_meja = '$pilihan_meja'
			order by
				id desc limit 1"; 

		$result	= $conn->query($sql);
		$record	= array();
		$rec = $result->fetch_assoc();
		$aassa = $rec['id'];
	
		return $aassa;
		
		
	}
	
	function show($conn,$pilihan_meja){
		if($pilihan_meja=="99"){
			$sql	= "
				SELECT
					id
				FROM
					`transaksi`
				where
					status = '0' && deleted = '0' && no_meja = '$pilihan_meja'
				order by
					id desc limit 1"; 

			$result	= $conn->query($sql);
			$record	= array();
			$rec = $result->fetch_assoc();
			
		}else{
			$aassa = '';
			$sql	= "
				SELECT
					id
				FROM
					`transaksi`
				where
					status = '0' && deleted = '0' && no_meja = '$pilihan_meja'
				order by
					id desc limit 1"; 

			$result	= $conn->query($sql);
			$record	= array();
			$rec = $result->fetch_assoc();
			$aassa = $rec['id'];
			
			$date 			= new DateTime();
			$var_time 		= $date->format('U');
			
			if($aassa==null){
				
				$h = '1';
				$i = '1';
				
				if($pilihan_meja == '105' || $pilihan_meja == '106' || $pilihan_meja == '103' || $pilihan_meja == '104'){
					$h = '0';
					$i = '0';
				}
		
				$sql	= "
					INSERT INTO `transaksi` 
						(
						`id`, `mprsh`, `mcab`, `kode`, `id_member`, `no_meja`, `discount_type`, 
						`nominal`, `biaya_ppn`, `biaya_service`, `ongkos_kirim`, `sub_ttl`, `catatan`,
						`ket_pmbyrn`, `status`, `date_add`, `deleted`
						) 
						VALUES
						(
						NULL, '3', '4', '', '','$pilihan_meja', NULL, '', '$h', 
						'$i', NULL, NULL, '', '', '0', '$var_time', '0'
						);";
						
				$result	= $conn->query($sql);
				
				$sql	= "
					SELECT
						id
					FROM
						`transaksi`
					where
						status = '0' && deleted = '0' && no_meja = '$pilihan_meja'
					order by
						id desc limit 1"; 

				$result	= $conn->query($sql);
				$record	= array();
				$rec = $result->fetch_assoc();
				$aassa = $rec['id'];
			}
			
			return $aassa;
		}
		
		
	}
	function show_total($conn,$pilihan_meja){
		$sql	= "
		SELECT * FROM `transaksi` where transaksi.status = '0' && transaksi.deleted = '0' && transaksi.no_meja = '$pilihan_meja' order by transaksi.id desc";

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
	function show_ngrep($conn,$pilihan_meja){
		$sql	= "
		SELECT 
			DISTINCT(`id_trans`),
			COUNT(DISTINCT(`id_trans`)) as 'oyi' 
		FROM `transaksi_detail` 
		inner join transaksi on 
		transaksi.id = transaksi_detail.id_trans 
		where 
			transaksi.status = '0' && 
			transaksi.deleted = '0' && 
			transaksi.no_meja = '$pilihan_meja' 
		order by transaksi.id desc ";

		$result	= $conn->query($sql);
		$rec = $result->fetch_assoc();
		$ae = $rec['oyi'];

		return $ae;
	}
	function show_ngarep($conn,$pilihan_meja){
		$sql	= "
		SELECT 
			DISTINCT(`id_trans`),
			COUNT(DISTINCT(`id_trans`)) as 'oyi' 
		FROM `transaksi_detail` 
		inner join transaksi on 
		transaksi.id = transaksi_detail.id_trans 
		where 
			transaksi.status = '0' && 
			transaksi.deleted = '0' && 
			transaksi.no_meja = '$pilihan_meja' 
		order by transaksi.id desc ";

		$result	= $conn->query($sql);
		$rec = $result->fetch_assoc();
		$ae = $rec['oyi'];
		
		$sql1	= "
			SELECT
				transaksi.id
			FROM
				`transaksi`
			where 
			status = '0' && 
			deleted = '0' && 
			no_meja = '$pilihan_meja' "; 

		$result1	= $conn->query($sql1);
		
		$aassa = 0;
		
		while($rec1 = $result1->fetch_assoc()){
			$asdsad = $rec1['id'];
			$sql2	= "
				SELECT DISTINCT(`id_trans`) as asasas FROM `transaksi_detail` where id_trans = '$asdsad' && deleted = '0' "; 

			$result2	= $conn->query($sql2);
			$rec2 = $result2->fetch_assoc();
			if($rec2['asasas']==""){
				$sql3	= "
					DELETE FROM `transaksi` WHERE `transaksi`.`id` = ".$asdsad.""; 

				$result3	= $conn->query($sql3);
			}else{
				$aassa = $rec['id'];
			}
		}
		
		return $ae;
	}
	function show_ngareps($conn,$pilihan_meja){
		$sql	= "
		SELECT 
			DISTINCT(`id_trans`),
			COUNT(DISTINCT(`id_trans`)) as 'oyi' 
		FROM `transaksi_detail` 
		inner join transaksi on 
		transaksi.id = transaksi_detail.id_trans 
		where 
			transaksi.status = '0' && 
			transaksi.deleted = '0' && 
			transaksi.no_meja = '$pilihan_meja' 
		order by transaksi.id desc ";

		$result	= $conn->query($sql);
		$rec = $result->fetch_assoc();
		$ae = $rec['oyi'];
		
		// $sql1	= "
			// SELECT
				// transaksi.id
			// FROM
				// `transaksi`
			// where 
			// status = '0' && 
			// deleted = '0' && 
			// no_meja = '$pilihan_meja' "; 

		// $result1	= $conn->query($sql1);
		
		// $aassa = 0;
		
		// while($rec1 = $result1->fetch_assoc()){
			// $asdsad = $rec1['id'];
			// $sql2	= "
				// SELECT DISTINCT(`id_trans`) as asasas FROM `transaksi_detail` where id_trans = '$asdsad' && deleted = '0' "; 

			// $result2	= $conn->query($sql2);
			// $rec2 = $result2->fetch_assoc();
			// if($rec2['asasas']==""){
				// $sql3	= "
					// DELETE FROM `transaksi` WHERE `transaksi`.`id` = ".$asdsad.""; 

				// $result3	= $conn->query($sql3);
			// }else{
				// $aassa = $rec['id'];
			// }
		// }
		
		return $ae;
	}
	function show_transaksis($conn,$pilihan_meja,$id){
		
		$aassa = 0;
		$sql	= "
				SELECT
					transaksi.id,
					transaksi.id_member
				FROM
					`transaksi`
				where
					transaksi.status = '0' && transaksi.deleted = '0' && transaksi.no_meja = '$pilihan_meja' && transaksi.id = '$id'
				order by
					transaksi.id desc limit 1"; 

		$result	= $conn->query($sql);
		$rec = $result->fetch_assoc();
		$aassa = $rec['id'];
		$member = $rec['id_member'];
				
		if($member != 0){
			$sql	= "
				SELECT
					transaksi_detail.id,
					transaksi_detail.id_trans,
					transaksi_detail.id_utm,
					transaksi_detail.id_child,
					transaksi_detail.id_item,
					transaksi.id_member,
					transaksi.nama as nm_tr,
					transaksi.voucher,
					transaksi.biaya_ppn,
					transaksi.biaya_service,
					transaksi.nama as nm_tr,
					user.barcode,
					user.deposit,
					user_category.discount,
					mkat2.dis,
					mkat2.dis_otmtis,
					mbrg.mkat2,
					mbrg.kode,
					mbrg.nama,
					transaksi_detail.ckode,
					transaksi_detail.tambahan,
					transaksi_detail.total,
					transaksi_detail.discount_type,
					transaksi_detail.nominal,
					transaksi_detail.harga as hrg,
					transaksi_detail.harga,
					transaksi_detail.catatan,
					transaksi_detail.stat_print,
					transaksi_detail.stat_simpan,
					transaksi_detail.date_add,
					transaksi_detail.deleted
				FROM
					`transaksi_detail`
				inner join
					mbrg
				ON
					mbrg.kode = transaksi_detail.id_item
				inner join
					transaksi
				ON
					transaksi.id = transaksi_detail.id_trans
				inner join
					user
				ON
					user.id_user = transaksi.id_member
				inner join
					user_category
				ON
					user_category.id_category = user.id_user_category
				inner join
					mkat2
				ON
					mkat2.kode = mbrg.mkat2
				where
					transaksi_detail.deleted = '0' && transaksi_detail.id_trans = '$aassa'
				order by
					transaksi_detail.id asc"; 
		}else{
			$sql	= "
				SELECT
					transaksi_detail.id,
					transaksi_detail.id_trans,
					transaksi_detail.id_utm,
					transaksi_detail.id_child,
					transaksi_detail.id_item,
					transaksi.voucher,
					transaksi.biaya_ppn,
					transaksi.biaya_service,
					transaksi.id_member,
					transaksi.nama as nm_tr,
					mbrg.kode,
					mbrg.nama,
					transaksi_detail.ckode,
					transaksi_detail.tambahan,
					transaksi_detail.total,
					transaksi_detail.discount_type,
					transaksi_detail.nominal,
					transaksi_detail.harga as hrg,
					transaksi_detail.harga,
					transaksi_detail.catatan,
					transaksi_detail.stat_print,
					transaksi_detail.stat_simpan,
					transaksi_detail.date_add,
					transaksi_detail.deleted
				FROM
					`transaksi_detail`
				inner join
					mbrg
				ON
					mbrg.kode = transaksi_detail.id_item
				inner join
					transaksi
				ON
					transaksi.id = transaksi_detail.id_trans
				where
					transaksi_detail.deleted = '0' && transaksi_detail.id_trans = '$aassa'
				order by
					transaksi_detail.id asc";
		}
		

		$result	= $conn->query($sql);
		$record	= array();
		if($result){
			if(!empty($result)){
				while($rec = $result->fetch_assoc()){
					$record[]	= $rec;
				}
			}
		}
		return $record;
	}
	
	
	
	function show_transaksi($conn,$pilihan_meja){
		
		$aassa = 0;
		$sql	= "
				SELECT
					transaksi.id,
					transaksi.id_member
				FROM
					`transaksi`
				where
					transaksi.status = '0' && transaksi.deleted = '0' && transaksi.no_meja = '$pilihan_meja'
				order by
					transaksi.id desc limit 1"; 

		$result	= $conn->query($sql);
		$rec = $result->fetch_assoc();
		$aassa = $rec['id'];
		$member = $rec['id_member'];
				
		if($member != 0){
			$sql	= "
				SELECT
					transaksi_detail.id,
					transaksi_detail.id_trans,
					transaksi_detail.id_utm,
					transaksi_detail.id_child,
					transaksi_detail.id_item,
					transaksi.id_member,
					transaksi.nama as nm_tr,
					transaksi.biaya_ppn,
					transaksi.biaya_service,
					transaksi.discount_type as dsc_tp,
					transaksi.ongkos_kirim,
					transaksi.voucher,
					user.barcode,
					user.deposit,
					user_category.discount,
					mkat2.dis,
					mkat2.dis_otmtis,
					mbrg.mkat2,
					mbrg.kode,
					mbrg.nama,
					transaksi_detail.harga as hrg,
					transaksi_detail.ckode,
					transaksi_detail.tambahan,
					transaksi_detail.total,
					transaksi_detail.discount_type,
					transaksi_detail.nominal,
					transaksi_detail.harga,
					transaksi_detail.keterangan,
					transaksi_detail.catatan,
					transaksi_detail.stat_print,
					transaksi_detail.stat_simpan,
					transaksi_detail.date_add,
					muser.ckode as nama_input,
					transaksi_detail.deleted
				FROM
					`transaksi_detail`
				inner join
					mbrg
				ON
					mbrg.kode = transaksi_detail.id_item
				inner join
					transaksi
				ON
					transaksi.id = transaksi_detail.id_trans
				inner join
					user
				ON
					user.id_user = transaksi.id_member
				inner join
					user_category
				ON
					user_category.id_category = user.id_user_category
				inner join
					mkat2
				ON
					mkat2.kode = mbrg.mkat2
				inner join
					muser
				ON
					muser.no = transaksi_detail.id_user
				where
					transaksi_detail.deleted = '0' && transaksi_detail.id_trans = '$aassa'
				order by
					transaksi_detail.id asc"; 
		}else{
			$sql	= "
				SELECT
					transaksi_detail.id,
					transaksi_detail.id_trans,
					transaksi_detail.id_utm,
					transaksi_detail.id_child,
					transaksi_detail.id_item,
					transaksi.biaya_ppn,
					transaksi.biaya_service,
					transaksi.id_member,
					transaksi.discount_type as dsc_tp,
					transaksi.ongkos_kirim,
					transaksi.nama as nm_tr,
					transaksi_detail.keterangan,
					transaksi.voucher,
					mbrg.kode,
					mbrg.nama,
					transaksi_detail.harga as hrg,
					transaksi_detail.ckode,
					transaksi_detail.tambahan,
					transaksi_detail.total,
					transaksi_detail.discount_type,
					transaksi_detail.nominal,
					transaksi_detail.harga,
					transaksi_detail.catatan,
					transaksi_detail.stat_print,
					transaksi_detail.stat_simpan,
					transaksi_detail.date_add,
					muser.ckode as nama_input,
					transaksi_detail.deleted
				FROM
					`transaksi_detail`
				inner join
					mbrg
				ON
					mbrg.kode = transaksi_detail.id_item
				inner join
					transaksi
				ON
					transaksi.id = transaksi_detail.id_trans
				inner join
					muser
				ON
					muser.no = transaksi_detail.id_user
				where
					transaksi_detail.deleted = '0' && transaksi_detail.id_trans = '$aassa'
				order by
					transaksi_detail.id asc";
		}
		

		$result	= $conn->query($sql);
		$record	= array();
		if($result){
			if(!empty($result)){
				while($rec = $result->fetch_assoc()){
					$record[]	= $rec;
				}
			}
		}
		return $record;
	}
	function insert($conn,$id,$id1,$id2){
		$date 			= new DateTime();
		$var_time 		= $date->format('U');
		
		$sql011	= "
			SELECT
				no_meja
			FROM 
				`transaksi`
			WHERE 
				id = '$id1'";
				
		$result01	= $conn->query($sql011);
		$rec01 = $result01->fetch_assoc();
		$nmkll= $rec01['no_meja'];
		
		
		$sql11	= "
			SELECT
				mbrg.hrg,
				mbrg.nhargagrab,
				mbrg.nhargagojek
			FROM 
				`mbrg`
			WHERE 
				kode = '$id' && sthapus = 0";
				
		$result11	= $conn->query($sql11);
		$rec11 = $result11->fetch_assoc();
		if($nmkll == 103){
			$hrga= $rec11['nhargagrab'];
		}else if($nmkll == 104){
			$hrga= $rec11['nhargagojek'];
		}else{
			$hrga= $rec11['hrg'];
		}
		
		
		$sql	= "
			INSERT INTO `transaksi_detail` 
			(
			`id`, `mprsh`, `mcab`,`id_trans`, `id_utm`, `id_child`, `id_item`, `ckode`, 
			`tambahan`, `total`, `discount_type`, `nominal`, `harga`, `catatan`, `date_add`, `id_user`, `deleted`
			) VALUES 
			(
			NULL, '3', '4','$id1', '', '0', '$id', '', 
			'', '1', '', '', '$hrga', '', '$var_time', '$id2', '0'
			);";
				
		$result	= $conn->query($sql);
		return $result;
	}
	function tambah_addons($conn,$id,$id1){
		$date 			= new DateTime();
		$var_time 		= $date->format('U');
		
		$sql011	= "
			SELECT transaksi.no_meja FROM `transaksi` inner JOIN `transaksi_detail` ON transaksi_detail.id_trans = transaksi.id WHERE transaksi_detail.id = '$id1'";
				
		$result01	= $conn->query($sql011);
		$rec01 = $result01->fetch_assoc();
		$nmkll= $rec01['no_meja'];
		
		
		$sql11	= "
			SELECT
				mbrg.nama,
				mbrg.hrg,
				mbrg.nhargagrab,
				mbrg.nhargagojek
			FROM 
				`mbrg`
			WHERE 
				kode = '$id' && sthapus = 0";
				
		$result11	= $conn->query($sql11);
		$rec11 = $result11->fetch_assoc();
		if($nmkll == 103){
			$hrga= $rec11['nhargagrab'];
		}else if($nmkll == 104){
			$hrga= $rec11['nhargagojek'];
		}else{
			$hrga= $rec11['hrg'];
		}
			$namaasdasd= $rec11['nama'];
		
		$sql	= "
			INSERT INTO `transaksi_addon` 
			(
			`id`, `mprsh`, `mcab`,`id_transaksi_detail`, `id_item`, `nama`,
			`ckode`, `keterangan`, `tambahan`, `total`, `discount_type`, 
			`nominal`, `harga`, `catatan`, `date_add`, `deleted`
			) VALUES 
			(
			NULL, '3', '4','$id1', '$id', '$namaasdasd',
			'0', '', '0', '1', '1', 
			'0', '$hrga', '', '$var_time', '0'
			);";
				
		$result	= $conn->query($sql);
		return $result;
	}
	function show_add_on($conn,$id,$id1){
		$sql	= "
			SELECT 
				transaksi_addon.id,
				transaksi_addon.id_transaksi_detail,
				transaksi_addon.id_item,
				mbrg.nama,
				mbrg.nhargagrab,
				mbrg.nhargagojek,
				transaksi_addon.harga as hrg,
				transaksi_addon.id_transaksi_detail,
				transaksi_detail.stat_simpan,
				transaksi_addon.total
			FROM 
				`transaksi_addon`
			inner join
				`mbrg`
			on
				mbrg.kode = transaksi_addon.id_item
			inner join
				`transaksi_detail`
			on
				transaksi_detail.id = transaksi_addon.id_transaksi_detail
			WHERE 
				transaksi_addon.id_transaksi_detail = '$id' && transaksi_addon.deleted = 0 
			order by transaksi_addon.id asc";
			

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
	
	function show_add_onsssss($conn,$id,$id1){
		$sql	= "
			SELECT
				stat_simpan
			FROM 
				`transaksi_detail`
			
			WHERE 
				id = '$id' && stat_simpan = '0'";
			

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
	function kurangi($conn,$id,$id1){
		if($id1==1){
			$sql1	= "
				DELETE FROM `transaksi_detail` WHERE `transaksi_detail`.`id` = '$id'";
			$result	= $conn->query($sql1);
			$sql	= "
				DELETE FROM `transaksi_addon` WHERE `transaksi_addon`.`id_transaksi_detail` = '$id'";
				
		}else{
			$id1 = $id1-1;
			$sql	= "
				UPDATE `transaksi_detail` SET `total` = '$id1' WHERE `transaksi_detail`.`id` = '$id'";
		}
				
		$result	= $conn->query($sql);
		return $result;
	}
	function kurangi_order_addons($conn,$id,$id1){
		if($id1==1){
			$sql	= "
				DELETE FROM `transaksi_addon` WHERE `transaksi_addon`.`id` = '$id'";
				
		}else{
			$id1 = $id1-1;
			$sql	= "
				UPDATE `transaksi_addon` SET `total` = '$id1' WHERE `transaksi_addon`.`id` = '$id'";
		}
				
		$result	= $conn->query($sql);
		return $result;
	}
	function tambahi($conn,$id,$id1){
		$id1 = $id1+1;
		$sql	= "
			UPDATE `transaksi_detail` SET `total` = '$id1' WHERE `transaksi_detail`.`id` = '$id'";
				
		$result	= $conn->query($sql);
		return $result;
	}
	function tambahi_order_addons($conn,$id,$id1){
		$id1 = $id1+1;
		$sql	= "
			UPDATE `transaksi_addon` SET `total` = '$id1' WHERE `transaksi_addon`.`id` = '$id'";
				
		$result	= $conn->query($sql);
		return $result;
	}
	function ganti_voucherrr($conn,$id,$id1){
		$sql	= "
			UPDATE `transaksi` SET `voucher` = '$id1' WHERE `transaksi`.`id` = '$id'";
				
		$result	= $conn->query($sql);
		return $result;
	}
	function ganti_diskont($conn,$id,$id1){
		$sql	= "
			UPDATE `transaksi` SET `discount_type` = '$id1' WHERE `transaksi`.`id` = '$id'";
				
		$result	= $conn->query($sql);
		return $result;
	}
	function ganti_diskonts($conn,$id,$id1){
		$sql	= "
			UPDATE `transaksi_detail` SET `discount_type` = '$id1' WHERE `transaksi_detail`.`id` = '$id'";
				
		$result	= $conn->query($sql);
		return $result;
	}
	function ganti_ongkir($conn,$id,$id1){
		$sql	= "
			UPDATE `transaksi` SET `ongkos_kirim` = '$id1' WHERE `transaksi`.`id` = '$id'";
				
		$result	= $conn->query($sql);
		return $result;
	}
	function ganti_keterangan($conn,$id,$id1){
		$sql	= "
			UPDATE `transaksi_detail` SET `keterangan` = '$id1' WHERE `transaksi_detail`.`id` = '$id'";
				
		$result	= $conn->query($sql);
		return $result;
	}
	function tttttt($conn,$id,$id1){
		
		if($id1==0){
			$sql1	= "
				DELETE FROM `transaksi_detail` WHERE `transaksi_detail`.`id` = '$id'";
			$result	= $conn->query($sql1);
			$sql	= "
				DELETE FROM `transaksi_addon` WHERE `transaksi_addon`.`id_transaksi_detail` = '$id'";
				
		}else{
			$sql	= "
				UPDATE `transaksi_detail` SET `total` = '$id1' WHERE `transaksi_detail`.`id` = '$id'";
		}
				
		$result	= $conn->query($sql);
		return $result;
	}
	
	function save($conn,$id){		
		$sql	= "
			UPDATE
				transaksi_detail
			SET
				stat_simpan = '1'
			WHERE
				id_trans = '$id'";

		$result	= $conn->query($sql);
		
		return $result;
	}
	function print_data($conn,$id){		
		$sql	= "
			UPDATE
				transaksi_detail
			SET
				stat_print = '1'
			WHERE
				id_trans = '$id'";

		$result	= $conn->query($sql);
		
		return $result;
	}
}
$transaksi	= new transaksi();
?>