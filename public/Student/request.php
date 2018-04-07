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
</style>

<body>
    <?php 
      if(isset($_GET["no_due"])) {
        $sql = "INSERT INTO `no_due_requests` (`student_id`) VALUES ('{$_SESSION["user_id"]}') ";
        if (mysqli_query($conn, $sql)) {
          $_SESSION["message"] = "No due request send to all departments";
          } else {
              $_SESSION["message"] = mysqli_error($conn);
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
      <button type="submit" name ="no_due" class="w3-button w3-teal w3-round-large">SUBMIT NO DUE REQUEST</button><br><br>
    </form>
    <p><button class="w3-button w3-teal w3-round-large"><a href="caution.html">CAUTION-DEPOSIT</a></button></p><br><br>
    <p><button class="w3-button w3-teal w3-round-large"><a href="other_requests.php">OTHER REQUEST</a></button></p><br><br>
  </div>

  <br>

</body>
</html>

<?php ob_end_flush(); 
      mysqli_close($conn);
?>
