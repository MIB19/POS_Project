<?php
class tbarangpaket{
	function show($conn){
		$sql	= "
		SELECT
			*
		FROM
			`tbarangpaket`";

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
}
$tbarangpaket	= new tbarangpaket();
?>