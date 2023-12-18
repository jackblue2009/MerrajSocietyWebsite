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

		$myLogName = $row['log_name'];
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
		margin-left: 25px;
		display: block;
		overflow: auto;
		width: 90%;
		height: 250px;
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
					<h2>Events Schedule</h2>
					<p>This page is specified for event planning. Only Administrators <u>allowed</u> to plan upcoming events, or cancel current event.</p>
					<table>
						<thead>
							<th>Event Name</th>
							<th>Event Time</th>
							<th>Date</th>
							<th>Place</th>
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
										echo "<td colspan='5' align='center'>No Event Added At The Moment..</td>";
										echo "</tr>";
								}

								if (isset($_POST['subBtn']))
								{
									$eventName = $_POST['eName'];
									$eventTime = $_POST['eTime'];
									$eventDate = $_POST['eDate'];
									$eventPlace = $_POST['ePlace'];
									$eventOrganizer = $id;
									//BELOW QUERY TO INSERT DATA
									$ins_query = "INSERT INTO event_table (event_name, event_time, event_date, event_place, admin) VALUES ('$eventName', '$eventTime', '$eventDate', '$eventPlace', '$eventOrganizer');";
									$run_ins_query = mysqli_query($conn, $ins_query);

									if ($run_ins_query)
									{
										echo "<script>alert('You have added a new event!');</script>";
										echo "<script>window.open('admin-events.php', '_self')</script>";
									}
									else
									{
										echo "<script>alert('Action could not be processed!');</script>";
										echo "<script>window.open('admin-events.php', '_self')</script>";
									}
								}
								
							?>
						</tbody>
					</table>

					<div id="addSec">
						<form action="admin-events.php" method="post" id="addForm" onsubmit="">
							<table>
								<tr>
									<td colspan="2"><span id="dataVal"></span></td>
								</tr>
								<!-- #1 -->
								<tr>
									<td><label for="eName"><span class="starR">*</span>Event Name</label></td>
									<td><input type="text" name="eName" id="eName" required /></td>
								</tr>
								<!-- #2 -->
								<tr>
									<td><label for="eTime"><span class="starR">*</span>Event Time</label></td>
									<td><input type="time" name="eTime" id="eTime" required /></td>
								</tr>
								<!-- #3 -->
								<tr>
									<td><label for="eDate"><span class="starR">*</span>Event Date</label></td>
									<td><input type="date" name="eDate" id="eDate" required /></td>
								</tr>
								<!-- #4 -->
								<tr>
									<td><label for="ePlace"><span class="starR">*</span>Event Place</label></td>
									<td><input type="text" name="ePlace" id="ePlace" required /></td>
								</tr>
								<!-- #5 -->
								<tr>
									<td><label for="eOrgBy"><span class="starR">*</span>Organized By</label></td>
									<td><input type="text" name="eOrgBy" id="eOrgBy" value="<?php echo $myLogName; ?>" required disabled /></td>
								</tr>
								<!-- #6 -->
								<tr>
									<td colspan="1">&nbsp;</td>
									<td>
										<input type="submit" name="subBtn" id="subBtn" />
										<input type="reset" name="resBtn" id="resBtn" />
									</td>
								</tr>
							</table>
						</form>
					</div>

					<!-- END of TOPIC DIV -->
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
		/*function ValidateForm ()
		{
			var eNameVar = document.forms['addForm']['eName'].value;
			var eTimeVar = document.forms['addForm']['eTime'].value;
			var eDateVar = document.forms['addForm']['eDate'].value;
			var ePlaceVar = document.forms['addForm']['ePlace'].value;

			var dataVar = document.getElementById("dataVal");
			dateVar.style.color = "red";

			if (eNameVar == "")
			{
				dataVar.innerHTML = "*Event Name Required!";
				return false;
			}
			else
			{
				dataVar.innerHTML = "";
			}

			if (eTimeVar == "")
			{
				dataVar.innerHTML = "Time NOT set!";
				return false;
			}
			else
			{
				dataVar.innerHTML = "";
			}

			if (eDateVar == "")
			{
				dataVar.innerHTML = "Date NOT set!";
				return false;
			}
			else
			{
				dataVar.innerHTML = "";
			}

			if (ePlaceVar == "")
			{
				dataVar.innerHTML = "A place for the EVENT is required!";
				return false;
			}
			else
			{
				dataVar.innerHTML = "";
			}

			return true;
		}*/

	</script>

</body>

</html>