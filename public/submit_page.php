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

		$formError = [];

		if (strlen($page) < 3) {
			$formError[] = "Must Name For Menu More than 3 chars";
		}


		if (empty($page)) {
			$formError[] = 'Meun Is Empty ... Plz Enter Value';
		}

		if (strlen($content) < 3) {
			$formError[] = "Must content More than 3 chars";
		}


		if (empty($content)) {
			$formError[] = 'content Is Empty ... Plz Enter Value';
		}

		
		if (! empty($formError)) {
			foreach ($formError as $error) {
				$_SESSION['error'] = $error;
			}

			header("Location: create_page.php");
		}

		

		if (empty($formError)) {
			
			$stmt = $con->prepare("INSERT INTO `pages`(`item_id`, `page_name`, `content`, `rank`, `visible`, `status`) VALUES (:zitem, :zpage, :zcontent, :zrank, :zvis, :zstate)");
			$stmt->execute([
				'zitem' 	=> $id,
				'zpage' 	=> $page,
				'zcontent' 	=> $content,
				'zrank' 	=> $rank,
				'zvis' 		=> $vis,
				'zstate'	=> $status
				]);

			if ($stmt) {
				
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
  