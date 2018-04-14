<?php require_once("../../includes/session.php");
    ob_start(); 
    require_once("../../includes/connect.php");
    require_once("../../includes/functions.php"); 
    confirm_logged_in(4);
?>
<!DOCTYPE html>
<html>
<title>Requests</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box}

/* Full-width input fields */
input[type=text], input[type=password] {
    width: 50%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
    background-color: #ddd;
    outline: none;
}
.container {
  width: 800px;
  clear: both;
}

.container input {
  width: 100%;
  clear: both;
}
/* Add padding to container elements */
.container {
	
    padding: 16px;
}

/* Clear floats */
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}
a {
    text-decoration: none;
}
</style>

<body>
    <?php 

      // Submit No Due Request
      if(isset($_GET["no_due"])) {
        $sql = "INSERT INTO `no_due_requests` (`student_id`) VALUES ('{$_SESSION["user_id"]}') ";
        if (mysqli_query($conn, $sql)) {
          $_SESSION["message"] = "No due request send to all departments";
          } else {
              $error = "Duplicate entry '".$_SESSION["user_id"]."' for key 'student_id'";
              if(mysqli_error($conn) == $error){
                  $_SESSION["message"] = "No Due request has already been submitted. Go to History for details";
              }else {
                  $_SESSION["message"] = mysqli_error($conn);
              }
          } 
    }
  ?>

  <?php require_once("../../includes/layouts/sidebar.php"); ?>

  <div id="main">

  <div class="w3-teal">
    <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
    <div class="w3-container">
      <h1 align="center">SUBMIT YOUR REQUEST</h1>
  	<h2 align="right">WELCOME <?php print($_SESSION["name"]); ?></h2><br>
    <?php print $_SESSION["message"]; 
          unset($_SESSION["message"]);
    ?>
    </div>
  </div>

  <div class="w3-container" ALIGN="CENTER">
  <h2 align="center" font-family="san-serif"><b>Select your choice of request</b></h2><br><br>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method ="get">
      <button type="submit" name ="no_due" class="w3-button w3-teal w3-round-large" style="width: 35%">Submit No Due Request</button><br><br>
    </form>
    <button class="w3-button w3-teal w3-round-large" style="width: 35%"><a href="caution_deposit_request.php">Submit Request for Caution Deposit</a></button><br><br>
    <button class="w3-button w3-teal w3-round-large" style="width: 35%"><a href="other_requests.php">Submit Other Requests</a></button><br>
  </div>

  <br>

</body>
</html>

<?php ob_end_flush(); 
      mysqli_close($conn);
?>
