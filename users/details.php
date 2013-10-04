<?php
//Start Session
session_start();

//Is User Logged in
$username = $_SESSION['username'];
$user_id = $_SESSION['id'];
$admin = $_SESSION['admin'];
if(($_SESSION['LoggedIn'] = 1) && ($_SESSION['username'] = $username)) {

//Get ID from list
$id = $_GET['id'];

//Get Update user values
$update = $_GET['update'];
$password = $_GET['password'];

//If password was successful
if ($password == 'success') {
	$password = '<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">&times</button>
								<strong>Great Work!</strong> Password changed.
						</div>';
} elseif ($password == 'fail') {
	$password = '<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">&times</button>
								<strong>Bad News!</strong> Password update failed.
						</div>';
}

//If User update successful
if ($update == 'success') {
	$update = '<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">&times</button>
								<strong>Great Work!</strong> User updated successfully.
						</div>';
} elseif ($update == 'fail') {
	$update = '<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">&times</button>
								<strong>Bad News!</strong> Updating user failed.
						</div>';
}

//Config Include
include_once('../include/config.php');

//Query for User Details
$detail_query = mysql_query("SELECT * FROM `bodnant_c0nsole`.`admin` WHERE `admin_ID` = $id");
$data = mysql_fetch_array($detail_query);

//Get fields from database
$fullname = ucwords($data['admin_fname'].' '.$data['admin_lname']);
$user = $data['username'];
$email = $data['email'];
$contact = $data['mobile'];
$position = $data['admin_position'];
$image = $data['admin_image'];
$notification = $data['enabled'];

if ($notification == 'true') {
	$notification = 'Enabled';
} else {
	$notification = 'Disabled';
}

//If there is no profile image then use placeholder
if (empty($image)) {
	$image = "http://placehold.it/300x300";
} else {
	$image = "avatars/$image";
}

//Get upload picture result
$upload = $_GET['image'];

//Alerts for profile image upload
if ($upload == 'success') {
	$alert = '<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">&times</button>
								<strong>Great News!</strong> Profile image changed.
						</div>';
} elseif ($upload == 'fail') {
	$alert = '<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">&times</button>
								<strong>Whoops</strong> Something Went wrong there.
						</div>';
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
					<?php if($admin=='yes') { echo '<li class="active"><a href="/users" title="Users">Users</a></li>'; } ?>
					
				</ul>
				
				<!-- Welcome Message -->
				<p class="welcome pull-right">Welcome back <strong><?php echo ucwords($username); ?></strong></p>
				
			</div>
			<!-- Nav inner end -->
			
		</div>
		<!-- Main desktop Nav End -->
		
		<!-- Main Row Start -->
		<div class="row-fluid">
		
			<!-- Main Span -->
			<div class="span8">
				
				<!-- Well -->
				<div class="well well-small">
				
				<!-- Notifications echo -->
				<?php
				echo $update;
				echo $password;
				?>
					<h3 class="thin pull-left">User Details</h3>
					
					<!-- Btn Group -->
					<div class="btn-group  pull-right">
						
						<a href="edit.php?id=<?php echo $id; ?>" title="Edit user" class="btn btn-info">Edit <i class="icon-edit icon-white"></i></a>
						<?php if($admin=='yes') { echo '<a href="#confirm" data-toggle="modal" role="button" class="btn btn-danger"><i class="icon-trash icon-white"></i></a>'; } ?>
						
					</div>
					<!-- Btn group end -->
					
					<div class="clearfix"></div>
					
					<!-- Delete Modal -->
					<div id="confirm" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
							<h3 id="myModalLabel">Confirm Delete User</h3>
						</div>
						<div class="modal-body">
							<p>Are you sure you want to delete <strong><?php echo $fullname; ?></strong>?</p>
						</div>
						<div class="modal-footer">
							<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
							<a href="delete.php?remove=1&id=<?php echo $id; ?>&name=<?php echo $fullname; ?>" class="btn btn-danger">Delete <i class="icon-trash icon-white"></i></a>
						</div>
					</div>
					<!-- Modal Delete End -->
					
					<!-- Profile Modal -->
					<div id="edit_image" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
							<h3 id="myModalLabel">Edit profile image</h3>
						</div>
						<div class="modal-body">
							<form action="image_upload.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
							<input type="file" name="profile_upload" />
							
						</div>
						<div class="modal-footer">
							<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
							<button class="btn btn-success">Upload Profile Image <i class="icon-arrow-up icon-white"></i></button>
							</form>
						</div>
					</div>
					<!-- Modal Profile End -->
					
					<hr>
					
					<?php if (!empty($alert)) {
						echo $alert;
					}
					?>
					
					<!-- Internal Row -->
					<div class="row-fluid">
						
						<!-- Internal Span5 -->
						<div class="span5">
							
							<!-- Profile Picture -->
							<div class="profile_image text-center">
								
								<img class="img-circle profile" src="<?php echo $image; ?>" title="Your Profile Image" />
								
								<div class="hover_filter img-circle"></div>
								
								<!-- Change Profile Image Modal Call -->
								<a href="#edit_image" data-toggle="modal" role="button" class="btn btn-info"><i class="icon-edit icon-white"></i> Edit Image</a>
								
							</div>
							
						</div>
						<!--Internal Span5 End -->
						
						<!--Internal Span7 -->
						<div class="span7">
							
							<h3><?php echo $fullname; ?></h3>
							<h4 class="thin"><strong>Username:</strong> <?php echo $user; ?></h4>
							<h4 class="thin"><strong>Email:</strong> <?php echo $email; ?></h4>
							<h4 class="thin"><strong>Contact Number:</strong> <?php echo $contact; ?></h4>
							<h4 class="thin"><strong>Text Notifications:</strong> <?php echo $notification; ?></h4>
							<h4 class="thin"><strong>Position:</strong> <?php echo $position; ?></h4>
							
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
						<!-- Internal Span7 End -->
								
						
					</div>
					<!-- Internal Row End -->
					
					<hr>
					<!-- Btn Group -->
					<div class="btn-group  pull-right">
						
						<a href="edit.php?id=<?php echo $id; ?>" title="Edit user" class="btn btn-info">Edit <i class="icon-edit icon-white"></i></a>
						<?php if($admin=='yes') { echo '<a href="#confirm" data-toggle="modal" role="button" class="btn btn-danger"><i class="icon-trash icon-white"></i></a>'; } ?>
					</div>
					<!-- Btn group end -->
					
					<div class="clearfix"></div>
					
					
				</div>
				<!-- Well end -->
				
			</div>
			<!-- Main Span End -->
		
		</div>
		<!-- Main Row End -->
		
	</div>
	<!-- Container End -->

<!-- Profile Button Fade -->
<script>

    $(function () {

        $('.profile_image').hover(function() {
           $('.profile_image a').fadeToggle("fast");
        });

    });


    </script>
</body>
</html>

<?php
//If User is not logged in throw them out
} else {
	header("location: ../login.php?error=timeout");
}
?>