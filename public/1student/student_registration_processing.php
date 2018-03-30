<?php require_once("../../includes/connect.php");
	  require_once("../../includes/functions.php");	?>

<?php

	# Retreving data from form
	# user_input_validation() is used to check whether user input is safe or not

	$name 			= user_input_validation($_REQUEST["name"]);
	$dob 			= user_input_validation($_REQUEST["dob"]);
	$gender 		= user_input_validation($_REQUEST["sex"]);
	$father 		= user_input_validation($_REQUEST["fname"]);
	$f_occupation 	= user_input_validation($_REQUEST["f_occupation"]);
	$mother 		= user_input_validation($_REQUEST["mname"]);
	$m_occupation 	= user_input_validation($_REQUEST["m_occupation"]);
	$religion 		= user_input_validation($_REQUEST["religion"]);
	$caste 			= user_input_validation($_REQUEST["caste"]);
	$category 		= user_input_validation($_REQUEST["category"]);
	$blood 			= user_input_validation($_REQUEST["bgroup"]);
	$aadhar 		= user_input_validation($_REQUEST["aadhar"]);
	$housename 		= user_input_validation($_REQUEST["hname"]);
	$place 			= user_input_validation($_REQUEST["plc"]);
	$postoffice 	= user_input_validation($_REQUEST["post"]);
	$district 		= user_input_validation($_REQUEST["district"]);
	$mobile 		= user_input_validation($_REQUEST["mob"]);
	$email 			= user_input_validation($_REQUEST["email"]);
	$yoa 			= user_input_validation($_REQUEST["yoa"]); #Year of Admission
	$admission_no 	= user_input_validation($_REQUEST["admno"]);
	$reg_no 		= user_input_validation($_REQUEST["register"]);
	$course 		= user_input_validation($_REQUEST["course"]);
	$semester	 	= user_input_validation($_REQUEST["smstr"]);
	$userid 		= user_input_validation($_REQUEST["UserID"]);
	$password 		= user_input_validation($_REQUEST["psw"]);
	$repeat_password= user_input_validation($_REQUEST["psw-repeat"]);

	# Convert password into hash value.
	$password = md5($password);

	# Accessing connection variable form connect.php
	global $conn;

	# Command to insert into table student_info
	$sql = "INSERT INTO student_info ( ";
	
	$sql.= "name,";
	$sql.= "dob,";
	$sql.= "gender,";
	$sql.= "father,";
	$sql.= "f_occupation,";
	$sql.= "mother,";
	$sql.= "m_occupation,";
	$sql.= "religion,";
	$sql.= "caste,";
	$sql.= "category,";
	$sql.= "blood,";
	$sql.= "aadhar,";
	$sql.= "housename,";
	$sql.= "place,";
	$sql.= "postoffice,";
	$sql.= "district,";
	$sql.= "mobile,";
	$sql.= "email,";
	$sql.= "yoa,";
	$sql.= "admission_no,";
	$sql.= "reg_no,";
	$sql.= "course,";
	$sql.= "semester,";
	$sql.= "userid,";
	$sql.= "password ";

	$sql.= ") VALUES ( ";

	$sql.= " '{$name}' , ";
	$sql.= " '{$dob}' , ";
	$sql.= " '{$gender}' , ";
	$sql.= " '{$father}' , ";
	$sql.= " '{$f_occupation}' , ";
	$sql.= " '{$mother}' , ";
	$sql.= " '{$m_occupation}' , ";
	$sql.= " '{$religion}' , ";
	$sql.= " '{$caste}' , ";
	$sql.= " '{$category}' , ";
	$sql.= " '{$blood}' , ";
	$sql.= " '{$aadhar}' , ";
	$sql.= " '{$housename}' , ";
	$sql.= " '{$place}' , ";
	$sql.= " '{$postoffice}' , ";
	$sql.= " '{$district}' , ";
	$sql.= " '{$mobile}' , ";
	$sql.= " '{$email}' , ";
	$sql.= " '{$yoa}' , ";
	$sql.= " '{$admission_no}' , ";
	$sql.= " '{$reg_no}' , ";
	$sql.= " '{$course}' , ";
	$sql.= " '{$semester}' , ";
	$sql.= " '{$userid}' , ";
	$sql.= " '{$password}' ";
	$sql.= ")";

	#Executing query
	if (mysqli_query($conn, $sql)) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	mysqli_close($conn);
?>