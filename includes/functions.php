<?php 
	function redirect_to($new_location) {
		  header("Location: " . $new_location, true, 301 );
		  exit;
	}


	// Inorder to regulate access to tutor,student,hod and principal to only their pages
	function check_user_type($user_type) {
		if($user_type == 4) {
			#code
		} elseif ($user_type == 3) {
			# code...
		} elseif ($user_type == 2) {
			# code...
		} elseif ($user_type == 1) {
			# code...
		} elseif ($user_type == 0) {
			# code...
		}
	}

	function user_input_validation ($data) {
		global $conn;
		$data = mysqli_real_escape_string($conn,$data);
		return $data;
	}

	function confirm_logged_in() {
		if(!isset($_SESSION["user_id"]))
			redirect_to("../common/login.php");	
	}

	function convert_password($password) {
		$password = md5($password);
		return $password;
	}

	function prepare_safe_data($data) {
		$data = htmlentities($data);
		$data = trim($data); 
		$data = stripslashes($data);
		return $data;
	}

	function check_existing_username($user_id,$user_type) {
		global $conn;
		$sql = "SELECT user_id FROM ";
		if($user_type == 4){ //Checking to see from which form request came and assigning corresponding table names
			$sql .= "student_info ";
		} elseif ($user_type == 3) {
			$sql .= "tutor_info ";
		} elseif ($user_type == 2) {
			$sql .= "hod_info ";
		} elseif ($user_type == 1) {
			$sql .= "principal_info ";
		} elseif ($user_type == 0) {
			$sql .= "admin_info ";
		}
		$sql.="WHERE user_id = '{$user_id}' LIMIT 1 ";

		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
  			return 0;
      } else {
          return 1;
      }
	}

	function get_department_name($department_id){
		if($department_id == 415){
			return "Computer Science and Engineering";
		} elseif ($department_id == 416) {
			return "Information and Technology";
		} elseif ($department_id == 403) {
			return "Mechanical Engineering";
		} elseif ($department_id == 401) {
			return "Civil Engineering";
		} elseif ($department_id == 412) {
			return  "Electronics and Communication Engineering";
		} elseif ($department_id == 411) {
			return "Electrical and Electronics Engineering";
		} else {
			return " ";
		}
	}

	function get_student_details($userid) {
		global $conn;
		$sql = "SELECT * from student_info where user_id = '{$userid}' LIMIT 1 ";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
  			return mysqli_fetch_assoc($result);
      } else {
  			return "";
      }
	}

	function get_tutor_details($userid) { //based on student_id
		global $conn;

		$student_details = get_student_details($userid);
		$sql = "SELECT * FROM tutor_info  WHERE department = '{$student_details["course"]}' AND semester = '{$student_details["semester"]}' AND designation = 'tutor' LIMIT 1";

	    // Executing query
	    $result = mysqli_query($conn, $sql);

	    if (mysqli_num_rows($result) > 0) {
	    // output data of each row
	    	return mysqli_fetch_assoc($result);
	    } else {
	        return "";
	    }
	}

	function get_hod_details($userid) { //based on student_id
		global $conn;
		$student_details = get_student_details($userid);
	    $sql = "SELECT * FROM hod_info  WHERE department = '{$student_details["course"]}' LIMIT 1";
	    // Executing query
	    $result = mysqli_query($conn, $sql);

	    if (mysqli_num_rows($result) > 0) {
	    // output data of each row
	    	return mysqli_fetch_assoc($result);
	    } else {
	        return "";
	    }
	}

	function get_request_details($request_no) {
		global $conn;
		$sql = " SELECT * FROM  pending_requests_other WHERE request_no = '{$request_no}' LIMIT 1";
	  	# Executing query
	  	$result_from_query = mysqli_query($conn,$sql);
	  	if (mysqli_num_rows($result_from_query) > 0) {
			return mysqli_fetch_assoc($result_from_query);
	      } else {
	          return "No results";
	      }
	}
?>