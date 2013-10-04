<?php
//Start Session
session_start();
//Is User logged in
$username = $_SESSION['username'];
if(($_SESSION['LoggedIn'] = 1) && ($_SESSION['username'] = $username)) {
include_once('../include/config.php');

//Get all variables from the create user form
$fname = mysql_real_escape_string($_POST['fname']);
$lname = mysql_real_escape_string($_POST['lname']);
$user = mysql_real_escape_string($_POST['username']);
$position = mysql_real_escape_string($_POST['position']);
$email = mysql_real_escape_string($_POST['email']);
$email_confirm = mysql_real_escape_string($_POST['email_confirm']);
$password = mysql_real_escape_string($_POST['password']);
$password_confirm = mysql_real_escape_string($_POST['password_confirm']);
$number = mysql_real_escape_string($_POST['number']);
$notification = ($_POST['notification']);
$god = ($_POST['god']);
$events = ($_POST['events']);
$shop = ($_POST['shop']);
$rooms = ($_POST['rooms']);
$school = ($_POST['school']);

//Check if god is set
if (isset($notification)) {
	$notification = 'true';
} else {
	$notification = 'false';
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

//check if required fields are filled in
if (!empty($fname) && !empty($lname) && !empty($user) && !empty($email) && !empty($email_confirm) && !empty($password) && !empty($password_confirm)) {

//Check if username is taken
$check_user = mysql_query("SELECT `username` FROM `admin` WHERE `username`= '$user'");
if (mysql_num_rows($check_user) != 1) {

//check if emails match
if ($email == $email_confirm) {

	//Check if passwords match
	if ($password == $password_confirm) {
	
		//Check if a role is checked
		if (isset($god) OR isset($events) OR isset($shop) OR isset($rooms) OR isset($school)) {
		
			
		
		//Create Salt for the password
		$rand1 = rand(0,10000000);
		$rand2 = rand(4000000,100000000);
		
		//Create password salt
		$salt = $rand1.$rand2;
		
		//Get todays date for insert
		$date = date('d/m/Y');
		
		//Create Password
		$password = md5($password.$salt);
		
		//Insert New User into admin table in bodnant_c0nsole database
		$user_insert = ("INSERT INTO `bodnant_c0nsole`.`admin` (`admin_fname`, `admin_lname`, `username`, `admin_position`, `email`, `password`, `salt`, `mobile`, `enabled`, `god`, `events`, `shop`, `rooms`, `school`, `user_created`) VALUES ('$fname', '$lname', '$user', '$position', '$email', '$password', '$salt', '$number', '$notification', '$god', '$events', '$shop', '$rooms', '$school', '$date')");
		
		//If insert is successful forward to users home with success message
		if (mysql_query($user_insert)) {
			header("location: index.php?create=success&user=$user");
		//If it fails then display error message	
		} else {
			header("location: index.php?create=fail");
		}
		
		//If no role has been selected	
		} else {
			header("location: create.php?error=role&fname=$fname&lname=$lname&user=$user&email=$email");
		}
	
	//If passwords don't match	
	} else {
		header("location: create.php?error=password&fname=$fname&lname=$lname&user=$user&email=$email");
	}
	
//if Emails don't match 
} else {
	header("location: create.php?error=email&fname=$fname&lname=$lname&user=$user");
}

//If username is taken
} else {
	header("location: create.php?error=user&fname=$fname&lname=$lname&email=$email");
}

//If required fields aren't filled in
} else {
	header("location: create.php?error=fields");
}

//If user is not logged in throw them out
} else {
	header("location: ../login.php?error=timeout");
}
?>