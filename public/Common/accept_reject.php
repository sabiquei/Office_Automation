<?php
	require_once("../../includes/session.php");
	ob_start();
	require_once("../../includes/connect.php");
    require_once("../../includes/functions.php");
    confirm_logged_in($_SESSION["user_type"]);

	$request_no = $_GET["request_no"];
	if($_SESSION["user_type"] == 3){
		$redirect_to = "../Teacher/tutor_inbox.php";
	} else if($_SESSION["user_type"] == 2) {
		$redirect_to = "../HOD/hod_inbox.php";
	} else if($_SESSION["user_type"] == 1) {
		$redirect_to = "../Principal/inbox.php";
	}
	// Checking for submit
	if($_POST["submit"] == "Accept"){
		print $request_details;
		$request_details = get_request_details($request_no);

		// Obtain remarks form POST SuperGlobal
		$remarks = user_input_validation($_POST["remarks"]);

		$request_details["current_level"] = $request_details["current_level"] + 1;

		foreach ($request_details as $key => $value) {
			print $key." -> ".$value."<br>";
		}

		$sql = "UPDATE pending_requests_other SET current_level = '{$request_details["current_level"]}' , remarks = '{$remarks}' ";
		if($request_details["current_level"] == $request_details["levels"]){
			$request_details["status"] = 1;
			$sql .= " , status = '{$request_details["status"]}' ";
			//print "Accepted";
			//Should Set a message
			
		} else {
			// Forward case
			// Should set a message here
		}
		$sql .= "WHERE request_no = '{$request_no}' ";
		global $conn;
		if(mysqli_query($conn,$sql)){
			redirect_to($redirect_to);
		} else {
			print "Something Went wrong at while accepting";
		}
	}elseif ($_POST["submit"] == "Reject") {

		$request_details["status"] = 2;

		// Obtain remarks form POST SuperGlobal
		$remarks = user_input_validation($_POST["remarks"]);

		$sql = "UPDATE pending_requests_other SET status = '{$request_details["status"]}', remarks = '{$remarks}' WHERE request_no = '{$request_no}'  ";
		global $conn;
		if(mysqli_query($conn,$sql)){
			redirect_to($redirect_to);
		} else {
			print "Something Went wrong while rejecting";
		}

		// Should set message as rejected
	}
	ob_end_flush();
?>