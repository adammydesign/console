<?php
//Start Session
session_start();

//Is User logged in
$username = $_SESSION['username'];
if(($_SESSION['LoggedIn'] = 1) && ($_SESSION['username'] = $username)) {
include_once('../include/config.php');

//Get ID from from post
$id = $_GET['id'];

//Get Form inputs
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$user = $_POST['user'];
$email = $_POST['email'];
$position = $_POST['position'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];
$mobile = $_POST['mobile'];
$notificaton = $_POST['notification'];
$god = ($_POST['god']);
$events = ($_POST['events']);
$shop = ($_POST['shop']);
$rooms = ($_POST['rooms']);
$school = ($_POST['school']);

//Check if notification is set
if (isset($notificaton)) {
	$notificaton = 'true';
} else {
	$notificaton = 'false';
}

//Check if god is set
if (isset($god)) {
	$god = 'true';
} else {
	$god = 'false';
}

//check if events is set
if (isset($events)) {
	$events = 'true';
} else {
	$events = 'false';
}

//Check if shop is set
if (isset($shop)) {
	$shop = 'true';
} else {
	$shop = 'false';
}

//Check if rooms is set
if (isset($rooms)) {
	$rooms = 'true';
} else {
	$rooms = 'false';
}

//Check if Schools is set
if (isset($school)) {
	$school = 'true';
} else {
	$school = 'false';
}

//Check if pasword is changed
if (!empty($password)) {
	
	//check if password matches with password confirm
	if ($password == $password_confirm) {
		
		//Create Salt for the password
		$rand1 = rand(0,10000000);
		$rand2 = rand(4000000,100000000);
		
		//Create password salt
		$salt = $rand1.$rand2;
		
		//Create Password
		$password = md5($password.$salt);
		
		//update database with new password and salt
		if (mysql_query("UPDATE `admin` SET `password` = '$password', `salt` ='$salt' WHERE `admin_ID` = $id ")) {
			$password_update = "&password=success";
		} else {
			$password_update = "&password=fail";
		}
	}
	
}

//update user query
$update_user = ("UPDATE `admin` SET `admin_fname`='$fname', `admin_lname`='$lname', `username`='$user', `admin_position`='$position', `email`='$email', `mobile`= '$mobile', `enabled`= '$notificaton', `god`='$god', `school`='$school', `events`='$events', `shop`='$shop', `rooms`='$rooms'  WHERE `admin_ID` = $id");

//if update user was successful then send confirm
if (mysql_query($update_user)) {
	header("location: details.php?id=$id&update=success$password_update");	
//if update has failed throw error
} else {
	header("location: details.php?id=$id&update=fail$password_update");	
}

//If user is not logged in throw them out
} else {
	header("location: ../login.php?error=timeout");
}
?>