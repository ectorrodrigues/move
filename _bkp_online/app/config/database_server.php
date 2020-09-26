<?php
	function db () {
		static $conn;

		$servername	= 'mova_bd.mysql.dbaas.com.br';
		$dbname		= 'mova_bd';
		$username	= 'mova_bd';
		$password	= 'Avantemova2016';
		$port = 3306;

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
