<?php
  session_start();

  if (isset($_SESSION['ID_LOGIN'])) {
  include('../includes/layout/header.php');
  include('../includes/function.php');
  include('../includes/conect.php');
?>
  <body>
    <!-- Fixed navbar -->
   

    <div class="container theme-showcase" role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Admins Area</h1>
        <p>Welcome To Admins Area</p>
        <p>
        <a  href="Management_content.php" class="btn btn-lg btn-primary">management Content</a>
        <a  class="btn btn-lg btn-info" href="admin_area.php">Admins_Area</a>
        <a  href="Logout.php" class="btn btn-lg btn-success">Logout</a>
        </p>
      </div>
    </div>


<?php
  include('../includes/layout/footer.php');
  } else {
    header("Location: login_page.php");
    exit();
  }
  ?>}
