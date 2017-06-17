<?php session_start(); ?>
<?php
  include('../includes/layout/header.php');
  include('../includes/function.php');
  include('session.php');
  include('../includes/conect.php');
?>

<?php

	$id = $_GET['admin'];

	$stmt = $con->prepare("DELETE FROM admins WHERE id = ?");
	$stmt->execute([$id]);
	$count  = $stmt->rowCount();

	if ($count > 0) {
		$_SESSION['msg'] = succed_delete_admin_msg();

				header("Location: admin_area.php");
				exit();
	} else {
		$_SESSION['msg'] = failure_delete_admin_msg();

				header("Location: admin_area.php");
				exit();
	}

	?>

		<?php
  include('../includes/layout/footer.php');
  ?>