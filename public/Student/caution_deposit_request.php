<?php session_start();
      ob_start();
      require_once("../../includes/connect.php");
      require_once("../../includes/functions.php");
      confirm_logged_in(4);
?>
<?php
    if(isset($_POST["submit"])) {  

		global $conn;

    	# Reading variables from form   
	    $body       = user_input_validation($_POST["body"]);
      	$user_id 	= $_SESSION["user_id"];

      	# Command to insert into table student_info
      	$sql = " INSERT INTO caution_deposit_requests( ";
      	$sql .= "student_id, ";
      	$sql .= "body ";
      	
      	$sql .=") VALUES ( ";

      	$sql .= " '{$user_id}' , ";
      	$sql .= " '{$body}'  ";

      	$sql.= " ) ";

      	#Executing query
      	if (mysqli_query($conn, $sql)) {
			$_SESSION["message"] =  "Request Send";
	    } else {
            $error = "Duplicate entry '".$_SESSION["user_id"]."' for key 'student_id'";
			if(mysqli_error($conn) == $error){
            	$_SESSION["message"] = "Caution Deposit request has already been submitted. Go to History for details";
            }else {
            	$_SESSION["message"] = mysqli_error($conn);
            }
        } 
    }
?>
<!DOCTYPE html>
<html>
	<title>Send a Request</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<body>
		<?php require_once("../../includes/layouts/sidebar.php"); ?>
		<div id="main">
			<div class="w3-teal">
			  <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
			  <div class="w3-container">
			    <h2 align="center">Submit your request</h2>
			        <?php	print $_SESSION["message"]; 
          					unset($_SESSION["message"]);
    				?>
			  </div>
			</div>
			<div class="w3-card-4">
		  		<form class="w3-container" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
				    <label class="w3-text-teal"><b>Application for :</b></label>
					<input class="w3-input w3-border w3-animate-input" type="text" style="width:50%" value="Caution Deposit Request" disabled>
	 
					<!-- <label class="w3-text-teal"><b>Subject</b></label>
					<input class="w3-input w3-border w3-animate-input" type="text" style="width:50%" name ="subject" required> -->
					
					<div class="w3-row w3-section">
						<div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-pencil"></i></div>
				    		<div class="w3-rest">
								<textarea placeholder="Write your request here..." class="w3-input w3-border w3-margin-bottom" style="height:300px" name ="body" required>  </textarea>
							</div>
							<button type ="submit" class="w3-button w3-right" onclick="document.getElementById('id01').style.display='none'" name="submit"> Send <i class="fa fa-paper-plane"></i></button>
							<input class="w3-check" type="radio" checked disabled>
				  			<label>Forward to Principal</label><br>
				  		</div>
				  	</div>
			  	</form>
		   	</div>
	   </div>
	</body>
</html> 
<?php ob_end_flush(); 
      mysqli_close($conn);
?>