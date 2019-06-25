<?php
	function getDB()
	{
		$dsn = "mysql:host=localhost;dbname=tai_shop";
		$username = "root";
		$password = '';


		try{
			$db = new PDO($dsn, $username, $password);
			return $db;
		} catch (PDOException $e) {
			$error_message = $e->getMessage();
			echo "Eroor connecting to database".$error_message;
		}
	}
?>