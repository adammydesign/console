<?php
//Start Session
session_start();

//Is user logged in
$username = $_SESSION['username'];
$user_id = $_SESSION['id'];
if(($_SESSION['LoggedIn'] = 1) && ($_SESSION['username'] = $username)) {

include_once('../include/config.php');

$edit = $_GET['update'];
$name = $_GET['name'];
$delete = $_GET['delete_mod'];
$create = $_GET['create'];

if ($edit == 'success') {
	$alert = '<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">&times</button>
								<strong>Great News!</strong> <strong>'.$name.'</strong> has been updated.
						</div>';
} elseif ($edit == 'fail') {
	$alert = '<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">&times</button>
								<strong>Bad News!</strong> Unable to edit '.$name.' at this time.
						</div>';
}

if ($delete == 'success') {
	$alert = '<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">&times</button>
								<strong>Great News!</strong> Modifier has been deleted.
						</div>';
} elseif ($delete == 'fail') {
	$alert = '<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">&times</button>
								<strong>Bad News!</strong> Unable to delete modifier at this time.
						</div>';
}

if ($create == 'success') {
	$alert = '<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">&times</button>
								<strong>Great News!</strong> Modifier has been created.
						</div>';
} elseif ($create == 'fail') {
	$alert = '<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">&times</button>
								<strong>Bad News!</strong> Unable to create modifier at this time.
						</div>';
}


$rooms = mysql_query("SELECT `room_ID`, `room_name` FROM `room_info`");
?>

<!DOCTYPE html>
<html>

<head>
    
    <title>Bodnant Welshfood | Orders</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Stylesheets -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../css/bootstrap-responsive.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <link href="../css/main.css" rel="stylesheet" media="screen">
     
    <!--Scripts -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    
    <script>
    $(function() {
    $( ".datepicker" ).datepicker({
	    dateFormat: 'DD, d MM',
    });
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
					<li class="active"><a href="../rooms" title="Rooms">Rooms</a></li>
					<li ><a href="../orders" title="Orders">Orders</a></li>
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
				
				<!-- Well -->
				<div class="well well-small">
					
					<?php
					if (!empty($alert)) {
						echo $alert;
					}
					?>
				
					<h3 class="thin">Bodnant Rooms</h3>
					<hr>
					
					<?php
					$get_rooms = mysql_query("SELECT * FROM `room_info`");
					
					while($row = mysql_fetch_array($get_rooms)) {
						
						echo '<div class="well well-small"><div class="row-fluid">';
						echo '<div class="span4">';
						echo '<img src="../bookings/room_images/'.$row['room_image'].'" />';
						echo '</div>';
						echo '<div class="span8">';
						echo '<h3 class="thin pull-left">'.$row['room_name'].'</h3>';
						echo '<a href="edit.php?id='.$row['room_ID'].'" class="btn btn-info pull-right"><i class="icon-edit icon-white"></i> Edit Room</a><div class="clearfix"></div>';
						echo '<strong>Room Type:</strong> '.$row['room_type'].'<br>';
						echo $row['room_text'].'<br>';
						echo '<strong>Basic Room Rate:</strong> &pound'.$row['room_price'];
						echo '</div>';
						echo '</div></div>';	
					}
					
					
					?>
					
				</div>
				<!-- Well End -->
				
			
			</div>
			<!-- Main Span End -->
			
			<!-- Side span -->
			<div class="span4">
			
				<!-- Well -->
				<div class="well well-small">
				
					<h3 class="thin">Price Modifier</h3>
					<hr>
					
					
					<?php
						$modifiers = mysql_query("SELECT * FROM `booking_modifier` INNER JOIN `room_info` ON booking_modifier.room_ID=room_info.room_ID");
						
						echo '<table class="table table-striped">';
						
						echo '<tr><td><strong>Mod Type</strong></td><td><strong>Mod Amount</strong></td><td class="text-center"><strong>Edit</strong></td></tr>';
						
						while($mod = mysql_fetch_array($modifiers)) {
							
							$id = $mod['modifier_ID'];
							$mod_date = $mod['modifier_date'];
							$room_ID = $mod['room_ID'];
							$room_name = $mod['room_name'];
							$mod_price = $mod['modifier_price'];
							$mod_desc = $mod['modifier_desc'];
							$mod_enabled = $mod['modifier_enabled'];
							
							if (isset($mod_enabled)) {
								$checked = 'checked';
							}
							
							
							echo '<tr><td>'.$type.'</td><td>'.$mod_price.'</td><td><div class="btn-group"><a data-toggle="modal" role="button" href="#edit'.$id.'" class="btn btn-info btn-small"><i class="icon-edit icon-white"></i> Edit</a><a data-toggle="modal" role="button" href="#delete'.$id.'" class="btn btn-danger btn-small"><i class="icon-trash icon-white"></i> Delete</a></div></td></tr>';
							
							
							echo '<!-- Delete Modal -->
							<div id="delete'.$id.'" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
									<h3 id="myModalLabel">Confirm Delete Modifier</h3>
								</div>
								<div class="modal-body">
									<p>Are you sure you want to delete modifier?</p>
								</div>
								<div class="modal-footer">
									<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
									<a href="delete_mod.php?remove=1&id='.$id.'" class="btn btn-danger">Delete <i class="icon-trash icon-white"></i></a>
								</div>
							</div>
							<!-- Modal Delete End -->';
							
							echo '<!-- Edit Modal -->
							<div id="edit'.$id.'" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
									<h3 id="myModalLabel">Edit Modifier</h3>
								</div>
								<div class="modal-body">
									<form action="edit_mod.php" method="post">
									
										<div class="alert alert-success">
						<strong>Important!</strong> You can only base a modifier on either a date or a room <strong>NOT</strong> both.
					</div>
					
					<input type="hidden" value="'.$id.'" name="id">
					<div class="row-fluid">
						
						<!-- Room Selection -->
						<div class="span6">
						
							<label for="room_mod">Room:</label>	
							<select name="room_mod" class="span12">';
										echo '<option value="'.$room_name.'">'.$room_name.'</option>';
								
										while($option = mysql_fetch_array($rooms)) {
											echo '<option value="'.$option['room_ID'].'">'.$option['room_name'].'</option>';
										}

										echo '</select>
										
										</div>
						
						<!-- date Selection -->
						<div class="span6">
							<label for="date_mod">Date:</label>
							<input id="datepicker" type="text" name="date_mod" value="'.$mod_date.'" class="span12 datepicker" >
						</div>
						
					</div>
					
					<div class="row-fluid">
						
						<!-- Price Modifier -->
						<div class="span6">
							<label for="price_mod">Price Modifier:</label>
							<input type="text" name="price_mod" value="'.$mod_price.'" class="span12" required>
						</div>
						
						<!-- Mod Enable -->
						<div class="span6" id="mod_enabled">
							<label class="checkbox inline" for="mod_enabled">
							<input type="checkbox" name="mod_enabled" '.$checked.'> Modifier Enabled</label>
						</div>
						
					</div>
					
					<label for="mod_desc">Modifier Description</label>
					<textarea name="mod_desc" rows="3" class="span12">'.$mod_desc.'</textarea>
									
								</div>
								<div class="modal-footer">
									<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
									<button class="btn btn-success"><i class="icon-ok icon-white"></i> Save Modifier</button>
									</form>
								</div>
							</div>
							<!-- Modal Edit End -->';
							
							
							
							
						}
						echo '</table>';
						
					?>
					
					<div class="well well-small">
					<h4 class="thin">Create Modifier</h4>
					<hr>
					<!-- Room Modifier -->
					<form method="post" action="modifier_create.php" id="create_mod">
					
					<div class="alert alert-success">
						<strong>Important!</strong> You can only base a modifier on either a date or a room <strong>NOT</strong> both.
					</div>
					
					<div class="row-fluid">
						
						<!-- Room Selection -->
						<div class="span6">
						
							<label for="room_mod">Room:</label>	
							<select name="room_mod" class="span12">
								<option value="">Select Room</option>
								<?php
									$rooms = mysql_query("SELECT `room_ID`, `room_name` FROM `room_info`");
									
									while($option = mysql_fetch_array($rooms)) {
										echo '<option value="'.$option['room_ID'].'">'.$option['room_name'].'</option>';
									}
									
								?>
							</select>
							
						</div>
						
						<!-- date Selection -->
						<div class="span6">
							<label for="date_mod">Date:</label>
							<input type="text" name="date_mod" placeholder="Select Date" class="span12 datepicker" >
						</div>
						
					</div>
					
					<div class="row-fluid">
						
						<!-- Price Modifier -->
						<div class="span6">
							<label for="price_mod">Price Modifier:</label>
							<input type="text" name="price_mod" placeholder="(+/-) 20.00" class="span12" required>
						</div>
						
						<!-- Mod Enable -->
						<div class="span6" id="mod_enabled">
							<label class="checkbox inline" for="mod_enabled">
							<input type="checkbox" name="mod_enabled"> Modifier Enabled</label>
						</div>
						
					</div>
					
					<label for="mod_desc">Modifier Description</label>
					<textarea name="mod_desc" rows="3" class="span12"></textarea>
					
					<hr>
					<button type="submit" class="btn btn-success pull-right"><i class="icon-ok icon-white"></i> Create Modifier</button>
					<div class="clearfix"></div>
					</form>
					
					</div>
					
				</div>
				<!-- well end -->
			
			</div>
			<!-- Side Span End -->
			
		</div>
		<!-- Main Row End -->
		
	</div>
	<!-- Container End -->
</body>
</html>
<?php
//If user is not logged in throw them out
} else {
	header("location: ../login.php?error=timeout");
}
?>