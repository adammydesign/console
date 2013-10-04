<?php
//Start Session
session_start();

//Is User logged in
$username = $_SESSION['username'];
if(($_SESSION['LoggedIn'] = 1) && ($_SESSION['username'] = $username)) {
include_once('../include/config.php');

//Get values from Form
$name = addslashes($_POST['name']);
$date = $_POST['date'];
$stime = $_POST['stime'];
$etime = $_POST['etime'];
$price = $_POST['price'];
$desc = addslashes($_POST['desc']);
$capacity = $_POST['capacity'];
$image_id = $_POST['image_insert'];

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


//Change date to MYSQL format
$date_insert = date('Y-m-d', strtotime($date));


//I required fields are empty throw a wobble
if (!empty($name) OR !empty($date) OR !empty($stime) OR !empty($price) OR !empty($desc)) {
	
	//If no image has been chosen then insert new event
	if ($image_id == '') {
		
		$event_insert = ("INSERT INTO `bodnant_c0nsole`.`events` (`event_name`, `type_ID`, `event_date`, `event_desc`, `event_price`, `event_capacity`, `event_start_time`, `event_end_time`) VALUES ('$name', '$type_id', '$date_insert', '$desc', '$price', '$capacity', '$stime', '$etime')");
	
	//If image has been chosen then update current insert with matching image_id	
	} else {
		
		$event_insert = ("UPDATE `events` SET `event_name`='$name', `type_ID`='$type_id', `event_date`='$date_insert', `event_desc`='$desc', `event_price`='$price', `event_capacity`='$capacity', `event_start_time`='$stime', `event_end_time`='$etime' WHERE `image_ID`='$image_id'");
		
	}
	
	//Do either Insert or update depending on above
	if (mysql_query($event_insert)) {
		
		header("location: index.php?create=success&name=$name");
	
	//If Insert fails then throw a wobble
	} else {
		
		header("location: index.php?create=fail");
		
	}
	
	
} else {
	header("location: create.php?error=fields");	
}

//If user is not logged in throw them out
} else {
	header("location: ../login.php?error=timeout");
}
?>