<?php
//Start Session
session_start();

//Is User logged in
$username = $_SESSION['username'];
if(($_SESSION['LoggedIn'] = 1) && ($_SESSION['username'] = $username)) {
include_once('.../include/config.php');


//If user is not logged in throw them out
} else {
	header("location: .../login.php?error=timeout");
}
?>