<?php require_once("../../includes/session.php");
    ob_start(); 
    require_once("../../includes/connect.php");
    require_once("../../includes/functions.php"); 
    confirm_logged_in(4);
?>

<?php
	// TO ADD 
	// If it is already accepted or rejected no need to resubmit.
	global $conn;
	$department_id = $_GET["department_id"];
	$department_remarks = $department_id."_remarks";
	$sql = "UPDATE `no_due_requests` SET `{$department_id}` = 0 , `{$department_remarks}` = 'Pending' WHERE `student_id` = '{$_SESSION["user_id"]}' ";
	if(mysqli_query($conn, $sql)) {
			redirect_to("../Student/nodue_request.php");
		} else {
			print "Unable to resubmit";
		}
?>

<?php ob_end_flush(); 
      mysqli_close($conn);
?>