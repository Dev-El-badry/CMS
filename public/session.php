<?php

	if(!isset($_SESSION)) {
		session_start();
	}

	function msg() {
		if (isset($_SESSION['msg'])) {
			$show = $_SESSION['msg'];

			$_SESSION['msg'] = null;
			return $show;
		}
	}

	function err() {
		if (isset($_SESSION['error'])) {
			 $show = $_SESSION['error'];

			$_SESSION['error'] = null;
			return $show;
		}
	}