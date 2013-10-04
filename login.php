<!DOCTYPE html>
<?php
$error = $_GET['error'];
?>
<html>

<head>
    
    <title>Bodnant Welshfood | Administrator Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Stylesheets -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.css" rel="stylesheet" media="screen">
    <link href="css/main.css" rel="stylesheet" media="screen">
     
    <!--Scripts -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
</head>
  
<body>
	
	<!-- Main container -->
	<div class="container">
	  	
		  	<!--- Login Form -->
			<form class="form-horizontal" id="login_form" action="login_valid.php" method="post">
				
				<img src="img/logo.gif" title="Skate the park Admin" id="logo_login" />
				
				<h3 class="thin white text-center">Admin Panel</h3>
				
				<?php 
				if ($error == 'incorrect'){
					echo '<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">&times</button>
								<strong>Oh snap!</strong> you need to enter something.
						</div>';		
				}
				if ($error == 'user'){
					echo '<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">&times</button>
								<strong>Oh snap!</strong> no user by that name.
						</div>';		
				}
				if ($error == 'pwd'){
					echo '<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">&times</button>
								<strong>Oh snap!</strong> your password is wrong.
						</div>';		
				}
				if ($error == 'logout'){
					echo '<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">&times</button>
								<strong>Yippeee</strong> logged out successfully.
						</div>';		
				}
				if ($error == 'timeout'){
					echo '<div class="alert alert-warning">
							<button type="button" class="close" data-dismiss="alert">&times</button>
								<strong>Uh Oh</strong> you need to log in.
						</div>';		
				}
				?>
				<div class="control-group">
				    <input type="text" id="username" placeholder="Username" name="username">
				</div>
				
				<div class="control-group">
				    <input type="password" id="inputPassword" placeholder="Password" name="password">
				</div>
				
				<div class="control-group">
				    <button type="submit" class="btn btn-info pull-right" id="login_btn">Sign in</button>
				</div>
		
			</form>
			<!-- end of login form -->

	
	</div>
	<!-- End of container -->
    
</body>
  
</html>