<?php

function cryptPass($password) {	
		$option = ['cost'=>12];

		$mySalt = md5(uniqid(rand(), true));

		//$saltPass = $password . $mySalt;

		$show = password_hash($password, CRYPT_BLOWFISH, $option);

		return $show;

	}

	function succed_msg() {
		$msg ='<div class="alert alert-success" role="alert">Successfully! The Menu Added</div>';

		return $msg;
	}

	function failed_msg() {
		$msg ='<div class="alert alert-danger" role="alert">Sorry Can\'t Added The Page Check .. Your MAke Mistake</div>';

		return $msg;
	}

	function succed_update_msg() {
		$noti ='<div class="alert alert-success" role="alert">Successfully! The Menu updated</div>';

		return $noti;
	}

	function failed_update_msg() {
		$noti ='<div class="alert alert-danger" role="alert">Sorry Can\'t Updated The Page Check .. Your MAke Mistake</div>';

		return $noti;
	}

		function failed_delete_msg() {
		$msg ='<div class="alert alert-danger" role="alert">Sorry Can\'t Deleted The Menu has Content Pages</div>';

		return $msg;
	}

		function succed_delete_msg() {
		$msg ='<div class="alert alert-success" role="alert">Successfully! The Menu Deleted</div>';

		return $msg;
	}

		function failed_delete() {
		$msg ='<div class="alert alert-success" role="alert">Sorry! The Menu Can\'t  Deleted</div>';

		return $msg;
	}

		function succed_update_page_msg() {
		$noti ='<div class="alert alert-success" role="alert">Successfully! The Page updated</div>';

		return $noti;
	}

		function succed_msg_add_admin() {
		$noti ='<div class="alert alert-success" role="alert">Successfully! Added Admin</div>';

		return $noti;
	}

		function failed_msg_add_admin() {
		$noti ='<div class="alert alert-success" role="alert">Failure! Added Admin</div>';

		return $noti;
	}
		function succed_msg_update_admin() {
		$noti ='<div class="alert alert-success" role="alert">Successfully! updated Admin</div>';

		return $noti;
	}

		function failed_msg_update_admin() {
		$noti ='<div class="alert alert-success" role="alert">Failure! updated Admin</div>';

		return $noti;
	}

	function succed_delete_admin_msg() {
		$msg ='<div class="alert alert-success" role="alert">Successfully! Deleted Admin</div>';

		return $msg;
	}

	function failed_delete_admin_msg() {
		$msg ='<div class="alert alert-danger" role="alert">Sorry! The Menu Can\'t  Deleted</div>';

		return $msg;
	}