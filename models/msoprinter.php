<?php
class msoprinter{
	function show($conn){
		$sql	= "
		SELECT
			*
		FROM
			`msoprinter`";

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
$msoprinter	= new msoprinter();
?>