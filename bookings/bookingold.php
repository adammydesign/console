<?php
//Start Session
session_start();

//Is User logged in
$username = $_SESSION['username'];
if(($_SESSION['LoggedIn'] = 1) && ($_SESSION['username'] = $username)) {
include_once('../include/config.php');

if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) ){

//Get Details From first form submision
$nights = $_POST['nights'];
$rooms = $_POST['rooms'];
$date = isset($_REQUEST["bookingDate"]) ? $_REQUEST["bookingDate"] : "";
$date = date("Y-m-d", strtotime($date));
$nights = $nights - 1;

//Create Start & End Date From above values
$start_date = $date;
$end_date = date("Y-m-d", strtotime($date."+ ".$nights." days"));

//Find Unique room_ID's from current_booking Where it is in date range
$room_check = mysql_query("SELECT DISTINCT `room_ID` FROM `current_booking` WHERE `booking_date` BETWEEN '$start_date' AND '$end_date'");
//Check Rows
$rows = mysql_num_rows($room_check);

//If mysql_num_rows = 5 then return no availability
if ($rows == 5) {
	
	echo '<div class="alert alert-warning"><strong>Sorry!</strong>There are no rooms available for this booking.</div>';

//If $rows is < 5 then continue because all rooms aren't taken
} else {
	
	//Create an available variable
	if ($rows == 0) {
		$available = 5;
	} elseif ($rows == 1) {
		$available = 4;
	} elseif ($rows == 2) {
		$available = 3;
	} elseif ($rows == 3) {
		$available = 2;
	} elseif ($rows == 4) {
		$available = 1;
	}
	
	//Return Hidden inputs for form submission $nights & $start_date
	echo '<input type="hidden" name="date" value="'.$start_date.'" >';
	echo '<input type="hidden" name="nights" value="'.($nights + 1).'" >';
	echo '<input type="hidden" name="rooms" value="'.$rooms.'" >';
	
	//Check if $available >= $rooms
	if ($available >= $rooms) {
		
		// Create Array of room_ID's to get available rooms
		$room_array = array();
		while($row = mysql_fetch_array($room_check)){
		    $room_array[] = $row['room_ID'];
		}
		
		//echo $room_array;
		$room_array = implode(',',$room_array);
		
		if (!empty($room_array)) {
			
			// Query with the room ID array
			$room_ids = mysql_query("SELECT * FROM `room_info` WHERE `room_ID` NOT IN ($room_array)");
		
		} else {
			
			//Query all rooms
			$room_ids = mysql_query("SELECT * FROM `room_info`");
			
		}
		
		//If $available > $rooms then show a selection choice
		if ($available > $rooms) {
			
			//If to check if we need an s
			if ($rooms > 1) {
				$s = 's';
			}
			
			//Tell User to select the number of rooms that they want
			echo '<div class="alert alert-success"><strong>Select '.$rooms.' room'.$s.' out of the rooms below.</strong></div>';
				
			//Table of rooms to select from
			echo '<table class="table table-striped" id="room_table">';
			echo '<tr><td><strong>Image</strong></td><td><strong>Name</strong></td><td><strong>Details</strong></td><td style="text-align: center;" ><strong>Room Select</strong></td></tr>';
			
			//While rooms are available display information
			while ($room_rows = mysql_fetch_array($room_ids)) {
				
				//Define image path
				$image = 'room_images/'.$room_rows['room_image'];
				
				// ROBS PRICE MODIFER
				// get the room id
				$roomid = $room_rows['room_ID'];
				
				$finalprice = $room_rows['room_price'];
				
				// do a check if room id based modifier exists for it
				$getroommod = mysql_query("SELECT * FROM `booking_modifier` WHERE `room_ID` = $roomid AND `modifier_enabled` = 'true'");
				$modinfo = mysql_fetch_array($getroommod);
				
						if (mysql_num_rows($getroommod) == 0)
							{
								// No modifer on roomid so carry on
							}
						elseif (mysql_num_rows($getroommod) >= 1)
							{
							// there IS a modifer so need to change the price here
							// two extra bits, a flag to say it is modified price and string of the desc so can echo out the special deal info on booking page
							
							echo 'Room: ' . $roomid . '  DAY: '.date("D", strtotime($date)); 
							echo " Orig price: £ $finalprice";
							
							$modnumber = $modinfo['modifier_price'];
							$finalprice = $finalprice + $modnumber;
							
							echo " Modifer: $modnumber TOTAL: £ $finalprice <br>  ";
									
														
							}
						
				// do a check if modifier exists for date
				$getroommoddate = mysql_query("SELECT * FROM `booking_modifier` WHERE `modifier_date` BETWEEN '$start_date' AND '$end_date' AND `modifier_enabled` = 'true'");
				$modinfo2 = mysql_fetch_array($getroommoddate);
				
						if (mysql_num_rows($getroommoddate) == 0)
							{
								// No modifer in date range so carry on
							
								
							}
						elseif (mysql_num_rows($getroommoddate) >= 1)
							{
							// there IS a modifer based on date range so need to change the price here
							// two extra bits, a flag to say it is modified price and string of the desc so can echo out the special deal info on booking page
							
							// right as it can be a single date modifer there can be 2 days of normal pricing and one of higher or lower. 
							
						$date = date("Y-m-d", strtotime($start_date));
						$days = $nights;
						$increment = 0;
						
						while ($days >= $increment) {
								
																
								$getdateprice = mysql_query("SELECT `modifier_price` FROM `booking_modifier` WHERE `modifier_date` = '$date' AND `modifier_enabled` = 'true'");
								
								$dateprice = mysql_fetch_array($getdateprice);
								
								if($dateprice) {
									// The query succeeded there is a modifer
									echo ' Inc: ' . $increment . 'Room: ' . $roomid . '  DAY: '.date("D", strtotime($date)); 
									echo " Orig price: £ $finalprice";
									$getmod = $dateprice['modifier_price'];
								    $modnumber = "$getmod";
									$finalprice = $finalprice + $modnumber;
									
									echo " Modifer: $modnumber TOTAL: £ $finalprice <br>  ";
									
									}
								
								else  {
									// no change to finalprice

								} 
								
																
								$finalprice = $room_rows['room_price'];
								$modnumber = "";
																
								
								
								$date = date("Y-m-d", strtotime($date.'+ 1 days'));
								$increment++;			
								$finalprice = $room_rows['room_price'];
								}
							
																	
							
							}
						
						
				// $finalprice is output
				
				//echo table rows
				echo '<tr><td><img src="'.$image.'" /></td><td>'.$room_rows['room_name'].'</td><td>'.htmlspecialchars($room_rows['room_text']).'<br/><strong>&pound'.$finalprice.' per night</strong></td><td class="span2" style="text-align: center;"><input type="checkbox" value="'.$room_rows['room_ID'].'" name="room[]"></td></tr>';
				
			}
			
			//End Table
			echo '</table>';
			
			//Disable Checkbox script
			echo '<script>
$("input:checkbox").click(function() {

  var bol = $("input:checkbox:checked").length >= '.$rooms.';     
  $("input:checkbox").not(":checked").attr("disabled",bol);

});</script>';
			
		//Else if $available
		} elseif ($available == $rooms) {
				
				
			//Table of rooms that are fixed
			echo '<table class="table table-striped" id="room_table">';
			echo '<tr><td><strong>Image</strong></td><td><strong>Name</strong></td><td><strong>Details</strong></td></tr>';


			//While rooms are available display information
			while ($room_rows = mysql_fetch_array($room_ids)) {
				
				//Define image path
				$image = 'room_images/'.$room_rows['room_image'];
				
				//echo table rows
				echo '<tr><td><input type="hidden" value="'.$room_rows['room_ID'].'" name="room[]"><img src="'.$image.'" /></td><td>'.$room_rows['room_name'].'</td><td>'.htmlspecialchars($room_rows['room_text']).'<br/><strong>&pound'.$room_rows['room_price'].' per night</strong></td></tr>';
				
			}
			
			//End Table
			echo '</table>';
			
			
			
		//End ELSEIF $available rooms = $rooms	
		}
		
		//Echo Accordion for final details
		echo '<div class="accordion" id="accordion2">
				<a class="accordion-toggle btn btn-info pull-right" data-toggle="collapse" id="customer_details" data-parent="#accordion2" href="#collapseOne">
					Next <i class="icon-chevron-right icon-white"></i>
				</a>
				<div class="clearfix"></div>
						
						<div id="collapseOne" class="accordion-body collapse">
							<div class="accordion-inner">
								
								<hr>
								
								<div class="alert alert-success">
									<strong>OK, Nearly There.</strong> Just fill in the details below to finish booking. 
								</div>
								
								<!-- First Input Row -->
								<div class="row-fluid">
									
									<!-- Title -->
									<div class="span2">
										<label for="title">Title:</label>
										<select name="title" class="span12">
											<option value="">Select</option>
											<option value="Mr">Mr</option>
											<option value="Miss">Miss</option>
											<option value="Mrs">Mrs</option>
										</select>
									</div>
									
									<!-- First Name -->
									<div class="span4">
										<label for="fname">First Name:</label>
										<input type="text" name="fname" placeholder="First Name" class="span12" required>
									</div>
									
									<!-- Last Name -->
									<div class="span4">
										<label for="lname">Last Name:</label>
										<input type="text" name="lname" placeholder="Last Name" class="span12" required>
									</div>
									
								</div>
								<!-- First Row End -->
								
								<!-- second Row -->
								<div class="row-fluid:">
								
									<!-- Email -->
									<div class="span6">
										<label for="email">Email Address:</label>
										<input name="email" type="email" placeholder="your@emailaddress.com" class="span12" required>
									</div>
									
									<!-- Contact Number -->
									<div class="span4">
										<label for="number">Contact Number:</label>
										<input type="tel" name="number" placeholder="00000 000000" class="span12" required>
									</div>
									
									<!-- Contact Number -->
									<div class="span2">
										<label for="postcode">Postcode:</label>
										<input type="text" name="postcode" placeholder="postcode" class="span12" required>
									</div>
								
								</div>
								<!-- Second Row -->
								
								<!-- Third Row -->
								<div class="row-fluid">
									
									<!-- Address Line 1 -->
									<div class="span6">
										<label for="address1">Address Line One:</label>
										<input name="address1" type="text" class="span12" placeholder="Address" required>
									</div>
									
									<!-- City -->
									<div class="span4">
										<label for="city">City:</label>
										<input name="city" type="text" class="span12" placeholder="City" required>
									</div>
									
									<!-- Language -->
									<div class="span2">
										<label for="language">Language:</label>
										<select name="language" class="span12" required>
											<option value="">Select</option>
											<option value="English">English</option>
											<option value="Welsh">Welsh</option>
										</select>
									</div>
									
								</div>
								<!-- Third row end -->
								
							</div>
							
							<hr>
			  
					  <button class="btn btn-success pull-right" type="submit" id="confirm_button"><i class="icon-ok icon-white"></i> Confirm Booking</button>
					  <div class="clearfix"></div>
					  
						</div>
					
					
			  </div>
			  
			  
			  
			  <script>
			  $("a#customer_details").click(function() {
    $(\'html, body\').animate({
        scrollTop: $("div#bottom_anchor").offset().top
    }, 1000);
    });
    
    $("button#confirm_button").click(function() {
    $(\'html, body\').animate({
        scrollTop: $("div#confirm").offset().top
    }, 1000);
    });
    
			  </script>
			  ';
		
	//Else there are not enough rooms available	
	} else {
		
		//Echo that there are not enough rooms
		echo '<div class="alert alert-warning"><strong>Sorry!</strong> There are not enough rooms available for this booking. We only have '.$available.' available.</div>';
		
	}
	
		
}



}
//End if form is submitted

//If user is not logged in throw them out
} else {
	header("location: ../login.php?error=timeout");
}
?>