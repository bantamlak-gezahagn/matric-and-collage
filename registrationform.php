<?php include('allhead.php'); ?>
<script>
	//javascript validation for various fildss
	function validateForm() {
		var fname = document.forms[ "register" ][ "fname" ].value;
		var lname = document.forms[ "register" ][ "lname" ].value;
		var faname = document.forms[ "register" ][ "faname" ].value;
		var course = document.forms[ "register" ][ "course" ].value;
		var dob = document.forms[ "register" ][ "dob" ].value;
		var addrs = document.forms[ "register" ][ "addrs" ].value;
		var gender = document.forms[ "register" ][ "gender" ].value;
		var phno = document.forms[ "register" ][ "phno" ].value;
		var x = document.forms[ "register" ][ "email" ].value;
		var atpos = x.indexOf( "@" );
		var dotpos = x.lastIndexOf( "." );
		var pass = document.forms[ "register" ][ "pass" ].value;
		if ( fname == null || fname == "" ) {
			alert( "First Name must be filled out" );
			return false;
		}
		if ( lname == null || lname == "" ) {
			alert( "Last Name must be filled out" );
			return false;
		}
		if ( faname == null || faname == "" ) {
			alert( "Father Name must be filled out" );
			return false;
		}
		if ( dob == null || dob == "" ) {
			alert( "Date of birth must be filled out" );
			return false;
		}
		if ( addrs == null || addrs == "" ) {
			alert( "Address must be filled out" );
			return false;
		}
		if ( gender == null || gender == "" ) {
			alert( "Gender must be filled out" );
			return false;
		}
		if ( phno == null || phno == "" ) {
			alert( "Phone Number must be filled out" );
			return false;
		}
		if ( atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length ) {
			alert( "Not a valid e-mail address" );
			return false;
		}
		if ( pass == null || pass == "" ) {
			alert( "Password must be filled out" );
			return false;
		}
	}
</script>

<div class="container" style="max-width: 1200px;">
	<div class="row">
		<?PHP
		include( "database.php" );
		
    $fname = $mname = $lname = $dob = $address = $gender = $contact = $email = $course = $conpassword = $password = "";
    $fnameErr = $mnameErr = $lnameErr = $dobErr = $addressErr = $genderErr = $contactErr = $emailErr = $coursesErr = $conpasswordErr =   $passwordErr = "";
	$flag=true;
  function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (empty($_POST["fname"])) {
            $fnameErr = "First Name is required";
			$flag=false;
          } else {
            $fname = test_input($_POST["fname"]);
            if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
                $fnameErr = "Only letters and white space allowed";
			$flag=false;
          }
        }
		if (empty($_POST["faname"])) {
            $mnameErr = "Middle Name is required";
			$flag=false;
          } else {
            $mname = test_input($_POST["faname"]);
            if (!preg_match("/^[a-zA-Z ]*$/",$mname)) {
                $mnameErr = "Only letters and white space allowed";
			$flag=false;
          }
        }
          if (empty($_POST["lname"])) {
            $lnameErr = "Last Name is required";
			$flag=false;
          } else {
            $lname = test_input($_POST["lname"]);
            if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
                $lnameErr = "Only letters and white space allowed";
			$flag=false;
          }
        }
        
          if (empty($_POST["dob"])) {
            $dobErr = "grade is required";
			$flag=false;
          } else {
			$x=date('Y')-15;
            $dob = test_input($_POST["dob"]);
			if($x>$dob){
		      $dobErr="Minimum age must be 15 years";
			  $flag=false;
			}
          }
		 

          if (empty($_POST["addrs"])) {
            $addressErr = "Address is required";
			$flag=false;
          } else {
            $address = test_input($_POST["addrs"]);
        
        }
		
          if (empty($_POST["phno"])) {
            $contactErr = "Contact is required";
			$flag=false;
          } else {
            $contact = test_input($_POST["phno"]);
          }
		  
		    if (empty($_POST["email"])) {
            $emailErr = "Email is required";
			$flag=false;
          } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
			$flag=false;
          }
        }
		
          if (empty($_POST["gender"])) {
            $genderErr = "Gender is requred";
			$flag=false;
          } else {
            $gender = test_input($_POST["gender"]);
          }
        
  
        
     if (empty($_POST["pass"])) {
        $passwordErr = "password is required";
	    $flag=false;
      } else {
    $password = test_input($_POST["pass"]);
    // check if name only contains letters and whitespace
	$uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number = preg_match('@[0-9]@', $password);
	$specialchar=preg_match('/[^\w]/',$password);
   if(!$uppercase || !$lowercase || !$number || strlen($password) < 8 || !$specialchar) {
      $passwordErr = "Invalid Format";
	  $flag=false;
    }
  }
  
     if (empty($_POST["conpass"])) {
    $conpasswordErr = "Password is required";
	 $flag=false;
  } else {
    $conpassword = $_POST["conpass"];
    // check if name only contains letters and whitespace
   if($conpassword!=$password) {
      $conpasswordErr = "Password must be the same";
	   $flag=false;
    }
  }
  
      $course = $_POST["course"];
	  

		 
		 
		 

			$done = "
<center>
<div class='alert alert-success fade in __web-inspector-hide-shortcut__'' style='margin-top:10px;'>
<a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>&times;</a>
<strong><h3 style='margin-top: 10px;
margin-bottom: 10px;'> Register Sucessfully Complete</h3>
</strong>
</div>
</center>
";      

   if ($flag==True){

			$sql = "INSERT INTO `registrationtable` (`FName`, `LName`, `FaName`, `DOB`, `Addrs`, `Gender`, `PhNo`, `Eid`, `Pass`,`Course`) VALUES ('$fname','$lname','$mname','$dob','$address','$gender','$contact','$email','$password','$course')";
			//close the connection
			mysqli_query( $connect, $sql );

			echo $done;
           }
		}

		?>

	</div>
	<div class="row">
		<div class="col-md-12">
			<form name="register" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" onsubmit="return validateForm()">
				<fieldset>
					<legend>
						<h3 style="padding-top: 25px;"> Registration Form </h3>
					</legend>
					<div class="control-group form-group">
						<div class="controls">
							<label>First Name: <span style="color: #ff0000;">* <?php echo $fnameErr;?></span></label>
							<input type="text" class="form-control" name="fname" id="fname" value="<?php echo $fname;?>" maxlength="30">
							<p class="help-block"></p>
						</div>
					</div>
					
					<div class="control-group form-group">
						<div class="controls">
							<label>Middle Name: <span style="color: #ff0000;">* <?php echo $mnameErr;?> </span></label>
							<input type="text" class="form-control" name="faname" id="faname" value="<?php echo $mname;?>" maxlength="30">
							<p class="help-block"></p>
						</div>
					</div>
					
					<div class="control-group form-group">
						<div class="controls">
							<label>Last Name: <span style="color: #ff0000;">* <?php echo $lnameErr;?></span></label>
							<input type="text" class="form-control" name="lname" id="lname" value="<?php echo $lname;?>" maxlength="30">
							<p class="help-block"></p>
						</div>
					</div>
					

					
					<div class="control-group form-group">
						<div class="controls">
							<label>Date of Birth: <span style="color: #ff0000;">* <?php echo $dobErr;?></span></label>
							<input type="Date" class="form-control" name="dob" id="dob" value="<?php echo $dob;?>">
							<p class="help-block"></p>
						</div>
					</div>

					<div class="control-group form-group">
						<div class="controls">
							<label>Address: <span style="color: #ff0000;">* <?php echo $addressErr;?></span></label>
							<textarea class="form-control" name="addrs" id="addrs" value="<?php echo $addrs;?>"></textarea>
							<p class="help-block"></p>
						</div>
					</div>

					<div class="control-group form-group">
						<div class="controls">
							<label>Gender: <span style="color: #ff0000;">* <?php echo $genderErr;?></span></label>
							<p>
								<label>
<input type="radio" name="gender" value="Male" id="Gender_0" checked>Male</label>
							

								<label>
<input type="radio" name="gender" value="Female" id="Gender_1">
Female</label>
							
								<br>
							</p>
							<p class="help-block"></p>
						</div>
					</div>

					<div class="control-group form-group">
						<div class="controls">
							<label>Contact Number (format: without code only 10 digits): <span style="color: #ff0000;">* <?php echo $contactErr;?></span></label>
							<input type="tel" pattern="^\d{10}$" required class="form-control" name="phno" id="phno" value="<?php echo $contact;?>" maxlength="10">
							<p class="help-block"></p>
						</div>
					</div>

					<div class="control-group form-group">
						<div class="controls">
							<label>Email Id: <span style="color: #ff0000;">* <?php echo $emailErr;?></span></label>
							<input type="text" class="form-control" name="email" id="email" value="<?php echo $email;?>" maxlength="50">
							<p class="help-block"></p>
						</div>
					</div>


					<div class="control-group form-group">
						<div class="controls">
							<label>Password: <span style="color: #ff0000;">* <?php echo $passwordErr;?></span></label>
							<input type="password" class="form-control" name="pass" id="pass" maxlength="30"> <span style="color: #ff0000;">*Max 30</span>
							<p class="help-block"></p>
						</div>
					</div>
					
					<div class="control-group form-group">
						<div class="controls">
							<label>Confirm Password: <span style="color: #ff0000;">* <?php echo $conpasswordErr;?> </span></label>
							<input type="password" class="form-control" name="conpass" maxlength="30"> <span style="color: #ff0000;">*Max 30</span>
							<p class="help-block"></p>
						</div>
					</div>
					
					  <div class="control-group form-group">
						<div class="controls">
							<label>Favorite Course <span style="color: #ff0000;"> </span></label>
							<input type="text" class="form-control" name="course" maxlength="30">
							<p class="help-block"></p>
						</div>
					</div>

					<button type="submit" name="submit" class="btn btn-primary">Register</button>
					<button type="reset" name="reset" class="btn btn-danger">Clear</button>


				</fieldset>
			</form>
		</div>
	</div>
</div>
<?php include('allfoot.php'); ?>