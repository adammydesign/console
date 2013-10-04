<?php
//Start Session
session_start();

//Is User Logged in
$user_id = $_SESSION['id'];
$username = $_SESSION['username'];
if(($_SESSION['LoggedIn'] = 1) && ($_SESSION['username'] = $username)) {

//Config Include
include_once('../include/config.php');
//Calendar Class Include
include_once('../include/tc_calendar.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
    
    <title>Bodnant Welshfood | Create Booking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Stylesheets -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../css/bootstrap-responsive.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <link href="../css/main.css" rel="stylesheet" media="screen">
     
    <!--Scripts -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script> 
    <script src="../js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="../js/calendar.js"></script>

    
</head>
  
<body>

<!-- Header Start -->
	<div class="header">
	
		<!-- Header Container -->
		<div class="container">
			
			<!-- Header Row -->
			<div class="row-fluid clearfix">
				
				<!-- Header Logo -->
				<img src="../img/logo.gif" title="Bodnant welshfood Admin" class="span2"/>
				
				<!-- Header Logout and settings -->
				<div class="pull-right text-right">
					
					<!-- Account Settings -->
					<a href="../users/details.php?id=<?php echo $user_id; ?>" class="btn">Account <i class="icon-cog"></i></a>
					
					<!-- Logout Button -->
					<a href="../logout.php" title="logout" class="btn btn-danger">Logout <i class="icon-off icon-white"></i></a>
					
					
				</div>
				
			</div>
			<!-- header Row End -->
		
		</div>
		<!-- header Container End -->
		
	</div>
	<!-- Header End -->
	
	<!-- Body Container -->
	<div class="container">
	
		<!-- Main Desktop Navigation -->
		<div class="hidden-mobile navbar">
			
			<!--Navbar Inner -->
			<div class="navbar-inner clearfix">
				
				<ul class="nav">
					
					<li><a href="../" title="Dashboard">Dashboard</a></li>
					<li class="active"><a href="../bookings" title="Bookings">Bookings</a></li>
					<li ><a href="../rooms" title="Rooms">Rooms</a></li>
					<li><a href="../orders" title="Orders">Orders</a></li>
					<li><a href="../events" title="Events">Events</a></li>
					<li ><a href="../products" title="Products">Products</a></li>
					<?php if($_SESSION['admin'] =='yes') { echo'<li><a href="../users" title="Users">Users</a></li>'; } ?>
					
				</ul>
				
				<!-- Welcome Message -->
				<p class="welcome pull-right">Welcome back <strong><?php echo ucwords($username); ?></strong></p>
				
			</div>
			<!-- Nav inner end -->
			
		</div>
		<!-- Main desktop Nav End -->
		
		<!-- Main Row -->
		<div class="row-fluid">
		
			<!-- Mai Span -->
			<div class="span8">
				
				<!-- Well -->
				<div class="well well-small">
				
				<h3 class="thin">Create A Booking</h3>
				
				<hr>
				
				<!-- well Start -->
				<div class="well well-small">
					
					<!-- check Date Ajax -->
					<form action="booking.php" id="check_date" method="post">
					
					<h4 class="thin pull-left">When and what do you wish to book?</h4>
					<button type="submit" class="btn btn-info pull-right basic_details">Next <i class="icon-chevron-right icon-white"></i></button>
					<div class="clearfix"></div>
					<hr>
					<!--- First Row Form -->
					<div class="row-fluid">
					
						<!-- Select Date -->
						<div class="span3">
						<label>Select Check In Date:</label>
						<?php
							 $myCalendar = new tc_calendar("bookingDate");
							  $myCalendar->setIcon("../img/iconCalendar.gif");
							  $myCalendar->setPath("../include/");
							  $myCalendar->setYearInterval(date("Y"), date("Y")+1);
							  $myCalendar->dateAllow(date("Y-m-d"), '');
							  $myCalendar->startMonday(true);
							  $myCalendar->writeScript();
							
						?>
						</div>
						
						<!-- Select No. of nights -->
						<div class="span2 offset2">
							<label>No. of Nights:</label>
							<input type="number" name="nights" placeholder="00" class="span12" required>
							
							<label>No. of Rooms:</label>
							<input type="number" name="rooms" placeholder="00" class="span12" required>
						</div>
						
						<!-- Information Box -->
						<div class="span5">
							
							<div class="well well-small">
							<strong>Top Tip!</strong>
							<hr>
							<p>All fields are required to continue with the booking.</p>
							<hr>
							<p>To continue with the booking simply click the next button.</p>
							</div>
							
						</div>
						
					</div>
					<!-- First Row End -->
					
					<hr>
					<button type="submit" class="btn btn-info pull-right basic_details">Next <i class="icon-chevron-right icon-white"></i></button>
					<div class="clearfix"></div>
					</form>
					<!-- Date check form end -->
					
				</div>
				<!-- well end -->
				
				
				<!-- Continue Booking Form -->
				<form action="confirm.php" method="post" id="continue_booking">
					
					<!-- Information Div -->
					<div class="text-center checking"></div>
					
				</form>
				
				<div id="bottom_anchor"></div>
				</div>
				<!-- Well End -->
				
				
			</div>
			<!-- Main span End -->
			
			<!-- Sidebar/confirm span -->
			<div class="span4" id="confirm">
				
				<!-- Information Div -->
				<div class="text-center checking_confirm"></div>
				
			</div>
			
		</div>
		<!-- Main Row End -->
	
	</div>
	<!-- Main Container End -->
<script type="text/javascript">

$(document).ready(function()
  {
   
    var options_type = { 
        target:        '#continue_booking',   // target element(s) to be updated with server response 
        beforeSubmit:  showRequest,  // pre-submit callback 
        //success:       showResponse  // post-submit callback 
 
        //clearForm: true        // clear all form fields after successful submit 
    };
    
    var options_confirm = { 
        target:        '#confirm',   // target element(s) to be updated with server response 
        beforeSubmit:  showConfirm,  // pre-submit callback 
        //success:       showResponse  // post-submit callback 
 
        //clearForm: true        // clear all form fields after successful submit 
    };
 
    // bind form using 'ajaxForm' 
    $('#check_date').ajaxForm(options_type); 
    $('#continue_booking').ajaxForm(options_confirm); 	
    
    $("button.basic_details").click(function() {
    $('html, body').animate({
        scrollTop: $("#continue_booking").offset().top
    }, 1000);
    });
        
    
  });

    
// pre-submit callback 
function showRequest(formData, jqForm, options_type) { 
    // formData is an array; here we use $.param to convert it to a string to display it 
    // but the form plugin does this for you automatically when it submits the data 
    var queryString = $.param(formData); 
 
    // jqForm is a jQuery object encapsulating the form element.  To access the 
    // DOM element for the form do this: 
    // var formElement = jqForm[0]; 
 
    $(".checking").html('');
    $(".checking").html('<img src="../img/loader.gif" alt="Uploading...." style="margin-top: 50px;"/> ');
    // here we could return false to prevent the form from being submitted; 
    // returning anything other than false will allow the form submit to continue 
    return true;
}

// pre-submit callback 
function showConfirm(formData, jqForm, options_confirm) { 

    var queryString = $.param(formData); 

    $(".checking_confirm").html('');
    $(".checking_confirm").html('<img src="../img/loader.gif" alt="Uploading...." style="margin-top: 50px;"/> ');

    return true;
}

</script>

</body>
</html>

<?php
//If User is not logged in throw them out
} else {
	header("location: ../login.php?error=timeout");
}
?>