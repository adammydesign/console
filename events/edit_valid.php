<?php
//Start Session
session_start();

//Is User logged in
$username = $_SESSION['username'];
if(($_SESSION['LoggedIn'] = 1) && ($_SESSION['username'] = $username)) {
include_once('../include/config.php');

//Get values from edit form
$id = $_GET['id'];
$event_name = addslashes($_POST['name']);
$date = $_POST['date'];
$stime = $_POST['stime'];
$etime = $_POST['etime'];
$price = $_POST['price'];
$desc = addslashes($_POST['desc']);
$capacity = $_POST['capacity'];

//Get Event Type
if (isset($_POST['event_type'])) {
	if (is_array($_POST['event_type'])) {
		foreach($_POST['event_type'] as $type){
			$type = $type;
		}
	}
}

$find_type = mysql_query("SELECT * FROM `event_type` WHERE `type_name`='$type'");
$type = mysql_fetch_array($find_type);
$type_id = $type['type_ID'];

//Change Date for insert
$date = date("Y-m-d", strtotime($date));

//Update Event Query
$update_event = ("UPDATE `events` SET `event_name`='$event_name', `type_ID`='$type_id', `event_date`='$date', `event_start_time`='$etime', `event_end_time`='$etime',  `event_price`='$price', `event_capacity`='$capacity', `event_desc`='$desc' WHERE `event_ID`=$id");

if (mysql_query($update_event)) {
	header("location: index.php?edit=success&name=$event_name");
} else {
	header("location: index.php?edit=fail&name=$event_name");
}


//If user is not logged in throw them out
} else {
	header("location: ../login.php?error=timeout");
}
?>