<?php
//Start Session
session_start();

//Is User logged in
$username = $_SESSION['username'];
if(($_SESSION['LoggedIn'] = 1) && ($_SESSION['username'] = $username)) {
include_once('../include/config.php');

// Get Values from hidden form
$id = $_POST['id'];
$room_ids = $_POST['room_ids'];
$nights = $_POST['nights'];
$date = $_POST['date'];
$title = $_POST['title'];
$fname = $_POST['fname'];
$lname = addslashes($_POST['lname']);
$email = $_POST['email'];
$number = $_POST['number'];
$postcode = $_POST['postcode'];
$address1 = addslashes($_POST['address1']);
$city = $_POST['city'];
$language = $_POST['language'];
$total = '500.00';// Change this

// Rob sorting out the array bit exploding the string making it an array

$room_ids = explode(',', $room_ids);


//Create Registration date
$reg_date = date('Y-m-d');

// Format Date

$date = date("Y-m-d", strtotime($date));

// Create new customer from details
$insert_customer = ("INSERT INTO `bodnant_c0nsole`.`customer` (`customer_ID`, `title`, `first_name`, `second_name`, `email`, `postcode`, `address_one`, `city`, `contact_num`, `newsletter`, `language`, `reg_date`, `notes`, `loyalty`) VALUES (NULL, '$title', '$fname', '$lname', '$email', '$postcode', '$address1', '$city', '$number', '', '$language', '$reg_date', '', '')");

// IF $insert_customer was successful create $customer_id with mysql_insert_id
if (mysql_query($insert_customer)) {
	$customer_id = mysql_insert_id();
//IF INSERT failed
} else {
	echo 'Customer Insert Failed';
}

// Create Increment for loop
$increment = 1;

// First loop Start
while($increment <= $nights) {
	
	foreach($room_ids as $room) {
		
		mysql_query("INSERT INTO `bodnant_c0nsole`.`current_booking` (`table_ID`, `booking_ID`, `customer_ID`, `room_ID`, `package_ID`, `booking_date`, `booking_paid`, `booking_price`) VALUES (NULL, '$id', '$customer_id', '$room', '0', '$date', '1', '$total')");
		
	}
	
	$date = date("Y-m-d", strtotime($date."+ 1 days"));
	$increment++;
	
	
}

header("location: index.php?booking=true");

//If user is not logged in throw them out
} else {
	header("location: ../login.php?error=timeout");
}
?>