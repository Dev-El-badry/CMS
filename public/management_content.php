<?php session_start();
  if (isset($_SESSION['ID_LOGIN'])) {
 ?>

<?php
  include('../includes/layout/header.php');
  include('../includes/function.php');
  include('session.php');
  include('../includes/conect.php');
?>
  <body>
    <!-- Navigation -->



</section>
  
  <!-- Fixed navbar -->
   

    <div class="container theme-showcase" role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Manage Area</h1>
        <p>Welcome To Management Area</p>
        <p>
        <a href="create_menu.php" class="btn btn-primary"><i class="fa fa-plus"></i>  Add Menu</a>
        <a href="edit_menu.php" class="btn btn-info"><i class="fa fa-edit"></i>  Edit Menu</a>
        <a href="delete_menu.php" class="btn btn-default"><i class="fa fa-trash-o"></i>  Delete Menu</a>
        <a  href="#" class="btn btn-danger"><i class="fa fa-sign-out"></i>  Logout</a><br><br>
        <a href="creat_page.php" class="btn btn-primary"><i class="fa fa-plus"></i>  Add Page</a>
        <a href="edit_page.php" class="btn btn-info"><i class="fa fa-edit"></i>  Edit Page</a>
        </p>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-sm-offset-4">
         <?php echo msg(); ?>
      </div>
      </div>
    </div>

    <!-- start section management content -->
    <section class="manage-content">
      <div class="container">
        <div class="col-sm-4">
          <?php
            $stmt = $con->prepare("SELECT * FROM site_navbar");
            $stmt->execute();
            $navs = $stmt->fetchAll();
            $count = $stmt->rowCount();

            if ($count > 0) {

              foreach ($navs as $nav) {
                
              
              ?>
        <div class="panel panel-default">

        <div class="panel-heading">
            <span class="pull-right"> <i class="fa fa-plus"></i></span>
            <?php echo "<h4><a href='?page=".$nav['id']."'>".$nav['item_name']."</a></h4>"; ?>
              
        </div>
        <div class="panel-body foc">
          <?php
           $stmt = $con->prepare("SELECT * FROM pages WHERE item_id = ?");
            $stmt->execute([$nav['id']]);
            $items = $stmt->fetchAll();
            $count = $stmt->rowCount();

            if ($count > 0) {

              foreach ($items as $item) {

                echo "<h5><a href=?menu=". $item['id'] .">".$item['page_name']."</a></h5>"; 

              }}
                
          ?>
        </div>
      </div>
       <?php }} ?>
      </div>
        <div class="col-sm-8">
          
            <?php 
            if (isset($_GET['menu'])) {
              echo "<div class='panel panel-default'>";
              echo "<div class='panel-heading'>";
               $stmt = $con->prepare("SELECT * FROM pages WHERE id = ?");
                $stmt->execute([$_GET['menu']]);
                $items = $stmt->fetch();
                $count = $stmt->rowCount();

                if ($count > 0) {
                  
                  echo "<h5>". $items['page_name'] ."</h5>";
            ?></div>
            <div class="panel-body"> <?php echo $items['content']; ?> </div>
            <?php 
          } 
            }else {
            echo "<h3 class='text-center'>Select Item From Menu To Show</h3>";
          } ?>
          
          </div>
      </div>
      </div>
    </section>
    <!-- end section management content -->


<?php
  include('../includes/layout/footer.php');
 } else {
    header("Location: login_page.php");
    exit();
  }
  ?>
  