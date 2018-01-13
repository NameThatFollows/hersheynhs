<?php
include('includes/session.php');

if ($login_session != 'admin') {
	header('Location: 401.php');
	exit;
}

?>

<html>
	<head>
		<title>Admin | Hershey National Honor Society</title>
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
					<li class="active"><a href="/admin.php">Dashboard</a></li><li><a href="/admin-editmembers.php">Edit Members</a></li><li><a href="/admin-editevents.php">Edit Events</a></li><li><a href="/admin-editpages.php">Edit Content</a></li><li><a href="/admin-help.php">Help</a></li>
				</ul>
			</nav>
		</header>

		<section id="banner">
			<div id="banner-image" style="background-image: url(/images/bg.jpg);">
				<div id="banner-text">
					<h1>Administration Panel</h1>
					<p>Welcome to the administration panel.</p>
					<p>Please use the links above to edit the website.</p>
				</div>
			</div>
		</section>
		
		<section id="main-content">
			<h1 class="center">Important Information</h1>
			<p>Most of the content on this website can now be edited using this administration panel. Because of this, it is very important that no students gain access to this dashboard. There are certain "core segments" to the website where the layout and format cannot be edited because these parts are used for core website functionality, such as the "hours" page.</p>

			<p>Step-by-step instructions are provided on each of the pages and detailed instructions are provided on the <a href="/admin-help.php">help</a> page, along with any additional information that may be needed. Changes made to the website are permanent, and old versions of the content cannot be accessed.</p>

			<p>If you have any further questions, please do not hesitate to contact me using the <a href="/admin-help.php">help</a> page. Have fun!</p>

			<h1 class="center">Changlog</h1>
			<p class="center">+ Added | ~ Changed | - Removed</p>
			<h2>2018/01/06</h2>
			+ SSL Certificate for secure connections.<br />
			+ Website editing capabilities.<br />
			+ Event editor.<br />
			~ Members and hours editor. Now requires grade and first year to allow upload.<br />
		</section>

		<?php include 'footer.php'; ?>

	</body>
</html>