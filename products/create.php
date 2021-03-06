<?php
//Start Session
session_start();

//Is User Logged in
$username = $_SESSION['username'];
$user_id = $_SESSION['id'];
if(($_SESSION['LoggedIn'] = 1) && ($_SESSION['username'] = $username)) {

//Config Include
include_once('../include/config.php');

?>

<!DOCTYPE html>
<html>

<head>
    
    <title>Bodnant Welshfood | Create Product</title>
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
					<li ><a href="../events" title="Events">Events</a></li>
					<li class="active"><a href="../products" title="Products">Products</a></li>
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
		        <h3 id="myModalLabel">Add Product Image</h3>
		    </div>
		    <div class="modal-body">
		        <form action="ajaxupload.php" method="post" enctype="multipart/form-data" id="imageform">
		        <input type="file" name="product_image" id="product_image"/>
		        </form>
		        
		    </div>
		    <div class="modal-footer">
		        <button class="btn btn-success" data-dismiss="modal" id="image_submit"> <i class="icon-ok icon-white"></i> Save Product Image</button>
		        
		    </div>
		</div>
		<!-- Event Image End -->
							
		<!-- Main Row -->
		<div class="row-fluid">
			
			<!-- Main span --->
			<div class="span8">
				
				<!-- Well -->
				<div class="well well-small">
				
					<h3 class="thin pull-left">Create Product</h3>
					
					<!-- Event create Form -->
					<form action="create_valid.php" method="post">
					<button type="submit" class="btn btn-success pull-right"><i class="icon-ok icon-white"></i> Create Product</button>
					<div class="clearfix"></div>
					<hr>
					<!-- event Create Header End -->
					
					
					<!-- Basic Event Details -->
					<div class="well well-small">
						
						<h4 class="thin">Product Details</h4><br>
						
						<div class="row-fluid">
							
						<!-- Basic Information Row -->
						<div class="row-fluid">
							
							<!-- event Image -->
							<div class="span4" id="image">
							
								<div id="preview">
									<img src="http://placehold.it/350x350" />
								<!-- Upload Image Modal button -->
								<a href="#imagemodal" data-toggle="modal" role="button" class="btn btn-info" id="event_btn"><i class="icon-plus icon-white"></i> Add Image</a>
								</div>
																

							</div>
							
							<!-- Product Information -->
							<div class="span8">
								
								<div class="row-fluid">
								
									<!-- Product Name --->
									<div class="span8">
										<label for="name">Product Name:</label>
										<strong><input type="text" name="name" placeholder="Product Name" class="span12" required></strong>
									</div>
									
									<!-- Product Price -->
									<div class="input-prepend input-append span4">
										<label for="price">Product Price:</label>
										<span class="add-on span3">&pound</span>
										<input class="span9" id="appendedPrependedInput" placeholder="10.00" type="text" name="price" required>
									</div>
								
								</div>
								
								<div class="row-fluid">
									
									<!-- Product Description -->
									<div class="span10">
										<label for="desc">Product Description:</label>
										<textarea placeholder="Product Description" name="desc" rows="5" class="span12"></textarea>
									
									</div>
									<!-- Product desc End -->
									
									<!-- Product Stock -->
									<div class="span2">
										<label for="capacity">Stock:</label>
										<input placeholder="00" type="number" name="stock" class="span12" required>
									</div>
									<!-- Stock end -->
								
							
								</div>
							
							</div>
						
							
						</div>
						<!-- Basic Information Row End -->
						<br/>
						<!-- Upload Image Info -->
						<div class="well well-small">
							<small>Images should be no larger than 1MB in size and should be of relevance to the product. If there is no image selected then a default image will be assigned.</small>
						</div>
					</div>
					<!-- basic Event Details end -->
					
					<hr>
					<button type="submit" class="btn btn-success pull-right"><i class="icon-ok icon-white"></i> Create Product</button>
					<div class="clearfix"></div>
					
					</div>
					
				</div>
				<!-- Well End -->
			
			</div>
			<!-- main span end -->
			
			<!-- Sidebar Span -->
			<div class="span4">
			
				<!-- Well Start -->
				<div class="well well-small">
				
					<h3 class="thin">Product Types</h3>
					<hr>
					
					<table class="table table-striped">
					
						<tr>
							<td><strong>Name</strong></td>
							<td><strong>Vendor</strong></td>
							<td><strong>Select</strong></td>
						</tr>
					
					<?php
					$type_query = mysql_query("SELECT * FROM `product_type`");
					$row = mysql_num_rows($type_query);
					$i = 0;
					
					while ($i < $row) {
						$type_ID = mysql_result($type_query, $i, "product_type_ID");
						$type_name = mysql_result($type_query, $i, "product_type_name");
						$type_vendor = mysql_result($type_query, $i, "product_vendor");
						
						$type_row = '<tr><td>'.$type_name.'</td><td>'.$type_vendor.'</td><td class="text-center"><input type="checkbox" name="event_type[]" value="'.$type_name.'"></td></tr>';					
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
						<form action="type_create.php" method="post" id="product_type">
							
							<div>
							<label for="type_name">Type Name:</label>
							<input name="type_name" type="text" placeholder="Product Type Name" class="span12" id="type_name">
							</div>
							<div>
							<label for="vendor_name">Vendor Name:</label>
							<input name="type_vendor" type="text" placeholder="Product Vendor Name" class="span12" id="vendor_name">
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
$("#product_image").live('change',function(){}) 
$("#submit_type").live('change',function(){}) 

// photoimg is the ID name of INPUT FILE tag and 

$('#imageform').ajaxForm()

//imageform is the ID name of FORM. While changing INPUT it calls FORM submit without refreshing page using ajaxForm() method.  
$(document).ready(function()
  {
    $('#product_image').live('change', function()
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
    $('#product_type').ajaxForm(options_type); 	
    
      
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