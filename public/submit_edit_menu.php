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
		$id 		= $_SESSION['id'];
		$menu 		= filter_var($_POST['menu'], FILTER_SANITIZE_STRING);
		$vis 		= $_POST['vis'];
		$rank 		= $_POST['rank'];

		// to show error
		$formError = [];

		if (strlen($menu) < 3) {
			$formError[] = "Must Name For Menu More than 3 chars";
		}


		if (empty($menu)) {
			$formError[] = 'Meun Is Empty ... Plz Enter Value';
		}

		
		if (! empty($formError)) {
			foreach ($formError as $error) {
				$_SESSION['error'] = $error;
			}

			header("Location: edit_page.php");
		}

		
		//update where not there erors
		if (empty($formError)) {
			
			$stmt = $con->prepare("UPDATE site_navbar SET item_name = ?, rank = ?, visible = ? WHERE id = ?");
			$stmt->execute([$menu, $rank, $vis, $id]);
			$count = $stmt->rowCount();

			if ($count > 0) {
				
				$_SESSION['msg'] = succed_update_msg();

				header("Location: management_content.php");
				exit();
			} else {

				$_SESSION['msg'] = failed_update_msg();

				header("Location: management_content.php");
				exit();
			}
		}

		foreach ($formError as $error) {
			echo '<div class="alert alert-waring" role="alert">'.$error.'</div>';
		}

	} else {
		echo '<div class="alert alert-waring" role="alert">Error Is Occured</div>';
		header("Location: management_content.php");
		exit();
		}?>

	<?php
  include('../includes/layout/footer.php');
  ?>
  