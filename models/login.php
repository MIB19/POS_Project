<?php
class login{
	function loginss($conn,$username,$password,$urls){
		$sql	= "
		SELECT
			no,ckode,nlvl
		FROM
			`muser`
		where 
			ckode = '$username' && cpwd = '$password' && deleted = '0'";

		$result	= $conn->query($sql);
		$rec = $result->fetch_assoc();
		if($rec['ckode'] != null){
			$_SESSION['pst_klbr'] = $rec['no'].'/'.$rec['ckode'].'/'.$rec['nlvl'];
		}
				
	}
	
}
$login	= new login();
?>