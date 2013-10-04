<?php
//Start Session
session_start();

//Is User Logged in
$username = $_SESSION['username'];
$user_id = $_SESSION['id'];
if(($_SESSION['LoggedIn'] = 1) && ($_SESSION['username'] = $username)) {

//Config Include
include_once('../include/config.php');

//Get Room ID
$id = $_GET['id'];

$edit_query = mysql_query("SELECT * FROM `room_info` WHERE `room_ID`= $id");
$row = mysql_fetch_array($edit_query);

?>

<!DOCTYPE html>
<html>

<head>
    
    <title>Bodnant Welshfood | Edit Order</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Stylesheets -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../css/bootstrap-responsive.css" rel="stylesheet" media="screen">
    <link href="../css/main.css" rel="stylesheet" media="screen">
     
    <!--Scripts -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
    <script src="http://malsup.github.com/jquery.form.js"></script> 
    <script src="../js/bootstrap.min.js"></script>
    
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
					<li><a href="../bookings" title="Bookings">Bookings</a></li>
					<li class="active"><a href="../rooms" title="Rooms">Rooms</a></li>
					<li ><a href="" title="Orders">Orders</a></li>
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
			
			<!-- Main Span -->
			<div class="span8">
			
			<!-- Room Image Modal -->
		<div id="imagemodal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
		        <h3 id="myModalLabel">Edit Room Image</h3>
		    </div>
		    <div class="modal-body">
		        <form action="imageupload.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data" id="imageform">
		        <input type="file" name="room_image" id="room_image"/>
		        </form>
		        
		    </div>
		    <div class="modal-footer">
		        <button class="btn btn-success" data-dismiss="modal" id="image_submit"> <i class="icon-ok icon-white"></i> Save Room Image</button>
		        
		    </div>
		</div>
		<!-- Room Image Modal End -->
				
				<!-- Well -->
				<div class="well well-small">
				
					<h3 class="thin pull-left">Edit Room</h3>
					<!--Room Form -->
					<form id="room_edit" action="edit_valid.php" method="post">
					<button type="submit" class="btn btn-success pull-right"><i class="icon-ok icon-white"></i> Save Changes</button>
					<div class="clearfix"></div>
					<hr>
					
					<div class="row-fluid">
					
						<div class="span4" id="room_image_box">
							<img src="../bookings/room_images/<?php echo $row['room_image']; ?>" />
							<a href="#imagemodal" data-toggle="modal" role="button" class="btn btn-info" id="event_btn"><i class="icon-edit icon-white"></i> Edit Image</a>
						</div>
						
						<div class="span8">
							
							<label for="name">Room Name:</label>
							<input type="text" value="<?php echo $row['room_name']; ?>" class="span8" name="name" required>
							
							<!-- Row -->
							<div class="row-fluid">
								
								<div class="span6">
									<label for="room_type">Room Type:</label>
									<input type="text" value="<?php echo $row['room_type']; ?>" class="span12" name="type" required>
								</div>
								
								<div class="span3">
									<label for="room_type">Room Capacity:</label>
									<input type="number" value="<?php echo $row['room_capacity']; ?>" class="span12" name="capacity" required>
								</div>
								
								<div class="span3">
									<label for="room_type">Room Price:</label>
									<div class="input-prepend">
										<div class="row-fluid">
										<span class="add-on span3">&pound</span>
										<input type="text" name="price" id="prependedInput" value="<?php echo $row['room_price']; ?>" class="span9" required>
										</div>
									</div>
								</div>
								
								
							</div>
							<!-- Row End -->
							
							<label for="text">Room Description:</label>
							<textarea name="text" class="span12" rows="5"><?php echo $row['room_text']; ?></textarea>
							
							<input type="hidden" value="<?php echo $id; ?>" name="id" >
							
						</div>
						
						
					</div>
					
					<hr>
					<button type="submit" class="btn btn-success pull-right"><i class="icon-ok icon-white"></i> Save Changes</button>
					<div class="clearfix"></div>
					
					
					
					</form>
					<!-- Room Form end -->
					
					
				</div>
				<!-- well end -->
				
			</div>
			<!-- Main Span End -->
		
		</div>
		<!--Main Row End -->
	
	</div>
	<!-- Container End -->

<script type="text/javascript">
$("#room_image").live('change',function(){}) 

// photoimg is the ID name of INPUT FILE tag and 

$('#imageform').ajaxForm()

//imageform is the ID name of FORM. While changing INPUT it calls FORM submit without refreshing page using ajaxForm() method.  
$(document).ready(function()
  {
    $('#room_image').live('change', function()
    {
      $("#room_image_box").html('');
      $("#room_image_box").html('<img src="../img/loader.gif" alt="Uploading...." style="margin-top: 50px;"/> ');
      $("#imageform").ajaxForm(
      {
        target: '#room_image_box'
      }).submit();
    });
    
      
  });




</script>

	
</body>
</html>

<?php
//If User is not logged in throw them out
} else {
	header("location: ../login.php?error=timeout");
}
?>