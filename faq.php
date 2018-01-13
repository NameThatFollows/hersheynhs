<?php
	include("includes/session.php");

	if ($login_session == "admin") {
		header('Location: admin.php');
		exit;
	}

	$database = include("config.php");

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
		<title>FAQ | Hershey National Honor Society</title>
		<link rel="stylesheet" type="text/css" href="./css/info.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://fonts.googleapis.com/css?family=Lato:400,700,900" rel="stylesheet">
	</head>

	<body>
		<header class="top">
			<div class="row">
				<div id="logo">
					<a href="/">HERSHEY NHS</a>
				</div>
				<div id="login">
					<a href="/logout.php" id="nav-button">LOG OUT</a>
				</div>
			</div>

			<nav class="top-nav">
				<ul>
					<li><a href="/dashboard.php">Dashboard</a></li><li><a href="/hours.php">Hours</a></li><li><a href="/events.php">Events</a></li><li><a href="/forms.php">Forms/Docs</a></li><li class="active"><a href="/faq.php">FAQ</a></li>
				</ul>
			</nav>
		</header>

		<section id="banner">
			<div id="banner-image" style="background-image: url(/images/faq.jpg);">
				<div id="banner-text">
					<h1>Frequently Asked Questions</h1>
					<p>Questions that are asked frequently</p>
				</div>
			</div>
		</section>

		<section id="main-content">
			<?php include 'pages/faq.html'; ?>
		</section>

		<?php include 'footer.php'; ?>

	</body>
</html>