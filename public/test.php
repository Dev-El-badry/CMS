<?php 


	function cryptPass($password) {	
		$option = ['cost'=>12];

		$mySalt = md5(uniqid(rand(), true));

		$saltPass = $password . $mySalt;


		$show = password_hash($password, CRYPT_BLOWFISH, $option);

		return $show;

	}

$hash = cryptPass('eslam');
var_dump($hash);
	$res = password_verify('eslam', $hash);
	var_dump($res);
?>