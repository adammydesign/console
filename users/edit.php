<?php
//Start Session
session_start();

//Is User Logged in
$username = $_SESSION['username'];
$user_id = $_SESSION['id'];
$admin = $_SESSION['admin'];
if(($_SESSION['LoggedIn'] = 1) && ($_SESSION['username'] = $username)) {

//Config Include
include_once('../include/config.php');

//Get ID from Details Page
$id = $_GET['id'];

//Query database and assign result to $data
$edit_query = mysql_query("SELECT * FROM `bodnant_c0nsole`.`admin` WHERE `admin_ID` = $id");
$data = mysql_fetch_array($edit_query);

$image = $data['admin_image'];

//If there is no profile image then use placeholder
if (empty($image)) {
	$image = "http://placehold.it/300x300";
} else {
	$image = "avatars/$image";
}

//Get User roles and apply checkbox
if ($data['god'] == 'true') {
	$roles = '<h4 class="thin"><i class="icon-check"></i> God</h4>';
}
if ($data['rooms'] == 'true') {
	$roles .= '<h4 class="thin"><i class="icon-check"></i> Rooms</h4>';
}
if ($data['shop'] == 'true') {
	$roles .= '<h4 class="thin"><i class="icon-check"></i> Shop</h4>';
}
if ($data['school'] == 'true') {
	$roles .= '<h4 class="thin"><i class="icon-check"></i> School</h4>';
}
if ($data['events'] == 'true') {
	$roles .= '<h4 class="thin"><i class="icon-check"></i> Events</h4>';
}

?>

<!DOCTYPE html>
<html>

<head>
    
    <title>Bodnant Welshfood | Edit User</title>
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
					
					<!-- Edit User Header -->
					<h3 class="thin pull-left">Edit User</h3>
					
					
					<!-- Edit User Form -->
					<form method="post" action="edit_valid.php?id=<?php echo $id; ?>" class="form">
						
						<button type="submit" class="btn btn-success pull-right"><i class="icon-ok icon-white"></i> Save Changes</button>
						<div class="clearfix"></div>
						<hr>
						<!-- Create User Header end -->
						
						<h4 class="thin">Basic Information</h4>
						
						<!-- First Row of form -->
						<div class="row-fluid">
							
							<!-- First Name Edit -->
							<div class="span6">
								<label for="fname">First Name:</label>
								<input type="text" value="<?php echo $data['admin_fname']; ?>" name="fname" class="span12" required>
							</div>
							
							<!-- Second Name Edit -->
							<div class="span6">
								<label for="lname">Surname:</label>
								<input type="text" value="<?php echo $data['admin_lname']; ?>" name="lname" class="span12" required>
							</div>
							
						</div>
						<!-- First Row End -->
						
						<!-- Second Row -->
						<div class="row-fluid">
							
							<!-- Username -->
							<div class="span6">
								<label for="user">Username:</label>
								<input type="text" value="<?php echo $data['username']; ?>" name="user" class="span12" required>
							</div>
							
						</div>
						<!-- Second Row End -->
						
						<!-- Third Row -->
						<div class="row-fluid">
							
							<!-- JOb Position -->
							<div class="span6">
								<label for="position">Job Position:</label>
								<input type="text" value="<?php echo $data['admin_position']; ?>" name="position" class="span12">
							</div>
							
							<!-- Email -->
							<div class="span6">
								<label for="email">Email:</label>
								<input type="text" value="<?php echo $data['email']; ?>" name="email" class="span12">
							</div>
							
						</div>
						<!-- Third row end -->
						
						<hr>
						<h4 class="thin">Contact Settings</h4>
						
						<!-- 3.5 Row -->
						<div class="row-fluid">
						
							<!-- mobile -->
							<div class="span6">
								<label for="mobile">Mobile Number:</label>
								<input type="text" value="<?php echo $data['mobile']; ?>" name="mobile" class="span12">
								<br>
								
								<!-- Notifications On/Off -->
								<label class="checkbox"><input type="checkbox" name="notification" <?php if ($data['enabled'] == 'true') echo 'checked'; ?>> Text Notifications</label>

							</div>
														
						</div>
						<!-- 3.5 Row End -->
						
						<hr>
						
						<h4 class="thin">Change Password</h4>
						
						<!-- Fourth Row -->
						<div class="row-fluid">
							
							<!-- New Password -->
							<div class="span6">
								<label for="password">New Password:</label>
								<input type="password" name="password" class="span12">
							</div>
							
							<!-- Confirm New Password -->
							<div class="span6">
								<label for="password_confirm">Confirm New Password:</label>
								<input type="password" name="password_confirm" class="span12">
							</div>
							
						
						</div>
						<!-- Fourth row End -->
						
						<hr>
						
						<h4 class="thin">User Roles</h4>
						
						<!-- Fifth Row -->
						<div class="row-fluid">
							
							<!-- God -->
							<label class="checkbox inline">
								<input type="checkbox" name="god" <?php if ($data['god'] == 'true') echo 'checked'; ?>> God
							</label>
							
							<!-- Events -->
							<label class="checkbox inline">
								<input type="checkbox"  name="events" <?php if ($data['events'] == 'true') echo 'checked'; ?>> Events
							</label>
							
							<!-- Shop -->
							<label class="checkbox inline">
								<input type="checkbox"  name="shop" <?php if ($data['shop'] == 'true') echo 'checked'; ?>> Shop
							</label>
							
							<!-- Rooms -->
							<label class="checkbox inline">
								<input type="checkbox"  name="rooms" <?php if ($data['rooms'] == 'true') echo 'checked'; ?>> Rooms
							</label>
							
							<!-- School -->
							<label class="checkbox inline">
								<input type="checkbox"  name="school" <?php if ($data['school'] == 'true') echo 'checked'; ?>> School
							</label>
							
						</div>
						<!-- Fifth Row End -->
												
						<hr>
						<button type="submit" class="btn btn-success pull-right"><i class="icon-ok icon-white"></i> Save Changes</button>
						<div class="clearfix"></div>
						
					</form>
					<!-- Edit Form End -->
					
				</div>
				<!-- Well End -->
			
			</div>
			<!-- Main Column End -->
			
			<!-- sidebar Column -->
			<div class="span4 hidden-mobile">
				
				<!-- Well -->
				<div class="well well-small">
					
					<h3 class="thin">Current Profile</h3>
					<hr>
					
					<div class="text-center">
					<img src="<?php echo $image; ?>" class="img-circle" />
					</div>
					
					<hr>
					
					<h3><?php echo ucwords($data['admin_fname'].' '.$data['admin_lname']); ?></h3>
					
					<h4 class="thin"><strong>Username:</strong> <?php echo $data['username']; ?></h4>
					<h4 class="thin"><strong>Email:</strong> <?php echo $data['email']; ?></h4>
					<h4 class="thin"><strong>Contact Number:</strong> <?php echo $data['mobile'];; ?></h4>
					<h4 class="thin"><strong>Text Notifications:</strong> <?php if ($data['enabled'] =='true') {
					echo 'Enabled'; } else { echo 'Disabled';} ?></h4>
					<h4 class="thin"><strong>Position:</strong> <?php echo $data['admin_position']; ?></h4>
							
					<hr>
							
					<div class="row-fluid">
								
						<div class="span3">
						    <h4 class="thin"><strong>Roles:</strong></h4>
						</div>
						
						<div class="span9">
						    <?php echo $roles; ?>
						</div>
								
					</div>

					
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
//If User is not logged in throw them out
} else {
	header("location: ../login.php?error=timeout");
}
?>