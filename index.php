<?php
//Session start
session_start();
//Is User Logged In
$username = $_SESSION['username'];
$user_id = $_SESSION['id'];
$admin = $_SESSION['admin'];
if(($_SESSION['LoggedIn'] = 1) && ($_SESSION['username'] = $username)) {

//Config include
include_once('include/config.php');

?>

<!DOCTYPE html>
<html>

<head>
    
    <title>Bodnant Welshfood | Administrator Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Stylesheets -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.css" rel="stylesheet" media="screen">
    <link href="css/main.css" rel="stylesheet" media="screen">
     
    <!--Scripts -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
</head>
  
<body>
	
	<!-- Header Start -->
	<div class="header">
	
		<!-- Header Container -->
		<div class="container">
			
			<!-- Header Row -->
			<div class="row-fluid clearfix">
				
				<!-- Header Logo -->
				<img src="img/logo.gif" title="Bodnant welshfood Admin" class="span2"/>
				
				<!-- Header Logout and settings -->
				<div class="pull-right text-right">
					
					<!-- Account Settings -->
					<a href="/users/details.php?id=<?php echo $user_id; ?>" class="btn">Account <i class="icon-cog"></i></a>
					
					<!-- Logout Button -->
					<a href="logout.php" title="logout" class="btn btn-danger">Logout <i class="icon-off icon-white"></i></a>
					
					
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
					
					<li class="active"><a href="" title="Dashboard">Dashboard</a></li>
					<li><a href="/bookings" title="Bookings">Bookings</a></li>
					<li ><a href="/rooms" title="Rooms">Rooms</a></li>
					<li><a href="/orders" title="Orders">Orders</a></li>
					<li><a href="/events" title="Events">Events</a></li>
					<li><a href="/products" title="Products">Products</a></li>
					<?php if($admin=='yes') { echo '<li><a href="/users" title="Users">Users</a></li>'; } ?>
					
				</ul>
				
				<!-- Welcome Message -->
				<p class="welcome pull-right">Welcome back <strong><?php echo ucwords($username); ?></strong></p>
				
			</div>
			<!-- Nav inner end -->
			
		</div>
		<!-- Main desktop Nav End -->
		
		<!-- First Body row -->
		<div class="row-fluid">
			
			<!-- Upcoming Bookings -->
			<div class="span6">
				
				<!-- well -->
				<div class="well well-small">
					
					<h3 class="pull-left thin">Bookings This Week</h3>
					<div class="btn-group pull-right">
					<a href="/bookings/create.php" class="btn btn-small btn-success"><i class="icon-plus icon-white"></i> Create A Booking</a>
					<a href="/bookings" title="View all bookings" class="btn btn-small btn-inverse">View Bookings</a>
					</div>
					<div class="clearfix"></div>
					<hr>
					
					<table class="table table-striped">
						
						<tr>
							<td><strong>Date</strong></td>
							<td><strong>No. Rooms Booked</strong></td>
							<td><strong>Details</strong></td>
						</tr>
						
						<?php
						
						$date = date("Y-m-d");
						$days = 7;
						$increment = 1;
						
						while ($days >= $increment) {
							
							$room_check = mysql_query("SELECT DISTINCT `room_ID` FROM `current_booking` WHERE `booking_date`='$date'");
							$rows = mysql_num_rows($room_check);
							
							if( $rows == 0) {
								$rooms = '<div class="btn-group"><a href="/bookings/details.php?date='.$date.'" class="btn btn-danger btn-small">1</a><a href="/bookings/details.php?date='.$date.'" class="btn btn-danger btn-small">2</a><a href="/bookings/details.php?date='.$date.'" class="btn btn-danger btn-small">3</a><a href="/bookings/details.php?date='.$date.'" class="btn btn-danger btn-small">4</a><a href="/bookings/details.php?date='.$date.'" class="btn btn-danger btn-small">5</a></div>';
							} elseif( $rows == 1) {
								$rooms = '<div class="btn-group"><a href="/bookings/details.php?date='.$date.'" class="btn btn-success btn-small">1</a><a href="/bookings/details.php?date='.$date.'" class="btn btn-danger btn-small">2</a><a href="/bookings/details.php?date='.$date.'" class="btn btn-danger btn-small">3</a><a href="/bookings/details.php?date='.$date.'" class="btn btn-danger btn-small">4</a><a href="/bookings/details.php?date='.$date.'" class="btn btn-danger btn-small">5</a></div>';
							} elseif($rows == 2) {
								$rooms = '<div class="btn-group"><a href="/bookings/details.php?date='.$date.'" class="btn btn-success btn-small">1</a><a href="/bookings/details.php?date='.$date.'" class="btn btn-success btn-small">2</a><a href="/bookings/details.php?date='.$date.'" class="btn btn-danger btn-small">3</a><a href="/bookings/details.php?date='.$date.'" class="btn btn-danger btn-small">4</a><a href="/bookings/details.php?date='.$date.'" class="btn btn-danger btn-small">5</a></div>';
							} elseif($rows == 3) {
								$rooms = '<div class="btn-group"><a href="/bookings/details.php?date='.$date.'" class="btn btn-success btn-small">1</a><a href="/bookings/details.php?date='.$date.'" class="btn btn-success btn-small">2</a><a href="/bookings/details.php?date='.$date.'" class="btn btn-success btn-small">3</a><a href="/bookings/details.php?date='.$date.'" class="btn btn-danger btn-small">4</a><a href="/bookings/details.php?date='.$date.'" class="btn btn-danger btn-small">5</a></div>';
							} elseif($rows == 4) {
								$rooms = '<div class="btn-group"><a href="/bookings/details.php?date='.$date.'" class="btn btn-success btn-small">1</a><a href="/bookings/details.php?date='.$date.'" class="btn btn-success btn-small">2</a><a href="/bookings/details.php?date='.$date.'" class="btn btn-success btn-small">3</a><a href="/bookings/details.php?date='.$date.'" class="btn btn-success btn-small">4</a><a href="/bookings/details.php?date='.$date.'" class="btn btn-danger btn-small">5</a></div>';
							} elseif($rows == 5) {
								$rooms = '<div class="btn-group"><a href="/bookings/details.php?date='.$date.'" class="btn btn-success btn-small">1</a><a href="/bookings/details.php?date='.$date.'" class="btn btn-success btn-small">2</a><a href="/bookings/details.php?date='.$date.'" class="btn btn-success btn-small">3</a><a href="/bookings/details.php?date='.$date.'" class="btn btn-success btn-small">4</a><a href="/bookings/details.php?date='.$date.'" class="btn btn-success btn-small">5</a></div>';
							}
							
							$booking = '<tr>';
							$booking .= '<td><strong>'.date("l, jS F", strtotime($date)).'</strong></td>';
							$booking .= '<td>'.$rooms.'</td>';
							$booking .= '<td><a href="/bookings/details.php?date='.$date.'" class="btn btn-small btn-info"><i class="icon-list icon-white"></i> Details</a></td>';			
							$booking .= '</tr>';							
													
							echo $booking;		
							
							
							
							$date = date("Y-m-d", strtotime($date.'+ 1 days'));
							$increment++;
						}
						
						
						?>
					
					</table>
					
					
				</div>
				<!-- Well end -->
				
			</div>
			<!-- Bookings End -->
			
			<!-- Recent Orders -->
			<div class="span6">
				
				<!-- well -->
				<div class="well well-small">
					
					<h3 class="pull-left thin">Recent Orders</h3>
					<div class="btn-group pull-right">
						<a href="/orders/create.php" title="Create user" class="btn btn-small btn-success"><i class="icon-plus icon-white"></i> Create Order</a>
						<a href="/orders" title="View all users" class="btn btn-small btn-inverse">All Orders</a>
					</div>
					<div class="clearfix"></div>
					<hr>
					
					
				</div>
				<!-- Well end -->
				
			</div>
			<!-- orders End -->
			
		</div>
		<!-- First Row end -->
		
		<!-- Secon Row -->
		<div class="row-fluid">
			
			<!-- Upcoming Events -->
			<div class="span6">
				
				<!-- well -->
				<div class="well well-small">
					
					<h3 class="pull-left thin">Upcoming Events</h3>
					
					<div class="btn-group pull-right">
						<a href="/events/create.php" title="Create event" class="btn btn-small btn-success"><i class="icon-plus icon-white"></i> Create Event</a>
						<a href="/events" title="View all events" class="btn btn-small btn-inverse">All Events</a>
					</div>
					
					<div class="clearfix"></div>
					<hr>
					<div id="event_container">
					<?php
					//Event Query
					$event_query = mysql_query("SELECT * FROM `bodnant_c0nsole`.`events` WHERE `event_date` >= DATE(NOW()) ORDER BY `event_date` LIMIT 0,4");
					$event_rows = mysql_num_rows($event_query);

						$i = 0;
						
						while ($i < $event_rows) {
							
							//Get todays date for comparison
							$today = date('Ymd');
							
							//Get info from database
							$id = mysql_result($event_query,$i,"event_ID");
							$name = mysql_result($event_query,$i,"event_name");
							$price = '&pound'.mysql_result($event_query, $i, "event_price");	
							$stime = mysql_result($event_query, $i, "event_start_time");
							$etime = mysql_result($event_query, $i, "event_end_time");
							$image = mysql_result($event_query, $i, "event_image");
							$date = mysql_result($event_query,$i,"event_date");
													
							//Change Database date to Display Date
							$date = date("l, jS F, Y", strtotime($date));
														
							//Get Image and if blank use holding image
							if (empty($image)) {
								$image = '../img/event_hold.jpg';
							} else {
								$image = 'events/event_images/'.$image;
							}
							
							$event = '<div class="span6 event">';
							$event .= '<img src="'.$image.'" class="event_image" title="'.$name.'" />';
							$event .= '<div class="overlay"></div>';
							$event .= '<a href="#image'.$id.'" data-toggle="modal" role="button" class="event_upload btn btn-info btn-small"><i class="icon-edit icon-white"></i> Edit Image</a>';
							$event .= '<div class="event_info">';
							$event .= '<div class="well well-small">';
							$event .= '<h4 class="thin"><strong>'.$name.'</strong></h4>';
							$event .= '<h5 class="thin">'.$date.'</h5>';
							$event .= '<hr>';
							$event .= '<div class="btn-group pull-right">';
							$event .= '<a href="/events/edit.php?id='.$id.'" class="btn btn-info"><i class="icon-edit icon-white"></i> Edit Event</a>';
							$event .= '<a href="#delete'.$id.'" class="btn btn-danger" data-toggle="modal" role="button"><i class="icon-trash icon-white"></i></a>';
							$event .= '</div><div class="clearfix"></div>';
							$event .= '</div>';
							$event .= '</div>';
							$event .= '</div>';
							
							//Echo Events
							echo $event;
							?>
							
							<!-- Delete Modal -->
							<div id="delete<?php echo $id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
									<h3 id="myModalLabel">Confirm Delete Event</h3>
								</div>
								<div class="modal-body">
									<p>Are you sure you want to delete <strong><?php echo $name; ?></strong>?</p>
								</div>
								<div class="modal-footer">
									<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
									<a href="/events/delete.php?remove=1&id=<?php echo $id; ?>&name=<?php echo $name; ?>" class="btn btn-danger">Delete <i class="icon-trash icon-white"></i></a>
								</div>
							</div>
							<!-- Modal Delete End -->
							
							<!-- Profile Modal -->
							<div id="image<?php echo $id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
									<h3 id="myModalLabel">Edit Event image</h3>
								</div>
								<div class="modal-body">
									<form action="/events/image_upload.php?id=<?php echo $id; ?>&name=<?php echo $name; ?>" method="post" enctype="multipart/form-data">
									<input type="file" name="image_upload" />
									
								</div>
								<div class="modal-footer">
									<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
									<button type="submit" class="btn btn-success">Upload Event Image <i class="icon-arrow-up icon-white"></i></button>
									</form>
								</div>
							</div>
							<!-- Modal Profile End -->
							
							<?
							
							$i++;
							
						}
						
						//If there are no upcoming events
						if ($event_rows == 0) {
							echo 'There are no upcoming events.';
						}
											
						
						?>

					
					</div>
					
				</div>
				<!-- Well end -->
				
			</div>
			<!-- Events End -->
			
			<?php if($_SESSION['admin'] == 'yes') {
					?>
			<!-- Current Users -->
			<div class="span6">
				
				<!-- well -->
				<div class="well well-small">
					
					<h3 class="pull-left thin">Current Users</h3>
					<div class="btn-group pull-right">
						<a href="/users/create.php" title="Create user" class="btn btn-small btn-success"><i class="icon-plus icon-white"></i> Create User</a>
						<a href="/users" title="View all users" class="btn btn-small btn-inverse">All Users</a>
					</div>

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
						echo '<tr><td>'.$fullname.'</td><td>'.$position.'</td><td><a href="/users/details.php?id='.$id.'" class="btn btn-small btn-info">User Details</a></td><td><a href="#confirm'.$id.'" data-toggle="modal" role="button" class="btn btn-small btn-danger"><i class="icon-trash icon-white"></i></a></td></tr>';
						
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
    <a href="/users/delete.php?remove=1&id='.$id.'&name='.$fullname.'" class="btn btn-danger">Delete <i class="icon-trash icon-white"></i></a>
  </div>
</div>';
						
						$i++;
						
						
						}
						
						?>
						
					</table>
					<!-- User Table End -->

					
					
				</div>
				<!-- Well end -->
				
			</div>
			<!-- Users End -->
			<?php } ?>
			
		</div>
		<!-- Second Row End -->
		
	</div>
	<!-- Body Container End -->
	
<!-- Page Scripts -->
<script>
var holder;

$(".event").each(function(index, elem){
    if(index%2==0){
        holder=$("<div class='row-fluid event_row'></div>").appendTo("#event_container");
    }
    
    holder.append(this);
});

$(function () {

        $('.event').hover(function() {
           $(this).children('.event a.event_upload, .event .overlay').fadeToggle("fast");
        });

    });

</script>
		
</body>
</html>
<?php
//If not logged in throw them out
} else {
	header("location: login.php?error=timeout");
}
?>