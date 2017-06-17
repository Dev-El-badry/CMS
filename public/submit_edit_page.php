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
		$page 		= filter_var($_POST['page'], FILTER_SANITIZE_STRING);
		$content 	= filter_var($_POST['content'], FILTER_SANITIZE_STRING);
		$vis 		= $_POST['vis'];
		$status 	= $_POST['status'];
		$rank 		= $_POST['rank'];

		// to show error
		$formError = [];

		if (strlen($page) < 3) {
			$formError[] = "Must Name For Menu More than 3 chars";
		}


		if (empty($page)) {
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
			
			$stmt = $con->prepare("UPDATE pages SET page_name = ?, content = ?, rank = ?, visible = ?, status = ? WHERE id = ?");
			$stmt->execute([$page, $content, $rank, $vis, $status, $id]);
			$count = $stmt->rowCount();

			if ($count > 0) {
				
				$_SESSION['msg'] = succed_update_page_msg();

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
  