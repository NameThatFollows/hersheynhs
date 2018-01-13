<?php
	include('includes/session.php');
	header('Refresh: 5; url=dashboard.php');
?>

<html>
	<head>
		<title>401 | Hershey National Honor Society</title>
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
			</div>
		</header>

		<section id="banner">
			<div id="banner-image" style="background-image: url(/images/bg.jpg);">
				<div id="banner-text">
					<h1>401</h1>
					<p>You're not supposed to be here. </p>
				</div>
			</div>
		</section>
		
		<section id="main-content">
			<div class="center">
				<p>Either an error occured, or you tried to gain access to something you weren't supposed to. You will be redirected soon. If you aren't automatically redirected, please click HERSHEY NHS at the top of the page.</p>
			</div>
		</section>

		<?php include 'footer.php'; ?>

	</body>
</html>
