<?php
//Start Session
session_start();

//Is User Logged in
$username = $_SESSION['username'];
$user_id = $_SESSION['id'];
if(($_SESSION['LoggedIn'] = 1) && ($_SESSION['username'] = $username)) {

//Config Include
include_once('../include/config.php');

//Grab Event ID
$event_id = $_GET['id'];

//Query for all event Details
$event_query = mysql_query("SELECT * FROM `events` WHERE `event_ID`='$event_id'");
$data = mysql_fetch_array($event_query);

$type_query = mysql_query("SELECT * FROM `event_type`");
$row = mysql_num_rows($type_query);

//Assign to variables
$name = $data['event_name'];
$type_id = $data['type_ID'];
$date = $data['event_date'];
$stime = $data['event_start_time'];
$etime = $data['event_end_time'];
$price = $data['event_price'];
$image = $data['event_image'];
$desc = $data['event_desc'];
$capacity = $data['event_capacity'];

$insert = $image;

//Change Date Format
$date = date("l, jS F Y", strtotime($date));

//Assign holding image to blank image value
if (empty($image)) {
	$image = '../img/event_hold.jpg';
} else {
	$image = 'event_images/'.$image.'';
}

?>


<!DOCTYPE html>
<html>

<head>
    
    <title>Bodnant Welshfood | Edit Event</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Stylesheets -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../css/bootstrap-responsive.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="../css/jquery.timepicker.css" />
    <link href="../css/main.css" rel="stylesheet" media="screen">
     
    <!--Scripts -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
    <script src="http://malsup.github.com/jquery.form.js"></script> 
    <script src="../js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="../js/timepicker.js"></script>
    <script>
    $(function() {
    $( "#datepicker" ).datepicker({
	    dateFormat: 'DD, d MM yy',
    });
    });	
    
    $(function() {
    $('#stime, #etime').timepicker();
    });	
    </script>
    
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
					<li ><a href="../rooms" title="Rooms">Rooms</a></li>
					<li><a href="../orders" title="Orders">Orders</a></li>
					<li class="active"><a href="../events" title="Events">Events</a></li>
					<li ><a href="../products" title="Products">Products</a></li>
					<?php if($_SESSION['admin'] =='yes') { echo'<li><a href="../users" title="Users">Users</a></li>'; } ?>
					
				</ul>
				
				<!-- Welcome Message -->
				<p class="welcome pull-right">Welcome back <strong><?php echo ucwords($username); ?></strong></p>
				
			</div>
			<!-- Nav inner end -->
			
		</div>
		<!-- Main desktop Nav End -->
		
		<!-- event Modal -->
		<div id="imagemodal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
		        <h3 id="myModalLabel">Add Event Image</h3>
		    </div>
		    <div class="modal-body">
		        <form action="ajaxupload.php?id=<?php echo $event_id; ?>" method="post" enctype="multipart/form-data" id="imageform">
		        <input type="file" name="event_image" id="event_image"/>
		        </form>
		        
		    </div>
		    <div class="modal-footer">
		        <button class="btn btn-success" data-dismiss="modal" id="image_submit"> <i class="icon-ok icon-white"></i> Save Event Image</button>
		        
		    </div>
		</div>
		<!-- Event Image End -->
							
		<!-- Main Row -->
		<div class="row-fluid">
			
			<!-- Main span --->
			<div class="span8">
				
				<!-- Well -->
				<div class="well well-small">
				
					<h3 class="thin pull-left">Edit Event</h3>
					
					<!-- Event create Form -->
					<form action="edit_valid.php?id=<?php echo $event_id; ?>" method="post">
					<button type="submit" class="btn btn-success pull-right"><i class="icon-ok icon-white"></i> Save Event</button>
					<div class="clearfix"></div>
					<hr>
					<!-- event Create Header End -->
					
					
					<!-- Basic Event Details -->
					<div class="well well-small">
						
						<h4 class="thin">Basic Event Details</h4>
						
						<div class="row-fluid">
								
								<?php
								//error field alert
								if ($_GET['error'] == 'fields') {
									echo '<div class="alert alert-warning">
								<button type="button" class="close" data-dismiss="alert">&times</button>
								<strong>All required fields must be filled</strong><br/><small>Event name | Date | Start Time | Price | Capacity.</small>
								</div>';
								}
								?>
						</div>
							
						<!-- Basic Information Row -->
						<div class="row-fluid">
							
							<!-- event Image -->
							<div class="span4" id="image">
							
								<div id="preview">
								<!-- Upload Image Modal button -->
								<a href="#imagemodal" data-toggle="modal" role="button" class="btn btn-info" id="event_btn"><i class="icon-plus icon-white"></i> Edit Image</a>
								<img src="<?php echo $image; ?>" title="<?php echo $name; ?>" />
								</div>
																

							</div>
							
							<!-- event Information -->
							<div class="span8">
								
								<div class="row-fluid">
								
									<!-- Event Name --->
									<div class="span10">
										<label for="name">Event Name:</label>
										<strong><input type="text" name="name" placeholder="Event Name" class="span12" value="<?php echo $name; ?>"required></strong>
									</div>
								
								</div>
								
								<div class="row-fluid">
								
									<!-- Event Date -->
									<div class="span6">
										<label for="date">Event Date:</label>
										<input type="text" name="date" placeholder="Event Date" class="span12" id="datepicker" value="<?php echo $date; ?>" required>
									</div>
									
									<!-- Start Time -->
									<div class="span3">
										<label for="stime">Start Time:</label>
										<input type="text" name="stime" placeholder="Start Time" class="span12" id="stime" value="<?php echo $stime; ?>" required>
									</div>
									
									<!-- End Time -->
									<div class="span3">
										<label for="etime">End Time:</label>
										<input type="text" name="etime" placeholder="End Time" class="span12" id="etime" value="<?php echo $etime; ?>">
									</div>
							
								</div>
								
								<div class="row-fluid">
									
									<!-- Event Price -->
									<div class="input-prepend input-append span6">
										<label for="price">Event Price:</label>
										<span class="add-on">&pound</span>
										<input class="span8" id="appendedPrependedInput" placeholder="10.00" type="text" name="price" value="<?php echo $price; ?>" required>
									</div>
									
								</div>
								
							
							</div>
						
						</div>
						<!-- Basic Information Row End -->
					
					</div>
					<!-- basic Event Details end -->
					
					<!-- Further Information -->
					<div class="well well-small well-white">
						
						<h4 class="thin">Further Information</h4>
						
						<!-- Further information Row -->
						<div class="row-fluid">

							<!-- Event Description -->
							<div class="span10">
								<label for="desc">Event Description:</label>
								<textarea placeholder="Event Description" name="desc" rows="5" class="span12"><?php echo $desc; ?></textarea>
							
							</div>
							<!-- event desc End -->
							
							<!-- Event Capacity -->
							<div class="span2">
								<label for="capacity">Event Capacity</label>
								<input placeholder="00" type="number" name="capacity" class="span12" value="<?php echo $capacity; ?>" required>
							</div>
							<!-- Capacity end -->
						
						
						
						</div>
						<!-- Further info row end -->
					
					</div>
					<!-- Further Information -->
					
					<hr>
					<button type="submit" class="btn btn-success pull-right"><i class="icon-ok icon-white"></i> Save Event</button>
					<div class="clearfix"></div>

					
					
				</div>
				<!-- Well End -->
			
			</div>
			<!-- main span end -->
			
			<!-- Sidebar Span -->
			<div class="span4">
			
				<!-- Well Start -->
				<div class="well well-small">
				
					<h3 class="thin">Event Types</h3>
					<hr>
					
					<table class="table table-striped">
					
						<tr>
							<td><strong>Name</strong></td>
							<td><strong>Location</strong></td>
							<td><strong>Select</strong></td>
						</tr>
					
					<?php
					$i = 0;
					
					while ($i < $row) {
						$type = mysql_result($type_query, $i, "type_ID");
						$type_name = mysql_result($type_query, $i, "type_name");
						$type_location = mysql_result($type_query, $i, "type_location");
						
						if ($type == $type_id) {
							$checked = 'checked';
						} else {
							$checked = '';
						}
						
						$type_row = '<tr><td>'.$type_name.'</td><td>'.$type_location.'</td><td class="text-center"><input type="checkbox" name="event_type[]" value="'.$type_name.'" '.$checked.'></td></tr>';					
						echo $type_row;
						
						$i++;
					}
					
					
					
					
					?>
					
					<tr class="new_row"></tr>
					
					</table>
					</form>
					<!-- Event Form End -->
					
					<!-- Create Type Well -->
					<div class="well well-small">
						
						<h4 class="thin">Create New Type</h4>
						<hr>
						
						<!-- Create Type Form -->
						<form action="type_create.php" method="post" id="event_type">
							
							<div>
							<label for="type_name">Type Name:</label>
							<input name="type_name" type="text" placeholder="Event Type Name" class="span12" id="type_name">
							</div>
							
							<div>
							<label for="type_location">Type Location:</label>
							<input name="type_location" type="text" placeholder="Event Type Location"  class="span12" id="type_location">
							</div>
							
							<button id="submit_type" type="submit" class="btn btn-success pull-right"><i class="icon-check icon-white"></i> Create Type</button>
							
							<div class="clearfix"></div>
							
						</form>
					
					</div>
					<!-- create Type Well End -->
					
				</div>
				<!-- Well end -->
				
			</div>
			<!-- Sidebar Span End -->

			
		</div>
		<!-- Main Row End -->
		
	</div>
	<!-- Body Contianer End -->	
<script type="text/javascript">
$("#event_image").live('change',function(){}) 
$("#submit_type").live('change',function(){}) 

// photoimg is the ID name of INPUT FILE tag and 

$('#imageform').ajaxForm()

//imageform is the ID name of FORM. While changing INPUT it calls FORM submit without refreshing page using ajaxForm() method.  
$(document).ready(function()
  {
    $('#event_image').live('change', function()
    {
      $("#preview").html('');
      $("#preview").html('<img src="../img/loader.gif" alt="Uploading...." style="margin-top: 50px;"/> ');
      $("#imageform").ajaxForm(
      {
        target: '#preview'
      }).submit();
    });
    
    var options_type = { 
        target:        '.new_row',   // target element(s) to be updated with server response 
        beforeSubmit:  showRequest,  // pre-submit callback 
        //success:       showResponse  // post-submit callback 
 
        clearForm: true        // clear all form fields after successful submit 
    }; 
 
    // bind form using 'ajaxForm' 
    $('#event_type').ajaxForm(options_type); 	
    
      
  });

    
// pre-submit callback 
function showRequest(formData, jqForm, options_type) { 
    // formData is an array; here we use $.param to convert it to a string to display it 
    // but the form plugin does this for you automatically when it submits the data 
    var queryString = $.param(formData); 
 
    // jqForm is a jQuery object encapsulating the form element.  To access the 
    // DOM element for the form do this: 
    // var formElement = jqForm[0]; 
 
    $(".new_row").html('');
    $(".new_row").html('<img src="../img/loader.gif" alt="Uploading...." style="margin-top: 50px;"/> ');
 
    // here we could return false to prevent the form from being submitted; 
    // returning anything other than false will allow the form submit to continue 
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