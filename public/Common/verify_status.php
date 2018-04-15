<?php 
    require_once("../../includes/session.php");
    ob_start(); 
    require_once("../../includes/connect.php");
    require_once("../../includes/functions.php"); 
    require_once("../../includes/account_verification_functions.php");
    confirm_logged_in($_SESSION["user_type"]);
?>
<?php
    // Verify 
    global $conn;
    print $_POST['verify'];
    $account_user_id = $_GET['user_id'];
    if($_POST["verify"] == "Verify Account"){
      if($_SESSION["user_type"] == 3) {
        $sql = "UPDATE student_info SET verified = 1 WHERE user_id = '{$account_user_id}' ";
      } elseif ($_SESSION["user_type"] == 2) {
         $sql = "UPDATE tutor_info SET verified = 1 WHERE user_id = '{$account_user_id}' ";
      } elseif ($_SESSION["user_type"] == 1) {
         $sql = "UPDATE hod_info SET verified = 1 WHERE user_id = '{$account_user_id}' ";
      } elseif ($_SESSION["user_type"] == 0) {
        // Show Principal
      } 
      if(mysqli_query($conn,$sql)){
          redirect_to("../../public/common/verify.php");
        } else {
          // Someting went wrong
        }
    } elseif($_POST["reject"] == "Reject Account") {
      if($_SESSION["user_type"] == 3) {
        $sql = "DELETE FROM student_info WHERE user_id = '{$account_user_id}' ";
      } elseif ($_SESSION["user_type"] == 2) {
         $sql = "DELETE FROM tutor_info WHERE user_id = '{$account_user_id}' ";
      } elseif ($_SESSION["user_type"] == 1) {
        $sql = "DELETE FROM hod_info WHERE user_id = '{$account_user_id}' ";
      } elseif ($_SESSION["user_type"] == 0) {
        // Show Principal
      } 
      if(mysqli_query($conn,$sql)){
          redirect_to("../../public/common/verify.php");
        } else {
          // Someting went wrong
        }
    }
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
          <?php
            $verified = $_GET['verified']; 
            if($verified == 0) {
              print "To Be Verified<br>";
            } else {
              print "Verified Already<br>";
            } 
          ?> 
        </div>
      </div>
      <!-- To Be Verified -->
      <!-- show account information like a list similar to inbox -->
      <!-- In the information page, give an option to update and verify or reject and hence delete -->
      <form action="<?php print "verify_status.php?user_id=".$_GET['user_id']; ?>" method="post">
        <?php 
              global $conn;
              $userid = $_SESSION["user_id"];
              $account_user_id = $_GET['user_id'];
              $verified = $_GET['verified'];
            if($_SESSION["user_type"] == 3) {
              $sql = student_info_sql($userid,$verified,$account_user_id);  
            } elseif ($_SESSION["user_type"] == 2) {
              $sql = tutor_info_sql($userid,$verified,$account_user_id);  
            } elseif ($_SESSION["user_type"] == 1) {
              $sql = hod_info_sql($userid,$verified,$account_user_id);
            } elseif ($_SESSION["user_type"] == 0) {
              // Show Principal
            } 

            # Execute Query
            $result = mysqli_query($conn,$sql); 
            # Checking if no rows are greater than 1
            if (mysqli_num_rows($result) > 0) {
              $row = mysqli_fetch_assoc($result);
              foreach ($row as $key => $value) {
                #print $key." => ".$value."<br>";
                print"<label class=\"w3-text-teal\"><b>".$key."</b></label>
                <input class=\"w3-input w3-border w3-animate-input\" type=\"text\" style=\"width:50%\" name =\"".$key."\" value = \"".$value."\" disabled> <br> ";
              }
              if($verified == 1) {
                //print '<input type ="submit" class="w3-button w3-right" onclick="document.getElementById(\'id01\').style.display=\'none\'" name="update" value="Update Account"> <i class="fa fa-paper-plane"></i>';
              } else {
                print '<input type ="submit" class="w3-button w3-right" onclick="document.getElementById(\'id01\').style.display=\'none\'" name="verify" value="Verify Account"> <i class="fa fa-paper-plane"></i>';
                print '<input type ="submit" class="w3-button w3-right" onclick="document.getElementById(\'id01\').style.display=\'none\'" name="reject" value="Reject Account"> <i class="fa fa-paper-plane"></i>';
              }
            }else {
              print "No Such Account";
            }
    ?>
  </form>
    </div>
    <?php require_once("../../includes/tabs.php"); ?>
  </body>
</html> 

<?php ob_end_flush(); 
      mysqli_close($conn);
?>