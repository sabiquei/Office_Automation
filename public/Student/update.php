<?php session_start();
      ob_start();
      require_once("../../includes/connect.php");
      require_once("../../includes/functions.php");
      confirm_logged_in();
?>

<!DOCTYPE html>
<html>
<title>Update Profile </title>
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

<?php require_once("../../includes/layouts/sidebar.php"); ?>

<div id="main">

<div class="w3-teal">
  <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
  <div class="w3-container">
    <h1 align="center">UPDATE PROFILE</h1>
	<h2 align="right">WELCOME <?php  print($_SESSION["user_id"]); ?> </h2>
  </div>
</div>

<img  align="right" src="anu.png" alt="Name" style="width:20%"><br>

<div class="w3-container">
  <form action="update.php" method ="post">
    <div class="container" align="center">
       <label for="name"><b>Name</b></label>
          <input type="text" placeholder="Enter Name" name="name" required>
      	<br><br>
      	 <label for="Semester"><b>Semester</b></label>
          <input type="text" placeholder="Enter Semester" name="semester" required>
      	<br><br>
      	 <label for="phn"><b>Phone Number</b></label>
          <input type="text" placeholder="Enter Mobile Number" name="mobile" requiredrequired>
      	<br><br>
      	 <label for="emailid"><b>Email id</b></label>
          <input type="text" placeholder="Enter Email id" name="email"required >
      	<br><br>
      	 <label for="userid"><b>User ID</b></label>
          <input type="text" placeholder="Enter User ID" name="userid" required>
      	<br><br>
      	 <label for="password"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="password"required >
      	<br><br>
          <input type ="submit" value ="Update" name ="submit"><br><br>
    </div>
  </form>
</div>

</div>

<?php

    if(isset($_POST["submit"])) { 
      #if(!empyt($_POST["name"])) {    
        $name      = user_input_validation($_POST["name"]);
      #}
      #$dob      = user_input_validation($_REQUEST["dob"]);
      #$gender     = user_input_validation($_REQUEST["sex"]);
      #$father     = user_input_validation($_REQUEST["fname"]);
      #$f_occupation   = user_input_validation($_REQUEST["f_occupation"]);
      #$mother     = user_input_validation($_REQUEST["mname"]);
      #$m_occupation   = user_input_validation($_REQUEST["m_occupation"]);
      #$category     = user_input_validation($_REQUEST["category"]);
      #$blood      = user_input_validation($_REQUEST["bgroup"]);
      #$aadhar     = user_input_validation($_REQUEST["aadhar"]);
      #$housename    = user_input_validation($_REQUEST["hname"]);
      #$place      = user_input_validation($_REQUEST["plc"]);
      #$postoffice   = user_input_validation($_REQUEST["post"]);
      #$district     = user_input_validation($_REQUEST["district"]);
      #if(!empyt($_POST["mobile"])) {
       $mobile     = user_input_validation($_POST["mobile"]);
      #}
      #if(!empyt($_POST["email"])) {
        $email      = user_input_validation($_POST["email"]);
      #}
      #$yoa      = user_input_validation($_REQUEST["yoa"]); #Year of Admission
      #$admission_no   = user_input_validation($_REQUEST["admno"]);
      #$reg_no     = user_input_validation($_REQUEST["register"]);
      #$course     = user_input_validation($_REQUEST["course"]);
      #if(!empyt($_POST["semester"])) {
        $semester   = user_input_validation($_POST["semester"]);
      #}
      #if(!empyt($_POST["userid"])) {
        $userid     = user_input_validation($_POST["userid"]);
      #}
      #if(!empyt($_POST["password"])) {
        $password     = user_input_validation($_POST["password"]);
        $password     = convert_password($password);
      #}

      global $conn;
      $old_user_id = $_SESSION["user_id"];

      # Command to insert into table student_info
      $sql = " UPDATE student_info SET ";
      
      $sql.= "name = '{$name}' ,";
      #$sql.= "dob,";
      #$sql.= "sex,";
      #$sql.= "father,";
      #$sql.= "f_occupation,";
      #$sql.= "mother,";
      #$sql.= "m_occupation,";
      #$sql.= "category,";
      #$sql.= "blood_group,";
      #$sql.= "aadhar,";
      #$sql.= "house_name,";
      #$sql.= "place,";
      #$sql.= "post_office,";
      #$sql.= "district,";
      $sql.= "mobile = '{$mobile}' ,";
      $sql.= "email = '{$email}' ,";
      #$sql.= "yoa,";
      #$sql.= "admission_no,";
      #$sql.= "register_no,";
      #$sql.= "course,";
      $sql.= "semester = '{$semester}' ,";
      $sql.= "user_id = '{$userid}'  ,";
      $sql.= "password  = '{$password}' ";

      $sql.= "WHERE user_id = '{$old_user_id}' ";

      #Executing query
      if (mysqli_query($conn, $sql)) {
          echo "Profile Updated<br>";
          // Updating user ID in session
          unset($_SESSION["user_id"]);
          $_SESSION["user_id"] = $userid;
          redirect_to("update.php");
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
    }
?>

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
