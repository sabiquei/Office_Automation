<?php require_once("../../includes/connect.php");
      require_once("../../includes/functions.php"); ?>

<?php 

      global $conn;
      // User ID
      $userid = "sabique";

      $sql = "SELECT name,admno,course,semester FROM student_info WHERE UserID = '{$userid}'";

      #Executing query
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
      // output data of each row
        $row = mysqli_fetch_assoc($result);
      } else {
          echo "0 results";
      }

?><!DOCTYPE html>
<html>
<title>Studentprofile.css</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>

<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
  <button class="w3-bar-item w3-button w3-large"
  onclick="w3_close()">Close &times;</button>
  <a href="#" class="w3-bar-item w3-button">Inbox</a>
  <a href="stuhomepage.html" class="w3-bar-item w3-button">Home</a>
  <a href="profile.html" class="w3-bar-item w3-button">Profile</a>
  <a href="marklist.html" class="w3-bar-item w3-button">Marklist</a>
  <a href="tuthod.html" class="w3-bar-item w3-button">Tutor & HOD</a>
  <a href="log.html" class="w3-bar-item w3-button">Logout</a>
</div>

<div id="main">

<div class="w3-teal">
  <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
  <div class="w3-container">
    <h1 align="center">PROFILE</h1>
	<h2 align="left">WELCOME NAME</h2>
  </div>
</div>

<img  align="right" src="anu.png" alt="Name" style="width:10%"><br>



<div class="w3-container">
<p>Name :<?php global $row; print($row["name"]); ?></p><br>
<p>Student ID :<?php global $row; print($row["admno"]); ?></p><br>
<p>Semester :<?php global $row; print($row["semester"]); ?></p><br>
<p>Dept:<?php global $row; print($row["course"]); ?></p><br>
<p>Address :<?php global $row; print($row["hname"]); ?></p><br>
<p>Phone Number:<?php global $row; print($row["mob"]); ?></p><br>
<p>Email id :<?php global $row; print($row["email"]); ?></p><br>
</div>

</div>
<div class="w3-button w3-teal w3-block w3-round-xxlarge" align="center" style="width:50% padding:50%">
  
  <a href="update.html">UPDATE PROFILE </a><br>
   
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
