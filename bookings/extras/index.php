<?php
//Start Session
session_start();

//Is user logged in
$username = $_SESSION['username'];
if(($_SESSION['LoggedIn'] = 1) && ($_SESSION['username'] = $username)) {

include_once('.../include/config.php');
?>

<!DOCTYPE html>
<html>

<head>
    
    <title>Bodnant Welshfood | Booking Extras</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Stylesheets -->
    <link href=".../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href=".../css/bootstrap-responsive.css" rel="stylesheet" media="screen">
    <link href=".../css/main.css" rel="stylesheet" media="screen">
     
    <!--Scripts -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src=".../js/bootstrap.min.js"></script>
    
</head>
  
<body>

</body>
</html>
<?php
//If user is not logged in throw them out
} else {
	header("location: .../login.php?error=timeout");
}
?>