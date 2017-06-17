<?php session_start(); 
  if (isset($_SESSION['ID_LOGIN'])) {
?>
<?php
  include('../includes/layout/header.php');
  include('../includes/function.php');
  include('session.php');
  include('../includes/conect.php');

  if (isset($_GET['menu'])) {
    $id_menu_selected = $_GET['menu'];
    $id_page_selected = null;
  } elseif (isset($_GET['page'])) {
    $id_page_selected = $_GET['page'];
    $id_menu_selected = null;
  } else {
    $id_menu_selected = null;
    $id_page_selected = null;
  }
?>
  <body>
    <!-- Navigation -->




    <div class="wrapper">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="panel panel-default">
              <div class="panel-heading"><h2>Delete Menu</h2></div>
              <div class="panel-body">
              <a href="management_content.php" class="btn btn-danger"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  

    <!-- start section management content -->
    <section class="manage-content">
      <div class="container">
        <div class="row">
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
            <?php echo "<h4><a href='?menu=".$nav['id']."'>".$nav['item_name']."</a></h4>"; ?>
              
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
      <!-- Start Section Content -->
         <div class="col-sm-8">
         <?php
 
            if (isset($id_menu_selected)) {
              # code...
           
            
            $stmt = $con->prepare("SELECT * FROM site_navbar WHERE id = ?");
            $stmt->execute([$id_menu_selected]);
            $rows = $stmt->fetch();
            $count = $stmt->rowCount();

            if ($count > 0) {
              
          ?>
         <div class="panel panel-warning">
            <!-- warning panel contents -->

            <div class="panel-heading"><h4>Deleted Menu</h4></div>
            <table class="table">
            <thead>
              <tr>
                <th>
                 Menu Name
                </th>
                <th>
                  Action
                </th>
              </tr>
            </thead>
            <tbody>
          
              <td><?php echo $rows['item_name']; ?></td>
              <td><a href="submit_delete_menu.php?menu=<?php echo $rows['id']; ?>" class="btn btn-danger btn-xs">Delete</a></td>
              <?php   
                } ?>
            </tbody>
          </table>
            <?php
            $stmt = $con->prepare("SELECT * FROM pages WHERE item_id = ?");
            $stmt->execute([$id_menu_selected]);
            $rows = $stmt->fetchAll();
            $count = $stmt->rowCount();

            if ($count > 0) {
              foreach ($rows as $row) {
          ?>
      <table class="table" style="margin-top: 10px">
            <thead>
              <tr>
                <th>
                 Page Name
                </th>
                <th>
                  Action
                </th>
              </tr>
            </thead>
            <tbody>
            <td><?php echo $row['page_name']; ?></td>
            <td><a href="submit_delete_menu.php?menu=<?php echo $row['id']; ?>" class="btn btn-danger btn-xs">Delete</a></td> 
            </tbody>
          </table>
          <?php } } ?>
          </div>
  <?php } else {
            echo "<h3 class='text-center'>Fisrt Select Item From Menu </h3>";
            } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
      <!-- End Section Content -->
<?php
  include('../includes/layout/footer.php');
  }else {
    header("Location: login_page.php");
    exit();
  }
  ?>