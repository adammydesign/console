<?php
include_once('include/config.php');

//Get Username and Password from login form
$username = mysql_escape_string($_POST['username']);
$password = mysql_escape_string($_POST['password']);
   
//Check if both username or password are filled, if not return to login.php?error=incorrect  
if($username && $password != '') { 
	
	$query = sprintf("SELECT * FROM `bodnant_c0nsole`.`admin` WHERE username='$username'");//Check database for a username match
	$result = mysql_query($query);//Get the result of the query
	$num = mysql_num_rows($result);//Get the number of rows that match
	$row = mysql_fetch_array($result);//Put all fields in an array of $row
	
	// Check to see if the number of rows that match are equal to one else return to login.php?error=user
	if ($num == 1) {
		$id = $row['admin_ID'];
		$god = $row['god'];
		if ($god == 'true') {
			$admin = 'yes';
		} else {
			$admin = 'no';
		}
		$db_password = $row['password'];//Get The user password from database
		$salt = $row['salt'];//Get the users random salt from database
		   
		$password = md5($password.$salt);//add the salt to the typed in password and md5 the result
		
		//Check to see if the types in pasword matches the database password, if not return to login.php?error=pwd 
		if ($db_password == $password ) {
		   	session_start(); //Start a session
		   	$_SESSION['LoggedIn'] = 1; //Create session variable LoggenIn == 1
		   	$_SESSION['id'] = $id; //Create session variable using the username
		   	$_SESSION['admin'] = $admin; //Create session variable using the username
		   	$_SESSION['username'] = $username; //Create session variable using the username
			header("location: index.php");//Redirect to admin area for me	    
		} else {
			   header("location: login.php?error=pwd");// Incorrect Password
		}
		   
	} else {
		header("location: login.php?error=user"); // Incorrect User 
	} 
	
}   
else {
	header("location: login.php?error=incorrect"); // Both fields not filled
}
?>