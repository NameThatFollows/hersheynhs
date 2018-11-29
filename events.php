<?php
	ini_set('display_errors',1);
	include("includes/session.php");

	if ($login_session == "admin") {
		header('Location: admin.php');
		exit;
	}

	$database = include("config.php");

	date_default_timezone_set('America/New_York');

	$connection = new mysqli($database['host'], $database['user'], $database['pass'], $database['name']);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Events | Hershey National Honor Society</title>
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
					<li><a href="/dashboard.php">Dashboard</a></li><li><a href="/hours.php">Hours</a></li><li class="active"><a href="/events.php">Events</a></li><li><a href="/forms.php">Forms/Docs</a></li><li><a href="/faq.php">FAQ</a></li>
				</ul>
			</nav>
		</header>

		<section id="banner">
			<div id="banner-image" style="background-image: url(/images/events.jpg);">
				<div id="banner-text">
					<h1>Events</h1>
					<p>Sign up for events, including sponsored events</p>
				</div>
			</div>
		</section>

		<section id="main-content">
			<div class="center">
				<iframe src=<?php echo $database['eventCalendarLink']; ?> style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
				<table>
				<?php
					$result = $connection->query("SELECT eventname, startdate, enddate, link, sponsored, description FROM events ORDER BY enddate, eventname");

					if ($result->num_rows > 0) {
						$format = "F j, Y";
						while ($row = $result->fetch_assoc()) {
							echo '<tr><h3>'.$row["eventname"].'</h4>';

							// Setup Date
							$date = '';
							if ($row['startdate'] != 0 && $row['enddate'] != 0) {
								if ($row['startdate'] == $row['enddate']) {
									$date = ''.date($format, strtotime($row['enddate']));
								} else {
									$date = ''.date($format, strtotime($row['startdate'])).' - '.date($format, strtotime($row['enddate']));
								}
							} elseif ($row['startdate'] != 0) {
								$date = ''.date($format, strtotime($row['startdate']));
							} elseif ($row['enddate'] != 0) {
								$date = ''.date($format, strtotime($row['enddate']));
							}

							if (!empty($date) && $row['sponsored']) {
								echo '<h5 class="dense">'.$date.' | NHS Sponsored Event </h5>';
							} elseif (!empty($date)) {
								echo '<h5 class="dense">'.$date.'</h5>';
							} elseif ($row['sponsored']) {
								echo '<h5 class="dense">NHS Sponsored Event</h5>';
							}

							if ($row["description"] !== ""){
								echo '<p">'.nl2br($row["description"]).'</p>';
							} else {
								echo '<p">There is no description for this event.</p>';
							}

							if ($row["link"] !== "") {
								echo '<li class="signup-button"><a href="'.$row["link"].'"target="blank">Sign Up</a></li>';
							}
							echo '</tr><hr />';
						}

						echo '</table>';
					} else {
						echo '</table><h3">There are currently no events to sign up for. </h3>';
					}

					$connection->close();
				?>

				<br /><br /><p>Any questions regarding events should go to the advisors or officers.</p>
			</div>
		</section>

		<?php include 'footer.php'; ?>

	</body>
</html>
