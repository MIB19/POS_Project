<?php

class config{
	public $base_url	= "http://localhost/kollabora/";
	// public $base_url	= "http://192.168.53.76/kollabora/";

	function base_url(){
		return $this->base_url;
	}
	function api_key(){
		return $this->apiKey;
	}
	function server(){
		return $this->database;
	}
}
$config	= new config();
?>