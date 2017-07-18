<?php
	include('includes/session.php');

	if ($login_session == 'admin') {
		header('Location: admin.php');
		exit;
	}

	$database = include('config.php');

	$connection = new mysqli($database['host'], $database['user'], $database['pass'], $database['name']);

	$sql = "SELECT name FROM members WHERE username = '$login_session'";
	$result = $connection->query($sql);

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$name = $row["name"];
		}
	} else {
		$name = $login_session;
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Dashboard | Hershey National Honor Society</title>
		<link rel="stylesheet" type="text/css" href="./css/dashboard.css">
		<script src="https://use.fontawesome.com/b756983ad8.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>

	<body>
		<div id="header-wrapper">
			<div class="header-image-container">
				<header id="header-content"><h1>HERSHEY NHS</h1></header>
				<nav class="mainnav">
					<ul>
						<li class="active">
							<a href="/dashboard.php"><i class="fa fa-home fa-2x" aria-hidden="true"></i><br />HOME</a>
						<li>
							<a href="/hours.php"><i class="fa fa-clock-o fa-2x" aria-hidden="true"></i><br />HOURS</a>
						<li>
							<a href="/events.php"><i class="fa fa-calendar fa-2x" aria-hidden="true"></i><br />EVENTS</a>
						<li>
							<a href="/absence.php"><i class="fa fa-file-text-o fa-2x" aria-hidden="true"></i><br />FORMS & DOCS</a>
						<li>
							<a href="/faq.php"><i class="fa fa-question-circle-o fa-2x" aria-hidden="true"></i><br />FAQ</a>
						<li>
							<a href="/logout.php"><i class="fa fa-sign-out fa-2x" aria-hidden="true"></i><br/>LOG OUT</a>
					</ul>
				</nav>

				<div id="header-image-cover"></div>
				<div id="header-image"></div>
			</div>
		</div>

		<div class="main-content">
			<h1>Hello <?php echo $name;?>!</h1>
			<p>This is your Hershey NHS Dashboard.</p>
			<p>Click on any of the tabs above to view your completed service hours, sign up for events, submit absence reports, and view meeting agendas and other important documents. </p>
			<p>If you are using a mobile device, the tabs can be scrolled left and right. </p>
		</div>

	</body>
</html>