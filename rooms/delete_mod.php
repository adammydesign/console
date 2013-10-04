<?php
//Start Session
session_start();

//Is User logged in
$username = $_SESSION['username'];
if(($_SESSION['LoggedIn'] = 1) && ($_SESSION['username'] = $username)) {
include_once('../include/config.php');

if ($_GET['remove'] == 1) {
	
	$id = $_GET['id'];
	$delete_mod = ("DELETE FROM `booking_modifier` WHERE `modifier_ID` = '$id'");
	
	if (mysql_query($delete_mod)) {
		header("location: index.php?delete_mod=success");
	} else {
		header("location: index.php?delete_mod=fail");
	}
	
}

//If user is not logged in throw them out
} else {
	header("location: ../login.php?error=timeout");
}
?>