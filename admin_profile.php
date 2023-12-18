<?php
	session_start();
	include ('partials/connectDB.php');

	if (!isset($_SESSION['id']))
	{
		header("Location:admin-login.php");
		exit();
	}
	else
	{
		$id = $_SESSION['id'];
		$sql = "SELECT * FROM admin_table WHERE id = '$id';";
		$run_sql = mysqli_query($conn, $sql);

		$row = mysqli_fetch_array($run_sql);

		$myFName = $row['first_name'];
		$myMName = $row['middle_name'];
		$myLName = $row['last_name'];
		$myEmail = $row['email'];
		$myPhone = $row['phone'];
		$myPosition = $row['position'];
		$myImg = $row['image'];
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
	#leftCol {
		width: 30% !important;
		text-align: left !important;
	}
	#rightCol {
		width: 70% !important;
		text-align: left !important;
	}
	ul {
		list-style-type: circle;
	}
	ul li {
		padding-bottom: 10px;
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
					<h1 id="mainHeader"><a href="#">Administrative Page</a></h1>
				</div>
				<div id="login">
					<button><a href="admin-logout.php">Logout</a></button>
				</div>
			</div>
			<div class="break"></div>
			<!-- NAVIGATION BAR SECTION -->
			<div id="navbar">
				<ul>
					<li><a href="admin_profile.php">Profile</a></li>
					<li><a href="#">Account Setting</a></li>
					<li><a href="admin-events.php">Manage Events</a></li>
					<li><a href="admin_mailbox.php">Mailbox</a></li>
				</ul>
			</div>
			<!-- CONTENT SECTION -->
			<div id="content">
				<div id="topic">
					<?php echo "<h2>Welcome Mr ".$myLName."</h2>"; ?>
					<div id="leftCol">
						<?php echo "<img src='".$myImg."' width='200' height='200' />"; ?>
					</div>
					<!-- LEFT COLUMN ABOVE - RIGHT COLUMN BELOW -->
					<div id="rightCol">
						<h4>Personal Data:</h4>
						<?php
						echo "<ul>";
						echo "<li>Full Name: ".$myFName." ".$myMName." ".$myLName."</li>";
						echo "<li>Email: ".$myEmail."</li>";
						echo "<li>Phone: ".$myPhone."</li>";
						echo "<li>Position: ".$myPosition."</li>";
						echo "</ul>";
						?>
					</div>
				</div>
				<div class="break"></div>
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
	</script>

</body>

</html>