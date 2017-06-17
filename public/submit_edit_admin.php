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
		$id 		= $_SESSION['id_admin'];
		$username 	= filter_var($_POST['username'], FILTER_SANITIZE_STRING);
		$first 		= $_POST['first_name'];
		$last 		= $_POST['last_name'];
		$email 		= $_POST['email'];

		$formError = [];

		if (strlen($username) < 3) {
			$formError[] = "Must Name For username More than 3 chars";
		}

		if (strlen($first) < 3) {
			$formError[] = "Must Name For Menu More than 3 chars";
		}

		if (strlen($last) < 3) {
			$formError[] = "Must Name For Menu More than 3 chars";
		}

		if (strlen($email) < 3) {
			$formError[] = "Must email For Menu More than 3 chars";
		}


		if (empty($username)) {
			$formError[] = 'username Is Empty ... Plz Enter Value';
		}

		if (empty($first)) {
			$formError[] = 'Name Is Empty ... Plz Enter Value';
		}

		if (empty($last)) {
			$formError[] = 'Name Is Empty ... Plz Enter Value';
		}

		if (empty($email)) {
			$formError[] = 'email Is Empty ... Plz Enter Value';
		}

		
		if (! empty($formError)) {
			foreach ($formError as $error) {
				$_SESSION['error'] = "<div class='alert alert-danger'  style='margin-top: 30px'>".$error."</div>";
			}

			header("Location: admin_area.php#admins");
		}

		

		if (empty($formError)) {
			
			$stmt = $con->prepare("UPDATE admins SET first_name = ?, last_name = ?, username = ?, email = ? WHERE id = ?");
			$stmt->execute([$first, $last, $username, $email, $id]);
			$count = $stmt->rowCount();

			if ($count > 0) {
				
				$_SESSION['msg'] = succed_msg_update_admin();

				header("Location: admin_area.php");
				exit();
			} else {

				$_SESSION['msg'] = failed_msg_update_admin();
				header("Location: admin_area.php");
				exit();
			}
		}

		foreach ($formError as $error) {
			echo '<div class="alert alert-waring" role="alert">'.$error.'</div>';
		}

	} else {
		header("Location: admin_area.php");
		exit();
		}?>

	<?php
  include('../includes/layout/footer.php');
  ?>
  