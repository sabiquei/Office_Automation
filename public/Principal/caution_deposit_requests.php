<?php session_start();
      ob_start();
      require_once("../../includes/connect.php");
      require_once("../../includes/functions.php");
      confirm_logged_in(1);
?>
<?php
		global $conn;
		$request_no = $_GET['request_no']; // Expect to get the request number.
		if($_POST['submit'] == "Accept") {

		// Obtain remarks form POST SuperGlobal
		$remarks = user_input_validation($_POST["remarks"]);
		$sql = "UPDATE `caution_deposit_requests` SET status = 1 , remarks = '{$remarks}' WHERE `request_no` = '{$request_no}' ";

		if(mysqli_query($conn,$sql)){
			redirect_to("../principal/inbox.php");
		} else {
			print "Something Went wrong at while accepting";
		}
		// should set message accordingly

	} elseif ($_POST["submit"] == "Reject") {
		// Obtain remarks form POST SuperGlobal
		$remarks = user_input_validation($_POST["remarks"]);

		$sql = "UPDATE `caution_deposit_requests` SET status = 2 , remarks = '{$remarks}' WHERE `request_no` = '{$request_no}' ";
		
		if(mysqli_query($conn,$sql)){
			redirect_to("../principal/inbox.php");
		} else {
			print "Something Went wrong while rejecting";
		}
		// Should set message as rejected
	}

?>
<?php
	//$request_no = $_GET['request_no'];
	global $request_no;
	print $request_no;
	$sql = "SELECT * FROM `caution_deposit_requests` WHERE `request_no` = '{$request_no}' ";
            $result = mysqli_query($conn,$sql); 
            if (mysqli_num_rows($result) > 0) {
              	$row = mysqli_fetch_assoc($result);
				$student_details = get_student_details($row["student_id"]);
             }
             else {
             	// Invalid request number.
             }
?>
<!DOCTYPE html>
<html>
	<title>Send a Request</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<body>
		<?php require_once("../../includes/layouts/principal_sidebar.php"); ?>
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
		  		<form class="w3-container" action="<?php echo"../Principal/caution_deposit_requests.php?request_no=".$request_no; ?>" method="post">
				    <label class="w3-text-teal"><b>Application for :</b></label>
					<input class="w3-input w3-border w3-animate-input" type="text" style="width:50%" value="Caution Deposit Request" disabled>

					<input class="w3-input w3-border w3-animate-input" type="text" style="width:50%" name ="request_no" value ="Request Number : <?php global $row; echo $row["request_no"]; ?>" disabled> <br>

					<!-- Student Detials -->
					<label class="w3-text-teal"><b>From  </b></label>
					<input class="w3-input w3-border w3-animate-input" type="text" style="width:50%" name ="date" value = "<?php global $student_details; echo $student_details["name"]." of ".$student_details["semester"]." ".get_department_name($student_details["course"]) ?>" disabled> <br>
	 
					<!-- <label class="w3-text-teal"><b>Subject</b></label>
					<input class="w3-input w3-border w3-animate-input" type="text" style="width:50%" name ="subject" required> -->
					
					<div class="w3-row w3-section">
						<div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-pencil"></i></div>
				    		<div class="w3-rest">
								<textarea class="w3-input w3-border w3-margin-bottom" style="height:300px" name ="body" disabled> <?php global $row; echo $row["body"]; ?>  </textarea>
							</div>
							<label class="w3-text-teal"><b>Remarks</b></label>
							<input class="w3-input w3-border w3-animate-input" type="text" style="width:50%" name ="remarks" placeholder = "Enter Remarks here.. Add Date for Collecting"  required>

							<input type ="submit" class="w3-button w3-right" onclick="document.getElementById('id01').style.display='none'" name="submit" value="Reject"> <i class="fa fa-paper-plane"></i>

							<input type ="submit" class="w3-button w3-right" onclick="document.getElementById('id01').style.display='none'" name="submit" value="Accept"> <i class="fa fa-paper-plane"></i>

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