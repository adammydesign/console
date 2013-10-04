<?php
//Start Session
session_start();

//Is User logged in
$username = $_SESSION['username'];
if(($_SESSION['LoggedIn'] = 1) && ($_SESSION['username'] = $username)) {
include_once('../include/config.php');

if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) ){
	
//Assign Variables
$rooms = $_POST['rooms'];
$nights = $_POST['nights'];
$date = $_POST['date'];
$title = $_POST['title'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$number = $_POST['number'];
$postcode = $_POST['postcode'];
$address1 = $_POST['address1'];
$city = $_POST['city'];
$language = $_POST['language'];
$total = '';// Get total from hidden variable in form

//Get Room ID's
if (isset($_POST['room'])) {
	if (is_array($_POST['room'])) {
		$room = implode(',', $_POST['room']);
	}
}

//Generate Full Name and title
$name = ucwords($title.' '.$fname.' '.$lname);

//Check in and out date format
$check_in = date("l, jS F, Y", strtotime($date));
$check_out = date("l, jS F, Y", strtotime($date."+ ".$nights." days"));

//Generate Booking ID
$booking_id = rand(2500, 100000).rand(100000, 500500);

echo '<div class="well well-small">';
echo '<h3 class="thin">Confirm Booking</h3><hr>';
echo '<h4><strong>Your '.$nights.' night stay.</strong></h4>';
echo '<h5><strong>Booking ID: '.$booking_id.'</strong></h5><br/>';
echo '<strong>Name:</strong> '.$name.'<br/>';
echo '<strong>Email:</strong> '.$email.'<br/>';
echo '<strong>Check in date:</strong> '.$check_in.'<br/>';
echo '<strong>Check out date:</strong> '.$check_out.'<br/>';
echo '<strong>No. of rooms:</strong> '.$rooms.'<br/><br/>';

echo 'Total: &pound'.$total;

echo '
<hr>
<a href="../bookings" class="btn pull-left btn-small"><i class="icon-remove"></i> Cancel</a>

<div class="pull-right btn-group">

	<form action="create_valid.php" method="post" class="pull-left">
	<input name="id" value="'.$booking_id.'" type="hidden"><input name="fname" value="'.$fname.'" type="hidden"><input name="lname" value="'.$lname.'" type="hidden"><input name="title" value="'.$title.'" type="hidden"><input name="date" value="'.$date.'" type="hidden"><input name="nights" value="'.$nights.'" type="hidden"><input name="id" value="'.$booking_id.'" type="hidden"><input name="room_ids" value="'.$room.'" type="hidden"><input name="email" value="'.$email.'" type="hidden"><input name="address1" value="'.$address1.'" type="hidden"><input name="city" value="'.$city.'" type="hidden"><input name="postcode" value="'.$postcode.'" type="hidden"><input name="language" value="'.$language.'" type="hidden"><input name="number" value="'.$number.'" type="hidden"><input name="total" value="'.$total.'" type="hidden">
	<button class="btn btn-info btn-small"><i class="icon-ok icon-white"></i> Mark as Paid</button>
	</form>
	
	<form action="payment.php" method="post" class="pull-right" id="payment">
		<input name="id" value="'.$booking_id.'" type="hidden"><input name="fname" value="'.$fname.'" type="hidden"><input name="lname" value="'.$lname.'" type="hidden"><input name="title" value="'.$title.'" type="hidden"><input name="date" value="'.$date.'" type="hidden"><input name="nights" value="'.$nights.'" type="hidden"><input name="id" value="'.$booking_id.'" type="hidden"><input name="room_ids" value="'.$room.'" type="hidden"><input name="email" value="'.$email.'" type="hidden"><input name="address1" value="'.$address1.'" type="hidden"><input name="city" value="'.$city.'" type="hidden"><input name="postcode" value="'.$postcode.'" type="hidden"><input name="language" value="'.$language.'" type="hidden"><input name="number" value="'.$number.'" type="hidden"><input name="total" value="'.$total.'" type="hidden">
		<button class="btn btn-success btn-small"><i class="icon-shopping-cart icon-white"></i> Take Payment</button>
	</form>
	
	
</div>

<div class="clearfix"></div>

</div>';

}
//End if form is submitted

//If user is not logged in throw them out
} else {
	header("location: ../login.php?error=timeout");
}
?>