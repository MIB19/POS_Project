<?php
class muser{
	function show($conn){
		$sql	= "
		SELECT
			*
		FROM
			`muser`
		where 
			deleted = '0'
			order by no desc
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
	function simpan($conn){
		$username			= $_POST['username'];
		$password			= $_POST['password'];
		$akses				= $_POST['akses'];
		$keterangan			= $_POST['keterangan'];
		$va1 	= date("Y-m-d");
		
		$sql	= "
			INSERT INTO `muser`(
				`mprsh`, `mcab`, `ckode`, `cpwd`, `keterangan`, 
				`nlvl`, `nsuper`, `date_add`
				) VALUES (
				'3','4','$username','$password','$keterangan',
				'$akses','0','va1'
				);";
						
		$result	= $conn->query($sql);
		
		header("location:$config->base_url"."user_pegawai.html");
	}
	function select($conn,$id){
		$id		= mysqli_real_escape_string($conn,$id);

		$sql	= "
		SELECT
			*
		FROM
			muser
		WHERE
			muser.no = '$id'";
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
		$no					= $_POST['no'];
		$password			= $_POST['password'];
		$akses				= $_POST['akses'];
		$keterangan			= $_POST['keterangan'];
		
		$sql	= "
			UPDATE
				muser
			SET
				cpwd 			= '$password',
				keterangan 			= '$keterangan',
				nlvl		= '$akses'
			WHERE
				no = '$no'";
						
		$result	= $conn->query($sql);
		
		header("location:$config->base_url"."user_pegawai.html");
	}
	function hapus($conn,$id){		
		$sql	= "
			DELETE FROM `muser` WHERE `muser`.`no` = '$id'";

		$result	= $conn->query($sql);
		
		return $result;
	}
}
$muser	= new muser();
?>