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
			redirect_to("login.php");	
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
		if($department_id = 415){
			$department_name = "Computer Science and Engineering";
		} elseif ($department_id = 416) {
			$department_name = "Information and Technology";
		} elseif ($department_id = 403) {
			$department_name = "Mechanical Engineering";
		} elseif ($department_id = 401) {
			$department_name = "Civil Engineering";
		} elseif ($department_id = 412) {
			$department_name = "Electronics and Communication Engineering";
		} elseif ($department_id = 411) {
			$department_name = "Electrical and Electronics Engineering";
		}
		return $department_name;
	}
?>