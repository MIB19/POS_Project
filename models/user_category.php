<?php
class user_category{
	function show($conn){
		$sql	= "
		SELECT
			*
		FROM
			`user_category`
		where 
			deleted = '0'
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
	function insert($conn){
		$nama_category		= $_POST['nama_category'];
		$discount			= $_POST['discount'];
		
		$sql	= "
			INSERT INTO 
				`user_category`(
					`nama_category`, 
					`discount`
				) 
				VALUES (
					'$nama_category',
					'$discount'
				)";
						
		$result	= $conn->query($sql);
		
		header("location:$config->base_url"."user_category.html");
	}
	function select($conn,$id){
		$id		= mysqli_real_escape_string($conn,$id);

		$sql	= "
		SELECT
			*
		FROM
			user_category
		WHERE
			user_category.id_category = '$id'";
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
	function select_kategory($conn,$id){
		$id		= mysqli_real_escape_string($conn,$id);

		$sql	= "
		SELECT
			*
		FROM
			mkat2
		WHERE
			mkat2.no = '$id'";
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
	function update_kategory($conn){
		$no				= $_POST['no'];
		$nama			= $_POST['nama'];
		$mprint			= $_POST['mprint'];
		$dis_otmtis		= $_POST['dis_otmtis'];
		$dis			= $_POST['dis'];
		
		$sql	= "
			UPDATE
				mkat2
			SET
				nama 			= '$nama',
				mprint 			= '$mprint',
				dis_otmtis		= '$dis_otmtis',
				dis 	  		= '$dis'
			WHERE
				no = '$no'";
						
		$result	= $conn->query($sql);
		
		header("location:$config->base_url"."kategory.html");
	}
	
	function update($conn){
		$id_category		= $_POST['id_category'];
		$nama_category		= $_POST['nama_category'];
		$discount			= $_POST['discount'];
		
		$sql	= "
			UPDATE
				user_category
			SET
				nama_category = '$nama_category',
				discount 	  = '$discount'
			WHERE
				id_category = '$id_category'";
						
		$result	= $conn->query($sql);
		
		header("location:$config->base_url"."user_category.html");
	}
	function hapus_kategory($conn,$id){		
		$sql	= "
			UPDATE
				`mkat2`
			SET
				sthapus = '1'
			WHERE
				no = '$id'";

		$result	= $conn->query($sql);
		
		return $result;
	}
	function hapus($conn,$id){		
		$sql	= "
			UPDATE
				user_category
			SET
				deleted = '1'
			WHERE
				id_category = '$id'";

		$result	= $conn->query($sql);
		
		return $result;
	}
	
}
$user_category	= new user_category();
?>