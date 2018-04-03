<?php require_once("../../includes/session.php");
    ob_start(); 
    require_once("../../includes/connect.php");
    require_once("../../includes/functions.php"); 
    confirm_logged_in();
?>

<!DOCTYPE html>
<html>
<title>Tutor and HOD</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>

<?php require_once("../../includes/layouts/sidebar.php"); ?>

<div id="main">

<div class="w3-teal">
  <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
  <div class="w3-container">
    <h1 align="center">TUTOR AND HOD</h1>
	<h2 align="RIGHT">WELCOME <?php print($_SESSION["name"]); ?> </h2>
  </div>
</div>
<div class="w3-container">
<h3 font-family="san-serif" align="left"><b>TUTOR</b></h3><br><br>

<?php 
      global $conn;

      // User ID
      $userid = $_SESSION["user_id"];

      // Obtain Student Department
      $sql = "SELECT course,semester FROM student_info WHERE user_id = '{$userid}' LIMIT 1 ";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $course = $row["course"];
      $semester = $row["semester"];

      //Obtaining Tutor and HOD Information

      $sql = "SELECT name,designation,mobile,email FROM tutor_info  WHERE department = '{$course}' AND semester = '{$semester}' AND designation = 'tutor' LIMIT 1";
      $sql2 = "SELECT name,designation,mobile,email FROM hod_info  WHERE department = '{$course}' LIMIT 1";
      // Executing query
      $result = mysqli_query($conn, $sql);
      $result2 = mysqli_query($conn, $sql2);

      if (mysqli_num_rows($result) > 0) {
      // output data of each row
        $row = mysqli_fetch_assoc($result);
      } else {
          echo "0 results";
      }
      if (mysqli_num_rows($result2) > 0) {
      // output data of each row
        $row2 = mysqli_fetch_assoc($result2);
      } else {
          echo "0 results";
      }

      // Displaying Tutor and HOD info
      print "
      <p>Name : ".$row['name']."</p><br>
      <p>Designation : ".$row['designation']."</p><br>
      <p>Phone Number : ".$row['mobile']."</p><br>
      <p>Email ID : ".$row['email']."</p><br>
      </div> ";


      print " <div class=\"w3-container\">
      <h3 font-family=\"san-serif\" align=\"left\"><b>HOD</b></h3><br><br>
      <p>Name : ".$row2['name']."</p><br>
      <p>Designation : ".$row2['designation']."</p><br>
      <p>Phone Number : ".$row2['mobile']."</p><br>
      <p>Email ID : ".$row2['email']."</p><br>
      </div>

      <br> ";
?>

</body>
</html>
<?php ob_end_flush(); 
      mysqli_close($conn);
?>