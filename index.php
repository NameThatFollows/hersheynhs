<?php
	include('includes/login_process.php');

	if(isset($_SESSION['login_user'])) {
		header("location: dashboard.php");
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Hershey National Honor Society</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="The official website for Hershey High School's National Honor Society." />
		<meta name="keywords" content="NHS,Hershey,High,School,Hershey High School,Derry,Derry Township,Hours,Sponsored Events" />
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" type="text/css" href="./css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,700" rel="stylesheet">
	</head>
	<body>
		<div id="wrapper">
			<header id="header-content">
				<hr>
				<h1>HERSHEY NHS</h1>

				<p>Welcome to the official website of Hershey High School's National Honor Society. If you are a member, tap or click the "log in" button to view service hours, submit absence reports, and sign up for events.</p>
				<hr>
				<div id="buttons" class="hidden open-buttons">
					<a class="big-button" id="login-button" href="./login.php">LOG IN</a>
				</div>

				<footer>
					&copy; 2017 Hershey NHS. All rights reserved. <br />
					Made with &#10084 by <a href="http://www.jamesjlu.com" target="blank">James Lu</a>.
				</footer>
			</header>
		</div>
		<div id="bg-cover"></div>
		<div id="bg"></div>
	</body>

	<script src="./js/script.js"></script>
</html>
