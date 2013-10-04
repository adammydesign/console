<?php
//Start Session
session_start();

//Is User logged in
$username = $_SESSION['username'];
if(($_SESSION['LoggedIn'] = 1) && ($_SESSION['username'] = $username)) {
include_once('../include/config.php');

//Get values from Form
$name = addslashes($_POST['name']);
$price = $_POST['price'];
$desc = addslashes($_POST['desc']);
$stock = $_POST['stock'];
$image = $_POST['image'];

//Get Event Type
if (isset($_POST['event_type'])) {
	if (is_array($_POST['event_type'])) {
		foreach($_POST['event_type'] as $type){
			$type = $type;
		}
	}
}

$find_type = mysql_query("SELECT * FROM `product_type` WHERE `product_type_name`='$type'");
$type = mysql_fetch_array($find_type);
$type_id = $type['product_type_ID'];
	
		
		$product_insert = ("INSERT INTO `bodnant_c0nsole`.`products` (`product_name`, `product_price`, `product_desc`, `product_image`, `product_type_ID`, `product_stock`) VALUES ('$name', '$price', '$desc', '$image', '$type_id', '$stock')");
	
	//Do either Insert or update depending on above
	if (mysql_query($product_insert)) {
		
		header("location: index.php?create=success&name=$name");
	
	//If Insert fails then throw a wobble
	} else {
		
		header("location: index.php?create=fail");
		
	}


//If user is not logged in throw them out
} else {
	header("location: ../login.php?error=timeout");
}
?>