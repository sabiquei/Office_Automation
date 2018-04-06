<?php session_start();
      ob_start();
      require_once("../../includes/connect.php");
      require_once("../../includes/functions.php");
      confirm_logged_in(4);
?>
<!DOCTYPE html>
<html>
	<title>Send a Request</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<body>
		<?php require_once("../../includes/layouts/sidebar.php"); ?>
		<div id="main">
			<div class="w3-teal">
			  <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
			  <div class="w3-container">
			    <h2 align="center">Submit your request</h2>
			  </div>
			</div>
			<div class="w3-card-4">
		  		<form class="w3-container" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
				    <!-- <label class="w3-text-teal"><b>Application for :</b></label>
					<input class="w3-input w3-border w3-animate-input" type="text" style="width:50%" name ="application_for" required> -->
	 
					<label class="w3-text-teal"><b>Subject</b></label>
					<input class="w3-input w3-border w3-animate-input" type="text" style="width:50%" name ="subject" required>
					
					<div class="w3-row w3-section">
						<div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-pencil"></i></div>
				    		<div class="w3-rest">
								<textarea placeholder="Write your request here..." class="w3-input w3-border w3-margin-bottom" style="height:300px" name ="body" required>  </textarea>
							</div>
							<button type ="submit" class="w3-button w3-right" onclick="document.getElementById('id01').style.display='none'" name="submit"> Send <i class="fa fa-paper-plane"></i></button>
							<p>Forward<i class="w3-padding fa fa-arrow-right"></i></p>
							<input class="w3-check" type="radio" name="levels" value="1" checked>
							<label>Up to Tutor</label></p>
				 
							<input class="w3-check" type="radio" name="levels" value ="2">
				 			<label>Up to HOD</label></p>
				 
							<input class="w3-check" type="radio" name="levels" value="3">
				  			<label>Up to Principal</label><br>
				  		</div>
				  	</div>
			  	</form>
		   	</div>
	   </div>
	</body>
</html> 
<?php
    if(isset($_POST["submit"])) {  

		global $conn;

    	# Reading variables from form   
	    $category   = "Other";
	   	$subject    = user_input_validation($_POST["subject"]);
	    $body       = user_input_validation($_POST["body"]);
	  	$levels		= user_input_validation($_POST["levels"]);
      	$user_id 	= $_SESSION["user_id"];

      	$tutor = get_tutor_details($user_id);
      	$hod = get_hod_details($user_id);

      	# Command to insert into table student_info
      	$sql = " INSERT INTO pending_requests_other( ";
      	$sql .= "student_id, ";
      	$sql .= "subject, ";
      	$sql .= "category, ";
      	$sql .= "body, ";
      	$sql .= "levels , ";
      	$sql .= "tutor_id, ";
      	$sql .= "hod_id "; 
      	
      	$sql .=") VALUES ( ";

      	$sql .= " '{$user_id}' , ";
      	$sql .= " '{$subject}' , ";
      	$sql .= " '{$category}' , ";
      	$sql .= " '{$body}' , ";
      	$sql .= " '{$levels}' , ";
      	$sql .= " '{$tutor["user_id"]}' ,";
      	$sql .= " '{$hod["user_id"]}'  ";

      	$sql.= " ) ";

      	#Executing query
      	if (mysqli_query($conn, $sql)) {
			echo "Request Send<br>";
	    } else {
	    	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	    }
    }
?>
<?php ob_end_flush(); 
      mysqli_close($conn);
?>