<?php
	session_start();
	include ('partials/connectDB.php');

	$errorLogin = "";

	if (isset($_POST['loginBtn']))
	{
		$adminName = $_POST['aName'];
		$adminPass = $_POST['aPass'];

		$query = "SELECT id FROM admin_table WHERE log_name = '$adminName' AND log_password = '$adminPass';";
		$run_query = mysqli_query($conn, $query);

		if ($row = mysqli_fetch_array($run_query))
		{
			$_SESSION['id'] = $row['id'];
			header("Location:admin_profile.php");
		}
		else
		{
			if ($adminName == "" || $adminPass = "")
				$errorLogin = "<p style='color: red;'>Login Name/ Password are both REQUIRED!</p>";
			elseif ($adminName != $row['log_name'] || $adminPass != $row['log_password'])
				$errorLogin = "<p style='color: red;'>Login Name/ Password are INCORRECT!</p>";
		}
	}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Merraj Society</title>
	<style type="text/css">
	#topic {
		padding-left: 15px;
		text-align: center;
	}
	#loginForm {
		/*The Form styles*/
	}
	#regBtn a {
		text-decoration: none;
		color: #000000;
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
					<h2>Admin Login</h2>
					<form action="admin-login.php" method="post" id="loginForm">
						<label for="aName">Login Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
						<input type="text" name="aName" id="aName" /><br />
						<p id="logNameVal"></p>
						<br />
						<br />
						<label for="aPass">Login Password: </label>
						<input type="password" name="aPass" id="aPass" /><br />
						<p id="logPassVal"></p>
						<br />
						<br />
						<input type="submit" name="loginBtn" id="loginBtn" value="Login" />
						<button id="regBtn" onclick="return RedirectReg()"><a href="admin-register.php">Register</a></button>
						<br />
						<?php
							echo $errorLogin;
						?>
					</form>
					<br />
					<br />
					<h3>[Important]</h3>
					<p>Only athunticated and authroized members are allowed to log in. Do not try to hack in, steal data, or phish information; because you are going to get caught and your monkey ass going to be thrown into prison.</p>
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
		function RedirectReg ()
		{
			var usrInput = prompt("Type Secret Password:");

			if (usrInput != "00000")
			{
				alert("Sorry, but your input is irrelevant!");
				return false;
			}
			else
			{
				window.open('admin-register.php', '_self');
			}

			return true;
		}
	</script>

</body>

</html>