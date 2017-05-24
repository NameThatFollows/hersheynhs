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
					<a class="big-button" id="about-button" href="javascript:void(0)">ABOUT US</a>
					<a class="big-button" id="news-button" href="javascript:void(0)">NEWS & UPDATES</a>
					<a class="big-button" id="login-button" href="javascript:void(0)">LOG IN</a>
				</div>

				<div id="about" class="hidden">
					<p>ABOUT IS OPEN</p>
					<a class="big-button home-button" href="javascript:void(0)">< GO BACK</a>
				</div>
				<div id="news" class="hidden">
					<p>NEWS IS OPEN</p>
					<a class="big-button home-button" href="javascript:void(0)">< GO BACK</a>
				</div>
				<div id="login" class="hidden">
					<input id="username" name="username" type="text" placeholder="Username" /><br />
					<input id="stuid" name="stuid" type="password" placeholder="School ID" /><br />

					<a class="big-button home-button" href="javascript:void(0)">< GO BACK</a>
					<input id="submit" type="submit" name="submit" value="LOG IN"></input>
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

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="./js/script.js"></script>
</html>
