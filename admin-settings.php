<?php
ini_set('display_errors',1);

include('includes/session.php');

if ($login_session != 'admin') {
	header('Location: 401.php');
	exit;
}

?>

<html>
	<head>
		<title>Admin Help | Hershey National Honor Society</title>
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
					<li><a href="/admin.php">Dashboard</a></li><li><a href="/admin-editmembers.php">Edit Members</a></li><li><a href="/admin-editevents.php">Edit Events</a></li><li><a href="/admin-editpages.php">Edit Content</a></li><li class="active"><a href="/admin-help.php">Help</a></li>
				</ul>
			</nav>
		</header>

		<section id="banner">
			<div id="banner-image" style="background-image: url(/images/bg.jpg);">
				<div id="banner-text">
					<h1>Settings</h1>
					<p>Change site settings</p>
				</div>
			</div>
		</section>
		
		<section id="main-content">
			<div class="center">
				
			</div>
		</section>

		<?php include 'footer.php'; ?>

	</body>
</html>
