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
		$menu 		= filter_var($_POST['menu'], FILTER_SANITIZE_STRING);
		$vis 		= (int) $_POST['vis'];
		$rank 		= (int) $_POST['rank'];

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

			header("Location: create_menu.php");
		}

		

		if (empty($formError)) {
			
			$stmt = $con->prepare("INSERT INTO site_navbar(item_name, rank, visible) 
												VALUES('{$menu}', '{$rank}', '{$vis}')");
			$stmt->execute();
			$count = $stmt->rowCount();

			if ($count > 0) {
				
				$_SESSION['msg'] = succed_msg();

				header("Location: management_content.php");
				exit();
			} else {

				$_SESSION['msg'] = failed_msg();
				header("Location: management_content.php");
				exit();
			}
		}

		foreach ($formError as $error) {
			echo '<div class="alert alert-waring" role="alert">'.$error.'</div>';
		}

	} else {
		header("Location: management_content.php");
		exit();
		}?>

	<?php
  include('../includes/layout/footer.php');
  ?>
  