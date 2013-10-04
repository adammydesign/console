<?php
//Start Session
session_start();

//Is User Logged in
$user_id = $_SESSION['id'];
$username = $_SESSION['username'];
if(($_SESSION['LoggedIn'] = 1) && ($_SESSION['username'] = $username)) {

//Config Include
include_once('../include/config.php');

// Get Values
$date = $_GET['date'];
$id = $_GET['id'];

// Details Query for $date
if (!empty($date)) {
	$details_query = mysql_query("SELECT * FROM `current_booking` INNER JOIN `customer` ON current_booking.customer_ID=customer.customer_ID INNER JOIN `room_info` ON current_booking.room_ID=room_info.room_ID WHERE `booking_date` = '$date'"); 
}

// Details Query based on $id
if (!empty($id)) {
	$details_query = mysql_query("SELECT * FROM `current_booking` INNER JOIN `customer` ON current_booking.customer_ID=customer.customer_ID INNER JOIN `room_info` ON current_booking.room_ID=room_info.room_ID WHERE `booking_ID` = '$id'");
}

?>

<!DOCTYPE html>
<html>

<head>
    
    <title>Bodnant Welshfood | Booking Details</title>
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
					<li class="active"><a href="../bookings" title="Bookings">Bookings</a></li>
					<li ><a href="../rooms" title="Rooms">Rooms</a></li>
					<li><a href="../orders" title="Orders">Orders</a></li>
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
		
		<!-- Main Row -->
		<div class="row-fluid">
			
			<!-- Main span -->
			<div class="span8">
				
				<!-- Well -->
				<div class="well well-small">
				
					<?php
					//Get appropriate header and buttons
					if (empty($id)) {
						echo '<h3 class="thin pull-left">Day Overview <small><strong>'.date("l, jS F", strtotime($date)).'</strong></small></h3>';
					} else {
						echo '<h3 class="thin pull-left">Booking Details</h3>';
					}
					
					if (!empty($id)) {
						echo '<a href="delete.php?id='.$id.'" class="pull-right btn btn-danger"><i class="icon-trash icon-white"></i> Delete</a>';
					}
					
					echo '<div class="clearfix"></div><hr>';
					
					// If no bookings
					if (mysql_num_rows($details_query) == 0) {
						echo '<strong>There are no bookings for today.</strong>';
					}
					?>
					
					
					
					<?php
						
						// Check if it is a day overview
						if (!empty($date)) {
							//Loop for todays bookings
							while ($rows = mysql_fetch_array($details_query)) {
								//Create Full name
								$name = ucwords($rows['first_name'].' '.$rows['second_name']);
								
								//Check Payment Status
								if ($rows['booking_paid'] == 1) {
									$paid = 'paid';
								} else {
									$paid = 'Unpaid';
								}
								
								echo '<div class="well well-small">'; // Well
								echo '<div class="pull-left"><h4 class="">'.$name.'</h4><h4 class="thin">in '.ucwords($rows['room_name']).'</h4></div>'; // Header
								echo '<a href="details.php?id='.$rows['booking_ID'].'" class="pull-right btn btn-info"><i class="icon-list icon-white"></i> Full Booking Details</a>';
								echo '<div class="clearfix"></div><hr>';
								echo '<div class="row-fluid">'; // Row Fluid
								echo '<div class="span4"><img src="room_images/'.$rows['room_image'].'" /></div>';
								echo '<div class="span8"><div class="well well-small">';// Information span
								echo '<strong>Booking ID:</strong> '.$rows['booking_ID'].'<br>';
								echo '<strong>Payment Status:</strong> '.$paid.'<br>';
								echo '<strong>Contact Number:</strong> '.$rows['contact_num'].'<br>';
								echo '<strong>Email:</strong> '.$rows['email'].'<br><br>';
								echo '<strong>Language Preference:</strong> '.$rows['language'].'<br>';
								echo '</div></div>';// Info Span end
								echo '</div>'; // End Row Fluid
								echo '</div>';//End Well
							}
							//End Loop
						}
						//End Day Overview
						
						//Check if it is Booking Details
						if(!empty($id)) {
							
							
								
						// Get Basic Booking Details
						$row=mysql_fetch_array($details_query);
						
						//Get Number of Nights and Check in Date
						$details = mysql_query("SELECT DISTINCT `booking_date` FROM `current_booking` WHERE `booking_ID` = '$id' ORDER BY `booking_date`");
						$nights = mysql_num_rows($details);
						$get_info = mysql_fetch_array($details);
						$check_in = date("l, jS F", strtotime($get_info['booking_date']));
						$check_out = date("l, jS F", strtotime($get_info['booking_date'].'+ '.$nights.' days'));
						
						
						
						echo '<h3 class="pull-left">'.ucwords($row['first_name'].' '.$row['second_name']).'';
						echo '<small> | <strong>Booking ID:</strong> '.$id.'</small></h3>';
						
						if ($row['booking_paid'] == 1) {
							echo '<div class="alert alert-success alert-even pull-right text-center">Paid</div>';
							echo '<div class="clearfix"></div><hr class="mb10">';
						} else {
							echo '<div class="alert alert-danger alert-even pull-right text-center">Unpaid</div>';
							echo '<div class="clearfix"></div><hr class="mb10">';
						}
						
						
						
								
							// Details Row
							echo '<div class="row-fluid">';
								
								//Booking Details Span
								echo '<div class="span6">';
								
									echo '<h4 class="thin mb10"><strong>Check in:</strong> '.$check_in.'</h4>';
									echo '<h4 class="thin mb10"><strong>Check Out:</strong> '.$check_out.'</h4>';
									echo '<h4 class="thin"><strong>Rooms Taken:</strong> ';
									//Room Names Query
									$room_names = mysql_query("SELECT DISTINCT `room_ID` FROM `current_booking` WHERE `booking_ID`='$id'");
										
										// Create Array of room_ID's to get available rooms
										$room_array = array();
										while($array = mysql_fetch_array($room_names)){
										    $room_array[] = $array['room_ID'];
										}
										
										//echo $room_array;
										$room_array = implode(',',$room_array);
										
										$room_info = mysql_query("SELECT `room_name` FROM `room_info` WHERE `room_ID` IN ($room_array)");
										
										while ($room = mysql_fetch_array($room_info)) {
											echo $room['room_name'].', ';
										}
									
									echo '</h4>';
									
								//Booking details End 
								echo '</div>';
								
								// Contact details
								echo '<div class="span6"><div class="well well-small">';
									
									echo '<h4>Contact Details</h4><hr>';
									echo '<strong>Email:</strong> '.$row['email'].'<br>';
									echo '<strong>Contact Num:</strong> '.$row['contact_num'].'<br>';
									echo '<strong>Address:</strong> '.$row['address_one'].', '.$row['city'].', '.$row['postcode'].'';
									
								// Contact Details end
								echo '</div></div>';
							
							// Details Row End
							echo '</div>';	
						}
						// End Booking details
						
					?>
					
				</div>
			</div>
			<!-- Main span End -->
		
		</div>
		<!-- Main Row End -->
		
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