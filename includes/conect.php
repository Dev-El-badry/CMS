<?php
	
	$host = 'mysql:host=localhost;dbname=website';
	$user = 'root';
	$pass = '';

	$option = [
		'PDO:MYSQL_ATTR_INIT_COMMAND' => 'SET NAMES utf8'
	];

	try {
		$con = new PDO($host, $user, $pass, $option);

		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	} catch(PDOException $e) {
		echo "Failed To Connection With Database" . $e->getMessage() ;
	}