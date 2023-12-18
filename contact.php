<?php
	include ('partials/connectDB.php');

	if (isset($_POST['submit']))
	{
		$name = $_POST['c_name'];
		$email = $_POST['c_email'];
		$phone = $_POST['c_phone'];
		$msg = $_POST['c_msg'];

		$phoneVal = "";

		if ($phone == "")
		{
			$phoneVal = "[NO PHONE NUMBER]";
		}
		else
		{
			$phoneVal = $phone;
		}

		$contact_query = "INSERT INTO contact_table (name, email, phone, message) VALUES ('$name', '$email', '$phoneVal', '$msg');";

		$run_contact_query = mysqli_query($conn, $contact_query);

		if ($run_contact_query)
		{
			echo "<script>alert('Your Form has been submitted! We will respond to you within approximately 72 hours.');</script>";
			echo "<script>window.open('contact.php', '_self')</script>";
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
	}
	#meth1 {
		text-align: left !important;
	}
	input, textarea {
		border: 1px solid #5E412F;
	}
	#meth2 {
		text-align: left !important;
	}
	span {
		font-style: italic;
		font-size: 1.2em;
	}
	#methCon {
		margin-left: 240px;
	}
	input[type=number]::-webkit-inner-spin-button, 
	input[type=number]::-webkit-outer-spin-button { 
	    -webkit-appearance: none;
	    -moz-appearance: none;
	    appearance: none;
	    margin: 0; 
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
					<h2>Contact Us</h2>
					<p>If you have any question, suggestion, or anything regarding the events or the organization itself, please do not hesitate to communicate with us, either by filling the form or through direct contact below:</p>
					<br />
					<br />
					<form id="methCon">
						<input type="radio" name="method" id="method1" checked="checked" value="1" /> Via Form
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="method" id="method2" value="2" /> Via Direct Contact
					</form>
					<br />
					<br />
					<div id="meth1" class="desc">
						<form action="contact.php" method="post" onsubmit="return ValidateForm()" id="conForm">
							<fieldset>
								<legend>Contact Form</legend>
								<label for="c_name">Name: </label>
								<br />
								<input type="text" name="c_name" id="c_name" placeholder="Type Your Name..." />&nbsp;&nbsp;
								<span id="nameVal"></span>
								<br />
								<label for="c_email">Email: </label>
								<br />
								<input type="email" name="c_email" id="c_email" placeholder="Type Your Email..." />&nbsp;&nbsp;
								<span id="emailVal"></span>
								<br />
								<label for="c_phone">Phone: </label>
								<br />
								<input type="text" name="c_phone" id="c_phone" maxlength="8" placeholder="Type Your Phone..." />
								<br />
								<label for="c_msg">Message: </label>
								<br />
								<textarea name="c_msg" id="c_msg" rows="5" cols="21" placeholder="Type Your Message..."></textarea>&nbsp;&nbsp;
								<span id="msgVal"></span>
								<br />
								<input type="submit" name="submit" id="submit" alt="Submit" />
								<input type="reset" name="reset" id="reset" alt="Reset" />
							</fieldset>
						</form>
					</div>
					<div id="meth2" class="desc">
						<form action="" method="post">
							<fieldset>
								<legend>Direct Contact</legend>
								<label>Contact Via Office Number:</label>
								<br />
								<span>+973 17334088</span>
								<br />
								<br />
								<label>Contact Via Email Address:</label>
								<br />
								<span>merraj_society@merraj.com</span>
								<br />
								<br />
								<label>Contact Via Mailbox:</label>
								<br />
								<span>P.O. Box 27719</span>
							</fieldset>
						</form>
					</div>
				</div>
				<div class="break"></div>
				<br />
				<br />
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
		$(document).ready(function(){
			$("#meth2.desc").hide();
			$("input[name$='method']").click(function () {
				var test = $(this).val();

				$("div.desc").hide();
				$("#meth" + test).show();
			});
		});

		//Form Varification Function
		function ValidateForm ()
		{
			var nameVar = document.forms["conForm"]["c_name"].value;		//Name Variable
			var emailVar = document.forms["conForm"]["c_email"].value;		//Email Variable
			var msgVar = document.forms["conForm"]["c_msg"].value;			//Message Variable

			//Verfiy if NAME is not NULL
			if (nameVar == "")
			{
				document.getElementById("nameVal").innerHTML = "Name Required!";
				document.getElementById("nameVal").style.color = "red";
				return false;
			}
			else
			{
				document.getElementById("nameVal").innerHTML = "";
			}

			//Verify if EMAIL is not NULL
			if (emailVar == "")
			{
				document.getElementById("emailVal").innerHTML = "Email Required!";
				document.getElementById("emailVal").style.color = "red";
				return false;
			}
			else
			{
				document.getElementById("emailVal").innerHTML = "";
			}

			//Verify if Message is not NULL
			if (msgVar == "")
			{
				document.getElementById("msgVal").innerHTML = "Message is Required!";
				document.getElementById("msgVal").style.color = "red";
				return false;
			}
			else
			{
				document.getElementById("msgVal").innerHTML = "";
			}

			return true;
		}
	</script>

</body>

</html>