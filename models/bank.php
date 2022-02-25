<?php
class bank{
	function show_edc($conn){
		$sql	= "
		SELECT
			*
		FROM
			`master_edc`
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

	function show_bank($conn){
		$sql	= "
		SELECT
			*
		FROM
			`master_bank`
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
}
$bank	= new bank();
?>