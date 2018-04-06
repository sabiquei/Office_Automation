<?php 
    require_once("../../includes/session.php");
    ob_start(); 
    require_once("../../includes/connect.php");
    require_once("../../includes/functions.php"); 
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
          <h1 align="center">HISTORY </h1>
        </div>
      </div>
      <?php 
          global $conn;
          $userid = $_SESSION["user_id"];

          if($_SESSION["user_type"] == 4){
            $sql = "SELECT * FROM `pending_requests_other` WHERE `student_id` = '{$userid}' ";
          } elseif($_SESSION["user_type"] == 3){
            $sql = "SELECT * FROM `pending_requests_other` WHERE `tutor_id` = '{$userid}' AND (`current_level` > 0 OR (`current_level` = 0 AND `status` = 2))";
          } elseif ($_SESSION["user_type"] == 2) {
            $sql = "SELECT * FROM `pending_requests_other` WHERE `hod_id` = '{$userid}' AND (`current_level` > 1 OR (`current_level` = 1 AND `status` = 2))";
          } elseif ($_SESSION["user_type"] == 1) {
            $sql = "SELECT * FROM `pending_requests_other` WHERE  `current_level` > 2 OR (`current_level` = 2 AND `status` = 2)";
          }

          $result = mysqli_query($conn,$sql); 
          $count = mysqli_num_rows($result);

          if ($count > 0) {
          # output data of each row
            while($row = mysqli_fetch_assoc($result)){
              $student_details = get_student_details($row["student_id"]);
              $request_no = $row["request_no"];
              $category = $row["category"];

              $color = get_status_color($row["status"]);

              print "<a style=\"text-decoration: none\" href=\"other_request_status.php?request_no=".$request_no."&category=".$category."\">
                        <div class=\"w3-container w3-hover-light-gray w3-border-bottom test\" width=\"100%\" style =\"color : ".$color.";\" >"
                        .get_department_name($student_details["course"])." , ".$student_details["semester"]."
                        <br>".$student_details["name"]."<br>"
                        .$row["subject"]."<br>".$row["date"]."<br>Status : ".get_status_remarks($row["status"],$row["current_level"])."
                        </div>
                      </a>";
            }
          } else {
              echo "No History";
          }
      ?>
    </div>
  </body>
</html> 

<?php ob_end_flush(); 
      mysqli_close($conn);
?>