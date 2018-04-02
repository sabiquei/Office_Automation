<?php
    ob_start();
    require_once("../../includes/connect.php");
    require_once("../../includes/functions.php");   
?>
<!DOCTYPE html>
<html>
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

hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
}

h1 { 
    display: block;
    font-size: 2em;
    margin-top: 0.67em;
    margin-bottom: 0.67em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
}

h2 { 
    display: block;
    font-size: 1.5em;
    margin-top: 0.67em;
    margin-bottom: 0.67em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
}

h3 { 
    display: block;
    font-size: 1.5em;
    margin-top: 0.67em;
    margin-bottom: 0.67em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
}

h4 { 
    display: block;
    font-size: 1.5em;
    margin-top: 0.67em;
    margin-bottom: 0.67em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
	}

h5 { 
    display: block;
    font-size: 1.5em;
    margin-top: 0.67em;
    margin-bottom: 0.67em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
}
	
/* Set a style for all buttons */
button {

    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 50%;
    opacity: 0.8;
}

button:hover {
    opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
    padding: 14px 20px;
    background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: center;
  width: 30%;
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

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
    .cancelbtn, .signupbtn {
       width: 100%;
    }
}
</style>
<body>

<?php
    if(isset($_POST["submit"])){
        # Retreving data from form
        # user_input_validation() is used to check whether user input is safe or not
        $name           = user_input_validation($_REQUEST["name"]);
        $designation    = $_REQUEST["designation"];
        $semester       = $_REQUEST["semester"];
        $department     = $_REQUEST["department"];
        $mobile         = user_input_validation($_REQUEST["mobile"]);
        $email          = user_input_validation($_REQUEST["email"]);
        $userid         = user_input_validation($_REQUEST["user_id"]);
        $password       = user_input_validation( $_REQUEST["password"]);

        # Convert password into hash value.
        $password = convert_password($password);

        # Accessing connection variable form connect.php
        global $conn;
        if(check_existing_username($userid,3)){
            # Command to insert into table student_info
            $sql = "INSERT INTO tutor_info ( ";
            
            $sql.= "name,";
            $sql.= "designation,";
            $sql.= "semester,";
            $sql.= "department,";
            $sql.= "mobile,";
            $sql.= "email,";
            $sql.= "user_id,";
            $sql.= "password ";

            $sql.= ") VALUES ( ";

            $sql.= " '{$name}' , ";
            $sql.= " '{$designation}' , ";
            $sql.= " '{$semester}' , ";
            $sql.= " '{$department}' , ";
            $sql.= " '{$mobile}' , ";
            $sql.= " '{$email}' , ";
            $sql.= " '{$userid}' , ";
            $sql.= " '{$password}' ";
            $sql.= ")";

            if (mysqli_query($conn, $sql)) {
                echo "New record created successfully";
                redirect_to("../student/login.php");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            print "User ID already exists";
        }
    }
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "post" enctype="multipart/form-data" style="border:1px solid #ccc">
  <div class="container"align="left">
    <h1>Sign Up</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>
	<h2> Personal Details</h2>
	 <label for="name"><b>Name</b></label>
    <input type="text" placeholder="Full Name" name="name" required>
	<br><br>
	
	<label for="designation"><b>Designation</b></label>
    <select name="designation">
      <option value="Tutor">Tutor</option>
      <option value="AP">Assistant Professor</option>
    </select><br><br>
	<br><br>
    
	<label for="semester"><b>Semester</b></label>
    <select name="semester">
      <option value="S8">S8</option>
      <option value="S7">S7</option>
      <option value="S6">S6</option>
      <option value="S5">S5</option>
      <option value="S4">S4</option>
      <option value="S3">S3</option>
      <option value="S2">S2</option>
      <option value="S1">S1</option>
    </select><br><br>
	<br><br>
	
	<label for="department"><b>Department</b></label>
    <select name="department">
      <option value="415">Computer Science and Engineering</option>
      <option value="416">Information and Technology</option>
      <option value="403">Mechanical Engineering</option>
      <option value="401">Civil Engineering</option>
      <option value="412">Electronics and Communication Engineering</option>
      <option value="411">Electrical and Electronics Engineering</option>
    </select><br><br>
	
	<label for="mobile"><b>Phone Number</b></label>
    <input type="text" placeholder="Phone Number" name="mobile" required>
	
	 <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Email" name="email" required>
	<br><br>
	
	<h5 >UserID and Password</h5>
	<br><br>
	<label for="user_id"><b>UserID</b></label>
    <input type="text" placeholder="Enter UserID" name="user_id" required>
	<br><br>
    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
	<br><br>
	<label for="Photo"><b>Attach a photo</b></label>
	<input type="file" name="file" ><br><br>
	
	<br><br>
	<b>DECLARATION</b>
	<input type="checkbox" name="declrtn" required >I do hereby declare that the information is correct and complete to the best of my knowledge and belief<br><br>
    <div class="clearfix" align="center">
      <button type="reset" class="cancelbtn" align="center">Reset</button><br><br>
      <button type="submit" class="signupbtn" align="center" name = "submit">Sign Up</button>
    </div>
  </div>
</form>

</body>
</html>

<?php ob_end_flush(); 
        mysqli_close($conn);
?>

