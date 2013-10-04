<?php
//Start Session
session_start();

//Is User logged in
$username = $_SESSION['username'];
if(($_SESSION['LoggedIn'] = 1) && ($_SESSION['username'] = $username)) {
include_once('../include/config.php');
include_once('../include/functions.php');

//This is the directory where images will be saved 
 $target = "event_images/"; 
 $target = $target . basename( $_FILES['image_upload']['name']);
   
 //Get Img from form & ID from get
 $id = $_GET['id'];
 $name = $_GET['name'];
 $pic = str_replace(' ', '%20', ($_FILES['image_upload']['name'])); 
  
 //If file write was successful Write to database
 if(move_uploaded_file($_FILES['image_upload']['tmp_name'], $target)) {

 //Write the information to the database 
 mysql_query("UPDATE `events` SET `event_image` = '$pic' WHERE `event_ID` = $id");
 
 //Forward back to details witht the new image 
 header("location: index.php?name=$name&image=success"); 

 //If failed then send back with error
} else { 
 //Gives and error if its not 
 header("location: index.php?name=$name&image=fail"); 
} 


//If user is not logged in throw them out
} else {
	header("location: ../login.php?error=timeout");
}
?>