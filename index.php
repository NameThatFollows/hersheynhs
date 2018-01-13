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

		<link href="https://fonts.googleapis.com/css?family=Lato:400,700,900" rel="stylesheet"> 
		<link rel="stylesheet" type="text/css" href="./css/dashboard.css">
	</head>
	<body>
		<header class="top">
			<div class="row">
				<div id="logo">
					<a href="/">HERSHEY NHS</a>
				</div>
				<div id="login">
					<a href="/login.php" id="nav-button">LOG IN</a>
				</div>
			</div>
		</header>
		<section id="banner">
			<div id="banner-image">
				<div id="banner-text">
					<h1>Hi There!</h1>
					<p>Welcome to the official website of Hershey High School's National Honor Society. </p>
					<p>Tap or click <strong>Log In</strong> to view service hours, sign up for events, and submit absense reports.</p>
				</div>
			</div>
		</section>

		<section id="main-content">
			<div>
			<?php include 'pages/home.html'; ?>
			</div>
		</section>

		<?php include 'footer.php'; ?>
	</body>
</html>
