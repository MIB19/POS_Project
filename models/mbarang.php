<?php
class mbarang{
	function show($conn){
		
		$sql	= "
		SELECT
			mbrg.no,
			mbrg.kode,
			mbrg.nama,
			mbrg.mkat2,
			mkat2.nama as nama_kategory,
			mkat2.kode as kode_kat,
			mbrg.hrg,
			mbrg.nhargagrab,
			mbrg.nhargagojek
		FROM
			`mbrg`
		inner join
			`mkat2`
		on
			mkat2.kode = mbrg.mkat2
		where 
			mbrg.staktif = '1' && mbrg.sthapus = '0' && mbrg.staddon = '0'
		order by mbrg.no desc
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
	function show_paket($conn){
		$sql	= "
		SELECT
			mbrg.no,
			mbrg.kode,
			mbrg.nama,
			mbrg.mkat2,
			mkat2.nama as nama_kategory,
			mbrg.hrg,
			mbrg.nhargagrab,
			mbrg.nhargagojek
		FROM
			`mbrg`
		inner join
			`mkat2`
		on
			mkat2.kode = mbrg.mkat2
		where 
			mbrg.staktif = '1' && mbrg.sthapus = '0' && mkat2.kode = 'PK'
		order by mbrg.no desc
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
	
	function show_item_paket($conn){
		$sql	= "
		SELECT
			tbarang_paket.id,
			mbrg.nama as name,
			tbarang_paket.mkat2,
			tbarang_paket.ckode,
			tbarang_paket.nama,
			tbarang_paket.kategory,
			tbarang_paket.ket_kategory,
			tbarang_paket.qty,
			tbarang_paket.deleted
		FROM
			`tbarang_paket`
		inner join
			`mbrg`
		on
			mbrg.kode = tbarang_paket.mkat2
		where 
			tbarang_paket.deleted = '0' && mbrg.sthapus = '0'
		order by tbarang_paket.id desc
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
	function showssss($conn,$id){
		
		$sql1	= "
		SELECT
			transaksi_detail.id_item,
            mbrg.mkat2
		FROM
			`transaksi_detail`
        inner join `mbrg`
        on transaksi_detail.id_item = mbrg.kode
		where 
			transaksi_detail.id = '$id'";
		$result1	= $conn->query($sql1);
		$rec1 = $result1->fetch_assoc();
		$asdafadsf= $rec1['mkat2'];

		$sql	= "
			SELECT * FROM `mbrg` WHERE mbrg.mkat2 = '$asdafadsf' && mbrg.staddon = 1";
			

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
	function insert($conn,$id11111){
		$nama			= $_POST['nama'];
		$kode			= $_POST['kode'];
		$kat2			= $_POST['kat2'];
		$harga1			= $_POST['harga1'];
		$harga2			= $_POST['harga2'];
		$harga3			= $_POST['harga3'];
		$addons			= $_POST['addons'];
		
		$sql	= "
			INSERT INTO `mbrg`(
				`mprsh`, `mcab`, `kode`, `nama`, `mkat1`, 
				`mkat2`, `hrg`, `nhargagrab`, `nhargagojek`, `gmbr`, 
				`ket`, `staktif`, `sthapus`, `staddon`, `creauser`
			) VALUES (
				'3','4','$kode','$nama','0',
				'$kat2','$harga1','$harga2','$harga3','',
				'','1','0','$addons','$id11111'
			)";
						
		$result	= $conn->query($sql);
		
		header("location:$config->base_url"."item.html");
	}
	function insert_item_paket($conn,$id11111){
		$text1			= $_POST['text1'];
		$text2			= $_POST['text2'];
		$text3			= $_POST['text3'];
		
		$sql	= "
		SELECT
			mbrg.nama,
			mbrg.mkat2,
			mkat2.nama as name
		FROM
			`mbrg`
		inner join
			`mkat2`
		on
			mbrg.mkat2 = mkat2.kode
		where 
			mbrg.kode = '$text2'
		";

		$result	= $conn->query($sql);
		$rec = $result->fetch_assoc();
		$a = $rec['nama'];
		$b = $rec['mkat2'];
		$c = $rec['name'];
		
		$sql	= "
			INSERT INTO `tbarang_paket`(
				`mkat2`, `ckode`, `nama`, `kategory`, 
				`ket_kategory`, `qty`, `date_add`, `deleted`
			) VALUES (
				'$text1','$text2','$a','$b',
				'$c','$text3','0','0'
			)";
						
		$result	= $conn->query($sql);
		
		header("location:$config->base_url"."item_paket.html");
	}
	function select($conn,$id){
		$id		= mysqli_real_escape_string($conn,$id);

		$sql	= "
		SELECT
			mbrg.no,
			mkat2.nama as name,
			mbrg.kode,
			mbrg.nama,
			mbrg.mkat2,
			mbrg.hrg,
			mbrg.nhargagrab,
			mbrg.nhargagojek,
			mbrg.staktif,
			mbrg.sthapus,
			mbrg.staddon,
			mbrg.creauser
		FROM
			mbrg
		inner join
			mkat2
		on
			mbrg.mkat2 = mkat2.kode
		WHERE
			mbrg.no = '$id'";
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
	function update($conn,$id11111){
		$no				= $_POST['no'];
		$nama			= $_POST['nama'];
		$kode			= $_POST['kode'];
		$mkat2			= $_POST['mkat2'];
		$harga1			= $_POST['harga1'];
		$harga2			= $_POST['harga2'];
		$harga3			= $_POST['harga3'];
		
		$sql	= "
			UPDATE
				mbrg
			SET
				nama 			= '$nama',
				kode 			= '$kode',
				mkat2 			= '$mkat2',
				hrg 			= '$harga1',
				nhargagrab		= '$harga2',
				nhargagojek		= '$harga3',
				creauser 	  	= '$id11111'
			WHERE
				no = '$no'";
						
		$result	= $conn->query($sql);
		
		header("location:$config->base_url"."item.html");
	}
	function hapus($conn,$id){		
		$sql	= "
			UPDATE
				mbrg
			SET
				sthapus = '1'
			WHERE
				no = '$id'";

		$result	= $conn->query($sql);
		
		return $result;
	}
	function hapus_item_paket($conn,$id){		
		$sql	= "
			UPDATE
				tbarang_paket
			SET
				deleted = '1'
			WHERE
				id = '$id'";

		$result	= $conn->query($sql);
		
		return $result;
	}
}
$mbarang	= new mbarang();
?>