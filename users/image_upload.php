<?php
//Start Session
session_start();

//Is User logged in
$username = $_SESSION['username'];
if(($_SESSION['LoggedIn'] = 1) && ($_SESSION['username'] = $username)) {
include_once('../include/config.php');
include_once('../include/functions.php');

//This is the directory where images will be saved 
 $target = "avatars/"; 
 $target = $target . basename( $_FILES['profile_upload']['name']);
   
 //Get Img from form & ID from get
 $id = $_GET['id'];
 $pic = str_replace(' ', '%20', ($_FILES['profile_upload']['name'])); 
  
 //If file write was successful Write to database
 if(move_uploaded_file($_FILES['profile_upload']['tmp_name'], $target)) {

 //Write the information to the database 
 mysql_query("UPDATE `admin` SET `admin_image` = '$pic' WHERE `admin_ID` = $id");
 
 //Forward back to details witht the new image 
 header("location: details.php?id=$id&image=success"); 

 //If failed then send back with error
} else { 
 //Gives and error if its not 
 header("location: details.php?id=$id&image=fail"); 
} 


//If user is not logged in throw them out
} else {
	header("location: ../login.php?error=timeout");
}
?>