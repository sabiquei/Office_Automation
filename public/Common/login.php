<?php
      require_once("../../includes/session.php"); 
      ob_start();
      require_once("../../includes/connect.php");
      require_once("../../includes/functions.php"); 
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<style type="text/css">
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
    padding: 14px 200px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 30%;
}

button:hover {
    opacity: 0.8;
}

.createbtn {
    width: auto;
    padding: 10px 18px;
    background-color: teal;
}
.createbtn{
        width=20%;
        float=center;
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
    <h2 align="center">Login</h2>
    <form action="login.php" method ="post">
      <div class="imgcontainer">
        <img src="anu.png" alt="Avatar" class="avatar">
      </div>

      <div class="container" align="center">
        <label for="uname" ><b>User Name</b></label>
        <input type="text" align="center" placeholder="Enter Username" name="user_id" required> <br><br>
        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required> <br><br> 
        <label for="user_type"><b>User Type</b></label>
        <select name="user_type" required>
          <option value="4">Student</option>
          <option value="3">Teacher</option>
          <option value="2">HOD</option>
          <option value="1">Principal</option>
          <!-- <option value="0">Sytem Admin</option> -->
        </select><br><br>  
        <button type="submit" name ="submit">Login</button> <br><br>
      </div>
    </form>
      <div class="container" style="background-color:#f1f1f1" align="center">
        <form method="login.php" method="get">
  		    <select name="new_account_type" required>
            <option value="4">Student</option>
            <option value="3">Teacher</option>
            <option value="2">HOD</option>
            <option value="1">Principal</option>
          </select><br><br>  
          <button type="submit" name ="create" class="createbtn">Create an Account </button><br><br>
      </div>
    </form>

    <?php
        if(isset($_POST["submit"])){
          $userid = user_input_validation($_POST["user_id"]);
          $password = user_input_validation($_POST["password"]);
          $password = convert_password($password);
          $user_type = $_POST["user_type"];
         /* print $userid;
          print $user_type;*/
          // Student Login
          if($user_type == 4) {
            $sql = "SELECT password,name,image_path,verified from student_info WHERE user_id = '{$userid}' LIMIT 1 ";
            $homepage = "../Student/stuhomepage.php";
          } elseif ($user_type == 3) {
            $sql = "SELECT password,name,verified from tutor_info WHERE user_id = '{$userid}' LIMIT 1 ";
            $homepage = "../Teacher/tutor_home.php";
          } elseif ($user_type == 2) { 
            $sql = "SELECT password,name,verified from hod_info WHERE user_id = '{$userid}' LIMIT 1 ";
            $homepage = "../HOD/hod_home.php";
          } elseif ($user_type == 1) {
            $sql = "SELECT password,name,verified from principal_info WHERE user_id = '{$userid}' LIMIT 1 ";
            $homepage = "../principal/home.php";
          } elseif ($user_type == 0) {
            $sql = "SELECT password,name from admin_info WHERE user_id = '{$userid}' LIMIT 1 ";
            $homepage = "../Admin/admin_home.php";
          }

          #Executing query
          $result = mysqli_query($conn, $sql);

          if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            if($password == $row["password"]) {
              if($row["verified"] == 1){
                $_SESSION["user_id"] = $userid;
                $_SESSION["name"] = $row["name"];
                $_SESSION["image_path"] = $row["image_path"];
                $_SESSION["user_type"] = $user_type;
                redirect_to($homepage);
              }else {
                print "Account is not verified";
              }
            } else {
              print " Invalid Password <br>";
            }
          } else {
              print " Invalid User name<br>";
          }
        } elseif(isset($_GET["create"])) {
            $new_account_type = $_GET["new_account_type"];
            if ($new_account_type == 4 ) {
              redirect_to("../Student/studentregistration.php");
            } elseif($new_account_type == 3 ) {
              redirect_to("../Teacher/tutor_registration.php");
            } elseif($new_account_type == 2 ) {
              redirect_to("../HOD/hodreg.php");
            } elseif($new_account_type == 1 ) {
              // add corresponding link for principal
            } 
        }
    ?>
  </body>
</html>

<?php ob_end_flush(); 
      mysqli_close($conn);
?>
