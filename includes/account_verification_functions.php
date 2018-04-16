<?php
	// Functions assossiated with verifying accounts created by students,tutors etc.

	// This function is used to print account details for displaying them in verify.php
	// The link redirects to verify_status where there is an option to verify account or view all the information.
	function list_accounts($row) {
		print "<a style=\"text-decoration: none\" href=\"../common/verify_status.php?user_id=".$row['user_id']."&verified=".$row['verified']."\">
	            <div class=\"w3-container w3-hover-light-gray w3-border-bottom test\" width=\"100%\" style =\"color : ".verify_color($row["verified"]).";\" >"
	            .get_department_name($row["department"]).
	            " , ".$row["semester"]."
	            <br>".$row["name"]."
	            <br>Created On : ".$row["date_created"]."
	            </div>
	          </a>";
	}

	// This function returns green for verified - (0) and grey for unverified - (1) It is used to style attribute
	function verify_color($verified) {
		if($verified == 0){
			return "grey";
		}
		else {
			return "green";
		}
	}

	// Function to return all student details of a particular sem and dept based on that of the tutor
	// The argument user id is the tutor's id and if specified_account is set,only that student's data is returned.
	function student_info_sql($userid,$verified,$specific_account = 1) {
		$sql = "SELECT student_info.course as department,student_info.* FROM student_info,tutor_info WHERE student_info.verified = '{$verified}' AND tutor_info.user_id = '{$userid}' AND tutor_info.department = student_info.course AND tutor_info.semester = student_info.semester ";
		if($specific_account != 1){
			$sql .= "AND student_info.user_id = '{$specific_account}' ";
		}
		return $sql;
	}

	// Function to return all tutor details of a particular dept based on the dept of the HOD
	// The argument user id is the HOD's id and if specified_account is set,only that tutor's account data is returned.
	function tutor_info_sql($userid,$verified,$specific_account = 1) {
		$sql = "SELECT tutor_info.* FROM tutor_info,hod_info WHERE tutor_info.verified = '{$verified}' AND hod_info.user_id = '{$userid}' AND tutor_info.department = hod_info.department ";
		if($specific_account != 1){
			$sql .= "AND tutor_info.user_id = '{$specific_account}' ";
		}
		return $sql;
	}

	// Function to return all HOD details 
	// The input user id is the principal's id and if specified_account is set,only that HOD data is returned.
	function hod_info_sql($userid,$verified,$specific_account = 1) {
		$sql = "SELECT hod_info.* FROM hod_info WHERE hod_info.verified = '{$verified}' ";
		if($specific_account != 1){
			$sql .= "AND hod_info.user_id = '{$specific_account}' ";
		}
		return $sql;
	}

	// Returns principal account information
	function principal_info_sql($userid,$verified,$specific_account = 1) {
		$sql = "SELECT principal_info.* FROM principal_info WHERE principal_info.verified = '{$verified}' ";
		if($specific_account != 1){
			$sql .= "AND hod_info.user_id = '{$specific_account}' ";
		}
		return $sql;
	}


























?>