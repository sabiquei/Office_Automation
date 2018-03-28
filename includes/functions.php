<?php 

function user_input_validation ($data) {
	$data = htmlentities($data);
	$data = trim($data);
	$data = stripslashes($data);
	return $data;

}

$variable = 10;
?>