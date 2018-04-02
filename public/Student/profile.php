<?php
      require_once("../../includes/session.php"); 
      ob_start();
      require_once("../../includes/connect.php");
      require_once("../../includes/functions.php");
      confirm_logged_in();
?>

<?php 

      global $conn;
      // User ID
      $userid = $_SESSION["user_id"];

      $sql = "SELECT name,admission_no,course,semester,house_name,mobile,email FROM student_info WHERE user_id = '{$userid}'";

      #Executing query
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
      // output data of each row
        $row = mysqli_fetch_assoc($result);
      } else {
          echo "0 results";
      }

?>
<!DOCTYPE html>
<html>
<title>Studentprofile.css</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>

<?php require_once("../../includes/layouts/sidebar.php"); ?>

<div id="main">

<div class="w3-teal">
  <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
  <div class="w3-container">
    <h1 align="center">PROFILE</h1>
	<h2 align="left">Welcome <?php global $row; print($row["name"]); ?> </h2>
  </div>
</div>

<img  align="right" src= "<?php echo $_SESSION['image_path']; ?>" alt="Name" style="width:10%"><br>



<div class="w3-container">
<p>Name :<?php global $row; print($row["name"]); ?></p><br>
<p>Student ID :<?php global $row; print($row["admission_no"]); ?></p><br>
<p>Semester :<?php global $row; print($row["semester"]); ?></p><br>
<p>Department :<?php global $row; print(get_department_name($row["department"])); ?></p><br>
<p>Address :<?php global $row; print($row["house_name"]); ?></p><br>
<p>Phone Number:<?php global $row; print($row["mobile"]); ?></p><br>
<p>Email id :<?php global $row; print($row["email"]); ?></p><br>
</div>

</div>
<div class="w3-button w3-teal w3-block w3-round-xxlarge" align="center" style="width:50% padding:50%">
  
  <a href="update.php">UPDATE PROFILE </a><br>
   
</div>
<br>

<script>
function w3_open() {
  document.getElementById("main").style.marginLeft = "25%";
  document.getElementById("mySidebar").style.width = "25%";
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("openNav").style.display = 'none';
}
function w3_close() {
  document.getElementById("main").style.marginLeft = "0%";
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("openNav").style.display = "inline-block";
}
</script>

</body>
</html>

<?php ob_end_flush(); 
      mysqli_close($conn);
?>
