<?php
//Start Session
session_start();

//Is user logged in
$username = $_SESSION['username'];
if(($_SESSION['LoggedIn'] = 1) && ($_SESSION['username'] = $username)) {

include_once('../include/config.php');
?>

<!DOCTYPE html>
<html>

<head>
    
    <title>Bodnant Welshfood | Orders</title>
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
					<a href="../users/edit.php?id=<?php echo $user_id; ?>" class="btn">Account <i class="icon-cog"></i></a>
					
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
					<li class="active"><a href="" title="Orders">Orders</a></li>
					<li><a href="../events" title="Events">Events</a></li>
					<li ><a href="../products" title="Products">Products</a></li>
					<?php if($_SESSION['admin'] =='yes') { echo'<li><a href="../users" title="Users">Users</a></li>'; } ?>
					
				</ul>
				
				<!-- Welcome Message -->
				<p class="welcome pull-right">Welcome back <strong><?php echo ucwords($username); ?></strong></p>
				
			</div>
			<!-- Nav inner end -->
			
		</div>
		<!-- Main desktop Nav End -->
		
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