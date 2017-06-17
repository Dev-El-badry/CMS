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
              <div class="panel-heading"><h2>Edit Menu</h2></div>
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

      <!-- Form Create -->
      
          <div class="col-sm-8">
                     <?php
      if (isset($id_menu_selected)) {
       
       $_SESSION['id'] = $id_menu_selected;
      
        $stmt = $con->prepare("SELECT * FROM site_navbar WHERE id = ?");
        $stmt->execute([$id_menu_selected]);
        $rows = $stmt->fetch();
        $count = $stmt->rowCount();

        if ($count > 0) {

          
          
          
        
      ?>
            <div class="panel panel-info">
              <div class="panel-heading"><i class="fa fa-edit"></i>Edit Menu</div>
              <div class="panel-body">
   
              <form action="submit_edit_menu.php" method="POST">
                <label>Menu  <?php echo $rows['item_name'] ?>:</label>
                <input type="text" class="form-control" value="<?php echo $rows['item_name'] ?>" name="menu" placeholder="Add Menu">

                <label style="margin-top: 10px">Visible:</label>
                
                <label class="radio-inline">
                  <input type="radio" name="vis" id="inlineRadio2" value="1" <?php if ($rows['visible'] == 1) { echo 'checked="checked"';  } ?> >Yes
                </label>
                
                <label class="radio-inline">
                  <input type="radio" name="vis" id="inlineRadio3" value="0" <?php if ($rows['visible'] == 0) { echo 'checked="checked"';  } ?> > No
                </label><br>

                <label>Rank <?php echo "(".$rows['rank']."):" ?></label>
                <select name="rank" class="form-control">
                    <?php
                    $stmt = $con->prepare("SELECT count(item_name) FROM site_navbar");
                    $stmt->execute();

                    $num = $stmt->fetchColumn();

                    for ($i=1; $i <= $num + 1 ; $i++) { 
                      echo "<option  value='".$i."'>" .$i."</option>";
                    }

                    
                    ?>
                </select>

                  <input type="submit" name="submit" value="Update Menu" class="btn btn-danger" style="margin-top: 10px" />
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
            echo "<h3 class='text-center'>Fisrt Select Menu </h3>";
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
  