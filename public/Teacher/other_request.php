<?php session_start();
      ob_start();
      require_once("../../includes/connect.php");
      require_once("../../includes/functions.php");
      confirm_logged_in();
?>
<?php 
	// Checking for submit
	if(isset($_POST["accept"])) {
		# code when tutor accepts the request
		/*	
		increment current level by one 
		if current level = levels
			set status as 1
			print "accepted";
		else 
			do nothing it means request has been forwarded to next level
			print "accepted and forwarded";
		*/
	}elseif (isset($_POST["reject"])) {
		# code when tutor rejects the request
		/*
			since tutor rejected it, it should not show up in inbox but should show up in rejected list
			status remains 0
			Set comments and rejected.
			Set message as the remarks field.
		*/
		print "rejected";
	}
?>
<?php
	# getting variables from url using get function
	$request_no = $_GET['request_no'];
	$category = $_GET['category'];

	if($category != "other") {
		print "Not the proper category";
		#should redirect according to category
	}

	global $conn;
  	# Command to get selected request details
  	$sql = " SELECT * FROM  pending_requests_other WHERE request_no = '{$request_no}' LIMIT 1";
  	# Executing query
  	$result = mysqli_query($conn,$sql);
  	if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $student_details = get_student_details($row["student_id"]);
      } else {
          echo "No results";
      }
      // The data fetched from pending_requests_other table are printed in to ther form input using values attribute
      // Student Details are printed using get_student_details from functions.php
?>
<?php 
	// Checking for submit
	if(isset($_POST["accept"])) {
		# code when tutor accepts the request
		print "accepted";
	}elseif (isset($_POST["reject"])) {
		# code when tutor rejects the request
		print "rejected";
	}
?>
<!DOCTYPE html>
<html>
	<title>Send a Request</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<body>
		<?php require_once("../../includes/layouts/tutor_sidebar.php"); ?>
		<div id="main">
			<div class="w3-teal">
			  <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
			  <p align="right" style="float: right"> <?php print $_SESSION["name"]; ?> </p>
			  <div class="w3-container">
			    <h2 align="center">Student Request </h2>
			  </div>
			</div>
			<div class="w3-card-4">
		  		<form class="w3-container" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
				    <label class="w3-text-teal"><b>Date  </b></label>
					<input class="w3-input w3-border w3-animate-input" type="text" style="width:50%" name ="date" value = "<?php global $row; echo $row["date"]; ?>" disabled> <br>

					<!-- Adding request details for recogonizing when form is submitted -->
					<label class="w3-text-teal"><b>Request Category and Request Number</b></label>
					<input class="w3-input w3-border w3-animate-input" type="text" style="width:50%" name ="category" value = "<?php global $row; echo $row["category"]; ?>" disabled> <br>
					<input class="w3-input w3-border w3-animate-input" type="text" style="width:50%" name ="request_no" value = "<?php global $row; echo $row["request_no"]; ?>" disabled> <br>

					<!-- Student Detials -->
					<label class="w3-text-teal"><b>From  </b></label>
					<input class="w3-input w3-border w3-animate-input" type="text" style="width:50%" name ="date" value = "<?php global $student_details; echo $student_details["name"]." of ".$student_details["semester"]." ".get_department_name($student_details["course"]) ?>" disabled> <br>
	 
					<label class="w3-text-teal"><b>Subject  </b></label>
					<input class="w3-input w3-border w3-animate-input" type="text" style="width:50%" name ="subject" value = "<?php global $row; echo $row["subject"]; ?>" disabled>
					
					<div class="w3-row w3-section">
						<div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-pencil"></i></div>
				    		<div class="w3-rest">
								<textarea placeholder="Write your request here..." class="w3-input w3-border w3-margin-bottom" style="height:300px" name ="body"  disabled> <?php global $row; echo $row["body"]; ?> </textarea>
							</div>
							<button type ="submit" class="w3-button w3-right" onclick="document.getElementById('id01').style.display='none'" name="reject"> Reject <i class="fa fa-paper-plane"></i></button>

							<button type ="submit" class="w3-button w3-right" onclick="document.getElementById('id01').style.display='none'" name="accept"> Accept <i class="fa fa-paper-plane"></i></button>
							<p>Request to be Forwarded<i class="w3-padding fa fa-arrow-right"></i></p>
							<?php 
								global $row;
								if($row["levels"] == 1) {
									echo ('<input class="w3-check" type="radio" name="levels" value="1" checked disabled>
									<label>Up to Tutor</label></p>');
								}
								elseif ($row["levels"] == 2) {
									echo ('<input class="w3-check" type="radio" name="levels" value ="2" checked disabled>
				 					<label>Up to HOD</label></p>');
								}
								elseif ($row["levels"] == 3) {
									echo ('<input class="w3-check" type="radio" name="levels" value="3" checked disabled>
				  					<label>Up to Principal</label><br>');
								}
								else {
									echo "Something went wrong.";
								}
							?>
				  		</div>
				  	</div>
			  	</form>
		   	</div>
	   </div>
	</body>
</html> 
<?php ob_end_flush(); 
      mysqli_close($conn);
?>