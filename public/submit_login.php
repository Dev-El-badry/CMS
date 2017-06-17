<?php session_start(); ?>
<?php
  include('../includes/layout/header.php');
  include('../includes/function.php');
  include('session.php');
  include('../includes/conect.php');
?>
  <body>

<?php

	if (isset($_POST['submit'])) {
		$username 	= filter_var($_POST['username'], FILTER_SANITIZE_STRING);
		$pass 		= filter_var( $_POST['pass'], FILTER_SANITIZE_STRING);

		
		$formError = [];

		if (empty($username)) {
			$formError[] = '<div class="alert alert-waring">Plz...Write Value To Login</div>';
		}

		if (empty($pass)) {
			$formError[] = '<div class="alert alert-waring">Plz...Write Value To Login</div>';
		}
		if (empty($formError)) {

		$stmt = $con->prepare("SELECT id, username, password FROM admins WHERE username = ?");
		$stmt->execute([$username]);
		$row = $stmt->fetch();
		$count  = $stmt->rowCount();

		if($count > 0) {	
			echo $pass;
			$res = password_verify($pass, $row['password']);
			var_dump($res);
			if ($res) {
				$_SESSION['ID_LOGIN'] = $row['id'];
				echo $row['password'];
				header("Location: admins.php");
				exit();
			} else {
				echo '<div class="alert alert-waring">Incorrect Password Or Username</div>';
			}
	}

	}	
		if (! empty($formError)) {
			foreach ($formError as $error) {
				$_SESSION['error'] = $error;
			}

			header("Location: login_page.php");
			exit();
		}

		} else {
			echo "not access directly to this page";
			header("Location: login_page.php");
			exit();
		}
	?>
