<?php
	session_start();
	include ('partials/connectDB.php');
	session_destroy();
	header("Location:admin-login.php");
	exit();
?>