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
		<title>Log In | Hershey National Honor Society</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="The official website for Hershey High School's National Honor Society." />
		<meta name="keywords" content="NHS,Hershey,High,School,Hershey High School,Derry,Derry Township,Hours,Sponsored Events" />
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" type="text/css" href="./css/login.css">
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,700" rel="stylesheet">
	</head>
	<body>
		<div id="wrapper">
			<header id="header-content">
				<hr>
				<h1>LOG IN</h1>
				<hr>

				<div id="login">
					<form action="" method="post">
						<input id="username" name="username" type="text" placeholder="Username" /><br />
						<input id="stuid" name="stuid" type="password" placeholder="School ID" /><br />

						<input id="submit" type="submit" name="submit" value="LOG IN"></input><br/><br />

						<a href="/">< GO BACK</a>
					</form>
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
</html>
