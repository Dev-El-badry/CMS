<?php
	session_start();

	include('../includes/layout/header.php');
  	include('../includes/function.php');
  	include('session.php');
  	include('../includes/conect.php'); 

  	if (isset($_GET['admin'])) {
  		$id_admin_selected = $_GET['admin'];
  	} else {
  		$id_admin_selected = null;
  	}

    if (isset($_SESSION['ID_LOGIN'])) {
    
  	?>

<div class="admin">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
			<h1>Manage Admins</h1>
		</div>
		<div class="col-sm-6">
			<?php
			 echo msg();
			 echo err();
			  ?>
		</div>
		</div>



			<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#admins" aria-controls="home" role="tab" data-toggle="tab">Admins</a></li>
    <li role="presentation"><a href="#add_admins" aria-controls="profile" role="tab" data-toggle="tab">Add Admins</a></li>
    <li role="presentation"><a href="#edit_admins" aria-controls="messages" role="tab" data-toggle="tab">Edit Admins</a></li>
    <li role="presentation"><a href="#delete" aria-controls="settings" role="tab" data-toggle="tab">Delete Admins</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="admins">
    <h2>Admins Information</h2>
    <p>Admins Inforamtion According to database</p>
    <table class="table table-bordered">
    <thead>
  		<th>#</th>
  		<th>username</th>
  		<th>first name</th>
  		<th>last name</th>
  		<th>E-Mail</th>
  		<th>Date</th>
    </thead>
    <tbody>  	<?php 
    	$stmt = $con->prepare("SELECT * FROM admins");
    	$stmt->execute();
    	$rows = $stmt->fetchAll();
    	$count = $stmt->rowCount();

    	if ($count > 0) {
    		foreach ($rows as $row) {
    	
    	 ?>
    	<tr>
    		<td><?php echo $row['id']; ?></td>
    		<td><?php echo $row['username']; ?></td>
    		<td><?php echo $row['first_name']; ?></td>
    		<td><?php echo $row['last_name']; ?></td>
    		<td><?php echo $row['email']; ?></td>
    		<td><?php echo $row['date']; ?></td>
    	</tr>
    	<?php 	}	
    		}?>
    </tbody>
	</table>
    </div>
    <div role="tabpanel" class="tab-pane" id="add_admins">
    	<div class="col-sm-2"><h4>Add Admin</h4></div>
    	<div class="col-sm-10">
    		<form style="margin-top: 50px; width: 500px" action="submit_add_admin.php" method="POST">
	    		<div class="form-group">
				    <label for="user">Username: </label>
				    <input type="text" class="form-control" id="user" name="username" placeholder="Type Here Username">
				</div>

				<div class="form-group">
				    <label for="first">First Name: </label>
				    <input type="text" class="form-control" id="first" name="first_name" placeholder="Type Here First Name">
				</div>

				<div class="form-group">
				    <label for="last">Last Name: </label>
				    <input type="text" class="form-control" id="last" name="last_name" placeholder="Type Here Last Name">
				</div>

				<div class="form-group">
				    <label for="pas">Password: </label>
				    <input type="password" class="form-control" id="pas" name="pass" placeholder="Type Here Password">
				</div>

				<div class="form-group">
				    <label for="mail">E-mail: </label>
				    <input type="email" class="form-control" id="user" name="email" placeholder="Type Here E-mail">
				</div>

				<button type="submit" class="btn btn-primary" name="submit">Submit</button>

    		</form>
    	</div>
    </div> 
    <div role="tabpanel" class="tab-pane" style="margin:20px auto" id="edit_admins">
    	<div class="row">
    		<div class="col-sm-4">
    		<ul class="group-list">
    		<?php 
    		$stmt = $con->prepare("SELECT * FROM admins");
	    	$stmt->execute();
	    	$rows = $stmt->fetchAll();
	    	$count = $stmt->rowCount();

    	if ($count > 0) { 
    		foreach ($rows as $row) {
    		?>
    			<a href="?admin=<?php echo $row['id']; ?>"><li class="list-group-item list-group-item-warning"><?php echo $row['username'] ?></li></a>
    		<?php } } else {
    				echo "no item";
    				}
    		 ?>
    		</ul>
    	</div>
    	<?php 
    	if (isset($id_admin_selected)) {

    		$_SESSION['id_admin'] = $id_admin_selected;

    		$stmt = $con->prepare("SELECT * FROM admins WHERE id = '{$id_admin_selected}'");
	    	$stmt->execute();
	    	$output = $stmt->fetch();
	    	$count = $stmt->rowCount();

	    	if ($count > 0) {
	    	
    		?>
    		    	<div class="col-sm-8">
    		<form style="margin-top: 50px; width: 500px" action="submit_edit_admin.php" method="POST">
	    		<div class="form-group">
				    <label for="user">Username: </label>
				    <input type="text" value="<?php echo $output['username']; ?>" class="form-control" id="user" name="username" placeholder="Type Here Username">
				</div>

				<div class="form-group">
				    <label for="first">First Name: </label>
				    <input type="text" value="<?php echo $output['first_name']; ?>" class="form-control" id="first" name="first_name" placeholder="Type Here First Name">
				</div>

				<div class="form-group">
				    <label for="last">Last Name: </label>
				    <input type="text" value="<?php echo $output['last_name']; ?>" class="form-control" id="last" name="last_name" placeholder="Type Here Last Name">
				</div>

				<div class="form-group">
				    <label for="mail">E-mail: </label>
				    <input type="email" value="<?php echo $output['email']; ?>" class="form-control" id="user" name="email" placeholder="Type Here E-mail">
				</div>

				<button type="submit" class="btn btn-primary" name="submit">Submit</button>

    		</form>
    	</div>
    		<?php  }
    	}  ?>
    	</div>
    </div>
    <div role="tabpanel" class="tab-pane" id="delete">
	<h2>Delete Admin</h2>
    <p>Delete Admin According to database</p>
    <table class="table table-bordered">
    <thead>
  		<th>#</th>
  		<th>username</th>
  		<th>first name</th>
  		<th>last name</th>
  		<th>E-Mail</th>
  		<th>Date</th>
  		<th>Control</th>
    </thead>
    <tbody> 
    <?php 
    	$stmt = $con->prepare("SELECT * FROM admins");
    	$stmt->execute();
    	$rows = $stmt->fetchAll();
    	$count = $stmt->rowCount();

    	if ($count > 0) {
    		foreach ($rows as $row) {
    	
    	 ?>
    	 <tr>
			<td><?php echo $row['id']; ?></td>
    		<td><?php echo $row['username']; ?></td>
    		<td><?php echo $row['first_name']; ?></td>
    		<td><?php echo $row['last_name']; ?></td>
    		<td><?php echo $row['email']; ?></td>
    		<td><?php echo $row['date']; ?></td>
    		<td><a href="submit_delete_admin.php?admin=<?php echo $row['id']; ?>" class="btn btn-danger btn-xs">Delete</a></td>
    	
</tr>
<?php }} ?>
    </tbody>
    </div>
  </div>

		</div>
		</div>

	</div>
</div>

<?php
include('../includes/layout/footer.php');
}else {
    header("Location: login_page.php");
    exit();
  }

?>
