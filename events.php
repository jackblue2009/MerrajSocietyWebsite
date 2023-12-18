<!DOCTYPE html>
<html>

<head>
	<title>Merraj Society</title>
	<style type="text/css">
	#topic {
		padding-left: 15px;
	}
	table {
		margin-left: 25px;
		display: block;
		overflow: auto;
		width: 90%;
		height: 450px;
		font-size: 0.9em;
	}
	table th {
		padding-right: 100px;
	}
	</style>
	<link rel="stylesheet" type="text/css" href="styles/main.css" />
	<link href='https://fonts.googleapis.com/css?family=Raleway:400,900italic,800italic,700italic,200italic' rel='stylesheet' type='text/css'>
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
					<h2>Our Events Schedule</h2>
					<table>
						<thead>
							<th>Event Name</th>
							<th>Event Time</th>
							<th>Event Date</th>
							<th>Event Place</th>
							<th style="padding-right: 0;">Organized By</th>
						</thead>
						<tbody>
							<?php
								include ('partials/connectDB.php');

								$query = "SELECT event_table.event_name, event_table.event_time, 
										  event_table.event_date, event_table.event_place, 
										  admin_table.log_name FROM event_table 
										  INNER JOIN admin_table ON event_table.admin = admin_table.id;";
								$run_query = mysqli_query($conn, $query);

								if ($run_query->num_rows > 0)
								{
									while ($row = mysqli_fetch_array($run_query))
									{
										echo "<tr>";
										echo "<td>$row[event_name]</td>";
										echo "<td>$row[event_time]</td>";
										echo "<td>$row[event_date]</td>";
										echo "<td>$row[event_place]</td>";
										echo "<td>$row[log_name]</td>";
										echo "</tr>";
									}
								}
								else
								{
										echo "<tr>";
										echo "<td colspan='5' align='center'>No Upcoming Events...</td>";
										echo "</tr>";
								}
							?>
						</tbody>
					</table>
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

</body>

</html>