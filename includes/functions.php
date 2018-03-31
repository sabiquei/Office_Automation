<?php 
	function redirect_to($new_location) {
		  header("Location: " . $new_location, true, 301 );
		  exit;
	}

	function user_input_validation ($data) {
		$data = htmlentities($data);
		$data = trim($data);
		$data = stripslashes($data);
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
?>