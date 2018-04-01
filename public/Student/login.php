<?php
      require_once("../../includes/session.php"); 
      ob_start();
      require_once("../../includes/connect.php");
      require_once("../../includes/functions.php"); 
?>

<!DOCTYPE html>
<html>
<head>
  <title>Student Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
    width: 50%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: teal;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 50%;
}

button:hover {
    opacity: 0.8;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 10%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
</style>
</head>
<body>

<h2 align="center">Login Form</h2>

<form action="login.php" method ="post">
  <div class="imgcontainer">
    <img src="anu.png" alt="Avatar" class="avatar">
  </div>

  <div class="container" align="center">
    <label for="uname" ><b>User Name</b></label>
    <input type="text" align="center" placeholder="Enter Username" name="user_id" required> 
<br><br>
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
     <br><br>   
    <button type="submit" value="Login" name ="submit">Login</button>
	<br><br>
  <!--
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
   -->
  </div>

  <div class="container" style="background-color:#f1f1f1" align="center">
    <!--
    <button type="button" class="cancelbtn" align="center">Cancel</button><br><br>
  -->
     <!-- <a href="#">Forgot password?</a><br><br> -->
	<a href="studentregistration.php">Create a new account</a>
  </div>
</form>

<?php
      if(isset($_POST["submit"])){
        $userid = user_input_validation($_POST["user_id"]);
        $password = user_input_validation($_POST["password"]);
        $password = convert_password($password);

        $sql = "SELECT password,name from student_info WHERE user_id = '{$userid}' LIMIT 1 ";

        #Executing query
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);

          if($password == $row["password"]) {
            $_SESSION["user_id"] = $userid;
            $_SESSION["name"] = $row["name"];
            redirect_to("stuhomepage.php");
          } else {
            print " Invalid Password <br>";
          }
        } else {
            print " Invalid User name<br>";
        }
      }
?>

</body>
</html>

<?php ob_end_flush(); 
      mysqli_close($conn);
?>
