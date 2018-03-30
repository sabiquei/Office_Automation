yc<?php require_once("../includes/connect.php");
	  require_once("../includes/functions.php");	?>

<?php

	# Retreving data from form
	# user_input_validation() is used to check whether user input is safe or not
	$name 			= user_input_validation($_REQUEST["name"]);
	$designation    = user_input_validation($_REQUEST["designation"]);
	
	$semester	 	= user_input_validation( $_REQUEST["smstr"]);
	$dept			= user_input_validation($_REQUEST["dept"]);
	$mobile 		= user_input_validation($_REQUEST["mob"]);
	$email 			= user_input_validation($_REQUEST["email"]);
	
	
	$userid 		= user_input_validation($_REQUEST["UserID"]);
	$password 		= user_input_validation( $_REQUEST["psw"]);
	$repeat_password= user_input_validation($_REQUEST["psw-repeat"]);

	# Accessing connection variable form connect.php
	global $conn;

	$test;


	# Command to insert into table student_info
	$sql = "INSERT INTO student_info ( ";
	
	$sql.= "name,";
	$sql.= "designation,";
	$sql.= "semester,";
	$sql.= "dept,";
	$sql.= "mobile,";
	$sql.= "email,";

	
	$sql.= "userid,";
	$sql.= "password ";

	$sql.= ") VALUES ( ";
	$sql.= " '{$name}' , ";

	$sql.= " '{$mobile}' , ";
	$sql.= " '{$email}' , ";

	$sql.= " '{$semester}' , ";
	$sql.= " '{$userid}' , ";
	$sql.= " '{$password}' ";
	$sql.= ")";

	if (mysqli_query($conn, $sql)) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	mysqli_close($conn);
?>