<?php
//Start Session
session_start();

//Is user logged in
$username = $_SESSION['username'];
$user_id = $_SESSION['id'];
if(($_SESSION['LoggedIn'] = 1) && ($_SESSION['username'] = $username)) {

include_once('../include/config.php');

if($_GET['booking'] == 'true') {
    $alert = '<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">&times</button>
								<strong>Great News!</strong> New booking created.
						</div>';
} 
?>

<!DOCTYPE html>
<html>

<head>
    
    <title>Bodnant Welshfood | Bookings </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Stylesheets -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../css/bootstrap-responsive.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <link href="../css/main.css" rel="stylesheet" media="screen">
     
    <!--Scripts -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script> 
    <script src="../js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
      
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
			
			<!-- Main Span -->
			<div class="span8">
				
								
				<!-- well -->
				<div class="well well-small">
					
					<?php
						if (!empty($alert)) {
						    echo $alert;
						}
					?>


					<h3 class="thin pull-left">Bookings</h3>
					<a href="create.php" class="btn btn-inverse pull-right"><i class="icon-plus icon-white"></i> Create Booking</a>
					<div class="clearfix"></div>
					<hr>
					<div class="well well-small">
					Below is a 2 week overview of rooms that are booked. Click  <a class="btn btn-mini btn-info"><i class="icon-list icon-white"></i> Details</a>  for more information. You can also search for a specific booking on this page.
					</div>
					
					<table class="table table-striped">
						
						<tr>
							<td><strong>Date</strong></td>
							<td><strong>No. Rooms Booked</strong></td>
							<td><strong>Details</strong></td>
						</tr>
						
						<?php
						
						$date = date("Y-m-d");
						$days = 14;
						$increment = 1;
						
						while ($days >= $increment) {
							
							$room_check = mysql_query("SELECT DISTINCT `room_ID` FROM `current_booking` WHERE `booking_date`='$date'");
							$rows = mysql_num_rows($room_check);
							
							if( $rows == 0) {
								$rooms = '<div class="btn-group"><a href="details.php?date='.$date.'" class="btn btn-danger btn-small">1</a><a href="details.php?date='.$date.'" class="btn btn-danger btn-small">2</a><a href="details.php?date='.$date.'" class="btn btn-danger btn-small">3</a><a href="details.php?date='.$date.'" class="btn btn-danger btn-small">4</a><a href="details.php?date='.$date.'" class="btn btn-danger btn-small">5</a></div>';
							} elseif( $rows == 1) {
								$rooms = '<div class="btn-group"><a href="details.php?date='.$date.'" class="btn btn-success btn-small">1</a><a href="details.php?date='.$date.'" class="btn btn-danger btn-small">2</a><a href="details.php?date='.$date.'" class="btn btn-danger btn-small">3</a><a href="details.php?date='.$date.'" class="btn btn-danger btn-small">4</a><a href="details.php?date='.$date.'" class="btn btn-danger btn-small">5</a></div>';
							} elseif($rows == 2) {
								$rooms = '<div class="btn-group"><a href="details.php?date='.$date.'" class="btn btn-success btn-small">1</a><a href="details.php?date='.$date.'" class="btn btn-success btn-small">2</a><a href="details.php?date='.$date.'" class="btn btn-danger btn-small">3</a><a href="details.php?date='.$date.'" class="btn btn-danger btn-small">4</a><a href="details.php?date='.$date.'" class="btn btn-danger btn-small">5</a></div>';
							} elseif($rows == 3) {
								$rooms = '<div class="btn-group"><a href="details.php?date='.$date.'" class="btn btn-success btn-small">1</a><a href="details.php?date='.$date.'" class="btn btn-success btn-small">2</a><a href="details.php?date='.$date.'" class="btn btn-success btn-small">3</a><a href="details.php?date='.$date.'" class="btn btn-danger btn-small">4</a><a href="details.php?date='.$date.'" class="btn btn-danger btn-small">5</a></div>';
							} elseif($rows == 4) {
								$rooms = '<div class="btn-group"><a href="details.php?date='.$date.'" class="btn btn-success btn-small">1</a><a href="details.php?date='.$date.'" class="btn btn-success btn-small">2</a><a href="details.php?date='.$date.'" class="btn btn-success btn-small">3</a><a href="details.php?date='.$date.'" class="btn btn-success btn-small">4</a><a href="details.php?date='.$date.'" class="btn btn-danger btn-small">5</a></div>';
							} elseif($rows == 5) {
								$rooms = '<div class="btn-group"><a href="details.php?date='.$date.'" class="btn btn-success btn-small">1</a><a href="details.php?date='.$date.'" class="btn btn-success btn-small">2</a><a href="details.php?date='.$date.'" class="btn btn-success btn-small">3</a><a href="details.php?date='.$date.'" class="btn btn-success btn-small">4</a><a href="details.php?date='.$date.'" class="btn btn-success btn-small">5</a></div>';
							}
							
							$booking = '<tr>';
							$booking .= '<td><strong>'.date("l, jS F", strtotime($date)).'</strong></td>';
							$booking .= '<td>'.$rooms.'</td>';
							$booking .= '<td><a href="details.php?date='.$date.'" class="btn btn-small btn-info"><i class="icon-list icon-white"></i> Details</a></td>';			
							$booking .= '</tr>';							
													
							echo $booking;		
							
							
							
							$date = date("Y-m-d", strtotime($date.'+ 1 days'));
							$increment++;
						}
						
						
						?>
					
					</table>
					
				</div>
				<!-- Well End -->
				
			</div>
			<!-- Main Span End -->
			
			<!-- Sidebar Span -->
			<div class="span4">
				
				<!-- Well -->
				<div class="well well-small">
					
					<h3 class="thin">Search Bookings</h3>
					<hr>
					
					<div class="well well-small">
					<small>
					<strong>Top Tip!</strong> At least one field is required to be filled in.</small>
					</div>
					
					<!-- Search Form -->
					<form action="search.php" method="post" id="search_bookings">
						
						<!-- First Row -->
						<div class="row-fluid">
							
							<div class="span12">
								<input class="span10" name="booking_id" type="text" placeholder="Booking ID">
								<button type="submit" class="btn btn-info">Search</button>
							</div>
							
							
							
						</div>
												
					
						
					</form>
					<!-- Search Form End -->
					
					<!-- Ajax Search Results -->
					
					<div class="results text-center"></div>
					
				</div>
				<!-- well end -->
				
			</div>
			<!-- Sidebar Span End -->
			
		</div>
		<!--Main Row End -->
		
	</div>
	<!-- Container End -->

<script type="text/javascript">
//imageform is the ID name of FORM. While changing INPUT it calls FORM submit without refreshing page using ajaxForm() method.  
$(document).ready(function()
  {
   
    var options_type = { 
        target:        '.results',   // target element(s) to be updated with server response 
        beforeSubmit:  showRequest,  // pre-submit callback 
        //success:       showResponse  // post-submit callback 
 
        clearForm: true        // clear all form fields after successful submit 
    }; 
 
    // bind form using 'ajaxForm' 
    $('#search_bookings').ajaxForm(options_type); 	
    
      
  });

    
// pre-submit callback 
function showRequest(formData, jqForm, options_type) { 
    // formData is an array; here we use $.param to convert it to a string to display it 
    // but the form plugin does this for you automatically when it submits the data 
    var queryString = $.param(formData); 
 
    // jqForm is a jQuery object encapsulating the form element.  To access the 
    // DOM element for the form do this: 
    // var formElement = jqForm[0]; 
 
    $(".results").html('');
    $(".results").html('<img src="../img/loader.gif" alt="Uploading...." style="margin-top: 50px;"/> ');
 
    // here we could return false to prevent the form from being submitted; 
    // returning anything other than false will allow the form submit to continue 
    return true; 
} 



</script>

</body>
</html>
<?php
//If user is not logged in throw them out
} else {
	header("location: ../login.php?error=timeout");
}
?>