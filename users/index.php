<?php
//Start Session
session_start();

//Is user logged in
$username = $_SESSION['username'];
$user_id = $_SESSION['id'];
$admin = $_SESSION['admin'];
if(($_SESSION['LoggedIn'] = 1) && ($_SESSION['username'] = $username)) {

include_once('../include/config.php');

//create User Alerts
$create = $_GET['create'];
$user = $_GET['user'];
if ($create == 'success') {
	$alert = '<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">&times</button>
								<strong>Great News!</strong> New user <strong>'.$user.'</strong> created.
						</div>';
} elseif ($create == 'fail') {
	$alert = '<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">&times</button>
								<strong>Bad News!</strong> User creation failed.
						</div>';
}

//Delete user alerts
$delete = $_GET['delete'];
$name = $_GET['name'];

if ($delete == 'success') {
	$alert = '<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">&times</button>
								<strong>Great News!</strong> <strong>'.$name.'</strong> has been deleted.
						</div>';
} elseif ($delete == 'fail') {
	$alert = '<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">&times</button>
								<strong>Bad News!</strong> Unable to delete user.
						</div>';
}
?>

<!DOCTYPE html>
<html>

<head>
    
    <title>Bodnant Welshfood | Users</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Stylesheets -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../css/bootstrap-responsive.css" rel="stylesheet" media="screen">
    <link href="../css/main.css" rel="stylesheet" media="screen">
     
    <!--Scripts -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    
</head>
<body>
	
	<!-- Header Start -->
	<div class="header">
	
		<!-- Header Container -->
		<div class="container">
			
			<!-- Header Row -->
			<div class="row-fluid clearfix">
				
				<!-- Header Logo -->
				<img src="../img/logo.gif" title="Bodnant welshfood Admin" class="span2"/>
				
				<!-- Header Logout and settings -->
				<div class="pull-right text-right">
					
					<!-- Account Settings -->
					<a href="../users/details.php?id=<?php echo $user_id; ?>" class="btn">Account <i class="icon-cog"></i></a>
					
					<!-- Logout Button -->
					<a href="../logout.php" title="logout" class="btn btn-danger">Logout <i class="icon-off icon-white"></i></a>
					
					
				</div>
				
			</div>
			<!-- header Row End -->
		
		</div>
		<!-- header Container End -->
		
	</div>
	<!-- Header End -->
	
	<!-- Body Container -->
	<div class="container">
	
		<!-- Main Desktop Navigation -->
		<div class="hidden-mobile navbar">
			
			<!--Navbar Inner -->
			<div class="navbar-inner clearfix">
				
				<ul class="nav">
					
					<li><a href="../" title="Dashboard">Dashboard</a></li>
					<li><a href="../bookings" title="Bookings">Bookings</a></li>
					<li ><a href="../rooms" title="Rooms">Rooms</a></li>
					<li><a href="../orders" title="Orders">Orders</a></li>
					<li><a href="../events" title="Events">Events</a></li>
					<li><a href="../products" title="Products">Products</a></li>
					<?php if($admin=='yes') { echo '<li class="active"><a href="/users" title="Users">Users</a></li>'; } ?>
					
				</ul>
				
				<!-- Welcome Message -->
				<p class="welcome pull-right">Welcome back <strong><?php echo ucwords($username); ?></strong></p>
				
			</div>
			<!-- Nav inner end -->
			
		</div>
		<!-- Main desktop Nav End -->
		
		<!-- Main content row -->
		<div class="row-fluid">
			
			<!-- Main Column -->
			<div class="span8">
				
				<!-- well -->
				<div class="well well-small">
				
					<?php
					if (!empty($alert)) {
						echo $alert;
					}
					?>
						
					<h3 class="thin pull-left">Current Users</h3>
					<a href="create.php" class="btn btn-inverse pull-right"><i class="icon-plus icon-white"></i> Create User</a>
					<div class="clearfix"></div>
					<hr>
					
					<!-- Users Table -->
					<table class="table table-striped">
						
						<!-- Table Header --->
						<tr><td><strong>Name</strong></td><td><strong>Role</strong></td><td><strong>Details</strong></td><td><strong>Delete</strong></td></tr>
						<!-- Database Pull of users -->
						<?php 
						$user_query = mysql_query("SELECT * FROM admin");
						$row = mysql_num_rows($user_query);
						$i = 0;

						while ($i < $row) {
						$id = mysql_result($user_query,$i,"admin_ID");
						$fname = mysql_result($user_query,$i,"admin_fname");
						$lname = mysql_result($user_query,$i,"admin_lname");
						$position = mysql_result($user_query,$i,"admin_position");
						
						$fullname = $fname.' '.$lname;
						
						//User echo in table
						echo '<tr><td>'.$fullname.'</td><td>'.$position.'</td><td><a href="details.php?id='.$id.'" class="btn btn-small btn-info">User Details</a></td><td><a href="#confirm'.$id.'" data-toggle="modal" role="button" class="btn btn-small btn-danger"><i class="icon-trash icon-white"></i></a></td></tr>';
						
						//Modal Confirm Delete
						echo '<div id="confirm'.$id.'" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
    <h3 id="myModalLabel">Confirm Delete User</h3>
  </div>
  <div class="modal-body">
    <p>Are you sure you want to delete <strong>'.ucwords($fullname).'</strong>?</p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
    <a href="delete.php?remove=1&id='.$id.'&name='.$fullname.'" class="btn btn-danger">Delete <i class="icon-trash icon-white"></i></a>
  </div>
</div>';
						
						$i++;
						
						
						}
						
						?>
						
					</table>
					<!-- User Table End -->
					
					
				</div>
				<!-- Well End -->
			
			</div>
			<!-- Main Column End -->
			
			<!-- sidebar Column -->
			<div class="span4">
				
				<!-- Well -->
				<div class="well well-small">
					
					<h3 class="thin">Useful User Information</h3>
					<hr>
					
				</div>
				<!-- Well End -->
			
			</div>
			<!-- Sidebar end -->
			
			
		</div>
		<!-- Row End -->
		
	</div>
	<!-- Container End -->
	
</body>
</html>
<?php
//If user is not logged in throw them out
} else {
	header("location: ../login.php?error=timeout");
}
?>