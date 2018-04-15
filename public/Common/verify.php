<?php 
    require_once("../../includes/session.php");
    ob_start(); 
    require_once("../../includes/connect.php");
    require_once("../../includes/functions.php"); 
    require_once("../../includes/account_verification_functions.php");
    confirm_logged_in($_SESSION["user_type"]);
?>
<!DOCTYPE html>
<html>
  <head>
    <title>History</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href='https://fonts.googleapis.com/css?family=RobotoDraft' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
    html,body,h1,h2,h3,h4,h5 {font-family: "RobotoDraft", "Roboto", sans-serif;}

    .w3-bar-block .w3-bar-item{padding:16px}
    </style>
    <link rel="stylesheet" type="text/css" href="../../stylesheets/tabs.css">
  </head>
  <body>
    <?php 
      if($_SESSION["user_type"] == 4){
        require_once("../../includes/layouts/sidebar.php"); 
      } elseif($_SESSION["user_type"] == 3){
        require_once("../../includes/layouts/tutor_sidebar.php"); 
      } elseif($_SESSION["user_type"] == 2){
        require_once("../../includes/layouts/hod_sidebar.php"); 
      } elseif($_SESSION["user_type"] == 1){
        require_once("../../includes/layouts/principal_sidebar.php"); 
      }
    ?>
    <div id="main">
      <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <p align="right" style="float: right"> <?php print $_SESSION["name"]; ?> </p>
        <div class="w3-container">
          <h1 align="center">Account Verification</h1>
        </div>
      </div>

      <div class="tab">
        <button class="tablinks" onclick="openCity(event, 'to_verify')" id="defaultOpen" >Accounts to be Verified</button>
        <button class="tablinks" onclick="openCity(event, 'verified')">Accounts Verified</button>
      </div>
      <!-- To Be Verified -->
      <div id="to_verify" class="tabcontent">
                <h3>Accounts to be Verified</h3>
      <!-- show account information like a list similar to inbox -->
      <!-- In the information page, give an option to update and verify or reject and hence delete -->
            <?php 
                  global $conn;
                  $userid = $_SESSION["user_id"];
                if($_SESSION["user_type"] == 3) {
                  $sql = student_info_sql($userid,0);
                } elseif ($_SESSION["user_type"] == 2) {
                  $sql = tutor_info_sql($userid,0);
                } elseif ($_SESSION["user_type"] == 1) {
                  $sql = hod_info_sql($userid,0);
                } elseif ($_SESSION["user_type"] == 0) {
                  // Show Principal
                }
                # Execute Query
                $result = mysqli_query($conn,$sql); 
                # Checking if no rows are greater than 1
                if (mysqli_num_rows($result) > 0) {
                  while($row = mysqli_fetch_assoc($result)){
                    list_accounts($row);
                  }
                }else {
                  print "No Accounts to be verified";
                } 
          ?>
    </div>
    <!--Verified -->
    <div id="verified" class="tabcontent">
                <h3>Verified Accounts</h3>
      <!-- show account information like a list similar to inbox -->
      <!-- -->
            <?php 
                global $conn;
                $userid = $_SESSION["user_id"];
                if($_SESSION["user_type"] == 3) {
                  $sql = student_info_sql($userid,1);
                } elseif ($_SESSION["user_type"] == 2) {
                  $sql = tutor_info_sql($userid,1);
                } elseif ($_SESSION["user_type"] == 1) {
                  $sql = hod_info_sql($userid,1);
                } elseif ($_SESSION["user_type"] == 0) {
                  // Show Principal
                } 
                # Execute Query
                $result = mysqli_query($conn,$sql); 
                # Checking if no rows are greater than 1
                if (mysqli_num_rows($result) > 0) {
                  while($row = mysqli_fetch_assoc($result)){
                    list_accounts($row);
                  }
                }else {
                  print "No Verified Accounts";
                }
        ?>
    </div>
    </div>
    <?php require_once("../../includes/tabs.php"); ?>
  </body>
</html> 

<?php ob_end_flush(); 
      mysqli_close($conn);
?>