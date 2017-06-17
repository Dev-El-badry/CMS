<?php session_start(); ?>

<?php
  include('../includes/layout/public_layout/header.php');
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

 <nav>
 	<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <ul class="list-unstyled">
 <?php
              $stmt = $con->prepare("SELECT * FROM site_navbar WHERE visible = 1");
              $stmt->execute();
              $nav = $stmt->fetchAll();
              $count = $stmt->rowCount();

              if ($count > 0) {
                foreach ($nav as $title) { ?>
					 <li> <a href="?menu=<?php echo $title['id']; ?>"><?php echo $title['item_name']; ?></a></li>
					 <ul class="list-unstyled" style="margin-left: 20px">
					 	<?php 
					 		$stmt = $con->prepare("SELECT * FROM pages WHERE visible = 1 AND item_id = ?");
                        $stmt->execute([$title['id']]);
                        $items = $stmt->fetchAll();
                        $count = $stmt->rowCount();

                        if ($count >  0) {

                          foreach ($items as $item) {
                            echo "<li><h4><a href='?page=".$item['id']."'>" . $item['page_name'] . "</a></h4></li>";
                          }
                        }
					 	 ?>
					 </ul>
					
				<?php }} ?>
	</ul>
</div>
<!-- Use any element to open the sidenav -->
<span onclick="openNav()"><h2><i class="fa fa-list"></i>  Menu</h2></span>

<!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
<div id="main">
	
</div> 
 </nav><!-- End Navigation --> <!--********************************** end ********************-->

 <div class="content">
 	<div class="container">
 		<div class="row">
 			<div class="col-sm-2"></div>
 			<div class="col-sm-10">
      <?php 
        if (isset($id_menu_selected)) {
          $stmt = $con->prepare("SELECT * FROM site_navbar WHERE visible = 1 AND id = ?");
              $stmt->execute([$id_menu_selected]);
              $menu = $stmt->fetch();
              $count = $stmt->rowCount();

              if ($count > 0) {
          ?>

          <div class="panel panel-success">
          <!-- Default panel contents -->
          <div class="panel-heading"><?php echo htmlentities($menu['item_name']); ?></div>
          <?php 
          if ($menu['item_name'] == 'Home') {
            echo '<div class="panel-body">
              <p>HP is a server-side scripting language designed primarily for web development but also used as a general-purpose programming language. Originally created by Rasmus Lerdorf in 1994,[4] the PHP reference implementation is now produced by The PHP Development Team.[5] PHP originally stood for Personal Home Page,[4] but it now stands for the recursive acronym PHP: Hypertext Preprocessor.[6]

                PHP code may be embedded into HTML or HTML5 markup, or it can be used in combination with various web template systems, web content management systems and web frameworks. PHP code is usually processed by a PHP interpreter implemented as a module in the web server or as a Common Gateway Interface (CGI) executable. The web server software combines the results of the interpreted and executed PHP code, which may be any type of data, including images, with the generated web page. PHP code may also be executed with a command-line interface (CLI) and can be used to implement standalone graphical applications.</p>
                          </div>';

                          ?>
<hr>
          <?php 
          if ($menu['item_name'] == 'Home') {
            echo '<div class="panel-body">
              <img class="img-responsive" src="static/images/php.png" alt="php">
                          </div>'; }


          } elseif ($menu['item_name'] == 'About') {
                    echo '<div class="panel-body">
              <p>PHP development began in 1995 when Rasmus Lerdorf wrote several Common Gateway Interface (CGI) programs in C,[10][11][12] which he used to maintain his personal homepage. He extended them to work with web forms and to communicate with databases, and called this implementation "Personal Home Page/Forms Interpreter" or PHP/FI.

PHP/FI could help to build simple, dynamic web applications. To accelerate bug reporting and to improve the code, Lerdorf initially announced the release of PHP/FI as "Personal Home Page Tools (PHP Tools) version 1.0" on the Usenet discussion group comp.infosystems.www.authoring.cgi on June 8, 1995.[13][14] This release already had the basic functionality that PHP has as of 2013. This included Perl-like variables, form handling, and the ability to embed HTML. The syntax resembled that of Perl but was simpler, more limited and less consistent.[5]

Lerdorf did not intend the early PHP to become a new programming language, but it grew organically, with Lerdorf noting in retrospect: "I don’t know how to stop it, there was never any intent to write a programming language […] I have absolutely no idea how to write a programming language, I just kept adding the next logical step on the way."[15] A development team began to form and, after months of work and beta testing, officially released PHP/FI 2 in November 1997.

The fact that PHP lacked an original overall design but instead developed organically has led to inconsistent naming of functions and inconsistent ordering of their parameters.[16] In some cases, the function names were chosen to match the lower-level libraries which PHP was "wrapping",[17] while in some very early versions of PHP the length of the function names was used internally as a hash function, so names were chosen to improve the distribution of hash values.[18]</p>
                          </div>';

                          ?>
<hr>
          <?php 
          if ($menu['item_name'] == 'About') {
            echo '<div class="panel-body">
              <img class="img-responsive" src="static/images/ele.png" alt="php">
                          </div>';
          }


           } ?>
          </div>  
 <?php 
        } 
       }elseif (isset($id_page_selected)) {
            ?>

          <div class="panel panel-success">
          <!-- Default panel contents -->
          <div class="panel-heading"><?php 
$stmt = $con->prepare("SELECT * FROM pages WHERE visible = 1 AND id = ?");
                        $stmt->execute([$id_page_selected]);
                        $items = $stmt->fetch();
                        $count = $stmt->rowCount();

                        if ($count >  0) {?>
                        <?php echo htmlentities($items['page_name']) . "</div>"; ?>
          <div class="panel-body">
            <?php echo nl2br($items['content']); ?>
          </div>  
        <?php
          } }
       ?>
 				
 			</div>
 		</div>
 	</div>
 </div>

<?php
  include('../includes/layout/footer.php');
  ?>
