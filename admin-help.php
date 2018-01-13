<?php
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
					<h1>Help</h1>
					<p>Get help.</p>
				</div>
			</div>
		</section>
		
		<section id="main-content">
			<div class="center">
				<p>I am working on some more in-depth tutorials and content for this page. If you have any questions or suggestions, please contact me at <a href="mailto:hello@jamesjlu.com?subject=[HERSHEY NHS] Question" target="blank">hello@jamesjlu.com</a>. I will respond to emails within 24 hours.</p>
			</div>
		</section>

		<?php include 'footer.php'; ?>

	</body>
</html>
