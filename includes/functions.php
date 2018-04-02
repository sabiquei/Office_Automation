<?php 
	function redirect_to($new_location) {
		  header("Location: " . $new_location, true, 301 );
		  exit;
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

	function check_existing_username($user_id) {
		global $conn;
		$sql = "SELECT user_id FROM student_info WHERE user_id = '{$user_id}' LIMIT 1 ";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
  			return 0;
      } else {
          return 1;
      }
	}
?>