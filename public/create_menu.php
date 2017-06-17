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




    <div class="wrapper">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="panel panel-default">
              <div class="panel-heading"><h2>Create Menu</h2></div>
              <div class="panel-body">
              <a href="management_content.php" class="btn btn-danger">< Back</a>
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
          <h3>Create Menu: </h3>
      </div>


      <!-- Form Create -->
      
          <div class="col-sm-8">
            <div class="panel panel-info">
              <div class="panel-heading"><i class="fa fa-edit"></i>Add Menu</div>
              <div class="panel-body">
              <form action="submit_menu.php" method="POST">
                <label>Menu:</label>
                <input type="text" class="form-control" name="menu" placeholder="Add Menu">

                <label style="margin-top: 10px">Visible:</label>
                <label class="radio-inline">
                  <input type="radio" name="vis" id="inlineRadio2" value="1">Yes
                </label>
                <label class="radio-inline">
                  <input type="radio" name="vis" id="inlineRadio3" value="0"> No
                </label> <br>

                <label>Rank:</label>
                <select name="rank" class="form-control">
                    <?php
                    $stmt = $con->prepare("SELECT count(item_name) FROM site_navbar");
                    $stmt->execute();

                    $num = $stmt->fetchColumn();

                    for ($i=1; $i <= $num + 1 ; $i++) { 
                      echo "<option value='".$i."'>" .$i."</option>";
                    }

                    
                    ?>
                </select>

                  <input type="submit" name="submit" value="ADD Menu" class="btn btn-danger" style="margin-top: 10px" />
              </form>
              </div>
            </div>
            <?php 

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
  }else {
    header("Location: login_page.php");
    exit();
  }
  ?>
  