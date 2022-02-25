<?php
class database{
	public $user		= "handitya";
	public $password	= "Bp123456";
	public $database	= "trading_irawan";
	// public $user		= "root";
	// public $password	= "";
	// public $database	= "trading_irawan_koll";
}
$database	= new database();
$conn	        = new mysqli('192.168.53.10',$database->user,$database->password,$database->database);
// $conn	        = new mysqli('localhost',$database->user,$database->password,$database->database);
?>