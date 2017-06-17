<?php session_start();
  if (isset($_SESSION['ID_LOGIN'])) {
 ?>
<?php
  include('../includes/layout/header.php');
  include('../includes/function.php');
  include('session.php');
  include('../includes/conect.php');
?>
<?php

		$id 		= $_GET['menu'];
		//Deleted where not there erors
		$stmt2 = $con->prepare("SELECT * FROM pages WHERE item_id = ?");
		$stmt2->execute([$id]);
		$count = $stmt2->rowCount();

		if ($count > 0) {

			$_SESSION['msg'] = failed_delete_msg();
			header("Location: delete_menu.php");

		} else {
			//$id1		= $_GET['menu'];
			$stmt = $con->prepare("DELETE FROM site_navbar WHERE id = ?");
			$stmt->execute([$id]);
			$count = $stmt->rowCount();

			if ($count > 0) {
				
				$_SESSION['msg'] = succed_delete_msg();

				header("Location: management_content.php");
				exit();
			} else {

				$_SESSION['msg'] = failed_delete() ;

				header("Location: management_content.php");
				exit();
			}

} ?>

	<?php
  include('../includes/layout/footer.php');
  else {
    header("Location: login_page.php");
    exit();
  }
  ?>
  