<?php
//Start Session
session_start();

//Is User logged in
$username = $_SESSION['username'];
if(($_SESSION['LoggedIn'] = 1) && ($_SESSION['username'] = $username)) {
include_once('../include/config.php');

if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) ){

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
	$name = $_POST['type_name']; 
	$vendor = $_POST['type_vendor'];
	
	if (!empty($name) && !empty($vendor)) {
		
		mysql_query("INSERT INTO `product_type` (`product_type_name`, `product_vendor`) VALUES ('$name', '$vendor')");
		echo '<td>'.$name.'</td><td>'.$vendor.'</td><td><input type="checkbox" name="event_type[]" value="'.$name.'"></td>';
		
	} else {
		echo '<div class="alert alert-warning">
								<button type="button" class="close" data-dismiss="alert">&times</button>
								<strong>Whoops!</strong> You need to fill in both fields.
								</div>';
	}
	
 }
 
}

//If user is not logged in throw them out
} else {
	header("location: ../login.php?error=timeout");
}
?>