<?php
//Start Session
session_start();

//Is User logged in
$username = $_SESSION['username'];
if(($_SESSION['LoggedIn'] = 1) && ($_SESSION['username'] = $username)) {
include_once('../include/config.php');

$name = $_GET['name'];
$delete_id = $_GET['id'];

if (isset($_GET['remove']) == 1) {
	
	$delete = ("DELETE FROM `bodnant_c0nsole`.`admin` WHERE `admin`.`admin_ID` = '$delete_id'");
	
	if (mysql_query($delete)) {
		header('location: index.php?delete=success&id='.$delete_id.'&name='.$name.'');
	} else {
		header('location: index.php?delete=fail');
	}
	
}


//If user is not logged in throw them out
} else {
	header("location: ../login.php?error=timeout");
}
?>