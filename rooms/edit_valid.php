<?php
//Start Session
session_start();

//Is User logged in
$username = $_SESSION['username'];
if(($_SESSION['LoggedIn'] = 1) && ($_SESSION['username'] = $username)) {
include_once('../include/config.php');

$id = $_POST['id'];
$name = addslashes($_POST['name']);
$price = $_POST['price'];
$capacity = $_POST['capacity'];
$type = $_POST['type'];
$text = addslashes($_POST['text']);

$room_update = ("UPDATE `room_info` SET `room_name`='$name', `room_price`='$price', `room_text`='$text', `room_capacity`='$capacity', `room_type`='$type' WHERE `room_ID` = '$id'");

if (mysql_query($room_update)) {
	header("location: index.php?update=success&name=$name");
} else {
	header("location: index.php?update=fail&name=$name");
}

//If user is not logged in throw them out
} else {
	header("location: ../login.php?error=timeout");
}
?>