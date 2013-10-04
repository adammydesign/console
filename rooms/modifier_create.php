<?php
//Start Session
session_start();

//Is User logged in
$username = $_SESSION['username'];
if(($_SESSION['LoggedIn'] = 1) && ($_SESSION['username'] = $username)) {
include_once('../include/config.php');
include_once('../include/functions.php');

	$room = $_POST['room_mod']; 
	$date = $_POST['date_mod'];
	$price = $_POST['price_mod'];
	$enabled = $_POST['mod_enabled']; 
	$desc = addslashes($_POST['mod_desc']); 

if (!empty($room) && !empty($date)) {
	header("location: index.php?create=fail");
}
	if (empty($date)) {
		$date = '';
	} else {
		$date = date("Y-m-d", strtotime($date));
	}
	
	if (isset($enabled)) {
		$enabled = 'true';
	} else {
		$enabled = 'false';	
	}
	
	if ($enabled == 'true') {
		$checked = 'checked';
	}
		
	$create = ("INSERT INTO `booking_modifier` (`room_ID`, `modifier_date`, `modifier_price`, `modifier_desc`, `modifier_enabled`) VALUES ('$room', '$date', '$price', '$desc', '$enabled')");
	
	if (mysql_query($create)) {
		header("location: index.php?create=success");
	} else {
		header("location: index.php?create=fail");
	}
		
//If user is not logged in throw them out
} else {
	header("location: ../login.php?error=timeout");
}
?>