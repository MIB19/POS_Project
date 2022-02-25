<?php
class mkategori{
	function show($conn){
		$sql	= "
		SELECT
			*
		FROM
			`mkat2`
		where sthapus = 0
		order by no desc";

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
		$nama		= $_POST['nama'];
		$kode			= $_POST['kode'];
		$print			= $_POST['print'];
		$dis_otmtis			= $_POST['dis_otmtis'];
		$nominal			= $_POST['nominal'];
		
		$sql	= "
			INSERT INTO `mkat2`(
				`mprsh`, `mcab`, `kode`, `mkat1`, `nama`,
				`mprint`, `dis_otmtis`, `dis`, `ket`, `iv`,
				`stenk`, `staktif`, `sthapus`, `stinput`, `creaIP`,
				`creaWS`, `creauser`, `creaTS`, `lastIP`, `lastWS`,
				`lastuser`, `lastTS`
			) VALUES (
				'3','4','$kode','0','$nama',
				'$print','$dis_otmtis','$nominal','','',
				'0','1','0','1','',
				'','$id11111','0','1','',
				'',''
			)";
						
		$result	= $conn->query($sql);
		
		header("location:$config->base_url"."kategory.html");
	}
}
$mkategori	= new mkategori();
?>