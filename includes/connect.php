<?php
// For connecting to the server and required database

	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "officeautomation";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

?>