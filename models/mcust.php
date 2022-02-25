<?php
class mcust{
	function show($conn){
		$sql	= "
		SELECT
			*
		FROM
			`mcust`";

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
$mcust	= new mcust();
?>