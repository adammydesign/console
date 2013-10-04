<?php
//Start Session
session_start();

//Is User logged in
$username = $_SESSION['username'];
if(($_SESSION['LoggedIn'] = 1) && ($_SESSION['username'] = $username)) {
include_once('../include/config.php');
include_once('../include/functions.php');

if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) ){

 
//During creating a new event
$path = "product_images/";

$valid_formats = array("jpg", "png", "gif", "bmp","jpeg");

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
  $name = $_FILES['product_image']['name'];
  $size = $_FILES['product_image']['size'];
  if(strlen($name)) {
    list($txt, $ext) = explode(".", $name);
    if(in_array($ext,$valid_formats)) {
      if($size<(1024*1024)) // Image size max 1 MB
      {
        $actual_image_name = time().'.'.$ext;
        $tmp = $_FILES['product_image']['tmp_name'];

        if(move_uploaded_file($tmp, $path.$actual_image_name)) {
        	
        	echo "<img src='product_images/".$actual_image_name."' class='preview'>";
        	echo '<input type="hidden"" value="'.$actual_image_name.'" name="image">';
        	echo '<a href="#imagemodal" data-toggle="modal" role="button" class="btn btn-info" id="event_btn"><i class="icon-edit icon-white"></i> Edit Image</a>';	
        	   
        }
        else 
          echo "failed";
      }
      else
        echo "Image file size max 1 MB";
    }
    else
      echo "Invalid file format..";
  }
  else
    echo "Please select image..!";
  exit;
}

}

//If user is not logged in throw them out
} else {
	header("location: ../login.php?error=timeout");
}
?>