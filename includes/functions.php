<?php 
	# Functions which are reused over multiple scripts

	// Used to redirect to a new page
	function redirect_to($new_location) {
		  header("Location: " . $new_location, true, 301 );
		  exit;
	}

	// Validating user input before entering in to sql.
	function user_input_validation ($data) {
		global $conn;
		$data = mysqli_real_escape_string($conn,$data);
		return $data;
	}

	// Checking whether the correct user is logged in while accessing a certain page
	// User type depicts the type of user, so if the logged in user type is 4 and the page is meant for user type 3, that user is logged out.
	function confirm_logged_in($user_type) {
		if((!isset($_SESSION["user_id"])) || ($_SESSION["user_type"] != $user_type)) {
			redirect_to("../common/logout.php");	
		}
	}

	// Function to convert password. Later changes can be made here if the mechanism has to be updated
	function convert_password($password) {
		$password = md5($password);
		return $password;
	}

	// For preparing the data read from forms or databse
	function prepare_safe_data($data) {
		$data = htmlentities($data);
		$data = trim($data); 
		$data = stripslashes($data);
		return $data;
	}

	// Function to check whether a userid already exists while creating an account. User type is checked and query is provided accordingly. 1 is returned if user id DOES NOT exist and 0 if it exists.
	function check_existing_username($user_id,$user_type) {
		global $conn;
		$sql = "SELECT user_id FROM ";
		if($user_type == 4){ 
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

	// returns department name based on the department id.
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

	// returns the student details for particular student id
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

	// returns the tutor details based on the particular student id. (This is a bad design) - Should be updated
	function get_tutor_details($userid) { 
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

	// returns the hod details based on the particular student id. (This is a bad design) - Should be updated
	function get_hod_details($userid) {
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

	// Returns the details of requests of category other based on the request no provided
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

	// Return remarks of requests of category other based on the request status and current level.
	function get_status_remarks($status,$current_level) {
		if($status == 0) {
			if($current_level == 0){
				return "Under Consideration by Tutor";
			} elseif ($current_level == 1) {
				return "Under Consideration by HOD";
			} elseif ($current_level == 2) {
				return "Under Consideration by Principal";
			}
		} elseif ($status == 1) {
			if ($current_level == 1) {
				return "Accepted By Tutor";
			} elseif ($current_level == 2) {
				return "Accepted by HOD";
			} elseif ($current_level == 3) {
				return "Accepted by Principal";
			}
		} elseif ($status == 2) {
			if ($current_level == 0) {
				return "Rejected By Tutor";
			} elseif ($current_level == 1) {
				return "Rejected by HOD";
			} elseif ($current_level == 3) {
				return "Rejected by Principal";
			}
		} else {
			return "Something is wrong with this request";
		}
	}

	// Returns a color based on status, for using in style attribute.
	function get_status_color($status) {
		if($status == 0) {
			return "grey";
		}elseif($status == 1) {
			return "green";
		}elseif($status == 2) {
			return "red";
		}
	}
?>