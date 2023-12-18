<?php
	include ('partials/connectDB.php');

	

	if (isset($_POST['subBtn']))
	{
		//File Upload Process Script
		$target_dir = "images/";
		$target_file = $_POST['fName'] . ".png";
		$fileName = $target_dir . $target_file;
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
		$uploadError = "";

		move_uploaded_file($_FILES['r_image']['name'], $target_dir . $target_file);

		//Assign DATA from FORM to VARIABLES 
		$logName = mysqli_real_escape_string($conn, $_POST['logName']);
		$logPass = mysqli_real_escape_string($conn, md5($_POST['logPass']));
		$fName = mysqli_real_escape_string($conn, $_POST['fName']);
		$mName = mysqli_real_escape_string($conn, $_POST['mName']);
		$lName = mysqli_real_escape_string($conn, $_POST['lName']);
		$myEmail = mysqli_real_escape_string($conn, $_POST['r_email']);
		$myPhone = mysqli_real_escape_string($conn, $_POST['r_phone']);
		$myPos = mysqli_real_escape_string($conn, $_POST['r_position']);
		$myImg = mysqli_real_escape_string($conn, $fileName);
		$regDate = date('Y-m-d');

		$insAdmin = "INSERT INTO admin_table (log_name, log_password, first_name, middle_name, last_name,
					 email, phone, position, image, registeration_date)
					 VALUES ('$logName', '$logPass', '$fName', '$mName', '$lName', '$myEmail', '$myPhone', '$myPos', '$myImg', '$regDate');";
		$run_insAdmin = mysqli_query($conn, $insAdmin);

		if ($run_insAdmin)
		{
			echo "<script>alert('You have successfully registered as new Admin.');</script>";
			echo "<script>window.open('admin-register.php', '_self')</script>";
		}
	}


?>
<!DOCTYPE html>
<html>

<head>
	<title>Merraj Society</title>
	<style type="text/css">
	#topic {
		padding-left: 25px;
	}
	input {
		border-color: #A87152;
	}
	input.btn {
		background-color: #A87152;
		color: #FCEBB6;
	}
	</style>
	<link rel="stylesheet" type="text/css" href="styles/main.css" />
	<link href='https://fonts.googleapis.com/css?family=Raleway:400,900italic,800italic,700italic,200italic' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
</head>

<body>

	<div id="container">
		<div class="fixedWidth">
			<!-- HEADER SECTION -->
			<div id="header">
				<div id="title">
					<h1 id="mainHeader"><a href="index.php">Merraj Society</a></h1>
				</div>
				<div id="login">
					<button><a href="admin-login.php">Admin Login</a></button>
				</div>
			</div>
			<div class="break"></div>
			<!-- NAVIGATION BAR SECTION -->
			<div id="navbar">
				<ul>
					<li><a href="about.php">About</a></li>
					<li><a href="achievements.php">Achievements</a></li>
					<li><a href="events.php">Events</a></li>
					<li><a href="contact.php">Contact</a></li>
				</ul>
			</div>
			<!-- CONTENT SECTION -->
			<div id="content">
				<div id="topic">
					<h2>Register new Admin Account</h2>
					<br />
					<p id="dataVal"></p>
					<p id="passVal"></p>
					<p id="fileVal"></p>
					<form action="admin-register.php" method="post" id="regForm" onsubmit="return ValidateDate()" enctype="multipart/form-data">
						<fieldset>
							<legend>Enter Required Data</legend>

							<table>
								<tr>
									<td><label for="logName"><span class="starR">*</span>Log Name: </label></td>
									<td><input type="text" name="logName" id="logName" /></td>
									<td colspan="2"></td>
								</tr>
								<tr>
									<td><label for="logPass"><span class="starR">*</span>Log Password: </label></td>
									<td><input type="password" name="logPass" id="logPass" /></td>
									<td><label for="confirmLogPass"><span class="starR">*</span>Confirm Log Password: </label></td>
									<td><input type="password" name="confirmLogPass" id="confirmLogPass" /></td>
								</tr>
								<tr>
									<td><label for="fName"><span class="starR">*</span>First Name: </label></td>
									<td><input type="text" name="fName" id="fName" /></td>
									<td><label for="mName">Middle Name: </label></td>
									<td><input type="text" name="mName" id="mName" /></td>
								</tr>
								<tr>
									<td><label for="lName"><span class="starR">*</span>Last Name: </label></td>
									<td><input type="text" name="lName" id="lName" /></td>
									<td colspan="2"></td>
								</tr>
								<tr>
									<td><label for="r_email"><span class="starR">*</span>Email: </label></td>
									<td><input type="email" name="r_email" id="r_email" /></td>
									<td colspan="2"></td>
								</tr>
								<tr>
									<td><label for="r_phone"><span class="starR">*</span>Phone: </label></td>
									<td><input type="text" maxlength="8" name="r_phone" id="r_phone" /></td>
									<td colspan="2"></td>
								</tr>
								<tr>
									<td><label for="r_position"><span class="starR">*</span>Position: </label></td>
									<td><input type="text" name="r_position" id="r_position" /></td>
									<td colspan="2"></td>
								</tr>
								<tr>
									<td><label for="r_image"><span class="starR">*</span>Personal Photo: </label></td>
									<td><input type="file" name="r_image" id="r_image" onchange="" /></td>
									<td colspan="2"></td>
								</tr>
								<tr>
									<td></td>
									<td>
										<input type="submit" name="subBtn" id="subBtn" class="btn" />
										<input type="reset" name="resetBtn" id="resetBtn" class="btn" />
									</td>
									<td colspan="2"></td>
								</tr>
							</table>
							
							
						</fieldset>
					</form>
					<br />
					<br />
				</div>
				<div class="break"></div>
				<div id="social">
					Follow Us
					<img src="images/twitter-icon.png" width="16" height="16" alt="twitter-icon" />
					<img src="images/facebook-icon.png" width="16" height="16" alt="facebook-icon" />
					<img src="images/youtube-icon.png" width="16" height="16" alt="youtube-icon" />
					<img src="images/instagram-icon.png" width="16" height="16" alt="instagram-icon" />
				</div>
			</div>
			<!-- FOOTER SECTION -->
			<div id="footer">
				Copyright 2016&copy; Merraj Society
			</div>
		</div>
	</div>

	<!-- SCRIPTING SECTION BELOW -->
	<script type="text/javascript">
		//Scripting GOES HERE
		var fileVar = document.getElementById("fileVal");
		fileVar.style.color = "red";
		fileVar.innerHTML = "<?php echo $uploadError; ?>";

		function ValidateDate ()
		{
			var ok = true;

			var logNameVar = document.forms['regForm']['logName'].value;
			var logPassVar = document.forms['regForm']['logPass'].value;
			var logPassConfirmVar = document.forms['regForm']['confirmLogPass'].value;
			var fNameVar = document.forms['regForm']['fName'].value;
			var lNameVar = document.forms['regForm']['lName'].value;
			var emailVar = document.forms['regForm']['r_email'].value;
			var phoneVar = document.forms['regForm']['r_phone'].value;
			var positionVar = document.forms['regForm']['r_position'].value;

			var dataVar = document.getElementById("dataVal");
			dataVar.style.color = "red";
			var passVar = document.getElementById("passVal");
			passVar.style.color = "red";
			

			if(logNameVar == "")
			{
				dataVar.innerHTML = "*Please provide the required information!";
				dataVar.style.color = "red";
				document.getElementById("logName").style.backgroundColor = "#FF9191";
				ok = false;
			}
			else
			{
				dataVar.innerHTML = "";
				document.getElementById("logName").style.backgroundColor = "#FFFFFF";
			}

			if (logPassVar == "")
			{
				dataVar.innerHTML = "*Please provide the required information!";
				dataVar.style.color = "red";
				document.getElementById("logPass").style.backgroundColor = "#FF9191";
				ok = false;
			}
			else
			{
				dataVar.innerHTML = "";
				document.getElementById("logPass").style.backgroundColor = "#FFFFFF";
				
			}

			if (logPassConfirmVar == "")
			{
				dataVar.innerHTML = "*Please provide the required information!";
				dataVar.style.color = "red";
				document.getElementById("confirmLogPass").style.backgroundColor = "#FF9191";
				ok = false;
			}
			else
			{
				dataVar.innerHTML = "";
				document.getElementById("confirmLogPass").style.backgroundColor = "#FFFFFF";
			}

			//Password Match-Up Validation START
			if (logPassVar != logPassConfirmVar)
			{
				passVar.innerHTML = "*BOTH PASSWORDS need to be the same!";
				document.getElementById("logPass").style.borderColor = "#FF9191";
				document.getElementById("confirmLogPass").style.borderColor = "#FF9191";
				ok = false;
			}
			else
			{
				passVar.innerHTML = "";
				document.getElementById("logPass").style.borderColor = "#A87152";
				document.getElementById("confirmLogPass").style.borderColor = "#A87152";
			}
			//Password Match-Up Validation END

			//First and Last Name Validation START
			if (fNameVar == "")
			{
				dataVar.innerHTML = "*Please provide the required information!";
				dataVar.style.color = "red";
				document.getElementById("fName").style.backgroundColor = "#FF9191";
				ok = false;
			}
			else
			{
				dataVar.innerHTML = "";
				document.getElementById("fName").style.backgroundColor = "#FFFFFF";
			}

			if (lNameVar == "")
			{
				dataVar.innerHTML = "*Please provide the required information!";
				dataVar.style.color = "red";
				document.getElementById("lName").style.backgroundColor = "#FF9191";
				ok = false;
			}
			else
			{
				dataVar.innerHTML = "";
				document.getElementById("lName").style.backgroundColor = "#FFFFFF";
			}
			////First and Last Name Validation END

			if (emailVar == "")
			{
				dataVar.innerHTML = "*Please provide the required information!";
				dataVar.style.color = "red";
				document.getElementById("r_email").style.backgroundColor = "#FF9191";
				ok = false;
			}
			else
			{
				dataVar.innerHTML = "";
				document.getElementById("r_email").style.backgroundColor = "#FFFFFF";
			}

			if (phoneVar == "")
			{
				dataVar.innerHTML = "*Please provide the required information!";
				dataVar.style.color = "red";
				document.getElementById("r_phone").style.backgroundColor = "#FF9191";
				ok = false;
			}
			else
			{
				dataVar.innerHTML = "";
				document.getElementById("r_phone").style.backgroundColor = "#FFFFFF";
			}

			if (positionVar == "")
			{
				dataVar.innerHTML = "*Please provide the required information!";
				dataVar.style.color = "red";
				document.getElementById("r_position").style.backgroundColor = "#FF9191";
				ok = false;
			}
			else
			{
				dataVar.innerHTML = "";
				document.getElementById("r_position").style.backgroundColor = "#FFFFFF";
			}

			

			return ok;
		} //End of MAIN VALIDATION FUNCTION

		/*function validate_fileupload(fileName)
		{
			var fileVar = document.getElementById("fileVal");
			fileVar.style.color = "red";

		    var allowed_extensions = new Array("jpg","png","gif");
		    var file_extension = fileName.split('.').pop(); // split function will split the filename by dot(.), and pop function will pop the last element from the array which will give you the extension as well. If there will be no extension then it will return the filename.

		    for(var i = 0; i < allowed_extensions.length; i++)
		    {
		        if(allowed_extensions[i]!=file_extension)
		        {
		        	fileVar.innerHTML = "*Please Upload a valid image file!";
		            return false; // valid file extension
		        }
		        else
		        {
		        	fileVar.innerHTML = "";
		        }
		    }

		    return true;
		}*/
	</script>

</body>

</html>