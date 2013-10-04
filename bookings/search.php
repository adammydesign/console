<?php
//Start Session
session_start();

//Is User logged in
$username = $_SESSION['username'];
if(($_SESSION['LoggedIn'] = 1) && ($_SESSION['username'] = $username)) {
include_once('../include/config.php');

if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) ){

$booking_id = $_POST['booking_id'];


//Check if at least one field is filled
if (empty($booking_id)) {
	echo '<div class="alert alert-warning text-left">
								<button type="button" class="close" data-dismiss="alert">&times</button>
								<strong>Remember!</strong><small> At least one field should be filled in.</small>
								</div>';
} else {	
	
	$search_query = mysql_query("SELECT * FROM `current_booking` WHERE `booking_ID` = '$booking_id' GROUP BY `booking_date`");
	$rows = mysql_num_rows($search_query);
	
	// If no results throw wobble
	if ($rows == 0) {
		echo '<div class="alert alert-warning text-left">
								<button type="button" class="close" data-dismiss="alert">&times</button>
								<strong>Sorry!</strong><small> No bookings found.</small>
								</div>';
	//If bookings found
	} else {
		
		echo '<table class="table table-striped">';
			while($row = mysql_fetch_array($search_query)) {
				echo '<tr><td>'.$row['booking_date'].'</td><td><a href="details.php?id='.$booking_id.'" class="btn btn-info btn-small"><i class="icon-list icon-white"></i> Details</a></td></tr>';	
			}
			
		echo '</table>';
	}
}
//En else if at least one field is filled

}
//End if form is submitted

//If user is not logged in throw them out
} else {
	header("location: ../login.php?error=timeout");
}
?>