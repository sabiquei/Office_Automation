<?php 
	session_start();
	ob_start();
	require_once("../../includes/connect.php");
	require_once("../../includes/functions.php");
	confirm_logged_in(2);
	global $conn;

	# User ID
	$userid = $_SESSION["user_id"];

	//Query to hod department
	$sql = "SELECT department FROM hod_info WHERE user_id = '{$userid}' LIMIT 1";

	# Executing query
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		# output data of each row
		$row = mysqli_fetch_assoc($result);
		$department = $row["department"];
	} else {
		echo "0 results";
	}

	# getting variables from url using get function
	$request_no = $_GET['request_no'];

  	# Get request details and student details
    $sql = "SELECT * FROM `no_due_requests` WHERE `request_no` = '{$request_no}' ";
	$result = mysqli_query($conn,$sql); 
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
	  	$student_details = get_student_details($row["student_id"]);
	}
?>
<!DOCTYPE html>
<html>
	<title>Send a Request</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<body>
		<?php require_once("../../includes/layouts/hod_sidebar.php"); ?>
		<div id="main">
			<div class="w3-teal">
			  <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
			  <p align="right" style="float: right"> <?php print $_SESSION["name"]; ?> </p>
			  <div class="w3-container">
			    <h2 align="center">Student No Due Request </h2>
			  </div>
			</div>
			<div class="w3-card-4">
				<!-- Reason for sending the request_no via the header is that since the form elements are disabled, the values of the form elements are not availbale at the action page -->
		  		<form class="w3-container" action="<?php global $request_no; echo "../HOD/nodue_request.php?request_no=".$request_no ?> " method="post">
				    <!-- <label class="w3-text-teal"><b>Date  </b></label>
					<input class="w3-input w3-border w3-animate-input" type="text" style="width:50%" name ="date" value = "< ? php global $row; echo $row["date"];  ?>" disabled> <br> -->

					<!-- Adding request details for recogonizing when form is submitted -->
					<label class="w3-text-teal"><b>Request Category and Request Number</b></label>
					<input class="w3-input w3-border w3-animate-input" type="text" style="width:50%" name ="category" value = "No Due" disabled> <br>
					<input class="w3-input w3-border w3-animate-input" type="text" style="width:50%" name ="request_no" value = "<?php global $row; echo $row["request_no"]; ?>" disabled> <br>

					<!-- Student Detials -->
					<label class="w3-text-teal"><b>From  </b></label>
					<input class="w3-input w3-border w3-animate-input" type="text" style="width:50%" name ="date" value = "<?php global $student_details; echo $student_details["name"]." of ".$student_details["semester"]." ".get_department_name($student_details["course"]) ?>" disabled> <br>
					<label class="w3-text-teal"><b>Remarks</b></label>
					<input class="w3-input w3-border w3-animate-input" type="text" style="width:50%" name ="remarks" placeholder = "Enter Remarks here.. (No Dues / Other Remarks)"  required>

					<input type ="submit" class="w3-button w3-right" onclick="document.getElementById('id01').style.display='none'" name="submit" value="Reject"> <i class="fa fa-paper-plane"></i>

					<input type ="submit" class="w3-button w3-right" onclick="document.getElementById('id01').style.display='none'" name="submit" value="Accept"> <i class="fa fa-paper-plane"></i>
			  	</form>
		   	</div>
	   </div>
	</body>
</html> 
<?php
	// Checking for submit
	global $request_no;
	global $department;
	$department_remarks = $department."_remarks"; 
	$remarks =user_input_validation($_POST["remarks"]);
	if($_POST["submit"] == "Accept"){
		$sql = "UPDATE `no_due_requests` SET `{$department}` = 1 , `{$department_remarks}` = '{$remarks}' WHERE `request_no` = '{$request_no}' ";
		if(mysqli_query($conn, $sql)) {
			redirect_to("../HOD/hod_inbox.php");
		} else {
			print "Unable to update request status";
		}
	}elseif ($_POST["submit"] == "Reject") {

		$sql = "UPDATE `no_due_requests` SET `{$department}` = 2 , `{$department_remarks}` = '{$remarks}' WHERE `request_no` = '{$request_no}' ";
		if(mysqli_query($conn, $sql)) {
			redirect_to("../HOD/hod_inbox.php");
		} else {
			print "Unable to update request status";
		}
	}
?>
<?php ob_end_flush(); 
      mysqli_close($conn);
?>