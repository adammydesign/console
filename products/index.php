<?php
//Start Session
session_start();

//Is user logged in
$user_id = $_SESSION['id'];
$username = $_SESSION['username'];
if(($_SESSION['LoggedIn'] = 1) && ($_SESSION['username'] = $username)) {

include_once('../include/config.php');

//Product Query
$product_query = mysql_query("SELECT * FROM `bodnant_c0nsole`.`products`");
$product_rows = mysql_num_rows($product_query);

$name = $_GET['name'];
$create = $_GET['create'];

//Alerts for new product
if ($create == 'success') {
	$alert = '<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">&times</button>
								<strong>Great News!</strong> New product created. <strong>'.ucwords($name).'</strong>.
						</div>';
} elseif ($create == 'fail') {
	$alert = '<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">&times</button>
								<strong>Whoops</strong> Unable to create product.
						</div>';
}

?>

<!DOCTYPE html>
<html>

<head>
    
    <title>Bodnant Welshfood | Products</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Stylesheets -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../css/bootstrap-responsive.css" rel="stylesheet" media="screen">
    <link href="../css/main.css" rel="stylesheet" media="screen">
     
    <!--Scripts -->
    <script src="http://code.jquery.com/jquery.js"></script>
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
					<li ><a href="../rooms" title="Rooms">Rooms</a></li>
					<li><a href="../orders" title="Orders">Orders</a></li>
					<li><a href="../events" title="Events">Events</a></li>
					<li class="active"><a href="../products" title="Products">Products</a></li>
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
					
					<h3 class="thin pull-left">Products</h3>
					<a href="create.php" class="pull-right btn btn-inverse"><i class="icon-plus icon-white"></i> Create Product</a>
					<div class="clearfix"></div>
					<hr>
					
					<!-- event Container -->
					<div id="event_container">
						
						<?php 
						$i = 0;
						
						while ($i < $product_rows) {
							
							//Get todays date for comparison
							$today = date('Ymd');
							
							//Get info from database
							$id = mysql_result($product_query,$i,"product_ID");
							$name = mysql_result($product_query,$i,"product_name");
							$price = '&pound'.mysql_result($product_query, $i, "product_price");	
							$image = mysql_result($product_query, $i, "product_image");
														
							//Get Image and if blank use holding image
							if (empty($image)) {
								$image = 'http://placehold.it/350x400';
							} else {
								$image = 'product_images/'.$image;
							}
							
							$event = '<div class="span4 event">';
							$event .= '<img src="'.$image.'" class="event_image" title="'.$name.'" />';
							$event .= '<div class="overlay"></div>';
							$event .= '<div class="event_info">';
							$event .= '<div class="well well-small">';
							$event .= '<h4 class="thin"><strong>'.$name.'</strong></h4>';
							$event .= '<h5 class="thin">'.$price.'</h5>';
							$event .= '<hr>';
							$event .= '<div class="btn-group pull-right">';
							$event .= '<a href="edit.php?id='.$id.'" class="btn btn-info"><i class="icon-edit icon-white"></i> Edit Product</a>';
							$event .= '<a href="#delete'.$id.'" class="btn btn-danger" data-toggle="modal" role="button"><i class="icon-trash icon-white"></i></a>';
							$event .= '</div><div class="clearfix"></div>';
							$event .= '</div>';
							$event .= '</div>';
							$event .= '</div>';
							
							//Echo Events
							echo $event;
							?>
							
							<!-- Delete Modal -->
							<div id="delete<?php echo $id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
									<h3 id="myModalLabel">Confirm Delete Product</h3>
								</div>
								<div class="modal-body">
									<p>Are you sure you want to delete <strong><?php echo $name; ?></strong>?</p>
								</div>
								<div class="modal-footer">
									<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
									<a href="delete.php?remove=1&id=<?php echo $id; ?>&name=<?php echo $name; ?>" class="btn btn-danger">Delete <i class="icon-trash icon-white"></i></a>
								</div>
							</div>
							<!-- Modal Delete End -->
							
							<?
							
							$i++;
							
						}
						
						//If there are no upcoming events
						if ($product_rows == 0) {
							echo 'There are no products.';
						}
											
						
						?>
						
					</div>	
					<!-- Event Container End -->
					
				</div>
				<!-- Well End -->
				
			</div>
			<!-- Main Span end -->
			
		
		</div>
		<!-- Main Row end -->
		
	</div>
	<!-- Container End -->
<!-- Page Scripts -->
<script>
var holder;

$(".event").each(function(index, elem){
    if(index%3==0){
        holder=$("<div class='row-fluid event_row'></div>").appendTo("#event_container");
    }
    
    holder.append(this);
});

$(function () {

        $('.event').hover(function() {
           $(this).children('.event a.event_upload, .event .overlay').fadeToggle("fast");
        });

    });

</script>


</body>
</html>
<?php
//If user is not logged in throw them out
} else {
	header("location: ../login.php?error=timeout");
}
?>