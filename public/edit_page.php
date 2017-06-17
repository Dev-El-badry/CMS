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
              <div class="panel-heading"><h2>Edit Page</h2></div>
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

                echo "<h5><a href=?page=". $item['id'] .">".$item['page_name']."</a></h5>"; 

              }}
                
          ?>
        </div>
      </div>
       <?php }} ?>
      </div>

      <!-- Form Create -->
      
          <div class="col-sm-8">
                     <?php
      if (isset($id_page_selected)) {
       
       $_SESSION['id'] = $id_page_selected;
      
        $stmt = $con->prepare("SELECT * FROM pages WHERE id = ?");
        $stmt->execute([$id_page_selected]);
        $rows = $stmt->fetch();
        $count = $stmt->rowCount();

        if ($count > 0) { 
      ?>
            <div class="panel panel-info">
              <div class="panel-heading"><i class="fa fa-edit"></i>Edit Menu</div>
              <div class="panel-body">
   
              <form action="submit_edit_page.php" method="POST">
                <label>Page Name:</label>
                <input type="text" class="form-control" name="page" placeholder="Add Name Page" value="<?php echo $rows['page_name']; ?>">

                <label style="margin-top: 10px">Content:</label>
                <textarea class="form-control" name="content" placeholder="Add Content For Page" value="<?php echo $rows['content']; ?>"><?php echo $rows['content']; ?></textarea>
                <!-- Start Visibilty -->
                <label style="margin-top: 10px">Visible:</label>
                <label  for="inlineRadio" class="radio-inline">
                  <input type="radio" name="vis" id="inlineRadio" value="1" <?php if ($rows['visible'] == 1) { echo "checked='checked'"; } ?> > Yes
                    
                </label>
                <label  for="inlineRadio1" class="radio-inline">
                  <input type="radio" name="vis" id="inlineRadio1" value="0" <?php if ($rows['visible'] == 0) { echo "checked='checked'"; } ?> > No
                </label> <br>
                <!-- End Visibilty -->
                <!-- Start Status -->
                <label style="margin-top: 10px">Status:</label>
                <label for="inlineRadio2" class="radio-inline">
                  <input type="radio" name="status" id="inlineRadio2" value="1"  <?php if ($rows['status'] == 1) { echo "checked='checked'"; } ?>>Yes
                </label>
                <label for="inlineRadio3" class="radio-inline">
                  <input type="radio" name="status" id="inlineRadio3" value="0"  <?php if ($rows['status'] == 0) { echo "checked='checked'"; } ?> > No
                </label> <br>
                <!-- End Status -->

                <label style="margin-top: 10px">Rank (<?php echo $rows['rank']; ?>) :</label>
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

                

                  <input type="submit" name="submit" value="UPADTE CHANGES" class="btn btn-primary pull-right" style="margin-top: 10px; color: #fff" />
              </form>

              </div>
            </div>
            <?php 

                if (isset($_SESSION['error'])) {
                  ?><div class="alert alert-warning" role="alert"><?php echo err(); ?></div><?php
                }
            ?>
          </div>

          <?php }  } else {
             echo "<h3 class='text-center'>Fisrt Select Page From Menu </h3>";
            }?>
        </div> 
      </div>  
   
    </section>
    <!-- end section management content -->


<?php
  include('../includes/layout/footer.php');
  }else {
    header("Location: login_page.php");
    exit();
  }
  ?>
  