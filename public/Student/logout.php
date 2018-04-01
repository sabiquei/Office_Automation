<?php
	  require_once("../../includes/session.php");
      ob_start();
      require_once("../../includes/functions.php");
?>

<?php 
		unset($_SESSION["user_id"]);
		unset($_SESSION["name"]);
		redirect_to("login.php");
?>

<?php ob_end_flush(); 
      mysqli_close($conn);
?>