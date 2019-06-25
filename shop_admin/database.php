<?php
	function getDB()
	{
		$dsn = "pgsql:host=ec2-54-221-243-211.compute-1.amazonaws.com;port=5432;dbname=
		d6jmv4urb51qs8";
		$username = 'docokbxiffiwzw';
		$password = '5a923307b82e04e852bb40397b2335a069f3ec647faaebd08ce96877b001baf8';

		try{
			$db = new PDO($dsn, $username, $password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $db;
		} catch (PDOException $e) {
			$error_message = $e->getMessage();
			echo "Eroor connecting to database".$error_message;
		}
	}
?>