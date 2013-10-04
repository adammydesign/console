<?php
//Start Session
session_start();

//Is User Logged in
$username = $_SESSION['username'];
$user_id = $_SESSION['id'];
if(($_SESSION['LoggedIn'] = 1) && ($_SESSION['username'] = $username)) {

//Config Include
include_once('../include/config.php');

$user_query = mysql_query("SELECT * FROM `admin` ORDER BY `admin_fname`");
$rows = mysql_num_rows($user_query);


$error = $_GET['error'];
$fname = $_GET['fname'];
$lname = $_GET['lname'];
$user = $_GET['user'];
$email = $_GET['email']


?>

<!DOCTYPE html>
<html>

<head>
    
    <title>Bodnant Welshfood | Create User</title>
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
					<?php if($_SESSION['admin'] =='yes') { echo '<li class="active"><a href="/users" title="Users">Users</a></li>'; } ?>

					
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
					
					<!-- Create User Header -->
					<h3 class="thin pull-left">Create New User</h3>
					
					
					<!-- Create User Form -->
					<form method="post" action="create_valid.php" class="form">
						
						<button type="submit" class="btn btn-success pull-right"><i class="icon-ok icon-white"></i> Create User</button>
						<div class="clearfix"></div>
						<hr>
						<!-- Create User Header end -->
						
						<!-- Form Fields -->
						<h4 class="thin">Basic Information <small>All basic information is required.</small></h4>
						
						<?php
							//Fields not filled
							if ($error == 'fields') {
								echo '<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">&times</button>
								<strong>Oh snap!</strong> Make sure you have filled in all required fields.
						</div>';	
							}

							?>
							
						<!-- First Form Row -->
						<div class="row-fluid">
							
							<!-- First Name -->
							<div class="span6">
								<label for="fname">First Name:</label>
								<input class="span12" type="text" placeholder="First Name" name="fname" value="<?php echo $fname; ?>" required>
							</div>
							
							<!-- Last name -->
							<div class="span6">
								<label for="lname">Surname:</label>
								<input class="span12" type="text" placeholder="Surname" name="lname" value="<?php echo $lname; ?>"required>
							</div>
							
						</div>
						<!-- First Row End -->
						
						<!-- Second Row -->
						<div class="row-fluid">
							
							<?php
							//Email error Alert
							if ($error == 'email') {
								echo '<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">&times</button>
								<strong>Oh snap!</strong> Make sure you type the same email address.
						</div>';	
							}
							
							//Email error Alert
							if ($error == 'user') {
								echo '<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">&times</button>
								<strong>Oh snap!</strong> That username is already taken.
						</div>';	
							}

							?>
							
							<!-- Username -->
							<div class="span6">
								<label for="username">Username:</label>
								<input class="span12" type="text" placeholder="Username" name="username" value="<?php echo $user; ?>" required>
							</div>
							
						</div>
						<!-- Second Row End -->
						
						<!-- 2.5 Row -->
						<div class="row-fluid">	
							<!-- Email -->
							<div class="span6">
								<label for="email">Email:</label>
								<input class="span12" type="email" placeholder="youremail@email.com" name="email" value="<?php echo $email; ?>" required>
							</div>
							
							<!-- Confirm Email -->
							<div class="span6">
								<label for="email_confirm">Confirm Email Address:</label>
								<input class="span12" type="email" placeholder="Confirm Email Address" name="email_confirm" required>
							</div>
							
						</div>
						<!-- 2.5 Row End -->
						
						<!-- Job row -->
						<div class="row-fluid">
						
							<!-- Job position -->
							<div class="span6">
								<label for="position">Current Job Position:</label>
								<input class="span12" type="text" placeholder="Current Job Position" name="position">
							</div>
							
						</div>
						<!-- Job row End -->
						
						<!-- Third Row -->
						<div class="row-fluid">
						
						<?php
							//Password error alert
							if ($error == 'password') {
								echo '<div class="alert alert-error">
								<button type="button" class="close" data-dismiss="alert">&times</button>
								<strong>Oh snap!</strong> Make sure you type the same password.
						</div>';	
						}
							?>
							
							<!-- Password -->
							<div class="span6">
								<label for="password">Password:</label>
								<input class="span12" type="password" placeholder="Password" name="password" required>
							</div>
							
							<!-- Password Confirm -->
							<div class="span6">
								<label for="password_confirm">Confirm Password:</label>
								<input class="span12" type="password" placeholder="Confirm Password" name="password_confirm" required>
							</div>
								
						</div>
						<!-- Third Row End -->
						
						<hr>
						
						<h4 class="thin">Contact Settings</h4>
						
						<!-- Fourth Row -->
						<div class="row-fluid">
							
							<!-- Mobile NUmber -->
							<div class="span6">
								<label for="number">Mobile Number:</label>
								<input class="span12" type="text" placeholder="Mobile Number" name="number" >
							</div>
							
							
						</div>
						<!-- Fourth Row End -->
						
						<!-- Notifications On/Off -->
						<label class="checkbox"><input type="checkbox" name="notification" > Text Notifications</label>
						
						<hr>
						
						<h4 class="thin">User Roles <small>At least one user role must be selected.</small></h4> 
						
						<?php
						//Role Error
						if ($error == 'role') {
							echo '<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">&times</button>
								<strong>Oh snap!</strong> you need to pick at least one role.
						</div>';	
						}
						?>
						
						<!--User Roles Well -->
						<div class="well well-small">
						<p>Please select the appropriate levels of the user. You can select more than one option if the user has more than one role within Bodnant.</p>
						</div>
						
						<!-- User Role Options -->
						
						<!-- God -->
						<label class="checkbox inline">
							<input type="checkbox" name="god"> God
						</label>
						
						<!-- Events -->
						<label class="checkbox inline">
							<input type="checkbox"  name="events"> Events
						</label>
						
						<!-- Shop -->
						<label class="checkbox inline">
							<input type="checkbox"  name="shop"> Shop
						</label>
						
						<!-- Rooms -->
						<label class="checkbox inline">
							<input type="checkbox"  name="rooms"> Rooms
						</label>
						
						<!-- School -->
						<label class="checkbox inline">
							<input type="checkbox"  name="school"> School
						</label>
						
						<br/>
						
						<hr>
						<button type="submit" class="btn btn-success pull-right"><i class="icon-ok icon-white"></i> Create User</button>
						<div class="clearfix"></div>
						
					</form>
					<!-- Create Form End -->
					
				</div>
				<!-- Well End -->
			
			</div>
			<!-- Main Column End -->
			
			<!-- sidebar Column -->
			<div class="span4 hidden-mobile">
				
				<!-- Well -->
				<div class="well well-small">
					
					<h3 class="thin">Current Users</h3>
					<hr>
					
					<!--  User Table -->
					<table class="table table-striped">
					
						<tr>
							<td><strong>Name</strong></td>
							<td><strong>Username</strong></td>
						</tr>
							<?php
							
							while($rows = mysql_fetch_array($user_query)) {
							
							$user = '<tr><td>'.ucwords($rows['admin_fname'].' '.$rows['admin_lname']).'</td><td>'.$rows['username'].'';
							
							echo $user;
								
							}
							?>
					
					</table>
					<!-- end User Table -->
					
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