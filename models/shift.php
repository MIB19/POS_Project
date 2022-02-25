<?php
class shift{
	function show_shift($conn){
		$sql	= "
			SELECT
				*
			FROM
				`shift`
			where 
				deleted = '0' &&  status = '0'
			";

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
	function insert($conn,$id11111,$vr){
		$date = date('Y-m-d H:i:s', (time()+18000));
		$date1 = date('Y-m-d', (time()+18000));
		
		$sql11	= "
			SELECT
				id
			FROM
				`shift`
			where 
				status = '1' && date_add LIKE '".$date1."%'
			";

		$result1	= $conn->query($sql11);
		$rec1 = $result1->fetch_assoc();
		
		if($rec1['id'] != null){
			$d = $rec1['id'];
			$sqlhasil	= "
			UPDATE
				`shift`
			SET
				status = '0'
			WHERE
				id = '$d'";
				
			$resulthasil	= $conn->query($sqlhasil);
		}
		
		$sql	= "
			INSERT INTO `shift`(
				`ckode`, `ket`, `date_add`, `shift`, `status`
			) VALUES (
				'$id11111','','$date','$vr', '1'
			)";
						
		$result	= $conn->query($sql);
		
		header("location:$config->base_url"."index.html");
	}

	function update($conn,$id11111,$vr){
		$date = date('Y-m-d', (time()+18000));
		$sqlhasil	= "
			UPDATE
				`shift`
			SET
				status = '0'
			WHERE
				shift = '$vr' && date_add LIKE '".$date."%'";
					
		$resulthasil	= $conn->query($sqlhasil);
		
		header("location:$config->base_url"."index.html");
	}

}
$shift	= new shift();
?>