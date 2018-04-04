<?php
	ob_start();
	require_once("../../includes/connect.php");
    require_once("../../includes/functions.php");
	print "In";
	foreach ($_POST as $key => $value) {
			print $key." => ".$value."<br>";

	}
	$request_no_get = $_GET["request_no"];
	print $request_no_get;
	print "<br>";
	// Checking for submit
		if($_POST["submit"] == "Accept"){
			print "inhere";
		
		$request_no = $_POST["request_no"]; 
		print $request_no."<br>";

		$request_details = get_request_details($request_no);

		foreach ($request_details as $key => $value) {
			print $key." => ".$value."<br>";
		}


		$request_details["current_level"] = $request_details["current_level"] + 1;

		if($request_details["current_level"] == $request_details["levels"]){
			$request_details["status"] = 1;
			print "Accepted";

			// to do
			// Update the changes in the table

		} else {
			print "Forwarded to HOD";
			redirect_to("../Teacher/tutor_inbox.php");
		}
		# code when tutor accepts the request
		/*	ToDo
		increment current level by one 
		if current level = levels
			set status as 1
			print "accepted";
		else 
			do nothing it means request has been forwarded to next level
			print "accepted and forwarded";
		*/
	}elseif (isset($_POST["submit"]) == "Reject") {
		# code when tutor rejects the request
		/*
			since tutor rejected it, it should not show up in inbox but should show up in rejected list
			status becomes 2
			Set comments and rejected.
			Set message as the remarks field.
		*/
		print "rejected";
	}
	ob_end_flush();
?>