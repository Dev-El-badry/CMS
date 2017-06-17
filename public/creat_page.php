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
              <div class="panel-heading"><h2>Create Page</h2></div>
              <div class="panel-body">
              <a href="management_content.php" class="btn btn-danger">< Back To Management Content</a>
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
           $stmt = $con->prepare("SELECT count(id) FROM pages WHERE item_id = ?");
            $stmt->execute([$nav['id']]);
            $items = $stmt->fetchColumn();
           
            if($items == 0) { echo "No Pages"; } elseif ($items == 1) { echo "one page"; } else { echo "<p>" . $items . " Pages</p>"; }

          ?>
        </div>
      </div>
       <?php }} ?>
      </div>


      <!-- Form Create -->
      
          <div class="col-sm-8">
          <?php
          if (isset($id_menu_selected)) {
            $_SESSION['id'] = $id_menu_selected;
            ?>
            <div class="panel panel-info">
              <div class="panel-heading"><i class="fa fa-edit"></i>Add Page</div>
              <div class="panel-body">
              <form action="submit_page.php" method="POST">
                <label>Page Name:</label>
                <input type="text" class="form-control" name="page" placeholder="Add Name Page">

                <label style="margin-top: 10px">Content:</label>
                <textarea class="form-control" name="content" placeholder="Add Content For Page" ></textarea>
                <!-- Start Visibilty -->
                <label style="margin-top: 10px">Visible:</label>
                <label  for="inlineRadio" class="radio-inline">
                  <input type="radio" name="vis" id="inlineRadio" value="1">Yes
                </label>
                <label  for="inlineRadio1" class="radio-inline">
                  <input type="radio" name="vis" id="inlineRadio1" value="0"> No
                </label> <br>
                <!-- End Visibilty -->
                <!-- Start Status -->
                <label style="margin-top: 10px">Status:</label>
                <label for="inlineRadio2" class="radio-inline">
                  <input type="radio" name="status" id="inlineRadio2" value="1">Yes
                </label>
                <label for="inlineRadio3" class="radio-inline">
                  <input type="radio" name="status" id="inlineRadio3" value="0"> No
                </label> <br>
                <!-- End Status -->

                <label style="margin-top: 10px">Rank:</label>
                <select name="rank" class="form-control">
                    <?php
                    $stmt = $con->prepare("SELECT count(rank) FROM pages WHERE item_id = ?");
                    $stmt->execute([$id_menu_selected]);

                    $num = $stmt->fetchColumn();

                    for ($i=1; $i <= $num + 1 ; $i++) { 
                      echo "<option value='".$i."'>" .$i."</option> <br>";
                    }

                    
                    ?>
                </select>

                

                  <input type="submit" name="submit" value="ADD Page" class="btn btn-primary pull-right" style="margin-top: 10px; color: #fff" />
              </form>
              </div>
            </div>
            <?php 
          }
                if (isset($_SESSION['error'])) {
                  ?><div class="alert alert-warning" role="alert"><?php echo err(); ?></div><?php
                }
            ?>
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
  }  ?>
  