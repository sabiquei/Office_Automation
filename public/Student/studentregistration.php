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

<?php
    require_once("../../includes/session.php"); 
    ob_start();
    require_once("../../includes/connect.php");
    require_once("../../includes/functions.php");   
?>

<?php
    if(isset($_REQUEST["submit"])) {
        # Retreving data from form
        # user_input_validation() is used to check whether user input is safe or not

        $name           = user_input_validation($_REQUEST["name"]);
        $dob            = user_input_validation($_REQUEST["dob"]);
        $gender         = user_input_validation($_REQUEST["sex"]);
        $father         = user_input_validation($_REQUEST["fname"]);
        $f_occupation   = user_input_validation($_REQUEST["f_occupation"]);
        $mother         = user_input_validation($_REQUEST["mname"]);
        $m_occupation   = user_input_validation($_REQUEST["m_occupation"]);
        $category       = user_input_validation($_REQUEST["category"]);
        $blood          = user_input_validation($_REQUEST["bgroup"]);
        #$aadhar         = user_input_validation($_REQUEST["aadhar"]);
        $housename      = user_input_validation($_REQUEST["hname"]);
        $place          = user_input_validation($_REQUEST["plc"]);
        $postoffice     = user_input_validation($_REQUEST["post"]);
        $district       = user_input_validation($_REQUEST["district"]);
        $mobile         = user_input_validation($_REQUEST["mob"]);
        $email          = user_input_validation($_REQUEST["email"]);
        $yoa            = user_input_validation($_REQUEST["yoa"]); #Year of Admission
        $admission_no   = user_input_validation($_REQUEST["admno"]);
        $reg_no         = user_input_validation($_REQUEST["register"]);
        $course         = user_input_validation($_REQUEST["course"]);
        $semester       = user_input_validation($_REQUEST["semester"]);
        $userid         = user_input_validation($_REQUEST["UserID"]);
        $password       = user_input_validation($_REQUEST["psw"]);
        #$repeat_password= user_input_validation($_REQUEST["psw-repeat"]);

        # Convert password into hash value.
        $password = convert_password($password);

        # Accessing connection variable form connect.php
        global $conn;

        // Checking if user id already exists in a database
       if(check_existing_username($userid,4)){    // 1 means user id is not taken

            //Copying image
            $image_name = $_FILES['file']['name'];
            $target_dir = "../../images/student_profile/";
            $target_file = $target_dir . basename($_FILES["file"]["name"]);

             // Select file type
             $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

             // Valid file extensions
             $extensions_arr = array("jpg","jpeg","png","gif");

             // Check extension
             if( in_array($imageFileType,$extensions_arr) ){
             
              // Upload file
              $image_path = $target_dir.$userid.".".$imageFileType; //Image name changed to username.extension
              move_uploaded_file($_FILES['file']['tmp_name'],$image_path);
              # Command to insert into table student_info
                $sql = "INSERT INTO student_info ( ";
                
                $sql.= "name,";
                $sql.= "dob,";
                $sql.= "sex,";
                $sql.= "father,";
                $sql.= "f_occupation,";
                $sql.= "mother,";
                $sql.= "m_occupation,";
                $sql.= "category,";
                $sql.= "blood_group,";
                #$sql.= "aadhar,";
                $sql.= "house_name,";
                $sql.= "place,";
                $sql.= "post_office,";
                $sql.= "district,";
                $sql.= "mobile,";
                $sql.= "email,";
                $sql.= "yoa,";
                $sql.= "admission_no,";
                $sql.= "register_no,";
                $sql.= "course,";
                $sql.= "semester,";
                $sql.= "user_id ,";
                $sql.= "password ,";
                $sql.= "image_path";

                $sql.= ") VALUES ( ";

                $sql.= " '{$name}' , ";
                $sql.= " '{$dob}' , ";
                $sql.= " '{$gender}' , ";
                $sql.= " '{$father}' , ";
                $sql.= " '{$f_occupation}' , ";
                $sql.= " '{$mother}' , ";
                $sql.= " '{$m_occupation}' , ";
                $sql.= " '{$category}' , ";
                $sql.= " '{$blood}' , ";
                #$sql.= " '{$aadhar}' , ";
                $sql.= " '{$housename}' , ";
                $sql.= " '{$place}' , ";
                $sql.= " '{$postoffice}' , ";
                $sql.= " '{$district}' , ";
                $sql.= " '{$mobile}' , ";
                $sql.= " '{$email}' , ";
                $sql.= " '{$yoa}' , ";
                $sql.= " '{$admission_no}' , ";
                $sql.= " '{$reg_no}' , ";
                $sql.= " '{$course}' , ";
                $sql.= " '{$semester}' , ";
                $sql.= " '{$userid}' , ";
                $sql.= " '{$password}' , ";
                $sql.= " '{$image_path}' ";

                $sql.= ")";

                #Executing query
                if (mysqli_query($conn, $sql)) {
                    echo "New record created successfully";
                       redirect_to("../common/login.php");
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
             } else {
                print "Image Upload Failed";
             }
       } else {
            print "User id already exists";
        }
    }
?>

<body>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" style="border:1px solid #ccc" method = "post" enctype="multipart/form-data" >
  <div class="container"align="left">
    <h1>Sign Up</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>
	<h2> Personal Details</h2>
	 <label for="name"><b>Name</b></label>
    <input type="text" placeholder="Enter Name" name="name" required>
	<br><br>
	 <label for="dob"><b>DOB</b></label>
    <input type="date" placeholder="DOB" name="dob" required><br><br>
	<br><br>
	
	 <label for="gender"><b>Gender</b></label>
    <input type="radio" name="sex" value="male">Male
    <input type="radio" name="sex" value="female">Female<br><br>
    
	
	 <label for="fname"><b>Father's Name</b></label>
    <input type="text" placeholder="Father's Name" name="fname" required>
	<br><br>
	 <label for="occupation"><b>Occupation</b></label>
    <input type="text" placeholder="Occupation" name="f_occupation" required>
	<br><br>
	 <label for="mname"><b>Mother's Name</b></label>
    <input type="text" placeholder="Mother's Name" name="mname" required>
	<br><br>
	 <label for="occupation"><b>Occupation</b></label>
    <input type="text" placeholder="Occupation" name="m_occupation" required>
	<br><br>
	
	Category:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="sex" value="SC/ST">SC/ST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="radio" name="category" value="OBC">OBC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="radio" name="category" value="OEC">OEC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="radio" name="category" value="General">General<br><br>
	
	 <label for="bgroup"><b>Blood Group</b></label>
    <input type="text" placeholder="Blood Group" name="bgroup" required>
	<br><br>
	 <!-- <label for="aadhar"><b>Aadhar Number</b></label>
    <input type="text" placeholder="Aadhar " name="aadhar" required>
	<br><br> -->
	
	<hr>
    <h3 border: 1px solid #f1f1f1;
    margin-bottom: 25px;>Address Details</h3></hr>
	<br><br>
	<label for="hname"><b>House Name</b></label>
    <input type="text" placeholder="House Name" name="hname" required>
	<br><br>
	<label for="plc"><b>Place</b></label>
    <input type="text" placeholder="Place" name="plc" required>
	<br><br>
	<label for="post"><b>Post Office</b></label>
    <input type="text" placeholder="Post Office" name="post" required>
	<br><br>
	<label for="district"><b>District</b></label>
    <input type="text" placeholder="District" name="district" required>
	<br><br>
	<label for="mob"><b>Moblie Number</b></label>
    <input type="text" placeholder="Mobile Number" name="mob" required>
	<br><br>
    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>
	<br><br>
	
	<hr>
	<h4 font-size="98730px">Academic Details</h4></hr>
	<br><br>
	<label for="yoa"><b>Year of Admission</b></label>
    <input type="text" placeholder="Year of Admission" name="yoa" required>
	<br><br>
	<label for="admno"><b>Admission No</b></label>
    <input type="text" placeholder="Admission No" name="admno" required>
	<br><br>
	<label for="register"><b>Register No</b></label>
    <input type="text" placeholder="Register No" name="register" required>
	<br><br>
	<!-- <label for="clsregister"><b>Class Register No</b></label>
    <input type="text" placeholder="Class Register No" name="clsregister" required>
	<br><br> -->

	<label for="course"><b>Course</b></label><br>
    <select name="course">
      <option value="415">Computer Science and Engineering</option>
      <option value="416">Information and Technology</option>
      <option value="403">Mechanical Engineering</option>
      <option value="401">Civil Engineering</option>
      <option value="412">Electronics and Communication Engineering</option>
      <option value="411">Electrical and Electronics Engineering</option>
    </select><br><br>
	<label for="smstr"><b>Semester</b></label>
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

    <!--
	<label for="tutor"><b>Tutor</b></label>
    <input type="text" placeholder="Tutor" name="tutor" required>
	<br><br>
	<label for="hod"><b>HOD</b></label>
    <input type="text" placeholder="HOD" name="hod" required>
	<br><br>
    
	<label for="marklist"><b>Marklist</b></label>
	<select>
	<option value="s1">SEMESTER 1</option>
	<option value="s2">SEMESTER 2</option>
	<option value="s3">SEMESTER 3</option>
	<option value="s4">SEMESTER 4</option>
	<option value="s5">SEMESTER 5</option>
	<option value="s6">SEMESTER 6</option>
	<option value="s7">SEMESTER 7</option>
	<option value="s8">SEMESTER 8</option>
	</select>
	<br><br>
	
	-->
    
	<h5 >UserID and Password</h5>
	<br><br>
	<label for="UserID"><b>UserID</b></label>
    <input type="text" placeholder="Enter UserID" name="UserID" required>
	<br><br>
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
	<br><br>

    <!--
    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
	<br><br>
    -->
	
	<label for="Photo"><b>Attach a photo</b></label>
	<input type="file" name="file" required /><br><br>
	
	<br><br>
	<b>DECLARATION</b>
	<input type="checkbox" name="declrtn" required>I do hereby declare that the information is correct and complete to the best of my knowledge and belief<br><br>
    
    <!-- <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p> -->
	<br><br>
    <div class="clearfix" align="center">
      <button type="submit" class="signupbtn" align="center" name ="submit">Sign Up</button ><br><br>
      <button type="reset" class="cancelbtn" align="center">Reset</button><br>
    </div>
  </div>
</form>

</body>
</html>

<?php ob_end_flush(); 
        mysqli_close($conn);
?>
