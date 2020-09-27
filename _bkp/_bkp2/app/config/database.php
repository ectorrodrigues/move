<?php
	function db () {
		static $conn;

		$servername	= 'localhost';
		$dbname		= 'movedl33_db';
		$username	= 'movedl33_db';
		$password	= '#Avantemova2016';
		$port = 8888;

		try{
			$conn = new PDO("mysql:host=$servername; dbname=$dbname; port=$port", $username, $password);
			// set the PDO error mode to exception
		  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		  $conn->exec("SET NAMES 'utf8'");

		}catch(Exception $e){
		  echo "Error: " . $e->getMessage();
		  exit;
		}

		return $conn;

	}
?>
