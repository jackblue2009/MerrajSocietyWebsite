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
	table {
		margin-left: 75px;
		display: block;
		overflow: auto;
		width: 90%;
		height: 400px;
		font-size: 0.9em;
	}
	table th {
		padding-right: 100px;
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
					<h2>Site Mailbox</h2>
					<p>All administrators have access to this page. Here you will receive messages from people around the world. You will have to respond to someone within 72 hours after receiving his/her particular message so it would be an efficient service.</p>
					<table>
						<thead>
							<th>Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th style="padding-right: 0;">Message</th>
						</thead>
						<tbody>
							<?php
								include ('partials/connectDB.php');

								$query = "SELECT * FROM contact_table;";
								$run_query = mysqli_query($conn, $query);

								while ($row = mysqli_fetch_array($run_query))
								{
									# code...
									echo "<tr>";
									echo "<td>$row[name]</td>";
									echo "<td><a href='mailto:$row[email]'>$row[email]</a></td>";
									echo "<td>$row[phone]</td>";
									echo "<td>$row[message]</td>";
									echo "</tr>";
									echo "<tr>";
									echo "<td>&nbsp;</td>";
									echo "<td>&nbsp;</td>";
									echo "<td>&nbsp;</td>";
									echo "<td>&nbsp;</td>";
									echo "</tr>";
								}
							?>
						</tbody>
					</table>
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